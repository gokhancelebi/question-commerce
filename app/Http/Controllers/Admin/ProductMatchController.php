<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Product;
use App\Models\ProductMatch;
use App\Models\Question;
use Illuminate\Http\Request;

class ProductMatchController extends Controller
{
    public function index()
    {
        $productMatches = ProductMatch::with(['product'])->paginate(10);
        $totalCombinations = $this->calculateTotalCombinations();
        $existingCombinations = ProductMatch::count();

        return view('admin.product-match.index', compact('productMatches', 'totalCombinations', 'existingCombinations'));
    }

    public function create()
    {
        $products = Product::all();
        $questions = Question::with('answers')->orderBy('order')->get();
        $productMatch = new ProductMatch();

        return view('admin.product-match.edit', compact('products', 'questions', 'productMatch'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'answer_combinations' => 'required|array',
            'answer_combinations.*' => 'required|exists:answers,id',
            'is_active' => 'boolean'
        ]);

        // Extract and convert answer IDs to integers
        $answerIds = collect($validated['answer_combinations'])
            ->map(fn($id) => (int) $id)
            ->values()
            ->all();

        ProductMatch::create([
            'product_id' => $validated['product_id'],
            'answer_combinations' => $answerIds,
            'is_active' => $validated['is_active'] ?? true
        ]);

        return redirect()->route('admin.product-matches.index')
            ->with('success', 'Ürün eşleştirmesi başarıyla oluşturuldu.');
    }

    public function edit(string $id)
    {
        $productMatch = ProductMatch::findOrFail($id);
        $products = Product::all();
        $questions = Question::with('answers')->orderBy('order')->get();

        return view('admin.product-match.edit', compact('productMatch', 'products', 'questions'));
    }

    public function update(Request $request, string $id)
    {
        $productMatch = ProductMatch::findOrFail($id);

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'answer_combinations' => 'required|array',
            'answer_combinations.*' => 'required|exists:answers,id',
            'is_active' => 'boolean'
        ]);

        // Extract and convert answer IDs to integers
        $answerIds = collect($validated['answer_combinations'])
            ->map(fn($id) => (int) $id)
            ->values()
            ->all();

        $productMatch->update([
            'product_id' => $validated['product_id'],
            'answer_combinations' => $answerIds,
            'is_active' => $validated['is_active'] ?? true
        ]);

        return redirect()->route('admin.product-matches.index')
            ->with('success', 'Ürün eşleştirmesi başarıyla güncellendi.');
    }

    public function destroy(string $id)
    {
        $productMatch = ProductMatch::findOrFail($id);
        $productMatch->delete();

        return redirect()->route('admin.product-matches.index')
            ->with('success', 'Ürün eşleştirmesi başarıyla silindi.');
    }

    /**
     * Delete all product matches
     */
    public function resetMatches()
    {
        // Delete all existing matches
        ProductMatch::truncate();

        return redirect()->route('admin.product-matches.index')
            ->with('success', 'Tüm ürün eşleştirmeleri başarıyla silindi.');
    }

    public function generateCombinations()
    {
        // Get all questions with their answers
        $questions = Question::with('answers')->orderBy('order')->get();

        // Get available products
        $products = Product::all();

        if ($products->isEmpty()) {
            return redirect()->route('admin.product-matches.index')
                ->with('error', 'Önce ürün eklemelisiniz.');
        }

        // Generate all possible combinations
        $combinations = $this->generateAllCombinations($questions);

        // Delete existing combinations
        ProductMatch::truncate();

        // Create new combinations
        foreach ($combinations as $index => $combination) {
            // Assign products in a round-robin fashion
            $productIndex = $index % $products->count();

            ProductMatch::create([
                'product_id' => $products[$productIndex]->id,
                'answer_combinations' => $combination,
                'is_active' => true
            ]);
        }

        return redirect()->route('admin.product-matches.index')
            ->with('success', count($combinations) . ' adet kombinasyon başarıyla oluşturuldu.');
    }

    private function generateAllCombinations($questions)
    {
        $combinations = [[]];

        foreach ($questions as $question) {
            $temp = [];
            foreach ($combinations as $combination) {
                foreach ($question->answers as $answer) {
                    $temp[] = array_merge($combination, [$answer->id]);
                }
            }
            $combinations = $temp;
        }

        return $combinations;
    }

    private function calculateTotalCombinations()
    {
        $total = 1;
        $questions = Question::with('answers')->get();

        foreach ($questions as $question) {
            $answerCount = $question->answers->count();
            if ($answerCount > 0) {
                $total *= $answerCount;
            }
        }

        return $total;
    }
}
