@extends('layouts.master-layouts')
@section('content')
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Rekap Absen</li>
              </ul>
              <div class="m-b-md">
                <h3 class="m-b-none"><i class="fa fa-group"></i> Rekap Absensi Karyawan</h3>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <!-- Create Form Component -->
                  <tgl-aktif-rekap></tgl-aktif-rekap>
                  <!-- End Form Component -->
                </div>
                <div class="col-md-12">
                </div>
                <div class="col-md-12">
                  <!-- Create Form Component -->
                  <rekap-absen></rekap-absen>
                  <!-- End Form Component -->
                </div>
                <div class="col-md-12">
                  <!-- Create Form Component -->
                  <transition name="fade">
                    <router-view>
                    </router-view>
                  </transition>
                  <!-- End Form Component -->
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@endsection
