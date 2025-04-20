<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = FAQ::all();
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        FAQ::create($request->all());
        return redirect()->route('admin.faqs.index')->with('success', 'Soru başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FAQ $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FAQ $faq)
    {
        $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $faq->update($request->all());
        return redirect()->route('admin.faqs.index')->with('success', 'Soru başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'Soru başarıyla silindi.');
    }
}
