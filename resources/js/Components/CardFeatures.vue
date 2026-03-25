<script setup lang="ts">
import { Card } from 'primevue';

const props = defineProps({
   feature: String,
});
//ITEMS
const features = [
   {
      type: 'manager',
      icon: 'fas fa-cogs',
      title: 'Gerenciamento',
      subtitle: 'Mantenha seu evento organizado.',
      description: 'Futzada possibilita gestão completa do seu evento esportivo entre amigos',
      footer: 'Controle de participantes, partidas e muito mais.',
      class: ['w-[15rem]', 'h-[30rem]', 'feature-manager'],
      style: {
         backgroundImage: "url('/img/futebol/football.jpg')",
         backgroundSize: 'cover',
         backgroundPosition: 'center',
         backgroundRepeat: 'no-repeat',
      },
   },
   {
      type: 'chat',
      title: 'Comunicação',
      subtitle: 'Comunicação centralizada no app.',
      description: 'Chats individuais e em grupos para comunicação unificada com seus amigos.',
      class: ['w-[15rem]', 'h-[14rem]', 'feature-chat'],
      icon: 'fas fa-paper-plane',
      style: {
         backgroundImage: "url('/img/futebol/football.jpg')",
         backgroundSize: 'cover',
         backgroundPosition: 'center',
      },
   },
   {
      type: 'notify',
      title: 'Notificações',
      subtitle: 'Mantenha-se alerta diante de tudo.',
      description: 'Notificações em tempo real sobre partidas e atualizações sobre sua vida de atleta.',
      class: ['w-[15rem]', 'h-[14rem]', 'feature-card'],
      icon: 'fas fa-bell',
      style: {
         backgroundImage: "url('/img/futebol/football.jpg')",
         backgroundSize: 'cover',
         backgroundPosition: 'center',
      },
   },
   {
      type: 'maps',
      title: 'Interação com Mapas',
      subtitle: 'Explore e encontre partidas no seu entorno.',
      description: 'Futzada utiliza de bases de dados publicas para mapear as areas e eventos esportivos na sua região.',
      footer: '+ 15.000 locais para jogar',
      class: ['w-[15rem]', 'h-[30rem]', 'feature-card'],
      icon: 'fas fa-compass',
      style: {
         backgroundImage: "url('/img/futebol/football.jpg')",
         backgroundSize: 'cover',
         backgroundPosition: 'center',
      },
   },
   {
      type: 'custom',
      title: 'Personalização',
      subtitle: 'Seu perfil, suas caracteristicas.',
      description: 'Caracteristicas individuais de atlea como posições e arquetipos para tornar sua experiência única.',
      footer: 'Personalize seu perfil de atleta da forma que desejar',
      class: ['w-[23rem]', 'h-[15rem]', 'feature-card'],
      icon: 'fas fa-user',
      style: {
         backgroundImage: "url('/img/futebol/football.jpg')",
         backgroundSize: 'cover',
         backgroundPosition: 'center',
      },
   },
   {
      type: 'achievement',
      title: 'Conquistas',
      subtitle: 'Bata todas as metas e alcance um novo patamar.',
      description: 'Sistema de gamificação com desafios semanais, mensais e muito mais.',
      footer: 'Desbloquei conquistas ao cumprimento tarefas esportivas e subir de nível',
      class: ['w-[23rem]', 'h-[15rem]', 'feature-card'],
      icon: 'fas fa-medal',
      style: {
         backgroundImage: "url('/img/futebol/football.jpg')",
         backgroundSize: 'cover',
         backgroundPosition: 'center',
      },
   },
];
//RESGATAR ITEM RECEBIDO
const cardFeature = features.find(f => f.type === props.feature);

</script>

<template>
   <Card
      class="feature-card relative !shadow-md inset-shadow-sm cursor-pointer transition-all duration-300 hover:scale-102"
      :class="cardFeature.class"
      :style="cardFeature.style"
   >
      <template #content>
         <div class="feature-text flex flex-1 flex-col justify-between items-center gap-5">
            <!-- TITLE -->
            <h3 class="text-xl">{{ cardFeature.title }}</h3>
            <!-- PREVIEW ICON -->
            <div class="feature-preview">
               <small class="text-center mb-3">{{ cardFeature.subtitle }}</small>
               <i :class="['text-5xl mt-3', cardFeature.icon]"></i>
            </div>
            <!-- DESCRIPTION -->
            <small class="feature-description text-center font-medium">{{ cardFeature.description }}</small>
            <!-- FOOTER TEXT -->
            <small class="feature-footer text-center">{{ cardFeature.footer }}</small>
         </div>
         <!-- OVERLAY -->
         <div :class="['rounded-lg feature-overlay', `feature-${cardFeature.type}`]"></div>
      </template>
   </Card>
</template>
<style scoped>
/* BASES */

.feature-overlay {
  position: absolute;
  inset: 0;
  pointer-events: none;
  z-index: 1;
  overflow: hidden;
}

.feature-overlay::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  border-radius: 50%;
  transform: translate(-50%, -50%);
  transition: width 0.3s ease, height 0.3s ease, opacity 0.4s;
  opacity: 0.9;
}

:deep(.p-card-body) {
  flex: 1;
  display: flex;
  flex-direction: column;
  position: relative;
  overflow: hidden; /* importante */
}

.feature-card :deep(.p-card-body)::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 150%;
  height: 150%;
  background: #fff;
  border-radius: 50%;
  transform: translate(-50%, -50%) scale(1);
  transition: transform 0.6s ease, opacity 0.4s ease;
  z-index: 0;
}

.feature-card :deep(.p-card-content) {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.feature-text > h3, .feature-preview, .feature-descrition, .feature-footer{
   z-index: 10;
}

.feature-preview {
   display: flex;
   flex: 1;
   flex-direction: column;
   justify-content: center;
   align-items: center;
}

.feature-description {
   display: none;
   flex: 1;
   flex-direction: column;
   justify-content: center;
   align-items: center;
}

/* HOVER EFFECTS*/

.feature-card:hover :deep(.p-card-body)::before {
  transform: translate(-50%, -50%) scale(2.5);
  opacity: 0.8;
}

.feature-card:hover .feature-overlay::before {
  width: 200%;
  height: 200%;
}

.feature-card:hover .feature-text {
   color: var(--blue-500);
}

.feature-card:hover .feature-preview {
   display: none;
}

.feature-card:hover .feature-description {
   display: flex;
   z-index: 10;
}

.feature-overlay::before {
   filter: blur(30px);
}

.feature-manager::before {
   background: radial-gradient(
      circle at center,
      transparent 0%,
      var(--green-300) 50%
   );
}

.feature-maps::before {
   background: radial-gradient(
      circle at center,
      transparent 0%,
      var(--blue-300) 50%
   );
}

.feature-chat::before {
   background: radial-gradient(
      circle at center,
      transparent 0%,
      var(--orange-300) 50%
   );
}

.feature-chat::before {
   background: radial-gradient(
      circle at center,
      transparent 0%,
      var(--orange-300) 50%
   );
}

.feature-notify::before {
   background: radial-gradient(
      circle at center,
      transparent 0%,
      var(--cyan-500) 50%
   );
}

.feature-custom::before {
   background: radial-gradient(
      circle at center,
      transparent 0%,
      var(--gray-300) 50%
   );
}

.feature-achievement::before {
   background: radial-gradient(
      circle at center,
      transparent 0%,
      var(--yellow-500) 50%
   );
}
</style>