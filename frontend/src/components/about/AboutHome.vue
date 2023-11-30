<template>
  <div>
    	<div class="home">
		<div class="background_image" :style="{
      'background-image': 'url(' + require(`@/assets/images/${image}`) + ')'
  }"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content text-center">
							<div class="home_title">About us</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</template>

<script>
export default {
    name: 'AboutHome',
	data() {
		return {
			image:'about.jpg'
		}
	},
}
</script>

<style>

</style>