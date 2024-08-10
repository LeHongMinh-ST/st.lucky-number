<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index($id)
    {
        return view('pages.client.register')->with(['campaignId' => $id]);
    }
}
