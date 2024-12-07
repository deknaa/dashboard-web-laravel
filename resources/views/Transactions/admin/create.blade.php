<x-app-layout>
    <x-dashboard.sidebar>
        <div class="mt-3">
            <x-alert-information></x-alert-information>
        </div>
        <h1 class="font-bold text-3xl mt-3">Tambah Transaksi oleh Admin</h1>

        <div class="bg-white p-6 rounded-md">
            <form action="{{ route('admin.transactions.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih User</label>
                    <select id="user_id" name="user_id" required
                        class="w-full mt-1 bg-gray-100 border border-gray-300 rounded-lg p-2">
                        <option value="" selected disabled>Pilih User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="jenis_transaksi" class="block text-sm font-medium text-gray-700">Jenis Transaksi</label>
                    <select id="jenis_transaksi" name="jenis_transaksi" required
                        class="w-full mt-1 bg-gray-100 border border-gray-300 rounded-lg p-2">
                        <option value="" selected disabled>Pilih Jenis Transaksi</option>
                        <option value="ruang_kelas">Sewa Ruangan</option>
                        <option value="kendaraan">Sewa Kendaraan</option>
                    </select>
                </div>

                <div id="ruangKelasSelect" style="display: none;" class="mb-4">
                    <label for="ruang_kelas_id" class="block text-sm font-medium text-gray-700">Pilih Ruang Kelas</label>
                    <select id="ruang_kelas_id" name="ruang_kelas_id"
                        class="w-full mt-1 bg-gray-100 border border-gray-300 rounded-lg p-2">
                        <option value="" disabled selected>Pilih Ruang Kelas</option>
                        @foreach ($ruangKelas as $ruang)
                            <option value="{{ $ruang->id }}">{{ $ruang->nama_ruangan }} - Rp{{ $ruang->harga_sewa }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="kendaraanSelect" style="display: none;" class="mb-4">
                    <label for="kendaraan_id" class="block text-sm font-medium text-gray-700">Pilih Kendaraan</label>
                    <select id="kendaraan_id" name="kendaraan_id"
                        class="w-full mt-1 bg-gray-100 border border-gray-300 rounded-lg p-2">
                        <option value="" disabled selected>Pilih Kendaraan</option>
                        @foreach ($kendaraan as $kend)
                            <option value="{{ $kend->id }}">{{ $kend->nama_kendaraan }} - Rp{{ $kend->harga_sewa }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="waktu_awal" class="block text-sm font-medium text-gray-700">Waktu Awal</label>
                    <input type="datetime-local" id="waktu_awal" name="waktu_awal" required
                        class="w-full mt-1 bg-gray-100 border border-gray-300 rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label for="waktu_akhir" class="block text-sm font-medium text-gray-700">Waktu Akhir</label>
                    <input type="datetime-local" id="waktu_akhir" name="waktu_akhir" required
                        class="w-full mt-1 bg-gray-100 border border-gray-300 rounded-lg p-2">
                </div>

                <div class="max-w-sm mt-3">
                    <label for="bukti_pembayaran" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Bukti Pembayaran</label>
                    <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" required
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                </div>
                

                <div class="mb-4">
                    <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea id="catatan" name="catatan" rows="3"
                        class="w-full mt-1 bg-gray-100 border border-gray-300 rounded-lg p-2"></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Buat Transaksi</button>
            </form>
        </div>
    </x-dashboard.sidebar>
    <script>
        document.getElementById('jenis_transaksi').addEventListener('change', function () {
            const ruangKelasSelect = document.getElementById('ruangKelasSelect');
            const kendaraanSelect = document.getElementById('kendaraanSelect');
            if (this.value === 'ruang_kelas') {
                ruangKelasSelect.style.display = 'block';
                kendaraanSelect.style.display = 'none';
            } else if (this.value === 'kendaraan') {
                ruangKelasSelect.style.display = 'none';
                kendaraanSelect.style.display = 'block';
            } else {
                ruangKelasSelect.style.display = 'none';
                kendaraanSelect.style.display = 'none';
            }
        });
    </script>
    
</x-app-layout>
