@extends('layout')
@section('icerik')
@inject('ts', 'App\Services\TranslateService')
<div class="container firstclear marbot">
    <div class="row"> 
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
        <div class="col-md-6">
            <h1 class="bigtitle"><strong>{{$ts->t("Üye Girişi")}}</strong></h1>

            <form method="POST" action="{{ route('genel.login') }}" enctype="multipart/form-data">
                @csrf
              
                <!-- Cross-Site Request Forgery (CSRF) koruması -->
                <div class="sozlesmebox rounded bordered nobg">
                    <div class="form-group">
                        <strong>{{$ts->t("E-posta Adresi")}}</strong>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </div>
                            <input class="form-control half" name="e_posta" type="text" placeholder="{{$ts->t('E-posta Adresi')}}..."
                                required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <strong>{{$ts->t("Şifre")}}</strong>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>
                            <input class="form-control half" name="password" type="password" placeholder="********"
                                required="" />
                        </div>
                    </div>

                    <br />
                    <input type="hidden" name="do" value="login" />
                    <input type="submit" value="Giriş Yap" class="btn turanj btn-lg" />
                </div>
            </form>


            <br />
            <h1 class="bigtitle"><strong>{{$ts->t("Şifremi Unuttum")}}</strong></h1>

            <form method="post" target="_self" enctype="application/x-www-form-urlencoded">
                <div class="sozlesmebox rounded bordered nobg">
                    <div class="form-group">
                        <strong>{{$ts->t("E-posta Adresi")}}</strong>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </div>

                            <input class="form-control half" name="email" type="text" placeholder="{{$ts->t('E-posta Adresi')}}..."
                                required="" />
                        </div>
                    </div>

                    <br />
                    <input type="hidden" name="do" value="recoverpass" />
                    <input type="submit" value="Şifre Hatırlat" class="btn turanj btn-lg" />
                </div>
            </form>
        </div>
        <div class="col-md-6">

            <h1 class="bigtitle"><strong>{{$ts->t("Kayıt Olun")}}</strong></h1>
            <form method="POST" action="{{ route('uye.kayit') }}" id="uyeol" enctype="multipart/form-data">
                @csrf
                <!-- Cross-Site Request Forgery (CSRF) koruması -->
              

                <div class="sozlesmebox rounded bordered nobg">
                    <div class="form-group">
                        <strong>{{$ts->t("Adınız")}}</strong>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>

                            <input class="form-control half" name="uye_adi" type="text"
                                placeholder="{{$ts->t('Adınız')}}..." required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <strong>{{$ts->t("Soyadınız")}}</strong>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>

                            <input class="form-control half" name="uye_soyadi" type="text"
                                placeholder="{{$ts->t('Soyadınız')}}..." required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <strong>{{$ts->t("Doğum Tarihiniz")}}</strong>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>

                            <input class="form-control half" name="d_tarih" type="date" required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <strong>{{$ts->t("Cep Telefonunuz")}}</strong>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-earphone"></span>
                            </div>

                            <input class="form-control half phone" name="cep_tel" type="number"
                                placeholder="{{$ts->t('Cep Telefonunuz')}}..." required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <strong>{{$ts->t("E-posta Adresiniz")}}</strong>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </div>

                            <input class="form-control half" name="e_posta" type="text"
                                placeholder="{{$ts->t('E-posta Adresiniz')}}..." required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <strong>{{$ts->t("Şifre Girin")}}</strong>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>

                            <input class="form-control half" name="password" id="password" type="password"
                                placeholder="********" required="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <strong>{{$ts->t("Şifreyi Tekrar Girin")}}</strong>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>

                            <input class="form-control half" name="password2" id="password2" type="password"
                                placeholder="********" required="" />
                        </div>
                    </div>

                    <br />
                    <input type="hidden" name="do" value="register" />
                    <input type="submit" value="Kaydı Tamamla" class="btn turanj btn-lg" />
                </div>
            </form>
        </div>
    </div>
</div>
<script>
const formuye = document.getElementById('uyeol');
const sifre = document.getElementById('password');
const sifre2 = document.getElementById('password2');

// Attach an event handler to the form's submit event
formuye.addEventListener('submit', function(event) {
    if (sifre.value !== sifre2.value) {
        // Şifreler uyuşmuyorsa
        event.preventDefault(); // Form göndermeyi engelle
        alert(
            `Şifre alanı ile şifre tekrar alanı uyuşmuyor. Lütfen şifre karakterlerinizi aynı şekilde giriniz.`);
    } else {
        // Şifreler aynı ise, formu gönder
        formuye.submit();
    }
});
</script>

@endsection