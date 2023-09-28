<?php

namespace App\Http\Controllers;
use App\Models\Arac;
use App\Models\Haber;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
   

    public function anasayfabilgi()
    {
        return view('anasayfa');
    }

    public function haber($unique_name)
    {
        $haberlerim = Haber::all(); 
        $haberVerileri = Haber::where('unique_name', $unique_name)->first(); 
        
    // Tüm kullanıcıları çekmek için

    return view('haber-detay', compact('haberVerileri','haberlerim'));
    }
}
