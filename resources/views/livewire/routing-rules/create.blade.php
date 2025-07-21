<div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('domains.show', $domain->id) }}" 
               class="text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Add Routing Rule</h1>
                <p class="mt-1 text-sm text-gray-600">Create a new routing rule for <span class="font-mono">{{ $domain->domain }}</span></p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-sm rounded-lg">
        <form wire:submit="save" class="p-6 space-y-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Rule Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="name"
                       wire:model="name" 
                       placeholder="API Proxy Rule"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea id="description"
                          wire:model="description" 
                          rows="2"
                          placeholder="Brief description of this routing rule"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-300 @enderror"></textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Path Pattern -->
            <div>
                <label for="path_pattern" class="block text-sm font-medium text-gray-700 mb-2">
                    Path Pattern <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="path_pattern"
                       wire:model="path_pattern" 
                       placeholder="/api/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('path_pattern') border-red-300 @enderror">
                @error('path_pattern')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Use * for wildcards. Examples: /api/*, /users/*/profile, /static/*</p>
            </div>

            <!-- Target URL -->
            <div>
                <label for="target_url" class="block text-sm font-medium text-gray-700 mb-2">
                    Target URL <span class="text-red-500">*</span>
                </label>
                <input type="url" 
                       id="target_url"
                       wire:model="target_url" 
                       placeholder="https://backend.example.com"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('target_url') border-red-300 @enderror">
                @error('target_url')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">The backend server URL where requests will be forwarded.</p>
            </div>

            <!-- HTTP Method & Priority -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="method" class="block text-sm font-medium text-gray-700 mb-2">
                        HTTP Method <span class="text-red-500">*</span>
                    </label>
                    <select id="method"
                            wire:model="method" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('method') border-red-300 @enderror">
                        <option value="*">All Methods</option>
                        <option value="GET">GET</option>
                        <option value="POST">POST</option>
                        <option value="PUT">PUT</option>
                        <option value="DELETE">DELETE</option>
                        <option value="PATCH">PATCH</option>
                        <option value="HEAD">HEAD</option>
                        <option value="OPTIONS">OPTIONS</option>
                    </select>
                    @error('method')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                        Priority <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="priority"
                           wire:model="priority" 
                           min="0"
                           max="1000"
                           placeholder="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('priority') border-red-300 @enderror">
                    @error('priority')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Higher numbers = higher priority</p>
                </div>
            </div>

            <!-- Advanced Settings -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Advanced Settings</h3>
                
                <!-- Load Balancing & Preserve Host -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="load_balancing" class="block text-sm font-medium text-gray-700 mb-2">
                            Load Balancing <span class="text-red-500">*</span>
                        </label>
                        <select id="load_balancing"
                                wire:model="load_balancing" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('load_balancing') border-red-300 @enderror">
                            <option value="round_robin">Round Robin</option>
                            <option value="least_connections">Least Connections</option>
                            <option value="ip_hash">IP Hash</option>
                        </select>
                        @error('load_balancing')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="timeout" class="block text-sm font-medium text-gray-700 mb-2">
                            Timeout (seconds)
                        </label>
                        <input type="number" 
                               id="timeout"
                               wire:model="timeout" 
                               min="5"
                               max="300"
                               placeholder="Use domain default"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('timeout') border-red-300 @enderror">
                        @error('timeout')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Override domain timeout</p>
                    </div>
                </div>

                <!-- Preserve Host -->
                <div class="mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="preserve_host"
                               wire:model="preserve_host"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="preserve_host" class="ml-2 block text-sm text-gray-900">
                            Preserve Original Host Header
                        </label>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Forward the original Host header to the backend server.</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('domains.show', $domain->id) }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                    Create Rule
                </button>
            </div>
        </form>
    </div>
</div>
