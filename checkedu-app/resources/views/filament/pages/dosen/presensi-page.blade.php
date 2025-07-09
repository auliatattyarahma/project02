<x-filament::page>
    <h1 class="text-xl font-bold mb-4">Presensi Mahasiswa</h1>

    <table class="min-w-full text-sm border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">NIM</th>
                <th class="p-2 border">Hadir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->mahasiswaList as $mahasiswa)
                <tr>
                    <td class="p-2 border">{{ $mahasiswa->nama }}</td>
                    <td class="p-2 border">{{ $mahasiswa->nim }}</td>
                    <td class="p-2 border text-center">
                        <input type="checkbox" name="presensi[{{ $mahasiswa->id }}]" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament::page>
