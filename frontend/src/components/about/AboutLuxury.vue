<template>
    <div class="split_section_right container_custom">
		<div class="container">
			<div class="row row-xl-eq-height">
				
				<div class="col-xl-6 order-xl-1 order-2">
					<div class="split_section_image">
						<div class="background_image" :style="{
      'background-image': 'url(' + require(`@/assets/images/${image}`) + ')'
  }"></div>
					</div>
				</div>

				<div class="col-xl-6 order-xl-2 order-1">
					<div class="split_section_right_content">
						<div class="split_section_title"><h1>Luxury Resort</h1></div>
						<div class="split_section_text">
							<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci ipsum, a bibendum lacus suscipit sit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci ipsum, a bibendum lacus suscipit sit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci.</p>
						</div>

						<!-- Milestones -->
						<div class="milestones_container d-flex flex-row align-items-start justify-content-start flex-wrap">
								
							<!-- Milestone -->
							<div class="milestone d-flex flex-row align-items-start justify-content-start">
								<div class="milestone_content">
									<div class="milestone_counter" data-end-value="45">0</div>
									<div class="milestone_title">Rooms available</div>
								</div>
							</div>

							<!-- Milestone -->
							<div class="milestone d-flex flex-row align-items-start justify-content-start">
								<div class="milestone_content">
									<div class="milestone_counter" data-end-value="21" data-sign-after="K">0</div>
									<div class="milestone_title">Tourists this year</div>
								</div>
							</div>

							<!-- Milestone -->
							<div class="milestone d-flex flex-row align-items-start justify-content-start">
								<div class="milestone_content">
									<div class="milestone_counter" data-end-value="2">0</div>
									<div class="milestone_title">Swimming pools</div>
								</div>
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
    name:'AboutLuxury',
    data() {
        return {
            image:'milestones.jpg'
        }
    },
}
</script>

<style>

</style>