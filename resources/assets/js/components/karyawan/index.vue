<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <i class="fa fa-table"></i> Tabel Karyawan 
      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i> 
    </header>
        <div class="table-responsive">
          <table id="karyawanTable" class="table table-striped m-b-none">
            <thead>
              <tr>
                <th width="5%">ID</th>
                <th width="15%">Nik</th>
                <th width="25%">Nama Lengkap</th>
                <th width="25%">Divisi</th>
                <th width="10%">Jenis Kelamin</th>
                <th width="10%">Status</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
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
                        { data: 'divisi', name: 'divisi' },
                        { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                        { data: 'status', name: 'status' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ]
                });
              Echo.channel('draw-table-event')
              .listen('DrawTableEvent', (e) => {
                table.draw();
              });
            });
            $(document).ready(function(){
              $('#editKaryawanModal').on('show.bs.modal', function(e) {
                      var id = $(e.relatedTarget).data('id');
                      $.get('karyawan/' + id + '/edit', function( data ) {
                        $("#namaTitle").attr('value', data.nama);
                        $("#nama").attr('value', data.nama);
                        $("#divisi").attr('value', data.divisi);
                        $("#jenis_kelamin").attr('value', data.jenis_kelamin);
                        $("#nik").attr('value', data.nik);
                        $("#status").attr('value', data.status);
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
				alertShow: false,
			}
		},
		mounted() {
			axios.get('karyawan/paginate').then(response => {
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
				axios.get('karyawan/paginate').then(respon => {
					this.users = respon.data;
				});		
			},

			deleteKaryawan(id){
				var app = this;
				if (confirm('Anda Yakin?')) {	
					axios.delete('karyawan/'+ id +'/delete').then(function(resp){
                		app.$router.replace('/karyawan'); // redirect to url "/"
                		app.fetch(); // redirect to url "/"
					})	
				}
			}
		}
	}
</script>
