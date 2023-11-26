<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model

{
    protected $fillable = ['subject', 'description', 'status', 'user_id'];

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
