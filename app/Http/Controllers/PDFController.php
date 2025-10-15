<?php

namespace App\Http\Controllers;
use App\Models\Marker;
use App\Models\Imgmodel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $marker = Marker::with(['person', 'target', 'result', 'maintarget', 'activity', 'benefit'])->find($id);
        $images = Imgmodel::where('Nactivity', $marker->Nactivity)->pluck('image_path')->toArray(); 
        $data = [
            'marker' => $marker,
            'images' => $images
        ];

        $pdf = Pdf::loadView('document', $data);
        return $pdf->stream('document.pdf'); // เปิดในเบราว์เซอร์
        // return $pdf->download('document.pdf'); // ดาวน์โหลดไฟล์

    }
}
