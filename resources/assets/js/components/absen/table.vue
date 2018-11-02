<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <i class="fa fa-filter"></i> Filter Absen {{ previewFilter }}
      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
      <div :class="['form-group', errors.tgl_history ? 'has-error'  : '']">
        <input type="date" @change="filterHistory()" class="form-control input-sm" placeholder="Filter by date" v-model="filter.tgl_history">
      </div>
    </header>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-striped m-b-none">
          <thead>
            <tr>
              <th width="10">
                <button class="btn btn-xs btn-default" @click="deleteChecked()"><i class="fa fa-trash-o"></i></button>
                <button class="btn btn-xs btn-default" @click="paginate()"><i class="fa fa-refresh"></i></button>
              </th>
              <th width="40">Nama Karyawan</th>
              <th width="20">Jam Masuk</th>
              <th width="20">Jam Keluar</th>
              <th width="20">Tanggal</th>
              <th width="30">Status</th>
              <th width="30">Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users.data">
              <td>
                <label>
                  <input type="checkbox" v-model="checkedRows" :value="user.absen_id">
                </label>
              </td>
              <td>{{ user.nama }}</td>
              <td>{{ user.checkin }}</td>
              <td>{{ user.checkout }}</td>
              <td>{{ user.created_at }}</td>
          		<!-- <td v-if="user.action == 'masuk'"><span class="label label-info">on working</span></td> -->
          		<td v-if="user.action == 'masuk'"><span class="label label-success">Masuk</span></td>
              <td v-else-if="user.action == 'alfa'"><span class="label label-danger">Alfa</span></td>
              <td v-else-if="user.action == 'izin'"><span class="label label-default">Izin</span></i></td>
              <td v-else-if="user.action == 'sakit'"><span class="label label-warning">Sakit</span></td>
              <td v-else-if="user.action == 'dinas'"><span class="label label-info">Dinas</span></td>
              <td v-else="user.action == ''"><span class="label label-default">Belum absen</span></td>
              <td>{{ user.alasan }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
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
</template>

<script>
	import pagination from 'laravel-vue-pagination'
	export default {
		data() {
			return {
        errors: [],
				checkedRows: [],
        filter: {
          tgl_history: ''
        },
        previewFilter : '',
				users: {},
				current_page: '',
				from: '',
				last_page: '',
				per_page: '',
				to: '',
				total: '',
				alertShow: false
			}
		},
		mounted() {
      this.getFilterHistory();
			this.fetch();
      Echo.channel('draw-table-event')
      .listen('DrawTableEvent', (e) => {
        this.paginate();
      });
		},
		methods: {
			paginate(page = this.current_page) {
				axios.get('history?page=' + page).then(response => {
					this.users = response.data;
					this.current_page = response.data.meta.current_page
					this.from = response.data.meta.from
					this.last_page = response.data.meta.last_page
					this.per_page = response.data.meta.per_page
					this.to = response.data.meta.to
					this.total = response.data.meta.total
				})
				this.$root.loading = true;
				 setInterval(() => {
					this.$root.loading = false
				 }, 2000)
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
        this.getFilterHistory()
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

      getFilterHistory(){
        let currentHistory = this;
        axios.get('master-filter/getFilterHistory').then(respon => {
            currentHistory.filter.tgl_history = respon.data.tgl_history;
            currentHistory.previewFilter = respon.data.previewFilter;
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
							this.paginate()
						})
					}
				}
			}
		}
	}
</script>
