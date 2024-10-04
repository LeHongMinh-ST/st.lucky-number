<?php

namespace App\Http\Controllers\Client;

use App\Enums\CampaignType;
use App\Http\Controllers\Controller;
use App\Models\Campaign;

class RegisterController extends Controller
{
    public function index($id)
    {
        $campaign = Campaign::findOrFail($id);
        if ($campaign->isExpired()) {
            abort(404);
        }

        return view('pages.client.register')->with(['campaign' => $campaign]);

    }
}
