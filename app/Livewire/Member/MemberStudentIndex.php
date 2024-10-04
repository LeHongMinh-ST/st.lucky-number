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

class MemberStudentIndex extends Component
{
    use WithPagination;

    public string $campaignId = '';

    public string $search = '';

    protected $listeners = [
        'refresh-student' => '$refresh'
    ];


    public function render()
    {
        $campaign = Campaign::query()->find($this->campaignId);

        $members = Member::query()
            ->search($this->search)
            ->where('campaign_id', $this->campaignId)
            ->orderBy('name', 'asc')
            ->paginate(Constants::PER_PAGE_ADMIN);
        $total = Member::query()
            ->where('campaign_id', $this->campaignId)->count();
        return view('livewire.member.member-student-index', [
            'members' => $members,
            'total' => $total
        ]);
    }

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function openImportModal()
    {
        $this->dispatch('open-import-modal');
    }
}
