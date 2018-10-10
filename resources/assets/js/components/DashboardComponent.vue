<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-dashboard"></i> {{ title }}</div>
                    <div class="panel-body">
                        <div class="btn btn-group">
                            <router-link :to="{ name: 'userIndex' }">
                                <button class="btn btn-info">Master Karyawan</button>
                            </router-link>

                            <router-link :to="{ name: 'historyIndex' }">
                                <button class="btn btn-danger">History Absen</button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-clock-o"></i> History Absen</div>

                    <div class="panel-body">
                        <history-component></history-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['title'],

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
<style lang="scss">
    @import url('https://fonts.googleapis.com/css?family=Ek+Mukta');

.fade-enter {
    opacity: 0;
}

.fade-enter-active {
    transition: opacity 0.5s ease;
}

.fade-leave {

}

.fade-leave-active {
    transition: opacity 0.5s ease;
    opacity: 0;
}
</style>
