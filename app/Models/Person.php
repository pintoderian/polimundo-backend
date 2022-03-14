<?php

namespace App\Models;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = [
        'email',
        'name',
        'last_name',
    ];

    public function resource()
    {
      return $this->hasOne(Resource::class, 'person_id');
    }
}
