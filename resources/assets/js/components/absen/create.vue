<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <i class="fa fa-plus"></i> Buat Absen
      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
    </header>
        <div class="panel-body">
            <form @submit.prevent="store" action="absen-admin/store" class="form-horizontal" method="post">
              <div :class="['form-group', errors.karyawan_id ? 'has-error' : '']">
                  <label class="col-sm-2 control-label">Nama Karyawan</label>
                  <div class="col-sm-10">
                      <select v-model="absen.karyawan_id" class="form-control rounded">
                          <option v-for="(user, index) in users.data" :value="user.id">{{ user.nama }}</option>
                      </select>
                      <span v-if="errors.karyawan_id" class="label label-danger">{{ errors.karyawan_id[0] }}</span>
                      <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                      <span v-if="messageError" class="label label-danger">{{ messageError }}</span>
                  </div>
              </div>

                <div :class="['form-group', errors.status ? 'has-error' : '']">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select v-model="absen.status" class="form-control rounded" :settings="settings.placeholderStatus">
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                            <option value="alfa">Alfa</option>
                        </select>
                        <span v-if="errors.status" class="label label-danger">{{ errors.status[0] }}</span>
                        <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                        <span v-if="messageError" class="label label-danger">{{ messageError }}</span>
                    </div>
                </div>

                  <div v-if="absen.status == 'izin'" :class="['form-group', errors.alasan ? 'has-error' : '']">
                      <label class="col-sm-2 control-label">Alasan Izin</label>
                      <div class="col-sm-10">
                          <input v-model="absen.alasan" type="text" class="form-control rounded" placeholder="Alasan Izin Karyawan [Max: 50 Karakter]..">
                          <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                          <span v-if="errors.alasan" class="label label-danger">{{ errors.alasan[0] }}</span>
                      </div>
                  </div>
                <button type="submit" class="btn btn-primary col-md-offset-9"><i class="fa fa-plus"></i> Absen</button>
            </form>
        </div>
  </section>
</template>


<script>
export default {
    mounted(){
      axios.get('karyawan/json').then(respon => {
        this.users = respon.data;
      });
    },
    data() {
        return {
            errors: [],
            // url : 'karyawan/post',
            users: [],
            absen: {
                karyawan_id: '',
                status: '',
                alasan: ''
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
        store: function(e) {
            var app = this;
            var newState = app.absen;
            axios.post(e.target.action, newState)
            .then(function (resp) {
            	app.errors = [];
            	// app.messageError = false; // showing result
              app.absen.karyawan_id = ''; // clear form
              app.absen.alasan = ''; // clear form
              app.absen.status = ''; // clear form
                // app.$router.replace('/'); // redirect to url "/"
            }).catch((error) => {
                 this.errors = error.response.data.errors;
                 this.message = false;
            });
        }
  	}
}
</script>
