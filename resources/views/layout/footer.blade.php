<footer>
   <div class="container">
      <div class="row">
         <div class="col-5 d-flex align-items-center">
            <img class="icone_footer" src="/img/icone.png" alt="">
            <h4 class="fw-bold text-blue-500">Futzada</h4>
         </div>
         <div class="col-7">
            <div class="col-4"></div>
            <div class="col-4"></div>
            <div class="col-4"></div>
         </div>
      </div>
   </div>
</footer>
{{-- Jquery --}}
<script src="plugins/jquery/jquery.min.js"></script>
{{-- Bootstrap --}}
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
{{-- AOS --}}
<script src="plugins/aos/js/aos.min.js"></script>
{{-- Animations Js --}}
<script src="/js/animation.js"></script>
<script>
   /* FEATURES */
   //ALTERAR IMAGEM OU VIDEO DO WIDGET DE CELULAR
   $(document).on('click','.btn_feature', function(){
      //RESGATAR ID DO COLLAPSE
      var targetCollapse = $(this).data('bs-target'); 
      //RESGATAR FEATURE
      let feature = targetCollapse.split('_')[1];
      //DELAY PARA TROCA DE IMAGENS
      setTimeout(() => {
            //VERIFICAR SE ESTA ABRINDO OU FECHANDO COLLAPSE
            if($(targetCollapse).hasClass('show')){
               $('.feature_celular').fadeOut(200, function(){
                  $(this).attr('src', '/img/app_1.png');
                  $(this).fadeIn(200);
               });
            }else{
               $('.feature_celular').fadeOut(200, function(){
                  $(this).attr('src', '/img/splash.png');
                  $(this).fadeIn(200);
               });
            }
      }, 500);
   });
   /* MODALITY */
   //TOOGLE ACTIVE
   $(document).on('click','.modality_item', function(){
      //RESGATAR MODALIDADE
      let modality = $(this).data('modality');
      //REMOVER CLASSE ACTIVE DE TODOS OS ITENS
      $('.modality_item').removeClass('active');
      //ADICIONAR NO ITEM CLICADO
      $(this).addClass('active');
      //ALTERAR TEMA DA PAGINA PARA MODALIDADE ESCOLHIDA
      /* $('#navbar').removeClass('bg-futebol bg-basketball bg-volleyball').addClass(`bg-${modality}`);
      $('#home').css({'background-image':`url('/img/${modality}/home_background_${modality}.png')`});
      $('#features').css({'background-image':`url('/img/${modality}/feature_background_${modality}.png')`}); */
      $('#modality').css({'background-image':`url('/img/${modality}/modality_background_${modality}.png')`});
   });
</script>