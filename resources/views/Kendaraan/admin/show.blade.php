<x-app-layout>
    <x-dashboard.sidebar>
        <div class="flex justify-between items-center mt-10">
            <h2 class="font-bold text-2xl">Manajemen Kendaraan</h2>
        </div>

        <hr class="h-[3px] my-8 bg-gray-200 border-0 dark:bg-gray-700 w-full">

        <div class="bg-white grid grid-cols-1 w-full h-auto mt-5 rounded-md p-5">
                <div class="max-w-sm">
                    <label for="nama_kendaraan"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Nama Kendaraan</label>
                    <input type="text" id="nama_kendaraan" name="nama_kendaraan" value="{{ old('nama_kendaraan', $kendaraan->nama_kendaraan) }}" class="rounded"
                        required disabled>
                </div>
                <div class="max-w-sm mt-3">
                    <label for="jenis_kendaraan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Jenis Kendaraan</label>
                    <select id="jenis_kendaraan" name="jenis_kendaraan" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        <option value="" {{ $kendaraan->jenis_kendaraan == null ? 'selected' : '' }} disabled>Pilih Jenis Kendaraan</option>
                        <option value="mobil" {{ $kendaraan->jenis_kendaraan == 'active' ? 'selected' : '' }}>Mobil</option>
                        <option value="motor" {{ $kendaraan->jenis_kendaraan == 'not_active' ? 'selected' : '' }}>Motor</option>
                    </select>
                </div>
                <div class="max-w-sm mt-3">
                    <label for="gambar"
                        class="block mb-2 text-sm font-medium text-slate-400 dark:text-white mt-3">Foto Kendaraan</label>
                        <img src="{{ asset('storage/' . $kendaraan->gambar) }}" alt="Foto Kendaraan" class="w-24 h-auto">
                </div>
                <div class="max-w-sm">
                    <label for="no_polisi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">No Polisi Kendaraan</label>
                    <input type="text" name="no_polisi" value="{{ old('no_polisi', $kendaraan->no_polisi) }}" class="rounded" required disabled>
                </div>
                <div class="max-w-sm">
                    <label for="tahun_kendaraan"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Tahun Kendaraan</label>
                    <input type="text" name="tahun_kendaraan" value="{{ old('tahun_kendaraan', $kendaraan->tahun_kendaraan) }}" class="rounded" required disabled>
                </div>
                <div class="max-w-sm">
                    <label for="harga_sewa"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Harga Sewa
                        Kendaraan</label>
                    <input type="text" name="harga_sewa" value="{{ old('harga_sewa', $kendaraan->harga_sewa) }}" class="rounded"
                        required disabled>
                </div>
                <div class="max-w-sm mt-3">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Status</label>
                    <select id="status" name="status" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                        <option value="" {{ $kendaraan->status == null ? 'selected' : '' }} disabled>Pilih Status</option>
                        <option value="active" {{ $kendaraan->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="not_active" {{ $kendaraan->status == 'not_active' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="disewa" {{ $kendaraan->status == null ? 'disewa' : '' }}>Disewa</option>
                    </select>
                </div>

        </div>
    </x-dashboard.sidebar>
</x-app-layout>
