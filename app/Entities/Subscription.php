<?php

namespace App\Entities;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Stripe\Stripe;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'user_id',
        'name',
        'trial_ends_at',
        'created_at',
    ];

    protected $appends = ['user_name', 'expire_date'];

    /**
     * Client age
     *
     */
    public function getUserNameAttribute()
    {
        return $this->user->name . $this->user->last_name;
    }

    /**
     * Get the user that owns the subscription.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Fetch Expiry date from stripe
     *
     * @return mixed|null
     */
    public function getExpireDateAttribute()
    {
        try {
            return Cache::remember($this->stripe_id, now()->addDay(30), function () {
                Stripe::setApiKey(config('services.stripe.secret'));
                $stripe = \Stripe\Subscription::retrieve($this->stripe_id);
                return Carbon::createFromTimestamp($stripe->current_period_end ?? $stripe->trial_end)->toDateString();
            });
        } catch (Exception $exception) {
            return null;
        }
    }

}
