@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-body">
        <div>
            <h4>Filter Data</h4>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group mb-3">
                    <label for="roundText">Pilih Opd</label>
                    <select class="form-select" name="nama_skpd" id="nama_skpd" style="width: 100%" required>
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <label for="roundText">Tanggal Awal</label>
                    <input type="date" name="tgl_awal" id="tgl_awal" class="form-control mb-3 flatpickr-no-config" placeholder="Select date..">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <label for="roundText">Tanggal Akhir</label>
                    <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control mb-3 flatpickr-no-config" placeholder="Select date..">
                </div>
            </div>
        </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <label for="roundText">Pilih Periode</label>
                        <select class="form-select" name="periode" id="periode" style="width: 100%" required>
                            <option value="">Pilih Semua</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <label for="roundText">Pilih Jenis Potongan</label>
                        <select class="form-select" name="jenis_pajak" id="jenis_pajak" style="width: 100%" required>
                            <option value="">Pilih Semua</option>
                            <option value="Iuran Jaminan Kesehatan 4%">Iuran Jaminan Kesehatan 4%</option>
                            <option value="PPH 21">PPH 21</option>
                            <option value="Iuran Wajib Pegawai 1%">Iuran Wajib Pegawai 1%</option>
                            <option value="Belanja Iuran Jaminan Kesehatan PPPK">Belanja Iuran Jaminan Kesehatan PPPK</option>
                            <option value="Belanja Iuran Jaminan Kesehatan PNS">Belanja Iuran Jaminan Kesehatan PNS</option>
                            <option value="askes">askes</option>
                        </select>
                    </div>
                </div>
            </div>

        <br>
        <div class="row">
            <div class="col-sm-10">
                <div class="form-group mb-3">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group mb-3">
                    <button type="button" class="btn btn-outline-primary caribaruadmin" data-bs-dismiss="modal">
                        <i class="fa fa-check"></i><br> Terapkan
                    </button>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group mb-3">
                    <button type="submit" id="saveBtn" value="create" class="btn btn-outline-danger reset">
                        <i class="fa fa-undo"></i><br>  R e s e t
                    </button>
                </div>
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