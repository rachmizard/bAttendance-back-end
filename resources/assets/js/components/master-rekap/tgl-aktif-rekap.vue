<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <i class="fa fa-check"></i> Set Tanggal Rekap
      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
    </header>
        <div class="panel-body">
            <form @submit.prevent="update" action="rekap-admin/1/updateMasterRekap" class="form-horizontal" method="post">
              <div :class="['form-group', errors.tanggal_aktif_rekap ? 'has-error' : '']">
                  <label class="col-sm-2 control-label">Tanggal Rekap Aktif</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" v-model="masterRekap.tanggal_aktif_rekap">
                      <span v-if="errors.tanggal_aktif_rekap" class="label label-danger">{{ errors.tanggal_aktif_rekap[0] }}</span>
                      <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                      <span v-if="messageError" class="label label-danger">{{ messageError }}</span>
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
      this.fetch()
    },
    data() {
        return {
            errors: [],
            // url : 'karyawan/post',
            masterRekap: {
                tanggal_aktif_rekap: '',
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
        fetch(){
            axios.get('rekap-admin/selectMasterRekap').then(respon => {
              this.masterRekap = respon.data;
            });
        },
        update: function(e) {
            var app = this;
            var newState = app.masterRekap;
            axios.put(e.target.action, newState)
            .then(function (resp) {
            	app.errors = [];
                if (resp.data.response.status == 'exist') {
                	app.message = false;
                	app.messageError = resp.data.response.message; // showing result
                }else{
                	app.message = resp.data.response.message;
                	app.messageError = false; // showing result
	                app.masterRekap.tanggal_aktif_rekap = ''; // clear form
	                app.masterRekap.alasan = ''; // clear form
	                app.masterRekap.status = ''; // clear form
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
