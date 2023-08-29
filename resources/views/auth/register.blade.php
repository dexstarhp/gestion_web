@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Registro de usuario'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Nuevo Usuario</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register.perform') }}">
                            @csrf
                            <div class="flex flex-col mb-3">
                                <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Name" value="{{ old('username') }}" >
                                @error('username') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <div class="flex flex-col mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" value="{{ old('email') }}" >
                                @error('email') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <div class="flex flex-col mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                                @error('password') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <div class="form-check form-check-info text-start">
                                @error('terms') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
