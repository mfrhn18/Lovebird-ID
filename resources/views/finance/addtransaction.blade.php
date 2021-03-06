<!-- Button -->
<div class="button">
    <button type="button" class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#addTransaction">
        Add Transaction
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="addTransaction">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Transaksi</h4>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form method="POST" action="/finance/transaction/add" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control datepicker pull-right" id="datepicker" name="datepicker">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tipe Transaksi</label><br>
                                <select id="type" name="type" class="form-control">
                                    <option selected>101-Penjualan</option>
                                    <option>102-Lelang</option>
                                    <option>103-Pemasukan lain-lain</option>
                                    <option>201-Tagihan</option>
                                    <option>202-Operasional</option>
                                    <option>203-Pengeluaran lain-lain</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="desc">Deskripsi</label><br>
                                <textarea id="desc" name="desc" class="form-control" rows="3" placeholder="Deskripsi"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="amount">Jumlah</label><br>
                                <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input id="amount" name="amount" type="text" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- bootstrap datepicker -->
    <script src="{{url('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
    $(function () {
        //Date picker
        $('#datepicker').datepicker({
        autoclose: true
        })

        //Timepicker
        $('.timepicker').timepicker({
        showInputs: false
        })
    })
    </script>