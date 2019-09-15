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
                        <form method="POST" action="{{ route('addjournal.store') }}">
                            @csrf
                            <p id="date" class="text-center"></p>
                            <div class="form-group">
                            <label for="timeStamp">Bulan - Tahun Jurnal</label></br> 
                                <input id="date" name="date" type="text" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary">Buat Jurnal</button>
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

    <script>
        var today = new Date();
        var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
        var timeStamp = today.getHours() + ":" + today.getMinutes()+", "+today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
        document.getElementById("date").innerHTML = date;
        document.getElementById("time").innerHTML = timeStamp;
    </script>