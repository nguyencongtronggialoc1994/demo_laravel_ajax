<?php
namespace App\Repositories\Impl;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Repositories\Eloquent\EloquentRepository;

class CustomerRepositoryImpl extends EloquentRepository implements CustomerRepository
{

    public function getModel()
    {
        $model = Customer::class;
        return $model;
    }
}
