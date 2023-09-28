@extends('layout')
@section('icerik')

<div class="container firstclear marbot">
    <div class="row">
        <div class="col-md-6">
            <h1 class="bigtitle"><strong>Bize Ulaşın</strong></h1>

            <p class="context">
                <span class="glyphicon glyphicon-map-marker"></span> <strong>Adres:</strong>
                {{$SayfailetisimVerileri->adres}}
            </p>

            <p class="context"><span class="glyphicon glyphicon-earphone"></span> <strong>Telefon:</strong>
                {{$SayfailetisimVerileri->tel}} </p>
            <p class="context">
                <span class="glyphicon glyphicon-envelope"></span> <strong>E-posta:</strong>
                {{$SayfailetisimVerileri->e_posta}}
            </p>

        </div>
        <div class="col-md-6">
            <h1 class="bigtitle"><strong>Mesaj Gönderin</strong></h1>
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
            <form method="POST" action="{{ route('iletisim.mesaj') }}" enctype="multipart/form-data">
                @csrf
                <!-- Cross-Site Request Forgery (CSRF) koruması -->
                <input name="ilet_id" id='ilet_id' type="hidden" class="form-control form-control-default">
                <input type="text" class="form-control" id="ad_soyad" name="ad_soyad" required=""
                    placeholder="Ad Soyad..." />

                <br />
                <input type="text" class="form-control" id="e_posta" name="e_posta" required=""
                    placeholder="E-posta Adresi..." />

                <br />
                <input type="text" class="form-control" id="konu" name="konu" required="" placeholder="Konu..."
                    value="" />

                <br />
                <textarea class="form-control" id="mesaj" name="mesaj" required="" placeholder="Mesaj..."></textarea>

                <br />
                <table cellpadding="0" cellpadding="0" border="0">
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="capt" required=""
                                placeholder="Güvenlik kodu..." />
                        </td>
                        <td style="padding-left: 15px;">
                            <img src="captcha.php" alt="CAPTCHA" id="capim" style="border-radius:8px;" />
                            <img src="fonts/ref.png" style="height: 24px; margin-left:10px;"
                                onclick="document.getElementById('capim').src = 'captcha.php?t=' + Date.now();" />
                        </td>
                    </tr>
                </table>

                <br />

                <input type="submit" class="btn turanj" value="Mesajı Gönder" />
                <input type="reset" class="btn btn-default" value="Formu Temizle" />
            </form>
        </div>
    </div>

    <br />
    <div class="staticmaps">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d24042.48006091193!2d37.285008!3d41.127758!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbdc82796dfdf3317!2sHaz%C4%B1r%20Rent%20a%20Car%20Sitesi%20Web%20Tasar%C4%B1m%C4%B1!5e0!3m2!1str!2str!4v1673880735156!5m2!1str!2str"
            width="640" height="480" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
@endsection