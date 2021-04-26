<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomValue;

class CustomValue extends Model
{
    protected $table = 'custom_values'; 
    protected $primaryKey = 'value_id';
}
