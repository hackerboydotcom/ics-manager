<?php

namespace App\Observers;

use App\Models\Subscriber;

class SubscriberObserver
{
    /**
     * Handle saving event
     *
     * @param Subscriber $subscriber
     */
    public function saving(Subscriber $subscriber)
    {
        if ($subscriber->updated_at
            and time() - strtotime($subscriber->updated_at) < 60
        ) {
            $subscriber->is_subscribed = true;
        }
    }

    /**
     * Handle saved event
     *
     * @param Subscriber $subscriber
     */
    public function saved(Subscriber $subscriber)
    {
        $this->countCampaignSubscribers($subscriber);
    }

    /**
     * Handle the Subscriber "created" event.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return void
     */
    public function created(Subscriber $subscriber)
    {

    }

    /**
     * Handle the Subscriber "updated" event.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return void
     */
    public function updated(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the Subscriber "deleted" event.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return void
     */
    public function deleted(Subscriber $subscriber)
    {
        $this->countCampaignSubscribers($subscriber);
    }

    /**
     * Handle the Subscriber "restored" event.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return void
     */
    public function restored(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the Subscriber "force deleted" event.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return void
     */
    public function forceDeleted(Subscriber $subscriber)
    {
        //
    }

    /**
     * Count campaign subscribers
     *
     * @param Subscriber $subscriber
     */
    protected function countCampaignSubscribers(Subscriber $subscriber)
    {
        if (!$campaign = $subscriber->campaign) {
            return;
        }

        $campaign->subscriber_count = Subscriber::where('campaign_id', $campaign->id)->where('is_subscribed', true)->count();
        $campaign->save();
    }
}
