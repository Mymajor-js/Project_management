<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function create()
    {
        return view('partials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'position' => 'nullable|string|max:100',
        ]);

        Teacher::create($request->only(['name', 'position']));

        return redirect()->route('dashboard')->with('success', 'เพิ่มข้อมูลอาจารย์เรียบร้อยแล้ว');
    }
}