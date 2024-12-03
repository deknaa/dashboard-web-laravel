<x-app-layout>
    <x-dashboard.sidebar>
        <h1 class="font-bold text-3xl">Dashboard</h1>
        <div class=" w-full mt-5 grid grid-cols-4 gap-4 items-center">
            @for ($i = 0; $i < 2; $i++)
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <div class="flex justify-between gap-8">
                        <h2>{{ $cardTittle[$i] }}</h2>
                        <div class="bg-yellow-300 rounded-2xl w-10 h-10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-4xl mb-7">{{ $totalAndPending[$i] }}</p>
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
                    </tr>
                </thead>
                <tbody>
                    @if ($transactionUser->count() > 0)
                        @foreach ($transactions as $transaction)
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
                                    @if($transaction->jenis_transaksi == 'ruang_kelas')
                                        <p>{{ $transaction->ruangKelas->nama_ruangan ?? '-' }}</p>
                                    @else
                                        <p>{{ $transaction->kendaraan->nama_kendaraan ?? '-' }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($transaction->bukti_pembayaran)
                                        <img src="{{ asset('storage/' . $transaction->bukti_pembayaran) }}"
                                            alt="Bukti Pembayaran" class="w-24 h-auto">
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
                                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Dalam
                                            Proses</button>
                                    @elseif($transaction->status == 'selesai')
                                        <button type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Selesai</button>
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

              {{-- Pagination --}}
              <div class="d-flex justify-content-center">
                {!! $transactions->links() !!}
            </div>
        </div>
    </x-dashboard.sidebar>
</x-app-layout>
