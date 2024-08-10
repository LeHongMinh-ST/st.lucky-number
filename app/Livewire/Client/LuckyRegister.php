<?php

namespace App\Livewire\Client;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LuckyRegister extends Component
{
    public string $campaignId = '';

    public int|string $memberId = '';

    public string $state = 'register';

    #[Validate(as: 'họ và tên')]
    public string $name = '';

    #[Validate(as: 'cccd/cmt')]
    public string $code_id = '';

    #[Validate(as: 'ngày sinh')]
    public string $dob = '';


    #[Validate(as: 'số điện thoại')]
    public string $phone = '';

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255'
            ],
            'code_id' => [
                'required',
                'max:255',
            ],
            'phone' => [
                'required',
                'max:20'
            ],
            'dob' => [
                'required',
            ],

        ];
    }
    protected $listeners = [
        'update-dob' => 'updateDob',
    ];

    public function updateDob($value): void
    {
        if ($value) {
            $this->resetValidation('dob');
        }
        $this->dob = str_replace('/', '-', $value);


    }

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

    public function render()
    {
        return view('livewire.client.lucky-register');
    }

    public function mount($campaignId)
    {
        $this->campaignId = (string)$campaignId;
    }

    public function submit()
    {
        $this->validate();
        // store
        $member = Member::where('code_id', $this->code_id)->first();
        if ($member) {
            $this->memberId = $member->id;
            $this->state = 'current';
        } else {
            try {
               $member = Member::create([
                    'name' => $this->name,
                    'code_id' => $this->code_id,
                    'phone' => $this->phone,
                    'dob' => Carbon::make($this->dob),
                    'campaign_id' => (int)$this->campaignId
                ]);
                $this->reset();
                $this->memberId = $member->id;

                $this->state = 'success';
            } catch (Exception $e) {
                $this->dispatch('alert', type: 'error', message: 'Tạo mới thất bại!');
                Log::error('Error create campaign', [
                    'method' => __METHOD__,
                    'message' => $e->getMessage(),
                ]);
            }
        }


        return null;
    }
}
