<?php

namespace App\Livewire\Campaign;

use App\Models\Campaign;
use Livewire\Component;

class CampaignUpdate extends Component
{
    public string $name = '';
    public string $campaignId = '';

    public function render()
    {
        return view('livewire.campaign.campaign-update');
    }

    public function mount($campaignId): void
    {
        $campaign = Campaign::query()->find($campaignId);
        if ($campaign) {
            $this->name = $campaign->name;
            $this->campaignId = $campaign->id;
        }
    }

}
