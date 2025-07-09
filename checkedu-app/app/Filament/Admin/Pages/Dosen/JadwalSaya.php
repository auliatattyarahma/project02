<?php

namespace App\Filament\Admin\Pages\Dosen;

use App\Models\ClassSession;
use App\Models\Schedule;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class JadwalSaya extends Page
{
    // Pengaturan untuk tampilan di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Jadwal Saya';
    protected static ?string $title = 'Jadwal Mengajar Saya';

    // Tampilan Blade yang akan digunakan
    protected static string $view = 'filament.admin.pages.dosen.jadwal-saya';

    /**
     * Fungsi ini untuk mengatur siapa yang bisa melihat menu ini.
     * Hanya user dengan peran 'dosen' yang bisa melihatnya.
     */
    public static function canAccess(): bool
    {
        return true; // Selalu izinkan akses
    }

    /**
     * Mendefinisikan Aksi (Tombol) yang ada di halaman ini.
     */
    protected function getHeaderActions(): array
    {
        return [
            // Tombol Refresh
            Action::make('refresh')
                ->label('Refresh Data')
                ->action('refreshSchedules'),
        ];
    }

    // Properti untuk menyimpan data jadwal
    public $schedules;

    /**
     * Fungsi ini akan dijalankan saat halaman pertama kali dimuat.
     */
    public function mount(): void
    {
        $this->refreshSchedules();
    }

    /**
     * Fungsi untuk mengambil data jadwal dari database.
     */
    public function refreshSchedules(): void
    {
        $this->schedules = Schedule::where('lecturer_id', Auth::id())
            ->with(['course', 'classSessions' => function ($query) {
                // Ambil sesi untuk hari ini saja
                $query->whereDate('session_date', today());
            }])
            ->get();
    }

    /**
     * Fungsi yang akan dijalankan saat tombol "Mulai Sesi" diklik.
     */
    public function startSession(int $scheduleId)
    {
        // Cari jadwal berdasarkan ID yang dikirim dari tombol
        $schedule = Schedule::find($scheduleId);

        // Buat sesi kelas baru untuk hari ini
        $session = $schedule->classSessions()->create([
            'session_date' => today(),
            'is_open' => true, // Tandai sesi ini sedang dibuka
        ]);

        // Daftarkan semua mahasiswa di jadwal ini ke dalam rekaman absensi
        // dengan status default 'alpa'
        foreach ($schedule->students as $student) {
            $session->attendanceRecords()->create([
                'student_id' => $student->id,
                'status' => 'alpa',
            ]);
        }

        // Kirim notifikasi sukses
        Notification::make()
            ->title('Sesi berhasil dimulai')
            ->body("Sesi untuk kelas {$schedule->class_name} telah dibuka.")
            ->success()
            ->send();

        // Refresh data jadwal di halaman
        $this->refreshSchedules();
    }
}
