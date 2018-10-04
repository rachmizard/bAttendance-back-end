<template>
	<div id="app" style="margin-top: 100px;">
    <half-circle-spinner
      :animation-duration="1000"
      :size="60"
      color="#91aee0"
    />
  </div>
</template>

<script>
import { HalfCircleSpinner } from 'epic-spinners'
export default {
    components: {
      HalfCircleSpinner
    }
}
</script>
