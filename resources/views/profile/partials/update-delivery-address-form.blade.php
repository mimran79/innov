<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-dark">
            {{ __('Delivery Address') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-600">
            {{ __("Update your delivery address information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('delivery-address.store') }}" class="mt-6 space-y-6">
        @csrf      

        <div>
            <x-input-label for="address" :value="__('Address')" class="text-gray-900 dark:text-white"/>
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="city" :value="__('City')" class="text-gray-900 dark:text-white"/>
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)" required autofocus autocomplete="city" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div>
            <x-input-label for="postal_code" :value="__('Postal Code')" class="text-gray-900 dark:text-white"/>
            <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code', $user->postal_code)" required autofocus autocomplete="postal_code" />
            <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
        </div>

        <div>            

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
