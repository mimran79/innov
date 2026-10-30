<x-general-layout>
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Product Catalog</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Product 1 -->
            @foreach ($products as $product)
             <a href="/catalog/{{ $product->id }}">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                <img src="{{ asset('storage/'. $product->image) }}" alt="{{ $product->name }}" class="w-70 h-50 object-cover rounded-lg mb-4 mx-auto">
                <h3 class="font-semibold text-lg text-gray-800">{{ $product->name }}</h3>
                <p class="text-gray-500 text-sm mb-2">{{ Str::limit($product->description, 45) }}</p>
                <p class="text-indigo-600 font-bold">{{ $product->price }}</p>
            </div>
             </a>   
            @endforeach

        </div>
    </div>
</x-general-layout>