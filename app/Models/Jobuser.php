<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobuser extends Model
{
    use HasFactory;
    protected $fillable = ['job_id','user_id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
