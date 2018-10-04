<template>
    <div class="btn btn-group">
		<router-link :to="{ name: 'userIndex' }">
			<button class="btn btn-info">Master Karyawan</button>
		</router-link>

        <router-link :to="{ name: 'historyIndex' }">
            <button class="btn btn-danger">History Absen</button>
        </router-link>

    </div>
</template>

<script>

    export default {
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
