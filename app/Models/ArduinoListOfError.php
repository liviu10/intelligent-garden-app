<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArduinoListOfError extends Model
{
    use HasFactory;
    protected $table = 'arduino_list_of_errors';
    protected $fillable = [
        'error_code',
        'error_description',
        'error_notes'
    ];
}
