<x-app-layout>
    <x-dashboard.sidebar>
        <h1 class="font-bold text-3xl mt-3">Tambah User</h1>

        <div class="bg-white grid grid-cols-1 w-full h-auto mt-5 rounded-md">

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white shadow rounded-md p-5">
                @csrf

                <div class="max-w-sm mt-3">
                    <label for="nama" class="block text-gray-700 font-bold">Nama:</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="max-w-sm mt-3">
                    <label for="nik" class="block text-gray-700 font-bold">NIK:</label>
                    <input type="number" id="nik" name="nik" value="{{ old('nik') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="max-w-sm mt-3">
                    <label for="email" class="block text-gray-700 font-bold">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="max-w-sm mt-3">
                    <label for="no_telp" class="block text-gray-700 font-bold">No Telp:</label>
                    <input type="number" id="no_telp" name="no_telp" value="{{ old('no_telp') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="max-w-sm mt-3">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                        Status</label>
                    <select id="status" name="status" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih Status</option>
                        <option value="active">Active</option>
                        <option value="not_active">Tidak Aktif</option>
                    </select>
                </div>
                <div class="max-w-sm mt-3">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                        role</label>
                    <select id="role" name="role" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="max-w-sm mt-3">
                    <label for="password" class="block text-gray-700 font-bold">Password:</label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm" {{ isset($user) ? '' : 'required' }}>
                    @if ($errors->has('password'))
                        <div class="text-red-500 text-sm mt-2">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="max-w-sm mt-3">
                    <label for="password_confirmation" class="block text-gray-700 font-bold">Password
                        Confirmation:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        value="{{ old('password_confirmation') }}" class="w-full border-gray-300 rounded-md shadow-sm"
                        {{ isset($user) ? '' : 'required' }}>
                    @if ($errors->has('password_confirmation'))
                        <div class="text-red-500 text-sm mt-2">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>

                {{-- submit button --}}
                <div class="flex items-center justify-center mt-5">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kirim</button>
                </div>
            </form>
        </div>
    </x-dashboard.sidebar>
</x-app-layout>
