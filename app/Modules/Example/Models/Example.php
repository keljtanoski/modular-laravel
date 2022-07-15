<?php

namespace App\Modules\Example\Models;

use App\Modules\Core\Traits\Filterable;
use App\Modules\ExampleType\Models\ExampleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Example extends Model
{
    use HasFactory, Filterable;

    /**
     * @var string
     */
    protected $table = 'examples';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'example_type_id',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    | These are the relationships defined for this model
    |
    */

    /**
     * @return BelongsTo
     */
    public function example_type(): BelongsTo
    {
        return $this->belongsTo(ExampleType::class);
    }

}
