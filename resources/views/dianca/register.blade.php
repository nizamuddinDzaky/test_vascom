@extends('layouts.store')

@section('title')
    <title>Registrasi</title>
@endsection

@section('content')
    <div class="align-items-center d-flex min-vh-100 section_gap">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-7 pt-5">
                    <div class="container my-auto">
                        <div>
                            <img class="responsive" src="{{ asset('img/register.png') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pt-5">
                    <div class="card shadow-1 my-auto pt-2">
                        <div class="card-body">
                            <h3 class="card-title text-center pb-1"><strong>Daftar akun baru</strong></h3>
                            <h6 class="card-subtitle mb-2 text-muted text-center">Lorem ipsum is simply dummy text</h6>
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <form action="{{ route('customer.post_register') }}" class="form pl-3 pr-3 pt-4" id="register-form" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama</label><br>
                                    <input type="text" name="name" id="name" class="form-control bg-light @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label><br>
                                    <input type="text" name="email" id="email" class="form-control bg-light @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Nomor Telepon</label><br>
                                    <input type="phone" name="phone" id="phone" class="form-control bg-light @error('phone') is-invalid @enderror" required autocomplete="new-phone">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label><br>
                                    <input type="password" name="password" id="password" class="form-control bg-light @error('password') is-invalid @enderror" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label><br>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-light" required autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                   <div id="my_camera"></div>
                                   <button type="button" class="btn btn-primary" id="btn-take-photo">Ambil Photo</button>
                                </div>
                                <div class="form-group d-none">
                                    <div id="results-photo" ></div>
                                    <button type="button" class="btn btn-danger" id="btn-retake-photo">Ambil Ulang</button>
                                </div>
                                <div>
                                    <input type="photo" name="photo" id="photo">
                                </div>
                                <div class="form-group pt-4 text-center">
                                    <input type="submit" value="Daftar Sekarang" name="register_submit"
                                        id="register_submit" class="form-control form-control-lg bg-orange"
                                        style="color: white">
                                    <label class="text-muted text-center pt-2"><a href="{{ route('administrator.login') }}"
                                            style="color:orange;font-weight:bold">Masuk Admin</a></label><br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#btn-take-photo').click(function () {
            take_snapshot()
            .then(function (data_uri) {
                $('#photo').val(data_uri)
                $('#results-photo').html('<img src="'+data_uri+'"/>');
                $('#results-photo').parent().removeClass('d-none');
                $('#my_camera').parent().addClass('d-none');
            })
            .catch(error => console.error(error));
        })
        $('#btn-retake-photo').click(function () {
            $('#photo').val('')
            $('#results-photo').html();
            $('#results-photo').parent().addClass('d-none');
            $('#my_camera').parent().removeClass('d-none');
        })
    })
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach( '#my_camera' );
    function take_snapshot() {
        return new Promise(function(resolve, reject) {
            Webcam.snap( function(data_uri) {
                resolve(data_uri)
            } );

        })
        // take snapshot and get image data
    }
</script>
@endsection
