<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Customer $customer) {
            if ($customer->username) {
                $user = User::where('username', $customer->username)->first();
                if (!$user) {
                    $user = new User();
                    $user->name = $customer->first_name;
                    $user->fill($customer->toArray());
                    $user->save();
                }
                $customer->user_id = $user->id;
            }
        });


        static::updating(function (Customer $customer) {
            $user = $customer->user;

            if ($user) {
                $user->fill($customer->toArray());
                $user->save();
            }

            $customer->save();
        });
    }


    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'username',
        'email',
        'phoneNumber',
        'status',
        'password',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function syncUsernameWithUser(User $user)
    {
        $this->username = $user->username;

        if ($this->phoneNumber) {
            $user->phoneNumber = $this->phoneNumber;
        }

        $this->save();
        $user->save();
    }


}
