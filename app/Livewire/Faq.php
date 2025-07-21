<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;

class Faq extends Component
{
    public $search = '';
    public $selectedCategory = 'all';
    public $openFaqs = [];
    
    protected $faqs = [
        [
            'question' => 'What is a reverse proxy?',
            'answer' => 'A reverse proxy is a server that sits in front of web servers and forwards client (web browser) requests to those web servers. It acts as an intermediary for requests from clients seeking resources from servers.',
            'category' => 'getting-started'
        ],
        [
            'question' => 'How do I get started?',
            'answer' => 'Getting started is simple! Sign up for an account, choose your plan, and follow our quick setup guide. You\'ll be up and running in minutes.',
            'category' => 'getting-started'
        ],
        [
            'question' => 'Can I change my plan anytime?',
            'answer' => 'Yes, you can upgrade or downgrade your plan at any time. Changes will be reflected in your next billing cycle. If you upgrade mid-cycle, you\'ll be charged a prorated amount.',
            'category' => 'pricing'
        ],
        [
            'question' => 'Do you offer a free trial?',
            'answer' => 'We offer a 14-day free trial for all plans. No credit card required to get started. You can cancel anytime during the trial period.',
            'category' => 'pricing'
        ],
        [
            'question' => 'What payment methods do you accept?',
            'answer' => 'We accept all major credit cards (Visa, MasterCard, American Express), PayPal, and bank transfers for enterprise customers.',
            'category' => 'pricing'
        ],
        [
            'question' => 'Is there a setup fee?',
            'answer' => 'No, there are no setup fees or hidden costs. You only pay the monthly or annual subscription fee for your chosen plan.',
            'category' => 'pricing'
        ],
        [
            'question' => 'What SSL/TLS versions do you support?',
            'answer' => 'We support TLS 1.2 and TLS 1.3. SSL certificates are automatically provisioned and renewed through Let\'s Encrypt, or you can upload your own custom certificates.',
            'category' => 'technical'
        ],
        [
            'question' => 'Do you support WebSocket connections?',
            'answer' => 'Yes, we fully support WebSocket connections and real-time communication protocols. WebSockets are automatically detected and properly proxied.',
            'category' => 'technical'
        ],
        [
            'question' => 'What load balancing algorithms are available?',
            'answer' => 'We offer several load balancing algorithms including round-robin, least connections, IP hash, and weighted round-robin. You can configure these through our dashboard.',
            'category' => 'technical'
        ],
        [
            'question' => 'How do health checks work?',
            'answer' => 'Our system performs regular health checks on your backend servers using HTTP, HTTPS, or TCP probes. Unhealthy servers are automatically removed from the load balancer rotation.',
            'category' => 'technical'
        ],
        [
            'question' => 'What are your uptime guarantees?',
            'answer' => 'We guarantee 99.9% uptime for Pro and Enterprise plans, and 99.5% for Starter plans. If we don\'t meet these targets, you\'ll receive service credits.',
            'category' => 'technical'
        ],
        [
            'question' => 'How can I contact support?',
            'answer' => 'You can reach our support team via email, live chat (available 24/7 for Pro and Enterprise customers), or through our help center. Enterprise customers also have access to phone support.',
            'category' => 'support'
        ],
        [
            'question' => 'Do you provide 24/7 support?',
            'answer' => 'Yes, we provide 24/7 support for Pro and Enterprise customers. Starter plan customers receive support during business hours with email support available 24/7.',
            'category' => 'support'
        ],
        [
            'question' => 'Where can I find documentation?',
            'answer' => 'Our comprehensive documentation is available in the help center, covering setup guides, API references, troubleshooting, and best practices.',
            'category' => 'support'
        ]
    ];
    
    #[Computed]
    public function filteredFaqs()
    {
        $faqs = $this->faqs;
        
        // Filter by category
        if ($this->selectedCategory !== 'all') {
            $faqs = array_filter($faqs, function($faq) {
                return $faq['category'] === $this->selectedCategory;
            });
        }
        
        // Filter by search
        if (!empty($this->search)) {
            $searchTerm = strtolower($this->search);
            $faqs = array_filter($faqs, function($faq) use ($searchTerm) {
                return strpos(strtolower($faq['question']), $searchTerm) !== false ||
                       strpos(strtolower($faq['answer']), $searchTerm) !== false;
            });
        }
        
        return array_values($faqs);
    }
    
    public function toggleFaq($index)
    {
        if (in_array($index, $this->openFaqs)) {
            $this->openFaqs = array_diff($this->openFaqs, [$index]);
        } else {
            $this->openFaqs[] = $index;
        }
    }
    
    public function render()
    {
        return view('livewire.faq')
            ->layout('layouts.app');
    }
}
