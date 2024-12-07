<x-app-layout>
    <x-dashboard.sidebar>
        <div class="mt-3">
            <x-alert-information></x-alert-information>
        </div>
        <h1 class="font-bold text-3xl mt-3">Dashboard</h1>
        <div class="w-full mt-5 grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
            @for ($i = 0; $i < count($cardTittle); $i++)
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <div class="flex justify-between gap-5">
                        <h2>{{ $cardTittle[$i] }}</h2>
                        <div class="bg-yellow-300 rounded-2xl w-full h-auto md:w-10 md:h-10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4.5V19a1 1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207"/>
                              </svg>                              
                        </div>
                    </div>
                    <p class="text-4xl mb-7">{{ $cardData[$i] }}</p>
                </div>
            @endfor
        </div>
        <div class="flex justify-between items-center mt-10">
            <h2 class="font-bold text-2xl">Transaksi Terbaru</h2>
            <a href="{{ route('transactions.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Buat
                Transaksi</a>
        </div>
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
                            Bukti Surat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Bukti Pembayaran
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
                        <th scope="col" class="px-6 py-3">
                            OPSI
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
                                        Sewa Ruangan
                                    @else
                                        Sewa Kendaraan
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($transaction->jenis_transaksi == 'ruang_kelas')
                                        <p>{{ $transaction->ruangKelas->nama_ruangan ?? '-' }}</p>
                                    @else
                                        <p>{{ $transaction->kendaraan->nama_kendaraan ?? '-' }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($transaction->bukti_surat)
                                        @php
                                            // Dapatkan ekstensi file
                                            $extension = pathinfo(
                                                storage_path('app/public/' . $transaction->bukti_surat),
                                                PATHINFO_EXTENSION,
                                            );
                                        @endphp

                                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                            {{-- Jika file berupa gambar --}}
                                            <img src="{{ asset('storage/' . $transaction->bukti_surat) }}"
                                                alt="Bukti Pembayaran" class="w-24 h-auto">
                                        @elseif ($extension === 'pdf')
                                            {{-- Jika file berupa PDF --}}
                                            <a href="{{ asset('storage/' . $transaction->bukti_surat) }}"
                                                target="_blank" class="text-blue-500 underline">
                                                Lihat Bukti Pembayaran (PDF)
                                            </a>
                                        @else
                                            <p>Format bukti pembayaran tidak dikenali.</p>
                                        @endif
                                    @else
                                        <p>Bukti Surat belum diunggah.</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($transaction->jenis_transaksi == 'ruang_kelas')
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
                                                <p>Format bukti surat tidak dikenali.</p>
                                            @endif
                                        @else
                                            <p>Bukti pembayaran belum diunggah.</p>
                                        @endif
                                    @else
                                        <p>Tidak Perlu Bukti Pembayaran</p>
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
                                <td class="px-6 py-4">
                                    <a href="{{ route('transactions.details', $transaction) }}">
                                        <div
                                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 flex items-center gap-1">
                                            <svg class="w-6 h-6 text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2"
                                                    d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                <path stroke="currentColor" stroke-width="2"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <span>Lihat Detail</span>
                                        </div>
                                    </a>
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

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {!! $transactions->links() !!}
            </div>
        </div>
    </x-dashboard.sidebar>
</x-app-layout>
