@inject('genelService', 'App\Services\GenelService')
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
                                        <div><span class="glyphicon glyphicon-menu-hamburger"></span> MENU</div> <a
                                            href="tel:{{$genelService->firmabilgi()->tel}}" target="_blank">{{$genelService->firmabilgi()->tel}}</a>
                                    </label>

                                    <a  href="{{url('/anasayfa')}}" class="menua">ANASAYFA</a>
                                    <a  href="{{url('/hakkimizda')}}" class="menua">HAKKIMIZDA</a>
                                    <a href="{{url('/fiyat-listesi')}}" class="menua">FİYAT LİSTESİ</a>
                                    <a href="{{url('/transfer')}}" class="menua">TRANSFER</a>
                                    <a href="{{url('/kiralama-kosullari')}}" class="menua">KIRALAMA KOŞULLARI</a>
                                    <a href="{{url('/filo-kiralama')}}" class="menua">FILO KIRALAMA</a>
                                    <a href="{{url('/sss')}}" class="menua">S.S.S.</a>
                                    <a href="{{url('/iletisim')}}" class="menua">İLETİŞİM</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>