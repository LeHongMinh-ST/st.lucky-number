<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CampaignController extends Controller
{
    public function index(): View|Application|Factory
    {
        return view('pages.campaign.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory
    {
        return view('pages.campaign.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Application|Factory
    {
        return view('pages.campaign.update')->with([
            'id' => $id,
        ]);
    }

    public function downloadTemplateStudent(): BinaryFileResponse
    {
        $filePath = public_path('templates/student.xlsx');
        return response()->download($filePath);
    }
}
