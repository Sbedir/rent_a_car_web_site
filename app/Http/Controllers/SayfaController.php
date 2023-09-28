<?php

namespace App\Http\Controllers;
use App\Models\Sayfa;
use HTMLPurifier;

use Illuminate\Http\Request;

class SayfaController extends Controller
{
    public function hakkimizda()
    {
      
        $hakkimizdaVerileri = Sayfa::where('sayfa_baslik', "Hakkımızda")->first(); 
        
        // Tüm kullanıcıları çekmek için

    return view('hakkimizda', compact('hakkimizdaVerileri'));
    }

    public function filokiralama()
    {
      
        $filokiralamaVerileri = Sayfa::where('sayfa_baslik', "Filo Kiralama")->first(); // Tüm kullanıcıları çekmek için

    return view('filo-kiralama', compact('filokiralamaVerileri'));
    }

    public function kiralamakosullari()
    {
      
        $kiralamakosullariVerileri = Sayfa::where('sayfa_baslik', "Kiralama Koşulları")->first(); // Tüm kullanıcıları çekmek için

    return view('kiralama-kosullari', compact('kiralamakosullariVerileri'));
    }

    public function sss()
    {
      
        $sssVerileri = Sayfa::where('sayfa_baslik', "s.s.s.")->first(); // Tüm kullanıcıları çekmek için

    return view('sss', compact('sssVerileri'));
    }
}
