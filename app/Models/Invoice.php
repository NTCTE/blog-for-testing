<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'bank_uuid',
        'status',
        'cart',
        'payable_id',
        'payable_type',
    ];

    protected $casts = [
        'cart' => 'array',
    ];

    static $statuses = [
        'payment' => 'Оплачивается',
        'paid' => 'Оплачен',
        'error' => 'Ошибка',
        'refund' => 'Возврат',
    ];

    // Getters
    public function user()
    {
        return $this -> belongsTo(User::class, 'user_id');
    }

    public function payable()
    {
        return $this -> morphTo();
    }
}
