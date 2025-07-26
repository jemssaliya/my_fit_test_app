<?php

namespace App\Http\Controllers;

use App\Entities\Plan;
use App\Entities\Subscription;
use App\Jobs\Subscription\SubscriptionExpired;
use App\Jobs\Subscription\SubscriptionExpiry;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UpdateTestRequest;
use Illuminate\View\View;
use Redirect;

class SubscriptionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|Response|View
     */
    public function index(Request $request)
    {
        return view('subscription.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Factory|Response|View
     */
    public function create(Request $request)
    {
        $plan = Plan::findOrFail(1);
        // return $plan;
        return view('subscription.create', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Plan $plan
     * @return RedirectResponse|Response
     */
    public function store(Request $request, Plan $plan)
    {
        $plan = Plan::findOrFail($request->get('plan'));

        try {
            if (!$request->user()->subscribed('main')){
                $request->user()
                    ->newSubscription('main', $plan->stripe_plan)
                    ->trialDays(30)
                    ->create($request->stripeToken);
            }

        } catch (Exception $e) {
            return redirect('subscribe/create')->with('error', 'Please enter correct card details');
        }

        return redirect()->route('clients.index')->with('success', 'You have subscribed successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTestRequest $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
    }

    /**
     * Cancel the subscription immediately.
     *
     * @return void
     */
    public function cancelNow()
    {
        Auth::user()->subscription('main')->cancelNow();
    }

    /**
     * Mark the subscription as cancelled.
     *
     * @return void
     */
    public function markAsCancelled()
    {
        // $this->fill(['ends_at' => Carbon::now()])->save();
    }

    /**
     * Cancel the subscription at the end of the billing period.
     *
     * @return void
     */
    public function cancel()
    {
        Auth::user()->subscription('main')->cancel();
        // $subscription = $this->asStripeSubscription();

        // $subscription->cancel(['at_period_end' => true]);

        // If the user was on trial, we will set the grace period to end when the trial
        // would have ended. Otherwise, we'll retrieve the end of the billing period
        // period and make that the end of the grace period for this current user.
        // if ($this->onTrial()) {
        //     $this->ends_at = $this->trial_ends_at;
        // } else {
        //     $this->ends_at = Carbon::createFromTimestamp(
        //         $subscription->current_period_end
        //     );
        // }

        // $this->save();

        // return $this;
    }

    /**
     * Resume Canceled subscription.
     *
     * @return void
     */
    public function resume()
    {
        if ($this->authUser->subscription('main')->onGracePeriod()) {
            $this->authUser->subscription('main')->resume();
        }
    }

    /**
     * @return Factory|View
     */
    public function manageSubscription()
    {
        /** @var User $user */
        $user = Auth::user();

        // $cards = $user->defaultCard();
        $cards = $user->defaultPaymentMethod();

        $plan = Plan::findOrFail(1);
        $status = 0;
        $endDate = null;

        // if ($user->subscription('main')->onGracePeriod())
        //     $status = 1;

        // if (!$user->subscribed('main')) {
        //     $status = 2;
        // } else {
        //     $sub = $user->subscription('main')->asStripeSubscription();
        //     $endDate = Carbon::createFromTimeStamp($sub->current_period_end)->format('d/m/Y');
        // }

        $subscription = $user->subscription;

        if ($subscription && $subscription->onGracePeriod()) {
            $status = 1;
        }

        if (!$subscription || !$subscription->valid()) {
            $status = 2;
        } else {
            $stripeSub = $subscription->asStripeSubscription(); // Cashier still supports this
            $endDate = Carbon::createFromTimestamp($stripeSub->current_period_end)->format('d/m/Y');
        }

        return view('subscription.edit', compact('plan', 'cards', 'status', 'endDate'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateSubscription(Request $request)
    {
        try {
            Auth::user()->updateCard($request->stripeToken);
        } catch (Exception $e) {
            return redirect('manage/subscription')->with('error', 'Please enter correct card details.');
        }

        return redirect('manage/subscription')->with('success', 'Payment successful.');
    }

    /**
     * @return RedirectResponse
     */
    public function cancelSubscription()
    {
        Auth::user()->subscription('main')->cancel();

        return redirect('manage/subscription')->with('success', 'Payment successful.');
    }

    /**
     * @return RedirectResponse
     */
    public function resumeSubscription()
    {
        Auth::user()->subscription('main')->resume();

        return redirect('manage/subscription')->with('success', 'Payment successful.');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function newSubscription(Request $request)
    {
        $plan = Plan::findOrFail($request->get('plan'));

        try {
            Auth::user()->newSubscription('main', $plan->stripe_plan)->create($request->stripeToken);
        } catch (Exception $e) {
            return redirect('manage/subscription')->with('error', 'Please enter correct card details');
        }

        return redirect('manage/subscription')->with('success', 'Payment successful.');
    }

    /**
     * @return Factory|View
     */
    public function confirmSubscription()
    {
        /** @var User $user */
        $user = Auth::user();
        $endDate = null;

        if ($user->subscribed('main')) {
            $sub = $user->subscription('main')->asStripeSubscription();
            $endDate = Carbon::createFromTimeStamp($sub->current_period_end)->format('d/m/Y');
        }

        return view('subscription.confirm', compact('endDate'));
    }
}
