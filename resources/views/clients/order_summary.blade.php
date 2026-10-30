<x-general-layout>
    <div class="max-w-4xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Order Summary</h1>

        <!-- Main Card Container -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            
            <!-- Order Header Info -->
            <div class="p-6 bg-gray-50 border-b border-gray-200 flex flex-wrap justify-between items-center gap-4">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Transaction ID</p>
                    <p class="text-lg font-bold text-gray-800">{{$order->transaction_id}}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Order Date</p>
                    <p class="text-sm text-gray-700">{{$order->created_at->format('d/M/Y')}}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Status</p>
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                        {{ $order->status }}
                    </span>
                </div>

                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Total Amount</p>
                    <p class="text-xl font-extrabold text-blue-600">{{$order->total_amount}}</p>
                </div>
            </div>

            <!-- Order Items Section -->
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Order Items</h2>
                
                <div class="divide-y divide-gray-200">
                    @foreach($order->items as $item)
                        <!-- Order Item Row -->
                        <div class="py-4 flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 font-bold overflow-hidden">
                                    <img src="{{ asset('storage/' . $item->productVariant->product->image) }}" alt="{{ $item->productVariant->product->name }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $item->productVariant->product->name }}</p>
                                    <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <p class="font-bold text-gray-800">{{ $item->price }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-general-layout>