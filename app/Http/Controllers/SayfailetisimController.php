<?php

namespace App\Http\Controllers;
use App\Models\Sayfailetisim;
use App\Models\Mesajiletisim;


use Illuminate\Http\Request;

class SayfailetisimController extends Controller
{
    public function sayfailetisim()
    {
        $SayfailetisimVerileri = Sayfailetisim::where('ayar_id', 1)->first();
       
    return view('iletisim', compact('SayfailetisimVerileri'));

    }

  

    public function mesaj(Request $request)
    {
        try {
                $ilet_id = $request->input('ilet_id');
               


                if(intval($ilet_id)!==0)
                {
                    $sayfaVerileri = Mesajiletisim::where('ilet_id', $ilet_id)->first();
                    if(empty($sayfaVerileri))
                    {
                        $sayfa = new Mesajiletisim;
                    }
                    else
                    {
                        $validatedData = $request->validate([
                            'ad_soyad' => 'required|string',
                            'e_posta' => 'required|string',
                            'konu' => 'required|string',
                            'mesaj' => 'required|string'
                          
                       
                       
                        ]);
                        $sayfa = Mesajiletisim::where('ilet_id', $ilet_id)
                        ->update([
                            'ad_soyad'=> $validatedData['ad_soyad'],
                            'e_posta'=> $validatedData['e_posta'],
                            'konu' => $validatedData['konu'],
                            'mesaj' => $validatedData['mesaj']
                          

                          
                        ]);
                        return redirect()->back()->with('success', 'Mesajınız gönderilmiştir.');
                    }
                }
                else
                {
                    
                    $sayfa = new Mesajiletisim;
                 }

                 $sayfa ->ad_soyad = $request->input('ad_soyad');
                 $sayfa ->e_posta = htmlspecialchars($request->input('e_posta'));
                 $sayfa ->konu = $request->input('konu');
                 $sayfa ->mesaj = $request->input('mesaj');

              
                 
                
                 $sayfa->save();
                 return redirect()->back()->with('success', 'İletişim mesajınız gönderilmiştir.');
        } catch (Exception $e) {
            // Hata yakalandığında yapılacak işlemler burada yer alır
            dd($e->getMessage()); // Hata mesajını bastırma
        }
    }
}
