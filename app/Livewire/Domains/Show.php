<?php

namespace App\Livewire\Domains;

use App\Models\Domain;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Show extends Component
{
    use WithPagination;

    public Domain $domain;
    public $showCreateRuleModal = false;

    public function mount($id)
    {
        $this->domain = auth()->user()->domains()->with('routingRules')->findOrFail($id);
    }

    public function toggleRule($ruleId)
    {
        $rule = $this->domain->routingRules()->findOrFail($ruleId);
        $rule->update(['is_active' => !$rule->is_active]);
        
        $this->dispatch('rule-updated');
    }

    public function deleteRule($ruleId)
    {
        $rule = $this->domain->routingRules()->findOrFail($ruleId);
        $rule->delete();
        
        $this->dispatch('rule-deleted');
        $this->domain->load('routingRules');
    }

    public function render()
    {
        $routingRules = $this->domain->routingRules()
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.domains.show', compact('routingRules'));
    }
}
