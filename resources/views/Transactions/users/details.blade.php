<x-app-layout>
    
    <h1 class="text-2xl font-bold mb-5">Detail Transaksi</h1>

    <div class="bg-white shadow rounded-md p-5">
        <h2 class="text-lg font-semibold mb-3">Informasi Transaksi</h2>
        <p><strong>ID Transaksi:</strong> {{ $transaction->id }}</p>
        <p><strong>Jenis:</strong> 
            @if ($transaction->ruang_kelas_id)
                Sewa Ruang Kelas ({{ $transaction->ruangKelas->nama_ruangan }})
            @elseif ($transaction->kendaraan_id)
                Sewa Kendaraan ({{ $transaction->kendaraan->nama_kendaraan }})
            @endif
        </p>
        <p><strong>Waktu Awal:</strong> {{ $transaction->waktu_awal }}</p>
        <p><strong>Waktu Akhir:</strong> {{ $transaction->waktu_akhir }}</p>
        <p><strong>Catatan:</strong> {{ $transaction->catatan }}</p>

        @if ($transaction->bukti_pembayaran)
            <p><strong>Bukti Pembayaran:</strong></p>
            <img src="{{ asset('storage/' . $transaction->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="w-24 h-auto">
        @endif

        <hr class="my-5">

        <h2 class="text-lg font-semibold mb-3">Balasan Admin</h2>
        @if ($transaction->adminResponse)
            <p>{{ $transaction->adminResponse->message }}</p>
        @else
            <p class="text-gray-500">Belum ada balasan dari admin.</p>
        @endif
    </div>
</x-app-layout>
