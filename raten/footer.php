                <section class="contacts_info" id="contacts_info">
                    <div class="cont">
                        <div class="data">
                            <div class="block_title">Контакты</div>

                            <div class="item location">
                                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_location"></use></svg>
                                <span><?php the_field("adres", "option") ?></span>
                            </div>

                            <div class="item phone">
                                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_phone"></use></svg>
                                <a href="tel:<?php echo edit_phone(get_field("phone", "option")); ?>"><?php the_field("phone", "option") ?></a>
                            </div>

                            <div class="item email">
                                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_email"></use></svg>
                                <a href="mailto:<?php the_field("email", "option") ?>"><?php the_field("email", "option") ?></a>
                            </div>

                            <button class="order_btn modal_btn" data-content="#callback_modal">Оставить заявку</button>
                        </div>
                    </div>

                    <div class="map_wrap">
                        <div id="map"></div>
                    </div>
                </section>
            </div>


            <footer>
                <div class="info">
                    <div class="cont row">
                        <div class="copyright">&copy; 2021 План-ремонта</div>

                        <div class="socials">
                            <a href="<?php the_field("vk", "option") ?>" target="_blank" rel="noopener nofollow" class="vkontakte_link">
                                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_vkontakte"></use></svg>
                            </a>

                            <!--<a href="<?php the_field("fb", "option") ?>" target="_blank" rel="noopener nofollow" class="facebook_link">
                                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_facebook"></use></svg>
                            </a>

                            <a href="<?php the_field("inst", "option") ?>" target="_blank" rel="noopener nofollow" class="instagram_link">
                                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_instagram"></use></svg>
                            </a>-->
                        </div>
                    </div>
                </div>
            </footer>


            <div class="overlay"></div>
        </div>


        <div class="supports_error">
            Ваш браузер устарел рекомендуем обновить его до последней версии<br> или использовать другой более современный.
        </div>


        <section class="modal" id="free_measurement_modal">
            <button class="close_btn">
                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_close"></use></svg>
            </button>

            <img src="<?php echo get_template_directory_uri();?>/images/tmp/free_measurement_img.png" alt="" class="img">

            <div class="data">
                <div class="title">Запишитесь<br> на бесплатный замер</div>

                <div class="pluses">
                    <div>
                        <div class="icon">
                            <svg><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_check"></use></svg>
                        </div>
                        <span>Выезжаем в выходные дни</span>
                    </div>

                    <div>
                        <div class="icon">
                            <svg><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_check"></use></svg>
                        </div>
                        <span>Замер ни к чему не обязывает</span>
                    </div>

                    <div>
                        <div class="icon">
                            <svg><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_check"></use></svg>
                        </div>
                        <span>Точно просчитаем стоимость работ, материалов и сроки ремонта</span>
                    </div>
                </div>

                <button class="btn modal_btn" data-content="#callback_modal">Записаться на замер</button>
            </div>
        </section>


        <section class="modal" id="calc_modal">
            <div class="row">
                <div class="head">
                    <div class="title">Успейте начать ремонт<br> по старым ценам</div>

                    <div class="desc">Давайте мы за 2 минуты рассчитаем для вас стоимость ремонта?</div>
                </div>

                <form action="" class="form">
                    <div class="line area">
                        <div>Площадь помещения: <span id="calc_area_range_value">60</span> м²</div>

                        <input type="hidden" id="calc_area_range" name="calc_area_range" value="">
                    </div>

                    <div class="line row">
                        <div class="label">Вид ремонта</div>

                        <div class="field">
                            <select name="type">
                                <option value="Выберите вариант" selected>Выберите вариант</option>
                                <option value="Косметический" >Косметический</option>
                                <option value="Капитальный">Капитальный</option>
                                <option value="Дизайнерский">Дизайнерский</option>
                                <option value="Другое">Другое</option>
                            </select>

                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_select_arrow"></use></svg>
                        </div>
                    </div>

                    <div class="line row">
                        <div class="label">количество<br> комнат</div>

                        <div class="field">
                            <select name="room">
                                <option value="Выберите вариант" selected>Выберите вариант</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>

                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_select_arrow"></use></svg>
                        </div>
                    </div>

                    <div class="line row">
                        <div class="label">Введите<br> Ваш телефон</div>

                        <div class="field">
                            <input type="tel" name="phone" value="" class="input required" required data-parsley-no-focus placeholder="+7 (___) ___-__-__">
                        </div>
                    </div>

                    <div class="submit">
                        <button type="submit" class="submit_btn">Рассчитать</button>
                    </div>

                    <div class="agree">Нажимая кнопку "Рассчитать", я подтверждаю, что я ознакомлен и согласен с условиями политики обработки персональных данных</div>
                    <input type="hidden" name="title" value="Рассчет стоимости">

                    <input type="hidden" name="utm_campaign" value="<?php echo $_GET["utm_campaign"]; ?>">
                    <input type="hidden" name="utm_content" value="<?php echo $_GET["utm_content"]; ?>">
                    <input type="hidden" name="utm_term" value="<?php echo $_GET["utm_term"]; ?>">
                    <input type="hidden" name="utm_medium" value="<?php echo $_GET["utm_medium"]; ?>">
                    <input type="hidden" name="utm_source" value="<?php echo $_GET["utm_source"]; ?>">
            
                </form>
            </div>

            <img data-src="<?php echo get_template_directory_uri();?>/images/tmp/bg_calc_modal.jpg" alt="" class="bg lozad">
        </section>


        <section class="modal order" id="callback_modal">
            <div class="title">Обратный звонок</div>

            <form action="" class="form">
                <div class="line row">
                    <div class="label">Введите<br> Ваше имя</div>

                    <div class="field">
                        <input type="text" name="name" value="" class="input required" required  placeholder="Александр">
                    </div>
                </div>

                <div class="line row">
                    <div class="label">Введите<br> Ваш телефон</div>

                    <div class="field">
                        <input type="tel" name="phone" value="" class="input required" required  placeholder="+7 (___) ___-__-__">
                    </div>
                </div>

                <div class="bottom">
                    <div class="submit">
                        <button type="submit" class="submit_btn">Отправить</button>
                    </div>

                    <div class="agree">Нажимая кнопку "Отправить", я подтверждаю, что я ознакомлен и согласен с условиями политики обработки персональных данных</div>
                </div>
                <input type="hidden" name="title" value="Заказ звонка">

                <input type="hidden" name="utm_campaign" value="<?php echo $_GET["utm_campaign"]; ?>">
                <input type="hidden" name="utm_content" value="<?php echo $_GET["utm_content"]; ?>">
                <input type="hidden" name="utm_term" value="<?php echo $_GET["utm_term"]; ?>">
                <input type="hidden" name="utm_medium" value="<?php echo $_GET["utm_medium"]; ?>">
                <input type="hidden" name="utm_source" value="<?php echo $_GET["utm_source"]; ?>">
            </form>
        </section>


        <section class="modal order" id="success_modal">
            <div class="title">Спасибо за заявку!<br><br> Скоро мы свяжемся с Вами!</div>            
        </section>


        <!-- Подключение javascript файлов -->
        <?php wp_footer(); ?>  
        <script src="<?php echo get_template_directory_uri();?>/js/jquery-3.5.0.min.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/lozad.min.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/swiper-bundle.min.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/inputmask.min.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/nice-select.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/ion.rangeSlider.min.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/fancybox.min.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/parsley.min.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/functions.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/scripts.js"></script>

        <!-- Яндекс карты -->
        <script src="https://api-maps.yandex.ru/2.1.75/?load=package.standard,package.geoObjects&lang=ru-RU"></script>
        <script>
            $(window).on('load', () => {
                setTimeout(() => {
                    if ($('#map').length) {
                        initMap()
                    }
                })
            })
        </script>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(87447650, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/87447650" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-216661244-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-216661244-3');
</script>
<!-- Meta Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '675561427203489');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=675561427203489&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src='https://vk.com/js/api/openapi.js?169',t.onload=function(){VK.Retargeting.Init("VK-RTRG-1276202-c6ivL"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-1276202-c6ivL" style="position:fixed; left:-999px;" alt=""/></noscript>
<!-- Calltouch request -->
<script>
jQuery(document).on('click','[type="submit"]', function() {
    var m = jQuery(this).closest('form');
    var formName = m.find('input[name*="title"]').val();
    var fio = m.find('input[name*="name"],input[type*="tel"]').val();
    var phone = m.find('input[type*="tel"],input[name*="phone"],input[data-type*="phone"]').val();
    var mail = m.find('input[name*="email"],input[name*="senderEmail"]').val();
    var ct_site_id = '48167';
    var sub = 'Заявка c '+ location.hostname;
    if(!!formName){sub = formName + ' c ' + location.hostname;}
    var ct_data = {            
        fio: fio,
        phoneNumber: phone,
        email: mail,
        subject: sub,
        requestUrl: location.href,
        sessionId: window.call_value
    };
    var ct_valid = !!fio && !!phone;
    if(formName == 'Рассчет стоимости'){ct_valid = !!phone;}
    console.log(ct_data);
    if (ct_valid&& window.ct_snd_flag != 1){
		window.ct_snd_flag = 1; setTimeout(function(){ window.ct_snd_flag = 0; }, 10000);
        jQuery.ajax({ 
          url: 'https://api.calltouch.ru/calls-service/RestAPI/requests/'+ct_site_id+'/register/',
          dataType: 'json', type: 'POST', data: ct_data, async: false
        });
    };
});
</script>
<!-- Calltouch request -->
    </body>
</html>