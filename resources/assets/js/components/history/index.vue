<template>
        <section id="content">
          <section class="hbox stretch">
            <!-- <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Submenu Header</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Phasellus at ultricies</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Malesuada augue</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Donec eleifend</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Dapibus porta</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Dacus eu neque</a></li>
              </ul>
            </aside> -->
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      <div class="btn-group">
                        <button @click="refresh()" type="button" class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-sm btn-default" @click="deleteChecked()"><i class="fa fa-trash-o"></i></button>
                      </div>
                    </div>
                    <div class="col-sm-4 m-b-xs">
                      <div :class="['input-group', errors.tgl_history ? 'has-error'  : '']">
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
                            <th width="10"></th>
                            <th width="20">Tanggal</th>
                            <th width="40">Nama Karyawan</th>
                            <th width="20">Jam Masuk</th>
                            <th width="20">Jam Keluar</th>
                            <th width="30">Status</th>
                            <th width="30">Alasan</th>
                          </tr>
                        </thead>
                        <tbody>
                        	<tr v-for="(user, index) in users.data">
                        		<td>
		                          <label>
		                            <input type="checkbox" v-model="checkedRows" :value="user.absen_id">
		                          </label>
                        		</td>
                        		<td>{{ user.created_at }}</td>
                        		<td>{{ user.nama }}</td>
                        		<td>{{ user.checkin }}</td>
                        		<td>{{ user.checkout }}</td>
                        		<td v-if="user.action == 'masuk'"><span class="label label-info">on working</span></td>
                        		<td v-if="user.action == 'keluar'"><i class="fa fa-check text-success"></i></td>
                        		<td v-if="user.action == 'alfa'"><span class="label label-danger">Alfa</span></td>
                        		<td v-if="user.action == 'izin'"><span class="label label-info">Izin</span></i></td>
                        		<td v-if="user.action == 'sakit'"><span class="label label-warning">Sakit</span></td>
                        		<td v-if="user.action == ''"><span class="label label-default">Tidak ada keterangan</span></td>
                        		<td>{{ user.alasan }}</td>
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

	<!-- <div class="table-responsive">
		<router-link :to="{name: 'index'}" class="btn btn-info">
			<i class="fa fa-home"></i> Home
		</router-link>
		<button class="btn btn-success" @click.prevent="refresh()"><i class="fa fa-refresh"></i> Refresh Page</button>
		<hr>

        <ol class="breadcrumb">
            <li><router-link :to="{name: 'index'}" >Home</router-link></li>
            <li class="active" >History Absensi</li>
        </ol>
		<table class="table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Karyawan</th>
					<th>Divisi</th>
					<th>Jam Masuk</th>
					<th>Tanggal</th>
					<th>Telah Masuk</th>
					<th class="text-right">Actions</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for="(user, index) in users.data">
					<td>{{ user.id }}</td>
					<td>{{ user.nama }} </td>
					<td>{{ user.divisi }} </td>
					<td>{{ user.jam }} </td>
					<td>{{ user.created_at }} </td>
					<td class="text-right">
						<div class="btn btn-group">
							<button class="btn btn-danger text-danger" @click.prevent="deleteHistory(user.id)"><i class="fa fa-trash"></i></button>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<ul class="pagination">
			<li v-if="users.prev_page_url">
				<a @click.prevent="paginate(users.links.prev)" :href="users.prev_page_url">&laquo; Previous</a>
			</li>
			<li v-if="users.next_page_url">
				<a @click.prevent="paginate(users.links.next)" :href="users.next_page_url">Next &raquo;</a>
			</li>
		</ul>
	</div> -->
</template>

<script>
	import pagination from 'laravel-vue-pagination'
	export default {
		data() {
			return {
				errors: [],
				checkedRows: [],
				users: {},
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
		},
		methods: {
			paginate(page = 1) {
				axios.get('history?page=' + page).then(response => {
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
				axios.get('history').then(respon => {
					this.users = respon.data
					this.current_page = respon.data.meta.current_page
					this.from = respon.data.meta.from
					this.last_page = respon.data.meta.last_page
					this.per_page = respon.data.meta.per_page
					this.to = respon.data.meta.to
					this.total = respon.data.meta.total
				});
			},

			refresh(){
			 	axios.get('history').then(respon => {
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
