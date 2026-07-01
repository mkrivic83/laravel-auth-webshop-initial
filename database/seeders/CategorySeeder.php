<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'naziv' => 'Mobiteli',
                'opis' => 'Pametni telefoni i mobilni uređaji.',
            ],
            [
                'naziv' => 'Laptopi',
                'opis' => 'Prijenosna računala za rad, školu i gaming.',
            ],
            [
                'naziv' => 'Monitori',
                'opis' => 'Računalni monitori različitih veličina.',
            ],
            [
                'naziv' => 'Tipkovnice',
                'opis' => 'Žičane, bežične i gaming tipkovnice.',
            ],
            [
                'naziv' => 'Miševi',
                'opis' => 'Računalni miševi za ured i gaming.',
            ],
            [
                'naziv' => 'Slušalice',
                'opis' => 'Slušalice s mikrofonom i bez mikrofona.',
            ],
            [
                'naziv' => 'Printeri',
                'opis' => 'Laserski i tintni pisači.',
            ],
            [
                'naziv' => 'Tableti',
                'opis' => 'Tableti za zabavu, školu i posao.',
            ],
            [
                'naziv' => 'Komponente',
                'opis' => 'Procesori, memorije, diskovi i grafičke kartice.',
            ],
            [
                'naziv' => 'Dodaci',
                'opis' => 'Kablovi, punjači, torbe i ostala oprema.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
