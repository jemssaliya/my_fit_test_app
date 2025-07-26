<?php

namespace App\Http\Controllers;

use App\Notifications\Subscription\ExpiredNotification;
use App\Notifications\Subscription\RenewedNotification;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Cashier\Http\Controllers\WebhookController;
use Stripe\Stripe;
use Stripe\Subscription;
use Symfony\Component\HttpFoundation\Response;

class StripeWebhookController extends WebhookController
{
    /**
     * @param array $payload
     * @return Response
     */
    public function handleInvoicePaymentFailed(array $payload)
    {
        /** @var User $user */
        $user = $this->getUserByStripeId($payload['data']['object']['customer']);

        if ($user) {
            $user->notify(new ExpiredNotification());

            return new Response('Webhook Handled', Response::HTTP_OK);
        }
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param array $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleInvoicePaymentSucceeded(array $payload)
    {
        /** @var User $user */
        $user = $this->getUserByStripeId($payload['data']['object']['customer']);

        if ($user) {
            $data = $payload['data']['object'];
            if ($data['billing_reason'] == 'subscription_cycle') {
                $user->notify(new RenewedNotification(
                    $this->getExpiryDate($data['subscription'])->format(config('oxygen.dateFormat'))
                ));
            }

            return new Response('Webhook Handled', Response::HTTP_OK);
        }
    }

    /**
     * @param $subscription_id
     * @return Carbon
     */
    protected function getExpiryDate($subscription_id)
    {
        Stripe::setApiKey(User::getStripeKey());
        $subscription = Subscription::retrieve($subscription_id);

        return Carbon::createFromTimestamp($subscription->current_period_end);
    }
}
