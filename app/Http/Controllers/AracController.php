<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AracController extends Controller
{
    public function aracim(Request $request)
    {
        $aracVerileri = DB::select(DB::raw("
        SELECT a.*, m.mr_isim AS marka_name, mo.m_name AS model_name,
        IF(a.a_musait = 1, 'Müsait', 'Müsait Değil') AS arac_musait,
        IF(a.yakit_tur = 1, 'Benzin', IF(a.yakit_tur = 2, 'LPG', IF(a.yakit_tur = 3, 'Benzin/LPG', IF(a.yakit_tur = 4, 'Dizel', IF(a.yakit_tur = 5, 'Elektrik', 'Hybrid'))))) AS yakit_tur_adi,
        IF(a.vites_tur = 1, 'Manuel', IF(a.vites_tur = 2, 'Yarı Otomatik', IF(a.vites_tur = 3, 'Otomatik', 'Triptonik'))) AS vites_tur_name,
        IF(a.vites_tur = 1, 'Ekonomik', IF(a.vites_tur = 2, 'Orta Sınıf', IF(a.vites_tur = 3, 'Üst Sınıf', 'VIP'))) AS kategori_name,
        IF(a.klima_tur = 1, 'Otomatik', 'Manuel') AS klima_tur_name,
        CONCAT(il.il_name,' / ',ilce.ilce_name,' / ',ao.ofis_name) ofis_adi,
        il.il_id,ilce.ilce_id
        FROM `arac` a
        LEFT JOIN marka m ON m.mr_id = a.mr_id
        LEFT JOIN model mo ON mo.m_id = a.m_id
        LEFT JOIN arac_ofis ao on ao.ofis_id=a.ofis_id
        LEFT JOIN ilce on ilce.ilce_id=ao.ilce_id
        LEFT JOIN il on il.il_id=ilce.il_id
 
       
        "));
        return view('fiyat-listesi', compact('aracVerileri'));
    }
}
