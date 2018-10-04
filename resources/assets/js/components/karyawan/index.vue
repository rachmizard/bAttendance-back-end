<template>
	<div class="table-responsive">
		<router-link :to="{name: 'index'}" class="btn btn-info">
			<i class="fa fa-home"></i> Home
		</router-link>

		<router-link to="create" class="btn btn-primary">
			Create new karyawan
		</router-link>

		<hr>

        <ol class="breadcrumb">
            <li><router-link :to="{name: 'index'}" >Home</router-link></li>
            <li class="active" >Karyawan</li>    
        </ol>
		<table class="table">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Lengkap</th>
					<th>Divisi</th>
					<th>Jenis Kelamin</th>
					<th>Nik</th>
					<th>Created</th>
					<th class="text-right">Actions</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for="(user, index) in users.data">
					<td>{{ users.from + index }}</td>
					<td>{{ user.nama }} </td>
					<td>{{ user.divisi }} </td>
					<td>{{ user.jenis_kelamin }} </td>
					<td>{{ user.nik }} </td>
					<td>{{ user.created_at }} </td>
					<td class="text-right">
						<div class="btn btn-group">	
							<router-link :to="{ name: 'userEdit', params: {id: user.id} }" class="btn btn-info">
								<i class="fa fa-pencil"></i>
							</router-link>
							<button class="btn btn-danger text-danger" @click.prevent="deleteKaryawan(user.id)"><i class="fa fa-trash"></i></button>
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
			axios.get('karyawan/paginate').then(response => {
				this.users = response.data;
				this.alertShow = true;
			});
		},
		methods: {
			paginate(url) {
				axios.get(url).then(response => {
					this.users = response.data;
				})
			},

			fetch(){
				axios.get('karyawan/paginate').then(respon => {
					this.users = respon.data;
				});		
			},

			deleteKaryawan(id){
				var app = this;
				if (confirm('Anda Yakin?')) {	
					axios.delete('karyawan/'+ id +'/delete').then(function(resp){
                		app.$router.replace('/karyawan'); // redirect to url "/"
                		app.fetch(); // redirect to url "/"
					})	
				}
			}
		}
	}
</script>
