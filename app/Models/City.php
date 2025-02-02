<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{  
    protected $primaryKey = 'id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cidade';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nome',
        'estado',
    ];
}
