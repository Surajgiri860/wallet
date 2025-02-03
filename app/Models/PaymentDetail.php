<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'payment_details'; // Table name from migration

    protected $fillable = [
        'user_id', 'account_number', 'ifsc_code', 'bank_name', 'upi_id'
    ];

    // PaymentDetails को User से कनेक्ट करना
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

