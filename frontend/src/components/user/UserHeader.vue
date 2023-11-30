<template>
    <div>
        <header class="header">
		<div class="header_content d-flex flex-row align-items-center justify-content-start">
			<div class="logo"><router-link to="/">The River</router-link> </div>
			<div class="ml-auto d-flex flex-row align-items-center justify-content-start">
				<nav class="main_nav">
					<ul class="d-flex flex-row align-items-start justify-content-start">
						<li class="active"><a href="/">Home</a></li>
						<li><router-link to="/about">About us</router-link></li>
						<li><router-link to="/booking">Rooms</router-link></li>
						<li><router-link to="/blogs">Blog</router-link></li>
						<li><router-link to="/contact">Notification</router-link></li>
					</ul>
				</nav>
				<div class="book_button">
					<router-link to="/booking">Book Online</router-link>	
					</div>
				<div class="header_phone d-flex flex-row align-items-center justify-content-center">
					<img :src="require('@/assets/images/phone.png')" alt="">
					<span>0183-12345678</span>
				</div>

				<!-- Hamburger Menu -->
				<div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
			</div>
		</div>
	</header>
    </div>
</template>
<script>
export default {
    name: 'UserHeader',
}
</script>