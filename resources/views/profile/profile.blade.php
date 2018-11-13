@extends('layouts.master-layouts')
@section('content')
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="/panel"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-user"></i> Profile</li>
              </ul>
              <div class="m-b-md">
                <h3 class="m-b-none"><i class="fa fa-group"></i> Profile {{ Auth::user()->name }}</h3>
              </div>
              <section class="panel panel-default">
                <header class="panel-heading">Profile</header>
                  <div class="panel-body">
                      <form class="form-horizontal" action="profile" method="POST" id="updateForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Upload Foto</label>
                            <div class="col-md-4">
                                <input class="form-control" type="file" autocomplete="off" placeholder="File..." name="image" autofocus="">
                            </div>
                        </div> -->
                          <div class="form-group">
                              <label for="nama" class="col-md-4 control-label">Nama</label>
                              <div class="col-md-4">
                                  <input class="form-control" autocomplete="off" placeholder="Nama..." type="text" name="name" id="nama" value="{{ Auth::user()->name }}" autofocus="">
                                  @if($errors->has('name'))
                                    <span class="label label-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="email" class="col-md-4 control-label">Email</label>
                              <div class="col-md-4">
                                  <input class="form-control" autocomplete="off" placeholder="email..." type="text" name="email" id="email" autofocus="" value="{{ Auth::user()->email }}">
                                  @if($errors->has('email'))
                                    <span class="label label-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="role" class="col-md-4 control-label">Hak Akses</label>
                              <div class="col-md-4">
                                  <input class="form-control" autocomplete="off" type="text" disabled="" value="{{ Auth::user()->role == 'pm' ? 'Project Manager' : 'General Affair' }}" id="role" autofocus="">
                                  @if($errors->has('role'))
                                    <span class="label label-danger">
                                        {{ $errors->first('role') }}
                                    </span>
                                  @endif
                              </div>
                          </div>
                      <div class="form-group">
                          <div class="col-md-4 col-md-offset-4">
                              <button class="btn btn-primary" id="btnSimpankaryawan" type="submit">Update Profile</button>
                          </div>
                      </div>
                  </form>
                  </div>
              </section>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@endsection
