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
                     {{$ts->t(" Kiralamak istediğiniz aracı seçin")}}              </div>
            </div>
            <div class="col-md-4 relat nopad cizgicont">
                <div class="cizgi sec">&nbsp;</div>
                <div class="cizgion sec">
                    <label>2</label>
                    <strong>{{$ts->t("Kişisel Bilgiler ve Ödeme")}}</strong>
                      {{$ts->t("Kredi kartı ile güvenli ödeme gerçekleştirin ")}}             </div>
            </div>
            <div class="col-md-4 relat nopad cizgicont">
                <div class="cizgi">&nbsp;</div>
                <div class="cizgion">
                    <label>3</label>
                    <strong>{{$ts->t("Rezervasyon Onayı")}}</strong>
                         {{$ts->t("Rezervasyon sonucunuzu görüntüleyin ")}}          </div>
            </div>
        </div>
    </div>
    

       

    <div class="container martop marbot">
        <h1 class="bigtitle"><strong>{{$veri['arac']["marka_name"].' '.$veri['arac']["model_name"]}} </strong>
            <span class="rfloat">
                <label class="aracozellik inline"><em class="redstr"><span class="glyphicon glyphicon-scale"></span></em>{{$ts->t($veri['arac']['yakit_tur_adi'])}}  </label>
                <label class="aracozellik inline"><em class="redstr"><span class="glyphicon glyphicon-random"></span></em> {{$ts->t($veri['arac']['vites_tur_name'])}} </label>
                <label class="aracozellik inline"><em class="redstr"><span class="glyphicon glyphicon-signal"></span></em> {{$ts->t($veri['arac']['klima_tur_name'])}} </label>
            </span>
        </h1>
        <div class="col-md-5 nopadleft mobnopad ctext">
            <div class="akat" style="left:10px;"> {{$ts->t($veri['arac']["kategori_name"])}} </div>            <img src="{{ config('app.imgurl') }}{{$veri['arac']['a_resim']}}" class="rezpagecar rounded" />
        </div>
        <div class="col-md-7 nopadright rezcont mobnopad">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Alış Yeri")}} </h1>
                   
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
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Alış Tarihi")}} </h1>
                    <span class="bigtext">{{$veri["alis_tarihi"]}}</span>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Dönüş Yeri")}} </h1>
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
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Dönüş Tarihi")}} </h1>
                    <span class="bigtext">{{$veri["donus_tarihi"]}}</span>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Kiralama Süresi")}} </h1>
                    <span class="bigtext"><span id="gunsayisi">{{$fark}}</span> {{$ts->t("Gün")}} </span>
                </div>
                <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Günlük Araç Ücreti")}} </h1>
                    @foreach($fiyatlar as $fiyat)
                    <span class="bigtext">{{$fiyat->fiyat}} {{$pbirim->para_name}}</span>
                    @endforeach
                </div>
            </div>
            <br />
            <div class="row">
                <!-- <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">Dropoff Ücreti</h1>
                    <span class="bigtext">{{$veri["donus_tarihi"]}}</span>
                </div> -->
                <div class="col-md-6">
                    <h1 class="bigtitle subbed nomartop">{{$ts->t("Toplam Ücret")}} </h1>
                    <span class="bigtext">{{$toplamfiyat}} {{$pbirim->para_name}}</span>
                </div>
            </div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('kiralik.arac.onayla') }}" enctype="multipart/form-data">
                @csrf <!-- Cross-Site Request Forgery (CSRF) koruması -->
        <input type="hidden" name="deger" value="{{json_encode($veri)}}"/>
        
        <div class="container marbot">
            <div class="col-md-12 extra rounded">
                <h1 class="bigtitle nomartop"><strong>{{$ts->t("Rezervasyon Ekstraları")}} </strong></h1>
                
                <label class="extcheck"  ><input type="checkbox" onchange="hesap()" value='{{$rez->navigasyon}}' id='navigasyon'  name='navigasyon'  />  {{$ts->t("Navigasyon")}}  <span>({{$ts->t("Günlük")}}  -{{$rez->navigasyon}} {{$pbirim->para_name}})</span></label>
                <label class="extcheck" ><input type="checkbox"  onchange="hesap()" value='{{$rez->sofor_hizmeti}}' id='sofor_hizmeti' name='sofor_hizmeti'/> {{$ts->t("Şoför Hizmeti ")}} <span>(Günlük{{$ts->t("Araç Seçimi")}}  - {{$rez->sofor_hizmeti}} {{$pbirim->para_name}})</span></label>
                <label class="extcheck" ><input type="checkbox"  onchange="hesap()" value='{{$rez->bebek_koltugu}}' id='bebek_koltugu' name='bebek_koltugu'/>  {{$ts->t("Bebek Koltuğu")}} <span>({{$ts->t("Bir kerelik")}}  - {{$rez->bebek_koltugu}} {{$pbirim->para_name}})</span></label>
                <label class="extcheck" ><input type="checkbox"  onchange="hesap()" value='{{$rez->yol_haritasi}}' id='yol_haritasi' name='yol_haritasi'/> {{$ts->t(" Yol Haritası")}} <span>( {{$ts->t("Bir kerelik")}} - {{$rez->yol_haritasi}} {{$pbirim->para_name}})</span></label>
            </div>
        </div>
        
        <div class="container marbot">
            <div class="col-md-12 total rounded">
               {{$ts->t("Toplam Kiralama Ücreti")}} : <label id='tku'>{{$toplamfiyat}} {{$pbirim->para_name}}</label>
            </div>
        </div>
    
        <div class="container marbot">
            <h1 class="bigtitle nomartop"><strong>{{$ts->t("Sürücü Bilgileri")}} </strong></h1>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <strong>{{$ts->t("Adınız")}} </strong>
                        <input type="text" class="form-control" name="ad" required="" placeholder="Adınız..." />
                        
                        <br />
                        <strong>{{$ts->t("Soyadınız")}} </strong>
                        <input type="text" class="form-control" name="soyad" required="" placeholder="Soyadınız..." />
                        
                        <br />
                        <strong>{{$ts->t("Doğum Tarihiniz")}} </strong>
                        <input type="text" class="form-control datepickyears" readonly="readonly" name="dogum" required="" placeholder="Doğum Tarihiniz..." />
                        
                        <br />
                        <strong>{{$ts->t("Uçuş Notları")}} </strong>
                        <textarea class="form-control" name="ucus" placeholder="İsteğe bağlı olarak doldurulabilir......"></textarea>
                    </div>
                    <div class="col-md-6 mobpadtop">
                        <strong>{{$ts->t("Cep Telefonunuz")}} </strong>
                        <input type="text" class="form-control phone" name="cep" required="" placeholder="Cep Telefonunuz..." />
                        
                        <br />
                        <strong>{{$ts->t("E-posta Adresiniz")}} </strong>
                        <input type="text" class="form-control" name="email" required="" placeholder="E-posta Adresiniz..." />

                        <br />
                        <strong>{{$ts->t("Özel Notlar")}} </strong>
                        <textarea class="form-control" name="ozel" placeholder="İsteğe bağlı olarak doldurulabilir......"></textarea>
                    </div>
                </div>
                
                <div class="uyebox rounded">
                    <label class="extcheck"><input type="checkbox" name="uyeol" onclick="setuyebox(this);" /> {{$ts->t("Girdiğim e-posta adresi ile üye olmak istiyorum")}} </label>
                    <div class="row">
                        <div class="col-md-6 pad20">
                            <strong>{{$ts->t("Şifre Girin")}} </strong>
                            <input type="password" class="form-control" name="pass1" id="pass1" placeholder="********" />
                        </div>
                        <div class="col-md-6 pad20">
                            <strong>{{$ts->t("Şifreyi Tekrar Girin")}} </strong>
                            <input type="password" class="form-control" name="pass2" id="pass2" placeholder="********" />
                        </div>
                    </div>
                </div>
                
                <div class="sozlesmebox rounded" style="display: none;">
                    <label class="extcheck"><input type="checkbox" name="sozlesme" value="1" required="required" checked="checked" />{{$ts->t(" Kiralama şartlarını okudum, onayladım ve kabul ediyorum")}} </label>
                </div>
                
                <!-- <div class="odemebox">
                    <h1 class="bigtitle"><strong>Ödeme Seçenekleri</strong></h1>
                    
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#other">Ödeme Seçenekleri</a></li>
                        <li><a data-toggle="tab" href="#tdpos">Online Ödeme (3DPos)</a></li>
                    </ul>
                    
                    <div class="tab-content">
                        <div id="other" class="tab-pane fade in active">
                            <label class="extcheck full"><input type="radio" name="odeme" checked="checked" value="1" /> Nakit</label>
                            <label class="extcheck full"><input type="radio" name="odeme" value="2" /> Banka Havalesi / EFT</span></label>
                            <label class="extcheck full"><input type="radio" name="odeme" value="3" /> Kredi Kartı</label>
                        </div>
                        <div id="tdpos" class="tab-pane fade">
                            Online ödeme (kredi kartı) ile yapılan işlemlerde rezervasyon anlık olarak onaylanır. 
                            Ödeme işlemi 3d secure ile SSL (güvenli/şifrelenmiş) bağlantı üzerinden gerçekleştirilmektedir. Ödeme işlemi sırasında kullandığınız kartın banka sayfasına yönlendirilirsiniz. Sitemiz kredi kartı bilgilerinizi hiçbir şekilde saklamamaktadır.<br /><br />
                            
                            <strong>Kart Sahibi Ad/Soyad</strong>
                            <input type="text" class="form-control mid" name="pos_name" placeholder="Kart Sahibi Ad/Soyad..." />
                            
                            <br />
                            <strong>Kart Numarası</strong>
                            <input type="text" class="form-control mid" name="pos_number" placeholder="Kart Numarası..." />
                            
                            <br />
                            <strong>Son Kullanma Tarihi / Güvenlik Kodu</strong><br />
                            <input type="text" class="form-control low inline" name="pos_month" placeholder="Ay..." />
                            <input type="text" class="form-control low inline" name="pos_year" placeholder="Yıl..." />
                            <input type="text" class="form-control low inline" name="pos_cv2" placeholder="CV2..." />
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        
        <div align="center">
            <input type="submit" class="btn turanj btn-lg" value="Rezervasyonu Tamamla" />
            <br /><br />
        </div>
    </form>
    <script>
        function hesap()
        {
            var fiyat=+{{$toplamfiyat}};
            var parabirim="{{$pbirim->para_name}}";
            var navigasyon=$('#navigasyon').is(':checked');
            var sofor_hizmeti=$('#sofor_hizmeti').is(':checked');
            var bebek_koltugu=$('#bebek_koltugu').is(':checked');
            var yol_haritasi=$('#yol_haritasi').is(':checked');
            if(navigasyon)
            {
                fiyat=fiyat+(+$('#navigasyon').val());
            }
            if(sofor_hizmeti)
            {
                fiyat=fiyat+(+$('#sofor_hizmeti').val());
            }
            if(bebek_koltugu)
            {
                fiyat=fiyat+(+$('#bebek_koltugu').val());
            }
            if(yol_haritasi)
            {
                fiyat=fiyat+(+$('#yol_haritasi').val());
            }
            console.log(fiyat);
            $('#tku').html(fiyat+' '+parabirim);
        }
    </script>
@endsection
