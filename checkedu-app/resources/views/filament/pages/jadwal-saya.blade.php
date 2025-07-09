<x-filament::page>
    <h1 class="text-xl font-bold mb-4">Jadwal Mengajar Saya</h1>

    @if($this->jadwals->isEmpty())
        <p class="text-gray-500">Tidak ada jadwal ditemukan.</p>
    @else
        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Hari</th>
                    <th class="p-2 border">Jam</th>
                    <th class="p-2 border">Mata Kuliah</th>
                    <th class="p-2 border">Kelas</th>
                    <th class="p-2 border">Ruangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($this->jadwals as $jadwal)
                    <tr class="border-t">
                        <td class="p-2">{{ $jadwal->hari }}</td>
                        <td class="p-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_akhir }}</td>
                        <td class="p-2">{{ $jadwal->mataKuliah->nama ?? '-' }}</td>
                        <td class="p-2">{{ $jadwal->kelas }}</td>
                        <td class="p-2">{{ $jadwal->ruangan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-filament::page>
