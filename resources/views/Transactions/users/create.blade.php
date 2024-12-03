<x-app-layout>
    <x-dashboard.sidebar>
        <h1 class="font-bold text-3xl mt-3">Tambah Transaksi</h1>

        <div class="bg-white grid grid-cols-1 w-full h-auto mt-5 rounded-md">
            <form class="w-full p-5" action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="max-w-sm">
                    <label for="jenis_transaksi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                        Transaksi</label>
                    <select id="jenis_transaksi" name="jenis_transaksi" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih Jenis Transaksi</option>
                        <option value="ruang_kelas">Sewa Ruangan</option>
                        <option value="kendaraan">Sewa Kendaraan</option>
                    </select>
                </div>
                
                <div id="ruangKelasSelect" style="display: none;">
                    <label for="ruang_kelas_id">Pilih Ruang Kelas</label>
                    <select name="ruang_kelas_id" id="ruang_kelas_id">
                        <option value="" disabled selected>Pilih Ruang Kelas</option>
                        @foreach ($ruangKelas as $ruang)
                            <option value="{{ $ruang->id }}">{{ $ruang->nama_ruangan }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div id="kendaraanSelect" style="display: none;">
                    <label for="kendaraan_id">Pilih Kendaraan</label>
                    <select name="kendaraan_id" id="kendaraan_id">
                        <option value="" disabled selected>Pilih Kendaraan</option>
                        @foreach ($kendaraan as $kend)
                            <option value="{{ $kend->id }}">{{ $kend->nama_kendaraan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-5">
                    <div>
                        <label for="waktu_awal"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Waktu Awal</label>
                        <input type="datetime-local" name="waktu_awal" class="rounded" required>
                        <span class="ms-3">-</span>
                    </div>
                    <div>
                        <label for="waktu_akhir"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Waktu
                            Akhir</label>
                        <input type="datetime-local" name="waktu_akhir" class="rounded" required>
                    </div>
                </div>
                <div class="max-w-sm">
                    <label for="bukti_pembayaran"
                        class="block mb-2 text-sm font-medium text-slate-400 dark:text-white mt-3">Upload Bukti
                        Pembayaran/Surat Peminjaman</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="bukti_pembayaran_help" id="bukti_pembayaran" type="file" name="bukti_pembayaran" required>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="bukti_pembayaran_help">PNG, JPG or PDF
                        (MAX 3MB).</p>
                </div>
                <div>
                    <label for="catatan"
                        class="block mb-2 text-sm font-medium text-slate-400 dark:text-white mt-3">Catatan</label>
                    <textarea id="catatan" rows="4" name="catatan"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Tuliskan catatan untuk admin..."></textarea>
                </div>
                {{-- submit button --}}
                <div class="flex items-center justify-center mt-5">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kirim</button>
                </div>
            </form>

            <script>
                const jenisTransaksi = document.getElementById('jenis_transaksi');
                const ruangKelasSelect = document.getElementById('ruangKelasSelect');
                const kendaraanSelect = document.getElementById('kendaraanSelect');
            
                jenisTransaksi.addEventListener('change', function () {
                    if (this.value === 'ruang_kelas') {
                        ruangKelasSelect.style.display = 'block';
                        kendaraanSelect.style.display = 'none';
                    } else if (this.value === 'kendaraan') {
                        ruangKelasSelect.style.display = 'none';
                        kendaraanSelect.style.display = 'block';
                    }
                });
            </script>
            
        </div>
    </x-dashboard.sidebar>
</x-app-layout>
