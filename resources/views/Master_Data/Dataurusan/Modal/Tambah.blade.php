<div class="modal fade" id="modalUrusan" tabindex="-1" aria-labelledby="modalUrusanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formUrusan" name="formUrusan">
        @csrf
        <input type="hidden" name="id" id="id">
        <div class="modal-header">
          <h5 class="modal-title" id="modalUrusanLabel">Tambah / Edit Urusan</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Urusan</label>
            <input type="text" name="Nama_Urusan" id="Nama_Urusan" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" id="saveBtn" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
