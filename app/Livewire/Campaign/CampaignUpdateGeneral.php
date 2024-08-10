<?php

namespace App\Livewire\Campaign;

use App\Models\Campaign;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CampaignUpdateGeneral extends Component
{

    public mixed $campaignId = null;

    #[Validate(as: 'tên chiến dịch')]
    public string $name = '';

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
            $this->campaignId = $campaign->id;
        }
    }

    public function update(): RedirectResponse|Redirector|null
    {
        $this->validate();

        try {
            Campaign::where('id', $this->campaignId)->update([
                'name' => $this->name
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
