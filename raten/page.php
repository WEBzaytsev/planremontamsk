<?php get_header(); ?>

<section class="first_section">
    <div class="cont">
        <div class="info tablet_min_w">
            <div class="title"><?php the_field("title1", 2); ?></div>

            <div class="desc"><?php the_field("subtitle1", 2); ?></div>

            <div class="discount"><?php the_field("skidka", 2); ?> при согласовании даты замера <?php 
             $arr = [
                  'января',
                  'февраля',
                  'марта',
                  'апреля',
                  'мая',
                  'июня',
                  'июля',
                  'августа',
                  'сентября',
                  'октября',
                  'ноября',
                  'декабря'
                ];

                // Поскольку от 1 до 12, а в массиве, как мы знаем, отсчет идет от нуля (0 до 11),
                // то вычитаем 1 чтоб правильно выбрать уже из нашего массива.

                $month = date('n')-1;
                echo date('d')." ".$arr[$month];
             ?> в <script>var today = new Date(); document.write(today.getHours() + ":" + today.getMinutes());</script></div>

            <div class="manager">
                <div class="photo">
                    <img data-src="<?php bloginfo('template_url'); ?>/images/tmp/manager_photo.jpg" alt="" class="lozad">
                </div>

                <div>
                    <div class="name">Руслан</div>
                    <div class="post">ваш специалист-сметчик</div>
                </div>
            </div>
        </div>


        <div class="order">
            <div class="title">Получить на 100% точную стоимость ремонта квартиры</div>

            <div class="desc">со всеми материалами уже через 30 мин?</div>

            <form action="" class="form">
                <div class="line row">
                    <div class="label">Что нужо<br> отремонтировать</div>

                    <div class="field">
                        <select name="what">
                        	<option value="Выберите вариант" selected>Выберите вариант</option>
                            <option value="Квартира" >Квартира</option>
                            <option value="Дом">Дом</option>
                            <option value="Офис">Офис</option>
                            <option value="Другое">Другое</option>
                        </select>

                        <svg class="icon"><use xlink:href="<?php bloginfo('template_url'); ?>/images/sprite.svg#ic_select_arrow"></use></svg>
                    </div>
                </div>

                <div class="line row">
                    <div class="label">Вид ремонта</div>

                    <div class="field">
                        <select name="type">
                        	<option value="Выберите вариант" selected>Выберите вариант</option>
                            <option value="Косметический">Косметический</option>
                            <option value="Капитальный">Капитальный</option>
                            <option value="Дизайнерский">Дизайнерский</option>
                            <option value="Другое">Другое</option>
                        </select>

                        <svg class="icon"><use xlink:href="<?php bloginfo('template_url'); ?>/images/sprite.svg#ic_select_arrow"></use></svg>
                    </div>
                </div>

                <div class="line row">
                    <div class="label">Тип Дома</div>

                    <div class="field">
                        <select name="home">
                        	<option value="Выберите вариант" selected>Выберите вариант</option>
                            <option value="Новостройка">Новостройка</option>
                            <option value="Вторичка">Вторичка</option>
                        </select>

                        <svg class="icon"><use xlink:href="<?php bloginfo('template_url'); ?>/images/sprite.svg#ic_select_arrow"></use></svg>
                    </div>
                </div>

                <div class="line area">
                    <div>Площадь помещения</div>

                    <input type="hidden" id="area_range" name="area_range" value="">
                </div>

                <div class="line duration">
                    Срок работ <b>от 20 до 35 дней</b>
                </div>

                <div class="line row">
                    <div class="label">Введите<br >Ваш телефон</div>

                    <div class="field">
                        <input type="tel" name="phone" value="" class="input required" required  placeholder="+ 7 (954) 12 - 09 - 841">
                    </div>
                </div>

                <div class="bottom">
                    <div class="submit">
                        <button type="submit" class="submit_btn">Рассчитать стоимость в 1 клик</button>
                    </div>

                    <div class="agree">Нажимая кнопку "ЗАКАЗАТЬ", я подтверждаю, что я ознакомлен и согласен с условиями политики обработки персональных данных</div>
                </div>
                <input type="hidden" name="title" value="Рассчет стоимости">

                <input type="hidden" name="utm_campaign" value="<?php echo $_GET["utm_campaign"]; ?>">
                <input type="hidden" name="utm_content" value="<?php echo $_GET["utm_content"]; ?>">
                <input type="hidden" name="utm_term" value="<?php echo $_GET["utm_term"]; ?>">
                <input type="hidden" name="utm_medium" value="<?php echo $_GET["utm_medium"]; ?>">
                <input type="hidden" name="utm_source" value="<?php echo $_GET["utm_source"]; ?>">
            </form>
        </div>
    </div>

    <img data-src="<?php bloginfo('template_url'); ?>/images/tmp/bg_first_section.jpg" alt="" class="bg lozad">
</section>


<!-- <section class="first_section">
    <div class="cont">
        <div class="info min_margin">
            <div class="title">Ремонт квартиры под ключ за 45 дней</div>

            <div class="desc">Ответьте на несколько вопросов прямо сейчас и получите стоимость ремонта квартиры</div>

            <div class="you_get">
                <div class="title">Сразу после теста Вы получите:</div>

                <div class="item">
                    <div class="icon">
                        <img data-src="<?php bloginfo('template_url'); ?>/images/ic_you_get1.svg" alt="" class="lozad">
                    </div>
                    <div>Стоимость ремонта квартиры<br> <b>по вашим параметрам</b></div>
                </div>

                <div class="item">
                    <div class="icon">
                        <img data-src="<?php bloginfo('template_url'); ?>/images/ic_you_get2.svg" alt="" class="lozad">
                    </div>
                    <div>Пример сметы <b>на ремонт<br> квартиры</b></div>
                </div>

                <div class="item">
                    <div class="icon">
                        <img data-src="<?php bloginfo('template_url'); ?>/images/ic_you_get3.svg" alt="" class="lozad">
                    </div>
                    <div>Дизайн-проект<br> <b>в подарок</b></div>
                </div>
            </div>

            <button class="btn modal_btn" data-content="#callback_modal">Узнать стоимость</button>
        </div>
    </div>

    <img data-src="<?php bloginfo('template_url'); ?>/images/tmp/bg_first_section.jpg" alt="" class="bg lozad">
</section> -->

<!-- Marquiz script start -->
<script>
(function(w, d, s, o){
  var j = d.createElement(s); j.async = true; j.src = '//script.marquiz.ru/v2.js';j.onload = function() {
    if (document.readyState !== 'loading') Marquiz.init(o);
    else document.addEventListener("DOMContentLoaded", function() {
      Marquiz.init(o);
    });
  };
  d.head.insertBefore(j, d.head.firstElementChild);
})(window, document, 'script', {
    host: '//quiz.marquiz.ru',
    region: 'eu',
    id: '61cbf15bc0b41d003feb2432',
    autoOpen: false,
    autoOpenFreq: 'once',
    openOnExit: false,
    disableOnMobile: false
  }
);
</script>
<!-- Marquiz script end -->
<style>
    @media print, (max-width: 767px)
    {
        .wrap{
            min-width: auto;
        }
    }
    
</style>

<section class="quiz">
    <div class="cont">
        <div class="block_head">
            <div class="title">Узнайте стоимость ремонта<br> <span>прямо сейчас</span></div>

            <div class="desc">Ответьте на 6 вопросов прямо сейчас и получите стоимость ремонта квартиры</div>
        </div>

        <div data-marquiz-id="61cbf15bc0b41d003feb2432"></div>
        <script>(function(t, p) {window.Marquiz ? Marquiz.add([t, p]) : document.addEventListener('marquizLoaded', function() {Marquiz.add([t, p])})})('Inline', {id: '61cbf15bc0b41d003feb2432', buttonText: 'Пройти тест', bgColor: '#d34085', textColor: '#ffffff', rounded: true, shadow: 'rgba(211, 64, 133, 0.5)', blicked: true, buttonOnMobile: true})</script>

    </div>
</section>


<section class="quiz">
    <div class="cont">
        <div class="block_head">
            <div class="title"><center>Видео обзоры квартир</center></div>
            

            <div class="video">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/Suqx2OtFm3I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class="video">
               <iframe width="560" height="315" src="https://www.youtube.com/embed/MF9lwwE9XuM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>        

    </div>
</section>
<?php get_footer(); ?>
