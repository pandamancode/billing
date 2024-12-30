@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Halaman Utama')
@section('content')
    <div class="row">
        <div class="panel-body">
            <div class="col-md-6 col-md-offset-3 text-center" >
                <h3 style="margin-top:5px !important;" class="text-success">Selamat Datang {{ Auth::user()->name }}</h3>
                
                <a class="btn btn-success btn-sm" href="{{ route('jadwal.index') }}">Klik untuk melihat Jadwal Ujian/Tryout</a>
            </div>
        </div>
    </div>
@endsection
