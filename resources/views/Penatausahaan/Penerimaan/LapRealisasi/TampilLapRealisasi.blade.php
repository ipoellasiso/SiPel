@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row col-md-12">
            <div class="col-md-4">
                <div class="avatar-image  m-h-15 m-r-25">
                    <img src="/app/assets/images/logo/13.png"  width="18%">
                </div>
            </div>
            <div class="col-md-4 text-center">
                <b><h4>PEMERINTAHAN KOTA PALU</b><br>
                <b><h4>REKAPAN POTONGAN TPP</b>
                <b><h4>TAHUN ANGGARAN 2025</b>
                <!-- <b><h5>PERIODE</h6></b> -->
            </div>
            <div class="col-md-4">
        </div>
    </div>

    

    </div>
</div>

<div class="card">
    <div class="card-body tampildata1">
        {{--Tampilan Data --}}
    </div>
</div>

@include('Penatausahaan.Penerimaan.Rekapan_tpp.Fungsi.Fungsi')

@endsection