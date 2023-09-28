<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Uye;
use App\Models\Musteri;
use Illuminate\Support\Facades\Session;
class RezervasyonController extends Controller
{

    public function rezervasyon(){
        $kullanici = json_decode(Session::get('kullanici'));
       
        $Musteri = Musteri::where('e_posta', $kullanici->e_posta)->first();
      
        $aracVerileri = DB::select(DB::raw("
            SELECT ka.*, a.a_resim AS resim, pb.para_name AS para_birim,
            DATE_FORMAT(ka.alis_tarihi, '%Y-%m-%d') as alis_tarihi,
            DATE_FORMAT(ka.donus_tarihi, '%Y-%m-%d') as donus_tarihi,
            CONCAT(m.mr_isim,' / ',mo.m_name) AS arac_adi,
            af.fiyat AS arac_top_fiyat
            
            FROM `kiralanan_arac` ka
            LEFT JOIN arac AS a ON a.a_id = ka.arac_id
            LEFT JOIN marka AS m ON m.mr_id = a.mr_id
            LEFT JOIN model AS mo ON mo.m_id = a.m_id
            LEFT JOIN para_birimi AS pb on pb.para_birim_id=ka.para_birim_id
            LEFT JOIN arac_fiyati af on (af.arac_id=ka.arac_id and af.para_birim_id=ka.para_birim_id and af.gun_baslangic<= DATEDIFF(ka.donus_tarihi, ka.alis_tarihi)
                                         and af.gun_bitis>= DATEDIFF(ka.donus_tarihi, ka.alis_tarihi)
                                        )
            WHERE ka.musteri_id =".$Musteri->mus_id
        ));
     
        return view('rezarvasyonlarim', compact('aracVerileri'));
    }

    public function trezervasyon(){
        $kullanici = json_decode(Session::get('kullanici'));
       
        $Musteri = Musteri::where('e_posta', $kullanici->e_posta)->first();
      
        $rezVerileri = DB::select(DB::raw("
            SELECT tr.*,  th.mesafe as mesafe,a_i.ilce_name as alis_yeri,d_i.ilce_name as donus_yeri
           
    
            
            FROM `transfer_rezarvasyon` tr
            LEFT JOIN transfer_hizmet AS th ON th.t_id = tr.t_id
            LEFT JOIN musteri AS m ON m.mus_id = tr.mus_id
            LEFT JOIN ilce AS a_i ON th.alis_yeri = a_i.ilce_id
            LEFT JOIN ilce AS d_i ON th.donus_yeri = d_i.ilce_id
            WHERE tr.mus_id =".$Musteri->mus_id
        ));
     
        return view('transfer-rezarvasyonlarim', compact('rezVerileri'));
    }

}
