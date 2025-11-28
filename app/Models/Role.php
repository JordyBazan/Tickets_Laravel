<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    // En tu DB antigua el campo se llama 'title', no 'name'
    protected $fillable = ['title', 'status']; 

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}