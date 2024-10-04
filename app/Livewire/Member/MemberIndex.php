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

    protected $listeners = [
        'refresh-student' => '$refresh'
    ];


    public function render()
    {
        $members = Member::query()
            ->search($this->search)
            ->where('campaign_id', $this->campaignId)
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::PER_PAGE_ADMIN);
        $total = Member::query()
            ->where('campaign_id', $this->campaignId)->count();
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
