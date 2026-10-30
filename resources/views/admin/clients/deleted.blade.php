<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Deleted Clients') }}
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
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('admin.clients.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-md shadow transition">
                    Return to Clients
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
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                            @foreach ($deletedClients as $client)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $client->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('admin.clients.restore', ['id' => $client->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white text-sm font-semibold py-2 px-4 rounded-md shadow transition">Restore</button>
                                        </form>
                                    </td>
                                </tr>
                                
                            @endforeach
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No clients found.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>