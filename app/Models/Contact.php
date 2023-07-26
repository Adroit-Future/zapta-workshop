<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;



    public function user(){
         /**
         * Define an inverse one-to-one or many relationship.
         *
         * @param  string  $related
         * @param  string|null  $foreignKey
         * @param  string|null  $ownerKey
         * @param  string|null  $relation
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(User::class,'user_id','id');
    }
}
