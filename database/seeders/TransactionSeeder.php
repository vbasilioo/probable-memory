<?php

namespace Database\Seeders;

use App\Models\Wallet\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'price' => 50.00,
        ]);
    }
}
