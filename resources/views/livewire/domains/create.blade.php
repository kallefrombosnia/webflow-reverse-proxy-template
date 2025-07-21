<div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('domains.index') }}" 
               class="text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Add New Domain</h1>
                <p class="mt-1 text-sm text-gray-600">Configure a new domain for reverse proxy routing.</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-sm rounded-lg">
        <form wire:submit="save" class="p-6 space-y-6">
            <!-- Domain -->
            <div>
                <label for="domain" class="block text-sm font-medium text-gray-700 mb-2">
                    Domain <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="domain"
                       wire:model="domain" 
                       placeholder="example.com"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('domain') border-red-300 @enderror">
                @error('domain')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">The domain name that will be proxied (without http/https).</p>
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Display Name
                </label>
                <input type="text" 
                       id="name"
                       wire:model="name" 
                       placeholder="My Application"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Optional friendly name for this domain.</p>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea id="description"
                          wire:model="description" 
                          rows="3"
                          placeholder="Brief description of this domain's purpose"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-300 @enderror"></textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- SSL Settings -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">SSL Configuration</h3>
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="ssl_enabled"
                           wire:model="ssl_enabled"
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="ssl_enabled" class="ml-2 block text-sm text-gray-900">
                        Enable SSL/TLS
                    </label>
                </div>
                <p class="mt-2 text-sm text-gray-500">Enable HTTPS for this domain.</p>
            </div>

            <!-- Advanced Settings -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Advanced Settings</h3>
                
                <!-- Timeout -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="timeout" class="block text-sm font-medium text-gray-700 mb-2">
                            Request Timeout (seconds) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="timeout"
                               wire:model="timeout" 
                               min="5"
                               max="300"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('timeout') border-red-300 @enderror">
                        @error('timeout')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Enable Logging -->
                <div class="mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="enable_logging"
                               wire:model="enable_logging"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="enable_logging" class="ml-2 block text-sm text-gray-900">
                            Enable Request Logging
                        </label>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Log all requests for this domain for monitoring and debugging.</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('domains.index') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                    Create Domain
                </button>
            </div>
        </form>
    </div>
</div>
