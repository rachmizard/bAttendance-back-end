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
              <!-- Create Form Component -->
              <karyawan-component v-if="$root.drawTable"></karyawan-component>
              <!-- End Form Component -->
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
                        <label for="" class="col-md-4 control-label"></label>
                        <div class="form-group">
                          <div class="col-md-4">
                            <img id="fp" width="100" height="100" alt="">
                          </div>
                        </div>
                        {{-- 
                      <div class="form-group">
                          <label for="nama" class="col-md-4 control-label">Upload Foto</label>
                          <div class="col-md-4">
                              <input class="form-control" type="file" autocomplete="off" placeholder="File..." v-on:change="onImageChange" @change="uploadImage()" autofocus="">
                          </div>
                      </div> --}}
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
                            <label for="nik" class="col-md-4 control-label">Status</label>
                            <div class="col-md-4">
                                <select name="status" class="form-control rounded" id="status">
                                  <option value="authorized">Buka Akses</option>
                                  <option value="unauthorized">Tutup Akses</option>
                                </select>
                                @if($errors->has('status'))
                                  <span class="label label-danger">
                                      {{ $errors->first('status') }}
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


            <div id="uploadModal" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="namaTitle"><i class="fa fa-upload"></i> Upload Karyawan</h4>
                  </div>
                    <form action="karyawan/import" method="post" enctype="multipart/form-data" id="submitUpload">
                      {{ csrf_field() }}
                      <div class="modal-body" style="margin-bottom: 50px;">
                        <div class="form-group">
                          <label class="col-md-2 control-label" for="file_name">File Excel</label>
                          <div class="col-md-10">
                            <input type="file" name="file_name" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <div class="btn-group">
                          <button class="btn btn-md btn-default" data-dismiss="modal">Tutup</button>
                          <button class="btn btn-md btn-info"><i class="fa fa-upload" click="document.getElementById('submitUpload').submit()"></i> Mulai Upload</button>
                        </div>
                      </div>
                    </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <form action="karyawan/exportKaryawan" method="POST" id="submitExport">
              {{ csrf_field() }}
            </form>
        </section>
@endsection
