<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { onMounted, ref, provide, computed } from 'vue'
import Navbar from './Partials/Navbar.vue'
import Sidebar from './Partials/Sidebar.vue'
import Header from './Partials/Header.vue'
import Footer from './Partials/Footer.vue'
import { getRoute } from '@/Utils/RouteConfig.js';
import Preloader from '@/Components/Popover/Preloader.vue'
import AlertToast from '@/Components/Toast/AlertToast.vue'
import ModalFile from '@/Components/Modals/ModalFile.vue'

//ESTADO - PRELOAD
const page = usePage();
const preloader = ref(null);
const toast = ref(null);
//ESTADOS - ROTA ATUAL
const route = computed(() => getRoute(page.url));

//EXPOR REF DE TOAST E PRELOADER
provide('toast', {
  showToast: (...args) => toast.value?.showToast(...args)
});
provide('preloader', {
  show: (...args) => preloader.value?.show(...args),
  hide: () => preloader.value?.hide(),
});

//CONFIGURAR LISTENER DE EVENTOS DO INERTIA
onMounted(() => {
  //TRIGGERS DE PRELOAD
  router.on('start', () => preloader.value?.show(route.value.action == 'novo' || route.value.action == 'editar' ? true : false))
  router.on('finish', () => preloader.value?.hide())
  router.on('error', () => preloader.value?.hide())
})
</script>

<template>
  <div class="layout-wrapper">
    <Header />
    <div class="main-content">
      <Navbar />
      <div class="content-wrapper">
        <main class="content">
          <slot />
        </main>
        <Footer />
      </div>
    </div>
  </div>
</template>

<style scoped>
.layout-wrapper {
  display: flex;
  min-height: 100vh;
}

.main-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  background-color: var(--p-body-background);
}

.content-wrapper {
  flex: 1;
  display: flex;
  flex-direction: column;
  min-height: 0;
}

.content {
  flex: 1;
  padding: 1rem;
  overflow-y: auto;
}
</style>