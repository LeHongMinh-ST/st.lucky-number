<?php

namespace App\Livewire\Gift;

use App\Models\Gift;
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
    public int $quantity = 1;

    #[Validate(as: 'Số thứ tự')]
    public int $order = 0;


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
    }

    public function closeCreateGiftModal()
    {
        $this->name = '';
        $this->dispatch('close-modal-update-gift');
    }

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

}
