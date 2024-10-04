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

    public array|string $scholarships = [];

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

        return view('livewire.client.lucky-register-success', [
            'scholarshipsLabel' => $scholarshipsLabel
        ]);
    }

    public function mount($memberId, $name, $code_id, $dob, $phone, $scholarships)
    {
        $this->name = $name;
        $this->memberId = $memberId;
        $this->code_id = $code_id;
        $this->dob = $dob;
        $this->phone = $phone;
        $this->scholarships = $scholarships;
    }
}
