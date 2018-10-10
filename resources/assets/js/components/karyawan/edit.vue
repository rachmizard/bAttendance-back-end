<template>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-dashboard"></i> {{ Dashboard }}</div>
                    <div class="panel-body">
                        <div class="row" >
                        <div class="col-md-8 col-md-offset-2">
                            <ol class="breadcrumb">
                                <li><router-link :to="{name: 'userIndex'}" >Karyawan</router-link></li>
                                <li class="active" >Edit Karyawan</li>    
                            </ol>
                            <div class="panel panel-default">
                                <div class="panel-heading">Edit Form</div>
                                <div class="panel-body">
                        
                                    <form @submit.prevent="saveForm" class="form-horizontal"> 
                                        <div class="form-group">
                                            <label for="nama" class="col-md-4 control-label">Nama</label>
                                            <div class="col-md-4">
                                                <input class="form-control" autocomplete="off" placeholder="Nama..." type="text" v-model="karyawan.nama" name="nama"  autofocus="">
                                                <span v-if="errors.nama" class="label label-danger">{{ errors.nama[0] }}</span>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="divisi" class="col-md-4 control-label">Divisi</label>
                                            <div class="col-md-4">
                                                <input class="form-control" autocomplete="off" placeholder="Divisi..." type="text" v-model="karyawan.divisi" name="divisi" autofocus="">
                                                <span v-if="errors.divisi" class="label label-danger">{{ errors.divisi[0] }}</span>
                                                
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="jenis_kelamin" class="col-md-4 control-label">Jenis Kelamin</label>
                                            <div class="col-md-4">
                                                <select v-model="karyawan.jenis_kelamin" :settings="settings"> 
                                                        <option value="L"  >Laki Laki</option>
                                                        <option value="P"  >Perempuan</option>
                                                    </select>
                                                <span v-if="errors.jenis_kelamin" class="label label-danger">{{ errors.jenis_kelamin[0] }}</span>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik" class="col-md-4 control-label">NIK</label>
                                            <div class="col-md-4">
                                                <input class="form-control" autocomplete="off" placeholder="Nik..." type="text" v-model="karyawan.nik" name="nik" autofocus="">
                                                <span v-if="errors.nik" class="label label-danger">{{ errors.nik[0] }}</span>
                                                <span v-if="messageError" class="label label-danger">{{ messageError }}</span>

                                            </div>
                                        </div> 
                                    <div class="form-group">
                                        <div class="col-md-4 col-md-offset-2">
                                            <button class="btn btn-primary" id="btnSimpankaryawan" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
    data: function () {
        return {
            errors: [],
            karyawanId: '',
            karyawan: {
                nama: '',
                divisi: '',
                jenis_kelamin: '',
                nik: ''
            },
            message : '',
            messageError : '',
            settings: {
                placeholder: 'Pilih Jenis Perusahaan'
            } 
        }
    },
    mounted(){
        this.getData();
    },
    methods: {
        saveForm() {
            var app = this;
            var newkaryawan = app.karyawan;
             axios.put('karyawan/' + app.karyawanId + '/update', newkaryawan)
            .then(function (resp) {
                if (resp.data.response.status == 'exist') {
                    app.message = false;
                    app.messageError = resp.data.response.message;
                }else{
                    app.message = resp.data.response.message;
                    app.messageError = false;
                    app.karyawan.nama = '';
                    app.karyawan.divisi = '';
                    app.karyawan.jenis_kelamin = '';
                    app.karyawan.nik = '';
                    app.errors = [];
                    app.$router.replace('/karyawan'); // redirect to home "/"
                }
            }).catch((error) => {
                 this.errors = error.response.data.errors;
                 this.message = false;
            });
        },
      getData(){
        let app = this;
        let id = app.$route.params.id;
        app.karyawanId = id;
        axios.get('karyawan/' + id +'/edit')
        .then(function (resp) {
            app.karyawan = resp.data;
        })
        .catch(function () {
            alert("Could not load your karyawan")
        });
      }
  }
}
</script>
