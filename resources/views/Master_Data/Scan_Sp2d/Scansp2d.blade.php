@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="col-md-9">
            </div>
            <div class="col-md-1">
            </div>
        </div>

        <br><br>
        <form action="{{ route('sp2d.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Pilih File SP2D (PDF/JPG/PNG)</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-upload"></i> Simpan ke Database
            </button>
        </form>

    </div>
</div>

@endsection