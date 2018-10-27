<template>

<div>
  <div class="form-group">
  <label v-if="image" for="" class="col-md-4 control label">Hasil</label>
    <div class="col-md-4">
        <img :src="image" class="img-responsive" height="70" width="90">
    </div>
  </div>
  <div class="form-group">
      <label for="nama" class="col-md-2 control-label">Upload Foto</label>
      <div class="col-md-10">
          <input class="form-control" type="file" autocomplete="off" placeholder="File..." v-on:change="onImageChange" autofocus="">
      </div>
  </div>
</div>

</template>

<script>
	export default {
		data: function(){
      return {
        image: '',
        upload: {
          file: ''
        },
      }
    },
    methods: {
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        uploadImage(){
            axios.put('/karyawan/uploadFp',{image: this.image}).then(response => {
               if (response.data.success) {
                 alert(response.data.success);
               }
            });
        }
    }

	}
</script>