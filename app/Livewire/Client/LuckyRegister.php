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

    public array $scholarships = [];

    public bool $isLoading = false;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'code_id' => [
                'required',
                'max:255',
            ],
            'phone' => [
                'required',
                'max:20',
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
        $this->campaignId = (string) $campaignId;
    }

    public function submit()
    {
        if (!$this->isLoading) {
            $this->isLoading = true;
            $this->validate();
            // store
            $this->dob = str_replace('/', '-', $this->dob);
            $member = Member::where('code_id', $this->code_id)->first();
            if ($member) {
                $this->dispatch('alert', type: 'error', message: 'Bạn đã đăng ký và nhận mã dự thưởng!');
            } else {
                try {
                    $member = Member::create([
                        'name' => $this->name,
                        'code_id' => $this->code_id,
                        'phone' => $this->phone,
                        'dob' => Carbon::make($this->dob),
                        'campaign_id' => (int) $this->campaignId,
                        'scholarships' => $this->scholarships,
                    ]);
                    $this->memberId = $member->id;
                    $this->state = 'success';
                } catch (Exception $e) {
                    $this->dispatch('alert', type: 'error', message: 'Đăng ký thất bại!');
                    Log::error('Error create campaign', [
                        'method' => __METHOD__,
                        'message' => $e->getMessage(),
                    ]);
                }
            }
            $this->isLoading = false;
        }
        return null;

    }
}
