<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-md-6">
        <div class="card p-4 shadow">
          <form @submit.prevent="register" ref="registerForm">
            <div v-if="message === 'error'" class="alert alert-danger">Invalid response</div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" v-model="name" class="form-control" id="username">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" v-model="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" v-model="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
              <label for="passwordConfirm" class="form-label">Password Confirm</label>
              <input
                type="password"
                v-model="confirmpassword"
                class="form-control"
                id="passwordConfirm"
                @input="checkMsg"
              >
            </div>
            <p v-if="showMessage" class="alert alert-danger">{{ errorMessage }}</p>
            <button :disabled="!isValid" type="submit" class="btn btn-primary mx-auto w-100 mb-3">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
return {
  name: "",
  email: "",
  password: "",
  confirmpassword: "",
  showMessage: false,
  registered: false,
  errorMessage: "", 

};
},

  computed: {
    passwordsMatch() {
      return this.password === this.confirmpassword;
    },
    isValid() {
      return this.password !== '' && this.confirmpassword !== '';
    },
    message() {
      if (this.passwordsMatch) {
        return 'Passwords match!';
      } else {
        return 'Passwords do not match.';
      }
    },
  },
  methods: {
    checkMsg() {
      this.dirty = this.confirmpassword !== '';
      this.showMessage = this.dirty;

      if (!this.dirty) {
        this.showMessage = false;
        this.errorMessage = ''; 
      }
    },
    async register() {
      try {
        const res = await axios.post("register", {
          name: this.name,
          email: this.email,
          password: this.password,
          confirmpassword: this.confirmpassword,
        })
        this.name = "";
        this.email = "";
        this.password = "";
        this.confirmpassword = "";
        this.registered = true;
        this.showMessage = false;
        this.errorMessage = ""; 
        this.$refs.registerForm.reset();
        this.$emit('data-saved');
        this.getInfo();
          } catch (error) {
        if (error.response && error.response.data && error.response.data.error) {
          this.errorMessage = error.response.data.error;
        }
                }
              }
            }
          };
</script>

