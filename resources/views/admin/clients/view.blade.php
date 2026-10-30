<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Client Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.clients.delete', ['id' => $client->id]) }}" onsubmit="return confirm('Are you sure you want to delete this client?');" class="mb-6">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Delete User Account Client
                </button>
            </form>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg lg:col-span-1">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">{{ $client->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-400"><span class="text-white font-bold">Email:</span> {{ $client->email ?? 'Not provided' }}</p>
                        <p class="text-gray-600 dark:text-gray-400"><span class="text-white font-bold">Address:</span> {{ $client->address ?? 'Not provided' }}</p>
                        <p class="text-gray-600 dark:text-gray-400"><span class="text-white font-bold">City:</span> {{ $client->city ?? 'Not provided' }}, {{ $client->postal_code ?? 'Not provided'}}</p>
                        <p class="text-gray-600 dark:text-gray-400"><span class="text-white font-bold">Monthly Budget:</span> €{{ $client->budget ?? 'Not provided'}}</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg lg:col-span-2">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Order Details</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="border-b border-gray-200 bg-gray-50 text-xs uppercase text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Transaction ID</th>
                                        <th scope="col" class="px-6 py-3">Date</th>
                                        <th scope="col" class="px-6 py-3">Total Amount</th>
                                        <th scope="col" class="px-6 py-3">Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="px-6 py-3">{{ $order->transaction_id }}</td>
                                            <td class="px-6 py-3">{{ $order->created_at }}</td>
                                            <td class="px-6 py-3">{{ $order->total_amount }}</td>
                                            <td class="px-6 py-3">{{ $order->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>