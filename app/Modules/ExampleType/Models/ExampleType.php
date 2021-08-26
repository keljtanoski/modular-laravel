<?php

namespace App\Modules\ExampleType\Models;

use App\Modules\Core\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExampleType extends Model
{
    use HasFactory, Filterable;

    /**
     * @var string
     */
    protected $table = 'example_types';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'is_active',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    | These are the relationships defined for this model
    |
    */
}
