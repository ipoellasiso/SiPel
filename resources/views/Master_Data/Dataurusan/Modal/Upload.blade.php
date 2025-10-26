<div class="modal fade" id="modalUploadExcel" tabindex="-1" aria-labelledby="modalUploadExcelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content shadow-lg border-0 rounded-3">

            <form id="formUploadExcel" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient bg-success text-white py-3">
                    <h5 class="modal-title fw-semibold" id="modalUploadExcelLabel">
                        <i class="fas fa-file-excel me-2"></i> Upload Data Urusan (Excel)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body px-4 py-3">
                    <!-- Input file -->
                    <div class="form-group mb-3">
                        <label for="file_excel" class="form-label fw-semibold">
                            <i class="fas fa-folder-open me-1 text-success"></i> Pilih File Excel
                        </label>
                        <input type="file" name="file_excel" id="file_excel"
                            class="form-control form-control-sm border-0 shadow-sm"
                            accept=".xlsx,.xls,.csv" required>
                    </div>

                    <!-- Preview -->
                    <div id="previewContainer" class="mt-3" style="display: none;">
                        <label class="form-label fw-semibold mb-2">
                            <i class="fas fa-eye me-1 text-primary"></i> Preview Data (5 Baris Pertama)
                        </label>
                        <div class="table-responsive border rounded-2">
                            <table class="table table-sm table-bordered align-middle mb-0" id="previewTable">
                                <thead class="table-success text-center small">
                                    <tr>
                                        <th>Nama Urusan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center small bg-white"></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="alert alert-info py-2 mt-3 mb-0 small d-flex align-items-center shadow-sm">
                        <i class="fas fa-info-circle me-2 text-primary"></i>
                        Pastikan file Excel memiliki header kolom:
                        <strong class="ms-1 text-dark">nama_urusan</strong>
                    </div>

                    <!-- Progress -->
                    <div class="progress mt-3" style="height: 20px; display:none;" id="progressContainer">
                        <div id="uploadProgress"
                            class="progress-bar progress-bar-striped progress-bar-animated bg-success fw-semibold"
                            role="progressbar" style="width: 0%">0%</div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-end border-0 px-4 pb-4">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" id="uploadBtn" class="btn btn-success btn-sm px-3 shadow-sm">
                        <i class="fas fa-upload me-1"></i> Upload
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
