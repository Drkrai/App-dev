<template>
  <div>
    <header class="header">
      <div
        class="header_content d-flex flex-row align-items-center justify-content-start"
      >
        <div class="logo"><router-link to="/">La Minsu</router-link></div>
        <div
          class="ml-auto d-flex flex-row align-items-center justify-content-start"
        >
          <nav class="main_nav">
            <ul class="d-flex flex-row align-items-start justify-content-start">
              <li class="active"><a href="/">Home</a></li>
              <li><router-link to="/about">About us</router-link></li>
              <li><router-link to="/booking">Rooms</router-link></li>
              <li v-if="isLoggedIn"><router-link to="/specific">Bookings</router-link></li>
              <li v-if="isLoggedIn">
                <router-link to="/contact">Notification</router-link>
              </li>
              <li v-if="!isLoggedIn">
                <router-link to="/login">Login</router-link>
              </li>
              <li v-if="!isLoggedIn">
                <router-link to="/register">Register</router-link>
              </li>
            </ul>
          </nav>
          <div class="book_button">
            <router-link to="/booking">Book Online</router-link>
          </div>
          <div class="book_button" v-if="isLoggedIn">
            <a  @click="logout()">Logout</a>
          </div>

          <!-- Hamburger Menu -->
          <div class="hamburger">
            <i class="fa fa-bars" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </header>
  </div>
</template>
<script>
import booking from "./Booking.vue";
export default {
  name: "UserHeader",
  components: {
    booking,
  },
  data() {
    return {
      isLoggedIn: false,
      show: false,
    };
  },
  created() {
    this.isLoggedIn = localStorage.getItem("user_id") !== null;
  },
  methods: {
    showBooking() {
      this.show = !this.show;
      console.log("show booking:", this.show);
    },
	logout() {
      localStorage.removeItem('name');
      localStorage.removeItem('token');
      localStorage.removeItem('user_id');
      this.$router.push('/login');
    },
  },
};
</script>