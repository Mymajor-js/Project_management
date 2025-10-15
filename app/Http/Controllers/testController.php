<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Marker;
use App\Models\Imgmodel;
use App\Models\responsible_person;
use App\Models\DetailActivity;
use App\Models\User;
use App\Models\PjBenefit;
use App\Models\PjMainTarget; 
use App\Models\PjActivity;
use App\Models\PjResult;
use App\Models\PjTarget;
use App\Models\PjPerson;

class testController extends Controller
{

    public function viewx(){
        return view('test.test');
    }
    public function viewinput(){
        return view('test.testinput');
    }
    public function store(Request $request)
{
    if ($request->has('personContainer')) {
    foreach ($request->personContainer as $key => $person) {
        if (is_array($person) && count($person) >= 2) { // ตรวจสอบว่ามีทั้งชื่อและตำแหน่ง
            PjPerson::create([
                'Nactivity' => $request->Nactivity,
                'name_lastname' => $person[0], // ชื่อ
                'position' => $person[1], // ตำแหน่ง
            ]);
        }
    }
    }


    // บันทึกวัตถุประสงค์หลัก
    if ($request->has('targetContainer')) {
        foreach ($request->targetContainer as $target) {
            PjTarget::create([
                'Nactivity' => $request->Nactivity,
                'target' => $target,
            ]);
        }
    }

    // บันทึกผลลัพธ์หลัก
    if ($request->has('resultContainer')) {
        foreach ($request->resultContainer as $result) {
            PjResult::create([
                'Nactivity' => $request->Nactivity,
                'target' => $result,
            ]);
        }
    }
    if ($request->has('activityContainer')) {
        foreach ($request->activityContainer as $activity) {
            if (!is_array($activity) || count($activity) < 3) {
                continue; // ข้ามถ้าข้อมูลไม่ครบ
            }
            
            PjActivity::create([
                'Nactivity' => $request->Nactivity,
                'name_activity' => $activity[0] ?? null,
                'person_pj' => $activity[1] ?? null,
                'resultx' => $activity[2] ?? null,
            ]);
        }
    }

    if ($request->has('result_main')) {
        foreach ($request->result_main as $key => $result_main) {
            PjMainTarget::create([
                'Nactivity' => $request->Nactivity,
                'result_main' => $result_main,
                'goal_unit' => $request->goal_unit[$key],
                'goal_amount' => $request->goal_amount[$key],
                'performance_unit' => $request->performance_unit[$key],
                'performance_amount' => $request->performance_amount[$key],
            ]);
        }
    }

    // บันทึกประโยชน์ที่ได้รับ
    if ($request->has('benefitContainer')) {
        foreach ($request->benefitContainer as $benefit) {
            PjBenefit::create([
                'Nactivity' => $request->Nactivity,
                'benefit' => $benefit,
            ]);
        }
    }

    return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ!');
}

    public function testsave(Request $request)
{

    $statusx = 'Pending';
    // Validate ข้อมูลที่ส่งมา
    $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'Nactivity' => 'required|string',
        'province' => 'nullable|string',
        'district' => 'nullable|string',
        'subdistrict' => 'nullable|string',
        'description' => 'nullable|string',
        'mauban' => 'nullable|string',
        'mautee' => 'nullable|string',
        'arear_money' => 'nullable|string',
        'time_pj' => 'nullable|string',
        'time_pj_end' => 'nullable|string',
        'year_money' => 'nullable|string',
        'my_name' => 'nullable|string',
        'suggestions' => 'required|string',
        'number_target' => 'required|string',
        'number_target_out' => 'required|string',
        'performancex' => 'required|string',
        'applied' => 'required|string'
    ]);

    Marker::create([
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'Nactivity' => $request->Nactivity,
        'province' => $request->province,
        'district' => $request->district,
        'subdistrict' => $request->subdistrict,
        'description' => $request->description,
        'suggestions' => $request->suggestions,
        'mauban' => $request->mauban,
        'mautee' => $request->mautee,
        'arear_money' => $request->arear_money,
        'time_pj' => $request->time_pj,
        'time_pj_end' => $request->time_pj_end,
        'my_name' => $request->my_name,
        'year_money' => $request->year_money,
        'number_target' => $request->number_target,
        'number_target_out' => $request->number_target_out,
        'performancex' => $request->performancex,
        'status' => $statusx,
        'applied' => $request->applied
    ]);
    return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ!');
}

}