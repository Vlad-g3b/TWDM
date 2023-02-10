<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'bill_categories';
    protected $fillable = ['id','name','user_id'];

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
