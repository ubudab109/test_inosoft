<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsToMany;
use Jenssegers\Mongodb\Relations\HasMany;
use Jenssegers\Mongodb\Relations\MorphTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $collections = 'vehicles';
    protected $primaryKey = '_id';
    protected $fillable = [
        'source_type',
        'source_id',
        'color',
        'price',
        'years',
    ];

    /**
     * > This function returns the type of vehicle that is associated with the current instance of the
     * `Vehicle` model
     * 
     * @return MorphTo A polymorphic relationship.
     */
    public function vehicles() : MorphTo
    {
        return $this->morphTo('source');
    }

    public function sales() : BelongsToMany
    {
        return $this->belongsToMany(VehicleTransaction::class);
    }
}
