@inject('genelService', 'App\Services\GenelService')
@inject('ts', 'App\Services\TranslateService')
<div class="container firstclear marbot">
        <div class="row">
            <div class="col-md-3">
                <h1 class="bigtitle"><strong>{{$ts->t("Üye Paneli")}}</strong></h1>
                
                <div class="uyevatar rounded">
                    @php
                    $kullaniciVeri=json_decode(session('kullanici'));
                   
                    @endphp
                 <strong>{{$kullaniciVeri->uye_adi.' '.$kullaniciVeri->uye_soyadi}}</strong>
                    <span><label class="redinline">{{$ts->t("Kayıt Tarihi")}}:</label> {{explode("T",$kullaniciVeri->created_at)[0]}}</span><br />
                    <span><label class="redinline">{{$ts->t("Rezervasyon")}}:</label>{{$genelService->rezsayi()[0]->sayi }}</span>
                </div>
                @php
               $currentUrl = URL::current();
                @endphp 
                

                <a href="{{ url('/uye-panel/rezervasyonlar') }}" id="rezervasyon" class="btn {{ $currentUrl === 'http://127.0.0.1:8001/uye-panel/rezervasyonlar' ? 'turanj' : 'btn-default' }} full">{{$ts->t("Rezervasyonlarım")}}</a>
                 <a href="{{url('/uye-panel/transferler')}}" id="transferler" class="btn {{$currentUrl === 'http://127.0.0.1:8001/uye-panel/transferler' ? 'turanj' : 'btn-default' }}  full">{{$ts->t("Transfer Rezervasyonlarım")}}</a>
                <a href="{{url('/uye-paneli')}}" id="uye-paneli" class="btn {{ $currentUrl === 'http://127.0.0.1:8001/uye-paneli' ? 'turanj' : 'btn-default' }}  full">{{$ts->t("Bilgileri Düzenle")}}</a>
                <a href="{{url('/uye-panel/sifre-degistir')}}" id="sifre-degistir" class="btn {{$currentUrl === 'http://127.0.0.1:8001/uye-panel/sifre-degistir' ? 'turanj' : 'btn-default' }}  full">{{$ts->t("Şifre Değiştir")}}</a>
                <a href="{{url('/uye-panel/cikis-yap')}}" id="cikis-yap" class="btn {{$currentUrl === 'http://127.0.0.1:8001/uye-panel/cikis-yap' ? 'turanj' : 'btn-default' }}  full">{{$ts->t("Çıkış Yap")}}</a>
            </div>
             





