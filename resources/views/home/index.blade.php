@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Halaman Utama')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <a href="#" class="box bg-info">
                <div class="box-cell p-a-3 valign-middle">
                    <i class="box-bg-icon middle right fa fa-tags"></i>
                    <span class="font-size-24"><strong>{{ $totalCategory }}</strong></span><br>
                    <span class="font-size-15">Category</span>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="#" class="box bg-info">
                <div class="box-cell p-a-3 valign-middle">
                    <i class="box-bg-icon middle right fa fa-cubes"></i>
                    <span class="font-size-24"><strong>{{ $totalProduct}}</strong></span><br>
                    <span class="font-size-15">Product</span>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="#" class="box bg-info">
                <div class="box-cell p-a-3 valign-middle">
                    <i class="box-bg-icon middle right fa fa-fax"></i>
                    <span class="font-size-24"><strong>{{ $totalRent}}</strong></span><br>
                    <span class="font-size-15">Rent / Penyewa</span>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('home.rent')
        </div>
    </div>
@endsection
