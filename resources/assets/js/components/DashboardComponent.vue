<template>
    <div>
		<router-link :to="{ name: 'userIndex' }">
			<button class="btn btn-info">Karyawan</button>
		</router-link>

        <!-- <div class="progress">
          <progressbar now="100" label type="warning" striped></progressbar>
        </div> -->
    </div>
</template>

<script>
    // import progressbar from 'vue-strap/src/progressbar'

    export default {
        // components:{
        //     progressbar
        // },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            redirect() {
                this.$router.push({
                    name: 'userIndex'
                })
            }
        }
    }
</script>
