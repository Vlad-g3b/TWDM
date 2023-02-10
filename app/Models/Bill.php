<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = "bills";
    protected $fillable = [
        'id',
        'name',
        'user_id',
        'address_id',
        'category_id',
        'period',
        'amount',
        'due_date',
        'is_paid',
        'date_paid',
        'amount_paid'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
