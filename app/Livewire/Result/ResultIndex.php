<?php

namespace App\Livewire\Result;

use App\Common\Constants;
use App\Exports\ResultExport;
use App\Models\Member;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ResultIndex extends Component
{
    public string $campaignId = '';

    public string $search = '';

    public function render()
    {
        $members = Member::query()
            ->search($this->search)
            ->whereHas('results')
            ->where('campaign_id', $this->campaignId)
            ->with('giftResult')
            ->paginate(Constants::PER_PAGE_ADMIN);

        return view('livewire.result.result-index', [
            'members' => $members
        ]);
    }

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }



    public function export()
    {
        return Excel::download(new ResultExport($this->campaignId), 'ket-qua-vqmm.xlsx');
    }
}
