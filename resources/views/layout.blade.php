
@include('components.header')


 @include('components.menu')  
<?php 
 $currentUrl = URL::current();
  if(!empty(session('kullanici'))&&$currentUrl=='http://127.0.0.1:8001/uye-panel/rezervasyonlar'||$currentUrl === 'http://127.0.0.1:8001/uye-panel/transferler'||$currentUrl === 'http://127.0.0.1:8001/uye-paneli'||$currentUrl === 'http://127.0.0.1:8001/uye-panel/sifre-degistir'||$currentUrl === 'http://127.0.0.1:8001/uye-panel/cikis-yap')
  {?>
    @include('components.kulheader');
 <?php }
 ?>
     @yield('icerik')

@include('components.footer')  



       