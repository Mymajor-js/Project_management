<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['status' => 'marked as read']);
    }

    public function delete($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        if ($notification->read_at) {
            $notification->delete();
        }

        return back()->with('success', 'ลบการแจ้งเตือนแล้ว');
    }
     public function deleteRead()
    {
        Auth::user()->readNotifications()->delete();

        return redirect()->back()->with('success', 'ลบแจ้งเตือนที่อ่านแล้วเรียบร้อย');
    }
}
