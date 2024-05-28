<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Subtotal;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new Subtotal);
    }

    public function scopeBetweenDate($query, $startDate = null, $endDate = null)
    {
        if(is_null($startDate) && is_null($endDate)){ 
             return $query;
        }

        if(!is_null($startDate) && is_null($endDate)){
             return $query->where('created_at', ">=", $startDate);
        }

        if(is_null($startDate) && !is_null($endDate)){
            $endDateAdd1Days = Carbon::parse($endDate)->addDays(1);
            return $query->where('created_at', '<=', $endDateAdd1Days);
        }

        if(!is_null($startDate) && !is_null($endDate)){
            $endDateAdd1Days = Carbon::parse($endDate)->addDays(1);

            return $query->where('created_at', ">=", $startDate)
            ->where('created_at', '<=', $endDateAdd1Days);
        }
    }
}
