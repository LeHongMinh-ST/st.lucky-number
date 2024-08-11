<?php

namespace App\Exports;

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
        return view('exports.member', [
            'members' => Member::query()
                ->where('campaign_id', $this->campaignId)->get()
        ]);
    }
}
