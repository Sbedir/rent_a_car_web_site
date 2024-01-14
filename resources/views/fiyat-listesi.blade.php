@extends('layout')
@section('icerik')
@inject('genelService', 'App\Services\GenelService')
@inject('ts', 'App\Services\TranslateService')


<form method="POST"  enctype="multipart/form-data">
                @csrf <!-- Cross-Site Request Forgery (CSRF) koruması -->
       
<div class="container firstclear rezcizgi ultrahide">
    <div class="row">
        <div class="col-md-4 relat nopad cizgicont">
            <div class="cizgi sec">&nbsp;</div>
            <div class="cizgion sec">
                <label>1</label>
                <strong>Araç Seçimi</strong>
                Kiralamak istediğiniz aracı seçin
            </div>
        </div>
        <div class="col-md-4 relat nopad cizgicont">
            <div class="cizgi">&nbsp;</div>
            <div class="cizgion">
                <label>2</label>
                <strong>Kişisel Bilgiler ve Ödeme</strong>
                Kredi kartı ile güvenli ödeme gerçekleştirin
            </div>
        </div>
        <div class="col-md-4 relat nopad cizgicont">
            <div class="cizgi">&nbsp;</div>
            <div class="cizgion">
                <label>3</label>
                <strong>Rezervasyon Onayı</strong>
                Rezervasyon sonucunuzu görüntüleyin
            </div>
        </div>
    </div>
</div>

<div class="container martop marbot reztitle">
        <div class="row">
            <div class="col-md-3">
                <h1 class="reztitlebig">{{$ts->t("Araç Filosu")}}</h1>
            </div>
            <div class="col-md-9 mobhide ultrahide arfil">
                <input type="text" id="search_mr_mdl" class="form-control arfillow somepad" onkeyup="aracsearch()"  style="width: 124px !important;" placeholder="Marka / Model...">
                
                <select class="form-control arfillow" id="search_yakit" onchange="aracsearch()">
                    <option value="">{{$ts->t("Yakıt")}}...</option>
                   
                    @foreach($genelService->yakitTur() as $key=>$yakitTur)
                    <optionvalue="{{$key}}">{{$yakitTur}}</option>
                    @endforeach
                </select>
                
                <select class="form-control arfillow" id="search_vites" onchange="aracsearch()">
                    <option value="">{{$ts->t("Vites")}}...</option>
                    @foreach($genelService->vitesTur() as $key=>$vitesTur)
                    <optionvalue="{{$key}}">{{$vitesTur}}</option>
                    @endforeach
                </select>
                
                <select class="form-control arfillow" style="width: 144px !important;" id="search_kategori" onchange="aracsearch()">
                    <option value="">{{$ts->t("Araç Kategorisi")}}...</option>
                    @foreach($genelService->kategori() as $key=>$kategori)
                    <optionvalue="{{$key}}">{{$kategori}}</option>
                    @endforeach
                </select>
            </div>
        </div>
</div>

<div class="container martop marbot">
    <div class="row">
        <div class="col-md-9 nopadleft" id='araclarim'>

            @foreach ($aracVerileri as $arac)
            <div class="araclisting">
                <div class="row">
                    <div class="col-md-4 ctext">
                        <img src="{{ config('app.imgurl') }}{{$arac->a_resim}}" />
                        <label class="green"><span class="glyphicon glyphicon-ok"></span> {{$arac->arac_musait}}</label>
                    </div>
                    <div class="col-md-5 nopadright">
                        <h1>{{$arac->marka_name}} {{$arac->model_name}}</h1>
                        <h2>{{$ts->t("Yolcu Sayısı")}}: <strong>{{$arac->yolcu_kapasite}}</strong>{{$ts->t("kişiye kadar")}} <br />{{$ts->t("Bagaj Kapasitesi")}}:
                            <strong>{{$arac->bagaj_kapasitesi}}</strong>{{$ts->t("kg kadar")}} 
                        </h2>

                        <label class="aracozellik">
                            <span class="glyphicon glyphicon-scale"></span> <strong>{{$ts->t("Yakıt")}} :</strong>
                            {{$arac->yakit_tur_adi}}
                        </label>
                        <label class="aracozellik">
                            <span class="glyphicon glyphicon-random"></span> <strong>{{$ts->t("Vites")}} :</strong>
                            {{$arac->vites_tur_name}}
                        </label>
                        <label class="aracozellik">
                            <span class="glyphicon glyphicon-signal"></span> <strong>{{$ts->t("Klima")}} :</strong>
                            {{$arac->klima_tur_name}}
                        </label>
                    </div>
                    <div class="col-md-3">
                        @foreach ($genelService->afiyat($arac->a_id) as $fiyat)
                        @foreach ($genelService->parabirim($fiyat['para_birim_id']) as $parabirim)
                        <div class="aracsec">
                            <label class="fiyatlab">{{$fiyat["gun_baslangic"]}}-{{$fiyat["gun_bitis"]}} {{$ts->t("Gün Aralığı")}}
                             
                            <span>{{$fiyat["fiyat"]}}-{{$parabirim->para_name}}</span></label>

                        </div>

                        @endforeach

                        @endforeach
                        <a onclick="hemenKirala({{json_encode($arac)}})"
                            class="btn turanj full martoplow">{{$ts->t("Hemen Kiralayın")}}</a>
                    </div>
                </div>
            </div>
            @endforeach




        </div>
        <div class="col-md-3 nopadright zindex" >
            <div class="subcont mobhide ultrahide rezfontlow">
              
                    <div class="form-group">
                        <div class="col-md-12 mt-2">
                            <div class="form-group mb-0">

                                <label for="" class="form-group mb-0"><b>{{$ts->t("Alış Yeri")}}</b></label>
                                <div class="atbd-select-list d-flex col-md-12 alisDonus">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group mb-0">

                                        <div class="col-md-12">
                                        <label for="" class="col-md-2 form-group mb-0 selectlabel"><b>{{$ts->t("İl")}}</b></label>
                                            <div class="col-md-10 atbd-select-list d-flex">
                                                <div class="atbd-select " style="width: 100%;">
                                                    <select name="il" id='il' class="form-control"
                                                        onChange="ilceSec(event.target.value)" style="width: 100%;">
                                                        <option value="">{{$ts->t("Seçiniz")}}</option>
                                                        @foreach ($genelService->il() as $key=>$il)
                                                        <option value="{{$il->il_id}}">{{$il->il_name}}</option>
                                                        @endforeach

                                                    </select>

                                                </div>

                                            </div>

                                        </div>
                                           
                                        </div>




                                    </div>


                                    <div class="col-md-12 mt2" id='alis_ilce'>
                                        <div class="form-group mb-0">

                                            <div class="col-md-12">
                                        <label for="" class="col-md-2 form-group mb-0 selectlabel"><b>{{$ts->t("İlçe")}}</b></label>
                                            <div class="col-md-10 atbd-select-list d-flex">
                                                <div class="atbd-select " style="width: 100%;">

                                                    <select name="ilce" id="ilce-select" class="form-control"
                                                        onChange="ofisSec(event.target.value)" style="width: 100%;">
                                                    </select>

                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 mt2" id='alis_ofis'>
                                        <div class="form-group mb-0">
                                        <div class="col-md-12">
                                        <label for="" class="col-md-2 form-group mb-0 selectlabel"><b>{{$ts->t("Ofis")}}</b></label>
                                            <div class="col-md-10 atbd-select-list d-flex">
                                                <div class="atbd-select " style="width: 100%;">

                                                    <select name="ofis_id" id="ofis-select" class="form-control"
                                                        style="width: 100%;">
                                                    </select>

                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 mt12">
                            <div class="form-group mb-0">

                                <label for="" class="form-group mb-0"><b>{{$ts->t("Alış Tarihi")}}</b></label>
                                <div class="atbd-select-list d-flex">
                                    <input name="alis_tarihi" id="alis_tarihi"  type="date"
                                        class="form-control form-control-default datePadding" />
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 mt-2">
                            <div class="form-group mb-0">

                                <label for="" class="form-group mb-0"><b>{{$ts->t("Dönüş Yeri")}}</b></label>
                                <div class="atbd-select-list d-flex col-md-12 alisDonus">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group mb-0">
                                            <div class="col-md-12">
                                        <label for="" class="col-md-2 form-group mb-0 selectlabel"><b>{{$ts->t("İl")}}</b></label>
                                            <div class="col-md-10 atbd-select-list d-flex">
                                                <div class="atbd-select " style="width: 100%;">

                                                    <select name="d_il" id='d_il' class="form-control"
                                                        onChange="ilceeSec(event.target.value)" style="width: 100%;">

                                                        <option value="">{{$ts->t("Seçiniz")}}</option>
                                                        @foreach ($genelService->d_il() as $key=>$il)
                                                        <option value="{{$il->il_id}}">{{$il->il_name}}</option>
                                                        @endforeach

                                                    </select>

                                                </div>

                                            </div>
                                            </div>
                                            
                                         
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt2" id='donus_ilce'>
                                        <div class="form-group mb-0">

                                        <div class="col-md-12">
                                        <label for="" class="col-md-2 form-group mb-0 selectlabel"><b>{{$ts->t("İlçe")}}</b></label>
                                            <div class="col-md-10 atbd-select-list d-flex">
                                                <div class="atbd-select " style="width: 100%;">


                                                    <select name="d_ilce" id="ilcee-select" class="form-control"
                                                        onChange="ofissSec(event.target.value)" style="width: 100%;">
                                                    </select>

                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 mt2" id='donus_ofis'>
                                        <div class="form-group mb-0">
                                        <div class="col-md-12">
                                        <label for="" class="col-md-2 form-group mb-0 selectlabel"><b>{{$ts->t("Ofis")}}</b></label>
                                            <div class="col-md-10 atbd-select-list d-flex">
                                                <div class="atbd-select " style="width: 100%;">


                                                    <select name="d_ofis_id" id="ofiss-select" class="form-control"
                                                        style="width: 100%;">
                                                    </select>

                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 mt12">
                        <div class="form-group mb-0">
                            
                            <label for="" class="form-group mb-0"><b>{{$ts->t("Dönüş Tarihi")}}</b></label>
                            
                                        <input name="donus_tarihi" id="donus_tarihi"  type="date" class="form-control form-control-default datePadding" >
                            
                        </div>
                    </div>


                    </div>

                    <input class="btn yellow rezbig lowtxt" value="ARAÇLARI LİSTELE" onclick="aracsearch()"/>
                
            </div>
        </div>
    </div>
</div>
</form>

<form method="POST" id='arac_kirala' action="{{ route('kiralik.arac') }}" enctype="multipart/form-data">
@csrf
    <input name='deger' type="hidden" id='arac_deger' />
</form>
<style>
    .alisDonus{
        background: #dfdfdf;
    padding: 3px 3px 3px 3px;
    border-radius: 10px;
    }
    .selectlabel{
        margin-top: 12px;
        margin-bottom: 0px;
    }
    .mt12{
        margin-top: 12px;
    }
    .mt2{
        margin-top: 2px;
    }
    .zindex{
        z-index: 111111;
    }
    .datePadding{
        padding: 0px 11px !important;
    }
</style>
<script>
    
    $('#alis_ilce').hide();
    $('#alis_ofis').hide();
    $('#donus_ilce').hide();
    $('#donus_ofis').hide();
    function ilceSec(il,secilenİlce=0)
    {
       
                var jsonData = { il_id: il };
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
                $('#ilce-select').html('');
                $('#ilce-select').append('<option value="">Seçiniz</option>');
                data.forEach(x=>{
                    $('#ilce-select').append('<option value="'+x.ilce_id+'">'+x.ilce_name+'</option>');
                })
                if(secilenİlce!==0)
                {
                    $('#ilce-select').val(secilenİlce);
                }
                $('#alis_ilce').show();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function ofisSec(ilce,secilenOfis)
    {
                var jsonData = {ilce_id: ilce };
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
                $('#ofis-select').html('');
                $('#ofis-select').append('<option value="">Seçiniz</option>');
                data.forEach(x=>{
                    $('#ofis-select').append('<option value="'+x.ofis_id+'">'+x.ofis_name+'</option>');
                })

                if(secilenOfis!==0)
                {
                    $('#ofis-select').val(secilenOfis);
                }
                $('#alis_ofis').show();
                
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }


    function ilceeSec(il,secilenİlce=0)
    {
                var jsonData = { il_id: il };
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
                $('#ilcee-select').html('');
                $('#ilcee-select').append('<option value="">Seçiniz</option>');
                data.forEach(x=>{
                    $('#ilcee-select').append('<option value="'+x.ilce_id+'">'+x.ilce_name+'</option>');
                })
                if(secilenİlce!==0)
                {
                    $('#ilcee-select').val(secilenİlce);
                }
                $('#donus_ilce').show();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function ofissSec(ilce,secilenOfis)
    {
                var jsonData = {ilce_id: ilce };
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
                $('#ofiss-select').html('');
                $('#ofiss-select').append('<option value="">Seçiniz</option>');
                data.forEach(x=>{
                    $('#ofiss-select').append('<option value="'+x.ofis_id+'">'+x.ofis_name+'</option>');
                })

                if(secilenOfis!==0)
                {
                    $('#ofiss-select').val(secilenOfis);
                }
                $('#donus_ofis').show();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    <?php
    if(!empty($_POST))
    {
        $at=explode(' ',$_POST['alistarih'])[0];
        $at=explode('/',$at);
        $at=$at[2].'-'.$at[1].'-'.$at[0];

        $don=explode(' ',$_POST['donustarih'])[0];
        $don=explode('/',$don);
        $don=$don[2].'-'.$don[1].'-'.$don[0];
        ?>
        $("#il").val('<?=$_POST['alisil']?>');
        ilceSec('<?=$_POST['alisil']?>','<?=$_POST['alisilce']?>');
        ofisSec('<?=$_POST['alisilce']?>','<?=$_POST['alisofis']?>');
        $("#alis_tarihi").val('<?=$at?>');
        $("#d_il").val('<?=$_POST['dil']?>');
        ilceeSec('<?=$_POST['dilce']?>','<?=$_POST['dilce']?>');
        ofissSec('<?=$_POST['dilce']?>','<?=$_POST['dofis']?>');
        $("#donus_tarihi").val('<?=$don?>');
        aracsearch();
    <?php }?>
    

 function  aracsearch()
 {
   var mrmdl= $("#search_mr_mdl").val();
   var yakit= $("#search_yakit").val();
   var vites= $("#search_vites").val();
   var kategori= $("#search_kategori").val();

   var a_il= $("#il").val();
   var a_ilce= $("#ilce-select").val();
   var a_ofis= $("#ofis-select").val();
   var alis_tarihi= $("#alis_tarihi").val();
   var d_il= $("#d_il").val();
   var d_ilce= $("#ilcee-select").val();
   var d_ofis= $("#ofiss-select").val();
   var donus_tarihi= $("#donus_tarihi").val();
   
   var jsonData = {mrmdl: mrmdl, yakit:yakit,vites:vites,kategori:kategori,
    a_il:a_il,a_ilce:a_ilce,a_ofis:a_ofis,alis_tarihi:alis_tarihi,d_il:d_il,d_ilce:d_ilce,d_ofis:d_ofis,donus_tarihi:donus_tarihi
};
            var urlParams = new URLSearchParams(jsonData);

            fetch('genel/arac-search?' + urlParams.toString(), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                aracDoldur(data)
                
            })
            .catch(error => {
                console.error('Error:', error);
            });
 }

 function aracDoldur(data)
 {
    var aracimlarim='';
    data.forEach(arac=>{
        aracFiyat='';
        if( arac.fiyat!==undefined)
        {
            arac.fiyat.forEach(fiyat=>{
                console.log(fiyat);
            aracFiyat+='<div class="aracsec">'+
                            '<label class="fiyatlab">'+fiyat.namee+
                                '<span>'+fiyat.deger+'</span></label>'+

                        '</div>';
                        
             });
        }

var jsonString = JSON.stringify(arac);
        aracimlarim+='<div class="araclisting">'+
                '<div class="row">'+
                    '<div class="col-md-4 ctext">'+
                        '<img src="<?=config('app.imgurl');?>'+ arac.a_resim+'" />'+
                        '<label class="'+(arac.a_musait==1 && arac.kiralik!==1?'green':'red')+'"><span class="glyphicon glyphicon-'+(arac.a_musait==1 && arac.kiralik!==1?'ok':'remove')+'"></span>'+(arac.a_musait==1 && arac.kiralik!==1?'Müsait':'Müsait Değil')+'</label>'+
                    '</div>'+
                    '<div class="col-md-5 nopadright">'+
                        '<h1>'+arac.marka_name+' '+arac.model_name+'</h1>'+
                        '<h2>Yolcu Sayısı: <strong>'+arac.yolcu_kapasite+'</strong> kişiye kadar<br />Bagaj Kapasitesi:'+
                            '<strong>'+arac.bagaj_kapasitesi+'</strong> kg kadar'+
                       ' </h2>'+

                       ' <label class="aracozellik">'+
                           ' <span class="glyphicon glyphicon-scale"></span> <strong>Yakıt:</strong>'+
                            arac.yakit_tur_adi+
                       ' </label>'+
                        '<label class="aracozellik">'+
                            '<span class="glyphicon glyphicon-random"></span> <strong>Vites:</strong>'+
                            arac.vites_tur_name+
                        '</label>'+
                        '<label class="aracozellik">'+
                            '<span class="glyphicon glyphicon-signal"></span> <strong>Klima:</strong>'+
                            arac.klima_tur_name+
                        '</label>'+
                    '</div>'+
                    '<div class="col-md-3">'+aracFiyat+
                        
                    '<a class="btn turanj full martoplow" '+(arac.a_musait==1 && arac.kiralik!==1?"onclick='hemenKirala("+jsonString+")'>Hemen Kiralayın":'">Müsait Değil')+'  </a>'+
                    '</div>'+
                '</div>'+
            '</div>';

    });

    $('#araclarim').html(aracimlarim);
  
 }

 function hemenKirala(arac)
 {
    var a_il= $("#il").val();
   var a_ilce= $("#ilce-select").val();
   var a_ofis= $("#ofis-select").val();
   var alis_tarihi= $("#alis_tarihi").val();
   var d_il= $("#d_il").val();
   var d_ilce= $("#ilcee-select").val();
   var d_ofis= $("#ofiss-select").val();
   var donus_tarihi= $("#donus_tarihi").val();
   console.log(a_il);
    if(a_il==='' || a_ilce==='' || a_ofis==='' || alis_tarihi==='' || d_il==='' || d_ilce==='' || d_ofis==='' || donus_tarihi==='')
    {
        alert('alış yeri , dönüş yeri , alış tarihi ve dönüş tarihi alanlarını araçları listele formundan doldurunuz.');
        return 0;
    }
    else{
         var deger = {}; 

     deger.a_il = $("#il").val();
     deger.a_ilce = $("#ilce-select").val();
     deger.a_ofis = $("#ofis-select").val();
     deger.alis_tarihi = $("#alis_tarihi").val();
     deger.d_il = $("#d_il").val();
     deger.d_ilce = $("#ilcee-select").val();
     deger.d_ofis = $("#ofiss-select").val();
     deger.donus_tarihi = $("#donus_tarihi").val();
     deger.arac = arac;

     $('#arac_deger').val(JSON.stringify(deger));
     var form = document.getElementById("arac_kirala");
    form.submit();

    }
   
    

 }


    </script>
@endsection