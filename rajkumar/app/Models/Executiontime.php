<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Executiontime extends Model
{
    use HasFactory;
    $fillable=['FirstName', 'LastName', 'ExecutionTime']; 
}
