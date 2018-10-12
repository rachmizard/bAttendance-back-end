@extends('layouts.master-layouts')
@section('content')<!-- 
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Karyawan</div>
        <div class="panel-body">
          <transition>
            <router-view></router-view>
          </transition>
        </div>
      </div>
    </div>
  </div>
</div> -->
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="#">Master Data</a></li>
                <li class="active">Jadwal Masuk</li>
              </ul>
              <div class="m-b-md">
                <h3 class="m-b-none"><i class="fa fa-clock-o"></i> Jam</h3>
              </div>
              <!-- Create Form Component -->
              <create-jam></create-jam>
              <!-- End Form Component -->
              <section class="panel panel-default">
                <header class="panel-heading">
                  <i class="fa fa-table"></i> Tabel Jadwal Masuk 
                  <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i> 
                </header>
                <div class="table-responsive">
                  <table class="table table-striped m-b-none" data-ride="datatables">
                    <thead>
                      <tr>
                        <th width="15%">No</th>
                        <th width="25%">Jam Masuk</th>
                        <th width="25%">Jam Keluar</th>
                        <th width="10%">Status</th>
                        <th width="35%">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($jams as $jam)
                      <tr>
                        <td>{{ $jam->id }}</td>
                        <td>{{ $jam->start }}</td>
                        <td>{{ $jam->end }}</td>
                        <td>
                            @if($jam->status == null)
                            <span class="label label-danger">Tidak Aktif</span>
                            @elseif($jam->status != null)
                            <span class="label label-success">Aktif</span>
                            @endif
                        </td>
                        <td>
                          <div class="btn-group">
                            @if($jam->status == null)
                            <form action="{{ route('jam.aktifkan', $jam->id) }}" method="POST" id="jamPost">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="_method" value="PUT">
                                  <button class="btn btn-sm btn-success" title="Aktifkan Jam Masuk"><i class="fa fa-check"></i> Aktifkan Jam Masuk</button>
                                  <a class="btn btn-sm btn-danger" onclick="document.getElementById('jamDelete').submit();"><i class="fa fa-trash-o"></i></a>
                            </form>
                            @elseif($jam->status != null)
                              <form action="{{ route('jam.matikan', $jam->id) }}" method="POST" id="jamOff">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                    <button class="btn btn-sm btn-info" title="Matikan Jam Masuk"><i class="fa fa-power-off"></i></button>
                                    <a class="btn btn-sm btn-danger" onclick="document.getElementById('jamDelete').submit();"><i class="fa fa-trash-o"></i></a>
                              </form>
                            @endif
                              <form action="{{ route('jam.destroy', $jam->id) }}" id="jamDelete" method="POST" style="display: none">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                              </form>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </section>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>

        @push('javascript')
          <script>
            $(document).ready(function(){
              // do here
            });
          </script>
        @endpush
@endsection
