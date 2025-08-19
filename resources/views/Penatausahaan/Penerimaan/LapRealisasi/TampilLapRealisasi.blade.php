@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($data2 as $d)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            {{$d->nomor_sp2d}}
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">{{$d->nilai_sp2d}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- @include('Penatausahaan.Penerimaan.Rekapan_tpp.Fungsi.Fungsi') -->

@endsection