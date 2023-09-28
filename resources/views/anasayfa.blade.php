@extends('layout')
@section('icerik')
@inject('genelService', 'App\Services\GenelService')
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
            <span class="sr-only">Önceki</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Sonraki</span>
        </a>
    </div>

    <div class="bnrezervasyon">
        <div class="container relat fheight">
            <div class="col-md-12 fheight">
                <form action="https://tema13.otokiralamascripti.net/fiyat-listesi" method="post"
                    onsubmit="return rezformsb(this, event);" target="_self"
                    enctype="application/x-www-form-urlencoded">
                    <div class="rezinner homrezer">
                        <div class="form-group">
                            <strong>Alış Yeri</strong>
                            <div class="input-group relative">
                                <input type="hidden" name="alisloc" id="setalisloc" value="" />
                                <input type="text" class="form-control black" id="setalistext" required="required"
                                    readonly="readonly" value="Alış yeri seçiniz" placeholder="Alış Yeri" />

                                <div class="openselector" id="open1" style="display: none;">
                                    <a href="javascript:void(0);" data-ustid="a:3:{i:0;s:9:"
                                        İstanbul";i:1;s:9:"İstanbul";i:2;s:9:"İstanbul";}"
                                        onclick="showkonum(19);"><span
                                            class="glyphicon glyphicon-chevron-right">&nbsp;</span> İstanbul</a>
                                    <a href="javascript:void(0);" data-ustid="a:3:{i:0;s:6:"
                                        Ankara";i:1;s:6:"Ankara";i:2;s:6:"Ankara";}" onclick="showkonum(20);"><span
                                            class="glyphicon glyphicon-chevron-right">&nbsp;</span> Ankara</a>
                                    <a href="javascript:void(0);" data-ustid="a:3:{i:0;s:6:"
                                        İzmir";i:1;s:6:"İzmir";i:2;s:6:"İzmir";}" onclick="showkonum(21);"><span
                                            class="glyphicon glyphicon-chevron-right">&nbsp;</span> İzmir</a>
                                    <a href="javascript:void(0);" data-ustid="a:3:{i:0;s:7:"
                                        Antalya";i:1;s:7:"Antalya";i:2;s:7:"Antalya";}" onclick="showkonum(22);"><span
                                            class="glyphicon glyphicon-chevron-right">&nbsp;</span> Antalya</a>
                                </div>

                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <strong>Alış Tarihi</strong>
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
                            <strong>Dönüş Yeri</strong>

                            <div class="input-group">
                                <input type="hidden" name="donusloc" id="setdonusloc" value="" />
                                <input type="text" class="form-control black" id="setdonustext" required="required"
                                    readonly="readonly" value="Dönüş yeri seçiniz" placeholder="Dönüş Yeri" />

                                <div class="openselector" id="open2" style="display: none;">
                                    <a href="javascript:void(0);" onclick="showkonumdonus(19);"><span
                                            class="glyphicon glyphicon-chevron-right">&nbsp;</span> İstanbul</a>
                                    <a href="javascript:void(0);" onclick="showkonumdonus(20);"><span
                                            class="glyphicon glyphicon-chevron-right">&nbsp;</span> Ankara</a>
                                    <a href="javascript:void(0);" onclick="showkonumdonus(21);"><span
                                            class="glyphicon glyphicon-chevron-right">&nbsp;</span> İzmir</a>
                                    <a href="javascript:void(0);" onclick="showkonumdonus(22);"><span
                                            class="glyphicon glyphicon-chevron-right">&nbsp;</span> Antalya</a>
                                </div>

                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <strong>Dönüş Tarihi</strong>
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
            <strong>Popüler Araçlar</strong>
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
                    <h3>{{$arac->marka_name.' '.$arac->model_name}} <strong>{{$arac->yakit_tur_adi}} /
                            {{$arac->vites_tur_name}}</strong></h3>
                    <h4>Günlük Fiyat: <strong>{{$fiyat}}</strong> {{$paraBirim}}</h4>

                    <a href="https://tema13.otokiralamascripti.net/rezervasyon/16-volkswagen-passat-kirala"
                        class="btn yellow full">Hemen Kiralayın</a>
                </div>
                @endforeach









            </div>
        </div>
    </div>
</div>

<div class="container martop habcont">
    <div class="col-md-12">
        <div class="col-md-12 homehaber">
            <h1 class="bigtitle"><strong>Haber &amp; Duyurular</strong></h1>
            @foreach($anasayfa['haberVerileri'] as $haber)
            <div class="haber col-md-4">
                <a href="{{ url('/haber/' . $haber->unique_name) }}"><img alt="{{ $haber->haber_adi }}"
                        src="{{ config('app.imgurl').$haber->haber_resim }}" /></a>
                <h2>{{ $haber->haber_adi }}</h2>
                <p>{{ $haber->haber_icerik }}</p>
            </div>
            @endforeach







        </div>
    </div>
</div>
@endsection