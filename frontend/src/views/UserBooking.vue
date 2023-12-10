<template>
    <div>
        <div class="super_container">
        <UserHeader/>
        <UserMenu/>
        <BookingHome/>
        <Mainbooking/>
        <Rooms/>
        <UserFooter/>
        </div>
    </div>
</template>
<script>
import UserHeader from '@/components/user/UserHeader.vue'
import UserMenu from '@/components/user/UserMenu.vue'
import Rooms from '@/components/booking/Rooms.vue'
import Mainbooking from '@/components/booking/Mainbooking.vue'
import UserFooter from '@/components/user/UserFooter.vue'
import BookingHome from '@/components/booking/BookingHome.vue'
import { onMounted } from 'vue'
export default {
    name:'UserBooking',
    components: {Rooms,Mainbooking,UserHeader,UserMenu,UserFooter,BookingHome},
     setup() {
    async function loadScript(src) {
      return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
      });
    }

    async function loadScriptsInOrder(scriptUrls) {
      for (const url of scriptUrls) {
        await loadScript(url);
      }
    }

    onMounted(async () => {
      await loadScriptsInOrder([
        '/js/jquery-3.3.1.min.js',
        '/js/popper.js',
        '/js/bootstrap.min.js',
        '/js/greensock/TweenMax.min.js',
        '/js/greensock/TimelineMax.min.js',
        '/js/scrollmagic/ScrollMagic.min.js',
        '/js/greensock/ScrollToPlugin.min.js',
        '/js/owl.carousel.js',
        '/js/easing/easing.js',
        '/js/progressbar/progressbar.min.js',
        '/js/parallax-js-master/parallax.min.js',
        '/js/jquery-ui.js',
        '/js/jquery.colorbox-min.js',
        '/js/custom.js',
        '/js/greensock/animation.gsap.min.js',
        '/js/booking.js'
      ]);
    });
  }
}


</script>
<style lang="css">
    @import'@/assets/plugins/OwlCarousel2-2.3.4/owl.carousel.css';
    @import'@/assets/plugins/OwlCarousel2-2.3.4/owl.carousel.css';
    @import'@/assets/plugins/OwlCarousel2-2.3.4/owl.theme.default.css';
    @import'@/assets/plugins/OwlCarousel2-2.3.4/animate.css';
    @import'@/assets/plugins/jquery-datepicker/jquery-ui.css';
    @import'@/assets/styles/booking.css';
    @import'@/assets/styles/booking_responsive.css';
    @import'@/assets/styles/responsive.css';
    @import'@/assets/styles/bootstrap-4.1.2/bootstrap.min.css';

</style>
