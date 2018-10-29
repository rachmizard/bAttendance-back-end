<template>
	<section class="panel panel-info" style="margin-bottom: 100px;">
    <header class="panel-heading">
			<router-link :to="{name: 'lisKaryawan'}" class="btn btn-xs btn-default">Kembali</router-link> Detail Absen {{ karyawan.nama }}
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
			<div class="col-md-8">
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
									<td v-if="rekap.hadir == 'hadir'"><span><i class="fa fa-check text-info"></i></span></td>
				  				<td v-else>-</td>
				  				<td v-if="rekap.sakit == 'sakit'"><span><i class="fa fa-check text-warning"></i></span></td>
									<td v-else>-</td>
				  				<td v-if="rekap.izin == 'izin'"><span><i class="fa fa-check text-default"></i></span></td>
									<td v-else>-</td>
				  				<td v-if="rekap.alfa == 'alfa'"><span><i class="fa fa-check text-danger"></i></span></td>
									<td v-else>-</td>
				  				<td v-if="rekap.dinas == 'dinas'"><span><i class="fa fa-check text-info"></i></span></td>
									<td v-else>-</td>
				  				<td>{{ rekap.keterangan }}</td>
							</tr>
		        </tbody>
		      </table>
		    </div>
			</div>
			<div class="col-md-4">
				Keternagan
			</div>
		</div>
  </section>
</template>
<script>
	const todos = [
	  {
	    description: 'Take Noah to basketball practice.',
	    isComplete: false,
	    dates: { weekdays: 6 }, // Every Friday
	    color: '#ff8080',       // Red
	  },
	];
	export default{
		data(){
			return {
				karyawan_id: '',
				nama: '',
				karyawan: {},
				todos,
				attrs: [
			        {
			          key: 'today',
			          highlight: {
			            backgroundColor: '#ff8080',
			            // Other properties are available too, like `height` & `borderRadius`
			          },
			          dates: {
						  weekdays: [1, 7]
						} // On the weekends
			        }
			      ],
			}
		},

		mounted(){
			this.getRekapDetailKaryawan()
			Echo.channel('draw-table-event')
			.listen('DrawTableEvent', (e) => {
				this.getRekapDetailKaryawan()
			});
			console.log(this.karyawan_id);
		},

		methods: {
			getRekapDetailKaryawan(){
		        let app = this;
		        let id = app.$route.params.id;
				app.karyawan_id = id;
				axios.get('rekap-admin/'+ id +'/rekapDetailKaryawan').then(respon => {
					app.karyawan = respon.data;
				})
			}
		}
	}
</script>
