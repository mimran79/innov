<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Admin Dashboard') }}
        </h2>
        <p class="text-center text-white">{{ date('jS F, Y') }}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Metric Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Total Clients Card -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 text-center">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Clients</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $users }}</p>
                </div>

                <!-- Total Orders Card -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 text-center">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Orders</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $orders }}</p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
