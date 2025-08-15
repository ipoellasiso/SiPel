<br><br>
<div class="m-t-25 table-responsive">
    <table id="tbl1" class="tabelrekapan table table-hover table-bordered datatable-minimal">
        <thead class="table-danger">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama OPD</th>
                <th class="text-center">Nomor SP2D</th>
                <th class="text-center">Nilai SP2D</th>
                <!-- {{-- <th class="text-center" width="100px">Action</th> --}} -->
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @php $no = 1; @endphp
            @foreach ($data3 as $d )
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $d->nama_skpd }}</td>
                    <td>{{ $d->nomor_sp2d }}</td>
                    <td>{{ number_format($d->nilai_sp2d) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                
            </tr>
        </tfoot>
    </table>
</div>