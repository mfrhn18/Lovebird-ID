@extends('layouts.base')

@section('content')
<main role="main">
    <section class="content-header">
        <h1>
            Breeder
            <small>Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="breeder"><i class="glyphicon glyphicon-info-sign"></i> Profile</a></li>
            <li class="active"><a href="#"> Edit</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-body">
                        <form method="POST" action="/breeder/edit/save" enctype="multipart/form-data">
                        @csrf
                            <div class="text-center">
                                <img class="text-center" src="{{ Session::get('image')}}" height="250">
                            </div>
                            <br class="pt-2 pb-2">
                            <div class="form-group">
                                <label for="file">Upload Foto</label>
                                <input type="file" name="file" class="form-control-file" id="file">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option selected>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Tanggal Lahir</label>
                                <input id="birthday" name="birthday" type="text" class="form-control" placeholder="{{ Session::get('birthday') }}">
                            </div>
                            <div class="form-group">
                                <label for="ktp">No. KTP</label>
                                <input id="ktp" name="ktp" type="text" class="form-control" placeholder="{{ Session::get('ktp') }}">
                            </div>
                            <div class="form-group">
                                <label for="city">Kota</label>
                                <input id="city" name="city" type="text" class="form-control" placeholder="{{ Session::get('city') }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <input id="address" name="address" type="text" class="form-control" placeholder="{{ Session::get('address') }}">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input id="location" name="location" type="text" class="form-control" placeholder="{{ Session::get('ktp') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">No. HP</label>
                                <input id="phone" name="phone" type="text" class="form-control" placeholder="{{ Session::get('phone') }}">
                            </div>
                            <div class="form-group">
                                <label for="farmName">Farm Name</label>
                                <input id="farmName" name="farmName" type="text" class="form-control" placeholder="{{ Session::get('farmName') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </section>
</main>
@endsection