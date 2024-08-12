<?php

namespace App\Livewire\Member;

use App\Common\Constants;
use App\Exports\MemberExport;
use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class MemberIndex extends Component
{
    use WithPagination;

    public string $campaignId = '';

    public string $search = '';

    public function render()
    {
        $members = Member::query()
            ->search($this->search)
            ->where('campaign_id', $this->campaignId)->paginate(Constants::PER_PAGE_ADMIN);

        return view('livewire.member.member-index', [
            'members' => $members,
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
}
