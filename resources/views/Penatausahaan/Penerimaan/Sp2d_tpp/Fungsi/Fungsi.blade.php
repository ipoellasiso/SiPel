<script type="text/javascript">
    $(function () {

      /*------------------------------------------
       --------------------------------------------
       Pass Header Token
       --------------------------------------------
       --------------------------------------------*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      /*------------------------------------------
      --------------------------------------------
      Render DataTable
      --------------------------------------------
      --------------------------------------------*/
    var table = $('.sp2dtpp').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/sp2dtpp",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'action1', name: 'action1'},
            {data: 'nomor_spm', name: 'nomor_spm'},
            {data: 'tanggal_sp2d', name: 'tanggal_sp2d'},
            {data: 'nomor_sp2d', name: 'nomor_sp2d'},
            // {data: 'norekening', name: 'norekening'},
            // {data: 'uraian', name: 'uraian'},
            // {data: 'nilai', name: 'nilai'},
            {data: 'nama_skpd', name: 'nama_skpd'},
            {data: 'nama_pihak_ketiga', name: 'nama_pihak_ketiga'},
            {data: 'keterangan_sp2d', name: 'keterangan_sp2d'},
            {data: 'jenis', name: 'jenis'},
            {data: 'nilai_sp2d', name: 'nilai_sp2d'},
            {data: 'action2', name: 'action2'},
        ]
    });

    // edit data
    $('body').on('click', '.editsp2dtpp', function()  {
        var iduser = $(this).data('idhalaman');
        $.get("/sp2dtpp/edit/"+iduser, function (data) {
            $('#saveBtn').val("edit-sp2dtpp");
            $('#tambahsp2dtpp').modal('show');
            $('#idhalaman').val(data.idhalaman);
            $('.bd-example-modal-xl').modal('hide');
        })
    });

    // Update data
    $('body').on('click', '.updatesp2dtpp', function()  {
        var iduser = $(this).data('idhalaman');
        $.get("/sp2dtpp/update/"+iduser, function (data) {
            $('#saveBtnUpdate').val("update-sp2dtpp");
            $('#updatesp2dtpp').modal('show');
            $('#idhalaman2').val(data.idhalaman);
            $('#nomor_sp2d1').val(data.nomor_sp2d);
            $('.bd-example-modal-xl').modal('hide');
        })
    });

    // Batal data
    $('body').on('click', '.batalsp2dtpp', function()  {
        var iduser = $(this).data('idhalaman');
        $.get("/sp2dtpp/batal/"+iduser, function (data) {
            $('#saveBtnBatal').val("batal-sp2dtpp");
            $('#batalsp2dtpp').modal('show');
            $('#idhalaman1').val(data.idhalaman);
            $('#nomor_sp2d').val(data.nomor_sp2d);
            $('.bd-example-modal-xl').modal('hide');
        })
    });

    // simpan data
    $('body').on('submit', '#userForm', function(e){
        e.preventDefault();

        var actionType = $('#saveBtn').val();
        $('#saveBtn').html('Tunggu..');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/sp2dtpp/store",
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success)
                {
                    $('#userForm').trigger("reset");
                    $('#tambahsp2dtpp').modal('hide');
                    $('#saveBtn').html('Simpan');

                    Swal.fire({
                        icon: "success",
                        title: "success",
                        text: "Data Berhasil Disimpan"
                    })

                    table.draw();
                }
                else
                {
                    $('#userForm').trigger("reset");
                    $('#tambahsp2dtpp').modal('hide');
                    $('#saveBtn').html('Simpan');

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Data Sp2d TPP Sudah Ada"
                    })

                    table.draw();
                }
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtn').html('Simpan');
            }
        });
    });

    // simpan data Update
    $('body').on('submit', '#userFormUpdate', function(e){
        e.preventDefault();

        var idhalaman2 = $(this).data("idhalaman2");
        var actionType = $('#saveBtn').val();
        $('#saveBtn').html('Sabar Ya.....');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/sp2dtpp/update/"+idhalaman2,
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {

                $('#userFormUpdate').trigger("reset");
                $('#updatesp2dtpp').modal('hide');
                $('#saveBtn').html('Terima');
                // $('.bd-example-modal-xl').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Data Berhasil DiUpdate"
                })

                table.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtn').html('Terima');
            }
        });
    });

    // simpan data Batal
    $('body').on('submit', '#userFormBatal', function(e){
        e.preventDefault();

        var idhalaman = $(this).data("idhalaman");
        var actionType = $('#saveBtnBatal').val();
        $('#saveBtnBatal').html('Sabar Ya.....');

        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "/sp2dtpp/batalupdate/"+idhalaman,
            data: formData,
            cacha: false,
            contentType: false,
            processData: false,
            success: (data) => {

                $('#userFormBatal').trigger("reset");
                $('#batalsp2dtpp').modal('hide');
                $('#saveBtnBatal').html('Terima');
                // $('.bd-example-modal-xl').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "success",
                    text: "Data Berhasil Dibatalkan"
                })

                table.draw();
            },
            error: function(data){
                console.log('Error:', data);
                $('saveBtnBatal').html('Terima');
            }
        });
    });
    
});

$(document).ready(function() {
        $('.amount').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), ' '));
        });
    });

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? ' ' + rupiah : '');
}

</script>