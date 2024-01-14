<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TranslateService
{
    public function t($unic_name)
    {      $dil= (Session::get('dil'))??1;
      
        $data = DB::select(DB::raw("
            SELECT tr.translate_id translate_id_tr, tr.unic_name unic_name_tr, tr.name name_tr, tr.language_id language_id_tr,
            en.translate_id translate_id_en, en.unic_name unic_name_en, en.name name_en, en.language_id language_id_en
            FROM `translate` tr 
            LEFT JOIN translate en ON en.unic_name = tr.unic_name AND en.language_id = 2
            WHERE tr.language_id = ".$dil." AND tr.unic_name = '".$unic_name."'
        "));
       
        if (!isset($data[0])) {
            $insert=DB::table('translate')->insert([
                'unic_name' => $unic_name,
                'name' => $unic_name,
                'language_id' => $dil,
            ]);
           
            return $this->t($unic_name);
        }
      
        return isset($data[0]) ? $data[0]->name_tr : '';
    }
}
