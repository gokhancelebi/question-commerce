<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Product;
use App\Models\ProductMatch;
use App\Models\Question;
use Illuminate\Database\Seeder;

class ProductMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first 5 questions
        $questions = Question::with('answers')->orderBy('order')->take(5)->get();
        
        // Get first 10 products
        $products = Product::take(10)->get();
        
        if ($questions->count() < 5 || $products->count() < 10) {
            return;
        }

        // Create some sample combinations
        $combinations = [
            // Combination 1
            [
                $questions[0]->answers->first()->id,
                $questions[1]->answers->first()->id,
                $questions[2]->answers->first()->id,
                $questions[3]->answers->first()->id,
                $questions[4]->answers->first()->id,
            ],
            // Combination 2
            [
                $questions[0]->answers->last()->id,
                $questions[1]->answers->last()->id,
                $questions[2]->answers->last()->id,
                $questions[3]->answers->last()->id,
                $questions[4]->answers->last()->id,
            ],
            // Combination 3 (mixed)
            [
                $questions[0]->answers->first()->id,
                $questions[1]->answers->last()->id,
                $questions[2]->answers->first()->id,
                $questions[3]->answers->last()->id,
                $questions[4]->answers->first()->id,
            ],
        ];

        foreach ($combinations as $index => $combination) {
            ProductMatch::create([
                'product_id' => $products[$index]->id,
                'answer_combinations' => $combination,
                'is_active' => true
            ]);
        }
    }
}
