@extends('layout')
@section('icerik')

<div class="container firstclear marbot">
        <div class="row">
            <div class="col-md-9">
            @if ($sssVerileri->count() > 0)

<h1 class="bigtitle">
    <strong>{{$sssVerileri->sayfa_baslik}}</strong>
</h1>
<div class="pagecont">
    <p>{!!$sssVerileri->icerik!!}</p>
</div>

@else
<p>Veri bulunamadı.</p>
@endif
</div>
            <div class="col-md-3">
                <h1 class="bigtitle"><strong>Bağlantılar</strong></h1>
                
                <a href="{{url('/filo-kiralama')}}" class="kata"><span class="glyphicon glyphicon-chevron-right"></span> Filo Kiralama</a>
<a href="{{url('/hakkimizda')}}" class="kata"><span class="glyphicon glyphicon-chevron-right"></span> Hakkımızda</a>
<a href="{{url('/kiralama-kosullari')}}" class="kata"><span class="glyphicon glyphicon-chevron-right"></span> Kiralama Koşulları</a>
<a href="{{url('/sss')}}" class="kata"><span class="glyphicon glyphicon-chevron-right"></span> S.S.S.</a>
                <a href="{{url('/iletisim')}}" class="kata"><span class="glyphicon glyphicon-chevron-right"></span> Bize Ulaşın</a>
             </div>
        </div>
    </div>
@endsection