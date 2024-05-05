<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN = 2;
    const USER = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForSms()
    {
        return '+2' . $this->phone;
    }


    public function routeNotificationFor($driver, $notification = null)
    {
        if (method_exists($this, $method = 'routeNotificationFor' . Str::studly($driver))) {
            return $this->{$method}($notification);
        }
        switch ($driver) {
            case 'database':
                return $this->notifications();
            case 'mail':
                return $this->email;
            case 'nexmo':
                return '+2' . $this->phone;
        }
    }

    public function add($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = Hash::make($data['password']);
        $this->user_id = Auth::id();
        $this->type = 2;
        return $this->save();
    }


    public function edit($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = isset($data['password']) ? Hash::make($data['password']) : $this->password;
        return $this->save();
    }


    public function getImageAttribute($value)
    {
        if ($value)
            return $value;

        return 'user-default.png';
    }

    public function getBannerAttribute($value)
    {
        if ($value)
            return $value;

        return 'photo1.png';
    }


    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getNameAttribute()
    {
        return $this->name ?? $this->first_name . ' ' . $this->last_name;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function designs(): HasMany
    {
        return $this->hasMany(UserDesign::class, 'user_id');
    }

    public function followers(): HasMany
    {
        return $this->hasMany(Follower::class, 'user_id');
    }

    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function url(): string
    {
        return route('users.show', $this->id);
    }

    public function images(): HasMany
    {
        return $this->hasMany(DesignImage::class);
    }

}
