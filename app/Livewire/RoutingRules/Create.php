<?php

namespace App\Livewire\RoutingRules;

use App\Models\Domain;
use App\Models\RoutingRule;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Create extends Component
{
    public Domain $domain;
    public $name = '';
    public $description = '';
    public $path_pattern = '/';
    public $target_url = '';
    public $method = '*';
    public $priority = 0;
    public $load_balancing = 'round_robin';
    public $preserve_host = false;
    public $timeout = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'path_pattern' => 'required|string|max:255',
        'target_url' => 'required|url|max:255',
        'method' => 'required|in:GET,POST,PUT,DELETE,PATCH,HEAD,OPTIONS,*',
        'priority' => 'required|integer|min:0|max:1000',
        'load_balancing' => 'required|in:round_robin,least_connections,ip_hash',
        'preserve_host' => 'boolean',
        'timeout' => 'nullable|integer|min:5|max:300',
    ];

    public function mount($domain_id)
    {
        $this->domain = auth()->user()->domains()->findOrFail($domain_id);
    }

    public function save()
    {
        $this->validate();

        $this->domain->routingRules()->create([
            'name' => $this->name,
            'description' => $this->description,
            'path_pattern' => $this->path_pattern,
            'target_url' => $this->target_url,
            'method' => $this->method,
            'priority' => $this->priority,
            'load_balancing' => $this->load_balancing,
            'preserve_host' => $this->preserve_host,
            'timeout' => $this->timeout,
        ]);

        session()->flash('message', 'Routing rule created successfully!');
        
        return redirect()->route('domains.show', $this->domain->id);
    }

    public function render()
    {
        return view('livewire.routing-rules.create');
    }
}
