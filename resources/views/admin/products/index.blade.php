<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
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

            <!-- Add Product Button -->
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-md shadow transition">
                    Add a new product
                </a>
                <a href="{{ route('admin.products.deleted') }}" class="bg-red-500 hover:bg-red-700 text-white text-sm font-semibold py-2 px-4 rounded-md shadow transition">
                    View Deleted Products
                </a>
            </div>
            <!-- Table Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700">
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Feature</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                            @foreach ($products as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($product->price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($product->is_feature)
                                            <span class="text-green-600 font-semibold">Yes</span>
                                        @else
                                            <span class="text-red-600 font-semibold">No</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-blue-500 text-sm hover:bg-blue-700 text-white font-bold py-1 px-4">Edit</a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-sm hover:bg-red-700 text-white font-bold py-1 px-4">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                
                            @endforeach
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No products found.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>