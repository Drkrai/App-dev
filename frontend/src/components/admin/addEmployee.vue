<template>
  <div>
    <div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">Add Employee</h3> </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form @submit.prevent="signUp">
							<div class="row formtype">
								<div class="col-md-4">
									<div class="form-group">
										<label>Name</label>
										<input class="form-control" type="text" v-model="name"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>User Name</label>
										<input class="form-control" type="text" v-model="username"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Email Address</label>
										<input class="form-control" type="text" v-model="email"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Password</label>
										<input class="form-control" type="text" v-model="password" @input="validatePassword">  </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Confirm Password</label>
										<input class="form-control" type="text" v-model="confirmPassword" @input="validatePassword"> </div>
								</div>
                                
								<div class="col-md-4">
									<div class="form-group">
										<label>Joining Date</label>
										
											<input type="date" class="form-control datetimepicker"> 
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Phone Number</label>
										<input class="form-control" type="text" v-model="phone"> </div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Role</label>
										<select class="form-control" id="sel1" name="sellist1" v-model="role">
											<option>Admin</option>
											<option>Manager</option>
											<option>Staff</option>
											<option>Servants</option>
											<option>Accountant</option>
										</select>
									</div>
								</div>
                                
							</div>
                            <p v-if="passwordError" style="color: red;">{{ passwordError }}</p>
                            <button type="submit" class="btn btn-primary buttonedit">Create Employee</button>
						</form>
					</div>
				</div>
				
			</div>
		</div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    name:'add-employee',
    data() {
        return {
            password:'',
            confirmPassword:'',
            passwordError: '',
            name:'',
            username: '',
            email: '',
            date: '',
            phone: '',
            role: '',
        }
    },

    methods: {
        validatePassword() {
    this.passwordError = '';

    if (!this.password && !this.confirmPassword) {
        this.passwordError = 'Password fields cannot be empty';
        return false;
    }

    if (this.confirmPassword && this.password !== this.confirmPassword) {
        this.passwordError = 'Passwords do not match';
        return false;
    }

    const passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/;
    if (!passwordRegex.test(this.password)) {
        this.passwordError = 'Password must have at least one uppercase letter, one number, one special character, and be at least 8 characters long';
        return false;
    }

    return true;
},

     async signUp() {
  if (this.validatePassword()) { 
    try {
      const ins= await axios.post('save-employee',{
                name:this.name,
                username:this.username,
                email:this.email,
                password:this.password,
                date:this.date,
                phone:this.phone,
                role:this.role,
            })
            if (ins.data.exists) {
            this.passwordError = 'Email already exists';
            return false;
        }
    } catch (error) {
        console.error('Error saving employee or checking email existence:', error);
        this.passwordError = 'Error signing up. Please try again later.';
        return false;
    }
  }
}
    },
}
</script>
