<x-general-layout>
    <div class="max-w-3xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout</h1>

        <form action="#" method="POST" class="space-y-6">
            @csrf

            <!-- Delivery Address Section -->
            <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Delivery Address</h2>

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:border-indigo-500 focus:ring-indigo-500 p-3" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Delivery Address</label>
                        <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:border-indigo-500 focus:ring-indigo-500 p-3" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="city" value="{{ old('city', $user->city ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:border-indigo-500 focus:ring-indigo-500 p-3" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Postal Code</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-lg focus:border-indigo-500 focus:ring-indigo-500 p-3" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 shadow-md transition">
                Confirm & Proceed to Payment
            </button>
        </form>
    </div>
</x-general-layout>