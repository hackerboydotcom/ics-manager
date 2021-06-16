<?php

namespace App\Http\Controllers;

use App\Helpers\Ip;
use App\Models\Campaign;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SubscriberController extends Controller
{
    /**
     * Show the ICS
     *
     * @param Request $request
     * @param Campaign $campaign
     * @param string $uuid
     */
    public function show(Request $request, Campaign $campaign, string $uuid)
    {
        // Check uuid valid
        if (!Uuid::isValid($uuid)) {
            abort(404);
        }

        // Create subscriber if not exists
        if (!$subscriber = Subscriber::where('ip', Ip::getRequestIp())->first()) {
            $subscriber = Subscriber::firstOrNew([
                'uuid' => $uuid
            ]);
        }
        $subscriber->campaign_id = $campaign->id;
        $subscriber->ip = Ip::getRequestIp();
        $subscriber->information = json_encode($request->header());
        $subscriber->hit_count++;
        $subscriber->save();

        return response(view('subscriber', [
            'campaign' => $campaign,
            'subscriber' => $subscriber
        ]), 200, [
            'Content-Type' => 'text/calendar; charset=utf-8'
        ]);
    }
}
