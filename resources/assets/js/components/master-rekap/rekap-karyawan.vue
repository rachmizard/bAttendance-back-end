<template>
	<div class="row">
		<router-link :to="{name: 'lisKaryawan'}" class="btn btn-sm btn-info">Kembali</router-link>
		<h1>{{ karyawan_id }}</h1>
		  <!-- <v-calendar :attributes='attrs'>
		  </v-calendar> -->
		  <div class="table-responsive">
		  	<table class="table table-bordered table-hovered">
		  		<thead>
		  			<tr>
			  			<th>Tanggal</th>
			  			<th>Hadir</th>
			  			<th>Sakit</th>
			  			<th>Izin</th>
			  			<th>Alfa</th>
			  			<th>Dinas</th>
			  			<th>Keterangan</th>
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<tr v-for="(rekap, index) in karyawan.data">
		  				<td>{{ rekap.tanggal }}</td>
		  				<td>{{ rekap.hadir }}</td>
		  				<td>{{ rekap.sakit }}</td>
		  				<td>{{ rekap.izin }}</td>
		  				<td>{{ rekap.alfa }}</td>
		  				<td>{{ rekap.dinas }}</td>
		  				<td>{{ rekap.keterangan }}</td>
		  			</tr>
		  		</tbody>
		  	</table>
		  </div>
	</div>
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
