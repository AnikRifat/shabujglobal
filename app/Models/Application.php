<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['subject', 'description', 'status', 'user_id'];

    public function files()
    {
        return $this->hasMany(File::class, 'application_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
