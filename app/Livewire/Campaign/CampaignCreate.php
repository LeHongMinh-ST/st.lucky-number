<?php

namespace App\Livewire\Campaign;

use App\Models\Campaign;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CampaignCreate extends Component
{
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
        return view('livewire.campaign.campaign-create');
    }

    public function submit(): RedirectResponse|Redirector|null
    {
        $this->validate();

        // store
        try {
            Campaign::create([
                'name' => $this->name,
                'key' => Str::random(8)
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
