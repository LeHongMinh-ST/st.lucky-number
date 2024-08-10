<?php

namespace App\Livewire\Campaign;

use App\Common\Constants;
use App\Models\Campaign;
use Livewire\Component;
use Livewire\WithPagination;

class CampaignIndex extends Component
{
    use WithPagination;

    public string|int|null $campaignId = null;

    public string $search = '';



    public function render()
    {
        $campaigns = Campaign::query()
            ->search($this->search)
            ->paginate(Constants::PER_PAGE_ADMIN);

        return view('livewire.campaign.campaign-index')->with([
            'campaigns' => $campaigns,
        ]);
    }
}
