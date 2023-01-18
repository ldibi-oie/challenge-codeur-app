import { createApp } from 'vue'
import { createPinia } from 'pinia'

import { Component } from 'vue-react';
import { Admin } from '@api-platform/admin';

import App from './App.vue'
import router from './router'

import './assets/main.css'

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.use(Component)

app.mount('#app')
