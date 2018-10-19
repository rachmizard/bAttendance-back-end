<template>
  <section class="panel panel-default">
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
            <th width="20">Tanggal</th>
            <th width="30"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in users.data">
            <td>
              <label>
                <input type="checkbox" v-model="checkedRows" :value="user.id">
              </label>
            </td>
            <td>{{ user.nama }}</td>
            <td>{{ user.jam }}</td>
            <td>{{ user.created_at }}</td>
            <td v-if="user.action == 'masuk'"><i class="fa fa-check text-success"></i></td>
            <td v-if="user.action == 'alfa'"><span class="label label-danger">Alfa</span></td>
            <td v-if="user.action == 'izin'"><span class="label label-info">Izin</span></i></td>
            <td v-if="user.action == 'sakit'"><span class="label label-warning">Sakit</span></td>
            <td v-if="user.action == ''"><span class="label label-default">Tidak ada keterangan</span></td>
          </tr>
          <tr v-if="total.length == null">
            <td class="text-center" colspan="8">Belum ada data.</td>
          </tr>
        </tbody>
      </table>
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
				checkedRows: [],
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
				this.$root.loading = true;
				 setInterval(() => {
					this.$root.loading = false
				 }, 2000)
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
				if (this.checkedRows.length == null) {
					alert('Silahkan ceklik karyawan yang ingn di hapus!');
				}else{
					if (confirm('Anda yakin untuk menghapus data yang di ceklis?')) {
						axios.post('absen-admin/destroyChecked', { checkedId: this.checkedRows })
						.then(respon => {
							this.paginate()
						})
					}
				}
			}
		}
	}
</script>
