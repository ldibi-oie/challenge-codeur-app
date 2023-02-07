<script setup>
import { RouterLink, RouterView } from 'vue-router'
<<<<<<< HEAD
import SidebarMenu from './components/SidebarMenu.vue'
=======
import HelloWorld from './components/HelloWorld.vue'
import PanelView from './views/Admin/PanelView.vue';
>>>>>>> develop
</script>

<template>      
<SidebarMenu /> 
<RouterView class="router-view"/>
</template>

<<<<<<< HEAD
=======
<style scoped lang="scss">
#root {
  display: grid;
  grid-template-areas: 'sidebar router-view';
  grid-template-columns: auto 1fr;
  font-family: sans-serif;
}
.sidebar {
  grid-area: 'sidebar';
}
.router-view {
  grid-area: 'router-view';
  padding: 1rem;
}
</style>
>>>>>>> 42c52507 (adding the first compagny design)
