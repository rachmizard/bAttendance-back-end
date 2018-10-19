@extends('layouts.master-layouts')
@section('content')
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Absen Admin</li>
              </ul>
              <div class="m-b-md">
                <h3 class="m-b-none"><i class="fa fa-bookmark"></i> Absen Panel</h3>
              </div>
              <!-- Create form's component here-->
              <div class="row">
                <div class="col-md-4">
                  <create-absen></create-absen>
                </div>
              <!-- End form's component here-->
              <!-- Create table component here-->
                <div class="col-md-8">
                  <table-absen></table-absen>
                </div>
              <!-- End table component here-->
              <!-- Create datatable component here-->
                <div class="col-md-4">
                  <datatable-absen></datatable-absen>
                </div>
              </div>
              <!-- End datatable component here-->
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@endsection
