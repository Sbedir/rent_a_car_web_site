

@extends('layout')
@section('icerik')
@inject('ts', 'App\Services\TranslateService')
<div class="container firstclear marbot">
        <div class="row">
            <div class="col-md-9">
            

<h1 class="bigtitle">
    <strong>{{$ts->t($haberVerileri->haber_adi)}}</strong>
</h1>
<div class="pagecont">
    <p>{{$ts->t($haberVerileri->haber_icerik)}}</p>
</div>


</div>
            <div class="col-md-3">
            <h1 class="bigtitle"><strong>{{$ts->t(Son Haberler)}}</strong></h1>
            @foreach($haberlerim as $haber)
            <div class="haber col-md-12">
                <a href="{{ url('/haber/' . $haber->unique_name) }}"><img alt="{{  $ts->t($haber->haber_adi)}}"
                        src="{{ config('app.imgurl').$haber->haber_resim }}" /></a>
                <h2> {{$ts->t($haber->haber_adi)}}</h2>
                <p>{{$ts->t($haber->haber_icerik)}}</p>
            </div>
            @endforeach
        </div>
        </div>
    </div>
    @endsection