<?php

namespace App\Livewire\Client;

use App\Common\Constants;
use App\Models\Member;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LuckyNumberSearch extends Component
{
    public string $campaignId = '';

    public ?Member $member = null;

    #[Validate(as: 'cccd/cmt')]
    public $code_id = '';

    #[Validate(as: 'ngày sinh')]
    public $dob = '';

    #[Validate(as: 'số điện thoại')]
    public $phone = '';

    public $dobFormat = '';
    public array $scholarships = [];

    public bool $isLoading = false;

    public function rules(): array
    {
        return [
            'code_id' => [
                'required',
                'max:255',
            ],
            'phone' => [
                'required',
                'max:20',
                'regex:'.Constants::REGEX_PHONE_NUMBER,
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
        $scholarshipsLabel = [
            'hoc_bong_du_hoc_nuoc_ngoai' => 'Học bổng du học nước ngoài',
            'hoc_bong_sinh_vien_tai_nang' => 'Học bổng sinh viên tài năng',
            'hoc_bong_toi_yeu_que_huong' => 'Học bổng tôi yêu quê hương',
            'hoc_bong_toi_yeu_hvn' => 'Học bổng tôi yêu HVN',
            'hoc_bong_sinh_vien_toan_cau' => 'Học bổng sinh viên toàn cầu',
            'hoc_bong_khoi_nghiep_vnua' => 'Học bổng khởi nghiệp VNUA',
            'hoc_bong_thap_sang_uoc_mo_nong_nghiep' => 'Học bổng thắp sáng ước mơ nông nghiệp',
            'hoc_bong_khuyen_khich_hoc_tap' => 'Học bổng khuyến khích học tập',
            'hoc_bong_tai_tro_cua_doanh_nghiep' => 'Học bổng tài trợ của doanh nghiệp',
        ];

        return view('livewire.client.lucky-number-search')->with('scholarshipsLabel', $scholarshipsLabel);
    }

    public function mount($campaignId)
    {
        $this->campaignId = (string) $campaignId;
    }

    public function submit()
    {
        $this->validate();
        if (!$this->isLoading) {
            $this->isLoading = true;
            $dob = Carbon::createFromFormat('d-m-Y', $this->dob);
            $memberInfo = Member::where('code_id', $this->code_id)->first();

            if ($memberInfo) {
                $message = '';

                if ($memberInfo->phone != $this->phone && $memberInfo->dob != $dob->format('Y-m-d')) {
                    $message = 'Số điện thoại và ngày sinh không đúng!';
                } elseif ($memberInfo->phone != $this->phone) {
                    $message = 'Số điện thoại không đúng!';
                } elseif ($memberInfo->dob != $dob->format('Y-m-d')) {
                    $message = 'Ngày sinh không đúng!';
                } else {
                    $this->member = $memberInfo;
                    $this->reset(['code_id', 'phone', 'dob']);
                }

                if ($message) {
                    $this->dispatch('alert', type: 'error', message: $message);
                }

                $this->dobFormat =  $this->member?->dob ? Carbon::createFromFormat('Y-m-d', $this->member->dob)->format('d/m/Y') : '';
            } else {
                $this->dispatch('alert', type: 'error', message: 'Bạn chưa đăng ký và nhận mã số may mắn!');
            }
            $this->isLoading = false;
        }

        return null;
    }
}
