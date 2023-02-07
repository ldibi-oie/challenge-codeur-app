<script setup>
import { RouterLink, RouterView } from 'vue-router'
import PanelView from './views/Admin/PanelView.vue';
</script>

<template>      
<SidebarMenu /> 
<!-- <RouterView class="router-view"/> -->
<RouterView />
</template>

<style scoped lang="scss">
// #root {
//   display: grid;
//   grid-template-areas: 'sidebar router-view';
//   grid-template-columns: auto 1fr;
//   font-family: sans-serif;
// }
// .sidebar {
//   grid-area: 'sidebar';
// }
// .router-view {
//   grid-area: 'router-view';
//   padding: 1rem;
// }
</style>
