<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function index(): RedirectResponse
    {
        $id = Setting::query()->where('key', 'campaign_id')->first()->value;
        if (! $id) {
            return redirect()->route('admin.campaigns.index');
        }

        return redirect()->route('lucky.search', $id);
    }
}
