@extends('Template.Layout')
@section('content')

{{-- pastikan sudah include sweetalert2 dan jquery --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

<style>
/* ✨ Animasi modal custom */
.modal.fade .modal-dialog {
    transform: translateY(-30px);
    transition: transform 0.3s ease-out;
}
.modal.fade.show .modal-dialog {
    transform: translateY(0);
}

/* ✨ Animasi modal tampil lembut */
.modal.fade .modal-dialog {
    transform: translateY(-30px);
    transition: transform 0.3s ease-out;
}
.modal.fade.show .modal-dialog {
    transform: translateY(0);
}

/* 💫 Background blur saat modal muncul */
.modal-backdrop.show {
    opacity: 0.3;
    backdrop-filter: blur(2px);
}

.progress {
    transition: all 0.3s ease-in-out;
}

.progress-bar {
    font-weight: 600;
    color: #fff;
    text-shadow: 0 0 3px rgba(0,0,0,0.4);
}

.table-warning {
    background-color: #fff3cd !important;
    color: #856404 !important;
}
.table-danger {
    background-color: #f8d7da !important;
    color: #842029 !important;
}
.table tbody tr:hover td {
    background-color: #f4f6f8;
}

.dropdown-menu {
    border-radius: 0.5rem;
    font-size: 0.9rem;
    padding: 0.5rem 0;
}
.dropdown-item i {
    width: 18px;
    text-align: center;
}
.dropdown-item:hover {
    background-color: #f1fdf3;
}
</style>

<div class="card">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-2">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="col-md-10 text-end">
                <!-- 🔹 Excel Tools Dropdown -->
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle shadow-sm"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-file-excel me-1"></i> Excel Tools
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                        <li>
                            <a class="dropdown-item text-success" href="javascript:void(0)" id="btnExportExcel">
                                <i class="fas fa-download me-2 text-success"></i> Export Data Urusan
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-primary" href="javascript:void(0)" id="btnUploadExcel">
                                <i class="fas fa-upload me-2 text-primary"></i> Upload dari Excel
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-dark" href="{{ asset('template_urusan_kosong.xlsx') }}">
                                <i class="fas fa-file-alt me-2 text-secondary"></i> Download Template Excel
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- 🔹 Tombol Tambah Data -->
                <a class="btn btn-outline-primary btn-sm shadow-sm ms-2" href="javascript:void(0)" id="createUrusan">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Data
                </a>
            </div>
        </div>

        <br><br>
        <div class="m-t-25 table-responsive">
            <table id="tabelurusan" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Urusan</th>
                        <th class="text-center" width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- datatable ajax --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('Master_Data.Dataurusan.Modal.Tambah')
@include('Master_Data.Dataurusan.Modal.Upload')
@include('Master_Data.Dataurusan.Fungsi.Fungsi')
@endsection
