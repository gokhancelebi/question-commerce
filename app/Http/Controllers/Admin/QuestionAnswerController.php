<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('answers')->orderBy('order')->paginate(10);
        return view('admin.question-answer.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $question = new Question();
        return view('admin.question-answer.edit', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'integer',
            'answers' => 'required|array|min:1',
            'answers.*.content' => 'required|string',
            'answers.*.order' => 'integer'
        ]);

        $question = Question::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_active' => $validated['is_active'] ?? true,
            'order' => $validated['order'] ?? 0
        ]);

        foreach ($validated['answers'] as $index => $answerData) {
            $question->answers()->create([
                'content' => $answerData['content'],
                'order' => $answerData['order'] ?? $index
            ]);
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Soru başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::with('answers')->findOrFail($id);
        return view('admin.question-answer.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question = Question::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'integer',
            'answers' => 'required|array|min:1',
            'answers.*.content' => 'required|string',
            'answers.*.order' => 'integer'
        ]);

        $question->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_active' => $validated['is_active'] ?? true,
            'order' => $validated['order'] ?? 0
        ]);

        // Delete existing answers
        $question->answers()->delete();

        // Create new answers
        foreach ($validated['answers'] as $index => $answerData) {
            $question->answers()->create([
                'content' => $answerData['content'],
                'order' => $answerData['order'] ?? $index
            ]);
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Soru başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('admin.questions.index')
            ->with('success', 'Soru başarıyla silindi.');
    }
}
