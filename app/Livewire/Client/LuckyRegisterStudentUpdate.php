<?php

namespace App\Livewire\Client;

use App\Models\Member;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LuckyRegisterStudentUpdate extends Component
{
    public string $code;

    public ?Member $member;

    #[Validate(as: 'email')]
    public ?string $email;

    #[Validate(as: 'căn cước công dân')]
    public ?string $code_id;

    #[Validate(as: 'số điện thoai')]
    public ?string $phone;

    #[Validate(as: 'địa chỉ')]
    public ?string $address;

    #[Validate(as: 'nơi ở hiện tại')]
    public ?string $address_now;

    public ?bool $is_inn;

    #[Validate(as: 'tên chủ trọ')]
    public ?string $inn_owner;

    #[Validate(as: 'số điện thoại chủ trọ')]
    public ?string $inn_owner_phone;

    public function setMember(?Member $member): void
    {
        $this->email = $member?->email;
        $this->phone = $member?->phone;
        $this->code_id = $member?->code_id;
        $this->address = $member?->address;
        $this->address_now = $member?->address_now;
        $this->is_inn = $member?->is_inn;
        $this->inn_owner = $member?->inn_owner;
        $this->inn_owner_phone = $member?->inn_owner_phone;
    }

    public function rules(): array
    {
        $rule = [
            'email' => [
                'required',
                'max:255',
            ],
            'code_id' => [
                'required',
                'max:255',
            ],
            'phone' => [
                'required',
                'max:255',
            ],
            'address' => [
                'required',
            ],
            'address_now' => [
                'required',
            ],

        ];

        if ($this->is_inn) {
            $rule['inn_owner'] = [
                'required',
                'max:255',
            ];

            $rule['inn_owner_phone'] = [
                'required',
                'max:255',
            ];
        }

        return $rule;
    }

    public function update()
    {
        $this->validate();
        Member::where('id', $this->member?->id)->update([
            'is_register' => true,
            'email' => $this->email,
            'code_id' => $this->code_id,
            'phone' => $this->phone,
            'address' => $this->address,
            'address_now' => $this->address_now,
            'is_inn' => $this->is_inn,
            'inn_owner' => $this->inn_owner ?? '',
            'inn_owner_phone' => $this->inn_owner_phone ?? '',
        ]);
        $this->dispatch('nextStepSuccess');
    }

    public function render()
    {
        return view('livewire.client.lucky-register-student-update');
    }

    public function mount($code, $campaignId)
    {
        $this->code = $code;
        $this->member = Member::query()->where('code', $this->code)
            ->where('campaign_id',$campaignId)->first();
        $this->setMember($this->member);
    }


}
