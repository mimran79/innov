<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl  text-center text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Name</label>
                            <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" value="{{ $product->name }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Description</label>
                            <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>{{ $product->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="specification" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Specification</label>
                            <textarea name="specification" id="specification" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" required>{{ $product->specification }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Price</label>
                            <input type="number" name="price" id="price" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline" value="{{ $product->price }}" required>
                        </div>
                        <div class="mb-4">
                            @if($product->image)
                                <div class="my-1">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-32 h-auto">
                                </div>
                            @endif
                            <label for="image" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Image</label>
                            <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="is_feature" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Feature Product</label>
                            <input type="checkbox" name="is_feature" id="is_feature" value="1" @checked($product->is_feature)>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Variants (e.g., Color or Size)</label>
                            @foreach ($product->variants as $variant)
                            <input
                                type="text"
                                name="variants[]"
                                value="{{ $variant->variant }}"
                                class="shadow appearance-none border rounded w-full mb-1 py-2 px-3"
                            >
                        @endforeach
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>