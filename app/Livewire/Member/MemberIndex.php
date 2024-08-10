<?php

namespace App\Livewire\Member;

use App\Common\Constants;
use App\Models\Member;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MemberIndex extends Component
{
    public string $campaignId = '';

    public string $search = '';


    public function render()
    {
        $members = Member::query()
            ->search($this->search)
            ->where('campaign_id', $this->campaignId)->paginate(Constants::PER_PAGE_ADMIN);
        return view('livewire.member.member-index', [
            'members' => $members
        ]);
    }

    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }

}
