<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    public function users(){
        return $this->belongsToMany(User::class);


    //         $paginator = User: :paginate(columns: ['id');
    // $redirectToPage = (Srequest->pale <= $paginator->LastPage())
    //     ? $request->page
    //      : $paginator->lastPage(); :
//  return redirect()->route( route: 'users. index', ['page' => $redirectToPage]);
    }
}


