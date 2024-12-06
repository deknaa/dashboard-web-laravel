<x-app-layout>
    <x-dashboard.sidebar>
        <div class="flex justify-between items-center mt-10">
            <h2 class="font-bold text-2xl">Buat Transaksi Baru</h2>
        </div>

        <form action="{{ route('admin.transactions.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white w-full h-auto mt-5 rounded-md p-5">
            @csrf

            <!-- Pilih User -->
            <div class="max-w-sm mt-3">
                <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                    Pengguna</label>
                <select id="user_id" name="user_id" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <option value="" disabled selected>Pilih pengguna</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jenis Transaksi -->
            <div class="max-w-sm mt-3">
                <label for="jenis_transaksi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                    Transaksi</label>
                <select id="jenis_transaksi" name="jenis_transaksi" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <option value="" disabled selected>Pilih jenis transaksi</option>
                    <option value="ruang_kelas">Sewa Ruang Kelas</option>
                    <option value="kendaraan">Sewa Kendaraan</option>
                </select>
            </div>

            <!-- Pilih Ruangan atau Kendaraan -->
            <div id="ruangKelasContainer" class="max-w-sm mt-3 hidden">
                <label for="ruang_kelas_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                    Ruang Kelas</label>
                <select id="ruang_kelas_id" name="ruang_kelas_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <option value="" disabled selected>Pilih ruang kelas</option>
                    @foreach ($ruangKelas as $kelas)
                        <option value="{{ $kelas->id }}" data-harga="{{ $kelas->harga_sewa }}">
                            {{ $kelas->nama_ruangan }} - Rp{{ $kelas->harga_sewa }}</option>
                    @endforeach
                </select>
            </div>

            <div id="kendaraanContainer" class="max-w-sm mt-3 hidden">
                <label for="kendaraan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                    Kendaraan</label>
                <select id="kendaraan_id" name="kendaraan_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <option value="" disabled selected>Pilih kendaraan</option>
                    @foreach ($kendaraan as $kendaraanItem)
                        <option value="{{ $kendaraanItem->id }}" data-harga="{{ $kendaraanItem->harga_sewa }}">
                            {{ $kendaraanItem->nama_kendaraan }} - Rp{{ $kendaraanItem->harga_sewa }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Waktu Awal dan Akhir -->
            <div class="flex flex-col md:flex-row gap-5 mt-3">
                <div>
                    <label for="waktu_awal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu
                        Awal</label>
                    <input type="datetime-local" id="waktu_awal" name="waktu_awal" required class="rounded">
                </div>
                <div>
                    <label for="waktu_akhir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu
                        Akhir</label>
                    <input type="datetime-local" id="waktu_akhir" name="waktu_akhir" required class="rounded">
                </div>
            </div>

            <!-- Total Transaksi -->
            <div class="max-w-sm mt-3">
                <label for="total_harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total
                    Harga</label>
                <input type="text" id="total_harga" name="total_harga" readonly
                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <!-- Catatan -->
            <div class="mt-3">
                <label for="catatan"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan</label>
                <textarea id="catatan" name="catatan" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"></textarea>
            </div>

            <!-- Bukti Pembayaran -->
            <div class="mt-3">
                <label for="bukti_pembayaran"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Bukti Pembayaran</label>
                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">
            </div>

            <!-- Submit -->
            <button type="submit" class="mt-5 bg-blue-500 text-white p-3 rounded">Simpan Transaksi</button>
        </form>

        <script>
            document.getElementById('jenis_transaksi').addEventListener('change', function() {
                const jenisTransaksi = this.value;
                const ruangKelasContainer = document.getElementById('ruangKelasContainer');
                const kendaraanContainer = document.getElementById('kendaraanContainer');
                const totalHargaInput = document.getElementById('total_harga');

                // Show the appropriate container based on transaction type
                if (jenisTransaksi === 'ruang_kelas') {
                    ruangKelasContainer.classList.remove('hidden');
                    kendaraanContainer.classList.add('hidden');
                } else if (jenisTransaksi === 'kendaraan') {
                    ruangKelasContainer.classList.add('hidden');
                    kendaraanContainer.classList.remove('hidden');
                }

                // Reset total harga when jenis transaksi changes
                totalHargaInput.value = '';
            });

            document.getElementById('waktu_awal').addEventListener('change', calculateTotal);
            document.getElementById('waktu_akhir').addEventListener('change', calculateTotal);
            document.getElementById('ruang_kelas_id').addEventListener('change', calculateTotal);
            document.getElementById('kendaraan_id').addEventListener('change', calculateTotal);

            function calculateTotal() {
                const waktuAwal = document.getElementById('waktu_awal');
                const waktuAkhir = document.getElementById('waktu_akhir');
                const ruangKelasSelect = document.getElementById('ruang_kelas_id');
                const kendaraanSelect = document.getElementById('kendaraan_id');
                const totalHargaInput = document.getElementById('total_harga');

                const start = new Date(waktuAwal.value);
                const end = new Date(waktuAkhir.value);

                if (start && end && start < end) {
                    const duration = Math.ceil((end - start) / (1000 * 3600 * 24)); // Calculate days difference
                    let pricePerUnit = 0;

                    if (ruangKelasSelect && ruangKelasSelect.value) {
                        const selectedOption = ruangKelasSelect.options[ruangKelasSelect.selectedIndex];
                        pricePerUnit = parseFloat(selectedOption.dataset.harga);
                    } else if (kendaraanSelect && kendaraanSelect.value) {
                        const selectedOption = kendaraanSelect.options[kendaraanSelect.selectedIndex];
                        pricePerUnit = parseFloat(selectedOption.dataset.harga);
                    }

                    if (pricePerUnit) {
                        totalHargaInput.value = 'Rp ' + (duration * pricePerUnit).toLocaleString('id-ID');
                    }
                }
            }
        </script>
    </x-dashboard.sidebar>
</x-app-layout>
