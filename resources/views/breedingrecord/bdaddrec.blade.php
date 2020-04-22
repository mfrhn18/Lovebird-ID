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
                        <form method="POST" action="/breedingdetails/batch/addrecord/add/{{$data['data']['breedingRecordById']['id']}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="formGroupExampleInput">
                                    <h5>Batch</h5>
                                </label>
                                <br>
                                <label for="formGroupExampleInput">
                                    <p>{{$data['data']['breedingRecordById']['name']}}</p>
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline"><input type="radio" onclick="javascript:yesnoCheck();" value="Breeding Log" name="log" id="noCheck">Log</label>
                                        <label class="radio-inline"><input type="radio" onclick="javascript:yesnoCheck();" value="Bertelur" name="log" id="maybeCheck">Bertelur</label>
                                        <label class="radio-inline"><input type="radio" onclick="javascript:yesnoCheck();" value="Hatch" name="log" id="yesCheck">Menetas</label>
                                        <div id="ifMaybe" style="visibility:hidden">
                                            <div class="row">
                                                <div class="col-md-6">Jumlah Telur <input id="egg" name="egg" type="text" class="form-control" placeholder="0"></div>
                                            </div>
                                        </div>
                                        <div id="ifYes" style="visibility:hidden">
                                            <div class="row">
                                                <div class="col-md-6">Born <input id="born" name="born" type="text" class="form-control" placeholder="0"></div>
                                                <div class="col-md-6">Dead <input id="dead" name="dead" type="text" class="form-control" placeholder="0"></div>
                                            </div>
                                        </div>
                                        <div id="ifNo" style="visibility:hidden">
                                            <label for="record">Deskripsi</label>
                                            <textarea class="form-control" rows="5" name="record" id="record"></textarea>
                                        </div>
                                    </div>
                                </div>
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

<script>
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.visibility = 'visible';
    }
    else document.getElementById('ifYes').style.visibility = 'hidden';

    if (document.getElementById('maybeCheck').checked) {
        document.getElementById('ifMaybe').style.visibility = 'visible';
    }
    else document.getElementById('ifMaybe').style.visibility = 'hidden';
    
    if (document.getElementById('noCheck').checked) {
        document.getElementById('ifNo').style.visibility = 'visible';
    }
    else document.getElementById('ifNo').style.visibility = 'hidden';
}
</script>