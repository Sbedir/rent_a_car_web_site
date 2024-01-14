<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Services\GenelService;
use App\Models\Uye;
use App\Models\Musteri;
use App\Models\KiralananArac;
use Illuminate\Support\Str;



use Illuminate\Http\Request;

class FiyatlistesiController extends Controller
{
    protected $genelService;
    
    public function __construct(GenelService $genelService)
    {
        $this->genelService = $genelService;
    }
    public function submitForm(Request $request)
    {
        $veri = json_decode($request->input('deger'), true);
        $tarih1 = Carbon::parse($veri["donus_tarihi"]);
        $tarih2 = Carbon::parse($veri["alis_tarihi"]);
        $pb = Session::get('pb')?json_decode(Session::get('pb')):1;
        $parabirim = $this->genelService->parabirim($pb);
        $pbirim= isset($parabirim[0])?$parabirim[0]:"";
       
        $rezarvasyon = $this->genelService->rezucret($pb);
        $rez= isset($rezarvasyon[0])?$rezarvasyon[0]:"";
        $farkt = $tarih1->diffInDays($tarih2);
        $fark=$farkt+1;
        
        $fiyatlar = DB::table('arac_fiyati')
            ->where('gun_baslangic', '<=', $fark)
            ->where('gun_bitis', '>=', $fark)
            ->where('para_birim_id', $pb)
            ->where('arac_id', $veri['arac']['a_id'])
            ->get();
        
        $toplamfiyat = 0;
       
        
        foreach ($fiyatlar as $fiyat) {
            // Her bir fiyatı toplam fiyata ekleyin
            $toplamfiyat += $fark * $fiyat->fiyat;
             // varsayalım ki fiyat sütunu "fiyat" olarak adlandırılmış
        }
        
        return view('fiyat-listesi2', compact('veri', 'fark', 'fiyatlar', 'toplamfiyat','pbirim','rez'));
        
    }
    
    public function submitFormOnayla(Request $request)
    {
        $veri = json_decode($request->input('deger'), true);
        $navigasyon=$request->input('navigasyon')??'';
        $sofor_hizmeti=$request->input('sofor_hizmeti')??'';
        $bebek_koltugu=$request->input('bebek_koltugu')??'';
        $yol_haritasi=$request->input('yol_haritasi')??'';

        $ad=$request->input('ad');
        $soyad=$request->input('soyad');
        $dogum=$request->input('dogum');
        $ucus=$request->input('ucus');
        $cep=$request->input('cep');
        $email=$request->input('email');
        $ozel=$request->input('ozel');
        $uyeol=$request->input('uyeol')??'';
        $pass1=$request->input('pass1');

      
        $tarih1 = Carbon::parse($veri["donus_tarihi"]);
        $tarih2 = Carbon::parse($veri["alis_tarihi"]);
        $pb = Session::get('pb')?json_decode(Session::get('pb')):1;
        $parabirim = $this->genelService->parabirim($pb);
        $pbirim= isset($parabirim[0])?$parabirim[0]:"";
       
        $rezarvasyon = $this->genelService->rezucret($pb);
        $rez= isset($rezarvasyon[0])?$rezarvasyon[0]:"";
        $farkt = $tarih1->diffInDays($tarih2);
        $fark=$farkt+1;
        
        $fiyatlar = DB::table('arac_fiyati')
            ->where('gun_baslangic', '<=', $fark)
            ->where('gun_bitis', '>=', $fark)
            ->where('para_birim_id', $pb)
            ->where('arac_id', $veri['arac']['a_id'])
            ->get();
        
        $toplamfiyat = 0;
       
        
        foreach ($fiyatlar as $fiyat) {
            // Her bir fiyatı toplam fiyata ekleyin
            $toplamfiyat += $fark * $fiyat->fiyat;
             // varsayalım ki fiyat sütunu "fiyat" olarak adlandırılmış
        }

        if($navigasyon!='')
        {
            $toplamfiyat=$toplamfiyat+(intval($rez->navigasyon));
        }

        if($sofor_hizmeti!='')
        {
            $toplamfiyat=$toplamfiyat+(intval($rez->sofor_hizmeti));
        }

        if($bebek_koltugu!='')
        {
            $toplamfiyat=$toplamfiyat+(intval($rez->bebek_koltugu));
        }

        if($yol_haritasi!='')
        {
            $toplamfiyat=$toplamfiyat+(intval($rez->yol_haritasi));
        }
        

        try {
            
            $musteri = $this->genelService->ismusteri($email);
            $ismusteri= isset($musteri[0])?$musteri[0]:"";
            $carbonDate = Carbon::createFromFormat('d/m/Y', $dogum);
            $databaseDate = $carbonDate->toDateString();
          
            if( $ismusteri=="")
            {
                $musteri = new Musteri;
                $musteri ->mus_adi = $ad;
                $musteri ->mus_soyadi = $soyad;
                $musteri ->d_tarih = $databaseDate;
                $musteri ->cep_tel = $cep;
                $musteri ->e_posta = $email;
                $musteri ->ucus_notlari = $ucus;
                $musteri ->ozel_notlar = $ozel;
                $musteri->save();
            }
            if( $uyeol=="")
            {
                $uye = $this->genelService->isuye($email);
                $isuye= isset($uye[0])?$uye[0]:"";
                if( $isuye=="")
                {
                    $uye = new Uye;
                    $uye ->uye_adi = $ad;
                    $uye ->uye_soyadi = $soyad;
                    $uye ->d_tarih = $databaseDate;
                    $uye ->cep_tel = $cep;
                    $uye ->e_posta = $email;
                    $uye ->password =md5($pass1) ;
                    $uye->save();
                }
            }
            $id = $request->input('id');
            $musteri = $this->genelService->ismusteri($email);
            $musteriId = isset($musteri[0]) ? $musteri[0]->mus_id : $musteri->mus_id;

            $aracId = $veri['arac']['a_id'];
            $alisTarihi = $veri['alis_tarihi'];
            $donusTarihi = $veri['donus_tarihi'];

            $aracVerileri = DB::select(DB::raw("
                SELECT *
                FROM `kiralanan_arac` a
                WHERE musteri_id = " . $musteriId . "
                AND arac_id = " . $aracId . "
                AND alis_tarihi = '" . $alisTarihi . "'
                AND donus_tarihi = '" . $donusTarihi . "'
            "));

            if(!empty($aracVerileri))//boşmu kontrol
            {
                $mesaj='Bu aracı verdiğiniz verdiğiniz tarihler arasında daha önceden rezarvasyon talebi oluşturmuşsunuz.Rezarvasyon onayını mailinize gelen rezarvasyon kodu ile sorgulayabilirsiniz.';
                $mesajKodu=500;
                return view('fiyat-listesi-onay', compact('veri', 'fark', 'fiyatlar', 'toplamfiyat','pbirim','rez','mesaj','mesajKodu'));
            }
            $aracVerileri = DB::select(DB::raw("
            SELECT *
            FROM `kiralanan_arac` a where arac_id=".$veri['arac']['a_id']." and ((alis_tarihi<='".$veri['alis_tarihi']."' and donus_tarihi>='".$veri['alis_tarihi']."') or (alis_tarihi<='".$veri['donus_tarihi']."' and donus_tarihi>='".$veri['donus_tarihi']."')) 
            "));
            
            if(!empty($aracVerileri))//boşmu kontrol
            {
                $mesaj='Bu tarihler arasında rezarvasyon talebinde bulunmuş olduğunuz arac kiralanmıştır.Lütfen farklı bir arac veya ileri bir tarih seçiniz.';
                $mesajKodu=500;
                return view('fiyat-listesi-onay', compact('veri', 'fark', 'fiyatlar', 'toplamfiyat','pbirim','rez','mesaj','mesajKodu'));
            }

             $kirArac = new KiralananArac;
             $kirArac ->arac_id =$veri['arac']['a_id'];
             $kirArac ->alis_yeri_id = $veri['a_ofis'];
             $kirArac ->donus_yeri_id =$veri['d_ofis'];
             $kirArac ->alis_tarihi = $veri['alis_tarihi'];
             $kirArac ->donus_tarihi =$veri['donus_tarihi'];
             $kirArac ->kiralanan_fiyat = $fiyatlar[0]->fiyat;
             $kirArac ->toplam_tutar =$toplamfiyat;
             $kirArac ->navigasyon = $navigasyon!=""? 1:0;
             $kirArac ->sofor_hizmeti =$sofor_hizmeti!="" ? 1:0;;
             $kirArac ->bebek_koltugu =$bebek_koltugu!=""? 1:0;;
             $kirArac ->yol_haritasi =$yol_haritasi!=""? 1:0;;
             $kirArac ->para_birim_id =$pb;
             $kirArac ->musteri_id =isset($musteri[0])?$musteri[0]->mus_id:$musteri->mus_id;
             $randomString = Str::random(8);
             $kirArac ->dropoff=0;
             $kirArac->rez_kod=$randomString;
             $kirArac->save();
             
             $mesaj='Rezervasyon işleminiz başarıyla tamamlandı!';
             $mesajKodu=200;
             $mus=(isset($musteri[0])?$musteri[0]:$musteri);
           
             return view('fiyat-listesi-onay', compact('veri', 'fark', 'fiyatlar', 'toplamfiyat','pbirim','rez','mesaj','mesajKodu','mus'));
        
    } catch (Exception $e) {
        // Hata yakalandığında yapılacak işlemler burada yer alır
        dd($e->getMessage()); // Hata mesajını bastırma
    }
        
    }

    public function parabirimsec($parabirimi)
    {
        session()->put('pb',$parabirimi);
    return true;
    }

    public function dilsec($dil)
    {
        session()->put('dil',$dil);
    return true;
    }
   

 
    
}
