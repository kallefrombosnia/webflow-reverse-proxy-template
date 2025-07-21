<?php

namespace App\Livewire\Domains;

use App\Models\Domain;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $showCreateModal = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleDomain($domainId)
    {
        $domain = auth()->user()->domains()->findOrFail($domainId);
        $domain->update(['is_active' => !$domain->is_active]);
        
        $this->dispatch('domain-updated');
    }

    public function deleteDomain($domainId)
    {
        $domain = auth()->user()->domains()->findOrFail($domainId);
        $domain->delete();
        
        $this->dispatch('domain-deleted');
    }

    public function render()
    {
        $domains = auth()->user()->domains()
            ->when($this->search, function ($query) {
                $query->where('domain', 'like', '%' . $this->search . '%')
                      ->orWhere('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.domains.index', compact('domains'));
    }
}
