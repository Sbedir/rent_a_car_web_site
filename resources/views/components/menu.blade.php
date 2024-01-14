@inject('genelService', 'App\Services\GenelService')
@inject('ts', 'App\Services\TranslateService')
<div class="midbar">
        <div class="container-fluid">
            <div class="container">
                <div class="col-md-12">
                    <div class="col-md-3 logo">
                        <a href="{{url('/anasayfa')}}" class="mobhide ultrahide"><img
                                alt="Oto Kiralama Scripti Rent a Car Sitesi"
                                src="{{ config('app.imgurl').$genelService->firmabilgi()->logo}}" /></a>
                       
                    </div>
                    <div class="col-md-9 rtext contact">
                        <div class="menubar">
                            <div class="container">
                                <div class="col-md-12">
                                    <label class="menubaropener">
                                        <div><span class="glyphicon glyphicon-menu-hamburger"></span> {{$ts->t("MENU")}}</div> <a
                                            href="tel:{{$genelService->firmabilgi()->tel}}" target="_blank">{{$genelService->firmabilgi()->tel}}</a>
                                    </label>

                                    <a  href="{{url('/anasayfa')}}" class="menua">{{$ts->t("ANASAYFA")}}</a>
                                    <a  href="{{url('/hakkimizda')}}" class="menua">{{$ts->t("HAKKIMIZDA")}}</a>
                                    <a href="{{url('/fiyat-listesi')}}" class="menua">{{$ts->t("FİYAT LİSTESİ")}}</a>
                                    <a href="{{url('/transfer')}}" class="menua">{{$ts->t("TRANSFER")}}</a>
                                    <a href="{{url('/kiralama-kosullari')}}" class="menua">{{$ts->t("KIRALAMA KOŞULLARI")}}</a>
                                    <a href="{{url('/filo-kiralama')}}" class="menua">{{$ts->t("FILO KIRALAMA")}}</a>
                                    <a href="{{url('/sss')}}" class="menua">{{$ts->t("S.S.S.")}}</a>
                                    <a href="{{url('/iletisim')}}" class="menua">{{$ts->t("İLETİŞİM")}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>