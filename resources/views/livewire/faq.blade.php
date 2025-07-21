<div>
    <!-- Header -->
    <section class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl lg:text-6xl">
                    Frequently Asked Questions
                </h1>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                    Everything you need to know about our reverse proxy service. Can't find what you're looking for? Contact our support team.
                </p>
            </div>

            <!-- Search -->
            <div class="mt-12 max-w-xl mx-auto">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input 
                        wire:model.live="search" 
                        type="search" 
                        placeholder="Search FAQs..." 
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Categories -->
    <section class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <!-- Category Filter -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button 
                    wire:click="$set('selectedCategory', 'all')" 
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $selectedCategory === 'all' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    All Questions
                </button>
                <button 
                    wire:click="$set('selectedCategory', 'getting-started')" 
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $selectedCategory === 'getting-started' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    Getting Started
                </button>
                <button 
                    wire:click="$set('selectedCategory', 'pricing')" 
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $selectedCategory === 'pricing' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    Pricing & Billing
                </button>
                <button 
                    wire:click="$set('selectedCategory', 'technical')" 
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $selectedCategory === 'technical' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    Technical
                </button>
                <button 
                    wire:click="$set('selectedCategory', 'support')" 
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $selectedCategory === 'support' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    Support
                </button>
            </div>

            <!-- FAQ Items -->
            <div class="max-w-4xl mx-auto">
                @if(count($this->filteredFaqs) > 0)
                    <div class="space-y-4">
                        @foreach($this->filteredFaqs as $index => $faq)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <button 
                                wire:click="toggleFaq({{ $index }})" 
                                class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors">
                                <span class="text-lg font-medium text-gray-900">{{ $faq['question'] }}</span>
                                <svg class="h-5 w-5 text-gray-500 transform transition-transform {{ in_array($index, $openFaqs) ? 'rotate-180' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            @if(in_array($index, $openFaqs))
                            <div class="px-6 pb-4">
                                <div class="text-gray-600 leading-relaxed">
                                    {!! nl2br(e($faq['answer'])) !!}
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No FAQs found</h3>
                        <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Contact Support -->
    <section class="bg-blue-600">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Still have questions?
                </h2>
                <p class="mt-4 text-xl text-blue-200">
                    Our support team is here to help you get the most out of our platform.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Email Support
                    </a>
                    <a href="#" class="inline-flex items-center justify-center px-6 py-3 border border-white text-base font-medium rounded-md text-white hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Live Chat
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>