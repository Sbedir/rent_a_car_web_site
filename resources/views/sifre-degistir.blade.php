@extends('layout')
 @section('icerik')

            
                <div class="col-md-9">
                                <h1 class="bigtitle"><strong>Şifre Değiştir</strong></h1>
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
                                <form method="POST" action="{{ route('sifre.degistir') }}" enctype="multipart/form-data">
                              @csrf                   
                        <div class="sozlesmebox rounded bordered nobg">
                         <div class="form-group">
                            <strong>Şuanki Şifre</strong>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </div>
                                                
                                <input class="form-control half" name="password" type="password" placeholder="********" required="" />
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <strong>Yeni Şifre</strong>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </div>
                                                
                                <input class="form-control half" name="password2" type="password" placeholder="********" required="" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <strong>Yeni Şifre Tekrarı</strong>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </div>
                                                
                                <input class="form-control half" name="password2" type="password" placeholder="********" required="" />
                            </div>
                        </div>
                        
                        <br />
                        <input type="hidden" name="do" value="updatepass" />
                        <input type="submit" value="Şifre Değiştir" class="btn btn-success btn-lg" />
                    </div>
                </form>
                            </div>
                            </div>
    </div>
    @endsection