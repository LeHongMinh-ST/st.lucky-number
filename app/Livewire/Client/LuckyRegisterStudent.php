<?php

namespace App\Livewire\Client;

use App\Common\Constants;
use App\Models\Member;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LuckyRegisterStudent extends Component
{
    public string $campaignId = '';

    #[Validate(as: 'mã sinh viên')]
    public string $code = '';

    #[Validate(as: 'ngày sinh')]
    public $dob = '';

    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'max:255',
            ],
            'dob' => [
                'required',
            ],

        ];
    }

    protected $listeners = [
        'update-dob' => 'updateDob',
        'nextStepSuccess' => 'nextStepSuccess'
    ];

    public function updateDob($value): void
    {
        if ($value) {
            $this->resetValidation('dob');
        }
        $this->dob = str_replace('/', '-', $value);
    }


    public function mount($campaignId)
    {
        $this->campaignId = (string) $campaignId;
    }

    public string $state = 'search';

    public function render()
    {
        return view('livewire.client.lucky-register-student');
    }

    public function nextStepRegister(): void
    {
        $this->state = 'register';
    }

    public function nextStepSuccess(): void
    {
        $this->state = 'success';
    }

    public function check()
    {
        $this->validate();
        $dob = Carbon::createFromFormat('d-m-Y', $this->dob);
        $member = Member::where('code', $this->code)->where('dob', $dob->format('Y-m-d'))->first();
        if ($member) {
            $this->nextStepRegister();
        } else {
            $this->dispatch('alert', type: 'error', message: 'Không tìm thấy sinh viên nào phù hợp!');
        }
    }
}
