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

        return view('front.home', compact('questions'));
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

        // Find product match that has these answers
        $productMatch = ProductMatch::whereJsonContains('answer_combinations', $selectedAnswerIds)
            ->with(['product', 'product.images'])
            ->first();

        if ($productMatch && $productMatch->product) {
            $product = $productMatch->product;
            $matchingProduct = [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->price,
                'description' => $product->description,
                'image' => $product->featured_image ? asset($product->featured_image) :
                    ($product->images->first() ? asset($product->images->first()->image_path) : null),
                'external_url' => $product->external_url,
            ];

            return response()->json([
                'success' => true,
                'products' => [$matchingProduct]
            ]);
        }

        // If no match found, return a random product as fallback
        $randomProduct = Product::with('images')
            ->inRandomOrder()
            ->first();

        if ($randomProduct) {
            return response()->json([
                'success' => true,
                'products' => [[
                    'id' => $randomProduct->id,
                    'name' => $randomProduct->title,
                    'price' => $randomProduct->price,
                    'description' => $randomProduct->description,
                    'image' => $randomProduct->featured_image ? asset($randomProduct->featured_image) :
                        ($randomProduct->images->first() ? asset($randomProduct->images->first()->image_path) : null),
                    'external_url' => $randomProduct->external_url,
                ]]
            ]);
        }

        return response()->json([
            'success' => false,
            'products' => []
        ]);
    }
}
