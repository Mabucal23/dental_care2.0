<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'contact_number',
        'email',
        'appointment_date',
        'address',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // 'user_id' is the foreign key
    }
}
