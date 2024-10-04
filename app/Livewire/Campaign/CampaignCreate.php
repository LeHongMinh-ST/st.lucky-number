<?php

namespace App\Livewire\Campaign;

use App\Common\Constants;
use App\Enums\CampaignType;
use App\Models\Campaign;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CampaignCreate extends Component
{
    #[Validate(as: 'tên chiến dịch')]
    public string $name = '';

    #[Validate('required', as: 'ngày kết thúc')]
    public string $end = '';

    #[Validate('required', as: 'loại')]
    public CampaignType $type = CampaignType::News;


    protected $listeners = [
        'update-end-date' => 'updateEndDate',
    ];


    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255'
            ],

        ];
    }

    public function mount(): void
    {
        $this->end = Carbon::now()->format(Constants::FORMAT_DATE);
    }

    public function render()
    {
        return view('livewire.campaign.campaign-create');
    }

    public function updateType($value)
    {
        $this->type = CampaignType::from($value);
    }

    public function updateEndDate($value): void
    {
        if ($value) {
            $this->resetValidation('end');
        }
        $this->end = str_replace('/', '-', $value);
    }


    public function submit(): RedirectResponse|Redirector|null
    {
        $this->validate();
        $this->end = str_replace('/', '-', $this->end);
        // store
        try {
            Campaign::create([
                'name' => $this->name,
                'key' => Str::random(8),
                'end' => Carbon::make($this->end),
                'type' => $this->type
            ]);
            session()->flash('success', 'Tạo mới thành công!');

            return redirect()->route('admin.campaigns.index');
        } catch (Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Tạo mới thất bại!');
            Log::error('Error create campaign', [
                'method' => __METHOD__,
                'message' => $e->getMessage(),
            ]);
        }

        return null;
    }
}
