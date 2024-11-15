<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scorer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team',
        'goals',
        'position',
        'assists',
        'birthdate',
        'nationality',
    ];
}
