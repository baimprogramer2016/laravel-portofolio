<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urs extends Model
{
    use HasFactory;
    protected $fillable = ['job_id','user_id','title','body'];

}
