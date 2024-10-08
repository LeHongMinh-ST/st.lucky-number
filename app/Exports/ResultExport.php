<?php

namespace App\Exports;

use App\Enums\CampaignType;
use App\Models\Campaign;
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
        $campaign = Campaign::query()->find($this->campaignId);

        return view('exports.result', [
            'members' => Member::query()
                ->whereHas('results')
                ->where('campaign_id', $this->campaignId)
                ->with('giftResult')->get(),
            'campaign' => $campaign,
        ]);
    }
}
