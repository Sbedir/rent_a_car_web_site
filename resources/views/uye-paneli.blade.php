@extends('layout')
 @section('icerik')
 @inject('ts', 'App\Services\TranslateService')

            <div class="col-md-9">
                                <h1 class="bigtitle"><strong>{{$ts->t("Bilgileri Düzenle")}}</strong></h1>
                                @if (Session::has('success_guncel'))
                <div class="alert alert-success">
                    {{ Session::get('success_guncel') }}
                </div>
                @endif

                @if (Session::has('error_guncel'))
                <div class="alert alert-danger">
                    {{ Session::get('error_guncel') }}
                </div>
                @endif
                                <form method="POST" action="{{ route('uye.guncelle') }}" enctype="multipart/form-data">
                                              @csrf <!-- Cross-Site Request Forgery (CSRF) koruması -->
                                              <input class="form-control" name="e_posta" type="hidden" value="{{$kullaniciVeri->e_posta}}" />

                    <div class="sozlesmebox rounded bordered nobg">
                        <div class="form-group">
                            <strong>{{$ts->t("Adınız")}}</strong>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </div>
                                                
                                <input class="form-control half" name="uye_adi" type="text" value="{{$kullaniciVeri->uye_adi}}" placeholder="{{$ts->t('Adınız')}}..." required="" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <strong>{{$ts->t("Soyadınız")}}</strong>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </div>
                                                
                                <input class="form-control half" name="uye_soyadi" type="text" value="{{$kullaniciVeri->uye_soyadi}}" placeholder="{{$ts->t('Soyadınız')}}..." required="" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <strong>{{$ts->t("Doğum Tarihiniz")}}</strong>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                                                
                                <input class="form-control half datepickyears" name="d_tarih" value="{{$kullaniciVeri->d_tarih}}" type="text" placeholder="{{$ts->t('Doğum Tarihiniz')}}..." required="" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <strong>{{$ts->t("Cep Telefonunuz")}}</strong>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-earphone"></span>
                                </div>
                                                
                                <input class="form-control half phone" name="cep_tel" type="text" value="{{$kullaniciVeri->cep_tel}}" placeholder="{{$ts->t('Cep Telefonunuz')}}..." required="" />
                            </div>
                        </div>
                        
                        <br />
                        <input type="hidden" name="do" value="updateuser" />
                        <input type="submit" value="Değişiklikleri Kaydet" class="btn btn-success btn-lg" />
                    </div>
                </form>
                            </div>
                            </div>
    </div>

    @endsection
