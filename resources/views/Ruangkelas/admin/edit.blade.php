<x-app-layout>
    <x-dashboard.sidebar>
        <div class="flex justify-between items-center mt-10">
            <h2 class="font-bold text-2xl">Manajemen Ruangan</h2>
        </div>

        <hr class="h-[3px] my-8 bg-gray-200 border-0 dark:bg-gray-700 w-full">

        <div class="bg-white grid grid-cols-1 w-full h-auto mt-5 rounded-md p-5">
            <form action="{{ route('ruangkelas.update', $ruangkelas->id) }}" method="POST" enctype="multipart/form-data"
                class="bg-white shadow rounded-md p-5">
                @csrf
                @method('PUT')

                <div class="max-w-sm">
                    <label for="nama_ruangan"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Nama Ruangan</label>
                    <input type="text" id="nama_ruangan" name="nama_ruangan" value="{{ old('nama_ruangan', $ruangkelas->nama_ruangan) }}" class="rounded"
                        required>
                </div>
                <div class="max-w-sm mt-3">
                    <label for="gambar"
                        class="block mb-2 text-sm font-medium text-slate-400 dark:text-white mt-3">Foto Ruangan</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="gambar_help" id="gambar" type="file" name="gambar" accept="image/*">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="gambar_help">PNG, JPG
                        (MAX 3MB).</p>
                </div>
                <img src="{{ asset('storage/' . $ruangkelas->gambar) }}" alt="Foto Ruangan" class="w-24 h-auto">
                <div class="max-w-sm">
                    <label for="lokasi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Lokasi Ruangan</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $ruangkelas->lokasi) }}" class="rounded" required>
                </div>
                <div class="max-w-sm">
                    <label for="harga_sewa"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Harga Sewa
                        Ruangan</label>
                    <input type="text" name="harga_sewa" value="{{ old('harga_sewa', $ruangkelas->harga_sewa) }}" class="rounded"
                        required>
                </div>
                <div class="max-w-sm mt-3">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Status</label>
                    <select id="status" name="status" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" {{ $ruangkelas->status == null ? 'selected' : '' }} disabled>Pilih Status</option>
                        <option value="active" {{ $ruangkelas->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="not_active" {{ $ruangkelas->status == 'not_active' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="disewa" {{ $ruangkelas->status == null ? 'disewa' : '' }}>Disewa</option>
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
