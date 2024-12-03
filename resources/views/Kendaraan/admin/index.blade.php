<x-app-layout>
    <x-dashboard.sidebar>
        <div class="flex justify-between items-center mt-10">
            <h2 class="font-bold text-2xl">Manajemen kendaraan</h2>
            <a href="{{ route('ruangkelas.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah
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
                            ID Kendaraan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Kendaraan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Gambar
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No Polisi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tahun Kendaraan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga Sewa
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
                    @if ($kendaraan->count() > 0)
                        @foreach ($kendaraan as $kendaraan)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $kendaraan->id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $kendaraan->nama_kendaraan }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($kendaraan->gambar)
                                        <img src="{{ asset('storage/' . $kendaraan->gambar) }}"
                                            alt="Foto kendaraan" class="w-24 h-auto">
                                    @else
                                        <p>Foto kendaraan Tidak Ada/Belum di Unggah</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $kendaraan->no_polisi }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $kendaraan->tahun_kendaraan }}
                                </td>
                                <td class="px-6 py-4">
                                    Rp. {{ $kendaraan->harga_sewa }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($kendaraan->status == 'active')
                                        <button type="button"
                                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Active</button>
                                    @elseif($kendaraan->status == 'not_active')
                                        <button type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tidak Aktif</button>
                                    @else
                                        <button type="button"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Disewa</button>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('kendaraan.show', $kendaraan->id) }}"
                                        class="bg-green-500 hover:bg-green-600 text-gray-900 py-1 px-2 rounded">Lihat</a>
                                    <a href="{{ route('kendaraan.edit', $kendaraan->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 py-1 px-2 rounded">Edit</a>
                                    <form action="{{ route('kendaraan.destroy', $kendaraan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-gray-900 py-1 px-2 rounded">Hapus</button>
                                    </form>
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
