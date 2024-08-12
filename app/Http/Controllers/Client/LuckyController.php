<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LuckyController extends Controller
{
    public function index($id)
    {
        $campaign = Campaign::findOrFail($id);

        $auth = Session::get('lucky-'.$campaign->id);
        if (! $auth) {
            return redirect()->route('lucky.auth', ['campaign_id' => $id]);
        }

        return view('pages.client.lucky-number')->with(['campaignId' => $id]);
    }

    public function auth($id)
    {
        $auth = Session::get('lucky-'.$id);
        if ($auth) {
            return redirect()->route('lucky.number', ['campaign_id' => $id]);
        }

        return view('pages.client.key')->with(['campaignId' => $id]);
    }

    public function handleCheckKey(Request $request, $id)
    {
        $campaign = Campaign::find($id);

        if (! $request->has('key')) {
            session()->flash('error', 'Vui lòng nhập mã khoá');

            return redirect()->back();
        }
        if ($campaign->key != $request->get('key')) {
            session()->flash('error', 'Mã khoá không đúng');

            return redirect()->back();
        }

        Session::put('lucky-'.$id, true);

        return redirect()->route('lucky.number', ['campaign_id' => $id]);
    }
}
