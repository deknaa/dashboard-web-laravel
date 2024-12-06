<x-app-layout>
    <x-dashboard.sidebar>
        <div class="flex justify-between items-center mt-10">
            <h2 class="font-bold text-2xl">Transaksi Kamu</h2>
            <a href="{{ route('transactions.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Buat
                Transaksi</a>
        </div>

        <hr class="h-[3px] my-8 bg-gray-200 border-0 dark:bg-gray-700 w-full">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No Transaksi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tipe Transaksi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Item
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Sewa
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Berakhir
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Harga
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($transactionUser->count() > 0)
                        @foreach ($transactionUser as $transaction)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $transaction->id }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($transaction->jenis_transaksi == 'ruang_kelas')
                                        <p>Sewa Ruangan</p>
                                    @else
                                        <p>Sewa Kendaraan</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($transaction->jenis_transaksi == 'ruang_kelas')
                                        <p>{{ $transaction->ruangKelas->nama_ruangan ?? '-' }}</p>
                                    @else
                                        <p>{{ $transaction->kendaraan->nama_kendaraan ?? '-' }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($transaction->bukti_pembayaran)
                                        @php
                                            // Dapatkan ekstensi file
                                            $extension = pathinfo(
                                                storage_path('app/public/' . $transaction->bukti_pembayaran),
                                                PATHINFO_EXTENSION,
                                            );
                                        @endphp

                                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                            {{-- Jika file berupa gambar --}}
                                            <img src="{{ asset('storage/' . $transaction->bukti_pembayaran) }}"
                                                alt="Bukti Pembayaran" class="w-24 h-auto">
                                        @elseif ($extension === 'pdf')
                                            {{-- Jika file berupa PDF --}}
                                            <a href="{{ asset('storage/' . $transaction->bukti_pembayaran) }}"
                                                target="_blank" class="text-blue-500 underline">
                                                Lihat Bukti Pembayaran (PDF)
                                            </a>
                                        @else
                                            <p>Format bukti pembayaran tidak dikenali.</p>
                                        @endif
                                    @else
                                        <p>Bukti pembayaran/Surat belum diunggah.</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->waktu_awal }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->waktu_akhir }}
                                </td>
                                <td class="px-6 py-4">
                                    Rp {{ number_format($transaction->total_transaksi, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($transaction->status == 'dalam_proses')
                                        <button type="button"
                                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Dalam Proses</button>
                                    @elseif($transaction->status == 'selesai')
                                        <button type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Selesai</button>
                                    @elseif($transaction->status == 'disewa')
                                        <button type="button"
                                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Disewa</button>
                                    @else
                                    <button type="button"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Ditolak</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="px-6 py-4">
                            <td>Anda belum melakukan transaksi Apapun!</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-5">
                {{ $transactionUser->links() }}
            </div>
        </div>
    </x-dashboard.sidebar>
</x-app-layout>
