@extends('layout')
@section('icerik')
@inject('genelService', 'App\Services\GenelService')
@inject('ts', 'App\Services\TranslateService')
<div class="container firstclear rezcizgi ultrahide">
        <div class="row">
            <div class="col-md-4 relat nopad cizgicont">
                <div class="cizgi sec">&nbsp;</div>
                <div class="cizgion sec">
                    <label>1</label>
                    <strong style="color: #666666;">{{$ts->t("Araç Seçimi")}}</strong>
                       {{$ts->t(" Kiralamak istediğiniz aracı seçin ")}}           </div>
            </div>
            <div class="col-md-4 relat nopad cizgicont">
                <div class="cizgi sec">&nbsp;</div>
                <div class="cizgion sec">
                    <label>2</label>
                    <strong style="color: #666666;">{{$ts->t("Kişisel Bilgiler ve Ödeme")}}</strong>
                        {{$ts->t(" Kredi kartı ile güvenli ödeme gerçekleştirin")}}           </div>
            </div>
            <div class="col-md-4 relat nopad cizgicont">
                <div class="cizgi sec">&nbsp;</div>
                <div class="cizgion sec">
                    <label>3</label>
                    <strong>{{$ts->t("Rezervasyon Onayı")}}</strong>
                     {{$ts->t("Rezervasyon sonucunuzu görüntüleyin ")}}              </div>
            </div>
        </div>
    </div>


   
    @if($mesajKodu==200)
    <div class="container firstclear marbot">
        <div class="col-md-12">
            <h1 class="bigtitle"><strong>{{$ts->t("Rezervasyon Tamamlandı")}}</strong></h1>
            
            <div class="col-md-12 total rounded green">
                       {{$ts->t("Rezervasyon işleminiz başarıyla tamamlandı!")}}     </div>
        </div>
    </div>
    <div class="container marbot">
        <div class="col-md-12 total rounded yellow">
            <strong>Sn, {{$mus->mus_adi.' '.$mus->mus_soyadi}}</strong><br>
            {{$ts->t("Rezervasyonunuz şuanda onay beklemektedir")}}.{{$ts->t(" Onay işlemi ardından bir e-posta ile bilgilendirileceksiniz!")}}    </div>
    </div>

    <div class="container martop marbot">
        <h1 class="bigtitle"><strong>{{$veri['arac']["marka_name"].' '.$veri['arac']["model_name"]}}</strong>
            <span class="rfloat">
            <label class="aracozellik inline"><em class="redstr"><span class="glyphicon glyphicon-scale"></span></em>{{$ts->t($veri['arac']['yakit_tur_adi'])}}  </label>
                <label class="aracozellik inline"><em class="redstr"><span class="glyphicon glyphicon-random"></span></em> {{$ts->t($veri['arac']['vites_tur_name'])}} </label>
                <label class="aracozellik inline"><em class="redstr"><span class="glyphicon glyphicon-signal"></span></em> {{$ts->t($veri['arac']['klima_tur_name'])}} </label>
            </span>
        </h1>
        <div class="col-md-5 nopadleft ctext">
                        <img src="{{ config('app.imgurl') }}{{$veri['arac']['a_resim']}}" class="rezpagecar rounded">
        </div>
        <div class="col-md-7 nopadright rezcont">
            <div class="row">
            <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Alış Yeri")}}</h1>
                   
                    @foreach ($genelService->ilbilgi($veri["a_il"]) as $key=>$il)
                    <span class="bigtext"  value="{{$il->il_id}}">{{$il->il_name}}
                    @foreach($genelService->ilcebilgi($veri["a_ilce"]) as $key=>$ilce)
                    <span class=""  value="{{$ilce->ilce_id}}">{{' / '.$ilce->ilce_name}}
                    @foreach($genelService->ofisbilgi($veri["a_ofis"]) as $key=>$ofis)
                    <span class=""  value="{{$ofis->ofis_id}}">{{' / '.$ofis->ofis_name}}

                    </span>
                    @endforeach
                    </span>
                    @endforeach
                   
                    </span>
                  
                                                     
                    @endforeach
                </div>
                <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Alış Tarihi")}}</h1>
                    <span class="bigtext">{{$veri["alis_tarihi"]}}</span>
                </div>
            </div>
            <br>
            <div class="row">
            <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Dönüş Yeri")}}</h1>
                    @foreach ($genelService->ilbilgi($veri["d_il"]) as $key=>$il)
                    <span class="bigtext"  value="{{$il->il_id}}">{{$il->il_name}}
                    @foreach($genelService->ilcebilgi($veri["d_ilce"]) as $key=>$donus_ilce)
                    <span  value="{{$donus_ilce->ilce_id}}">{{' / '.$donus_ilce->ilce_name}}
                    @foreach($genelService->ofisbilgi($veri["d_ofis"]) as $key=>$ofis)
                    <span  value="{{$ofis->ofis_id}}">{{' / '.$ofis->ofis_name}}

                    </span>
                    @endforeach
                    </span>
                    @endforeach
                   
                    </span>
                  
                                                     
                    @endforeach
                </div>
                <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Dönüş Tarihi")}}</h1>
                    <span class="bigtext">{{$veri["donus_tarihi"]}}</span>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Kiralama Süresi")}}</h1>
                    <span class="bigtext"><span id="gunsayisi">{{$fark}}</span> {{$ts->t("Gün")}}</span>
                </div>
                <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Günlük Araç Ücreti")}}</h1>
                    @foreach($fiyatlar as $fiyat)
                    <span class="bigtext">{{$fiyat->fiyat}} {{$pbirim->para_name}}</span>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="row">
                <!-- <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">Dropoff ve Ekstra Ücretler</h1>
                    <span class="bigtext">0.00 TRY</span>
                </div> -->
                <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Toplam Kiralama Ücreti")}}</h1>
                    <span class="bigtext">{{$toplamfiyat}} {{$pbirim->para_name}}</span>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container firstclear marbot">
        <div class="col-md-12">
            <h1 class="bigtitle"><strong>{{$ts->t("Hata")}}</strong></h1>
            
            <div class="col-md-12 total rounded red">
            {{$mesaj}}            </div>
        </div>
    </div>
    @endif
    @endsection