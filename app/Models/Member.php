<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code_id', 'dob', 'phone', 'campaign_id', 'scholarships'];

    protected $casts = [
        'scholarships' => 'array',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function giftResult()
    {
        return $this->hasOne(Result::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('name', 'like', '%'.$search.'%')->orWhere('code_id', 'like', '%'.$search.'%')->orWhere('phone', 'like', '%'.$search.'%');
        }

        return $query;
    }

    public function getScholarshipLabelAttribute()
    {

        if ($this->scholarships) {
            $scholarships = [
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

            $result = [];

            foreach ($this->scholarships as $key) {
                if (isset($scholarships[$key])) {
                    $result[] = $scholarships[$key];
                }
            }

            return implode(', ', $result);
        }

        return 'Không';
    }
}
