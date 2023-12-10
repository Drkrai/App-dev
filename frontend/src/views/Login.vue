<template>
  <body class="bg-gradient-primary">

    <div class="container containers">

      <!-- Outer Row -->
      <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-8 col-md-9">

          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    </div>
                    <div v-if="errorMessage" class="text-center text-danger mt-3">
                      {{ errorMessage }}
                    </div>
                    <form class="user" @submit.prevent="validateAndLogin">
                      <div class="form-group">
                        <input v-model="email" type="email" class="form-control form-control-user" required placeholder="Enter Email Address...">
                      </div>
                      <div class="form-group">
                        <input v-model="password" type="password" class="form-control form-control-user" placeholder="Password">
                      </div>
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                      </button>
                    </form>
                    <hr>
                    <div class="text-center">
                      <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                      <router-link to="register">Create an Account</router-link>
                    </div>
                  </div>
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
 

    import axios from 'axios'   
    export default {
      name: 'Login',

      data() {
    return {
      email: '',
      password: '',
      errorMessage: '',
    };
  },
  methods: {
    
    
    validateAndLogin() {

      if (!this.email || !this.password) {
        this.errorMessage = 'Email and password are required';
      } else {
        this.login();
      }
    },
    login() {
      const data = {
        email: this.email,
        password: this.password,
      };

      axios
        .post('/login', JSON.stringify(data), {
          headers: {
            'Content-Type': 'application/json',
          },
        })
        .then((response) => {
          if (response.data.message === 'Login successful') {
            this.$router.push('/');
            localStorage.setItem('username', response.data.name);
            localStorage.setItem('token', response.data.token);
            localStorage.setItem('user_id', response.data.userid);
          
          }
        })
        .catch((error) => {
            console.error(error.response.data);
                if ( error.response.data ) {
                    this.errorMessage = error.response.data;
                } else {
                    this.errorMessage = 'Invalid email or password, try again!';
                }
                this.clearErrorMessageAfterDelay(3000);
            });
    },
    clearErrorMessageAfterDelay(delay) {
    setTimeout(() => {
      this.errorMessage = '';
    }, delay);
  },
  },
    }

</script>