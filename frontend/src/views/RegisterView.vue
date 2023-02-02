<template>
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
      <a href="/" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
          <span>MyProject Codeur</span>  
      </a>
      <!-- Card -->
      <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
              Create a Free Account
          </h2>
          <form class="mt-8 space-y-6" @submit.prevent="submitForm">
              <div>
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                  <input type="email"  v-model="username" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="name@company.com" required="">
              </div>
              <div>
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                  <input type="password" v-model="password"  id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" required="">
              </div>
              <div>
                  <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                  <input type="password" v-model="confirmPassword"  name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" required="">
              </div>
              <div class="flex items-start">
                  <div class="flex items-center h-5">
                      <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-red-300 dark:focus:ring-red-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required="">
                  </div>
                  <div class="ml-3 text-sm">
                      <label for="remember" class="font-medium text-gray-900 dark:text-white">I accept the <a href="#" class="text-red-700 hover:underline dark:text-red-500">Terms and Conditions</a></label>
                  </div>
              </div>
              <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 sm:w-auto dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Create account</button>
              <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                  Already have an account? <a href="/login" class="text-red-700 hover:underline dark:text-red-500">Login here</a>
              </div>
          </form>
          {{  token  }}
          {{  error  }}
      </div>
  </div>
</template>
  
<script>
import requestApi from "../axios" 
  export default {
    data() {
      return {
        username: "",
        password: "",
        confirmPassword: "",
        token: "",
        error: ""
      };
    },
    methods: {
      submitForm: function () {
        if(this.confirmPassword != this.password) {
          this.error = "Les mots de passes ne sont pas identiques" 
        } else {
          requestApi.post("/apip/users" , {
            email: this.username,
            roles: ["USER_ROLES"],
            password: this.password   
          })
          .then((res) => {
              // this.token = res.data.token
              console.log(res)
              if(res){
                this.$router.push('/verify/waiting');
              }
          })
          .catch(err => {
              this.error = err
          })
        }
      }
    },
  };
</script>