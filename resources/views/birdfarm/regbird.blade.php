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
            <li class="active"><a href="#"> Register Burung</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <form method="POST" action="/birdfarm/regbird/create" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="ring">Kode Ring</label>
                                <input id="ring" name="ring" type="text" class="form-control" placeholder="Kode Ring">
                            </div>
                            <div class="form-group">
                                <label for="species">Warna Mutasi</label>
                                <input id="species" name="species" type="text" class="form-control" placeholder="Warna Mutasi">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Jenis Burung</label><br>
                                <select id="type" name="type" class="form-control">
                                    <option selected>AGARPONIS ROSEICOLLIS</option>
                                    <option>AGARPONIS FISCHERI</option>
                                    <option>AGARPONIS NIGRIGENIS</option>
                                    <option>AGARPONIS LILIANAE</option>
                                    <option>AGARPONIS PERSONATA</option>
                                    <option>AGARPONIS TARANTA</option>
                                    <option>AGARPONIS CANUS</option>
                                    <option>AGARPONIS PULLARIUS</option>
                                    <option>AGARPONIS SWINDERNIANUS</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label for="gender">Kelamin</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option selected>Jantan</option>
                                    <option>Betina</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="age">Usia</label>
                                <input id="age" name="age" type="date" class="form-control datepicker">
                            </div>
                            <div class="form-group">
                                <label for="inputState">Induk</label>
                                <select id="inputState" class="form-control">
                                    <option selected>Null</option>
                                {{-- @if($data['data']['user']['birdOwned']['gender'] == "Jantan") --}}
                                    @foreach($data['data']['user']['birdParent'] as $ind)
                                    <option>{{$ind['noParent']}}</option>
                                    @endforeach 
                                {{-- @endif --}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="breeder">Peternak</label>
                                <input id="breeder" name="breeder" type="text" class="form-control" placeholder="Peternak">
                            </div>
                            <div class="form-group">
                                <label for="file">Upload Foto</label>
                                <input type="file" name="file" class="form-control-file" id="file">
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </section>
</main>
@endsection

<!-- bootstrap datepicker -->
    <script src="{{url('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
    $(function () {
        //Date picker
        $('#age').datepicker({
        dateFormat: 'dd-mm-yy'
        autoclose: true
        })

        //Timepicker
        $('.timepicker').timepicker({
        showInputs: false
        })
    })
    </script>