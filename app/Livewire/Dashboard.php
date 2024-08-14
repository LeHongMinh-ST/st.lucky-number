<?php

namespace App\Livewire;

use App\Models\Campaign;
use App\Models\Setting;
use Livewire\Component;

class Dashboard extends Component
{
    public $campaignIdSelected = '';

    public function render()
    {
        $campaigns = Campaign::query()->get();

        return view('livewire.dashboard', [
            'campaigns' => $campaigns,
        ]);
    }

    public function mount()
    {
        $this->campaignIdSelected = Setting::query()->where('key', 'campaign_id')->first()->value;
    }

    public function updatedCampaignIdSelected()
    {
        Setting::query()->where('key', 'campaign_id')->update([
            'value' => $this->campaignIdSelected,
        ]);

        $this->dispatch('alert', type: 'success', message: 'Cập nhật thành công!');
    }
}
