<x-app-layout>
    <x-dashboard.sidebar>
        <h1 class="font-bold text-3xl mt-3">Tambah Transaksi</h1>

        <div class="bg-white grid grid-cols-1 w-full h-auto mt-5 rounded-md">
            <form class="w-full p-5">
                <div class="max-w-sm">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                        Transaksi</label>
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih Jenis Transaksi</option>
                        <option value="sewa_ruangan">Sewa Ruangan</option>
                        <option value="sewa_kendaraan">Sewa Kendaraan</option>
                    </select>
                </div>
                <div class="max-w-sm">
                    <label for="countries"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Product</label>
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih Jenis Transaksi</option>
                        <option value="sewa_ruangan">Sewa Ruangan</option>
                        <option value="sewa_kendaraan">Sewa Kendaraan</option>
                    </select>
                </div>
                <div class="flex gap-5">
                    <div>
                        <label for="countries"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Waktu Awal</label>
                        <input type="datetime-local" class="rounded">
                        <span class="ms-3">-</span>
                    </div>
                    <div>
                        <label for="countries"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Waktu
                            Akhir</label>
                        <input type="datetime-local" class="rounded">
                    </div>
                </div>
                <div class="max-w-sm">
                    <label for="file_input"
                        class="block mb-2 text-sm font-medium text-slate-400 dark:text-white mt-3">Upload Bukti
                        Pembayaran/Surat Peminjaman</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or PDF
                        (MAX 3MB).</p>
                </div>
                <div>
                    <label for="catatan"
                        class="block mb-2 text-sm font-medium text-slate-400 dark:text-white mt-3">Catatan</label>
                    <textarea id="catatan" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Tuliskan catatan anda..."></textarea>
                </div>
                {{-- submit button --}}
                <div class="flex items-center justify-center mt-5">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kirim</button>
                </div>
            </form>
        </div>

    </x-dashboard.sidebar>
</x-app-layout>
