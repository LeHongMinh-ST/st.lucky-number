<?php

namespace App\Livewire\Client;

use App\Enums\CampaignType;
use App\Models\Campaign;
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

    public array $numberMiss = [];


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
        $turn = 1;

        foreach ($gifts as $gift) {
            // Count the number of times this gift appears in the results
            $giftResultCount = $results->where('gift_id', $gift->id)->count();

            // If this gift is not fully used yet
            if ($giftResultCount < $gift->quantity) {
                $giftCurrent = $gift;
                $turn = $giftResultCount + 1;
                break;
            }
        }



        return view('livewire.client.lucky-number', [
            'giftCurrent' => $giftCurrent,
            'turn' => $turn
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

            $campaign = Campaign::query()->find($this->campaignId);

            $resultsMemberId = $results->pluck('member_id')->toArray();

            $memberIds = Member::query()
                ->whereNotIn('id', [...$resultsMemberId, ...$this->numberMiss])
                ->where('campaign_id', $this->campaignId)
                ->when($campaign->type == CampaignType::Students, function ($query)  {
                    $query->where('is_register', true);
                })
                ->get()->pluck('id')->toArray();
            if (count($memberIds) === 0) {
                $this->dispatch('alert', type: 'error', message: 'Hết người chơi!');
                $this->isLoading = false;
                return;
            }
            $key = array_rand($memberIds);
            $this->numberLucky = $memberIds[$key];
            $this->numberMiss[] = $this->numberLucky;
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
