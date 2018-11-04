<template>
	<section class="panel panel-info" style="margin-bottom: 100px;">
    <header class="panel-heading">
			<router-link :to="{name: 'lisKaryawan'}" class="btn btn-xs btn-default">Kembali</router-link> Detail Absen
    </header>
		<div class="row wrapper">
			<div class="col-md-12">
				<div class="text-center">
					<img src="/images/avatar_default.jpg" class="img-circle">
					<p>{{ jumlah.data.karyawan.nik }}</p>
					<p>{{ jumlah.data.karyawan.nama }}</p>
					<p>{{ jumlah.data.karyawan.jabatan }} - {{ jumlah.data.karyawan.divisi }}</p>
				</div>
			</div>
		</div>
		<div class="row wrapper">
			<div class="col-md-9">
			    <div class="table-responsive">
			      <table class="table table-bordered table-striped b-t b-light">
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
			<div class="col-md-3">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="50%">Hadir</th>
								<th width="50%"><span class="label label-info label-sm">{{ jumlah.data.jml_hadir }}</span></th>
							</tr>
							<tr>
								<th width="50%">Izin</th>
								<th width="50%"><span class="label label-default label-sm">{{ jumlah.data.jml_izin }}</span></th>
							</tr>
							<tr>
								<th width="50%">Sakit</th>
								<th width="50%"><span class="label label-warning label-sm">{{ jumlah.data.jml_sakit }}</span></th>
							</tr>
							<tr>
								<th width="50%">Alfa</th>
								<th width="50%"><span class="label label-danger label-sm">{{ jumlah.data.jml_alfa }}</span></th>
							</tr>
							<tr>
								<th width="50%">Dinas</th>
								<th width="50%"><span class="label label-info label-sm">{{ jumlah.data.jml_dinas }}</span></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
  </section>
</template>
<script>
	export default{
		data(){
			return {
				karyawan_id: '',
				nama: '',
				karyawan: {},
				jumlah: []
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
					this.getJumlahAbsenOfKaryawan();
				})
			},

			getJumlahAbsenOfKaryawan(){
        let app = this;
        let id = app.$route.params.id;
				axios.get('rekap-admin/'+ id +'/detail').then(function(resp) {
					app.jumlah = resp.data;
				})
			}
		}
	}
</script>
