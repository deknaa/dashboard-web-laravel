<x-app-layout>
    <x-dashboard.sidebar>
        <div class="flex justify-between items-center mt-10">
            <h2 class="font-bold text-2xl">Detail Transaksi</h2>
        </div>

        <hr class="h-[3px] my-8 bg-gray-200 border-0 dark:bg-gray-700 w-full">

        <div class="bg-white grid grid-cols-1 w-full h-auto mt-5 rounded-md p-5">
            <div class="grid grid-cols-3">
                <div class="max-w-sm mt-3">
                    <label for="jenis_transaksi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Transaksi</label>
                    <select id="jenis_transaksi" name="jenis_transaksi" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled>
                        <option value="" {{ $transaksi->jenis_transaksi == null ? 'selected' : '' }} disabled>
                            Jenis Transaksi
                        </option>
                        <option value="ruang_kelas"
                            {{ $transaksi->jenis_transaksi == 'ruang_kelas' ? 'selected' : '' }}>Sewa Ruangan</option>
                        <option value="kendaraan" {{ $transaksi->jenis_transaksi == 'kendaraan' ? 'selected' : '' }}>
                            Sewa Kendaraan
                        </option>
                    </select>
                </div>
                <div class="flex gap-5">
                    <div>
                        <label for="waktu_awal"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Waktu Awal</label>
                        <input type="datetime-local" name="waktu_awal" class="rounded"
                            value="{{ $transaksi->waktu_awal }}" disabled>
                        <span class="ms-3">-</span>
                    </div>
                    <div>
                        <label for="waktu_akhir"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Waktu
                            Akhir</label>
                        <input type="datetime-local" name="waktu_akhir" class="rounded"
                            value="{{ $transaksi->waktu_akhir }}" disabled>
                    </div>
                </div>
                <div class="max-w-sm mt-3">
                    <div class="flex gap-2 items-center">
                        <label for="status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            @if ($transaksi->status == 'dalam_proses')
                            <button type="button"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Dalam Proses</button>
                            @elseif($transaksi->status == 'selesai')
                                <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Selesai</button>
                            @elseif($transaksi->status == 'disewa')
                                <button type="button"
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Disewa</button>
                            @else
                            <button type="button"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Ditolak</button>
                            @endif
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-3">
                <div class="max-w-sm mt-3">
                    <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                    @if ($transaksi->jenis_transaksi == 'ruang_kelas')
                        <input type="text" name="product"
                            value="{{ old('product', $transaksi->ruangkelas->nama_ruangan ?? '-') }}" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            disabled>
                    @else
                        <input type="text" name="product"
                            value="{{ old('product', $transaksi->kendaraan->nama_kendaraan ?? '-') }}" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            disabled>
                    @endif
                </div>
                <div class="max-w-sm mt-3">
                    <label for="total_harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Harga</label>
                    <input type="text" id="total_harga" name="total_harga" readonly 
                        class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="Rp {{ number_format($transaksi->total_transaksi, 0, ',', '.') }}">
                </div>
            </div>
            <div class="max-w-sm">
                <label for="bukti_pembayaran"
                    class="block mb-2 text-sm font-medium text-slate-400 dark:text-white mt-3">Upload Bukti
                    Pembayaran/Surat Peminjaman</label>
                @if ($transaksi->bukti_pembayaran)
                    <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                        class="w-24 h-auto">
                @else
                    <p>Bukti pembayaran/Surat belum diunggah.</p>
                @endif
            </div>
            <div>
                <label for="catatan"
                    class="block mb- mt-3 text-sm font-medium text-gray-900 dark:text-white">Catatan</label>
                <textarea id="catatan" rows="10"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    disabled>{{ $transaksi->catatan }}</textarea>
            </div>
        </div>
        <h2 class="font-bold text-2xl mt-3">Proses Transaksi</h2>
        <div class="bg-white grid grid-cols-1 w-full h-auto mt-5 rounded-md p-5">
            <div>
                {{-- form untuk menolak transaksi --}}
                @if ($transaksi->status == 'dalam_proses')
                <form id="rejectForm" action="{{ route('admin.transaction.reject', $transaksi->id) }}" method="POST" onsubmit="return validateRejectForm()">
                    @csrf
                    <small id="error-message" class="text-red-500 hidden">Harap isi alasan penolakan!</small>
                    <textarea id="alasan_tolak" rows="5"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukan Pesan Untuk User" name="alasan_tolak"></textarea>
                    <button type="submit" class="mt-3 bg-red-500 text-white p-2 rounded">Tolak</button>
                </form>

                {{-- form untuk memproses transaksi --}}
                <form action="{{ route('admin.transaction.process', $transaksi->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="mt-3 bg-green-500 text-white p-2 rounded">Proses</button>
                </form>

                @elseif ($transaksi->status == 'disewa')
                {{-- form untuk menyelesaikan transaksi --}}
                <form method="POST" action="{{ route('admin.transaction.finish', $transaksi->id) }}">
                    @csrf
                    @method('PATCH')
                    <textarea id="optional_note" rows="5"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Catatan opsional (tidak wajib diisi)" name="catatan_opsional"></textarea>
                    <button type="submit" class="mt-3 bg-green-500 text-white p-2 rounded">
                        Selesaikan Transaksi
                    </button>
                </form>
                @endif
            </div>
        </div>

        <script>
            function validateRejectForm() {
                const alasanTolak = document.getElementById('alasan_tolak');
                const errorMessage = document.getElementById('error-message');
        
                if (!alasanTolak.value.trim()) {
                    errorMessage.classList.remove('hidden');
                    return false; // Prevent form submission
                }
        
                errorMessage.classList.add('hidden');
                return true; // Allow form submission
            }
        </script>
        
    </x-dashboard.sidebar>
</x-app-layout>
