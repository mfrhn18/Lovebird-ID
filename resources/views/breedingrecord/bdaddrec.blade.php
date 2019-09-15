<!-- Button -->
<div class="button">
    <button type="button" class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#modalRecord">
        Add Record
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="modalRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Aktivitas Breeding</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="formGroupExampleInput">
                            <h5>Batch</h5>
                        </label>
                        <br>
                        <label for="formGroupExampleInput">
                            <p>Batch-1 - IND-001</p>
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"><label class="radio-inline"><input type="radio" name="optradio" checked>Log</label></div>
                            <div class="col-md-4"><label class="radio-inline"><input type="radio" name="optradio">Bertelur</label></div>
                            <div class="col-md-4"><label class="radio-inline"><input type="radio" name="optradio">Menetas</label></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2"><h6>Deskripsi</h6></label>
                        <textarea class="form-control" rows="5" id="record"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Tambah Log</button>
            </div>
        </div>
    </div>
</div>