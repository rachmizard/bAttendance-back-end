<template>
	<section class="panel panel-info" style="margin-bottom: 100px;">
    <header class="panel-heading">
			<router-link :to="{name: 'lisKaryawan'}" class="btn btn-xs btn-default">Kembali</router-link> Detail Absen
    </header>
    <div class="row wrapper">
      <div class="col-sm-12">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
		<div class="row">
			<div class="col-md-12">
			    <div class="table-responsive">
			      <table class="table table-striped b-t b-light">
			        <thead>
			          <tr>
			  			<th width="10%">Tanggal</th>
			  			<th width="10%">Hadir</th>
			  			<th width="10%">Sakit</th>
			  			<th width="10%">Izin</th>
			  			<th width="10%">Alfa</th>
			  			<th width="10%">Dinas</th>
			  			<th width="50%">Keterangan</th>
			          </tr>
			        </thead>
			        <tbody>
						<tr v-if="karyawan.data.length == 0">
							<td colspan="8" class="text-center">Data absen masih kosong!</td>
						</tr>
						<tr v-else v-for="(rekap, index) in karyawan.data">
			  				<td>{{ rekap.tanggal }}</td>
							<td v-if="rekap.hadir == 'masuk'"><span><i class="fa fa-check text-info"></i></span></td>
			  				<td v-else>-</td>
			  				<td v-if="rekap.sakit == 'sakit'"><span><i class="fa fa-check text-warning"></i></span></td>
							<td v-else>-</td>
			  				<td v-if="rekap.izin == 'izin'"><span><i class="fa fa-check text-default"></i></span></td>
							<td v-else>-</td>
			  				<td v-if="rekap.alfa == 'alfa'"><span><i class="fa fa-check text-danger"></i></span></td>
							<td v-else>-</td>
			  				<td v-if="rekap.dinas == 'dinas'"><span><i class="fa fa-check text-info"></i></span></td>
							<td v-else>-</td>
			  				<td v-if="rekap.alasan != ''">{{ rekap.keterangan }}</td>
			  				<td v-if="rekap.alasan === ''">-</td>
						</tr>
			        </tbody>
			      </table>
			    </div>
			</div>
		</div>
  </section>
</template>
<script>
	export default{
		props: ['nama'], 
		data(){
			return {
				karyawan_id: '',
				nama: '',
				karyawan: {},
			}
		},

		mounted(){
			this.getRekapDetailKaryawan()
			Echo.channel('draw-table-event')
			.listen('DrawTableEvent', (e) => {
				this.getRekapDetailKaryawan()
			});
		},

		methods: {
			getRekapDetailKaryawan(){
		        var app = this;
		        var id = app.$route.params.id;
				app.karyawan_id = id;
				axios.get('rekap-admin/'+ id +'/rekapDetailKaryawan').then(respon => {
					app.karyawan = respon.data;
					app.nama = respon.data.nama;
				})
			}
		}
	}
</script>
