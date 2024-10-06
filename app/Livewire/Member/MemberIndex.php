<?php

namespace App\Livewire\Member;

use App\Common\Constants;
use App\Enums\CampaignType;
use App\Exports\MemberExport;
use App\Models\Campaign;
use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class MemberIndex extends Component
{
    use WithPagination;

    public string $campaignId = '';

    public string $search = '';

    public ?Campaign $campaign;

    protected $listeners = [
        'refresh-student' => '$refresh'
    ];


    public function render()
    {
        $campaign = Campaign::query()->find($this->campaignId);
        $this->campaign = $campaign;
        $members = Member::query()
            ->search($this->search)
            ->where('campaign_id', $this->campaignId)
            ->when($campaign->type === CampaignType::Students, function ($q) {
                return $q->where('is_register', true)->orderBy('register_at', 'desc');
            })
            ->when($campaign->type !== CampaignType::Students, function ($q) {
                return $q->orderBy('created_at', 'desc');
            })
            ->paginate(Constants::PER_PAGE_ADMIN);
        $total = Member::query()
            ->where('campaign_id', $this->campaignId)
            ->when($campaign->type === CampaignType::Students, function ($q) {
                return $q->where('is_register', true);
            })
            ->count();
        return view('livewire.member.member-index', [
            'members' => $members,
            'total' => $total
        ]);
    }

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function export()
    {
        return Excel::download(new MemberExport($this->campaignId), 'ds-nguoi-choi.xlsx');
    }

    public function openImportModal()
    {
        $this->dispatch('open-import-modal');
    }
}
