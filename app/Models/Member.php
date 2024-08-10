<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code_id', 'dob', 'phone', 'campaign_id'];

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
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query;
    }
}
