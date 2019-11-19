<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Country
 */
class Country extends Model {

    /**
     * Fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'iso_code',
    ];
}
