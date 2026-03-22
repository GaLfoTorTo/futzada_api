import './bootstrap';
import App from './Layout/App.vue';
import { createApp } from 'vue';
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import ConfirmationService from 'primevue/confirmationservice';
import Popover from 'primevue/popover';
import Ripple from 'primevue/ripple';
import Tooltip from 'primevue/tooltip';
import { appRoutes } from '@/Routes/AppRoute';
import { appTheme } from '@/Theme/AppTheme';
import { appLocale } from '@/Theme/AppLang';

//CRIAÇÃO DO APP
const app = createApp(App);
//INICIALIZAR PRIMEVUE
app.use(PrimeVue, {
   locale: appLocale,
   theme: {
      preset: appTheme,
      options: {
         darkModeSelector: '.app-theme',
      }
   },
   unstyled: false,
   pt: {},
   ripple: true,
   iconClass: (icon) => icon
});
//HABILITAR POPOVER
app.directive('popover', Popover)
//HABILITAR RIPPLE (ANIMAÇÕES DE CLICK)
app.directive('ripple', Ripple)
//HABILITAR TOOLTIP
app.directive('tooltip', Tooltip)
//INICIALIZAR SERVIÇO DE TOASTS
app.use(ToastService);
//INICIALIZAR SERVIÇO DE CONFIRMAÇÃO
app.use(ConfirmationService);
//RENDER APP
app.use(appRoutes)
   .mount('#app');