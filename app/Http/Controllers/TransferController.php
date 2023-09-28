<?php

namespace App\Http\Controllers;
use App\Models\Transfer;
use App\Models\Musteri;
use App\Models\Transferrezarvasyon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function transferhizmet()
    {
      
        $transferVerileri = DB::select(DB::raw("
        SELECT th.*, pb.para_name AS para_birim,
        i_a.ilce_name AS alis_yeri,
        i_d.ilce_name AS donus_yeri,
          ai.il_id,i_a.ilce_id,i_d.ilce_id,di.il_id
      
       
      
        FROM `transfer_hizmet` th
        LEFT JOIN para_birimi pb ON th.para_birim_id = pb.para_birim_id
        LEFT JOIN ilce AS i_d on i_d.ilce_id=th.donus_yeri
        LEFT JOIN ilce AS i_a on i_a.ilce_id=th.alis_yeri
        LEFT JOIN il AS ai on ai.il_id=i_a.il_id
        LEFT JOIN il AS di on di.il_id=i_d.il_id
       
        "));
        
        // Tüm kullanıcıları çekmek için

    return view('transfer', compact('transferVerileri'));
    }

    public function musteri()
    {
        $musteriVerileri = Musteri::all();
       
    return view('transfer', compact('musteriVerileri'));

    }

    public function createUpdate(Request $request)
    {
        try {
            $mus_model = Musteri::where('e_posta', $request->input('e_posta'))->first();
          
            $date=$request->input('d_tarih'); /// 11/09/1997
            /// 1997-09-11
            $ayirDate=explode('/',$date);
            $newDate=$ayirDate[2].'-'.$ayirDate[1].'-'.$ayirDate[0];
         
            if(empty($mus_model))
            {
                $mus_model = new Musteri;
                $mus_model ->mus_adi =$request->input('mus_adi');
                $mus_model ->mus_soyadi= $request->input('mus_soyadi');
                $mus_model ->d_tarih=  $newDate;
                $mus_model ->ucus_notlari= $request->input('ucus_notlari');
                $mus_model ->cep_tel= $request->input('cep_tel');
                $mus_model ->e_posta= $request->input('e_posta');
                $mus_model ->ozel_notlar= $request->input('ozel_notlar');
                $mus_model->save();
            }
            else{
                $mus_model = Musteri::where('mus_id', $mus_model->mus_id)
                ->update([
                    'mus_adi'=> $request->input('mus_adi'),
                    'mus_soyadi'=> $request->input('mus_soyadi'),
                    'd_tarih' =>  $newDate,
                    'ucus_notlari' => $request->input('ucus_notlari'),
                    'cep_tel' => $request->input('cep_tel'),
                    'e_posta' => $request->input('e_posta'),
                    'ozel_notlar' => $request->input('ozel_notlar'),
                ]);
                
            }

        
            $mus = Musteri::where('e_posta', $request->input('e_posta'))->first();

            $transfer = new Transferrezarvasyon;
            $transfer ->t_id = $request->input('trans');
            $transfer ->mus_id=  $mus->mus_id;
            $transfer ->rez_kod= null;
            $transfer ->onay= null;
            $transfer->save();
                 return redirect()->back()->with('success', 'Sn. '.$mus->mus_adi.' '.$mus->mus_soyadi.',
                 Transfer rezervasyonu isteğiniz başarıyla gönderildi. Rezervasyon ile ilgili detaylar için lütfen e-posta adresinizin gelen kutusunu kontrol edin.');
        } catch (Exception $e) {
            // Hata yakalandığında yapılacak işlemler burada yer alır
            dd($e->getMessage()); // Hata mesajını bastırma
        }
    }

}
