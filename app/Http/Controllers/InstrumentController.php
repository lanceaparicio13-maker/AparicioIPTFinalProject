<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function index()
    {
        $instruments = Instrument::withCount('courses')
            ->latest()
            ->paginate(10);

        return view('instruments.index', compact('instruments'));
    }

    public function create()
    {
        return view('instruments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'condition' => ['required', 'in:Excellent,Good,Fair,Needs Repair'],
            'quantity' => ['required', 'integer', 'min:0', 'max:10000'],
            'availability' => ['required', 'in:Available,Unavailable,Maintenance'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        Instrument::create($validated);

        return redirect()->route('instruments.index')
            ->with('success', 'Instrument added successfully.');
    }

    public function show(Instrument $instrument)
    {
        $instrument->load('courses');

        return view('instruments.show', compact('instrument'));
    }

    public function edit(Instrument $instrument)
    {
        return view('instruments.edit', compact('instrument'));
    }

    public function update(Request $request, Instrument $instrument)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'condition' => ['required', 'in:Excellent,Good,Fair,Needs Repair'],
            'quantity' => ['required', 'integer', 'min:0', 'max:10000'],
            'availability' => ['required', 'in:Available,Unavailable,Maintenance'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        $instrument->update($validated);

        return redirect()->route('instruments.index')
            ->with('success', 'Instrument updated successfully.');
    }

    public function destroy(Instrument $instrument)
    {
        $instrument->delete();

        return redirect()->route('instruments.index')
            ->with('success', 'Instrument deleted successfully.');
    }
}
