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

    protected $listeners = [
        'deleteCampaign' => 'deleteCampaign',
    ];

    public function render()
    {
        $campaigns = Campaign::query()
            ->search($this->search)
            ->orderByDesc('created_at')
            ->paginate(Constants::PER_PAGE_ADMIN);

        return view('livewire.campaign.campaign-index')->with([
            'campaigns' => $campaigns,
        ]);
    }

    public function openDeleteModal(int $id): void
    {
        $this->campaignId = $id;
        $this->dispatch('openDeleteModal');
    }

    public function deleteCampaign(): void
    {
        $campaign = Campaign::destroy($this->campaignId);
        $this->dispatch('alert', type: 'success', message: 'Xóa chiến dịch thành công');
    }
}
