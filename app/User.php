<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   
        # code...
      /**
         * Get all of the comments for the User
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function Orders()
        {
            return $this->hasMany(Orders::class);
        }
        
        public function cart()
        {
            return $this->hasOne(Cart::class);
        }

        public function shipping()
        {
            # code...

            return $this->hasOne(Shipping::class);
        }
}
