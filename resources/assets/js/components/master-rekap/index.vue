<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <i class="fa fa-table"></i> Rekap Absen Tabel
      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
    </header>
        <div class="table-responsive">
          <table id="rekapTable" class="table table-striped m-b-none">
            <thead>
              <tr>
                <th width="5%">NIK</th>
                <th width="15%">Nama Karyawan</th>
                <th width="25%">Jumlah Hadir</th>
                <th width="25%">Jumlah Izin</th>
                <th width="10%">Jumlah Sakit</th>
                <th width="10%">Jumlah Alfa</th>
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
         var table = $('#rekapTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "rekap-admin/json",
              columns: [
                  { data: 'nik', name: 'nik' },
                  { data: 'karyawan', name: 'karyawan' },
                  { data: 'jml_hadir', name: 'jml_hadir' },
                  { data: 'jml_izin', name: 'jml_izin' },
                  { data: 'jml_sakit', name: 'jml_sakit' },
                  { data: 'jml_alfa', name: 'jml_alfa' }
              ]
          });
        Echo.channel('draw-table-event')
        .listen('DrawTableEvent', (e) => {
          table.draw();
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
