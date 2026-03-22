import { createRouter, createWebHistory } from 'vue-router'

// FUNÇÃO DE BIDING DE PÁGINAS
const resolverPage = (name) => {
   const pages = import.meta.glob('../Pages/**/*.vue')
   const path = `../Pages/${name}.vue`
   if (!pages[path]) {
      throw new Error(`Página Não Encontrada: ${name}`)
   }
   
   return () => pages[path]() // <-- retorna uma função, não a Promise
}

const routes = [
   { 
      path: '/landing', 
      name: 'landing',
      component: resolverPage('Landing/Index'),
   }
]

export const appRoutes = createRouter({
   history: createWebHistory(),
   routes
})