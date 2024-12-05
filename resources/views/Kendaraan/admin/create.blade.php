<x-app-layout>
    <x-dashboard.sidebar>
        <h1 class="font-bold text-3xl mt-3">Tambah Kendaraan</h1>

        <div class="bg-white grid grid-cols-1 w-full h-auto mt-5 rounded-md">

            <form action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-md p-5">
                @csrf

                <div class="max-w-sm mt-3">
                    <label for="nama_kendaraan" class="block text-gray-700 font-bold">Nama Kendaraan:</label>
                    <input type="text" id="nama_kendaraan" name="nama_kendaraan" value="{{ old('nama_kendaraan') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="max-w-sm mt-3">
                    <label for="jenis_kendaraan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Jenis Kendaraan</label>
                    <select id="jenis_kendaraan" name="jenis_kendaraan" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih Jenis Kendaraan</option>
                        <option value="mobil">Mobil</option>
                        <option value="motor">Motor</option>
                    </select>
                </div>

                <div class="max-w-sm mt-3">
                    <label for="gambar"
                        class="block mb-2 text-sm font-medium text-slate-400 dark:text-white mt-3">Upload Foto Kendaraan</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="gambar_help" id="gambar" type="file" name="gambar" accept="image/*" required>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="gambar_help">PNG, JPG
                        (MAX 3MB).</p>
                </div>

                <div class="max-w-sm mt-3">
                    <label for="no_polisi" class="block text-gray-700 font-bold">No Polisi:</label>
                    <input type="text" id="no_polisi" name="no_polisi" value="{{ old('no_polisi') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="max-w-sm mt-3">
                    <label for="tahun_kendaraan" class="block text-gray-700 font-bold">Tahun Kendaraan:</label>
                    <input type="number" id="tahun_kendaraan" name="tahun_kendaraan" value="{{ old('tahun_kendaraan') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="max-w-sm mt-3">
                    <label for="harga_sewa" class="block text-gray-700 font-bold">Harga Sewa:</label>
                    <input type="number" id="harga_sewa" name="harga_sewa" value="{{ old('harga_sewa') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="max-w-sm mt-3">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Status</label>
                    <select id="status" name="status" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option value="" selected disabled>Pilih Status</option>
                        <option value="active">Active</option>
                        <option value="not_active">Tidak Aktif</option>
                        <option value="disewa">Disewa</option>
                    </select>
                </div>

                {{-- submit button --}}
                <div class="flex items-center justify-center mt-5">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kirim</button>
                </div>
            </form>
        </div>
    </x-dashboard.sidebar>
</x-app-layout>
