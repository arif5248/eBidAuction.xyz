<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPackage extends Model
{
    public function customer_package_payments()
    {
        return $this->hasMany(CustomerPackagePayment::class);
    }
}
