<template>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Karyawan</th>
					<th>Divisi</th>
					<th>Jam Masuk</th>
					<th class="text-right">Actions</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for="(user, index) in users.data">
					<td>{{ user.id }}</td>
					<td>{{ user.nama }} </td>
					<td>{{ user.divisi }} </td>
					<td>{{ user.jam }} </td>
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
				<a @click.prevent="paginate(users.prev_page_url)" :href="users.prev_page_url">&laquo; Previous</a>
			</li>
			<li v-if="users.next_page_url">
				<a @click.prevent="paginate(users.next_page_url)" :href="users.next_page_url">Next &raquo;</a>
			</li>
		</ul>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				users: [],
				alertShow: false
			}
		},
		mounted() {
			this.fetch();
		},
		methods: {
			paginate(url) {
				axios.get(url).then(response => {
					this.users = response.data;
				})
			},

			fetch(){
				axios.get('history').then(respon => {
					setInterval(() => {
						this.users = respon.data;
					}, 1000);
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
			}
		}
	}
</script>
