<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Finger;
use App\Models\Phone;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Supplier;
use App\Models\History;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    public $timestamps = FALSE;

    // Relationship
    public function finger() // One to One
    {
        return $this->hasOne(Finger::class, 'user_id');
    }

    public function phones() // One to Many
    {
        return $this->hasMany(Phone::class, 'user_id');
    }

    public function products() // Many to Many
    {
        return $this->belongsToMany(Product::class, 'users_products', 'user_id', 'product_id')
        ->withPivot('quantity', 'id') // Lấy thêm cột trung gian
        ;
    }

    public function plans() { // Has Many Through
        return $this->hasManyThrough(
            Plan::class,
            Subscription::class,
            'user_id',    // Foreign key on subscriptions table
            'id',         // Local key on plans table
            'id',         // Local key on users table
            'plan_id'     // Foreign key on subscriptions table
        )
        ->statusActive() // = ->where('plans.status', 'active')
        ;
    }

    public function availablePlans()
    {
        return $this->plans()
            ->where('subscriptions.end_at', '>', now());
    }

    public function uniquePlans()
    {
        return $this->availablePlans()
            ->distinct();
    }

    public function hasActiveSubscription()
    {
        return $this->subscriptions()->valid()->exists();
    }

    public function getActiveSubscription()
    {
        return $this->subscriptions()->valid()->first();
    }

    public function getHasActiveSubscriptionAttribute()
    {
        return $this->hasActiveSubscription();
    }

    public function getActiveSubscriptionAttribute()
    {
        return $this->getActiveSubscription();
    }

    public function supplier() // has One Through
    {
        return $this->belongsTo(Supplier::class);
    }

    public function history() // has One Through
    {
        return $this->hasOne(History::class);
    }
    // End Relationship


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'supplier_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    public function latestPlan()
    {
        return $this->availablePlans()
            ->orderBy('subscriptions.id', 'desc')
            ->first()
        ;
    }

}
