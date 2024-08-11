<?php

namespace App\Livewire\Gift;

use App\Models\Gift;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GiftUpdate extends Component
{
    public string $giftId = '';

    public function render()
    {
        return view('livewire.gift.gift-update');
    }

    protected $listeners = [
        'open-update-gift-modal' => 'openUpdateGiftModal'
    ];

    #[Validate(as: 'tên quà')]
    public string $name = '';

    #[Validate(as: 'Số lượng')]
    public int|string $quantity = '';

    #[Validate(as: 'Số thứ tự')]
    public int|string $order = '';


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



    public function openUpdateGiftModal($data)
    {
        $this->giftId = $data['giftId'];
        $gift = Gift::find($this->giftId);
        $this->name = $gift->name;
        $this->order = $gift->order;
        $this->quantity = $gift->quantity;
    }

    public function closeUpdateGiftModal()
    {
        $this->name = '';
        $this->dispatch('close-modal-update-gift');
    }

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

    public function submit()
    {
        $this->validate();

        // store
        try {
            Gift::where('id', $this->giftId)->update([
                'name' => $this->name,
                'quantity' => $this->quantity,
                'order' => $this->order,
            ]);
            $this->dispatch('alert', type: 'success', message: 'Cập nhật thành công!');
            $this->closeUpdateGiftModal();
            $this->dispatch('refresh-gift');
        } catch (Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Cập nhật thất bại!');
            Log::error('Error update gift', [
                'method' => __METHOD__,
                'message' => $e->getMessage(),
            ]);
        }

        return null;
    }
}
