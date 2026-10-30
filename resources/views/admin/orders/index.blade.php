<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">            
            <!-- Flash Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <!-- Table Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700">
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Transaction ID</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Order Date</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Total Price</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->transaction_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('d/MM/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">€{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->status }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.order.summary',$order->id) }}" class="bg-blue-700 hover:bg-blue-600 px-2 py-2">View Order</a>
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>