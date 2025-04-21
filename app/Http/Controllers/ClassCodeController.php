<?php

namespace App\Http\Controllers;

use App\Models\ClassCode;
use Illuminate\Http\Request;

class ClassCodeController extends Controller
{
    /**
     * Display a listing of the class codes.
     */
    public function index()
    {
        $classCodes = ClassCode::orderBy('code')->paginate(10);
        return view('admin.class_codes.index', compact('classCodes'));
    }

    /**
     * Show the form for creating a new class code.
     */
    public function create()
    {
        return view('admin.class_codes.create');
    }

    /**
     * Store a newly created class code in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:class_codes,code',
            'description' => 'nullable|string|max:255',
        ]);

        ClassCode::create($validated);

        return redirect()->route('admin.class_codes.index')->with('success', 'Class code created successfully.');
    }

    /**
     * Show the form for editing the specified class code.
     */
    public function edit(ClassCode $classCode)
    {
        return view('admin.class_codes.edit', compact('classCode'));
    }

    /**
     * Update the specified class code in storage.
     */
    public function update(Request $request, ClassCode $classCode)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:class_codes,code,' . $classCode->id,
            'description' => 'nullable|string|max:255',
        ]);

        $classCode->update($validated);

        return redirect()->route('admin.class_codes.index')->with('success', 'Class code updated successfully.');
    }

    /**
     * Remove the specified class code from storage.
     */
    public function destroy(ClassCode $classCode)
    {
        $classCode->delete();

        return redirect()->route('admin.class_codes.index')->with('success', 'Class code deleted successfully.');
    }
}
