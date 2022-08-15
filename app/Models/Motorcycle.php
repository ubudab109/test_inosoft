<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Jenssegers\Mongodb\Eloquent\Model;

class Motorcycle extends Model
{
    use HasFactory;

    protected $collections = 'motorcycles';
    protected $fillable = [
        'machine',
        'suspension_type',
        'transmision_type',
        'qty'
    ];
    protected $hidden = ['updated_at','created_at'];


    
    /**
     * > This function returns a `MorphOne` relationship between the `User` model and the `Vehicle`
     * model
     * 
     * @return MorphOne A morphOne relationship.
     */
    public function vehicles() : MorphOne
    {
        return $this->morphOne(Vehicle::class, 'source');
    }


    /**
     * > This function returns a `MorphOne` relationship between the `Vehicle` model and the
     * `VehicleTransaction` model
     * 
     * @return MorphOne A morphOne relationship.
     */
    public function sales() : MorphOne
    {
        return $this->morphOne(VehicleTransaction::class, 'vehicles');
    }
}
