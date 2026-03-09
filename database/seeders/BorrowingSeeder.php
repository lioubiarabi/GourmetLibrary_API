<?php

namespace Database\Seeders;

use App\Models\Borrowing;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BorrowingSeeder extends Seeder
{
    public function run(): void
    {
        Borrowing::create([
            'user_id' => 2,
            'book_id' => 1,
            'returned_at' => null,
            'created_at' => Carbon::now()->subDays(5),
            'updated_at' => Carbon::now()->subDays(5),
        ]);

        Borrowing::create([
            'user_id' => 2,
            'book_id' => 2,
            'returned_at' => Carbon::now()->subDays(2),
            'created_at' => Carbon::now()->subDays(10),
            'updated_at' => Carbon::now()->subDays(2),
        ]);
    }
}
