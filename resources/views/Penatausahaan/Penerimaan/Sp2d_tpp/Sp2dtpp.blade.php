@extends('Template.Layout')
@section('content')


{{-- <div class="card"> --}}

    <div class="tab-content m-t-15" id="myTabContentJustified">
        <div class="tab-pane fade show active" id="bku" role="tabpanel" aria-labelledby="home-tab-justified">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                        <div class="col-md-7">
                        </div>
                        <div class="col-md-1">
                            <div class="btn-group dropdown me-1 mb-1">
                                <button type="button" class="btn btn-outline-primary btn-tone m-r-5 btn-xs ml-auto dropdown-toggle" id="dropdownMenuOffset"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    data-offset="5,20">
                                    <i class="fas fa-download"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                    {{-- <a class="dropdown-item" href="javascript:void(0)" id="createBku">Tambah Data</a>
                                    <a class="dropdown-item" id="createimportbku" href="#">Upload Data</a> --}}
                                    {{-- <a class="dropdown-item" href="/datarealisasi/export" data-toggle="tooltip" data-placement="top" title="klik"> Download Data </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- class="m-t-25" --}}
                    <br><br>
                    <div class="m-t-25 table-responsive">
                        <table id="data-table" class="sp2dtpp table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Action</th>
                                    <th>Nomor SPM</th>
                                    <th>Tanggal SP2D</th>
                                    <th>Nomor SP2D</th>
                                    <!-- <th>No. Rekening</th> -->
                                    <!-- <th>Rekening</th> -->
                                    <!-- <th>Nilai Rekening</th> -->
                                    <th>Unit SKPD</th>
                                    <th>Nama Penerima</th>
                                    <th>Keterangan</th>
                                    <th>Jenis SP2D</th>
                                    <th>Nilai SP2D</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('Penatausahaan.Penerimaan.Sp2d_tpp.Fungsi.Fungsi')
@include('Penatausahaan.Penerimaan.Sp2d_tpp.Modal.Tambah')


@endsection