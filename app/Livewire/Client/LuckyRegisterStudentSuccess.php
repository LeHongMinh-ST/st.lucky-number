<?php

namespace App\Livewire\Client;

use App\Models\Member;
use Livewire\Component;

class LuckyRegisterStudentSuccess extends Component
{
    public string $code;

    public ?Member $member;

    public function render()
    {
        return view('livewire.client.lucky-register-student-success');
    }

    public function mount($code, $campaignId)
    {
        $this->code = $code;
        $this->member = Member::query()->where('code', $this->code)
            ->where('campaign_id',$campaignId)->first();
    }

}
