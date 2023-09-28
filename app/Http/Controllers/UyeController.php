<?php

namespace App\Http\Controllers;
use App\Models\Uye;
use App\Models\Musteri;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UyeController extends Controller
{
    public function uyeler()
    {
        $uyeVerileri = Uye::all(); 
        
        // Tüm kullanıcıları çekmek için

    return view('uye-giris', compact('uyeVerileri'));
    }

    public function kullanicibilgi()
    {
        $kullaniciVeri = json_decode(Session::get('kullanici'));
        
      

    return view('uye-paneli', compact('kullaniciVeri'));
    }

  

  


   
   
   
    public function uyeekleme(Request $request)
    {
        try {
           
              


                $kullanici = json_decode(Session::get('kullanici'));

       if ($kullanici) {
      // Kullanıcı oturum açmışsa güncelleme işlemi yap
      $e_posta = $request->input('e_posta');
      
      $password = $request->input('password');

      // Kullanıcıyı e-posta adresine göre bul
      $Uye = Uye::where('e_posta', $kullanici->e_posta)->first();

   
      if ($Uye) {
        // Kullanıcı bulundu, şimdi güncelleme işlemini yapabilirsiniz
      
        
        $newpassword = $request->input('password2');
        $oldpassword = $request->input('password');
      
        // Şifre güncellemesi yapmak isterseniz aşağıdaki kodu kullanabilirsiniz
        if($newpassword!=""&&$newpassword!=null)
        {
          
            if ( $Uye->password===md5($oldpassword)) {

                
                $Uyem = Uye::where('uye_id', $Uye->uye_id)
                ->update([
                    'password'=> md5($newpassword)
              
                ]);
                return redirect()->back()->with('success', 'Şifre değiştirme işlemi başarılı.');
            }
            else{
       
                return redirect()->back()->with('error', 'Eski şifre yanlış!');
            }
        }
        else{
            $Uyem = Uye::where('uye_id', $Uye->uye_id)
            ->update([
                'uye_adi'=> $request->input('uye_adi'),
                'uye_soyadi'=> $request->input('uye_soyadi'),
                'd_tarih'=> $request->input('d_tarih'),
                'cep_tel'=> $request->input('cep_tel'),
              
            ]);
           
            $guncellenenUye = Uye::where('uye_id', $Uye->uye_id)->first();
           
            session()->put('kullanici', json_encode($guncellenenUye));
        }

     

       
        $musteri = Musteri::where('e_posta',$e_posta)->first();
        if($musteri)
        {
            $Musteri = Musteri::where('mus_id', $musteri->mus_id)
            ->update([
                'mus_adi'=> $request->input('uye_adi'),
                'mus_soyadi'=> $request->input('uye_soyadi'),
                'd_tarih'=> $request->input('d_tarih'),
                'cep_tel'=> $request->input('cep_tel'),
              
            ]);
           
        }
        
       
        return redirect()->back()->with('success_guncel', 'Üye bilgileriniz güncellendi.');
            } 
      else
       {
        return redirect()->back()->with('error_guncel', 'Kullanıcı bulunamadı.');
       }
                     } 
     else
     {
      // Kullanıcı oturum açmamışsa yeni üye eklemesi yapın
      $e_posta = $request->input('e_posta');
               


            
     $UyeVeri = Uye::where('e_posta', $e_posta)->first();
    
     if(!$UyeVeri)
     {
        $Uye = new Uye;
        $Uye ->uye_adi = $request->input('uye_adi');
        $Uye ->e_posta = $request->input('e_posta');
        $Uye ->uye_soyadi = $request->input('uye_soyadi');
        $Uye ->d_tarih = $request->input('d_tarih');
        $Uye ->cep_tel = $request->input('cep_tel');
        $Uye ->password = md5($request->input('password'));
        $Uye->save();
        $musteriVeri = Musteri::where('e_posta',$e_posta)->first();
     
        if(!$musteriVeri)
        {
            $musteri = new Musteri;
            $musteri ->mus_adi = $request->input('uye_adi');
            $musteri ->e_posta = $request->input('e_posta');
            $musteri ->mus_soyadi = $request->input('uye_soyadi');
            $musteri ->d_tarih = $request->input('d_tarih');
            $musteri ->cep_tel = $request->input('cep_tel');
            $musteri->save();
        }
        
        
       return redirect()->back()->with('success', 'Üye olma işlemi başarılı şekilde gerçekleşmiştir.');
     }

     else
     {
        return redirect()->back()->with('error', 'Üye olma işlemi başarısız olmuştur,bu e-posta daha önceden kayıt olmuştur!..');
     }
     }

                    
             }
               

             
         catch (Exception $e) {
            // Hata yakalandığında yapılacak işlemler burada yer alır
            dd($e->getMessage()); // Hata mesajını bastırma
        }
    }


    public function kullanicirez()
    {
        $e_posta = session('kullanici.e_posta');
        $musteri = Musteri::where('e_posta',$e_posta)->first();
        $musteri = Musteri::where('e_posta',$e_posta)->first();

    }
    
}