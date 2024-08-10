<?php

namespace App\Livewire\Client;

use App\Models\Gift;
use App\Models\Member;
use App\Models\Result;
use Livewire\Component;

class LuckyNumber extends Component
{
    public string $campaignId = '';

    public bool $isLoading = false;

    public bool $firstStart = true;

    public int|string $numberLucky = "";


    protected $listeners = [
      'endLoading' => 'endLoading'
    ];

    public function render()
    {
        $results = Result::query()->where('campaign_id', $this->campaignId)
            ->get();

        $gifts = Gift::query()->orderBy('order')
            ->where('campaign_id', $this->campaignId)
            ->get();



        $giftCurrent = null;

        foreach ($gifts as $gift) {
            // Count the number of times this gift appears in the results
            $giftResultCount = $results->where('gift_id', $gift->id)->count();

            // If this gift is not fully used yet
            if ($giftResultCount < $gift->quantity) {
                $giftCurrent = $gift;
                break;
            }
        }


        return view('livewire.client.lucky-number', [
            'giftCurrent' => $giftCurrent
        ]);
    }

    public function mount($campaignId)
    {
        $this->campaignId = (string)$campaignId;
    }

    public function startLucky()
    {
        if (!$this->isLoading) {
            $this->isLoading = true;
            $this->numberLucky = '';
            $results = Result::query()->where('campaign_id', $this->campaignId)
                ->get();

            $resultsMemberId = $results->pluck('member_id')->toArray();

            $memberIds = Member::query()
                ->whereNotIn('id', $resultsMemberId)
                ->where('campaign_id', $this->campaignId)
                ->get()->pluck('id')->toArray();

            $key = array_rand($memberIds);
            $this->numberLucky = $memberIds[$key];

            $this->dispatch('start-lucky', ['number' => $this->numberLucky]);
        }
    }

    public function endLoading()
    {
        $this->firstStart = false;
        $this->isLoading = false;
    }

    public function saveResult($giftId)
    {
        Result::create([
            'member_id' => (int)$this->numberLucky,
            'gift_id' => (int)$giftId,
            'campaign_id' => (int)$this->campaignId
        ]);

        return $this->redirect(route('lucky.number', $this->campaignId));
    }
}
