<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timetable;
use Illuminate\Support\Facades\Response;

class TimetableController extends Controller
{
    public function index()
    {
        $timetables = Timetable::orderBy('class_code')->paginate(10);
        return view('admin.timetables.TimetableManagement', compact('timetables'));
    }

    public function create()
    {
        return view('admin.timetables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_code' => 'required|string|max:255',
            'instructor_name' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'day_of_week' => 'required|string|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Timetable::create($request->all());

        return redirect()->route('admin.timetables.index')->with('success', 'Timetable created successfully.');
    }

    public function edit(Timetable $timetable)
    {
        return view('admin.timetables.edit', compact('timetable'));
    }

    public function update(Request $request, Timetable $timetable)
    {
        $request->validate([
            'class_code' => 'required|string|max:255',
            'instructor_name' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'day_of_week' => 'required|string|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $timetable->update($request->all());

        return redirect()->route('admin.timetables.index')->with('success', 'Timetable updated successfully.');
    }

    public function destroy(Timetable $timetable)
    {
        $timetable->delete();

        return redirect()->route('admin.timetables.index')->with('success', 'Timetable deleted successfully.');
    }

    public function exportCsv()
    {
        $timetables = Timetable::orderBy('class_code')->get();
        $filename = "timetables.csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($timetables) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ["Class Code", "Instructor", "Room", "Day", "Start Time", "End Time"]);

            foreach ($timetables as $row) {
                fputcsv($handle, [
                    $row->class_code,
                    $row->instructor_name,
                    $row->room,
                    $row->day_of_week,
                    $row->start_time,
                    $row->end_time,
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }
}
