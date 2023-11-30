<template>
  <div>
    <div class="super_container">
      <about-header/>
      <about-home/>
      <about-luxury/>
      <about-testimonials/>
      <user-footer/>
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import AboutHeader from '@/components/about/AboutHeader.vue';
import AboutHome from '@/components/about/AboutHome.vue';
import AboutLuxury from '@/components/about/AboutLuxury.vue';
import AboutTestimonials from '@/components/about/AboutTestimonials.vue';
import UserFooter from '@/components/user/UserFooter.vue';

export default {
  name: 'UserAbout',
  components: { AboutHome, AboutLuxury, AboutTestimonials, UserFooter, AboutHeader },
  setup() {
    const stylesLoaded = ref(false);

    async function loadStyles() {
      try {
        await import('@/assets/styles/bootstrap-4.1.2/bootstrap.min.css');
        await import('@/assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css');
        await import('@/assets/plugins/OwlCarousel2-2.3.4/owl.carousel.css');
        await import('@/assets/plugins/OwlCarousel2-2.3.4/owl.theme.default.css');
        await import('@/assets/plugins/OwlCarousel2-2.3.4/animate.css');
        await import('@/assets/plugins/jquery-datepicker/jquery-ui.css');
        await import('@/assets/styles/about.css');
        await import('@/assets/styles/about_responsive.css');

        stylesLoaded.value = true;
      } catch (error) {
        console.error('Error loading styles:', error);
      }
    }

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
      await Promise.all([
        loadStyles(),
        loadScriptsInOrder([
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
          '/js/about.js',
          '/js/greensock/animation.gsap.min.js',
        ]),
      ]);
    });

    return { stylesLoaded };
  },
};
</script>


