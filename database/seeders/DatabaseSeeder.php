<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;
use App\Models\Balance;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $category = Category::first();

        if (!$user || !$category) {
            $this->command->error('❌ Pastikan tabel users dan categories sudah berisi data.');
            return;
        }

        $transactions = [
            [
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Gaji Bulanan',
                'amount' => 3000000,
                'type' => 'income',
                'date' => Carbon::now()->subDays(10),
                'source' => 'PT. Maju Jaya',
                'description' => 'Pemasukan rutin setiap awal bulan.',
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Belanja Harian',
                'amount' => 150000,
                'type' => 'expense',
                'date' => Carbon::now()->subDays(9),
                'source' => 'Supermarket Setempat',
                'description' => 'Beli kebutuhan pokok dan sabun.',
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Proyek Freelance',
                'amount' => 500000,
                'type' => 'income',
                'date' => Carbon::now()->subDays(8),
                'source' => 'Fiverr',
                'description' => 'Desain logo untuk klien luar negeri.',
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Transportasi',
                'amount' => 80000,
                'type' => 'expense',
                'date' => Carbon::now()->subDays(6),
                'source' => 'Gojek',
                'description' => 'Pergi ke kantor dan pulang.',
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Jual Barang Bekas',
                'amount' => 200000,
                'type' => 'income',
                'date' => Carbon::now()->subDays(4),
                'source' => 'Marketplace Online',
                'description' => 'Jual earphone lama.',
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Makan di Luar',
                'amount' => 120000,
                'type' => 'expense',
                'date' => Carbon::now()->subDays(3),
                'source' => 'Warung Padang',
                'description' => 'Makan malam bersama teman.',
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Ngopi Bareng Teman',
                'amount' => 50000,
                'type' => 'expense',
                'date' => Carbon::now()->subDays(2),
                'source' => 'Kopi Kenangan',
                'description' => 'Hangout sore hari.',
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Bonus Kecil',
                'amount' => 100000,
                'type' => 'income',
                'date' => Carbon::now()->subDay(),
                'source' => 'Manajer Kantor',
                'description' => 'Bonus karena menyelesaikan proyek lebih cepat.',
            ],
            [
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Tagihan Internet',
                'amount' => 90000,
                'type' => 'expense',
                'date' => Carbon::now(),
                'source' => 'Indihome',
                'description' => 'Pembayaran bulanan internet rumah.',
            ],
        ];

        foreach ($transactions as $trx) {
            Transaction::create($trx);
        }

        $income = Transaction::where('user_id', $user->id)->where('type', 'income')->sum('amount');
        $expense = Transaction::where('user_id', $user->id)->where('type', 'expense')->sum('amount');
        $balance = $income - $expense;

        Balance::updateOrCreate(
            ['user_id' => $user->id],
            ['amount' => $balance]
        );

        // $user = User::first(); // pastikan ada user
        // $categories = ['Makanan dan Minuman', 'Transportasi', 'Kebutuhan', 'Hiburan', 'Lainnya'];

        // foreach ($categories as $c) {
        //     Category::create([
        //         'name' => $c,
        //         'user_id' => $user->id,
        //     ]);
        // }

        $this->command->info('✅ DatabaseSeeder berhasil membuat data transaksi lengkap & valid!');
    }
}
