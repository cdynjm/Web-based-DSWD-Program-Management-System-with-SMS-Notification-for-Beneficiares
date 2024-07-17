<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $table = 'beneficiary';

    protected $fillable = [
        'id',
        'name',
        'gender',
        'contact_number',
        'address',
        'birthdate'
    ];

    public function Address() {
        return $this->hasOne(Barangay::class, 'id', 'address');
    }

    public function ProgramType() {
        return $this->hasOne(ProgramType::class, 'userid', 'id');
    }
    public function User() {
        return $this->hasOne(User::class, 'userid', 'id');
    }

}
