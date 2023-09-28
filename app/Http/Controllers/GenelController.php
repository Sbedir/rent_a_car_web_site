<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arac;
use App\Models\Uye;
use App\Models\AracFiyat;
use App\Models\Rezarvasyon;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\GenelService;
// use Illuminate\Support\Facades\Session;
class GenelController extends Controller
{
    protected $genelService;
    
    public function __construct(GenelService $genelService)
    {
        $this->genelService = $genelService;
    }
  
    public function ilce(Request $request)
    {   
          $ilId = $request->query('il_id');
          $ilceler = $this->genelService->ilce($ilId);
          return response()->json($ilceler);
    }

    public function ofis(Request $request)
    {   
          $ilceId = $request->query('ilce_id');
          $ofisler = $this->genelService->ofis($ilceId);
          return response()->json($ofisler);
    }



    public function kiralamaucrethesap(Request $request)
    {   
   

      $ilkTarih = Carbon::parse(explode(' ',$request['alis_tarihi'])[0]);

      // İkinci tarihi oluşturun
      $ikinciTarih = Carbon::parse(explode(' ',$request['donus_tarihi'])[0]);

      // İki tarih arasındaki gün farkını hesaplayın
      $fark = $ilkTarih->diffInDays($ikinciTarih);
      $gun=$fark+1;


      $aracfiyatverileri = AracFiyat::where('arac_id', $request['arac_id'])
      ->where('para_birim_id',$request['para_birim'])
      ->where('gun_baslangic', '<=', $gun)
      ->where('gun_bitis', '>=', $gun)
      ->first();
      if($aracfiyatverileri==null)
      {
            return response()->json(['hata'=>'*** '.$gun.' gün için bu araca ait fiyat bilgisi bulunamadı.Lütfen araca gün fiyat bilgisi ekleyiniz!']);
      }
      $rezervasyonfiyatverileri = Rezarvasyon::where('para_birim_id',$request['para_birim'])
      ->first();
      $kiralananFiyat=$aracfiyatverileri->fiyat;
      $toplamFiyat= $kiralananFiyat*$gun;
      if($request['sofor_hizmeti']=='true')
      {
            $toplamFiyat+=$rezervasyonfiyatverileri->sofor_hizmeti*$gun;
      }
      if($request['navigasyon']=='true')
      {
            $toplamFiyat+=$rezervasyonfiyatverileri->navigasyon;
      }
      if($request['bebek_koltugu']=='true')
      {
            $toplamFiyat+=$rezervasyonfiyatverileri->bebek_koltugu;
      }
      if($request['yol_haritasi']=='true')
      {
            $toplamFiyat+=$rezervasyonfiyatverileri->yol_haritasi;
      }

      return response()->json(['kiralananFiyat'=>$kiralananFiyat,'toplamFiyat'=>$toplamFiyat]);
      //     $ilceId = $request->query('ilce_id');
      //     $ofisler = $this->genelService->ofis($ilceId);
      //     return response()->json($ofisler);
    }

    public function aracSearch(Request $request)
    {
      $mrmdl = $request->query('mrmdl');
      $yakit = $request->query('yakit');
      $vites = $request->query('vites');
      $kategori = $request->query('kategori');
      $a_il = $request->query('a_il');
      $a_ilce = $request->query('a_ilce');
      $a_ofis = $request->query('a_ofis');
      $d_il = $request->query('d_il');
      $d_ilce = $request->query('d_ilce');
      $d_ofis = $request->query('d_ofis');
      $alis_tarihi = $request->query('alis_tarihi');
      $donus_tarihi = $request->query('donus_tarihi');
      $where='';
      $join='';
    
      if($mrmdl!=='' && $mrmdl!==null)
      {
            $where="CONCAT(m.mr_isim,' / ',mo.m_name) like '%".$mrmdl."%' ";
      }
      if($yakit!=='' && $yakit!==null && intval($yakit)>0)
      {
            if($where!=='')
            {
                  $where.=' and ';
            }
            $where.='a.yakit_tur='.$yakit;
      }
      if($vites!=='' &&  $vites!==null && intval($vites)>0)
      {
            if($where!=='')
            {
                  $where.=' and ';
            }
            $where.='a.vites_tur='.$vites;
      }

      if($kategori!=='' &&  $kategori!==null && intval($kategori)>0)
      {
            if($where!=='')
            {
                  $where.=' and ';
            }
            $where.='a.a_kategori='.$kategori;
      }


      if($where!=='')
            {
                  $where=' where '.$where;
            }
          

            if($alis_tarihi!="" && $donus_tarihi!="" &&  $alis_tarihi!==null &&  $donus_tarihi!==null)
            {
                  $join="LEFT JOIN kiralanan_arac ka on a.a_id=ka.arac_id and ((ka.alis_tarihi<='".$alis_tarihi ."' and ka.donus_tarihi>='".$alis_tarihi."') || (ka.alis_tarihi<='".$donus_tarihi ."' and ka.donus_tarihi>='".$donus_tarihi."'))" ;
            }


      $aracVerileri = DB::select(DB::raw("
      SELECT a.*, m.mr_isim AS marka_name, mo.m_name AS model_name,
      IF(a.a_musait = 1, 'Müsait', 'Müsait Değil') AS arac_musait,
      IF(a.yakit_tur = 1, 'Benzin', IF(a.yakit_tur = 2, 'LPG', IF(a.yakit_tur = 3, 'Benzin/LPG', IF(a.yakit_tur = 4, 'Dizel', IF(a.yakit_tur = 5, 'Elektrik', 'Hybrid'))))) AS yakit_tur_adi,
      IF(a.vites_tur = 1, 'Manuel', IF(a.vites_tur = 2, 'Yarı Otomatik', IF(a.vites_tur = 3, 'Otomatik', 'Triptonik'))) AS vites_tur_name,
      IF(a.a_kategori = 1, 'Ekonomik', IF(a.a_kategori = 2, 'Orta Sınıf', IF(a.a_kategori = 3, 'Üst Sınıf', 'VIP'))) AS kategori_name,
      IF(a.klima_tur = 1, 'Otomatik', 'Manuel') AS klima_tur_name,
      CONCAT(il.il_name,' / ',ilce.ilce_name,' / ',ao.ofis_name) ofis_adi,
      il.il_id,ilce.ilce_id ".($join!==''?',
      IF(ka.arac_id is not null,1,0) as kiralik':'')."
      FROM `arac` a
      LEFT JOIN marka m ON m.mr_id = a.mr_id
      LEFT JOIN model mo ON mo.m_id = a.m_id
      LEFT JOIN arac_ofis ao on ao.ofis_id=a.ofis_id
      LEFT JOIN ilce on ilce.ilce_id=ao.ilce_id
      LEFT JOIN il on il.il_id=ilce.il_id
      ".$join.$where));
      
      $araclar=[];
      foreach($aracVerileri as $arac)
      {
            $afiyat = $this->genelService->afiyat($arac->a_id);
            foreach($afiyat as $fiyat)
            {
                  $fiyat=(array) $fiyat;
                  $arac=(array) $arac;
                  $paraBirimi = $this->genelService->parabirim($fiyat['para_birim_id']);
                  $fiyat['paraBirimi']=$paraBirimi[0]->para_name;
                  $fiyat['namee']=$fiyat['gun_baslangic'].' - '.$fiyat['gun_bitis'].' Gün Aralığı';
                  $fiyat['deger']=$fiyat['fiyat'].' - '.$fiyat['paraBirimi'];
                  $arac['fiyat'][]=$fiyat;

            }
            $araclar[]=$arac;
      }
      return response()->json($araclar);
    }

    public function logout()
    {

      // session_destroy();
      session()->forget('kullanici');
      return redirect('anasayfa');
    }



    public function login(Request $request)
    {
        $e_posta = $request->input('e_posta');
        $password = $request->input('password');
   
        // Kullanıcı adına göre kullanıcıyı buluyoruz
        $Uye = Uye::where('e_posta', $e_posta)->first();

        if ($Uye) {
            // Eğer kullanıcı varsa, şifre kontrolü yapabiliriz
            if (md5($password)==$Uye->password) {
                session()->put('kullanici', json_encode($Uye));
                // Şifre doğruysa, kullanıcı giriş yapmıştır
                // İstediğiniz işlemi burada gerçekleştirebilirsiniz
                return redirect()->route('uye-panel'); // Örnek olarak yönlendiriyoruz
            }
        }
    
        // Eğer kullanıcı adı veya şifre yanlışsa, giriş sayfasına geri dönebiliriz
        return redirect()->route('uye-giris')->with('error', 'E-posta veya şifre hatalı.');
    }


    
    

   

    
    
    
    
    
 

    
}
