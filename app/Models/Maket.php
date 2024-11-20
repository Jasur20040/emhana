<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maket extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    
    public function shrifts()
    {
        return $this->belongsToMany(Shrift::class, 'maket_shrifts', 'maket_id', 'shrift_id');
    }
}
