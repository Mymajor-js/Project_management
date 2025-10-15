<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Marker;
use App\Models\Imgmodel;
use App\Models\responsible_person;
use App\Models\DetailActivity;
use App\Models\User;
use App\Models\Number;
use App\Models\PjBenefit;
use App\Models\PjMainTarget; 
use App\Models\PjActivity;
use App\Models\PjResult;
use App\Models\PjTarget;
use App\Models\PjPerson;
use App\Models\Teacher;
use App\Notifications\NewMarkerCreated;

class mapController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'Nactivity' => 'required|string',
            // เพิ่มการ validate field อื่นๆ ถ้ามี
        ]);

        // ✅ สร้าง marker ใหม่
        $marker = Marker::create($request->all());

        // ✅ ส่งแจ้งเตือนไปยัง admin ทุกคน (ในระบบ + ส่งอีเมล)
        $admins = User::where('level', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewMarkerCreated($marker));
        }

        // ✅ กลับไปยังหน้าเดิมพร้อมข้อความ
        return redirect()->back()->with('success', 'เพิ่มโครงการและส่งแจ้งเตือนเรียบร้อยแล้ว');
    }

    private function notifyAdmins($marker)
    {
        $admins = User::where('level', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\NewMarkerCreated($marker));
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // ตรวจสอบรหัสผ่านเดิม
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'รหัสผ่านเดิมไม่ถูกต้อง']);
        }

        // อัปเดตรหัสผ่านใหม่
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('message', 'เปลี่ยนรหัสผ่านสำเร็จ');
    }


    public function show_b_up(Request $request, $Nactivity){


        $marker = Marker::where('Nactivity', $Nactivity)
                ->with(['person', 'target', 'result','number','activity','benefit','maintarget'])
                ->first();
        return view('update-map', compact('marker'));
    }
    
    public function update(Request $request, $id)
    {

        $marker = Marker::findOrFail($id);

        $request->validate([
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
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
            'suggestions' => 'nullable|string',
            'number_target' => 'nullable|string',
            'number_target_out' => 'nullable|string',
            'performancex' => 'nullable|string',
            'applied' => 'nullable|string',
            'personContainer.*.name' => 'nullable|string',
            'personContainer.*.position' => 'nullable|string',

        ]);

        $marker->update($request->only([
            'year_money', 'arear_money', 'province', 'district', 'subdistrict',
            'mauban', 'mautee', 'number_target', 'number_target_out',
            'time_pj', 'time_pj_end', 'performancex', 'applied',
            'description', 'suggestions'
        ]));
        if ($request->has('longitude','latitude')) {
            $llsave = Marker::findOrFail($id);
            $llsave->longitude = $request->longitude;
            $llsave->latitude = $request->latitude;
            $llsave->save();
        }

        if ($request->has('batthai_two')) {
            Number::create([
                'batthai' => $request->batthai_two, // ใช้ค่าที่รับมา
                'Nactivity' => $request->Nactivity, // ใส่ค่าคอลัมน์อื่น ๆ ตามที่ต้องการ

            ]);
        }

        if ($request->has('person_id')) {
            foreach ($request->person_id as $index => $personId) {
                $person = PjPerson::findOrFail($personId);
                $person->Nactivity = $request->Nactivity;
                $person->name_lastname = $request->name_lastname[$index];
                $person->position = $request->person[$index];
                $person->save();
            }
        }

        if ($request->has('number_id')) {
            foreach ($request->number_id as $index => $numberId) {
                $number = Number::findOrFail($numberId);
                $number->Nactivity = $request->Nactivity;
                $number->batthai = $request->batthai[$index];
                $number->save();
            }
        }
        
        if ($request->has('target_id')) {
            foreach ($request->target_id as $index => $targetId) {
                $target = PjTarget::findOrFail($targetId);
                $target->Nactivity = $request->Nactivity;
                $target->target = $request->target[$index];
                $target->save();
            }
        }
        
        if ($request->has('result_id')) {
            foreach ($request->result_id as $index => $resultId) {
                $result = PjResult::findOrFail($resultId);
                // ใน form ใช้ชื่อ input ว่า target_two สำหรับผลลัพธ์
                $result->Nactivity = $request->Nactivity;

                $result->target = $request->target_two[$index];
                $result->save();
            }
        }
        
        if ($request->has('activity_id')) {
            foreach ($request->activity_id as $index => $activityId) {
                $activity = PjActivity::findOrFail($activityId);
                $activity->Nactivity = $request->Nactivity;
                $activity->name_activity = $request->name_activity[$index];
                $activity->person_pj = $request->person_pj[$index];
                $activity->resultx = $request->resultx[$index];
                $activity->save();
            }
        }
        
        if ($request->has('main_target_id')) {
            // หากส่งเป็น array
                foreach ($request->main_target_id as $index => $maintargetId) {
                    $maintarget = PjMainTarget::findOrFail($maintargetId);
                    $maintarget->Nactivity = $request->Nactivity;
                    $maintarget->result_main = $request->result_main[$index];
                    $maintarget->goal_unit = $request->goal_unit[$index];
                    $maintarget->goal_amount = $request->goal_amount[$index];
                    $maintarget->performance_unit = $request->performance_unit[$index];
                    $maintarget->performance_amount = $request->performance_amount[$index];
                    $maintarget->save();
                }
        }
        if ($request->has('benefit_id')) {
            foreach ($request->benefit_id as $index => $benefitId) {
                $benefit = PjBenefit::findOrFail($benefitId);
                $benefit->Nactivity = $request->Nactivity;
                $benefit->benefit = $request->benefit[$index];
                $benefit->save();
            }
        }
        if ($request->has('personContainer')) {
            foreach ($request->personContainer as $person) {
                // ตรวจสอบว่า $person เป็น array ที่มี 'name' และ 'position'
                if (is_array($person) && isset($person['name'], $person['position'])) {
                    // สร้างข้อมูลผู้รับผิดชอบในฐานข้อมูล
                    PjPerson::create([
                        'Nactivity' => $request->Nactivity, // หรือค่าอื่น ๆ ที่คุณต้องการ
                        'name_lastname' => $person['name'],
                        'position' => $person['position'],
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
            if ($request->has('result_main_new')) {
                foreach ($request->result_main_new as $key => $result_main_new) {
                    PjMainTarget::create([
                        'Nactivity' => $request->Nactivity,
                        'result_main' => $result_main_new,
                        'goal_unit' => $request->goal_unit_new[$key],
                        'goal_amount' => $request->goal_amount_new[$key],
                        'performance_unit' => $request->performance_unit_new[$key],
                        'performance_amount' => $request->performance_amount_new[$key],
                    ]);
                }
            }
        
            if ($request->has('benefitContainer')) {
                foreach ($request->benefitContainer as $benefit) {
                    PjBenefit::create([
                        'Nactivity' => $request->Nactivity,
                        'benefit' => $benefit,
                    ]);
                }
            }

        return redirect()->route('dashboard')->with('success', 'อัปเดตข้อมูลสำเร็จ!');
    }

    public function delRow($id)
    {
        $maintarget = PjMainTarget::findOrFail($id);
        $maintarget->delete();
        
        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ!');

    }

    public function deleteperson($id)
    {
        $persondel = PjPerson::findOrFail($id);
        $persondel->delete();
        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ!');
    }

    public function deletenumber($id)
    {
        $numberdel = Number::findOrFail($id);
        $numberdel->delete();
        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ!');
    }

    public function deletetarget($id)
    {
        $targetdel = PjTarget::findOrFail($id);
        $targetdel->delete();
        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ!');
    }

    public function deleteresult($id)
    {
        $resultdel = PjResult::findOrFail($id);
        $resultdel->delete();
        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ!');
    }

    public function deleteactivity($id)
    {
        $activitydel = PjActivity::findOrFail($id);
        $activitydel->delete();
        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ!');
    }

    public function deletebenefit($id)
    {
        $benefitdel = PjBenefit::findOrFail($id);
        $benefitdel->delete();
        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ!');
    }

    public function del($Nactivity)
    {
        // ลบข้อมูลจากตาราง Marker
        Marker::where('Nactivity', $Nactivity)->delete();

        Number::where('Nactivity', $Nactivity)->delete();
        PjBenefit::where('Nactivity', $Nactivity)->delete();
        PjMainTarget::where('Nactivity', $Nactivity)->delete();
        PjActivity::where('Nactivity', $Nactivity)->delete();
        PjResult::where('Nactivity', $Nactivity)->delete();
        
        Imgmodel::where('Nactivity', $Nactivity)->delete();

        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ!');
    }

    public function getMarkers(Request $request)
    {
        $query = Marker::query();

        $user = Auth::user();
        if ($user) {
            // ✅ ถ้า user ไม่ใช่ admin ให้กรองเฉพาะข้อมูลของตัวเอง
            if ($user->level !== 'admin') {
                $query->where('my_name', $user->my_name);
            }
        }
        // ✅ ถ้าผู้ใช้ไม่ได้ล็อกอิน ให้แสดงข้อมูลทั้งหมด (ไม่กรอง my_name)
        
        if ($request->has('year') && !empty($request->year)) {
            $query->where('year_money', $request->year);
        }

        // ✅ ดึงข้อมูลทั้งหมด
        $markers = $query->get()
            ->filter(function ($marker) {
                // ✅ ตรวจสอบว่า latitude และ longitude ไม่เป็นค่าว่าง, null หรือ 0
                return !empty($marker->latitude) && !empty($marker->longitude);
            })
            ->map(function ($marker) {
                // ✅ ค้นหารูปแรกที่อ้างอิง Nactivity
                $firstImage = Imgmodel::where('Nactivity', $marker->Nactivity)->first();

                return [
                    'latitude' => $marker->latitude,
                    'longitude' => $marker->longitude,
                    'Nactivity' => $marker->Nactivity,
                    'project_id' => $marker->project_id,
                    'my_name' => $marker->my_name,
                    'year_money' => $marker->year_money, // ✅ เพิ่มปีงบประมาณไปในข้อมูล
                    'image' => $firstImage ? asset('storage/images/' . $firstImage->image_path) : null, // ✅ ส่ง URL ของภาพไป
                ];
            });

        return response()->json($markers);
    }


    public function alldata(Request $request)
    {
        $query = Marker::query();

        if (Auth::user()->level !== 'admin') {
            $query->where('my_name', Auth::user()->my_name);
        }

        // Search query แบบ dynamic
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('Nactivity', 'like', "%$search%")
                ->orWhere('my_name', 'like', "%$search%")
                ->orWhere('province', 'like', "%$search%")
                ->orWhere('district', 'like', "%$search%")
                ->orWhere('year_money', 'like', "%$search%");
            });
        }

        $markers = $query->paginate(10);

        // ภาพประกอบกิจกรรม
        $images = Imgmodel::select('Nactivity', 'image_path')
            ->whereIn('Nactivity', $markers->pluck('Nactivity'))
            ->whereRaw('id IN (SELECT MIN(id) FROM imgmodels GROUP BY Nactivity)')
            ->get();

        // กรองค่าเฉพาะเพื่อใช้ใน select filter (optional)
        $uniqueNamePepo = Marker::distinct()->pluck('my_name');
        $uniqueProvinces = Marker::distinct()->pluck('province');
        $uniqueDistricts = Marker::distinct()->pluck('district');
        $uniqueSubDistricts = Marker::distinct()->pluck('subdistrict');
        $uniqueFiscalYears = Marker::distinct()->pluck('year_money');

        // ถ้า AJAX request ให้ return partial view
        if ($request->ajax()) {
            return view('partials.marker_table', compact('markers', 'images'))->render();
        }

        return view('all-list', compact(
            'markers',
            'images',
            'uniqueNamePepo',
            'uniqueProvinces',
            'uniqueDistricts',
            'uniqueSubDistricts',
            'uniqueFiscalYears'
        ));
    }

    public function alldatalist(Request $request)
    {
        $query = Marker::query();

        if (Auth::user()->level !== 'admin') {
            $query->where('my_name', Auth::user()->my_name);
        }

        // Search query แบบ dynamic
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('Nactivity', 'like', "%$search%")
                ->orWhere('my_name', 'like', "%$search%")
                ->orWhere('province', 'like', "%$search%")
                ->orWhere('district', 'like', "%$search%")
                ->orWhere('year_money', 'like', "%$search%");
            });
        }

        $markers = $query->paginate(10);

        // ภาพประกอบกิจกรรม
        $images = Imgmodel::select('Nactivity', 'image_path')
            ->whereIn('Nactivity', $markers->pluck('Nactivity'))
            ->whereRaw('id IN (SELECT MIN(id) FROM imgmodels GROUP BY Nactivity)')
            ->get();

        // กรองค่าเฉพาะเพื่อใช้ใน select filter (optional)
        $uniqueNamePepo = Marker::distinct()->pluck('my_name');
        $uniqueProvinces = Marker::distinct()->pluck('province');
        $uniqueDistricts = Marker::distinct()->pluck('district');
        $uniqueSubDistricts = Marker::distinct()->pluck('subdistrict');
        $uniqueFiscalYears = Marker::distinct()->pluck('year_money');

        // ถ้า AJAX request ให้ return partial view
        if ($request->ajax()) {
            return view('partials.homelist', compact('markers', 'images'))->render();
        }

        return view('all-list', compact(
            'markers',
            'images',
            'uniqueNamePepo',
            'uniqueProvinces',
            'uniqueDistricts',
            'uniqueSubDistricts',
            'uniqueFiscalYears'
        ));
    }

    public function showlist(Request $request)
    {
        $query = Marker::query();
        
        $chartProvince = Marker::select('province', DB::raw('count(*) as total'))
            ->groupBy('province')
            ->get();

        $chartDistrict = Marker::select('district', DB::raw('count(*) as total'))
            ->groupBy('district')
            ->get();
        
        $chartSubdistrict = Marker::select('subdistrict', DB::raw('count(*) as total'))
            ->groupBy('subdistrict')
            ->get(); 

        $chartArear_money = Marker::select(
        'year_money',
        'arear_money',
        DB::raw('count(*) as total')
        )
        ->groupBy('year_money', 'arear_money')
        ->orderBy('year_money')
        ->get();
        // สรุปจำนวนโครงการตามปีงบประมาณ
        
        $chartYear = Marker::select('year_money', DB::raw('count(*) as total'))
            ->groupBy('year_money')
            ->get();

        // สรุปจำนวนโครงการตามชื่อผู้รับผิดชอบ
        $chartUser = Marker::select('my_name', DB::raw('count(*) as total'))
            ->groupBy('my_name')
            ->get();
        
        if (Auth::user()->level !== 'admin') {
            $query->where('my_name', Auth::user()->my_name);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('Nactivity', 'like', "%$search%")
                ->orWhere('my_name', 'like', "%$search%")
                ->orWhere('province', 'like', "%$search%")
                ->orWhere('district', 'like', "%$search%")
                ->orWhere('year_money', 'like', "%$search%");
            });
        }
        $teachers = Teacher::select('name', 'position')->get();
        $markers = $query->paginate(10);

        $images = Imgmodel::select('Nactivity', 'image_path')
            ->whereIn('Nactivity', $markers->pluck('Nactivity'))
            ->whereRaw('id IN (SELECT MIN(id) FROM imgmodels GROUP BY Nactivity)')
            ->get();

        // กรองค่าที่ใช้ใน filter dropdown
        $uniqueNamePepo = Marker::distinct()->pluck('my_name');
        $uniqueProvinces = Marker::distinct()->pluck('province');
        $uniqueDistricts = Marker::distinct()->pluck('district');
        $uniqueSubDistricts = Marker::distinct()->pluck('subdistrict');
        $uniqueFiscalYears = Marker::distinct()->pluck('year_money');

        // ✅ โหลด users เฉพาะกรณี admin
        if (Auth::user()->level === 'admin') {
            $users = User::select('my_name','position')->get();
        } else {
            $users = collect([
                (object)[
                    'my_name' => Auth::user()->my_name,
                    'position' => Auth::user()->position
                ]
            ]);
        }


        if ($request->ajax()) {
            return view('partials.marker_table', compact('markers', 'images'))->render();
        }
        $userLoggedIn = Auth::user();
        return view('map', compact(
                'markers',
                'images',
                'uniqueNamePepo',
                'uniqueProvinces',
                'uniqueDistricts',
                'uniqueSubDistricts',
                'uniqueFiscalYears',
                'teachers',
                'users',
                'chartProvince',
                'chartYear',
                'chartDistrict',
                'chartSubdistrict',
                'userLoggedIn',
                'chartArear_money'
        ));
    }

    public function updateProfilex(Request $request)
    {
        $user = Auth::user();

        // ถ้ามีการขอเปลี่ยนรหัสผ่าน
        if ($request->filled('current_password') || $request->filled('new_password')) {
            // ตรวจสอบรหัสผ่านเดิม
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'รหัสผ่านเดิมไม่ถูกต้อง']);
            }

            // ตรวจสอบรหัสผ่านใหม่
            $request->validate([
                'new_password' => 'required|min:6|confirmed',
            ]);

            $user->password = Hash::make($request->new_password);
        }

        // อัปเดต email ถ้ามี
        if ($request->filled('email')) {
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);
            $user->email = $request->email;
        }

        $user->save();

        return back()->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
    }


    public function filterData(Request $request) {
        $query = Marker::query();

        if ($request->has('my_name') && $request->my_name != '') {
            $query->where('my_name', $request->my_name);
        }
        if ($request->has('province') && $request->province != '') {
            $query->where('province', $request->province);
        }
        if ($request->has('district') && $request->district != '') {
            $query->where('district', $request->district);
        }
        if ($request->has('sub_district') && $request->sub_district != '') {
            $query->where('subdistrict', $request->sub_district);
        }
        if ($request->has('year_money') && $request->year_money != '') {
            $query->where('year_money', $request->year_money);
        }

        $filtered_markers = $query->get();

        // ตรวจสอบค่าที่ได้รับ
        return response()->json([
            'filtered_markers' => $filtered_markers,
            'name_pepos' => $filtered_markers->pluck('my_name')->unique(),
            'provinces' => $filtered_markers->pluck('province')->unique(),
            'districts' => $filtered_markers->pluck('district')->unique(),
            'subdistricts' => $filtered_markers->pluck('subdistrict')->unique(),
            'year_money' => $filtered_markers->pluck('year_money')->unique()
        ]);
    }
    // ฟังก์ชันแสดงฟอร์ม
    public function showAddForm(Request $request)
    {

        return view('add-marker-info', [
            'lat' => $request->query('lat'),
            'lng' => $request->query('lng'),
            'Nactivity' => $request->query('Nactivity'),
            'my_name' => $request->query('my_name'),
            'province' => $request->query('province'),
            'district' => $request->query('district'),
            'subdistrict' => $request->query('subdistrict'),
            'mauban' => $request->query('mauban'),
            'mautee' => $request->query('mautee'),
            'arear_money' => $request->query('arear_money'),
            'time_pj' => $request->query('time_pj'),
            'time_pj_end' => $request->query('time_pj_end'),
            'year_money' => $request->query('year_money')
            
        ]);
    }

    public function showData(Request $request){   

        $latitude = $request->query('lat');
        $longitude = $request->query('lng');
        $project_id = $request->Nac;
        // ค้นหาหมุดที่พิกัดตรงกัน
        $marker = Marker::where('Nactivity', $project_id)
                        ->with(['person', 'target', 'result','number','activity','benefit','maintarget'])
                        ->first();
        $compressedImageData = null; // กำหนดค่าตัวแปรนี้ให้เป็น null
        if ($marker) {
            $latitude = $marker->latitude;
            $longitude = $marker->longitude;
            // ค้นหารูปภาพทั้งหมดที่พิกัดตรงกัน
            $imgx = Imgmodel::where('latitude', $latitude)
                            ->where('longitude', $longitude)
                            ->where('Nactivity', $project_id)
                            ->get();
        
            // ตรวจสอบว่ามีภาพหรือไม่
            if ($imgx->isNotEmpty()) {
                $firstImage = $imgx->first(); // เอารูปแรก
                $path = public_path('storage/images/' . $firstImage->image_path);
                
        
                if (file_exists($path)) {
                    $imageInfo = getimagesize($path);
                    $mime = $imageInfo['mime']; // ตัวอย่าง: image/jpeg, image/png

                    $width = $imageInfo[0];
                    $height = $imageInfo[1];

                    $newWidth = 400;
                    $newHeight = ($height / $width) * $newWidth;

                    switch ($mime) {
                        case 'image/jpeg':
                            $source = imagecreatefromjpeg($path);
                            break;
                        case 'image/png':
                            $source = imagecreatefrompng($path);
                            break;
                        case 'image/gif':
                            $source = imagecreatefromgif($path);
                            break;
                        case 'image/webp':
                            $source = imagecreatefromwebp($path);
                            break;
                        default:
                            throw new \Exception("ไม่รองรับประเภทไฟล์: $mime");
                    }

                    $newImage = imagecreatetruecolor($newWidth, $newHeight);

                    // สำหรับ PNG และ GIF ให้รองรับ transparency
                    if (in_array($mime, ['image/png', 'image/gif'])) {
                        imagecolortransparent($newImage, imagecolorallocatealpha($newImage, 0, 0, 0, 127));
                        imagealphablending($newImage, false);
                        imagesavealpha($newImage, true);
                    }

                    imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                    ob_start();
                    imagejpeg($newImage, null, 70); // ✅ บีบอัดให้เป็น jpeg
                    $compressedImageData = ob_get_clean();
                }

            }
        } else {
            $imgx = collect(); // ถ้าไม่มีหมุด ให้กำหนดเป็น collection ว่าง
        }
        
       
        return view('show-data', compact('marker', 'imgx', 'compressedImageData'));
    }

    public function Mesave(Request $request)
    {   
        $statusx = 'Pending';
        
        // Validate ข้อมูลที่ส่งมา
        $request->validate([
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
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
            'suggestions' => 'nullable|string',
            'number_target' => 'nullable|string',
            'number_target_out' => 'nullable|string',
            'performancex' => 'nullable|string',
            'applied' => 'nullable|string'
        ]);

        // ตรวจสอบว่า Nactivity มีอยู่ในฐานข้อมูลแล้วหรือไม่
        $exists = Marker::where('Nactivity', $request->Nactivity)->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'กิจกรรมนี้มีอยู่ในระบบแล้ว!');
        }

        // ถ้าไม่มี ให้ทำการบันทึกข้อมูล
        $marker = Marker::create([
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
        $this->notifyAdmins($marker);
        Number::create([
            'batthai' => $request->batthai,
            'Nactivity' => $request->Nactivity
        ]);

        if ($request->has('personContainer')) {
            foreach ($request->personContainer as $key => $person) {
                if (is_array($person) && count($person) >= 2) {
                    PjPerson::create([
                        'Nactivity' => $request->Nactivity,
                        'name_lastname' => $person[0],
                        'position' => $person[1],
                    ]);
                }
            }
        }

        if ($request->has('targetContainer')) {
            foreach ($request->targetContainer as $target) {
                PjTarget::create([
                    'Nactivity' => $request->Nactivity,
                    'target' => $target,
                ]);
            }
        }

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
                    continue;
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

        if ($request->has('benefitContainer')) {
            foreach ($request->benefitContainer as $benefit) {
                PjBenefit::create([
                    'Nactivity' => $request->Nactivity,
                    'benefit' => $benefit,
                ]);
            }
        }

        return redirect('/dashboard')->with('success', 'บันทึกข้อมูลสำเร็จ!');
    }

    public function Sentsave(Request $request)
    {   
        $statusx = 'Pending';
        // Validate ข้อมูลที่ส่งมา
        $request->validate([
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'Nactivity' => 'nullable|string',
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
            'suggestions' => 'nullable|string',
            'number_target' => 'nullable|string',
            'number_target_out' => 'nullable|string',
            'performancex' => 'nullable|string',
            'applied' => 'nullable|string'
        ]);
        
        // ตรวจสอบว่า Nactivity มีอยู่ในฐานข้อมูลแล้วหรือไม่
        $exists = Marker::where('Nactivity', $request->Nactivity)->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'กิจกรรมนี้มีอยู่ในระบบแล้ว!');
        }
        $myName = isset($request->personContainer[1][0]) ? $request->personContainer[1][0] : null;
        // ถ้าไม่มี ให้ทำการบันทึกข้อมูล
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
            'my_name' => $myName,
            'year_money' => $request->year_money,
            'number_target' => $request->number_target,
            'number_target_out' => $request->number_target_out,
            'performancex' => $request->performancex,
            'status' => $statusx,
            'applied' => $request->applied
        ]);

        Number::create([
            'batthai' => $request->batthai,
            'Nactivity' => $request->Nactivity
        ]);

        if ($request->has('personContainer')) {
            foreach ($request->personContainer as $key => $person) {
                if (is_array($person) && count($person) >= 2) {
                    PjPerson::create([
                        'Nactivity' => $request->Nactivity,
                        'name_lastname' => $person[0],
                        'position' => $person[1],
                    ]);
                }
            }
        }

        if ($request->has('targetContainer')) {
            foreach ($request->targetContainer as $target) {
                PjTarget::create([
                    'Nactivity' => $request->Nactivity,
                    'target' => $target,
                ]);
            }
        }

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
                    continue;
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

        if ($request->has('benefitContainer')) {
            foreach ($request->benefitContainer as $benefit) {
                PjBenefit::create([
                    'Nactivity' => $request->Nactivity,
                    'benefit' => $benefit,
                ]);
            }
        }

        return redirect('/dashboard')->with('success', 'บันทึกข้อมูลสำเร็จ!');
    }

    public function admin_add(Request $request)
    {   
        $statusx = 'Pending';
        $request->validate([
            'Nactivity' => 'required|string',
            'year_money' => 'nullable|string',
            'my_name' => 'required|string',
        ]);

        $existing = Marker::where('Nactivity', $request->Nactivity)->exists();

        if ($existing) {
            return redirect()->back()->with('error', 'ชื่อโครงการนี้มีอยู่ในระบบแล้ว!');
        }
        
        Marker::create([
            'Nactivity' => $request->Nactivity,
            'my_name'     => $request->my_name,
            'status'     => $statusx,
            'year_money'      => $request->year_money
        ]);

        return redirect('dashboard')->with('success', 'บันทึกข้อมูลสำเร็จ!');
    }

    public function add_activity(Request $request){
        $users = User::pluck('my_name');
        return view('add_activity', compact('users'));
    }

    public function update_success($Nactivity){

        $maker = Marker::where('Nactivity', $Nactivity)->first();

        if ($maker) {
            $maker->status = 'finish';
            $maker->save(); 
        }

        return redirect()->back()->with('success', 'อัพเดทข้อมูลสำเร็จ !');
    }

    public function search(Request $request)
    {
        // รับค่าจาก input
        $searchQuery = $request->input('query');
        $userMyName = Auth::user()->my_name;
        $isAdmin = Auth::user()->level === 'admin';

        // ตรวจสอบว่ามี "-/" หรือไม่
        if (strpos($searchQuery, '-/') !== false) {
            $keywords = explode('-/', $searchQuery);

            // เริ่มต้น query
            $markers = Marker::query();

            // ถ้าไม่ใช่แอดมิน ให้กรองเฉพาะข้อมูลของตัวเองก่อน
            if (!$isAdmin) {
                $markers->where('my_name', $userMyName);
            }

            // ค้นหาข้อมูลที่ตรงกับเงื่อนไข
            foreach ($keywords as $keyword) {
                $markers->where(function ($query) use ($keyword) {
                    $query->where('Nactivity', 'like', "%{$keyword}%")
                        ->orWhere('province', 'like', "%{$keyword}%")
                        ->orWhere('district', 'like', "%{$keyword}%")
                        ->orWhere('subdistrict', 'like', "%{$keyword}%")
                        ->orWhere('mauban', 'like', "%{$keyword}%")
                        ->orWhere('mautee', 'like', "%{$keyword}%")
                        ->orWhere('arear_money', 'like', "%{$keyword}%")
                        ->orWhere('time_pj', 'like', "%{$keyword}%")
                        ->orWhere('time_pj_end', 'like', "%{$keyword}%")
                        ->orWhere('year_money', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%")
                        ->orWhere('suggestions', 'like', "%{$keyword}%")
                        ->orWhere('status', 'like', "%{$keyword}%")
                        ->orWhere('number_target_out', 'like', "%{$keyword}%")
                        ->orWhere('performancex', 'like', "%{$keyword}%")
                        ->orWhere('applied', 'like', "%{$keyword}%")
                        ->orWhere('number_target', 'like', "%{$keyword}%");
                });
            }

            $markers = $markers->get();
        } else {
            // ค้นหาตามปกติเมื่อไม่มี "-/"
            $markers = Marker::query();

            // ถ้าไม่ใช่แอดมิน กรองเฉพาะข้อมูลของตัวเอง
            if (!$isAdmin) {
                $markers->where('my_name', $userMyName);
            }

            // เงื่อนไขการค้นหา
            $markers->where(function ($query) use ($searchQuery) {
                $query->where('Nactivity', 'like', "%{$searchQuery}%")
                    ->orWhere('province', 'like', "%{$searchQuery}%")
                    ->orWhere('district', 'like', "%{$searchQuery}%")
                    ->orWhere('subdistrict', 'like', "%{$searchQuery}%")
                    ->orWhere('mauban', 'like', "%{$searchQuery}%")
                    ->orWhere('mautee', 'like', "%{$searchQuery}%")
                    ->orWhere('arear_money', 'like', "%{$searchQuery}%")
                    ->orWhere('time_pj', 'like', "%{$searchQuery}%")
                    ->orWhere('time_pj_end', 'like', "%{$searchQuery}%")
                    ->orWhere('year_money', 'like', "%{$searchQuery}%")
                    ->orWhere('description', 'like', "%{$searchQuery}%")
                    ->orWhere('suggestions', 'like', "%{$searchQuery}%")
                    ->orWhere('status', 'like', "%{$searchQuery}%")
                    ->orWhere('number_target_out', 'like', "%{$searchQuery}%")
                    ->orWhere('performancex', 'like', "%{$searchQuery}%")
                    ->orWhere('applied', 'like', "%{$searchQuery}%")
                    ->orWhere('number_target', 'like', "%{$searchQuery}%");
            });

            $markers = $markers->get();
        }

        // ตรวจสอบว่ามีข้อมูลหรือไม่ก่อน pluck
        if ($markers->isNotEmpty()) {
            $nactivities = $markers->pluck('Nactivity')->toArray();

            // ดึงรูปแรกของแต่ละ Nactivity
            $images = Imgmodel::whereIn('Nactivity', $nactivities)
                ->whereIn('id', function ($query) {
                    $query->select(DB::raw('MIN(id)'))
                        ->from('imgmodels')
                        ->groupBy('Nactivity');
                })
                ->get();
        } else {
            $images = collect(); // ถ้าไม่มีข้อมูล ให้ส่ง Collection ว่าง
        }

        return view('search-results', compact('markers', 'images'));
    }



    public function showMap(Request $request)
    {
        // รับค่าจากฟอร์มค้นหา
        $query = $request->input('query');
        $Nactivity = $request->get('Nactivity', []);
        $latitude = $request->get('latitude', []);
        $longitude = $request->get('longitude', []);

        // แปลงข้อมูลที่ได้ให้เป็น array
        $NactivityArray = explode(',', $Nactivity);
        $latitudeArray = explode(',', $latitude);
        $longitudeArray = explode(',', $longitude);

        // ค้นหาข้อมูลที่ตรงกับคำค้นหา
        $markers = Marker::whereIn('Nactivity', $NactivityArray)
                        ->whereIn('latitude', $latitudeArray)
                        ->whereIn('longitude', $longitudeArray)
                        ->get();



        // วนลูปเพื่อดึงภาพที่เกี่ยวข้อง
        foreach ($markers as $marker) {
            $imgxtwo = Imgmodel::where('latitude', $marker->latitude)
                ->where('longitude', $marker->longitude)
                ->where('Nactivity', $marker->Nactivity)
                ->first();

            $marker->imageUrl = $imgxtwo ? asset('storage/images/' . $imgxtwo->image_path) : null;
        }

        return view('map-view', compact('markers'));
    }

    public function showChart()
    {
        $markers = Marker::all(); // ดึงข้อมูลทั้งหมดจาก Database
        return view('chart', compact('markers'));
    }

    public function sent_activity()
    {
        $usersent = User::select('my_name', 'position')->get();
        return view('sent_activity', compact('usersent'));
    }
    
}