<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'amount',
        'amount_paid',
        'customer_id',
        'due_on',
        'vat',
        'is_vat_inclusive',
        'payment_method'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
