<!-- Button -->
<div class="button">
    <button type="button" class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#addTransaction">
        Add Image
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
                <h4 class="modal-title">Add Bird Image</h4>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('addimage.store') }}" enctype="multipart/form-data">
                            @csrf
                            <p id="date" class="text-center"></p>
                            <div class="form-group">
                                <label for="file">Upload Foto</label>
                                <input type="file" name="file" class="form-control-file" id="file">
                            </div>
                            <div class="form-group">
                                {{-- @foreach ($data['data']['user']['birdOwned'] as $bird)
                                <label for="role">Jenis Burung</label><br>
                                <select id="role" name="role" class="form-control">
                                    <option selected>{{$bird['ring']}}</option>
                                </select>
                                @endforeach --}}
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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