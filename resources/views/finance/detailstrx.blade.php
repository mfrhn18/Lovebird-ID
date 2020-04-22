<!-- Button -->
<div class="button">
    <button type="button" class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#TrxDet">
        Details
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="TrxDet">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Transaksi</h4>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="timeStamp">PEMASUKAN</label></br>
                        <table id="journal" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            @foreach($data['pemasukan'] as $pemasukan)
                            <tbody>
                                <td>{{$pemasukan['type']}}</td>
                                <td>{{$pemasukan['description']}}</td>
                                <td>Rp. {{$pemasukan['amount']}}</td>
                            </tbody>
                            @endforeach
                        </table> </br>
                        <label for="timeStamp">PENGELUARAN</label></br>
                        <table id="journal" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            @foreach($data['pengeluaran'] as $pengeluaran)
                            <tbody>
                                <td>{{$pengeluaran['type']}}</td>
                                <td>{{$pengeluaran['description']}}</td>
                                <td>Rp. {{$pengeluaran['amount']}}</td>
                            </tbody>
                            @endforeach
                        </table>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label>SUB TOTAL:</label>
                            </div>
                            <div class="col-md-6">
                                {{$data['pemasukanCalc']}}</br>
                                {{$data['pengeluaranCalc']}}</br>
                                _______-</br>
                                {{$data['pemasukanCalc']-$data['pengeluaranCalc']}}
                            </div>
                        </div>
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