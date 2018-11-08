<template>

    <span class="badge badge-sm up bg-danger m-l-n-sm count text-white">
		{{ users.data.length }}
	</span>
</template>

<script>
export default {
	data(){
		return {
			users: {}
		}
	},

	mounted(){
		this.countApproval();
	},

	methods: {
		countApproval: function(){
		 	axios.get('lembur/karyawan').then(respon => {
		 		this.users = respon.data;
			});
		}
	},

	computed: {
		resultCount(){
			return Object.keys(this.users).length;
		}
	}
}
</script>
