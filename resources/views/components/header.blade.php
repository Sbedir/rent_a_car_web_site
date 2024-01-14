@inject('genelService', 'App\Services\GenelService')
@inject('ts', 'App\Services\TranslateService')
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Oto Kiralama Scripti Rent a Car Sitesi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Bu sitede araçlarınızı kiralayın!" />
    <meta name="keywords" content="araç,kiralama" />
    <meta name="robots" content="index,follow" />
    <script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/theme.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
</head>

<body>
    <div class="headbar">
        <div class="container-fluid">
            <div class="container">
                <div class="col-md-12">
                    <div class="col-md-6 ltext mobfleft">
                        @if(!empty(session('kullanici')))
                        <a href="{{url('/uye-paneli')}}" class="menua uye"
                            style="background:#f90000 !important; color:#ffffff !important;"><span
                                class="glyphicon glyphicon-user"></span>{{$ts->t("ÜYE PANELİ")}}</a>
                        <a href="{{url('/uye-giris')}}" class="menua uye phone"
                            style="color:#ffffff !important;"><span class="glyphicon glyphicon-phone"></span> {{$genelService->firmabilgi()->tel}}
                            </a>
                            @else
                            <a href="{{url('/uye-giris')}}" class="menua uye"
                            style="background:#f90000 !important; color:#ffffff !important;"><span
                                class="glyphicon glyphicon-user"></span> {{$ts->t("ÜYE GİRİŞİ / KAYIT")}}</a>
                        <a href="{{url('/uye-giris')}}" class="menua uye phone"
                            style="color:#ffffff !important;"><span class="glyphicon glyphicon-phone"></span> {{$genelService->firmabilgi()->tel}}
                            </a>
                            @endif
                    </div>
                    <div class="col-md-6 rtext mobfright">
                        <div class="parabirimi">
                            <label>PARA BİRİMİ:</label>
                              @if(!empty(session('pb')))
                             @foreach($genelService->parabirim(session('pb')) as $pb)
                             <strong>   {{$pb->para_name}}</strong>
                                @endforeach
                                @else
                                <strong>  TRY</strong>
                                @endif
                            
                            <span class="glyphicon glyphicon-chevron-down">&nbsp;</span>

                            <div class="birimacilir" style="display: none;">
                            @foreach($genelService->parabirimi() as $parabirim)
                    
                    <a href="javascript:void(0);" onclick="parabirimi({{$parabirim->para_birim_id}});">{{$parabirim->para_name}}</a>
                    @endforeach
                            </div>
                        </div>
                        <div class="langselector">
                            <label>DİL SEÇİMİ:</label> <img alt="Türkçe" src="{{asset('images/lang/tr.png')}}" />
                            <span class="glyphicon glyphicon-chevron-down">&nbsp;</span>

                            <div class="dilacilir" style="display: none;">
                            @foreach($genelService->dilbilgisi() as $dil)
                            <a href="javascript:void(0);" onclick="secdil('{{$dil->language_id}}');"><img alt="Türkçe"
                                        src="{{ config('app.imgurl').$dil->resim}}" /></a>
                   
                    @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
   function parabirimi(pb)
    {
       // Hedef URL
var url = '/para-birimi/'+pb;

// GET isteği gönderme
fetch(url)
    .then(function(response) {
        if (response.ok) {
            return response.json(); // Yanıtı JSON olarak çözümle
        }
        throw new Error('HTTP Hatası ' + response.status);
    })
    .then(function(data) {
        location.reload(); 
        console.log(data); // Yanıt verilerini kullanma
    })
    .catch(function(error) {
        console.error('Hata:', error);
    });







    }

    function secdil(l_id)
    {
       // Hedef URL
       var url = '/dil-sec/'+l_id;

// GET isteği gönderme
fetch(url)
    .then(function(response) {
        if (response.ok) {
            return response.json(); // Yanıtı JSON olarak çözümle
        }
        throw new Error('HTTP Hatası ' + response.status);
    })
    .then(function(data) {
        location.reload(); 
        console.log(data); // Yanıt verilerini kullanma
    })
    .catch(function(error) {
        console.error('Hata:', error);
    });
    }

    </script>