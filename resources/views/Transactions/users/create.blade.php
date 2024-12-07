<x-app-layout>
    <x-dashboard.sidebar>
        <h1 class="font-bold text-3xl mt-3">Tambah Transaksi</h1>

        <div class="bg-white grid grid-cols-1 w-full h-auto mt-5 rounded-md">
            <form id="transactionForm" class="w-full p-5" action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="max-w-sm">
                    <label for="jenis_transaksi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Transaksi</label>
                    <select id="jenis_transaksi" name="jenis_transaksi" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih Jenis Transaksi</option>
                        <option value="ruang_kelas">Sewa Ruangan</option>
                        <option value="kendaraan">Sewa Kendaraan</option>
                    </select>
                </div>

                <div id="ruangKelasSelect" style="display: none;" class="max-w-sm mt-3">
                    <label for="ruang_kelas_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Ruang Kelas</label>
                    <select name="ruang_kelas_id" id="ruang_kelas_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled selected>Pilih Ruang Kelas</option>
                        @foreach ($ruangKelas as $ruang)
                            <option value="{{ $ruang->id }}" data-harga="{{ $ruang->harga_sewa }}">{{ $ruang->nama_ruangan }} - Rp{{ $ruang->harga_sewa }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="kendaraanSelect" style="display: none;" class="max-w-sm mt-3">
                    <label for="kendaraan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Kendaraan</label>
                    <select name="kendaraan_id" id="kendaraan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled selected>Pilih Kendaraan</option>
                        @foreach ($kendaraan as $kend)
                            <option value="{{ $kend->id }}" data-harga="{{ $kend->harga_sewa }}">{{ $kend->nama_kendaraan }} - Rp{{ $kend->harga_sewa }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col md:flex-row gap-5 mt-3">
                    <div>
                        <label for="waktu_awal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Awal</label>
                        <input type="datetime-local" id="waktu_awal" name="waktu_awal" class="rounded w-full" required>
                    </div>
                    <div>
                        <label for="waktu_akhir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Akhir</label>
                        <input type="datetime-local" id="waktu_akhir" name="waktu_akhir" class="rounded w-full" required>
                    </div>
                </div>

                <div class="max-w-sm mt-3">
                    <label for="total_harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Harga</label>
                    <input type="text" id="total_harga" name="total_harga" readonly 
                        class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div class="max-w-sm mt-3">
                    <label for="bukti_pembayaran" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Bukti Pembayaran</label>
                    <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" required 
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                </div>

                <div class="max-w-sm mt-3">
                    <label for="catatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan</label>
                    <textarea id="catatan" rows="4" name="catatan" 
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                </div>

                <div class="flex items-center justify-center mt-5">
                    <button type="submit" onclick="return confirm('Apakah anda yakin membuat transaksi ini?')" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-10 py-2.5">Kirim</button>
                </div>
            </form>
        </div>

        <script>
            const jenisTransaksi = document.getElementById('jenis_transaksi');
            const ruangKelasSelect = document.getElementById('ruangKelasSelect');
            const kendaraanSelect = document.getElementById('kendaraanSelect');
            const waktuAwal = document.getElementById('waktu_awal');
            const waktuAkhir = document.getElementById('waktu_akhir');
            const totalHargaInput = document.getElementById('total_harga');

            jenisTransaksi.addEventListener('change', function () {
                if (this.value === 'ruang_kelas') {
                    ruangKelasSelect.style.display = 'block';
                    kendaraanSelect.style.display = 'none';
                } else if (this.value === 'kendaraan') {
                    ruangKelasSelect.style.display = 'none';
                    kendaraanSelect.style.display = 'block';
                }
                totalHargaInput.value = ''; // Reset total harga saat jenis transaksi berubah
            });

            function calculateTotalHarga() {
                const waktuAwalVal = new Date(waktuAwal.value);
                const waktuAkhirVal = new Date(waktuAkhir.value);
                if (isNaN(waktuAwalVal) || isNaN(waktuAkhirVal) || waktuAwalVal >= waktuAkhirVal) {
                    totalHargaInput.value = '';
                    return;
                }

                const durasi = Math.ceil((waktuAkhirVal - waktuAwalVal) / (1000 * 60 * 60 * 24)); // Dalam hari
                const selectedOption = document.querySelector(
                    jenisTransaksi.value === 'ruang_kelas' 
                        ? '#ruang_kelas_id option:checked' 
                        : '#kendaraan_id option:checked'
                );
                const hargaSewa = selectedOption ? parseFloat(selectedOption.dataset.harga) : 0;

                totalHargaInput.value = `Rp ${new Intl.NumberFormat('id-ID').format(durasi * hargaSewa)}`;
            }

            waktuAwal.addEventListener('change', calculateTotalHarga);
            waktuAkhir.addEventListener('change', calculateTotalHarga);
            document.getElementById('ruang_kelas_id')?.addEventListener('change', calculateTotalHarga);
            document.getElementById('kendaraan_id')?.addEventListener('change', calculateTotalHarga);

            function confirmSubmit() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Pastikan semua data sudah benar sebelum mengirim!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Kirim!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('transactionForm').submit();
                    }
                });
            }
        </script>
    </x-dashboard.sidebar>
</x-app-layout>
