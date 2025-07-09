<x-filament-panels::page>
    {{-- Ini adalah komponen utama halaman dari Filament --}}

    <div class="space-y-4">
        {{-- Cek apakah dosen punya jadwal atau tidak --}}
        @if($schedules->isEmpty())
            <div class="p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800">
                <p>Anda tidak memiliki jadwal mengajar saat ini.</p>
            </div>
        @else
            {{-- Jika ada, tampilkan setiap jadwal dalam sebuah kartu --}}
            @foreach ($schedules as $schedule)
                @php
                    // Cek apakah sudah ada sesi untuk jadwal ini hari ini
                    $todaySession = $schedule->classSessions->first();
                @endphp
                <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $schedule->course->name }} - {{ $schedule->class_name }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{-- Mengubah nama hari menjadi format Indonesia --}}
                            @php
                                $hari = [
                                    'monday' => 'Senin', 'tuesday' => 'Selasa', 'wednesday' => 'Rabu',
                                    'thursday' => 'Kamis', 'friday' => 'Jumat', 'saturday' => 'Sabtu',
                                ];
                            @endphp
                            {{ $hari[$schedule->day_of_week] ?? $schedule->day_of_week }}, Pukul {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                        </p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        {{-- Tampilkan tombol yang berbeda tergantung kondisi --}}
                        @if($todaySession)
                            {{-- Jika sesi sudah dibuat, tampilkan tombol untuk melihat presensi --}}
                            <x-filament::button color="success" tag="a" href="{{ route('filament.admin.pages.presensi') }}">
                                Lihat Presensi
                            </x-filament::button>
                        @else
                            {{-- Jika sesi belum dibuat, tampilkan tombol untuk memulai sesi --}}
                            <x-filament::button wire:click="startSession({{ $schedule->id }})">
                                Mulai Sesi
                            </x-filament::button>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-filament-panels::page>

