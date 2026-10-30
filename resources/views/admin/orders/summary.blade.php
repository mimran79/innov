<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Order Summary') }}
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

            <!-- Main Layout Grid (1/3 Left, 2/3 Right) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Left Card: Client & Delivery Info (1/3 Width) -->                
                <div class="space-y-6">

                    <!-- Client & Delivery Info Card -->
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-gray-700 pb-2">Client Details</h3>
                        
                        <div class="space-y-4 text-sm">
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold">Client Name</p>
                                <p class="font-medium text-white">{{ $order->user->name }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold">Email Address</p>
                                <p class="font-medium text-white">{{ $order->user->email }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold">Delivery Address</p>
                                <p class="font-medium text-white">
                                    {{ $order->address ?? 'Not specified' }}<br>
                                    {{ $order->city ?? '' }} {{ $order->postal_code ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Update Card (Admin Only) -->
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-gray-700 pb-2">Update Order Status</h3>
                        
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            <div class="mb-4">
                                <label for="status" class="block text-xs font-semibold text-gray-400 uppercase mb-2">Select Status</label>
                                <select name="status" id="status" class="w-full bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                    <option value="Processing Order" {{ $order->status == 'Processing Order' ? 'selected' : '' }}>Processing Order</option>
                                    <option value="Order Shipped" {{ $order->status == 'Order Shipped' ? 'selected' : '' }}>Order Shipped</option>
                                    <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg text-sm transition-colors duration-200">
                                Update Status
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Right Card Container: Order Summary & Items (2/3 Width) -->
                <div class="md:col-span-2 space-y-6">
                    
                    <div class="bg-gray-800 rounded-lg shadow-md border border-gray-700 overflow-hidden">
                        <!-- Order Header Info -->
                        <div class="p-6 bg-gray-700 border-b border-gray-600 flex flex-wrap justify-between items-center gap-4">
                            <div>
                                <p class="text-xs text-gray-300 uppercase tracking-wide font-semibold">Transaction ID</p>
                                <p class="text-lg font-bold text-white">{{ $order->transaction_id }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-300 uppercase tracking-wide font-semibold">Order Date</p>
                                <p class="text-sm text-white">{{ $order->created_at->format('d/M/Y') }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-300 uppercase tracking-wide font-semibold">Status</p>
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $order->status }}
                                </span>
                            </div>

                            <div>
                                <p class="text-xs text-gray-300 uppercase tracking-wide font-semibold">Total Amount</p>
                                <p class="text-xl font-extrabold text-white">€{{ $order->total_amount }}</p>
                            </div>
                        </div>

                        <!-- Order Items Section -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-4">Order Items</h3>
                            
                            <div class="divide-y divide-gray-700">
                                @foreach($order->items as $item)
                                    <!-- Order Item Row -->
                                    <div class="py-4 flex justify-between items-center">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 bg-gray-700 rounded-lg flex items-center justify-center text-white font-bold overflow-hidden">
                                                <img src="{{ asset('storage/' . $item->productVariant->product->image) }}" alt="{{ $item->productVariant->product->name }}" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-semibold text-white">{{ $item->productVariant->product->name }}</p>
                                            </div>
                                        </div>
                                        <p class="font-bold text-white">€{{ $item->price }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>