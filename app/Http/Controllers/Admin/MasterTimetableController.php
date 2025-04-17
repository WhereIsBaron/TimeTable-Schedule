<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterTimetable;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MasterTimetableController extends Controller
{
    /**
     * Display a listing of the master timetables.
     */
    public function index()
    {
        $masterTimetables = MasterTimetable::with('faculty')->orderBy('title')->paginate(10);
        return view('admin.master_timetables.index', compact('masterTimetables'));
    }

    /**
     * Show the form for creating a new master timetable.
     */
    public function create()
    {
        $facultyAdmins = User::where('is_faculty_admin', true)->get();
        return view('admin.master_timetables.create', compact('facultyAdmins'));
    }

    /**
     * Store a newly created master timetable in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'faculty_admin_id' => 'required|exists:users,id',
            'class_codes' => 'nullable|array',
            'class_codes.*' => 'string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $masterTimetable = MasterTimetable::create([
                'title' => $request->title,
                'description' => $request->description,
                'faculty_admin_id' => $request->faculty_admin_id,
            ]);

            // Save class codes in pivot table
            if ($request->filled('class_codes')) {
                foreach ($request->class_codes as $code) {
                    DB::table('faculty_class_code')->insert([
                        'faculty_admin_id' => $request->faculty_admin_id,
                        'class_code' => $code,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });

        return redirect()->route('admin.master_timetables.index')->with('success', 'Master Timetable created successfully.');
    }

    /**
     * Show the form for editing the specified master timetable.
     */
    public function edit($id)
    {
        $masterTimetable = MasterTimetable::findOrFail($id);
        $facultyAdmins = User::where('is_faculty_admin', true)->get();

        $assignedClassCodes = DB::table('faculty_class_code')
            ->where('faculty_admin_id', $masterTimetable->faculty_admin_id)
            ->pluck('class_code')
            ->toArray();

        return view('admin.master_timetables.edit', compact('masterTimetable', 'facultyAdmins', 'assignedClassCodes'));
    }

    /**
     * Update the specified master timetable in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'faculty_admin_id' => 'required|exists:users,id',
            'class_codes' => 'nullable|array',
            'class_codes.*' => 'string|max:255',
        ]);

        DB::transaction(function () use ($request, $id) {
            $masterTimetable = MasterTimetable::findOrFail($id);

            $masterTimetable->update([
                'title' => $request->title,
                'description' => $request->description,
                'faculty_admin_id' => $request->faculty_admin_id,
            ]);

            // Clear old class code assignments
            DB::table('faculty_class_code')
                ->where('faculty_admin_id', $request->faculty_admin_id)
                ->delete();

            // Insert new ones
            if ($request->filled('class_codes')) {
                foreach ($request->class_codes as $code) {
                    DB::table('faculty_class_code')->insert([
                        'faculty_admin_id' => $request->faculty_admin_id,
                        'class_code' => $code,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });

        return redirect()->route('admin.master_timetables.index')->with('success', 'Master Timetable updated successfully.');
    }

    /**
     * Remove the specified master timetable from storage.
     */
    public function destroy($id)
    {
        $masterTimetable = MasterTimetable::findOrFail($id);

        DB::transaction(function () use ($masterTimetable) {
            DB::table('faculty_class_code')
                ->where('faculty_admin_id', $masterTimetable->faculty_admin_id)
                ->delete();

            $masterTimetable->delete();
        });

        return redirect()->route('admin.master_timetables.index')->with('success', 'Master Timetable deleted successfully.');
    }
}
