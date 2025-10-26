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
    // === DataTables ===
    var table = $('#tabelurusan').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dataurusan.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center'},
            {data: 'Nama_Urusan', name: 'Nama_Urusan'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className:'text-center'},
        ]
    });

    // === SweetAlert Toast Config ===
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // === Tambah Urusan ===
    $('#createUrusan').click(function () {
        $('#formUrusan').trigger("reset");
        $('#id').val('');
        $('#saveBtn').html('Simpan');
        $('#saveBtn').prop('disabled', false);
        $('#modalUrusan').modal({
            backdrop: 'static',
            keyboard: false
        }).modal('show');

        // 📘 Toast info saat mode tambah aktif
        Toast.fire({
            icon: 'info',
            title: 'Mode tambah data aktif'
        });

        // ✍️ Auto-focus ke input nama setelah modal muncul
        setTimeout(() => {
            $('#Nama_Urusan').focus();
        }, 400);
    });

    // === Edit Urusan ===
    $('body').on('click', '.editUrusan', function () {
        var id = $(this).data('id');
        $.get("http://127.0.0.1:8000/api/urusan/" + id, function (data) {
            $('#modalUrusan').modal({
                backdrop: 'static',
                keyboard: false
            }).modal('show');
            $('#id').val(data.UrusanID);
            $('#Nama_Urusan').val(data.Nama_Urusan);

            // ✍️ Auto-focus juga saat edit
            setTimeout(() => {
                $('#Nama_Urusan').focus();
            }, 400);
        })
    });

    // === Simpan / Update Urusan ===
    $('#saveBtn').click(function (e) {
        e.preventDefault();

        // 🚨 Validasi kosong
        var namaUrusan = $('#Nama_Urusan').val().trim();
        if (namaUrusan === '') {
            Toast.fire({
                icon: 'warning',
                title: 'Nama Urusan tidak boleh kosong!'
            });
            $('#Nama_Urusan').focus();
            return;
        }

        var id = $('#id').val();
        var url = id ? "http://127.0.0.1:8000/api/urusan/" + id : "http://127.0.0.1:8000/api/urusan";
        var method = id ? "PUT" : "POST";

        // 🔄 Spinner loading
        $('#saveBtn').html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        $('#saveBtn').prop('disabled', true);

        $.ajax({
            data: { Nama_Urusan: namaUrusan },
            url: url,
            type: method,
            dataType: 'json',
            success: function (data) {
                table.ajax.reload();

                // 💨 Fade-out lembut
                $('#modalUrusan .modal-dialog').fadeOut(300, function() {
                    $('#modalUrusan').modal('hide');
                    $('#modalUrusan .modal-dialog').show();
                });

                // Reset tombol & form
                $('#saveBtn').html('Simpan');
                $('#saveBtn').prop('disabled', false);
                $('#formUrusan').trigger("reset");

                // ✅ Toast sukses (delay biar halus)
                setTimeout(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan'
                    });
                }, 400);
            },
            error: function (xhr) {
                $('#saveBtn').html('Simpan');
                $('#saveBtn').prop('disabled', false);

                Toast.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan saat menyimpan data'
                });
            }
        });
    });

    // === Hapus Urusan ===
    $('body').on('click', '.deleteUrusan', function () {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus data ini?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "http://127.0.0.1:8000/api/urusan/" + id,
                    success: function (data) {
                        table.ajax.reload();

                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil dihapus'
                        });
                    },
                    error: function (data) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Gagal menghapus data'
                        });
                    }
                });
            }
        });
    });

    // === Upload Urusan ===
    $('#btnUploadExcel').on('click', function () {
        // buka modal
        $('#modalUploadExcel').modal('show');
    });

    // === Proses Upload Excel ===
    $('#formUploadExcel').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var progressBar = $('#uploadProgress');
        var progressContainer = $('#progressContainer');

        $('#uploadBtn').html('<i class="fa fa-spinner fa-spin"></i> Mengunggah...');
        $('#uploadBtn').prop('disabled', true);
        progressContainer.show();
        progressBar.css('width', '0%').text('0%');

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();

                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        progressBar.css('width', percentComplete + '%').text(percentComplete + '%');
                    }
                }, false);

                return xhr;
            },
            url: "{{ route('urusan.import') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#uploadBtn').html('<i class="fas fa-upload"></i> Upload');
                $('#uploadBtn').prop('disabled', false);
                progressContainer.hide();
                $('#modalUploadExcel').modal('hide');
                $('#file_excel').val('');
                $('#tabelurusan').DataTable().ajax.reload();

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745'
                });
            },
            error: function(xhr) {
                $('#uploadBtn').html('<i class="fas fa-upload"></i> Upload');
                $('#uploadBtn').prop('disabled', false);
                progressContainer.hide();

                let msg = xhr.responseJSON?.message || 'Terjadi kesalahan!';
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: msg,
                });
            }
        });
    });

    $('#file_excel').on('change', function(e) {
        var file = e.target.files[0];
        if (!file) return;

        var reader = new FileReader();

        reader.onload = function(e) {
            var data = new Uint8Array(e.target.result);
            var workbook = XLSX.read(data, { type: 'array' });

            var firstSheet = workbook.SheetNames[0];
            var worksheet = workbook.Sheets[firstSheet];
            var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

            var tbody = $('#previewTable tbody');
            tbody.empty();

            if (jsonData.length <= 1) {
                tbody.append('<tr><td class="text-muted">Tidak ada data ditemukan</td></tr>');
                $('#previewContainer').slideDown();
                return;
            }

            // Ambil semua nilai di kolom pertama (tanpa header)
            var values = [];
            for (var i = 1; i < jsonData.length; i++) {
                if (jsonData[i] && jsonData[i][0]) {
                    values.push(jsonData[i][0].toString().trim());
                }
            }

            // Hitung duplikat
            var duplicates = values.filter((item, idx) => values.indexOf(item) !== idx);

            // Tampilkan 5 baris pertama dengan validasi warna
            for (var i = 1; i < jsonData.length && i <= 5; i++) {
                var cellValue = jsonData[i] && jsonData[i][0] ? jsonData[i][0].toString().trim() : '';
                var cssClass = '';
                var tooltip = '';

                if (cellValue === '') {
                    cssClass = 'table-warning text-warning fw-semibold';
                    tooltip = 'Baris ini kosong dan tidak akan diimport';
                } else if (duplicates.includes(cellValue)) {
                    cssClass = 'table-danger text-danger fw-semibold';
                    tooltip = 'Data ini duplikat dengan baris lain';
                }

                var row = `
                    <tr>
                        <td class="${cssClass}" title="${tooltip}">
                            ${cellValue || '(kosong)'}
                        </td>
                    </tr>`;
                tbody.append(row);
            }

            // Aktifkan tooltip Bootstrap
            $('[title]').tooltip({ placement: 'top', trigger: 'hover' });

            // Tampilkan preview container
            $('#previewContainer').addClass('show').slideDown(200);
        };

        reader.readAsArrayBuffer(file);
    });

    // === Excel Tools Dropdown Actions ===

    // Export Excel
    $('#btnExportExcel').on('click', function() {
        Swal.fire({
            title: 'Export Data Urusan?',
            text: "File akan diunduh dalam format Excel.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Export Sekarang',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#28a745',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('urusan.export') }}";
            }
        });
    });

    // Upload Excel (buka modal)
    $('#btnUploadExcel').on('click', function() {
        $('#modalUploadExcel').modal('show');
    });

});

</script>
