<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Domains</h1>
                <p class="mt-1 text-sm text-gray-600">Manage your reverse proxy domains and routing rules.</p>
            </div>
            <a href="{{ route('domains.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                Add Domain
            </a>
        </div>
    </div>

    <!-- Search -->
    <div class="mb-6">
        <div class="relative">
            <input type="text" 
                   wire:model.live="search" 
                   placeholder="Search domains..."
                   class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Domains Grid -->
    @if($domains->count())
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($domains as $domain)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                    <!-- Header -->
                    <div class="p-6 pb-4">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2">
                                    <h3 class="text-lg font-medium text-gray-900 truncate">
                                        {{ $domain->display_name }}
                                    </h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $domain->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $domain->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <p class="mt-1 text-sm text-gray-600 font-mono">{{ $domain->domain }}</p>
                                @if($domain->description)
                                    <p class="mt-2 text-sm text-gray-500 line-clamp-2">{{ $domain->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="px-6 py-3 border-t border-gray-100">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $domain->routingRules->count() }} routing rules</span>
                            <span>{{ $domain->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="px-6 py-4 bg-gray-50 flex justify-between items-center">
                        <div class="flex space-x-2">
                            <button wire:click="toggleDomain({{ $domain->id }})" 
                                    class="text-sm {{ $domain->is_active ? 'text-red-600 hover:text-red-700' : 'text-green-600 hover:text-green-700' }}">
                                {{ $domain->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                            <button wire:click="deleteDomain({{ $domain->id }})" 
                                    wire:confirm="Are you sure you want to delete this domain?"
                                    class="text-sm text-red-600 hover:text-red-700">
                                Delete
                            </button>
                        </div>
                        <a href="{{ route('domains.show', $domain->id) }}" 
                           class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Manage →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $domains->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9h-9m9 0h9M3 12a9 9 0 019-9"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No domains found</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first domain.</p>
            <a href="{{ route('domains.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                Add Domain
            </a>
        </div>
    @endif
</div>
