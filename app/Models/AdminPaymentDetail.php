<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'admin_payment_details'; // Correct table name
    protected $fillable = ['upi_id', 'bank_name', 'account_number', 'ifsc_code', 'qrpic'];
}
