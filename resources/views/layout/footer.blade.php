<footer>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script>
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
    </script>
</footer>