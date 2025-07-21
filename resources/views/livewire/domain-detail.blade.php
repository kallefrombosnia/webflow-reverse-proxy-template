<div class="min-h-screen bg-gray-50">
    <!-- Header with breadcrumb -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-6">
                <!-- Breadcrumb -->
                <nav class="flex mb-4" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <button wire:click="goToDashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>Dashboard
                            </button>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $domainData['name'] }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <!-- Domain Header -->
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br {{ $domainData['color'] }} rounded-lg flex items-center justify-center mr-4">
                                <span class="text-white font-semibold text-lg">{{ $domainData['initials'] }}</span>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">{{ $domainData['name'] }}</h1>
                                <div class="flex items-center mt-1 space-x-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $domainData['status_color'] }}">
                                        <svg class="w-2 h-2 mr-1 fill-current" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>{{ $domainData['status'] }}
                                    </span>
                                    <span class="text-sm text-gray-500">SSL Certificate Valid</span>
                                    <span class="text-sm text-gray-500">•</span>
                                    <span class="text-sm text-gray-500">Last updated {{ $domainData['last_updated'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex space-x-3 md:mt-0 md:ml-4">
                        <button wire:click="showSettings" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Settings</button>
                        <button wire:click="showAddRouteModal" type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">Add Route</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics & Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-8">
            @foreach(['requests_today', 'avg_response', 'error_rate', 'bandwidth', 'uptime'] as $stat)
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">{{ ucwords(str_replace('_', ' ', $stat)) }}</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $statistics[$stat] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tabbed Interface -->
        <div class="bg-white shadow rounded-lg">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                    @foreach(['routing' => 'Routing', 'pwa' => 'PWA Settings', 'files' => 'File Manager', 'analytics' => 'Analytics'] as $tab => $label)
                    <button wire:click="setActiveTab('{{ $tab }}')" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === $tab ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">{{ $label }}</button>
                    @endforeach
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                @if($activeTab === 'routing')
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Route Configuration</h3>
                        <button wire:click="showAddRouteModal" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-blue-700 bg-blue-100 hover:bg-blue-200">Add Route</button>
                    </div>
                    <div class="space-y-4">
                        @forelse($routes as $index => $route)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $route['method_color'] }}">{{ $route['method'] }}</span>
                                        <code class="text-sm font-mono text-gray-900">{{ $route['path'] }}</code>
                                        <span class="text-sm text-gray-500">→</span>
                                        <span class="text-sm text-gray-600">{{ $route['backend'] }}</span>
                                    </div>
                                    <div class="mt-2 flex items-center space-x-4 text-xs text-gray-500">
                                        <span>Load Balancing: {{ $route['load_balancing'] }}</span>
                                        <span>•</span>
                                        <span>Health Check: {{ $route['health_check'] }}</span>
                                        <span>•</span>
                                        <span>{{ $route['requests_today'] }} requests today</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button wire:click="editRoute({{ $index }})" class="text-gray-400 hover:text-gray-600">Edit</button>
                                    <button wire:click="deleteRoute({{ $index }})" class="text-gray-400 hover:text-red-600">Delete</button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No routes configured</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by adding your first route.</p>
                            <button wire:click="showAddRouteModal" class="mt-6 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Add Route</button>
                        </div>
                        @endforelse
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-6 text-center">
                        <h3 class="mt-2 text-sm font-medium text-gray-900">{{ ucwords(str_replace('-', ' ', $activeTab)) }}</h3>
                        <p class="mt-1 text-sm text-gray-500">This feature is coming soon.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add Route Modal -->
    @if($showRouteModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeRouteModal"></div>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Route</h3>
                    <p class="text-sm text-gray-500">Configure a new route for {{ $domainData['name'] }}.</p>
                </div>
                <form wire:submit="addRoute" class="mt-5 sm:mt-6 space-y-4">
                    <div>
                        <label for="route_method" class="block text-sm font-medium text-gray-700">HTTP Method</label>
                        <select wire:model="routeMethod" id="route_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="GET">GET</option>
                            <option value="POST">POST</option>
                            <option value="*">All Methods</option>
                        </select>
                    </div>
                    <div>
                        <label for="route_path" class="block text-sm font-medium text-gray-700">Path</label>
                        <input wire:model="routePath" type="text" id="route_path" placeholder="/api/v1/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @error('routePath') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="route_backend" class="block text-sm font-medium text-gray-700">Backend URL</label>
                        <input wire:model="routeBackend" type="text" id="route_backend" placeholder="https://backend.internal:3000" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @error('routeBackend') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:col-start-2 sm:text-sm">Add Route</button>
                        <button wire:click="closeRouteModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:col-start-1 sm:text-sm">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>