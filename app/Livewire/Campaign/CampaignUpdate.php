<?php

namespace App\Livewire\Campaign;

use App\Enums\CampaignType;
use App\Models\Campaign;
use Livewire\Component;

class CampaignUpdate extends Component
{
    public string $name = '';
    public string $key = '';
    public CampaignType $type;
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
            $this->key = $campaign->key;
            $this->campaignId = $campaign->id;
            $this->type = $campaign->type;
        }
    }

}
