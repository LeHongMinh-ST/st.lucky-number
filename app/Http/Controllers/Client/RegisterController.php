<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Campaign;

class RegisterController extends Controller
{
    public function index($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('pages.client.register')->with(['campaignId' => $campaign->id]);
    }
}
