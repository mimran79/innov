<x-general-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Client\'s Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php
    $budget = auth()->user()->budget ?? 500;
    $percentage = $budget > 0 ? min(100, ($totalSpent / $budget) * 100) : 0;
    $isOverBudget = $totalSpent >= ($budget * 0.8);
@endphp

<div class="mb-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
    <div class="flex justify-between mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
        <span>Monthly Spending Goal</span>
        <span>Spent: €{{ $totalSpent }} of €{{ $budget }} ({{ round(($totalSpent / ($budget > 1 ? $budget : 1)) * 100) }}%)</span>
    </div>
    
    <!-- Progress Bar Track -->
    <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700 overflow-hidden">
        <!-- Progress Bar Fill -->
        <div class="h-4 rounded-full transition-all duration-300 {{ $isOverBudget ? 'bg-red-500' : 'bg-blue-600' }}" 
             style="width: {{ $percentage }}%"></div>
    </div>

    @if($totalSpent > $budget)
        <p class="text-xs text-red-500 mt-2 font-semibold">⚠️ You have exceeded your monthly budget!</p>
    @endif
</div>
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="border-b border-gray-200 bg-gray-50 text-xs uppercase text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Transaction ID</th>
                                    <th scope="col" class="px-6 py-3">Date</th>
                                    <th scope="col" class="px-6 py-3">Total Amount</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                               @foreach ($orders as $order)
                               
                                   <tr>
                                    <td class="px-6 py-3">{{$order->transaction_id}}</td>
                                    <td class="px-6 py-3">{{$order->created_at}}</td>
                                    <td class="px-6 py-3">{{$order->total_amount}}</td>
                                    <td class="px-6 py-3">{{$order->status}}</td>
                                    <td class="px-6 py-3">
                                        <a href="{{ route('order.view', $order->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white px-2 py-2">View Order</a>
                                    </td>
                                   </tr>
                               @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-general-layout>
