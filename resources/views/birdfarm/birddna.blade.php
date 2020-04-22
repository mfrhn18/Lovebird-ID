<!-- Button -->
<div class="button">
    <button type="button" class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#addTransaction">
        Bird DNA
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
                <h4 class="modal-title">Bird DNA</h4>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form method="POST" action="/birdfarm/birddetails/dna/{{$data['data']['data']['birdFilterById']['id']}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Upload Bird DNA</label>
                                <input type="file" name="file" class="form-control-file" id="file">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if($data['data']['data']['birdFilterById']['dna']['src'] == true)
                            <img class="d-block img-fluid" src="{{$data['data']['data']['birdFilterById']['dna']['src']}}" width="500">
                        @else
                            <p align="center">DNA belum di upload.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->