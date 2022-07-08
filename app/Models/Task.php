<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','day','percent','user_id','job_id','status'];
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Job()
    {
        return $this->belongsTo(Job::class);
    }

}
