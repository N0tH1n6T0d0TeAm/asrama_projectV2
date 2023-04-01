<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJK extends Model
{
    use HasFactory;
    protected $table = "detail_jk";
    protected $fillable = [
"id_jk","hari","dari","sampai
    "];
    public $timestamps = false;
}
