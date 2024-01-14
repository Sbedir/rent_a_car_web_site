@extends('layout')
@section('icerik')
@inject('ts', 'App\Services\TranslateService')
<div class="container firstclear marbot">
    <div class="row">
        <div class="col-md-9">
            @if ($kiralamakosullariVerileri->count() > 0)

            <h1 class="bigtitle">
                <strong>{{$ts->t($kiralamakosullariVerileri->sayfa_baslik)}}</strong>
            </h1>
            <div class="pagecont">
                <p>{!!$ts->t($kiralamakosullariVerileri->icerik)!!}</p>
            </div>

            @else
            <p>Veri bulunamadı.</p>
            @endif
          </div>
            <div class="col-md-3">
                <h1 class="bigtitle"><strong>{{$ts->t("Bağlantılar")}}</strong></h1>

                <a href="{{url('/filo-kiralama')}}" class="kata"><span class="glyphicon glyphicon-chevron-right"></span>
                    {{$ts->t("Filo Kiralama")}}</a>
                <a href="{{url('/hakkimizda')}}" class="kata"><span class="glyphicon glyphicon-chevron-right"></span>
                    {{$ts->t("Hakkımızda")}}</a>
                <a href="{{url('/kiralama-kosullari')}}" class="kata"><span
                        class="glyphicon glyphicon-chevron-right"></span>{{$ts->t("Kiralama Koşulları")}}</a>
                <a href="{{url('/sss')}}" class="kata"><span class="glyphicon glyphicon-chevron-right"></span>
                    {{$ts->t("S.S.S.")}}</a>
                <a href="{{url('/iletisim')}}" class="kata"><span class="glyphicon glyphicon-chevron-right"></span> 
                    {{$ts->t("Bize Ulaşın")}}</a>
            </div>
        </div>
    </div>
    @endsection