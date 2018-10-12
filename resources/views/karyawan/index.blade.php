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
                <li class="active">Karyawan</li>
              </ul>
              <div class="m-b-md">
                <h3 class="m-b-none"><i class="fa fa-group"></i> Karyawan</h3>
              </div>
              <!-- Create Form Component -->
              <create-karyawan></create-karyawan>
              <!-- End Form Component -->
              <section class="panel panel-default">
                <header class="panel-heading">
                  <i class="fa fa-table"></i> Tabel Karyawan 
                  <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i> 
                </header>
                <div class="table-responsive">
                  <table class="table table-striped m-b-none" data-ride="datatables">
                    <thead>
                      <tr>
                        <th width="15%">Nik</th>
                        <th width="25%">Nama Lengkap</th>
                        <th width="25%">Divisi</th>
                        <th width="10%">Jenis Kelamin</th>
                        <th width="10%">Status</th>
                        <th width="25%">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($karyawans as $karyawan)
                      <tr>
                        <td>{{ $karyawan->nik }}</td>
                        <td>{{ $karyawan->nama }}</td>
                        <td>{{ $karyawan->divisi }}</td>
                        <td>{{ $karyawan->jenis_kelamin }}</td>
                        <td>
                          @if($karyawan->status == 'unauthorized')
                            <span class="label label-danger">{{ $karyawan->status}}</span>
                          @else
                            <span class="label label-success">{{ $karyawan->status}}</span>
                          @endif
                        </td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-info" data-target="#editKaryawanModal" data-toggle="modal" data-id="{{ $karyawan->id }}" data-nik="{{ $karyawan->nik }}" data-nama="{{ $karyawan->nama }}" data-divisi="{{ $karyawan->divisi }}" data-jenis_kelamin="{{ $karyawan->jenis_kelamin }}" data-status="{{ $karyawan->status }}"><i class="fa fa-pencil"></i></button>
                            <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
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
          <div id="editKaryawanModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="namaTitle"></h4>
                </div>
                <div class="modal-body"> 
                    <form class="form-horizontal" method="POST" id="updateForm"> 
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="nama" class="col-md-4 control-label">Nama</label>
                            <div class="col-md-4">
                                <input class="form-control" autocomplete="off" placeholder="Nama..." type="text" name="nama" id="nama" autofocus="">
                                @if($errors->has('nama'))
                                  <span class="label label-danger">
                                      {{ $errors->first('nama') }}
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="divisi" class="col-md-4 control-label">Divisi</label>
                            <div class="col-md-4">
                                <input class="form-control" autocomplete="off" placeholder="Divisi..." type="text" name="divisi" id="divisi" autofocus="">
                                @if($errors->has('divisi'))
                                  <span class="label label-danger">
                                      {{ $errors->first('divisi') }}
                                  </span>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="jenis_kelamin" class="col-md-4 control-label">Jenis Kelamin</label>
                            <div class="col-md-4">
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control rounded"> 
                                        <option value="L" >Laki Laki</option>
                                        <option value="P"  >Perempuan</option>
                                </select>
                                @if($errors->has('jenis_kelamin'))
                                  <span class="label label-danger">
                                      {{ $errors->first('jenis_kelamin') }}
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="col-md-4 control-label">NIK</label>
                            <div class="col-md-4">
                                <input class="form-control" autocomplete="off" name="nik" placeholder="Nik..." type="text" id="nik" autofocus="">

                                @if($errors->has('nik'))
                                  <span class="label label-danger">
                                      {{ $errors->first('nik') }}
                                  </span>
                                @endif
                            </div>
                        </div> 
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                            <button class="btn btn-primary" id="btnSimpankaryawan" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </section>

        @push('javascript')
          <script>
            $(document).ready(function(){
              $('#editKaryawanModal').on('show.bs.modal', function(e) {
                      var id = $(e.relatedTarget).data('id');
                      $.get('karyawan/' + id + '/edit', function( data ) {
                        $("#namaTitle").attr('value', data.nama);
                        $("#nama").attr('value', data.nama);
                        $("#divisi").attr('value', data.divisi);
                        $("#jenis_kelamin").attr('value', data.jenis_kelamin);
                        $("#nik").attr('value', data.nik);
                        // document.getElementById('nama').setAttribute('value', data.nama);
                        // document.getElementById('divisi').setAttribute('value', data.divisi);
                        // document.getElementById('jenis_kelamin').setAttribute('value', data.jenis_kelamin);
                        // document.getElementById('nik').setAttribute('value', data.nik);
                      });
                $("#updateForm").attr('action', 'karyawan/'+ id +'/update');
              });
            });
          </script>
        @endpush
@endsection
