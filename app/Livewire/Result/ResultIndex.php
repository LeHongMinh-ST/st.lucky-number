<?php

namespace App\Livewire\Result;

use App\Common\Constants;
use App\Exports\ResultExport;
use App\Models\Member;
use App\Models\Result;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ResultIndex extends Component
{
    public string $campaignId = '';

    public string $search = '';

    protected $listeners = [
        'resetResult'=> 'resetResult'
    ];

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

    public function openResetResultModal(): void
    {
        $this->dispatch('openResetResultModal');
    }

    public function resetResult()
    {
        Result::query()->where('campaign_id', $this->campaignId)->delete();
        $this->dispatch('alert', type: 'success', message: 'Đặt lại thành công!');
    }
}
