<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <i class="fa fa-plus"></i> Tambah Karyawan
      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
    </header>
        <div class="panel-body">
            <form action="karyawan/post" class="form-horizontal" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                  <label v-if="state.image" for="" class="col-md-2 control label">Hasil</label>
                    <div class="col-md-10">
                        <img :src="state.image" class="img-responsive" height="70" width="90">
                    </div>
              </div>
                <div :class="['form-group', errors.nama ? 'has-error' : '']">
                    <label class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input v-model="state.nama" name="nama" type="text" class="form-control rounded" placeholder="Nama Karyawan.." required="">
                        <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                        <span v-if="errors.nama" class="label label-danger">{{ errors.nama[0] }}</span>
                    </div>
                </div>
                <div :class="['form-group', errors.jabatan ? 'has-error' : '']">
                    <label class="col-sm-2 control-label">Jabatan</label>
                    <div class="col-sm-10">
                        <input name="jabatan" v-model="state.jabatan" type="text" class="form-control rounded" placeholder="Jabatan Karyawan.." required="">
                        <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                        <span v-if="errors.jabatan" class="label label-danger">{{ errors.jabatan[0] }}</span>
                    </div>
                </div>
                <div :class="['form-group', errors.divisi ? 'has-error' : '']">
                    <label class="col-sm-2 control-label">Divisi</label>
                    <div class="col-sm-10">
                        <input name="divisi" v-model="state.divisi" type="text" class="form-control rounded" placeholder="Divisi Karyawan.." required="">
                        <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                        <span v-if="errors.divisi" class="label label-danger">{{ errors.divisi[0] }}</span>
                    </div>
                </div>

                <div :class="['form-group', errors.jenis_kelamin ? 'has-error' : '']">
                    <label class="col-sm-2 control-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select v-model="state.jenis_kelamin" name="jenis_kelamin" class="form-control rounded" :settings="settings.placeholder" required="">
                            <option disabled selected>Pilih Jenis Kelamin</option>
                            <option value="L" >Laki Laki</option>
                            <option value="P" >Perempuan</option>
                        </select>
                        <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                        <span v-if="errors.jenis_kelamin" class="label label-danger">{{ errors.jenis_kelamin[0] }}</span>
                    </div>
                </div>

                <!-- <div :class="['form-group', errors.nik ? 'has-error' : '']">
                    <label class="col-sm-2 control-label">NIK</label>
                    <div class="col-sm-10">
                        <input v-model="state.nik" type="number" class="form-control rounded" placeholder="NIK Karyawan..">
                        <span v-if="errors.nik" class="label label-danger">{{ errors.nik[0] }}</span>
                        <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                        <span v-if="messageError" class="label label-danger">{{ messageError }}</span>
                    </div>
                </div> -->

                <div :class="['form-group', errors.status ? 'has-error' : '']">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select v-model="state.status" name="status" class="form-control rounded" :settings="settings.placeholderStatus" required="">
                            <option disabled selected>Pilih Status</option>
                            <option value="authorized">Buka Akses</option>
                            <option value="unauthorized">Tutup Akses</option>
                        </select>
                        <span v-if="errors.status" class="label label-danger">{{ errors.status[0] }}</span>
                        <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                        <span v-if="messageError" class="label label-danger">{{ messageError }}</span>
                    </div>
                </div>
                  <div class="form-group">
                      <label for="nama" class="col-md-2 control-label">Upload Foto</label>
                      <div class="col-md-10">
                          <input class="form-control" type="file" name="image" autocomplete="off" placeholder="File..." @change="onImageChange" autofocus="">
                      </div>
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
  </section>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            // url : 'karyawan/post',
            state: {
                nama: '',
                jabatan: '',
                divisi: '',
                jenis_kelamin: '',
                nik: '',
                status: '',
                image: ''
            },
            message : '',
            messageError: '',
            settings: {
                placeholder: 'Pilih Jenis Kelamin',
                placeholderStatus: 'Pilih Status Karyawan'
            }
        }
    },
    methods: {
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            console.log(e.target.files[0]);
            if (!files.length)
                return;
            this.createImage(files[0]);
            this.state.image = e.target.files[0];
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.state.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        uploadImage(){
            axios.put('/karyawan/uploadFp',{image: this.image}).then(response => {
               if (response.data.success) {
                 alert(response.data.success);
               }
            });
        },
        store: function(e) {
            let app = this;
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
                    app.state.jabatan = ''; // clear form
                    app.state.divisi = ''; // clear form
                    app.state.jenis_kelamin = ''; // clear form
                    app.state.nik = ''; // clear form
                    app.state.status = ''; // clear form
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
