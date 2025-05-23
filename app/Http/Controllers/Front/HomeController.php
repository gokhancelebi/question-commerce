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

        // Get all selected answer IDs - current implementation is not extracting values correctly
        $selectedAnswerIds = collect($answers)->filter(function($value, $key) {
            return str_starts_with($key, 'question');
        })->values()->toArray();

        // Convert to actual integer IDs
        $answerIds = [];
        foreach ($selectedAnswerIds as $value) {
            $answerIds[] = (int) $value;
        }

        // Find product match with exact answer combination
        $productMatch = ProductMatch::where('is_active', true)
            ->with(['product', 'product.images'])
            ->whereJsonContains('answer_combinations', $answerIds)
            ->first();

        if (!$productMatch) {
            // Try to find a match by checking if all our answers are in any combination
            // This handles cases where the exact combination doesn't exist
            $productMatches = ProductMatch::where('is_active', true)
                ->with(['product', 'product.images'])
                ->get();

            foreach ($productMatches as $match) {
                $matchAnswers = $match->answer_combinations;
                $allFound = true;

                foreach ($answerIds as $answerId) {
                    if (!in_array($answerId, $matchAnswers)) {
                        $allFound = false;
                        break;
                    }
                }

                if ($allFound) {
                    $productMatch = $match;
                    break;
                }
            }
        }

        if ($productMatch && $productMatch->product) {
            $product = $productMatch->product;
            $matchingProduct = [
                'id' => $product->id,
                'name' => $product->title,
                'description' => $product->description,
                'image' => $product->featured_image ? asset($product->featured_image) :
                    ($product->images->first() ? asset($product->images->first()->image_path) : null),
                'external_url' => $product->external_url,
            ];

            // Only include price if there's no external URL
            if (!$product->external_url) {
                $matchingProduct['price'] = $product->price;
            }

            return response()->json([
                'success' => true,
                'products' => [$matchingProduct]
            ]);
        }

        // Return "no match found" response instead of random product
        return response()->json([
            'success' => false,
            'message' => 'Üzgünüz, seçtiğiniz kriterlere uygun bir ürün bulamadık. Lütfen farklı seçenekler deneyin.',
            'products' => []
        ]);
    }
}
