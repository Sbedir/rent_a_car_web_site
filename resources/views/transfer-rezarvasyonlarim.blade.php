@extends('layout')
 @section('icerik')
<div class="col-md-9">
                                <h1 class="bigtitle"><strong>Transfer Rezervasyonlarım</strong></h1>
                
                <table class="table table-responsive table-striped table-bordered table-hover">
                <tr>
                    <th>Alış Yeri</th>
                    <th>Dönüş Yeri</th>
                    <th>Mesafe</th>
                    <th>Tarih</th>
                    <th>Durum</th>
                </tr>
                @foreach($rezVerileri as $rez)  
                                <tr>
                    <td>{{$rez->alis_yeri }}</td>
                    <td>{{$rez->donus_yeri }}</td>
                    <td>{{$rez->mesafe }}</td>
                    <td>Alış Tarihi: {{$rez->alis_tarihi }}<br />Dönüş Tarihi: {{$rez->donus_tarihi }}</td></td>
                    <td><span class="glyphicon glyphicon-dashboard"></span> {{$rez->onay==1?"Onaylandı":($rez->onay==2?"Reddedildi":"Onay Bekliyor") }}</td>
                </tr>
                      @endforeach
                                </table>
                          
      </div>
      </div>
    </div>
    @endsection