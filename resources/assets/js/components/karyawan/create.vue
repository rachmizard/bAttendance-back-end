<template>	
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-dashboard"></i> {{ title }}</div>
                    <div class="panel-body">             	
						<div>
					        <ol class="breadcrumb">
					            <li><router-link :to="{name: 'userIndex'}" >Karyawan</router-link></li>
					            <li class="active" >Tambah Karyawan</li>    
					        </ol>
							<div v-if="message" class="alert alert-success">
								{{ message }}
							</div>
							<div v-if="messageError" class="alert alert-danger">
								{{ messageError }}
							</div>

							<form @submit.prevent="store" action="karyawan/post" method="post">
								<div :class="['form-group', errors.nama ? 'has-error' : '']">
									<label>Nama Lengkap</label>
									<input v-model="state.nama" type="text" class="form-control">
									<span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
									<span v-if="errors.nama" class="label label-danger">{{ errors.nama[0] }}</span>
								</div>

								<div :class="['form-group', errors.divisi ? 'has-error' : '']">
									<label>Divisi</label>
									<input v-model="state.divisi" type="text" class="form-control">
									<span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
									<span v-if="errors.divisi" class="label label-danger">{{ errors.divisi[0] }}</span>
								</div>

								<div :class="['form-group', errors.jenis_kelamin ? 'has-error' : '']">
									<label>Jenis Kelamin</label>
									<input v-model="state.jenis_kelamin" type="text" class="form-control">
									<span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
									<span v-if="errors.jenis_kelamin" class="label label-danger">{{ errors.jenis_kelamin[0] }}</span>
								</div>

								<div :class="['form-group', errors.nik ? 'has-error' : '']">
									<label>NIK</label>
									<input v-model="state.nik" type="number" class="form-control">
									<span v-if="errors.nik" class="label label-danger">{{ errors.nik[0] }}</span>
									<span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
									<span v-if="messageError" class="label label-danger">{{ messageError }}</span>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary">Submit</button>
									<router-link :to="{ name: 'userIndex' }">Back to index</router-link>
								</div>
							</form>
						</div>
                    </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['title'],

    data() {
        return {
            errors: [],
            // url : 'karyawan/post',
            state: {
                nama: '',
                divisi: '',
                jenis_kelamin: '',
                nik: '',
            },
            message : '',
            messageError: '',
            settings: {
                placeholder: 'Pilih Jenis Perusahaan'
            } 
        }
    },
    methods: {
        store: function(e) {
            var app = this;
            var newState = app.state;
            axios.post(e.target.action, newState)
            .then(function (resp) {
            	app.errors = [];
                if (resp.data.response.status == 'exist') {
                	app.message = false;
                	app.messageError = resp.data.response.message; // showing result
                }else{
                	app.message = resp.data.response.message;
                	app.messageError = false; // showing result
	                app.state.nama = ''; // clear form
	                app.state.divisi = ''; // clear form
	                app.state.jenis_kelamin = ''; // clear form
	                app.state.nik = ''; // clear form	
                }
                // app.$router.replace('/'); // redirect to url "/"
            }).catch((error) => {
                 this.errors = error.response.data.errors;
                 this.message = false;
            });
        }
  	}
}
</script>
