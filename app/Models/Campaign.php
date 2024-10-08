<?php

namespace App\Models;

use App\Enums\CampaignType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'key', 'end', 'type'];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function isExpired()
    {
        if (!$this->end) return false;

        $now = Carbon::now()->timestamp;
        $end = Carbon::make($this->end)->endOfDay()->timestamp;
        return $end < $now;
    }

    protected $casts = [
      'type' => CampaignType::class
    ];
}
