<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\Bank;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Customer::truncate();
        
        User::create([
            'name' => 'admin1',
            'email' => 'admin1@dianca.id',
            'password' => 'asdasdasd'
        ]);

        $customers = [
            [
                'name' => 'cust verif',
                'email' => 'butsherlock@gmail.com',
                'password' => Hash::make('asdasdasd'),
                'phone_number' => '123123123',
            ],
            [
                'name' => 'Rizal Adam',
                'email' => 'rizaladam@gmail.com',
                'password' => Hash::make('asdasdasd'),
                'phone_number' => '123123123',
            ],
            [
                'name' => 'Afia Hana',
                'email' => 'afia@gmail.com',
                'password' => Hash::make('asdasdasd'),
                'phone_number' => '123123123',
            ],
            [
                'name' => 'Reva',
                'email' => 'reva@gmail.com',
                'password' => Hash::make('asdasdasd'),
                'phone_number' => '123123123',
            ],
        ];

        Customer::insert($customers);
        
    }
}
