<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imgmodel;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function deleteImage(Request $request)
    {
        $imgId = $request->id;

        // ค้นหารูปที่ตรงกับ ID ที่ส่งมาจากคำขอ
        $img = Imgmodel::find($imgId);

        if ($img) {
            // ลบไฟล์จากโฟลเดอร์ใน storage
            $imagePath = storage_path('app/public/images/' . $img->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath); // ลบไฟล์จริง
            }

            // ลบข้อมูลจากฐานข้อมูล
            $img->delete();
        }

        return response()->json(['success' => true]);
    }


    
    public function uploadImage(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'latitude' => 'required',
            'longitude' => 'required',
            'Nactivity' => 'required',
        ], [
            'images.*.mimes' => 'ไฟล์ต้องเป็น jpg, jpeg, png, gif หรือ webp เท่านั้น',
            'images.*.image' => 'ไฟล์ต้องเป็นรูปภาพเท่านั้น',
            'images.*.max' => 'แต่ละไฟล์ต้องมีขนาดไม่เกิน 5MB',
        ]);

        foreach ($request->file('images') as $image) {
            $imageName = time() . uniqid() . '.' . $image->extension();
            $image->storeAs('images', $imageName, 'public');

            Imgmodel::create([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'Nactivity' => $request->Nactivity,
                'image_path' => $imageName,
            ]);
        }

        return redirect()->back()->with('message', 'อัพโหลดรูปภาพทั้งหมดสำเร็จ');
    }


    public function alldata()
{
    $images = Imgmodel::select('Nactivity', 'image_path')
    ->whereRaw('id IN (SELECT MIN(id) FROM imgmodels GROUP BY Nactivity)')
    ->get();
    
    $markers = Marker::all(); // ดึงข้อมูลทั้งหมด
    return view('all-list', compact('markers','images'));

}
}
