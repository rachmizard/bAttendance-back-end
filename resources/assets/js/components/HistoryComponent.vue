<template>
  <section class="panel panel-default">
    <header class="panel-heading">                    
      Absen History
    </header>
    <section class="panel-body slim-scroll" data-height="230px">
      <article v-for="(user, index) in users.data" class="media">
        <span class="pull-left thumb-sm"><img src="images/avatar_default.jpg" class="img-circle"></span>
        <div class="media-body">
          <div class="pull-right media-xs text-center text-muted">
            <strong class="h4">{{ user.jam }}</strong><br>
          </div>
          <a href="#" class="h4">Saya Hadir!</a>
          <small class="block"><a href="#" class="">{{ user.nama }}</a> <span class="label label-success">{{ user.divisi }}</span></small>
          <small class="block m-t-sm">Horee, saya masuk hari ini!</small>
        </div>
      </article>
      <div class="line pull-in"></div>
    </section>
  </section>

<!-- 
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
	</div> -->
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
			Echo.channel('absen')
			.listen('Absen', (e) => {
				this.fetch();
				alert('Successfully loaded!');
			});	
		},
		methods: {
			paginate(url) {
				axios.get(url).then(response => {
					this.users = response.data;
				})
			},

			fetch(){
				axios.get('history').then(respon => {
					this.users = respon.data;
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
