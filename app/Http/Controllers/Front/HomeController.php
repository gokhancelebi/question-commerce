<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

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
        // Validate the survey answers
        $validated = $request->validate([
            'question1' => 'required|integer|between:1,5',
            'question2' => 'required|integer|between:1,5',
            'question3' => 'required|integer|between:1,4',
            'question4' => 'required|integer|between:1,5',
            'question5' => 'required|integer|between:1,4',
        ]);

        // TODO: Implement the recommendation logic based on survey answers
        // For now, return a mock response
        $recommendation = [
            'main_product' => [
                'id' => 1,
                'name' => 'UltraBook Pro X15',
                'price' => 12999.99,
                'image' => 'https://public.readdy.ai/ai/img_res/40f576fd9d3d86c9800aae87faf61a0c.jpg',
                'specs' => '15.6" 4K, Intel Core i7, 16GB RAM, 1TB SSD'
            ],
            'similar_products' => [
                [
                    'id' => 2,
                    'name' => 'ProBook Elite 14',
                    'price' => 9499.99,
                    'image' => 'https://public.readdy.ai/ai/img_res/0f9912ba37ee3fbc9a4d3fb954871768.jpg',
                    'specs' => '14" FHD, Intel Core i5, 8GB RAM, 512GB SSD'
                ],
                [
                    'id' => 3,
                    'name' => 'UltraSlim 15',
                    'price' => 14299.99,
                    'image' => 'https://public.readdy.ai/ai/img_res/7d2f689eb2623d742ced67ca234f0dce.jpg',
                    'specs' => '15.6" 4K OLED, Intel Core i7, 16GB RAM, 1TB SSD'
                ],
                [
                    'id' => 4,
                    'name' => 'PowerBook Pro 16',
                    'price' => 16799.99,
                    'image' => 'https://public.readdy.ai/ai/img_res/cdb8a35fee12f29f01976897daf138aa.jpg',
                    'specs' => '16" QHD+, Intel Core i9, 32GB RAM, 2TB SSD'
                ]
            ]
        ];

        return response()->json($recommendation);
    }
}
