<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <i class="fa fa-table"></i> Tabel Karyawan
      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
      <a href="#" onclick="document.getElementById('submitExport').submit()" class="btn btn-sm btn-info"><i class="fa fa-download"></i> Export</a>
      <a data-target="#uploadModal" data-toggle="modal" class="btn btn-sm btn-info"><i class="fa fa-upload"></i> Import</a>
    </header>
        <div class="table-responsive">
          <table id="karyawanTable" class="table table-striped m-b-none">
            <thead>
              <tr>
                <th width="5%">ID</th>
                <th width="15%">Nik</th>
                <th width="25%">Nama Lengkap</th>
                <th width="25%">Jabatan</th>
                <th width="25%">Divisi</th>
                <th width="10%">Jenis Kelamin</th>
                <th width="10%">Status</th>
                <th width="10%">Foto</th>
                <th width="10%">Tanggal Join</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="namaTitle"></h4>
              </div>
              <div class="modal-body">
                  <span>Anda yakin akan menghapus karyawan? <span id="namaKaryawan"></span></span>
              </div>
              <div class="modal-footer">
                <div class="btn-group">
                  <button class="btn btn-md btn-info" data-dismiss="modal">Cancel</button>
                  <button class="btn btn-md btn-default" id="deleteBtn"><i class="fa fa-trash-o"></i> Ok</button>
                </div>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
  </section>
</template>

<script>
	import JQuery from 'jquery'

   $(function() {
         var table = $('#karyawanTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "karyawan/json",
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'nik', name: 'nik' },
                  { data: 'nama', name: 'nama' },
                  { data: 'jabatan', name: 'jabatan' },
                  { data: 'divisi', name: 'divisi' },
                  { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                  { data: 'status', name: 'status' },
                  { data: 'fp', name: 'fp' },
                  { data: 'created_at', name: 'created_at' },
                  { data: 'action', name: 'action', orderable: false, searchable: false },
              ]
          });
        Echo.channel('draw-table-event')
        .listen('DrawTableEvent', (e) => {
          table.draw();
        });

        $('#deleteModal').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $.get('karyawan/' + id + '/edit', function( data ) {
                  $("#namaKaryawan").attr('value', data.nama);
                    this.id_karyawan = data.id
                });
          $("#deleteBtn").on('click', function(){
              axios.post('karyawan/'+ id +'/delete').then(function(resp){
                $('#deleteModal').modal('hide')
                table.draw()
              }).then(function(){
                window.location.reload()
              })
          });
        });
      });
      $(document).ready(function(){
        $('#editKaryawanModal').on('show.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('id');
                $.get('karyawan/' + id + '/edit', function( data ) {
                  $("#namaTitle").attr('value', data.nama);
                  $("#nama").attr('value', data.nama);
                  $("#jabatan").attr('value', data.jabatan);
                  $("#divisi").attr('value', data.divisi);
                  $("#jenis_kelamin").attr('value', data.jenis_kelamin);
                  $("#nik").attr('value', data.nik);
                  $("#status").attr('value', data.status);
                  if (data.fp == null) {
                    $("#fp").attr('src', '/storage/images/default.png');
                  }else{
                    $("#fp").attr('src', '/storage/images/' + data.fp);
                  }
                  // document.getElementById('nama').setAttribute('value', data.nama);
                  // document.getElementById('divisi').setAttribute('value', data.divisi);
                  // document.getElementById('jenis_kelamin').setAttribute('value', data.jenis_kelamin);
                  // document.getElementById('nik').setAttribute('value', data.nik);
                });
          $("#updateForm").attr('action', 'karyawan/'+ id +'/update');
        });
      });
	export default {
        props: ['title'],


		data() {
			return {
				users: [],
        id_karyawan: null,
				alertShow: false,
			}
		},
		mounted() {
			axios.get('karyawan/json').then(response => {
				this.users = response.data;
				this.alertShow = true;
			});
		},
		methods: {
			paginate(url) {
				axios.get(url).then(response => {
					this.users = response.data;
				})
			},

			fetch(){
				axios.get('karyawan/json').then(respon => {
					this.users = respon.data;
				});
			},

			deleteKaryawan(id){
				var app = this;
				if (confirm('Anda Yakin?')) {
					axios.delete('karyawan/'+ id +'/delete').then(function(resp){
                		app.fetch(); // redirect to url "/"
					})
				}
			}
		}
	}
</script>
