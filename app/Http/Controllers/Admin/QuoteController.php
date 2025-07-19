<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuoteRequest;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::latest()->paginate(20);
        return view('admin.quotes.index', compact('quotes'));
    }

    public function create()
    {
        return view('admin.quotes.create');
    }

    public function store(StoreQuoteRequest $request)
    {
        Quote::create($request->validated());
        return redirect()->route('admin.quotes.index')->with('success', 'Quote added successfully.');
    }

    public function show(Quote $quote)
    {
        return view('admin.quotes.show', compact('quote'));
    }

    public function edit(Quote $quote)
    {
        return view('admin.quotes.edit', compact('quote'));
    }

    public function update(StoreQuoteRequest $request, Quote $quote)
    {
        $quote->update($request->validated());
        return redirect()->route('admin.quotes.index')->with('success', 'Quote updated successfully.');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return redirect()->route('admin.quotes.index')->with('success', 'Quote deleted successfully.');
    }
}
