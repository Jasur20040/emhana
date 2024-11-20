<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaketShrift extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function shrift()
    {
        return $this->belongsTo(Shrift::class);
    }
}
