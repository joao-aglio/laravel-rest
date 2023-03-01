<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveBook extends Model
{
    protected $table = 'reserves_books';
    protected $guarded = ['id'];
    use HasFactory;
}
