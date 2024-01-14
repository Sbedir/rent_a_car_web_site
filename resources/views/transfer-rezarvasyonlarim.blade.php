@extends('layout')
 @section('icerik')
 @inject('ts', 'App\Services\TranslateService')
<div class="col-md-9">
                                <h1 class="bigtitle"><strong>{{$ts->t("Transfer Rezervasyonlarım")}}</strong></h1>
                
                <table class="table table-responsive table-striped table-bordered table-hover">
                <tr>
                    <th>{{$ts->t("Alış Yeri")}}</th>
                    <th>{{$ts->t("Dönüş Yeri")}}</th>
                    <th>{{$ts->t("Mesafe")}}</th>
                    <th>{{$ts->t("Tarih")}}</th>
                    <th>{{$ts->t("Durum")}}</th>
                </tr>
                @foreach($rezVerileri as $rez)  
                                <tr>
                    <td>{{$rez->alis_yeri }}</td>
                    <td>{{$rez->donus_yeri }}</td>
                    <td>{{$rez->mesafe }}</td>
                    <td>{{$ts->t("Alış Tarihi")}}: {{$rez->alis_tarihi }}<br />{{$ts->t("Dönüş Tarihi")}}: {{$rez->donus_tarihi }}</td></td>
                    <td><span class="glyphicon glyphicon-dashboard"></span> {{$rez->onay==1?"Onaylandı":($rez->onay==2?"Reddedildi":"Onay Bekliyor") }}</td>
                </tr>
                      @endforeach
                                </table>
                          
      </div>
      </div>
    </div>
    @endsection