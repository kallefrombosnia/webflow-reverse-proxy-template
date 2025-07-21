<div>
    <!-- Header -->
    <section class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl lg:text-6xl">
                    Simple, transparent pricing
                </h1>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                    Choose the plan that fits your needs. All plans include our core features with no hidden fees.
                </p>
            </div>

            <!-- Toggle -->
            <div class="mt-12 flex justify-center">
                <div class="relative bg-gray-100 rounded-lg p-1 flex">
                    <button 
                        wire:click="$set('billing', 'monthly')" 
                        class="relative w-24 rounded-md py-2 text-sm font-medium text-gray-700 transition-all focus:outline-none focus:z-10 {{ $billing === 'monthly' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-500' }}">
                        Monthly
                    </button>
                    <button 
                        wire:click="$set('billing', 'yearly')" 
                        class="ml-0.5 relative w-24 rounded-md py-2 text-sm font-medium text-gray-700 transition-all focus:outline-none focus:z-10 {{ $billing === 'yearly' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-500' }}">
                        Yearly
                        <span class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs px-1.5 py-0.5 rounded-full">
                            -20%
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="bg-gray-50 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                
                <!-- Starter Plan -->
                <div class="bg-white rounded-2xl shadow-lg">
                    <div class="p-8">
                        <h3 class="text-2xl font-semibold text-gray-900">Starter</h3>
                        <p class="mt-4 text-gray-600">Perfect for small projects and personal use</p>
                        <div class="mt-8">
                            <div class="flex items-baseline">
                                <span class="text-5xl font-extrabold text-gray-900">
                                    ${{ $billing === 'monthly' ? '9' : '7' }}
                                </span>
                                <span class="ml-1 text-xl font-semibold text-gray-500">/month</span>
                            </div>
                            @if($billing === 'yearly')
                                <p class="text-sm text-gray-500 mt-1">Billed annually ($84/year)</p>
                            @endif
                        </div>
                        <ul class="mt-8 space-y-3">
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">Email support</span>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="{{ route('register') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-6 rounded-lg font-medium transition-colors">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pro Plan -->
                <div class="bg-white rounded-2xl shadow-lg border-2 border-blue-500 relative">
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <span class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-medium">Most Popular</span>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-semibold text-gray-900">Pro</h3>
                        <p class="mt-4 text-gray-600">Great for growing businesses and teams</p>
                        <div class="mt-8">
                            <div class="flex items-baseline">
                                <span class="text-5xl font-extrabold text-gray-900">
                                    ${{ $billing === 'monthly' ? '29' : '23' }}
                                </span>
                                <span class="ml-1 text-xl font-semibold text-gray-500">/month</span>
                            </div>
                            @if($billing === 'yearly')
                                <p class="text-sm text-gray-500 mt-1">Billed annually ($276/year)</p>
                            @endif
                        </div>
                        <ul class="mt-8 space-y-3">
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">Up to 25 domains</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">100GB bandwidth</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">SSL certificates</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">Advanced analytics</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">Load balancing</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">Priority support</span>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="{{ route('register') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-6 rounded-lg font-medium transition-colors">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Enterprise Plan -->
                <div class="bg-white rounded-2xl shadow-lg">
                    <div class="p-8">
                        <h3 class="text-2xl font-semibold text-gray-900">Enterprise</h3>
                        <p class="mt-4 text-gray-600">For large organizations with custom needs</p>
                        <div class="mt-8">
                            <div class="flex items-baseline">
                                <span class="text-5xl font-extrabold text-gray-900">
                                    ${{ $billing === 'monthly' ? '99' : '79' }}
                                </span>
                                <span class="ml-1 text-xl font-semibold text-gray-500">/month</span>
                            </div>
                            @if($billing === 'yearly')
                                <p class="text-sm text-gray-500 mt-1">Billed annually ($948/year)</p>
                            @endif
                        </div>
                        <ul class="mt-8 space-y-3">
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">Unlimited domains</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">1TB bandwidth</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">Custom SSL certificates</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">Real-time analytics</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">Advanced load balancing</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">24/7 phone support</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-3 text-gray-600">SLA guarantee</span>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="{{ route('register') }}" class="block w-full bg-gray-900 hover:bg-gray-800 text-white text-center py-3 px-6 rounded-lg font-medium transition-colors">
                                Contact Sales
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">
                    Frequently asked questions
                </h2>
                <div class="space-y-8">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Can I change my plan anytime?</h3>
                        <p class="mt-2 text-gray-600">Yes, you can upgrade or downgrade your plan at any time. Changes will be reflected in your next billing cycle.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Do you offer a free trial?</h3>
                        <p class="mt-2 text-gray-600">We offer a 14-day free trial for all plans. No credit card required to get started.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">What payment methods do you accept?</h3>
                        <p class="mt-2 text-gray-600">We accept all major credit cards (Visa, MasterCard, American Express) and PayPal.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Is there a setup fee?</h3>
                        <p class="mt-2 text-gray-600">No, there are no setup fees or hidden costs. You only pay the monthly or annual subscription fee.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>