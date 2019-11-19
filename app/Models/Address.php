<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Address
 */
class Address extends Model {

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
