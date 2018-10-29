<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <i class="fa fa-table"></i> Karyawan
      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
    </header>
        <div class="table-responsive">
          <table class="table table-striped m-b-none">
            <thead>
              <tr>
                <th width="25%">NIK</th>
                <th width="25%">Nama Karyawan</th>
                <th width="25%">Aksi</th>
              </tr>
            </thead>
            <tbody>
				<tr v-for="(karyawan, index) in karyawans.data">
					<td>{{ karyawan.nik }}</td>
					<td>{{ karyawan.nama }}</td>
					<td><router-link :to="{name: 'rekapKaryawan', params: { id: karyawan.id }}" class="btn btn-warning btn-sm">Rekap</router-link></td>
				</tr>
            </tbody>
          </table>
        </div>
  </section>
</template>
<script>
	export default{
		data(){
			return {
			 	karyawans: {}
			}
		},

		mounted(){
		  this.getKaryawan()
		},

		methods: {
			getKaryawan(){
				axios.get('karyawan/paginate').then(respon => {
					this.karyawans = respon.data
				})
			}
		}
	}
</script>
