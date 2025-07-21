<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-6">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Dashboard</h1>
                        <p class="mt-1 text-sm text-gray-500">Welcome back, {{ auth()->user()->name }}</p>
                    </div>
                    <div class="mt-4 flex md:mt-0 md:ml-4">
                        <button wire:click="showAddDomainModal" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Domain
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @foreach(['total_domains' => ['icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9', 'color' => 'blue', 'label' => 'Total Domains'], 'monthly_requests' => ['icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'color' => 'green', 'label' => 'Monthly Requests'], 'bandwidth_used' => ['icon' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4', 'color' => 'yellow', 'label' => 'Bandwidth Used'], 'uptime' => ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'emerald', 'label' => 'Uptime']] as $key => $stat)
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-{{ $stat['color'] }}-500 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">{{ $stat['label'] }}</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $key === 'monthly_requests' ? number_format($statistics[$key]) : $statistics[$key] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Domains Section -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Your Domains</h3>
                    <button wire:click="showAddDomainModal" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-blue-700 bg-blue-100 hover:bg-blue-200">
                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Domain
                    </button>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($domains as $domain)
                <div class="px-6 py-4 hover:bg-gray-50 cursor-pointer" wire:click="viewDomain('{{ $domain['slug'] }}')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br {{ $domain['color'] }} rounded-lg flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">{{ $domain['initials'] }}</span>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center space-x-2">
                                    <p class="text-sm font-medium text-gray-900">{{ $domain['name'] }}</p>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $domain['status_color'] }}">
                                        <svg class="w-2 h-2 mr-1 fill-current" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                                        {{ $domain['status'] }}
                                    </span>
                                </div>
                                <div class="flex items-center mt-1 space-x-4 text-xs text-gray-500">
                                    <span>{{ $domain['requests'] }} requests/month</span>
                                    <span>•</span>
                                    <span>SSL: {{ $domain['ssl_status'] }}</span>
                                    <span>•</span>
                                    <span>{{ $domain['routes'] }} routes configured</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="text-right">
                                <div class="text-sm text-gray-900">{{ $domain['uptime'] }}</div>
                                <div class="text-xs text-gray-500">Uptime</div>
                            </div>
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No domains</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating your first domain.</p>
                    <div class="mt-6">
                        <button wire:click="showAddDomainModal" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Domain
                        </button>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Add Domain Modal -->
    @if($showModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Domain</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Configure a new domain for your reverse proxy.</p>
                        </div>
                    </div>
                </div>
                <form wire:submit="addDomain" class="mt-5 sm:mt-6">
                    <div class="mb-4">
                        <label for="domain_name" class="block text-sm font-medium text-gray-700">Domain Name</label>
                        <input wire:model="domainName" type="text" id="domain_name" placeholder="api.example.com" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @error('domainName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="backend_url" class="block text-sm font-medium text-gray-700">Backend URL</label>
                        <input wire:model="backendUrl" type="text" id="backend_url" placeholder="https://backend.internal:3000" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @error('backendUrl') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:col-start-2 sm:text-sm">Add Domain</button>
                        <button wire:click="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:col-start-1 sm:text-sm">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>