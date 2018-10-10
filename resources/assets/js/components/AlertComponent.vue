<template>
	<alert placement="top-right" v-bind:type="type" width="400px" dismissable>
	  <img v-if="image != null" v-bind:src="image" width="80" height="80" alt="">
	  <span class="icon-ok-circled alert-icon-float-left"></span>
	  <strong>{{ title }}</strong>
	  <p>{{ message }}</p>
	</alert>
</template>


<script>
	import alert from 'vue-strap/src/alert';
	export default {
	  props: ['title', 'message', 'type', 'image'],
	  components: {
	    alert: alert
	  },
	  data() {
		  return {
		  }
	  }
	}
</script>
