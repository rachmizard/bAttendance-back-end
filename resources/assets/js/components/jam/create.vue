<template>
  <section class="panel panel-default">
    <header class="panel-heading">
      <i class="fa fa-clock-o"></i> Tambah Jam 
      <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i> 
    </header>
        <div class="panel-body">
            <form @submit.prevent="store" action="jam/post" class="form-horizontal" method="post">
                <div :class="['form-group', errors.start ? 'has-error' : '']">
                    <label class="col-sm-2 control-label">Jam Masuk</label>
                    <div class="col-sm-10">
                        <input v-model="state.start" type="time" class="form-control rounded" placeholder="Jam Masuk..">
                        <span v-if="message" class="text-success"><i class="fa fa-check"></i></span>
                        <span v-if="errors.start" class="label label-danger">{{ errors.start[0] }}</span>
                    </div>
                </div>

                <div :class="['form-group', errors.tolerance ? 'has-error' : '']">
                    <label class="col-sm-2 control-label">Toleransi Masuk</label>
                    <div class="col-sm-10">
                        <input v-model="state.tolerance" type="time" class="form-control rounded" placeholder="Jam Toleransi..">
                        <span v-if="message" class="text-success"><i class="fa fa-check"></i></span>
                        <span v-if="errors.tolerance" class="label label-danger">{{ errors.tolerance[0] }}</span>
                    </div>
                </div>

                <div :class="['form-group', errors.end ? 'has-error' : '']">
                    <label class="col-sm-2 control-label">Jam Keluar</label>
                    <div class="col-sm-10">
                        <input v-model="state.end" type="time" class="form-control rounded" placeholder="Jam Keluar..">
                        <span v-if="message" class="text-success"><i class="fa fa-check"></i></span>
                        <span v-if="errors.end" class="label label-danger">{{ errors.end[0] }}</span>
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
                start: '',
                tolerance: '',
                end: '',
            },
            message : '',
            messageError: ''
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
                    app.state.start = ''; // clear form
	                app.state.tolerance = ''; // clear form
	                app.state.end = ''; // clear form
                    window.location.reload();
                }
                // app.$router.replace('/'); // redirect to url "/"
            }).then(function(resp){
                window.location.reload();
            }).catch((error) => {
                 this.errors = error.response.data.errors;
                 this.message = false;
            });
        }
  	}
}
</script>
