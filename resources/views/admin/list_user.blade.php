@extends('layouts.admin')

@section('title')
<title>User</title>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row pb-100">
        <div class="col-lg-12">
            <div class="table-responsive curved-border">
                <table class="table table-bordered text-gray-2">
                    <thead>
                        <tr>
                            <th class="px-3">ID</th>
                            <th class="px-3">Nama</th>
                            <th class="px-3">Email</th>
                            <th class="px-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customer as $c)
                        <tr>
                            <td class="weight-600 font-14 px-3">{{ $c->id }}</td>
                            <td class="font-14 px-3">{{ $c->name }}</td>
                            <td class="font-14 px-3">{{ $c->email }}</td>
                            <td class="font-14 px-3">
                                <button class="btn btn-primary btn-detail" 
                                    data-nama="{{ $c->name }}"
                                    data-email="{{ $c->email }}"
                                    data-image="{{ asset($c->image) }}"
                                >
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade w-100"  role="dialog" id="modal-detail-user">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header pl-0 pb-4">
                <h3 class="modal-title w-100 text-center position-absolute">Detail User</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="cart_inner" id="div-list-alamat">
                        <table class="table table-striped">
                            <tr>
                                <th>Nama</th>
                                <td id="td-nama"></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td id="td-email"></td>
                            </tr>
                            <tr>
                                <th>Photo</th>
                                <td id="td-photo"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.btn-detail').click(function () {
        let nama = $(this).data('nama');
        let email = $(this).data('email');
        let photo = $(this).data('image');
        $('#td-nama').text(nama);
        $('#td-email').text(email);
        $('#td-photo').html('<image src=\''+photo+'\'>');
        $('#modal-detail-user').modal('toggle');
        $('#modal-detail-user').modal('show');
    })
</script>
@endsection