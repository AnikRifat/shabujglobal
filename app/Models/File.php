<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = ['application_id', 'file'];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
