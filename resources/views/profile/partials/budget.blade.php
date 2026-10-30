<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-black">
            {{ __('Set Budget') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-600">
            {{ __('Set your monthly budget to avoid overspending.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.budget') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="budget" :value="__('Set Amount')" class="text-gray-900 dark:text-black"/>
            <x-text-input id="budget" name="budget" type="number" class="mt-1 block w-full" autocomplete="budget" value="{{ $user->budget }}" />
            <x-input-error :messages="$errors->budget->get('budget')" class="mt-2" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
