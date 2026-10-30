<x-general-layout>
    <div class="max-w-7xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Product Image -->
            <div>
                <img src="{{ asset('storage/'. $product->image) }}" alt="{{ $product->name }}" class="w-80 h-auto object-cover rounded-xl shadow-md border border-gray-200 mx-auto my-auto">
            </div>

            <!-- Product Details -->
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{$product->name}}</h1>
                <p class="text-2xl text-indigo-600 font-bold mb-4">€{{$product->price}}</p>
                
                <p class="text-gray-600 mb-6">
                    {{ $product->description }}
                </p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <!-- Options: Color / Size -->
                <div class="mb-6 space-y-4">
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Colors</label>
                        <select name="variant" class="border-gray-300 rounded-md shadow-sm w-full sm:w-64">
                            @foreach ($product->variants as $variant )
                                <option value={{ $variant->id }}>{{$variant->variant}}</option>    
                            @endforeach                            
                        </select>
                    </div>
                </div>

                {{-- Specifications --}}
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Specifications</h3>
                    <p class="text-gray-600">{{$product->specification}}</p>                
                </div>
                @auth
                    @if(auth()->user()->role === 'client')
                        <!-- Add to Cart Button -->
                        <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 shadow-sm transition">
                            Add to Cart
                        </button>  
                    @endif
                @endauth
            </form>
            </div>
        </div>
    </div>
</x-general-layout>