<?php

namespace App\Livewire\Client;


use Livewire\Component;

class LuckyRegisterSuccess extends Component
{
    public int|string $memberId = '';

    public string $name = '';

    public string $code_id = '';

    public string $dob = '';


    public string $phone = '';

    public function render()
    {
        return view('livewire.client.lucky-register-success');
    }

    public function mount($memberId, $name, $code_id, $dob, $phone)
    {
        $this->name = $name;
        $this->memberId = $memberId;
        $this->code_id = $code_id;
        $this->dob = $dob;
        $this->phone = $phone;
    }
}
