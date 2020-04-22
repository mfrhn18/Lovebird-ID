<!-- Button -->
<div class="button">
    <button type="button" class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#addTransaction">
        Add Journal
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
                    <div class="col-md-12">
                        <form method="POST" action="/finance/journal/create">
                            @csrf
                            <p id="date" class="text-center"></p>
                            <div class="form-group">
                                <label for="timeStamp">Bulan</label></br> 
                                <div class="col-md-6">
                                    <select id="month" name="month" class="form-control">
                                        <option value="01" selected>January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input id="year" name="year" type="text">
                                </div>
                                <button type="submit" class="btn btn-primary">Buat Jurnal</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
