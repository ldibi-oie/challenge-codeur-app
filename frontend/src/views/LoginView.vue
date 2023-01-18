<!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
    <!--
      This example requires updating your template:
  
      ```
      <html class="h-full bg-gray-50">
      <body class="h-full">
      ```
    -->
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md space-y-8">
        <div>
          <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=red&shade=600" alt="Your Company" />
          <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
          <p class="mt-2 text-center text-sm text-gray-600">
            Or
            {{ ' ' }}
            <a href="#" class="font-medium text-red-600 hover:text-red-500">start your 14-day free trial</a>
          </p>
        </div>
        <form class="mt-8 space-y-6"  @submit.prevent="submitForm">
          <input type="hidden" name="remember" value="true" />
          <div class="-space-y-px rounded-md shadow-sm">
            <div>
              <label for="email-address" class="sr-only">Email address</label>
              <input v-model="username" id="email-address" name="email" type="email" autocomplete="email" required="" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm" placeholder="Email address" />
            </div>
            <div>
              <label for="password" class="sr-only">Password</label>
              <input v-model="password"  id="password" name="password" type="password" autocomplete="current-password" required="" class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-red-500 sm:text-sm" placeholder="Password" />
            </div>
          </div>
  
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500" />
              <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
            </div>
  
            <div class="text-sm">
              <a href="#" class="font-medium text-red-600 hover:text-red-500">Forgot your password?</a>
            </div>
          </div>
  
          <div>
            <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <!-- <LockClosedIcon class="h-5 w-5 text-red-500 group-hover:text-red-400" aria-hidden="true" /> -->
              </span>
              Sign in
            </button>
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
        token: "",
        error: ""
      };
    },
    methods: {
      submitForm: function () {
        requestApi.post("/api/login_check" , {
            username: this.username,
            password: this.password
        })
        .then((res) => {
            this.token = res.data.token
        })
        .catch(err => {
            this.error = err
        })

      }
    },
  };
</script>