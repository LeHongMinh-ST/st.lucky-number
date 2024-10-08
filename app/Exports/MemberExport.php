<?php

namespace App\Exports;

use App\Enums\CampaignType;
use App\Models\Campaign;
use App\Models\Member;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MemberExport implements FromView
{
    public function __construct(private $campaignId)
    {
    }

    public function view(): View
    {
        $campaign = Campaign::query()->find($this->campaignId);
        return view('exports.member', [
            'members' => Member::query()
                ->when($campaign->type === CampaignType::Students, function ($q) {
                    return $q->where('is_register', true)->orderBy('register_at', 'desc');
                })
                ->where('campaign_id', $this->campaignId)->get(),
            'campaign' => $campaign,

        ]);
    }
}
