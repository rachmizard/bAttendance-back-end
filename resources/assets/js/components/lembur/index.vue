<template>
    <section id="content">
      <section class="hbox stretch">
        <aside>
          <section class="vbox">
            <header class="header bg-white b-b clearfix">
              <div class="row m-t-sm">
                <div class="col-sm-8 m-b-xs">
                  <div class="btn-group">
                    <button @click="refresh()" type="button" class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></button>
                    <!-- <button class="btn btn-sm btn-default" @click="deleteChecked()"><i class="fa fa-trash-o"></i></button> -->
                  </div>
                </div>
                <div class="col-md-4 m-b-xs">
                  <div :class="['form-group', errors.tgl_history ? 'has-error'  : '']">
                    <input type="date" @change="filterHistory()" class="form-control input-sm" placeholder="Filter by date" v-model="filter.tgl_history">
                  </div>
                </div>
              </div>
            </header>
            <section class="scrollable wrapper w-f">
              <section class="panel panel-default">
                <div class="table-responsive">
                  <table class="table table-striped m-b-none">
                    <thead>
                      <tr>
                        <th width="20">NIK</th>
                        <th width="40">Nama Karyawan</th>
                        <th width="20">Durasi Lembur</th>
                        <th width="20">Keterangan Lembur</th>
                        <th width="20">Status</th>
                        <th width="20">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<tr v-for="(user, index) in users.data">
                    		<!-- <td>
	                          <label>
	                            <input type="checkbox" v-model="checkedRows" :value="user.absen_id">
	                          </label>
                    		</td> -->
                    		<td>{{ user.karyawan.nik }}</td>
                    		<td>{{ user.karyawan.nama }}</td>
                    		<td>{{ user.durasi }}</td>
                    		<td>{{ user.alasan }}</td>
                    		<td v-if="user.status == 'false'"><span class="label label-default">Belum di Approve</span></td>
                    		<td v-else-if="user.status == 'true'"><i class="fa fa-check text-success"></i></td>
                    		<td v-else><span class="label label-success">Belum Lembur</span></td>
                    		<td>
                    			<a v-if="user.status == 'false' " @click="approveLembur(user.id)" class="btn btn-sm btn-success" title="Approve Lemburan"><i class="fa fa-check"></i> Approve Lembur</a>
                    			<a v-if="user.status == 'false' " @click="hapusLembur(user.id)" class="btn btn-sm btn-danger" title="Hapus Lemburan"><i class="fa fa-trash-o"></i></a>
                    			<a v-else-if="user.status == 'true' " @click="batalLembur(user.id)" class="btn btn-sm btn-danger"><i class="fa fa-check"></i> Batal Approve</a>
                    			<a v-else @click="approveLembur(user.id)" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Approve Lembur</a>
                    		</td>
                    	</tr>
                    </tbody>
                  </table>
                </div>
              </section>
            </section>
            <footer class="footer bg-white b-t">
              <div class="row text-center-xs">
                <div class="col-md-6 hidden-sm">
                  <p class="text-muted m-t">Current Page <span class="label label-info">{{ current_page }}</span> of {{ total }}</p>
                </div>
                <div class="col-md-6 col-sm-12 text-right text-center-xs">
                  <!-- ul class="pagination pagination-sm m-t-sm m-b-none">
                    <li v-if="users.prev_page_url">
						<a @click.prevent="paginate(users.prev_page_url)" :href="users.prev_page_url">&laquo; Previous</a>
					</li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
					<li v-if="users.next_page_url">
						<a @click.prevent="paginate(users.next_page_url)" :href="users.next_page_url">Next &raquo;</a>
					</li>
                  </ul> -->
                  <pagination class="pagination pagination-sm m-t-sm m-b-none" :data="users" @pagination-change-page="paginate">
					<span slot="prev-nav"><i class="fa fa-chevron-left"></i></span>
					<span slot="next-nav"><i class="fa fa-chevron-right"></i></span>
                  </pagination>
                </div>
              </div>
            </footer>
          </section>
        </aside>
      </section>
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
</template>

<script>
	import pagination from 'laravel-vue-pagination'
	export default {
		data() {
			return {
				errors: [],
				checkedRows: [],
				users: {},
				id_lembur: '',
				filter: {
					tgl_history: ''
				},
				current_page: '',
				from: '',
				last_page: '',
				per_page: '',
				to: '',
				total: '',
				alertShow: false,
	            message : '',
	            messageError: '',
			}
		},
		mounted() {
			axios.get('master-filter/getFilterHistory').then(respon => {
				this.filter.tgl_history = respon.data.tgl_history
			})
			this.fetch();
			// setInterval(() => {
			// 	this.realtime()
			// }, 15000)
		},
		methods: {
			paginate(page = 1) {
				axios.get('lembur/karyawan?page=' + page).then(response => {
					this.users = response.data;
					this.current_page = response.data.meta.current_page
					this.from = response.data.meta.from
					this.last_page = response.data.meta.last_page
					this.per_page = response.data.meta.per_page
					this.to = response.data.meta.to
					this.total = response.data.meta.total
				})
			},

			fetch(){
				axios.get('lembur/karyawan').then(respon => {
					this.users = respon.data
					this.current_page = respon.data.meta.current_page
					this.from = respon.data.meta.from
					this.last_page = respon.data.meta.last_page
					this.per_page = respon.data.meta.per_page
					this.to = respon.data.meta.to
					this.total = respon.data.meta.total
				})
			},

			realtime(){
			 	axios.get('lembur/karyawan').then(respon => {
					this.users = respon.data;
				});
			 },

			refresh(){
			 	axios.get('lembur/karyawan').then(respon => {
					this.users = respon.data;
				});
				this.$root.loading = true;
				 setInterval(() => {
					this.$root.loading = false
				 }, 2000)
			},

			filterHistory(){
				var app = this;
				var filterDate = app.filter;
				axios.post('master-filter/getFilterHistory', filterDate).then(respon => {
					this.refresh()
				}).catch((error) => {
	                 this.errors = error.response.data.errors;
	                 this.message = false;
	            });
			},

			approveLembur(id){
				axios.put('lembur/'+ id +'/approveLembur').then(respon => {
					this.refresh();
				});
			},

			batalLembur(id){
				axios.put('lembur/'+ id +'/batalLembur').then(respon => {
					this.refresh();
				});
			},

			hapusLembur(id){
				axios.delete('lembur/'+ id +'/hapusLembur').then(respon => {
					this.refresh();
				});
			},

			deleteHistory(id){
				var app = this;
				if (confirm('Anda Yakin?')) {
					axios.delete('history/'+ id +'/delete').then(function(resp){
                		app.fetch(); // redirect to url "/"
					})
				}
			},

			deleteChecked() {
				if (this.checkedRows.length == 0) {
					alert('Silahkan ceklik karyawan yang ingn di hapus!');
				}else{
					if (confirm('Anda yakin untuk menghapus data yang di ceklis?')) {
						axios.post('history/deleteChecked', { checkedId: this.checkedRows })
						.then(respon => {
							this.refresh()
						})
					}
				}
			}
		}
	}
</script>
