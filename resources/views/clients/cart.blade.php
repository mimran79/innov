<x-general-layout>
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Shopping Cart</h1>
        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded" href="{{ route('cart.reset') }}">Empty Cart</a>
        @if(count($cart) > 0)
            <div class="my-5 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-sm">
                            <th class="py-4 px-6">Product</th>
                            <th class="py-4 px-6">Variant</th>
                            <th class="py-4 px-6">Price</th>
                            <th class="py-4 px-6">Quantity</th>
                            <th class="py-4 px-6">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @php $total = 0; @endphp
                        @foreach($cart as $key => $item)
                            @php 
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td class="py-4 px-6 flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-md border">
                                    <span class="font-semibold text-gray-800">{{ $item['name'] }}</span>
                                </td>
                                <td class="py-4 px-6 text-gray-600">
                                    Variant #{{ $item['variant_id'] }}
                                </td>
                                <td class="py-4 px-6 text-gray-600">€{{ $item['price'] }}</td>
                                <td class="py-4 px-6 text-gray-600">{{ $item['quantity'] }}</td>
                                <td class="py-4 px-6 font-semibold text-gray-800">€{{ $subtotal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cart Summary & Pay Now Button -->
            <div class="flex justify-between items-center bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div>
                    <span class="text-lg text-gray-600 font-medium">Total Amount:</span>
                    <span class="text-2xl font-bold text-gray-900 ml-2">€{{ $total }}</span>
                </div>

                <a href="{{ route('cart.checkout') }}" class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 shadow-sm transition">
                    Pay Now (€{{ $total }})
                </a>
            </div>
        @else
            <div class="my-5 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-gray-600">Your cart is currently empty.</p>
            </div>
        @endif
    </div>
</x-general-layout>