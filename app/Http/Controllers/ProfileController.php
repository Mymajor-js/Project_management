<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function adduser(){

        return view('add_user');
    }
    public function registerx(Request $request){

        if ($request->password !== $request->cpassword) {
            
            return redirect()->back()->with('error', 'รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่อีกครั้ง');
        }

        if (User::where('email', $request->email)->exists()) {
            return back()->with('error', 'อีเมลนี้ถูกใช้แล้ว กรุณาใช้อีเมลอื่น');
        }elseif(User::where('name', $request->name)->exists()){
            return back()->with('error', 'ผู้ใช้นี้ถูกใช้แล้ว กรุณากรอกใหม่อีกครั้ง');
        }elseif(User::where('my_name', $request->my_name)->exists()){
            return back()->with('error', 'ชื่อนามสกุลนี้ถูกใช้แล้ว กรุณากรอกใหม่อีกครั้ง');
        }else{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:6',
                'cpassword' => 'required|same:password', // ตรวจสอบว่าตรงกับ password
                'my_name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                
            ]);
            
            $levelx = 'user';
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'my_name' => $request->my_name,
                'position' => $request->position,
                'level' => $levelx,
            ]);
            return redirect('/dashboard')->with('success', 'บันทึกข้อมูลสำเร็จ!');
        }
    }

}
