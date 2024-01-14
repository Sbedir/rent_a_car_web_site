@extends('layout')
@section('icerik')
@inject('genelService', 'App\Services\GenelService')
@inject('ts', 'App\Services\TranslateService')
<?php
$anasayfa=$genelService->anasayfa();
 ?>

<div class="banner container-fluid">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class='active'></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>

        <div class="carousel-inner">

            @foreach($anasayfa['sliderVerileri'] as $slider)
            <div class="item {{$anasayfa['sliderVerileri'][0]==$slider?'active':''}}"><img alt="{{$slider->sli_baslik}}"
                    src="{{ config('app.imgurl') }}{{$slider->resim}}" /></div>

            @endforeach
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">{{$ts->t("Önceki")}}</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">{{$ts->t("Sonraki")}}</span>
        </a>
    </div>

    <div class="bnrezervasyon">
        <div class="container relat fheight">
            <div class="col-md-12 fheight">
                <form action="{{ route('fiyat.listesi') }}"  method="post"
                    enctype="application/x-www-form-urlencoded">
                    @csrf
                    <div class="rezinner homrezer">
                        <div class="form-group">
                        <input type="hidden" name="alisil" id="alisil" value="" />
                        <input type="hidden" name="alisilce" id="alisilce" value="" />
                        <input type="hidden" name="alisofis" id="alisofis" value="" />
                        <input type="hidden" name="dil" id="dil" value="" />
                        <input type="hidden" name="dilce" id="dilce" value="" />
                        <input type="hidden" name="dofis" id="dofis" value="" />
                            <strong>{{$ts->t("Alış Yeri")}}</strong>
                            <div class="input-group relative">
                                <input type="hidden" name="alisloc" id="setalisloc" value="" />
                                <input type="text" class="form-control black" id="setalistext" required="required"
                                    readonly="readonly" value="Alış yeri seçiniz" placeholder="Alış Yeri" />

                                <div class="openselector" id="open1" style="display: none;">
                            
                                </div>

                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <strong>{{$ts->t("Alış Tarihi")}}</strong>
                            <div class="input-group">
                                <input type="text" class="form-control ronly datepicker" value="17/09/2023 15:30"
                                    id="datestart" name="alistarih" readonly="readonly" required=""
                                    placeholder="Alış Tarihi..." />

                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <strong>{{$ts->t("Dönüş Yeri")}}</strong>

                            <div class="input-group">
                                <input type="hidden" name="donusloc" id="setdonusloc" value="" />
                                <input type="text" class="form-control black" id="setdonustext" required="required"
                                    readonly="readonly" value="Dönüş yeri seçiniz" placeholder="Dönüş Yeri" />

                                <div class="openselector" id="open2" style="display: none;">
                              
                                </div>

                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <strong>{{$ts->t("Dönüş Tarihi")}}</strong>
                            <div class="input-group">
                                <input type="text" class="form-control ronly datepicker" value="20/09/2023 15:30"
                                    id="dateend" name="donustarih" readonly="readonly" required=""
                                    placeholder="Dönüş Tarihi..." />

                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn yellow rezbig" style="margin-top: 25px;"
                                value="UYGUN ARAÇLARI BUL" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container martop mobfixpad2">
    <div class="col-md-12">
        <h1 class="bigtitle mobtleft2">
            <strong>{{$ts->t("Popüler Araçlar")}}</strong>
            <label class="titlebuttons">
                <span id="popleft" class="glyphicon glyphicon-chevron-left"></span>
                <span id="popright" class="glyphicon glyphicon-chevron-right"></span>
            </label>
        </h1>

        <div class="poparac">
            <div class="poparacinner" id="popslider">

                @foreach($anasayfa['aracVerileri'] as $arac)
                <?php 
                $fiyatim =$genelService->afiyat($arac->a_id,1);
                $fiyat='';
                $paraBirim='';
                if($fiyatim!==null && $fiyatim!=='')
                {
                    $fiyat=$fiyatim->fiyat;
                    $para_birimi=$genelService->parabirim($fiyatim->para_birim_id);
                    $paraBirim=$para_birimi[0]->para_name;
                }
                
                ?>
                <div class="popcol">
                    <img src="{{ config('app.imgurl') }}{{$arac->a_resim}}"
                        alt="{{$arac->marka_name.' '.$arac->model_name}}" />
                    <h3>{{$arac->marka_name.' '.$arac->model_name}} <strong>{{$ts->t($arac->yakit_tur_adi)}} /
                            {{$ts->t($arac->vites_tur_name)}}</strong></h3>
                    <h4>{{$ts->t("Günlük Fiyat")}}: <strong>{{$fiyat}}</strong> {{$paraBirim}}</h4>

                    <a href="https://tema13.otokiralamascripti.net/rezervasyon/16-volkswagen-passat-kirala"
                        class="btn yellow full">{{$ts->t("Hemen Kiralayın")}}</a>
                </div>
                @endforeach









            </div>
        </div>
    </div>
</div>

<div class="container martop habcont">
    <div class="col-md-12">
        <div class="col-md-12 homehaber">
            <h1 class="bigtitle"><strong>{{$ts->t("Haber")}} &amp; {{$ts->t("Duyurular")}}</strong></h1>
            @foreach($anasayfa['haberVerileri'] as $haber)
            <div class="haber col-md-4">
                <a href="{{ url('/haber/' . $haber->unique_name) }}"><img alt="{{ $haber->haber_adi }}"
                        src="{{ config('app.imgurl').$haber->haber_resim }}" /></a>
                <h2>{{  $ts->t($haber->haber_adi)}}</h2>
                <p>{{  $ts->t($haber->haber_icerik)}}</p>
            </div>
            @endforeach







        </div>
    </div>
</div>
@endsection
<script>
   
function showkonum(locid)
{
    $("#alisil").val(locid);
    $("#open1").html(lang_loading);

    var jsonData = { il_id: locid };
            var urlParams = new URLSearchParams(jsonData);

            fetch('genel/ilce?' + urlParams.toString(), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                $('#open1').html('');
                $('#open1').append('<a href="javascript:void(0);" onclick="ilceSec(0)"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>Seçiniz</a>');
                data.forEach(x=>{
                    $('#open1').append('<a href="javascript:void(0);" onclick="ilceSec('+x.ilce_id+')"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>'+x.ilce_name+'</a>');
               })
            })
            .catch(error => {
                console.error('Error:', error);
            });
  
}

function ilceSec(locid)
{
    $("#alisilce").val(locid);
    $("#open1").html(lang_loading);

    var jsonData = { ilce_id: locid };
            var urlParams = new URLSearchParams(jsonData);

            fetch('genel/ofis?' + urlParams.toString(), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                $('#open1').html('');
                $('#open1').append('<a href="javascript:void(0);" onclick="ofisSec(0,\'Seçiniz\')"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>Seçiniz</a>');
                data.forEach(x=>{
                    $('#open1').append('<a href="javascript:void(0);" onclick="ofisSec('+x.ofis_id+',\''+x.ofis_name+'\')"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>'+x.ofis_name+'</a>');
               })
            })
            .catch(error => {
                console.error('Error:', error);
            });
  
}

var alisyeri_id=0;
var donusyeri_id=0;

function ofisSec(id, txt)
{
    $("#alisofis").val(id);
    alisyeri_id=id;
    $('#setalistext').val(txt);
    $("#open1").hide();
}

function setalisdefaulthtml()
{
    alisdefaulthtml = $("#open1").html();
}

function setdonusdefaulthtml()
{
    donusdefaulthtml = $("#open2").html();
}

function showkonumreset()
{
    $("#open1").html(alisdefaulthtml);
    $("#open2").html(donusdefaulthtml);
}


function showkonum2(locid)
{
    $("#dil").val(locid);
    $("#open2").html(lang_loading);

    var jsonData = { il_id: locid };
            var urlParams = new URLSearchParams(jsonData);

            fetch('genel/ilce?' + urlParams.toString(), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                $('#open2').html('');
                $('#open2').append('<a href="javascript:void(0);" onclick="ilceSec2(0)"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>Seçiniz</a>');
                data.forEach(x=>{
                    $('#open2').append('<a href="javascript:void(0);" onclick="ilceSec2('+x.ilce_id+')"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>'+x.ilce_name+'</a>');
               })
            })
            .catch(error => {
                console.error('Error:', error);
            });
  
}

function ilceSec2(locid)
{
    $("#dilce").val(locid);
    $("#open2").html(lang_loading);

    var jsonData = { ilce_id: locid };
            var urlParams = new URLSearchParams(jsonData);

            fetch('genel/ofis?' + urlParams.toString(), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                $('#open2').html('');
                $('#open2').append('<a href="javascript:void(0);" onclick="ofisSec2(0,\'Seçiniz\')"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>Seçiniz</a>');
                data.forEach(x=>{
                    $('#open2').append('<a href="javascript:void(0);" onclick="ofisSec2('+x.ofis_id+',\''+x.ofis_name+'\')"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>'+x.ofis_name+'</a>');
               })
            })
            .catch(error => {
                console.error('Error:', error);
            });
  
}
function ofisSec2(id, txt)
{
    $("#dofis").val(id);
    donusyeri_id=id;
    $('#setdonustext').val(txt);
    $("#open2").hide();
}

// $("#setalistext").click(function(){
//     alert();
//         fetch('genel/il', {
//                 method: 'GET',
//                 headers: {
//                     'Content-Type': 'application/json',
//                 },
//             })
//             .then(response => response.json())
//             .then(data => {
//                 console.log(data);
//                 $('#open1').html('');
//                 $('#open1').append('<a href="javascript:void(0);" onclick="showkonum(0)"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>Seçiniz</a>');
//                 data.forEach(x=>{
//                     $('#open1').append('<a href="javascript:void(0);" onclick="showkonum('+x.ofis_id+')"><span class="glyphicon glyphicon-chevron-right">&nbsp;</span>'+x.ofis_name+'</a>');
//                })
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//             });
//     });


</script>