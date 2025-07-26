<?php

namespace App\Models;

use App\Entities\Client;
use App\Entities\Token;

use App\Shared\HasLocalDates;
use EMedia\Oxygen\Entities\Traits\OxygenUserTrait;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements JWTSubject
{
    use OxygenUserTrait;
    use Notifiable;
    use Billable;
    use HasLocalDates;

    /**
     * @var string[]
     */
    protected $searchable = ['name', 'last_name', 'email'];

    protected $fillable = [
        'name',
        'last_name',
        'first_name',
        'email',
        'phone',
        'password',
        'avatar_url',
        'avatar_path',
        'timezone',
        'logo_path'
    ];

    protected $hidden = ['name', 'password', 'remember_token', 'logo_path'];

    protected $appends = ['full_name', 'status', 'logo_url'];

    public function getFirstNameAttribute()
    {
        return $this->name;
    }

    public function getStatusAttribute()
    {
        if ($this->subscribed('main')) {
            if ($this->subscription('main')->onTrial())
                return 'trial';

            if ($this->subscription('main')->cancelled())
                return 'canceled';

            if ($this->subscription('main') && $this->subscription('main')->onGracePeriod())
                return 'on grace period';

            return 'subscribed';
        }

        return 'not subscribed';
    }

    public function setFirstNameAttribute()
    {
        return !empty($this->last_name) ? ($this->name . ' ' . $this->last_name) : $this->name;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the clients for the user.
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * User tokens relation
     *
     * @return HasMany
     */
    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    /**
     * Return the country code and phone number concatenated
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        // return $this->country_code.$this->phone;
        return $this->phone;
    }

    /**
     * Return the country code and phone number concatenated
     *
     * @return string
     */
    public function Code()
    {
        return $this->hasMany(Token::class)->latest();
    }

    /**
     * @return false
     */
    public function getLogoUrlAttribute()
    {
        $storage = Storage::disk('public');

        if (!empty($this->logo_path) && $storage->exists($this->logo_path))
            return $storage->url($this->logo_path);

        return false;
    }

    public function subscription()
    {
        return $this->hasOne(\Laravel\Cashier\Subscription::class)->latestOfMany();
    }

     public function subscribed($type = 'default', $price = null)
    {
        $subscription = $this->subscription($type)->first();

        if (! $subscription || ! $subscription->valid()) {
            return false;
        }

        return ! $price || $subscription->hasPrice($price);
    }

}
