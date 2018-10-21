<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <i class="fa fa-check"></i> Set Tanggal Rekap
      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
    </header>
        <div class="panel-body">
            <form @submit.prevent="update" action="rekap-admin/1/updateMasterRekap" class="form-horizontal" method="post">
              <div :class="['form-group', errors.tahun ? 'has-error'  : '']">
                  <label class="col-sm-4 control-label">Set Tahun</label>
                  <div class="col-sm-8">
                      <select class="form-control" v-model="masterRekap.tahun">
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                      </select>
                      <span v-if="errors.tahun" class="label label-danger">{{ errors.tahun[0] }}</span>
                      <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                      <span v-if="messageError" class="label label-danger">{{ messageError }}</span>
                  </div>
              </div>
              <div :class="['form-group', errors.bulan_awal ? 'has-error'  : '']">
                  <label class="col-sm-4 control-label">Bulan Awal</label>
                  <div class="col-sm-8">
                        <select class="form-control" v-model="masterRekap.bulan_awal">
                          <option value="first day of January">Januari</option>
                          <option value="first day of February">Februari</option>
                          <option value="first day of March">Maret</option>
                          <option value="first day of April">April</option>
                          <option value="first day of May">Mei</option>
                          <option value="first day of June">Juni</option>
                          <option value="first day of July">Juli</option>
                          <option value="first day of August">Agustus</option>
                          <option value="first day of September">September</option>
                          <option value="first day of October">Oktober</option>
                          <option value="first day of November">November</option>
                          <option value="first day of December">Desember</option>
                        </select>
                      <span v-if="errors.bulan_awal" class="label label-danger">{{ errors.bulan_awal[0] }}</span>
                      <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                      <span v-if="messageError" class="label label-danger">{{ messageError }}</span>
                  </div>
              </div>
              <div :class="['form-group', errors.bulan_akhir ? 'has-error'  : '']">
                  <label class="col-sm-4 control-label">Bulan Akhir</label>
                  <div class="col-sm-8">
                        <select class="form-control" v-model="masterRekap.bulan_akhir">
                          <option value="last day of January">Januari</option>
                          <option value="last day of February">Februari</option>
                          <option value="last day of March">Maret</option>
                          <option value="last day of April">April</option>
                          <option value="last day of May">Mei</option>
                          <option value="last day of June">Juni</option>
                          <option value="last day of July">Juli</option>
                          <option value="last day of August">Agustus</option>
                          <option value="last day of September">September</option>
                          <option value="last day of October">Oktober</option>
                          <option value="last day of November">November</option>
                          <option value="last day of December">Desember</option>
                        </select>
                      <span v-if="errors.bulan_akhir" class="label label-danger">{{ errors.bulan_akhir[0] }}</span>
                      <span v-if="message" class="label label-success"><i class="fa fa-check"></i></span>
                      <span v-if="messageError" class="label label-danger">{{ messageError }}</span>
                  </div>
              </div>
                <button type="submit" class="btn btn-primary col-md-offset-7"><i class="fa fa-check"></i> Set Rekap</button>
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
                bulan_awal: '',
                bulan_akhir: '',
                tahun: '',
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
                	app.message = resp.data.response.message
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
