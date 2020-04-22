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
            <li class="active"><a href="#"> Register Induk</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <form method="POST" action="/birdfarm/reginduk/create" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="noParent">No. Induk</label>
                                <input name="noParent" type="text" class="form-control" id="noParent" placeholder="No. Induk">
                            </div>
                            <div class="form-group">
                                <label for="male">List Burung Jantan</label>
                                <select name="male" id="male" class="form-control">
                                    @foreach($data['data']['user']['birdOwned'] as $male)
                                        @if($male['gender'] == "Jantan")
                                            <option selected value="{{$male['id']}}">{{$male['ring']}} - {{$male['species']}}</option>
                                        @endif
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="female">List Burung Betina</label>
                                <select name="female" id="female" class="form-control">
                                    @foreach($data['data']['user']['birdOwned'] as $female)
                                        @if($female['gender'] == "Betina")
                                            <option selected value="{{$female['id']}}">{{$female['ring']}} - {{$female['species']}}</option>
                                        @endif
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="file">Upload Foto</label>
                                <input type="file" name="file" class="form-control-file" id="file">
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>           
                    </div> 
                </div>
            <div class="col-md-3"></div>
        </div>
    </section>
</main>
@endsection