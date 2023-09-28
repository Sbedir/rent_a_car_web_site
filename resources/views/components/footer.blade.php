

  <div class="footbar">
        <div class="container-fluid xtop">
            <div class="container">
                <div class="row fooicons">
                    <div class="col-md-3 fooiconed">
                        <p>
                            <span class="glyphicon glyphicon-road"></span>
                            <strong>ARAÇ FİLOSU</strong>
                            En uygun fiyatlarla en kaliteli araç kiralama hizmeti!
                        </p>
                    </div>
                    <div class="col-md-3 fooiconed">
                        <p>
                            <span class="glyphicon glyphicon-user"></span>
                            <strong>ÜYELİK İŞLEMLERİ</strong>
                            Hemen ücretsiz üye olun, rezervasyon takibini kolayca yapın!
                        </p>
                    </div>
                    <div class="col-md-3 fooiconed">
                        <p>
                            <span class="glyphicon glyphicon-fire"></span>
                            <strong>EKSTRA SEÇENEKLER</strong>
                            Rezervasyonun ekstraları ile sürüşünüzü kolay ve güvenli yapın!
                        </p>
                    </div>
                    <div class="col-md-3 fooiconed">
                        <p>
                            <span class="glyphicon glyphicon-map-marker"></span>
                            <strong>BİZE ULAŞIN</strong>
                            Her türlü soru ve sorununuz için bize hemen ulaşabilirsiniz!
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid xgreen">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <h3 class="footitle">Rezervasyon İşlemleri</h3>

                            <a href="https://tema13.otokiralamascripti.net/fiyat-listesi" class="foota fylist">Araç
                                Kirala</a>
                            <a href="https://tema13.otokiralamascripti.net/sorgulama" class="foota">Rezervasyon
                                Sorgula</a>
                            <a href="https://tema13.otokiralamascripti.net/uye-panel" class="foota">Geçmiş
                                Rezervasyonlarım</a>
                            <a href="https://tema13.otokiralamascripti.net/transfer" class="foota">Transfer
                                Rezervasyonu</a>
                            <a href="https://tema13.otokiralamascripti.net/uye-giris" class="foota">Üye Giriş/Kayıt</a>
                        </div>
                        <div class="col-md-4">
                            <h3 class="footitle">Hakkımızda</h3>
                            <a href="https://tema13.otokiralamascripti.net/sayfa/5-hakkimizda"
                                class="foota">Hakkımızda</a>
                            <a href="https://tema13.otokiralamascripti.net/sayfa/6-kiralama-kosullari"
                                class="foota">Kiralama Koşulları</a>
                            <a href="https://tema13.otokiralamascripti.net/sayfa/7-filo-kiralama" class="foota">Filo
                                Kiralama</a>
                            <a href="https://tema13.otokiralamascripti.net/sayfa/8-s.s.s." class="foota">S.S.S.</a>
                            <a href="https://tema13.otokiralamascripti.net/haberler" class="foota">Haber &amp;
                                Duyurular</a>
                            <a href="https://tema13.otokiralamascripti.net/iletisim" class="foota">Bize Ulaşın</a>
                        </div>
                        <div class="col-md-4">
                            <h3 class="footitle">Sosyal Medya</h3>

                            <div class="socialsfoot">
                                <a href="http://www.facebook.com" target="_blank" class="facebook">&nbsp;</a>
                                <a href="http://www.twitter.com" target="_blank" class="twitter">&nbsp;</a>
                                <a href="http://www.linkedin.com" target="_blank" class="linkedin">&nbsp;</a>
                                <a href="http://www.plussoc.com" target="_blank" class="googleplus">&nbsp;</a>

                                <p class="foodestek">
                                    <strong>Rezervasyon Hattı</strong>
                                    <span><a href="tel:+905443240060" target="_blank">0 544 324 00 60</a></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

    <div class="fooaltbar">
        https://tema13.otokiralamascripti.net/ &copy; 2023 - Tüm Hakları Saklıdır - <label><a
                href="http://www.otokiralamascripti.net" target="_blank">Oto Kiralama Scripti</a></label>
    </div>

    <script type="text/javascript" src="{{asset('assets/js/system.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/system.css')}}" />
    <script type="text/javascript" src="{{asset('theme/js/theme.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.css')}}" />
    <script type="text/javascript" src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/datepicker-tr.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery-ui-timepicker-addon.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/uilang/datepicker-tr.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui-timepicker-addon.css')}}" />
    <script type="text/javascript">
        lang_operror = 'İşlem gerçekleştirilirken bir hata oluştu!';
        lang_afterselect = 'Lütfen seçim yaptıktan sonra tekrar deneyin!';
        lang_loading = 'Yükleniyor, lütfen bekleyin!';
        $.timepicker.setDefaults($.timepicker.regional['tr']);

        const formuye = document.getElementById('uyeol');
    const sifre = document.getElementById('password');
    const sifre2 = document.getElementById('password2');

    // Attach an event handler to the form's submit event
    formuye.addEventListener('submit', function(event) {
        if (sifre.value !== sifre2.value) {
            // Şifreler uyuşmuyorsa
            event.preventDefault(); // Form göndermeyi engelle
            alert(`Şifre alanı ile şifre tekrar alanı uyuşmuyor. Lütfen şifre karakterlerinizi aynı şekilde giriniz.`);
        } else {
            // Şifreler aynı ise, formu gönder
            formuye.submit();
        }
    });

   
               
 




   



 
    </script>

    <!-- analytics kodu 
 SHORTCUTS -->
    <div class="shortcut_container">
        <a href="https://api.whatsapp.com/send?phone=905443240060" target="_blank" class="shortcut_icon"
            data-tooltip="Whatsapp Mesajı Gönder"><img src="{{asset('images/shortcut/wp.png')}}" width="100%" height="100%"></a> <a
            href="https://www.google.com/maps/place/Haz%C4%B1r+Rent+a+Car+Sitesi+Web+Tasar%C4%B1m%C4%B1/@41.127758,37.285008,14z/data=!4m5!3m4!1s0x0:0xbdc82796dfdf3317!8m2!3d41.1277577!4d37.2850083?hl=tr-TR"
            target="_blank" class="shortcut_icon" data-tooltip="Haritayı Görüntüle"><img src="{{asset('images/shortcut/map.png')}}"
                width="100%" height="100%"></a> <a href="tel:0 544 324 00 60" target="_blank" class="shortcut_icon"
            data-tooltip="Arama Yap"><img src="{{asset('images/shortcut/tel.png')}}" width="100%" height="100%"></a>
    </div>
</body>

</html>