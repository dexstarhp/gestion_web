@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Editar Items'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Modificación de Item</p>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form role="form" method="POST" action={{ route('items.update',$item) }} enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('items.partials.form')
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Editar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
