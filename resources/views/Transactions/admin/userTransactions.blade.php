<x-app-layout>
    <x-dashboard.sidebar>
        <h1 class="font-bold text-3xl">Dashboard</h1>
        <div class="flex justify-between items-center mt-10">
            <h2 class="font-bold text-2xl">Transaksi Terbaru</h2>
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
                            Nama
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
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            AKSI
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
                                    {{ $transaction->user->nama }}
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
                                    @if ($transaction->status == 'dalam_proses')
                                        <button type="button"
                                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Pending</button>
                                    @elseif($transaction->status == 'selesai')
                                        <button type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Selesai</button>
                                    @else
                                        <button type="button"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Ditolak</button>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="grid grid-cols-3 justify-items-center items-center">
                                    <a href="{{ route('transaction.show', $transaction->id) }}"
                                        class="bg-green-500 hover:bg-green-600 text-gray-900 py-1 px-2 rounded"><svg
                                            class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('transaction.edit', $transaction->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 py-1 px-2 rounded"><svg
                                            class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('transaction.destroy', $transaction->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-gray-900 py-1 px-2 rounded"><svg
                                                class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </tr>
                        @endforeach
                    @else
                        <tr class="px-6 py-4">
                            <td>Tidak Ada transaksi Apapun!</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{-- Pagination --}}
            {{-- <div class="d-flex justify-content-center">
                {!! $transactions->links() !!}
            </div> --}}
        </div>
    </x-dashboard.sidebar>
</x-app-layout>