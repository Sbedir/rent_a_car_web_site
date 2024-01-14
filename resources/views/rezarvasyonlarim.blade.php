@extends('layout')
 @section('icerik')
 @inject('ts', 'App\Services\TranslateService')

            <div class="col-md-9">
                                <h1 class="bigtitle"><strong>{{$ts->t("Rezervasyonlarım")}} #</strong></h1>
                
                <table class="table table-responsive table-striped table-bordered table-hover">
                <tr>
                    <th class="ctext">{{$ts->t("Resim")}}</th>
                    <th class="mobhide">{{$ts->t("Marka")}}</th>
                    <th class="mobhide">{{$ts->t("Alış Tarihi")}} / {{$ts->t("Dönüş Tarihi")}}</th>
                    <th class="mobhide">{{$ts->t("Rezervasyon")}} </th>
                    <th class="mobhide">{{$ts->t("Toplam Ücret")}}</th>
                    <th class="mobhide">{{$ts->t("Durum")}}</th>
                </tr>
                @foreach($aracVerileri as $kiralik)              
                <tr>
                    <td class="ctext">
                        <img src="{{ config('app.imgurl').$kiralik->resim }}" class="lowthumb" />
                        <div class="mobshow">

                            <strong>{{$ts->t("Marka")}}:</strong>{{$kiralik->arac_adi }} <br />
                            <strong>{{$ts->t("Alış Tarihi")}}:</strong> {{$kiralik->alis_tarihi }} <br />
                            <strong>{{$ts->t("Dönüş Tarihi")}}:</strong> {{$kiralik->donus_tarihi }} <br />
                            <strong>{{$ts->t("Rezervasyon")}} #:</strong> 650b2162156a7<br />
                            <strong>{{$ts->t("Toplam Ücret")}}:</strong>{{$kiralik->arac_top_fiyat }}{{$kiralik->para_birim }}<br />
                            <strong>{{$ts->t("Durum")}}:</strong> <span class="glyphicon glyphicon-dashboard"></span> {{$kiralik->onay==1?"Onaylandı":($kiralik->onay==2?"Reddedildi":"Onay Bekliyor") }} </div>
                    </td>
                    <td class="mobhide"> {{$kiralik->arac_adi }}</td>
                    <td class="mobhide"> {{$kiralik->alis_tarihi }}<br /> {{$kiralik->donus_tarihi }}</td>
                    <td class="mobhide">650b2162156a7</td>
                    <td class="mobhide"> {{$kiralik->arac_top_fiyat." ".$kiralik->para_birim }}</td>
                    <td class="mobhide"><span class="glyphicon glyphicon-dashboard"></span>  {{$kiralik->onay==1?"Onaylandı":($kiralik->onay==2?"Reddedildi":"Onay Bekliyor") }}</td>
                </tr>
                @endforeach
                                </table>
                            </div>
                            </div>
    </div>
    @endsection
    