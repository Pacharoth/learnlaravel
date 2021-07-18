<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Course extends Model
{
    use HasFactory;
    protected $fillable =[
        'topic_id',
        'user_id',
        'name',
        'description',
    ];

    //relation
    public function users(){
        return $this->hasMany('App\Models\User','uuid','user_id');
    }

    public function topic(){
        return $this->hasOne('App\Models\Topic','uuid','topic_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }
    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
