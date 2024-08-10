<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'gift_id', 'campaign_id'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function gift()
    {
        return $this->belongsTo(Gift::class);
    }

}
