<?php

namespace App\Livewire\Campaign;

use App\Common\Constants;
use App\Models\Campaign;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CampaignUpdateGeneral extends Component
{

    public mixed $campaignId = null;

    #[Validate(as: 'tên chiến dịch')]
    public string $name = '';

    #[Validate('required', as: 'ngày kết thúc')]
    public string $end = '';

    protected $listeners = [
        'update-end-date' => 'updateEndDate',
    ];

    public function updateEndDate($value): void
    {
        if ($value) {
            $this->resetValidation('end');
        }
        $this->end = str_replace('/', '-', $value);
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255'
            ],

        ];
    }

    public function render()
    {
        return view('livewire.campaign.campaign-update-general');
    }


    public function mount($campaignId): void
    {
        $campaign = Campaign::query()->find($campaignId);
        if ($campaign) {
            $this->name = $campaign->name;
            $this->end = $campaign->end ? Carbon::make($campaign->end)->format(Constants::FORMAT_DATE) : "";
            $this->campaignId = $campaign->id;
        }
    }

    public function update(): RedirectResponse|Redirector|null
    {
        $this->validate();
        $this->end = str_replace('/', '-', $this->end);

        try {
            Campaign::where('id', $this->campaignId)->update([
                'name' => $this->name,
                'end' => Carbon::make($this->end),
            ]);
            $this->dispatch('alert', type: 'success', message: 'Cập nhật thành công');

        } catch (Exception $e) {
            Log::error('Error update campaign', [
                'method' => __METHOD__,
                'message' => $e->getMessage(),
            ]);
            $this->dispatch('alert', type: 'error', message: 'Cập nhật thất bại!');
        }
        return null;
    }
}
