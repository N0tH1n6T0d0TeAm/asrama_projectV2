<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingKonseling extends Model
{
    use HasFactory;
    protected $table="billing_konseling";
    protected $primary = "id_bk";
}
