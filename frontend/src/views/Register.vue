<template>
  <body class="bg-gradient-primary">
    <div
      class="container d-flex justify-content-center align-items-center h-100"
    >
      <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">

          <div class="row">
            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                </div>
                <form
                  class="user"
                  @submit.prevent="register"
                  style="max-width: 400px; width: 100%"
                >

                  <div class="form-group row">
                    <label for="fullname">Fullname:</label>
                    <input
                      v-model="username"
                      type="text"
                      class="form-control"
                    />

                  </div>
                  <!-- Email Input -->
                  <div class="form-group row">
                    <label for="email">Email:</label>
                    <input v-model="email" type="email" class="form-control" />
                    <span v-if="!isValidEmail" class="text-danger">{{
                      emailError || "Please enter a valid email"
                    }}</span>
                  </div>

                  <div class="form-group row">
                    <label for="password">Password:</label>
                    <input
                      v-model="password"
                      type="password"
                      class="form-control"
                    />
                    <span v-if="!isValidPassword" class="text-danger">{{
                      passwordError || "Please enter a valid password"
                    }}</span>
                  </div>

                  <div class="form-group row">
                    <label for="r-password">Repeat Password:</label>
                    <input
                      v-model="repeatPassword"
                      type="password"
                      class="form-control"
                    />
                    <span v-if="!isValidRepeatPassword" class="text-danger"
                      >Passwords do not match</span
                    >
                  </div>

                  <button class="btn btn-primary btn-user btn-block">
                    Register Account
                  </button>
                </form>
                <hr />
                <div class="text-center">
                  <a class="small" href="forgot-password.html"
                    >Forgot Password?</a
                  >
                </div>
                <div class="text-center">
                  <router-link to="login"
                    >Already have an account? Login!</router-link
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</template>

<script>
import axios from "axios";
export default {
  name: "Register",
  data() {
    return {
      username: "",
      email: "",
      emailError: "",
      password: "",
      passwordError: "",
      repeatPassword: "",
      isValidFullName: true,
      isValidEmail: true,
      isValidPassword: true,
      isValidRepeatPassword: true,
    };
  },
  methods: {
    async register() {
      this.isValidEmail = this.validateEmail(this.email);
      this.isValidPassword = this.password.length >= 6;
      this.isValidRepeatPassword = this.password === this.repeatPassword;

      const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@#])[A-Za-z\d@#]+$/;
      if (!passwordRegex.test(this.password)) {
        this.isValidPassword = false;
        this.passwordError =
          "Password must contain at least one letter, one number, and one character";
      }

      if (

        this.isValidEmail &&
        this.isValidPassword &&
        this.isValidRepeatPassword
      ) {
        try {
          const response = await axios.post("register", {
            username: this.username,
            email: this.email,
            password: this.password,
            confirmpassword: this.repeatPassword,
            role: this.selectedRole,
          });
          console.log(this.FullName);
          console.log(response.data);
          this.$router.push("/login");
          // Handle the response accordingly, e.g., redirect to another page
        } catch (error) {
          console.error(error);
          if (error.response && error.response.status === 400) {
            this.isValidEmail = false;
            this.emailError = "Email already exists";
          }
        }
      }
    },
    validateEmail(email) {
      // Regular expression for a simple email validation
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    },
  },
};
</script>
