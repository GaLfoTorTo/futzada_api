<section id="home" class="container-fluid">
   <div class="section_1_background">
      <img src="/img/home_background.png" class="section_1_background_img">
   </div>
   <div class="container">
      <div class="row">
         <article class="col-6 col-sm-12 col-md-6 col-lg-6" data-aos="fade-right">
            <div class="section_1_article_title d-flex flex-column justify-content-center text-blue-500">
               <h1 class="fw-bold section_1_title">Eleve seu futebol</h1>
               <h1 class="fw-bold section_1_title">Para o próximo nível</h1>
               <p>Encontre partidas, organize jogos, marque pontos e aproveite uma experiência inovadora com o Futzada!</p>
            </div>
         </article>
         <article class="col-6 col-sm-12 col-md-6 col-lg-6">
            <div class="section_1_article_img px-5">
               @for($num = 1; $num <= 3; $num++)
                  <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                     @for($x = 1; $x < 3; $x++)
                        <div class="column_{{$num}}">
                           @php
                              //CONTABILIZAR QUANTIDADE DE ITEMS POR SEÇÃO
                              $arr = [];
                              if($num > 1){
                                 for($key = 1; $key <= $num; $key ++){
                                    $arr[] = $key;
                                 }
                              }else{
                                 $arr[] = $num;
                              }
                           @endphp
                           @foreach($arr as $i)
                              @php
                                 //AJUSTAR INDEX APARTIR DE SEÇÃO
                                 if($num == 2){
                                    $i = $i += 1;
                                 }elseif($num == 3){
                                    $i = $i += 3;
                                 }
                              @endphp
                              <div class="phone">
                                 <div class="screen">
                                    <img src="/img/app_{{$i}}.png">
                                 </div>
                              </div>
                           @endforeach
                        </div>
                     @endfor
                  </div>
               @endfor
            </div>
         </article>
      </div>
   </div>
</section>