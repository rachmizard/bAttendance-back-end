<template>
	<section class="panel panel-info" style="margin-bottom: 100px;">
    <header class="panel-heading">
			<router-link :to="{name: 'lisKaryawan'}" class="btn btn-xs btn-default">Kembali</router-link> Detail Absen
    </header>
		<div class="row wrapper">
			<div class="col-md-12">
				<div class="text-center">
					<img :src="jumlah.data.karyawan.fp" class="img-circle">
					<p>{{ jumlah.data.karyawan.nik }}</p>
					<p>{{ jumlah.data.karyawan.nama }}</p>
					<p>{{ jumlah.data.karyawan.jabatan }} - {{ jumlah.data.karyawan.divisi }}</p>
				</div>
			</div>
		</div>
		<div class="row wrapper">
			<div class="col-md-9">
				<form action="/rekap-admin/export/detail" method="POST">
					<input type="hidden" name="_token" :value="csrf_token">
					<input type="hidden" name="start_date" :value="start_date">
					<input type="hidden" name="end_date" :value="end_date">
					<input type="hidden" name="karyawan_id" :value="karyawan_id">
					<button class="btn btn-sm btn-primary"><i class="fa fa-file"></i> Export Hasil Rekapan</button>
				</form>
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
							<td v-if="rekap.hadir == 'masuk'"><span><i class="fa fa-check text-success"></i></span></td>
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
								<th width="50%" colspan="9" class="text-center">Keterangan Lanjut</th>
							</tr>
							<tr>
								<th width="50%" class="text-success">Hadir</th>
								<th width="50%"><span class="label label-success label-sm">{{ jumlah.data.jml_hadir }}</span></th>
							</tr>
							<tr>
								<th width="50%" class="text-default">Izin</th>
								<th width="50%"><span class="label label-default label-sm">{{ jumlah.data.jml_izin }}</span></th>
							</tr>
							<tr>
								<th width="50%" class="text-warning">Sakit</th>
								<th width="50%"><span class="label label-warning label-sm">{{ jumlah.data.jml_sakit }}</span></th>
							</tr>
							<tr>
								<th width="50%" class="text-danger">Alfa</th>
								<th width="50%"><span class="label label-danger label-sm">{{ jumlah.data.jml_alfa }}</span></th>
							</tr>
							<tr>
								<th width="50%" class="text-info">Dinas</th>
								<th width="50%"><span class="label label-info label-sm">{{ jumlah.data.jml_dinas }}</span></th>
							</tr>
							<tr>
								<th width="50%" colspan="9" class="text-center">Potensi Absen</th>
							</tr>
							<tr>
								<th width="50%">Total Lembur</th>
								<th width="50%">{{ jumlah.data.lembur_total }}</th>
							</tr>
							<tr>
								<th width="50%">Total Jam Lembur</th>
								<th width="50%">{{ jumlah.data.total_lembur }}</th>
							</tr>
							<tr>
								<th width="50%">Total Jam Kerja</th>
								<th width="50%">{{ jumlah.data.total_jam_kerja_sebulan }}</th>
							</tr>
							<tr>
								<th width="50%">Total Telat</th>
								<th width="50%">{{ jumlah.data.total_telat }}</th>
							</tr>
							<tr>
								<th width="50%">Total Jam Telat</th>
								<th width="50%">{{ jumlah.data.total_jam_telat_sebulan }}</th>
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
				csrf_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
				karyawan_id: '',
				start_date: '',
				end_date: '',
				nama: '',
				karyawan: {},
				jumlah: []
			}
		},

		mounted(){
			this.getTanggalAktifRekap();
			this.getRekapDetailKaryawan();
			Echo.channel('draw-table-event')
			.listen('DrawTableEvent', (e) => {
				this.getRekapDetailKaryawan()
				this.getTanggalAktifRekap();
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

			getTanggalAktifRekap(){
				axios.get('rekap-admin/selectMasterRekap').then(respon => {
					this.start_date = respon.data.start;
					this.end_date = respon.data.end;
				});
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
