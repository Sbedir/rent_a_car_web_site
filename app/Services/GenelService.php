<?php
namespace App\Services;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Ayarlar;
use App\Models\AracFiyat;
use App\Models\Arac;
use App\Models\Musteri;
use App\Models\Haber;
use App\Models\Slider;
class GenelService
{
    public function arac()
    {
        $data = DB::select(DB::raw("
        SELECT a.*,
     
        CONCAT(m.mr_isim,' / ',mo.m_name,' / ',a.uretim_yili) AS aracadi
       
        FROM `arac` a
        LEFT JOIN marka m ON m.mr_id = a.mr_id
        LEFT JOIN model mo ON mo.m_id = a.m_id
      
        "));

        return  $data;
    }


    public function musteri()
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `musteri`
        "));

        return  $data;
    }

    public function marka()
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `marka`
        "));

        return  $data;
    }

    public function model($marka_id)
    {
        $data = DB::select(DB::raw("
        SELECT * FROM `model` where mr_id=".$marka_id."
        "));
        return  $data;
    }

    public function year()
    {
       $year=[];
        for($i=1990;$i<=date('Y');$i++)
        {
            array_push($year,$i);
        }

        return  $year;
    }

    public function musaitlikDurumu()
    {
        $kategori[1]='Müsait';
        $kategori[2]='Müsait Değil';

        return  $kategori;
    }

    public function kategori()
    {
        $kategori[1]='Ekonomik';
        $kategori[2]='Orta Sınıf';
        $kategori[3]='Üst Sınıf';
        $kategori[4]='VIP';

        return  $kategori;
    }

    public function klimaTur()
    {
        $kategori[1]='Otomatik(Dijital)';
        $kategori[2]='Manuel';

        return  $kategori;
    }

    public function yakitTur()
    {
        $kategori[1]='Benzin';
        $kategori[2]='Lpg';
        $kategori[3]='Benzin/Lpg';
        $kategori[4]='Dizel';
        $kategori[5]='Elektrik';
        $kategori[6]='Hybrit';
        return  $kategori;
    }

    public function vitesTur()
    {
        $kategori[1]='Manuel';
        $kategori[2]='Yarı Otomatik';
        $kategori[3]='Otomatik';
        $kategori[4]='Triptonik';
        return  $kategori;
    }

    public function ofis($ilce)
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `arac_ofis` where ilce_id='.$ilce.'
        "));

        return  $data;
    }

    public function ofisbilgi($ofis)
    {
        
        $data = DB::select(DB::raw("
            SELECT * FROM `arac_ofis` where ofis_id=".$ofis."
        "));
        return  $data;
    }

    
    public function ilce($il)
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `ilce` where il_id=".$il."
        "));

        return  $data;
    }
    public function il()
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `il`
        "));

        return  $data;
    }

   


    public function d_ofis($d_ilce)
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `arac_ofis` where ilce_id='.$d_ilce.'
        "));

        return  $data;
    }

    public function d_ilce($d_il)
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `ilce` where il_id=".$d_il."
        "));

        return  $data;
    }
    public function d_il()
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `il`
        "));

        return  $data;
    }

    public function rezarvasyon()
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `rezervasyon_extralari`
        "));

        return  $data;
    }

    public function dil()
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `languages`
        "));

        return  $data;
    }


    public function afiyat($a_id,$isGunluk=0)
    {
        $data = AracFiyat::where('arac_id', $a_id); 
        if(!empty(session('pb')))
        {
            $data=$data->where('para_birim_id',session('pb'));
        }
        else{
            $data=$data->where('para_birim_id',1);
        }
        
        if($isGunluk!=0)
        {
            $data=$data->where('gun_baslangic',1)->first();
        }
        else{
            $data=$data->get()->toArray();
        }

        return  $data;
    }

    
    public function parabirim($para_birim_id)
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `para_birimi` where para_birim_id=".$para_birim_id."
        "));

        return  $data;
    }

    public function firmabilgi()
    {
        $data = ayarlar::where('ayar_id', 1)->first(); 

        return  $data;
    }

    public function parabirimi()
    {
        $data = DB::table('para_birimi')->get();


        return  $data;
    }

    public function dilbilgisi()
    {
        $data = DB::table('languages')->get();

        return  $data;
    }

   

    public function anasayfa()
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
     
    

        $sliderVerileri = Slider::all(); 
        
        
        $haberVerileri = Haber::all(); 
        return ['aracVerileri'=> $aracVerileri,'sliderVerileri'=>$sliderVerileri,'haberVerileri'=>$haberVerileri ];
    }

    public function rezsayi()
    { $kullanici= json_decode(Session::get('kullanici'));
        $Musteri = Musteri::where('e_posta', $kullanici->e_posta)->first();
       
        $data = DB::select(DB::raw("
        SELECT count(id) as sayi FROM `kiralanan_arac` where musteri_id=".$Musteri->mus_id
           
        ));

        return  $data;
    }

    public function ilbilgi($il)
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `il` where il_id=".$il."
        "));

        return  $data;
    }

    public function ilcebilgi($ilce)
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `ilce` where ilce_id=".$ilce
        ));

        return  $data;
    }

    public function rezucret($pb)
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `rezervasyon_extralari` where para_birim_id=".$pb
        ));

        return  $data;
    }
    public function ismusteri($email)
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `musteri` where e_posta='".$email."'"));
        return  $data;
    }
    public function isuye($email)
    {
        $data = DB::select(DB::raw("
            SELECT * FROM `uyeler` where e_posta='".$email."'"));
        return  $data;
    }
    
}
