<x-app-layout>
    <x-dashboard.sidebar>
        <h1 class="font-bold text-3xl">Dashboard</h1>
        <div class=" w-full mt-5 grid grid-cols-4 gap-4 items-center">
            @for ($i = 0; $i < 4; $i++)    
            <div class="bg-white rounded-lg shadow-lg p-4">
                <div class="flex justify-between gap-8">
                    <h2>Transaksi Pending</h2>
                    <div class="bg-yellow-300 rounded-2xl w-10 h-10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2"/>
                          </svg>                      
                    </div>
                </div>
                <p class="text-4xl mb-7">2</p>
            </div>
            @endfor
        </div>
    </x-dashboard.sidebar>
</x-app-layout>
