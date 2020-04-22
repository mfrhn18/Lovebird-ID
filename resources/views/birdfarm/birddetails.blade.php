@extends('layouts.base')

@section('content')
<main role="main">
    <section class="content-header">
        <h1>
            BirdFarm
            <small>Management</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="birdfarm"><i class="glyphicon glyphicon-info-sign"></i> BirdFarm</a></li>
            <li class="active"><a href="#"> Bird Details</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="col-md-6">
                        <!-- Gallery -->
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                @foreach($data['data']['birdFilterById']['image'] as $img)
                                <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                @foreach($data['data']['birdFilterById']['image'] as $img)
                                <div class="item {{ $loop->first ? 'active' : '' }}">
                                    <img class="d-block img-fluid" src="{{$img['src']}}" width="500">
                                </div>
                                @endforeach
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Information -->
                        <h3>{{$data['data']['birdFilterById']['ring']}}</h3>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="button">
                                    <a href="/birdfarm/birddetails/edit/{{$data['data']['birdFilterById']['id']}}" type="button" class="btn btn-block btn-sm bg-orange">
                                        Edit Details
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Button -->
                                <div class="button">
                                    <button type="button" class="btn btn-block btn-sm bg-orange" data-toggle="modal" data-target="#addDNA">
                                        Bird DNA
                                    </button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="addDNA">
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
                                                    <div class="col-md-12">
                                                        @if($data['data']['birdFilterById']['dna']['src'] != null)
                                                            <img class="d-block img-fluid" src="{{$data['data']['birdFilterById']['dna']['src']}}" width="500">
                                                        @else
                                                            <p align="center">DNA belum di upload.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <form method="POST" action="/birdfarm/birddetails/dna/{{$data['data']['birdFilterById']['id']}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="file">Upload Bird DNA</label>
                                                                <input type="file" name="file" class="form-control-file" id="file">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </form>
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
                                </div>
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                        </div>
                        <hr>
                        <table class="mt-3 pt-3 mb-1 pb-1" id="userdetails">
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td>{{$data['data']['birdFilterById']['name']}}</td>
                                </tr>
                                <tr>
                                    <th>No. Ring</th>
                                    <td>:</td>
                                    <td>{{$data['data']['birdFilterById']['ring']}}</td>
                                </tr>
                                <tr>
                                    <th>Warna Mutasi</th>
                                    <td>:</td>
                                    <td>{{$data['data']['birdFilterById']['species']}}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Burung</th>
                                    <td>:</td>
                                    <td>{{$data['data']['birdFilterById']['type']}}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>:</td>
                                    <td>{{$data['data']['birdFilterById']['gender']}}</td>
                                </tr>
                                <tr>
                                    <th>Induk</th>
                                    <td>:</td>
                                    <td>{{$data['data']['birdFilterById']['parent']['noParent']}}</td>
                                </tr>
                                <tr>
                                    <th>Peternak</th>
                                    <td>:</td>
                                    <td>{{$data['data']['birdFilterById']['breeder']}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>
@endsection