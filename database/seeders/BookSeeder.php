<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'category_id' => 1, // Pâtisserie Française
            'title' => 'L\'art de la pâtisserie',
            'author' => 'Pierre Hermé',
            'quantity' => 5,
            'damaged_quantity' => 1,
        ]);

        Book::create([
            'category_id' => 3, // Végétarien
            'title' => 'Légumes gourmands',
            'author' => 'Yotam Ottolenghi',
            'quantity' => 3,
            'damaged_quantity' => 0,
        ]);
    }
}
