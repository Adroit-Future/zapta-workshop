<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function product(){
        return $this->hasOne(Product::class);
    }

    public function contact(){
        /** Params
         * 1st Related Model
         * 2nd ForeignId of the Realted Table that is connected to the current Table
         * 3rd local key of the current table
         */
        return $this->hasOne(Contact::class,'user_id','id');
    }


    public function posts(){
        /**
         * Define a one-to-many relationship.
         *
         * @param  string  $related
         * @param  string|null  $foreignKey
         * @param  string|null  $localKey
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->hasMany(Post::class,'user_id','id')->latest();
    }


    public function latestPost(){
        /**
         * Define a one-to-many relationship.
         *
         * @param  string  $related
         * @param  string|null  $foreignKey
         * @param  string|null  $localKey
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->hasOne(Product::class,'user_id','id')->ofMany(['qty'=>'max'],function($q){
            $q->where('id' ,'<',270);
        });
    }


    public function roles(){
        return $this->belongsToMany(Role::class,'role_users','users_id','role_id2')->as('user_roles')->withPivot('created_at');
    }


   
}
