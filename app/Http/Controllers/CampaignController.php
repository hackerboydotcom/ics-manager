<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Get campaign detail
     *
     * @param Request $request
     * @param Campaign $campaign
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(Request $request, Campaign $campaign)
    {
        return response(view('campaign', [
            'campaign' => $campaign
        ]), 200, [
            'Content-Type' => 'text/javascript'
        ]);
    }
}
