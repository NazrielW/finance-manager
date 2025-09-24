<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // $userId = 1; // sesuaikan dengan user_id yang ada

        // Transaction::insert([
        //     [
        //         'user_id' => $userId,
        //         'type' => 'pengeluaran',
        //         'amount' => 15000,
        //         'description' => 'Beli roti',
        //         'source' => 'Alfamart',
        //         'date' => Carbon::today(),
        //         'category_id' => null,
        //     ],
        //     [
        //         'user_id' => $userId,
        //         'type' => 'pengeluaran',
        //         'amount' => 10000,
        //         'description' => 'Beli minuman',
        //         'source' => 'Alfamart',
        //         'date' => Carbon::today(),
        //         'category_id' => 'Makanan dan Minuman',
        //     ],
        //     [
        //         'user_id' => $userId,
        //         'type' => 'pengeluaran',
        //         'amount' => 50000,
        //         'description' => 'Beli charger',
        //         'source' => 'Shopee',
        //         'date' => Carbon::today(),
        //         'category_id' => 'Kebutuhan',
        //     ],
        //     [
        //         'user_id' => $userId,
        //         'type' => 'pengeluaran',
        //         'amount' => 20000,
        //         'description' => 'Sayur',
        //         'source' => 'Pasar',
        //         'date' => Carbon::yesterday(),
        //         'category_id' => 'Makanan dan Minuman',
        //     ],
        // ]);

        $categories = ['Makanan dan Minuman', 'Transportasi', 'Kebutuhan', 'Hiburan', 'Lainnya'];
        foreach($categories as $c){
            Category::create(['name' => $c]);
        }
    }
}