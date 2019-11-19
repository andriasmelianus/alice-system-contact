<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model City
 */
class City extends Model {

    /**
     * Fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'altitude',
    ];
}
