<?php

namespace App\Livewire\Domains;

use App\Models\Domain;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Create extends Component
{
    public $domain = '';
    public $name = '';
    public $description = '';
    public $ssl_enabled = false;
    public $timeout = 30;
    public $enable_logging = true;

    protected $rules = [
        'domain' => 'required|string|max:255|unique:domains,domain',
        'name' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:500',
        'ssl_enabled' => 'boolean',
        'timeout' => 'required|integer|min:5|max:300',
        'enable_logging' => 'boolean',
    ];

    public function save()
    {
        $this->validate();

        auth()->user()->domains()->create([
            'domain' => $this->domain,
            'name' => $this->name,
            'description' => $this->description,
            'ssl_enabled' => $this->ssl_enabled,
            'timeout' => $this->timeout,
            'enable_logging' => $this->enable_logging,
        ]);

        session()->flash('message', 'Domain created successfully!');
        
        return redirect()->route('domains.index');
    }

    public function render()
    {
        return view('livewire.domains.create');
    }
}
