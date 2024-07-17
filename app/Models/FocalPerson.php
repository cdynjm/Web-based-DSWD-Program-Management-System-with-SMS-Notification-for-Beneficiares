<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FocalPerson extends Model
{
    use HasFactory;

    protected $table = 'focal_persons';

    protected $fillable = [
        'name',
        'address',
        'contact_number'
    ];

    public function Program() {
        return $this->hasOne(Program::class, 'focal_person', 'id');
    }
    public function User() {
        return $this->hasOne(User::class, 'userid', 'id');
    }
}
