<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $showModal = false;
    public $domainName = '';
    public $backendUrl = '';
    
    public $statistics = [];
    public $domains = [];

    protected $rules = [
        'domainName' => 'required|string|max:255',
        'backendUrl' => 'required|url',
    ];

    public function mount()
    {
        $this->statistics = [
            'total_domains' => 3,
            'monthly_requests' => 125430,
            'bandwidth_used' => '24.3 GB',
            'uptime' => '99.97%'
        ];

        $this->domains = [
            [
                'name' => 'api.myapp.com',
                'slug' => 'api-myapp-com',
                'initials' => 'AP',
                'color' => 'from-blue-500 to-blue-600',
                'status' => 'Active',
                'status_color' => 'bg-green-100 text-green-800',
                'requests' => '45.2K',
                'ssl_status' => 'Valid',
                'routes' => 3,
                'uptime' => '99.98%'
            ],
            [
                'name' => 'web.example.com',
                'slug' => 'web-example-com',
                'initials' => 'WE',
                'color' => 'from-purple-500 to-purple-600',
                'status' => 'Active',
                'status_color' => 'bg-green-100 text-green-800',
                'requests' => '78.5K',
                'ssl_status' => 'Valid',
                'routes' => 5,
                'uptime' => '99.95%'
            ],
            [
                'name' => 'staging.myapp.com',
                'slug' => 'staging-myapp-com',
                'initials' => 'ST',
                'color' => 'from-orange-500 to-orange-600',
                'status' => 'Paused',
                'status_color' => 'bg-yellow-100 text-yellow-800',
                'requests' => '1.2K',
                'ssl_status' => 'Valid',
                'routes' => 1,
                'uptime' => '—'
            ]
        ];
    }

    public function showAddDomainModal()
    {
        $this->showModal = true;
        $this->domainName = '';
        $this->backendUrl = '';
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->domainName = '';
        $this->backendUrl = '';
        $this->resetErrorBag();
    }

    public function addDomain()
    {
        $this->validate();
        
        // Generate initials from domain name
        $parts = explode('.', $this->domainName);
        $initials = strtoupper(substr($parts[0], 0, 2));
        
        // Generate random color
        $colors = [
            'from-blue-500 to-blue-600',
            'from-purple-500 to-purple-600',
            'from-green-500 to-green-600',
            'from-red-500 to-red-600',
            'from-indigo-500 to-indigo-600',
            'from-pink-500 to-pink-600'
        ];
        
        $newDomain = [
            'name' => $this->domainName,
            'slug' => str_replace('.', '-', $this->domainName),
            'initials' => $initials,
            'color' => $colors[array_rand($colors)],
            'status' => 'Active',
            'status_color' => 'bg-green-100 text-green-800',
            'requests' => '0',
            'ssl_status' => 'Pending',
            'routes' => 0,
            'uptime' => '100%'
        ];
        
        $this->domains[] = $newDomain;
        $this->statistics['total_domains']++;
        
        $this->closeModal();
        session()->flash('message', 'Domain added successfully!');
    }

    public function viewDomain($slug)
    {
        return redirect()->route('domains.show', $slug);
    }

    public function showAnalytics()
    {
        session()->flash('message', 'Analytics feature coming soon!');
    }

    public function showSettings()
    {
        session()->flash('message', 'Settings feature coming soon!');
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('layouts.app');
    }
}