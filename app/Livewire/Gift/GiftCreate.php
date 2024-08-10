<?php

namespace App\Livewire\Gift;

use App\Models\Gift;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GiftCreate extends Component
{
    public string $campaignId = '';

    #[Validate(as: 'tên quà')]
    public string $name = '';

    #[Validate(as: 'Số lượng')]
    public int $quantity = 1;

    #[Validate(as: 'Số thứ tự')]
    public int $order = 0;


    protected $listeners = [
        'open-create-gift-modal' => 'openCreateGiftModal'
    ];

    public function closeCreateGiftModal()
    {
        $this->name = '';
        $this->reset();

        $this->dispatch('close-modal-create-gift');
    }


    public function mount($campaignId)
    {
        $this->campaignId = $campaignId;
    }


    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255'
            ],
            'quantity' => [
                'required',
                'min:1'
            ],
        ];
    }

    public function render()
    {
        return view('livewire.gift.gift-create');
    }

    public function submit()
    {
        $this->validate();

        // store
        try {
            Gift::create([
                'name' => $this->name,
                'quantity' => $this->quantity,
                'order' => $this->order,
                'campaign_id' => $this->campaignId
            ]);
            $this->dispatch('alert', type: 'success', message: 'Tạo mới thành công!');
            $this->closeCreateGiftModal();
            $this->dispatch('refresh-gift');
        } catch (Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Tạo mới thất bại!');
            Log::error('Error create gift', [
                'method' => __METHOD__,
                'message' => $e->getMessage(),
            ]);
        }

        return null;
    }

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

}
