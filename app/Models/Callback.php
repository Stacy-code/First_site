<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Callback extends Model
{
    use HasFactory;



    protected $table='callback'; //назва таблицы

    public $timestamps = false;
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'content',
        'confirmed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected function confirm($id){
        $result = false;
        $item = Callback::find($id);
        if ($item instanceof Callback) {
            $item->confirmed = true;
            $item->save();
            $result = true;
        }
        return $result;
    }
}
