<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        <button class="btn btn-lg btn-success" @click="addVerifikasi()">Generate PIN</button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Status QR</td>
                                    <td>Status Pin</td>
                                    <td>PIN</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="verifikasi in verifikasis">
                                    <td>{{ verifikasi.id }}</td>
                                    <td>{{ verifikasi.status_qr }}</td>
                                    <td>{{ verifikasi.status_pin }}</td>
                                    <td>{{ verifikasi.pin }}</td>
                                    <td><button class="btn btn-danger btn-lg" @click="deleteVerifikasi(verifikasi.id)">HAPUS</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted(){
            this.fetchVerifikasi();
        },

        data(){
            return {
                verifikasis: [],
                verifikasi:{
                    id: '',
                    status_qr: '',
                    status_pin: '',
                    pin: '',
                    qrcode: ''
                },
                verifikasi_id: '',
            }
        },

        created(){
            Echo.channel('qrcode')
            .listen('qrTrigger', (e) => {
                this.fetchVerifikasi();
            });
        },

        methods: {
            fetchVerifikasi(){
                fetch('api/fetch')
                .then(res => res.json())
                .then(res => {
                    // console.log(res.data);
                    this.verifikasis = res.data;
                })
            },

            addVerifikasi(){
                fetch('api/fetch/post', {
                    method: 'post'
                })
                .then(res => res.json())
                .then(data => {
                    this.fetchVerifikasi();
                })
            },

            deleteVerifikasi(id){
                if (confirm('Anda yakin?')) {
                    fetch(`api/fetch/delete/${id}`, {
                        method: 'delete'
                    }).then(res => res.json())
                    .then(data => {
                        this.fetchVerifikasi();
                    })
                }
            }
        }
    }
</script>
