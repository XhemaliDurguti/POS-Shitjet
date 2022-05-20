<?php

namespace App\Models\Models;

use App\Models\Models\Payment;
use App\Models\Models\Customer;
use App\Models\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id'
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function getCustomerName()
    {
        if($this->customer){
            return $this->customer->first_name.' '.$this->customer->last_name;
        }
        return 'Walking Customer';
    }
    
    public function total(){
        return $this->items->map(function($i){
            return $i->price;
        })->sum();
    }
    public function formattedTotal(){
        return number_format($this->total(),2);
    }

    public function recivedAmount(){
        return $this->payments->map(function($i){
            return $i->amount;
        })->sum();
    }
    public function formattedRecivedAmount(){
        return number_format($this->recivedAmount(),2);
    }
}
