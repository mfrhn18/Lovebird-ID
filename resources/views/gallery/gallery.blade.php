@extends('layouts.base')

@section('content')    
<main role="main">
    <section class="content-header">
        <h1>
            Gallery
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="birdfarm"><i class="fa fa-picture-o"></i> Gallery</a></li>
        </ol>
    </section>    

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h4>Bird Gallery</h4>    
                        </div>
                        <div class="pull-right">
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
                                                    <form method="POST" action="/gallery/addimage" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="file">Upload Foto</label>
                                                            <input type="file" name="file" class="form-control-file" id="file">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="role">Jenis Burung</label><br>
                                                            <select name="role" id="role" class="form-control">
                                                                @foreach($data['data']['user']['birdOwned'] as $bird)
                                                                    <option selected value="{{$bird['id']}}">{{$bird['ring']}}</option>
                                                                @endforeach 
                                                            </select>
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
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="marketing text-center">        
                            
                            <div class="row text-center text-lg-left">
                                @foreach($data['data']['user']['birdOwned'] as $img)
                                    @foreach ( $img['image'] as $image )
                                        <div class="col-lg-3 col-md-4 col-xs-6">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="show-img">
                                                        <a href="#" class="d-block mb-4 h-100"><img src="{{$image['src']}}"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                                    
                            </div><!-- /.row -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>  
</main>
@endsection

<style type="text/css">
    .show-img img{
        width: 100%;
        height: 30%;
    }
</style>