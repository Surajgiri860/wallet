<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestTransaction extends Model
{
    use HasFactory;

    // Define the table name (if it's not the plural form of the model name)
    protected $table = 'Request_transaction'; 

    // Define fillable fields (for mass assignment)
    protected $fillable = [
        'user_id',
        'request_amount',
        'type',       // 1 = Deposit, 2 = Withdraw
        'utr_number',
        'request_status',
    ];
    
    // Define timestamps if necessary (defaults to true)
    public $timestamps = true;

    // Additional methods or relationships can be added here

            public function user()
        {
            return $this->belongsTo(User::class, 'user_id'); 
        }

}

