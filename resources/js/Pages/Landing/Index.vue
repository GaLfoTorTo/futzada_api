<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import { Avatar, Button, Card, Toolbar } from 'primevue';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollSmoother } from 'gsap/ScrollSmoother';
import CardFeatures from '@/Components/CardFeatures.vue';

gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

/* ESTADOS - NAVBAR */
//BOTÕES DE NAVEGAÇÃO
const items = ref([
    {
      label: 'Overview',
      section: 'overview',
      icon: 'fas fa-home',
    },
    {
      label: 'Features',
      section: 'features',
      icon: 'fas fa-cogs',
    },
    {
      label: 'Modality',
      section: 'modality',
      icon: 'fas fa-futbol',
    },
    {
      label: 'Network',
      section: 'network',
      icon: 'fas fa-globe',
    },
    {
      label: 'Download',
      section: 'download',
      icon: 'fas fa-download',
    },
    {
      label: 'Contact',
      section: 'contact',
      icon: 'fas fa-phone',
    },
]);
//BOTÕES DE AÇÃO
const buttons = ref([
    {
      label: 'Login',
      route: '/login',
    },
    {
      label: 'Register',
      route: '/register',
    },
]);

/* ESTADOS - OVERVIEW */

// ESTADOS - VIDEO
const videos = ref([
  {id: 1, src: '/videos/futebol_1.mp4', overlay: 'overlay-futebol', tabBar: 'navbar-futebol'},
  {id: 2, src: '/videos/basquete_1.mp4', overlay: 'overlay-basquete', tabBar: 'navbar-basquete'},
  {id: 3, src: '/videos/volei_1.mp4', overlay: 'overlay-volei', tabBar: 'navbar-volei'},
]);
const videoIndex = ref(0);
const videoNext = ref();
const videoTransition = ref(false);
const video = ref(videos.value[0]);
let intervalId = null;

//ESTADOS - SMOOTHSCROOL
const main = ref();
let smoother;
let ctx;

/* ESTADOS - FEATURE */
//OPÇÕES CARD FEATURES

const features = ref([
  'manager',
  ['chat','notify',],
  'maps',
  ['custom','achievement',]
])

/* ESTADOS - FOOTER */
//BOTÕES FOOTER
const products = [
  'Overview',
  'Features',
  'Network',
  'Modality',
  'Download',
];
const empresa = [
  'Contact us',
  'Support',
  'About us',
];
const legal = [
  'Privacy Policy',
  'Terms of Use',
  'Services',
];

// FUNÇÃO PARA ALTERAR O VIDEO
const nextVideo = () => {
  if (videoTransition.value) return;
  
  //PREPARA PROXIMO VIDEO
  const nextIndex = (videoIndex.value + 1) % videos.value.length;
  videoNext.value = videos.value[nextIndex];
  
  //INICIALIZAR TRANSIÇÃO
  videoTransition.value = true;
  
  //ALTEAR VIDEO APOS DELAY
  setTimeout(() => {
    videoIndex.value = nextIndex;
    video.value = videoNext.value;
    
    //FINALIZAR TRANSIÇÃO
    setTimeout(() => {
      videoTransition.value = false;
      videoNext.value = null;
    }, 50);
  }, 500);
};

// FUNÇÃO PARA INICIALIZAR CARROUSEL
const startCarousel = () => {
  if (intervalId) {
    clearInterval(intervalId);
  }
  intervalId = setInterval(() => {
    nextVideo();
  }, 10000);
};

// FUNÇÃO DE PARADA DE CARROUSEL
const stopCarousel = () => {
  if (intervalId) {
    clearInterval(intervalId);
    intervalId = null;
  }
};
// FUNÇÃO DE SMOOTHSCROLL
const scrollTo = (el) => {
  smoother.scrollTo(`#${el}`, true, 'center center');
};

// FUNÇÃO DE INICIALIZAÇÃO DE SCROLLSMOOTHER
const startSmoothScroll = () => {
  ctx = gsap.context(() => {
    //INSTANCIAR SMOOTHSCROLL
    smoother = ScrollSmoother.create({
      wrapper: "#smooth-wrapper",
      content: "#smooth-content",
      smooth: 2,
      effects: true,
      normalizeScroll: true,
      ignoreMobileResize: true
    });
    //INSTANCIAR TRIGGER
    ScrollTrigger.create({
      trigger: '#footer',
      pin: true,
      start: 'top top',
      end: "+=300"
    });
  }, main.value);
}

onMounted(() => {
  //INICIAR CARROUSEL
  startCarousel();
  //INICIAR SCROLLSMOOTHER
  setTimeout(() => {
    startSmoothScroll();
  }, 100);
});

onUnmounted(() => {
  //PARA CARROUSEL
  stopCarousel();
  //PARA SCROLLSMOOTHER
  //ctx.revert();
  //smoother.kill();
});

</script>
<template>
  <Toolbar
    :class="['navbar', video.tabBar, '!rounded-xl !shadow-xs m-5']"
  >
    <template #start>
      <div class="flex justify-center gap-2 w-full">
        <Avatar 
          image="/img/icone.png" 
          size="large"
          class="mx-2"
        />
      </div>
    </template>
    <template #center>
      <div class="flex justify-center gap-2 w-full">
        <Button
          v-for="item in items"
          :label="item.label"
          :icon="item.icon"
          variant="link"
          size="small"
          class="nav-button"
          @click="scrollTo(item.section)"
        />
      </div>
    </template>
    <template #end>
      <div class="flex justify-center gap-2 w-full">
        <Button
          v-for="item in buttons"
          :label="item.label"
          class="nav-button"
          variant="link"
          as="a"
          :href="item.route"
          fluid
        />
      </div>
    </template>
  </Toolbar>
  <main id="smooth-wrapper" ref="main">
    <div id="smooth-content">
      <section id="overview" class="flex flex-col justify-center items-center" style="height: 60rem;" data-speed="0.5">
        <div class="video-container">
          <video 
            :key="video.id"
            autoplay 
            muted 
            loop 
            playsinline
            class="background-video"
            :class="{ 'fade-out': videoTransition }"
          >
            <source :src="video.src" type="video/mp4">
            Seu navegador não suporta vídeos HTML5.
          </video>
          <!-- Overlay com gradiente -->
          <div>
            <div :class="['overlay', video.overlay, { 'fade-out': videoTransition }]"></div>
            <div v-if="videoNext" :class="['overlay', videoNext.overlay, 'fade-in']"></div>
          </div>
        </div>
        <div class="overview-content flex flex-col justify-center items-center gap-8">
          <h1 class="text-6xl text-center text-[var(--blue-500)] max-w-[35rem]">Eleve sua pelada para o próximo nível</h1>
          <h2 class="text-xl text-center text-[var(--blue-500)] max-w-[40rem]">Encontre e organize partidas, pontue dentro e fora das quadras, aproveite de uma experiência única no seu esporte favorito. No futzada você e seus amigos desfrutam de uma prática esportiva inovadora e divertida.</h2>
          <div class="flex mt-8 gap-10">
            <Button 
              label="Get Started"
              severity="secondary"
              size="large"
              raised
            />
            <Button 
              label="Download"
              severity="secondary"
              variant="outlined"
              class="!bg-white"
              size="large"
              raised
            />
          </div>
        </div>
      </section>
      
      <section id="features" class="flex flex-col justify-center items-center gap-5" style="height: 60rem;" data-speed="0.5">
        <div class="flex flex-col justify-center items-center gap-5">
          <h2 class="text-4xl text-center text-[var(--blue-500)] max-w-[35rem]">Uma experiência unica no meio tecno esportivo!</h2>
          <h3 class="text-xl text-center text-[var(--blue-500)] max-w-[40rem]">Toda facilidade que a tecnologia proporciona agora na palma da suas mãos em prol da sua diversão e entretenimento.</h3>
        </div>
        <div class="flex flex-wrap justify-center items-center gap-8 w-[70%] mt-[5rem]">
          <div 
            v-for="(feat, i) in features" 
          >
            <div v-if="i == 0 || i == 2">
              <CardFeatures 
                :feature="feat"
              />
            </div>
            <div v-if="i == 1" class="flex flex-col gap-8">
              <div v-for="(item, ix) in feat">
                <CardFeatures 
                  :feature="item"
                />
              </div>
            </div>
            <div v-if="i == 3" class="flex flex-col md:flex-row gap-8">
              <div v-for="(item, i) in feat">
                <CardFeatures 
                  :feature="item"
                />
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <section id="network" class="flex flex-col justify-center items-center" style="height: 60rem;" data-speed="0.5">
        <div >Network Section</div>
      </section>
      
      <section id="modality" class="flex flex-col justify-center items-center" style="height: 60rem;" data-speed="0.5">
        <div >Modality Section</div>
      </section>
      
      <section id="download" class="flex flex-col justify-center items-center" style="height: 60rem;" data-speed="0.5">
        <div >Download Section</div>
      </section>
      
      <section id="contact" class="flex flex-col justify-center items-center" style="height: 60rem;" data-speed="0.5">
        <div >Contact Section</div>
      </section>

      <footer id="footer" class="flex flex-col md:flex-row justify-evenly" style="height: 60rem;" data-speed="0.5">
        <div class="flex flex-col text-white">
          <strong >Futzada</strong>
          <small class="text-slate-400">&copy; Futzada {{ new Date().getFullYear() }}, Todos os direitos reservados.</small>
        </div>
        <div class="flex flex-col">
          <strong class="text-white">Produto</strong>
          <ul>
            <li v-for="item in products" class="text-slate-400"><a href="#"><small>{{ item }}</small></a></li>
          </ul>
        </div>
        <div class="flex flex-col">
          <strong class="text-white">Empresa</strong>
          <ul>
            <li v-for="item in empresa" class="text-slate-400"><a href="#"><small>{{ item }}</small></a></li>
          </ul>
        </div>
        <div class="flex flex-col">
          <strong class="text-white">Legal</strong>
          <ul>
            <li v-for="item in legal" class="text-slate-400"><a href="#"><small>{{ item }}</small></a></li>
          </ul>
        </div>
      </footer>
    </div>
  </main>
</template>
<style scoped>
/* NAVBAR STYLES */
.navbar {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  margin: 1rem !important;
  width: calc(100% - 2rem);
}

.navbar:hover .navbar:active{
  background: var(--green-300);
  backdrop-filter: blur(14px);
  transition: all 0.5s ease;
}

/* NAVBAR HOVER POR ESPORTES */
.navbar-futebol:hover {
  background: var(--green-300);
  backdrop-filter: blur(14px);
  transition: all 0.5s ease;
}

.navbar-basquete:hover {
  background: var(--orange-500);
  backdrop-filter: blur(14px);
  transition: all 0.5s ease;
}

.navbar-volei:hover {
  background: var(--bege-500);
  backdrop-filter: blur(14px);
  transition: all 0.5s ease;
}

:deep(.nav-button) {
  background: transparent;
  border: none;
}

section {
  min-height: 100vh!important;
  padding-top: 15rem!important;
  padding-bottom: 5rem!important;
}

.overview-animation {
  inset: 0;
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
}

#overlay {
  inset: 0;
  position: absolute;
  z-index: -1;
}

/* VIDEO */
.video-container {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -2;
}

.background-video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: opacity 0.6s ease-in-out;
  opacity: 1;
}

.background-video.fade-out {
  opacity: 0;
}

/* OVERLAYS DE VIDEO */

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  transition: opacity 0.6s ease-in-out;
  opacity: 1;
}

.overlay-futebol {
  background: linear-gradient(
    rgba(4, 211, 97, 1) 0%,
    rgba(4, 211, 97, 0.9) 30%,
    rgba(255, 255, 255, 1) 80%,
    rgba(255, 255, 255, 1) 100%
  );
}

.overlay-basquete {
  background: linear-gradient(
    rgba(235, 61, 11, 1) 0%,
    rgba(235, 61, 11, 0.9) 30%,
    rgba(255, 255, 255, 1) 80%,
    rgba(255, 255, 255, 1) 100%
  );
}

.overlay-volei {
  background: linear-gradient(
    rgba(209, 165, 122, 1) 0%,
    rgba(209, 165, 122, 0.9) 30%,
    rgba(255, 255, 255, 1) 80%,
    rgba(255, 255, 255, 1) 100%
  );
}

/* ANIMAÇÃO DE FADE OVERLAYS */
.overlay.fade-out {
  opacity: 0;
}

.overlay.fade-in {
  animation: fadeIn 0.6s ease-in-out forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

/* FOOTER */
#footer {
  height: 20rem;
  padding: 2rem;
  background: linear-gradient(
    rgba(20, 7, 80, 1) 0%,
    rgba(20, 7, 80, 1) 50%,
    rgba(13, 5, 47, 1) 100%
  ) !important;
}
</style>