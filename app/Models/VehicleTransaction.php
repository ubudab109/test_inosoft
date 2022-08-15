<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;

class VehicleTransaction extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $primaryKey = '_id';
    protected $collections = 'vehicle_transactions';
    protected $fillable = [
        'vehicle_id',
        'qty',
    ];
    protected $dates = ['created_at','updated_at'];
    protected $appends = ['total_price'];

    /**
     * > This function returns a relationship between the `Vehicle` model and the `VehicleImage` model
     * 
     * @return BelongsTo A BelongsTo relationship
     */
    public function vehicle() : BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', '_id');
    }

    public function getTotalPriceAttribute()
    {
        return $this->qty * $this->vehicle->price;
    }
}
