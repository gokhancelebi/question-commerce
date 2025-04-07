<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Product;
use App\Models\ProductMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Display the home page with survey
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $questions = Question::with('answers')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('fromt.home', compact('questions'));
    }

    /**
     * Process survey answers and return product recommendations
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function processSurvey(Request $request)
    {
        $answers = $request->all();

        // Get all selected answer IDs
        $selectedAnswerIds = collect($answers)->filter(function($value, $key) {
            return str_starts_with($key, 'question');
        })->values()->toArray();

        // Find product matches that have these answers
        $productMatches = ProductMatch::whereJsonContains('answer_combinations', $selectedAnswerIds)
            ->with(['product', 'product.images'])
            ->get();

        $matchingProducts = collect();

        if ($productMatches->isNotEmpty()) {
            // Transform product matches into a format suitable for frontend
            $matchingProducts = $productMatches->map(function($match) {
                $product = $match->product;
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'description' => $product->description,
                    'image' => $product->images->first() ? asset($product->images->first()->image_path) : null,
                    'external_url' => $product->external_url,
                ];
            });
        }

        // If no matches found, return some default products
        if ($matchingProducts->isEmpty()) {
            $defaultProducts = Product::with('images')
                ->inRandomOrder()
                ->limit(3)
                ->get();

            $matchingProducts = $defaultProducts->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'description' => $product->description,
                    'image' => $product->images->first() ? asset($product->images->first()->image_path) : null,
                    'external_url' => $product->external_url,
                ];
            });
        }

        return response()->json([
            'success' => true,
            'products' => $matchingProducts->toArray()
        ]);
    }
}
