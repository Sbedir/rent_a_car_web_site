@extends('layout')
@section('icerik')

<form method="POST" action="{{ route('transfer.rezarvasyon') }}" enctype="multipart/form-data">
    @csrf
    <!-- Cross-Site Request Forgery (CSRF) koruması -->



    <div class="container firstclear martop marbot">
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif

        @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
        @endif
        <h1 class="bigtitle"><strong>Transfer Hizmetleri</strong></h1>

        <div class="col-md-12">
            <table class="table table-responsive table-striped table-bordered table-hover">
                <tr>
                    <th>Alış Yeri / Dönüş Yeri</th>
                    <th>Mesafe</th>
                    <th>Minimum Kişi</th>
                    <th>Maximum Kişi</th>
                    <th>Fiyat</th>

                </tr>
                @foreach ($transferVerileri as $tra)
                <tr>
                    <td>
                        <label class="extcheck full trn">

                            <input type="radio" name="trans" required="required" value="{{$tra->t_id}}" />
                            {{$tra->alis_yeri}} <span class="glyphicon glyphicon-chevron-right"></span> <span
                                class="redinline">{{$tra->donus_yeri}}</span>
                        </label>
                    </td>
                    <td>{{$tra->mesafe}}</td>
                    <td>{{$tra->kisi_baslangic}}</td>
                    <td>{{$tra->kisi_bitis}}</td>
                    <td>{{$tra->fiyat}}</td>

                </tr>
                @endforeach

            </table>
        </div>
    </div>

    <div class="container marbot">
        <h1 class="bigtitle nomartop"><strong>Transfer Bilgileri</strong></h1>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <input name="mus_id" id='mus_id' type="hidden" class="form-control form-control-default">
                    <strong>Adınız</strong>
                    <input type="text" class="form-control" name="mus_adi" required=""
                        placeholder="Adınız Soyadınız..." />

                    <br />
                    <strong>Soyadınız</strong>
                    <input type="text" class="form-control" name="mus_soyadi" required=""
                        placeholder="Adınız Soyadınız..." />

                    <br />
                    <strong>Doğum Tarihiniz</strong>
                    <input type="text" class="form-control datepickyears" name="d_tarih" required=""
                        placeholder="Doğum Tarihiniz..." />

                    <br />
                    <strong>Transfer Notları</strong>
                    <textarea class="form-control" name="ucus_notlari" required=""
                        placeholder="Transfer notlarını bu alana girin. Kaç kişi transfer edilecek, diğer bilgiler neler?"></textarea>
                </div>
                <div class="col-md-6 mobpadtop">
                    <strong>Cep Telefonunuz</strong>
                    <input type="text" class="form-control phone" name="cep_tel" required=""
                        placeholder="Cep Telefonunuz..." />

                    <br />
                    <strong>E-posta Adresiniz</strong>
                    <input type="text" class="form-control" name="e_posta" required=""
                        placeholder="E-posta Adresiniz..." />

                    <br />
                    <strong>Özel Notlar</strong>
                    <textarea class="form-control" name="ozel_notlar"
                        placeholder="İsteğe bağlı olarak doldurulabilir..."></textarea>
                </div>
            </div>

            <div class="sozlesmebox rounded" style="display: none;">
                <label class="extcheck"><input type="checkbox" name="sozlesme" checked="checked" value="1"
                        required="required" /> Hizmet şartlarını okudum, onayladım ve kabul ediyorum.</label>
            </div>
        </div>
    </div>

    <div style="text-align:center">
        <input type="submit" class="btn turanj btn-lg" value="Transfer Rezervasyonunu Tamamla" />
        <br /><br />
    </div>
</form>
@endsection