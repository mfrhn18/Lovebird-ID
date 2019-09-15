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
                        <form method="POST" action="{{ route('reginduk.store') }}">
                        @csrf
                            <div class="form-group">
                                <label for="noParent">No. Induk</label>
                                <input name="noParent" type="text" class="form-control" id="noParent" placeholder="No. Induk">
                            </div>
                            <div class="form-group">
                                <label for="male">List Burung Jantan</label>
                                <select name="male" id="male" class="form-control">
                                {{-- @if($data['data']['user']['birdOwned']['gender'] == "Jantan") --}}
                                    @foreach($data['data']['user']['birdOwned'] as $male)
                                    <option selected value="{{$male['id']}}">{{$male['ring']}}</option>
                                    @endforeach 
                                {{-- @endif --}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="female">List Burung Betina</label>
                                <select name="female" id="female" class="form-control">
                                    @foreach($data['data']['user']['birdOwned'] as $female)
                                    <option selected value="{{$female['id']}}">{{$female['ring']}}</option>
                                    @endforeach
                                </select>
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