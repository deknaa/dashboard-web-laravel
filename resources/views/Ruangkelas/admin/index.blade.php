<x-app-layout>
    <x-dashboard.sidebar>
        <x-alert-information></x-alert-information>
        <div class="grid grid-cols-2 justify-between items-center mt-10">
            <h2 class="font-bold text-2xl">Manajemen Ruangan</h2>
            <a href="{{ route('ruangkelas.create') }}"
                class="text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-1 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah
                Ruangan</a>
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
                            ID Ruangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Ruangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Gambar
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lokasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga Sewa
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Update
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($ruangkelas->count() > 0)
                        @foreach ($ruangkelas as $ruangan)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $ruangan->id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $ruangan->nama_ruangan }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($ruangan->gambar)
                                        <img src="{{ asset('storage/' . $ruangan->gambar) }}"
                                            alt="Foto Ruangan" class="w-24 h-auto">
                                    @else
                                        <p>Foto Ruangan Tidak Ada/Belum di Unggah</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $ruangan->lokasi }}
                                </td>
                                <td class="px-6 py-4">
                                    Rp. {{ $ruangan->harga_sewa }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $ruangan->updated_at }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($ruangan->status == 'active')
                                        <button type="button"
                                            class="flex items-center justify-center focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Active</button>
                                    @elseif($ruangan->status == 'not_active')
                                        <button type="button"
                                            class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tidak Aktif</button>
                                    @else
                                        <button type="button"
                                            class="flex items-center justify-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Disewa</button>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                                    <a href="{{ route('ruangkelas.show', $ruangan->id) }}"
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
                                    <a href="{{ route('ruangkelas.edit', $ruangan->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 py-1 px-2 rounded"><svg
                                            class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('ruangkelas.destroy', $ruangan->id) }}" method="POST">
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
            {{-- <div class="mt-5">
                {{ $ruangkelas->links() }}
            </div> --}}
        </div>
    </x-dashboard.sidebar>
</x-app-layout>
