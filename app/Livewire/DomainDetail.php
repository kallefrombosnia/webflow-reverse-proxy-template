<?php

namespace App\Livewire;

use Livewire\Component;

class DomainDetail extends Component
{
    public $domain;
    public $activeTab = 'routing';
    public $showRouteModal = false;
    
    public $routeMethod = 'GET';
    public $routePath = '';
    public $routeBackend = '';
    public $loadBalancing = 'round_robin';
    
    public $domainData = [];
    public $statistics = [];
    public $routes = [];
    public $recentActivity = [];

    protected $rules = [
        'routePath' => 'required|string|max:255',
        'routeBackend' => 'required|url',
    ];

    public function mount($domain)
    {
        $this->domain = $domain;
        
        // Mock domain data - in real app, fetch from database
        $this->domainData = [
            'name' => str_replace('-', '.', $domain),
            'slug' => $domain,
            'initials' => strtoupper(substr(explode('-', $domain)[0], 0, 2)),
            'color' => 'from-blue-500 to-blue-600',
            'status' => 'Active',
            'status_color' => 'bg-green-100 text-green-800',
            'last_updated' => '2 hours ago',
            'created_at' => 'March 15, 2024'
        ];

        $this->statistics = [
            'requests_today' => '1,547',
            'avg_response' => '245ms',
            'error_rate' => '0.03%',
            'bandwidth' => '2.3 GB',
            'uptime' => '99.98%'
        ];

        $this->routes = [
            [
                'method' => 'GET',
                'method_color' => 'bg-green-100 text-green-800',
                'path' => '/api/v1/*',
                'backend' => 'backend-api.internal:3000',
                'load_balancing' => 'Round Robin',
                'health_check' => 'Enabled',
                'requests_today' => '1,234'
            ],
            [
                'method' => 'POST',
                'method_color' => 'bg-blue-100 text-blue-800',
                'path' => '/webhook/*',
                'backend' => 'webhook-handler.internal:8080',
                'load_balancing' => 'Least Connections',
                'health_check' => 'Enabled',
                'requests_today' => '89'
            ],
            [
                'method' => '*',
                'method_color' => 'bg-purple-100 text-purple-800',
                'path' => '/*',
                'backend' => 'frontend.internal:3000',
                'load_balancing' => 'Round Robin',
                'health_check' => 'Enabled',
                'requests_today' => '224'
            ]
        ];

        $this->recentActivity = [
            [
                'message' => 'SSL certificate renewed',
                'time' => '2h ago',
                'color' => 'bg-green-500',
                'icon' => '<svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>'
            ],
            [
                'message' => 'Route configuration updated',
                'time' => '1d ago',
                'color' => 'bg-blue-500',
                'icon' => '<svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>'
            ],
            [
                'message' => 'Domain created',
                'time' => '3d ago',
                'color' => 'bg-gray-400',
                'icon' => '<svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>'
            ]
        ];
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function goToDashboard()
    {
        return redirect()->route('dashboard');
    }

    public function showAddRouteModal()
    {
        $this->showRouteModal = true;
        $this->routeMethod = 'GET';
        $this->routePath = '';
        $this->routeBackend = '';
        $this->loadBalancing = 'round_robin';
        $this->resetErrorBag();
    }

    public function closeRouteModal()
    {
        $this->showRouteModal = false;
        $this->resetErrorBag();
    }

    public function addRoute()
    {
        $this->validate();

        $methodColors = [
            'GET' => 'bg-green-100 text-green-800',
            'POST' => 'bg-blue-100 text-blue-800',
            'PUT' => 'bg-yellow-100 text-yellow-800',
            'DELETE' => 'bg-red-100 text-red-800',
            '*' => 'bg-purple-100 text-purple-800'
        ];

        $loadBalancingMap = [
            'round_robin' => 'Round Robin',
            'least_connections' => 'Least Connections',
            'ip_hash' => 'IP Hash',
            'weighted' => 'Weighted'
        ];

        $newRoute = [
            'method' => $this->routeMethod,
            'method_color' => $methodColors[$this->routeMethod],
            'path' => $this->routePath,
            'backend' => $this->routeBackend,
            'load_balancing' => $loadBalancingMap[$this->loadBalancing],
            'health_check' => 'Enabled',
            'requests_today' => '0'
        ];

        $this->routes[] = $newRoute;
        $this->closeRouteModal();
        session()->flash('message', 'Route added successfully!');
    }

    public function editRoute($index)
    {
        session()->flash('message', 'Route editing feature coming soon!');
    }

    public function deleteRoute($index)
    {
        if (isset($this->routes[$index])) {
            unset($this->routes[$index]);
            $this->routes = array_values($this->routes); // Re-index array
            session()->flash('message', 'Route deleted successfully!');
        }
    }

    public function showSettings()
    {
        session()->flash('message', 'Domain settings feature coming soon!');
    }

    public function viewLogs()
    {
        session()->flash('message', 'Logs viewer feature coming soon!');
    }

    public function exportConfig()
    {
        session()->flash('message', 'Config export feature coming soon!');
    }

    public function cloneDomain()
    {
        session()->flash('message', 'Domain cloning feature coming soon!');
    }

    public function render()
    {
        return view('livewire.domain-detail')
            ->layout('layouts.app');
    }
}