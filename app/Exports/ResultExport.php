<?php

namespace App\Exports;

use App\Models\Member;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResultExport implements FromView
{
    public function __construct(private $campaignId)
    {
    }

    public function view(): View
    {
        return view('exports.result', [
            'members' => Member::query()
                ->whereHas('results')
                ->where('campaign_id', $this->campaignId)
                ->with('giftResult')->get()
        ]);
    }
}
