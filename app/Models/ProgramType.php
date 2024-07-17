<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramType extends Model
{
    use HasFactory;

    protected $table = 'program_type';

    protected $fillable = [
        'userid',
        'name',
        'control_number',
        'program',
        'disability',
        'address',
        'status',
        'reason'
    ];

    public function Program() {
        return $this->hasOne(Program::class, 'id', 'program');
    }

    public function Beneficiary() {
        return $this->hasOne(Beneficiary::class, 'id', 'userid');
    }

    public function Payroll() {
        return $this->hasOne(Payroll::class, 'programtype_id', 'id');
    }
}
