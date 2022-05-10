<?php
/*
Template Name: Главная
*/
?>
<?php get_header(); ?>

<section class="first_section">
    <div class="cont">
        <div class="info tablet_min_w">
            <div class="title"><?php the_field("title1"); ?></div>

            <div class="desc"><?php the_field("subtitle1"); ?></div>

            <div class="manager">
                <div class="photo">
                    <img data-src="<?php echo get_template_directory_uri();?>/images/tmp/manager_photo.jpg" alt="" class="lozad">
                </div>

                <div>
                    <div class="name">Руслан</div>
                    <div class="post">ваш специалист-сметчик</div>
                </div>
            </div>
            
            <div class="discount"><?php the_field("skidka"); ?> на материалы при&nbsp;согласовании даты замера <?php 
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
             ?><!-- в <script>var today = new Date(); document.write(today.getHours() + ":" + today.getMinutes());</script>--></div>

        </div>


        <div class="order">
            <div class="title">Получить на 100% точную стоимость ремонта квартиры</div>

            <div class="desc">со всеми материалами уже через 30 мин</div>

            <form action="" class="form">
                <div class="line row">
                    <div class="label">Что нужно<br> отремонтировать</div>

                    <div class="field">
                        <select name="what">
                        	<option value="Выберите вариант" selected>Выберите вариант</option>
                            <option value="Квартира" >Квартира</option>
                            <option value="Дом">Дом</option>
                            <option value="Офис">Офис</option>
                            <option value="Другое">Другое</option>
                        </select>

                        <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_select_arrow"></use></svg>
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

                        <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_select_arrow"></use></svg>
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

                        <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_select_arrow"></use></svg>
                    </div>
                </div>

                <div class="line area">
                    <div>Площадь помещения: <span id="area_range_value">60</span> м²</div>

                    <input type="hidden" id="area_range" name="area_range" value="">
                </div>

                <!-- <div class="line duration">
                    Срок работ <b>от 20 до 35 дней</b>
                </div> -->

                <div class="line row">
                    <div class="label">Введите<br >Ваш телефон</div>

                    <div class="field">
                        <input type="tel" name="phone" value="" class="input required" required  placeholder="+7 (___) ___-__-__">
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

    <img data-src="<?php echo get_template_directory_uri();?>/images/tmp/bg_first_section.jpg" alt="" class="bg lozad">
</section>


<section class="advantages">
    <div class="cont">
        <div class="row">
            <?php if( have_rows('preimushhestva') ): ?>
                <?php while( have_rows('preimushhestva') ): the_row(); 
                    $icon = get_sub_field('icon');
                    $desc = get_sub_field('desc');
                    ?>
                    <div class="item">
                        <div class="icon">
                            <img data-src="<?php echo $icon; ?>" alt="" class="lozad">
                        </div>

                        <div class="name"><?php echo $desc; ?></div>

                        <div class="overlay"><button class="order_btn modal_btn" data-content="#callback_modal">Оставить заявку</button></div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>            
        </div>
    </div>
</section>


<section class="plan" id="plan">
    <div class="cont row">
        <div class="image">
            <img src="<?php echo get_template_directory_uri();?>/images/plan_img.png" alt="">
        </div>

        <div class="data">
            <div class="block_title"><?php the_field("title2"); ?></div>

            <div class="items">
                <?php if( have_rows('plan') ): ?>
                <?php while( have_rows('plan') ): the_row(); 
                    $icon = get_sub_field('icon');
                    $desc = get_sub_field('desc');
                    $title = get_sub_field('title');
                    ?>
                <div class="item">
                    <div class="icon">
                        <img data-src="<?php echo $icon; ?>" alt="" class="lozad">

                        <div class="check">
                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_check"></use></svg>
                        </div>
                    </div>

                    <div>
                        <div class="name"><?php echo $title; ?></div>

                        <div class="desc"><?php echo $desc; ?></div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>    

            </div>

            <button class="order_btn modal_btn" data-content="#callback_modal">Да, я хочу ремонт по плану</button>
        </div>
    </div>

    <img src="<?php echo get_template_directory_uri();?>/images/plan_bg_text.svg" alt="" class="lozad bg_text">
</section>
<section class="сertificate" id="certificate">
    <div class="cont row">
        <div class="image">
            <img src="/wp-content/uploads/2022/05/diplom-luchshaya-kompaniya-1-scaled.jpg" alt="">
        </div>

        <div class="data">
            <div class="block_title"><b>Лучшая</b><br> компания по ремонту квартир по версии Российского Строительного Олимпа</div>

        </div>
    </div>
</section>

<section class="quality_control" id="quality_control">
    <div class="cont">
        <div class="block_head">
            <div class="title"><?php the_field("title3"); ?></div>

            <div class="desc"><?php the_field("subtitle3"); ?></div>
        </div>

        <div class="row">
            <?php if( have_rows('sotrudniki') ): ?>
            <?php while( have_rows('sotrudniki') ): the_row(); 
                $dolzhnost = get_sub_field('dolzhnost');
                $desc = get_sub_field('desc');
                $name = get_sub_field('name');
                $foto = get_sub_field('foto');
                ?>
            <div class="person">
                <div class="photo">
                    <img data-src="<?php echo $foto; ?>" alt="" class="lozad">
                </div>

                <div class="info">
                    <div class="name"><?php echo $name; ?></div>
                    <div class="post"><?php echo $dolzhnost; ?></div>

                    <div class="desc"><?php echo $desc; ?></div>

                    <button class="order_btn modal_btn" data-content="#callback_modal">Оставить заявку</button>
                </div>


            </div>
            <?php endwhile; ?>
            <?php endif; ?>    

        </div>
    </div>

    <img src="<?php echo get_template_directory_uri();?>/images/quality_control_bg_text.svg" alt="" class="lozad bg_text">
</section>


<section class="tariffs" id="tariffs">
    <div class="cont">
        <div class="block_head center white">
            <div class="title">Цена</div>
        </div>

        <div class="row">
            <?php if( have_rows('czeny') ): ?>
            <?php while( have_rows('czeny') ): the_row(); 
                $name = get_sub_field('name');
                $desc = get_sub_field('desc');
                $price = get_sub_field('price');
                $spisok_rabot = get_sub_field('spisok_rabot');
                ?>
            <div class="tariff">
                <div class="head">
                    <div class="name"><?php echo $name; ?></div>

                    <div class="desc"><?php echo $desc; ?></div>

                    <div class="price">От <b><?php echo $price; ?></b> руб/м²</div>
                </div>

                <div class="list">
                    <div class="title">список работ</div>

                    <div class="items">
                        <?php $k=0; if($spisok_rabot) { foreach ($spisok_rabot as $value) { $k++;?>   
                        <div class="item">
                            <div class="work <?php if($k==1) {echo "active";} ?>" >
                                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_arrow_right"></use></svg>
                                <span><?php echo $value["name"]; ?></span>
                            </div>

                            <div class="sub"  <?php if($k==1) { ?>style="display: block;" <?php } ?>>
                                <?php if($value["vklyuchennye_raboty"]) { foreach ($value["vklyuchennye_raboty"] as $val) { ?>
                                    <div><?php echo $val["name"]; ?></div>
                                <?php }} ?>
                                
                            </div>
                        </div>
                        <?php } }  ?>
                    </div>

                    <button class="order_btn modal_btn" data-content="#callback_modal">Заказать</button>
                </div>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>   
        </div>


        <div class="calc" id="calc">
            <div class="data">
                <div class="block_title"><b>Калькулятор<br> стоимости</b> ремонта</div>

                <div class="btns">
                    <a href="#popup:marquiz_61cbf15bc0b41d003feb2432" class="btn">Рассчитать</a>

                    <a href="https://wa.me/79260123881?text=%D0%94%D0%BE%D0%B1%D1%80%D1%8B%D0%B9%20%D0%B4%D0%B5%D0%BD%D1%8C!%20%D0%A3%20%D0%BC%D0%B5%D0%BD%D1%8F%20%D0%B5%D1%81%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BF%D0%BE%D0%B2%D0%BE%D0%B4%D1%83%20%D1%80%D0%B5%D0%BC%D0%BE%D0%BD%D1%82%D0%B0" class="btn white">
                        <img src="<?php echo get_template_directory_uri();?>/images/ic_whatsapp.png" alt="">
                        <span>Написать в WhatsApp и обсудить проект</span>
                    </a>
                </div>
            </div>

            <div class="manager">
                <div class="photo">
                    <img src="<?php echo get_template_directory_uri();?>/images/tmp/manager_photo2.png" alt="">
                </div>

                <div class="message"><b>Здравствуйте, меня зовут Ярослав</b><br> Давайте узнаем стоимость Вашего ремонта в компании</div>
            </div>

            <img data-src="<?php echo get_template_directory_uri();?>/images/tariffs_bg_text.svg" alt="" class="lozad bg_text">
        </div>
    </div>

    <img data-src="<?php echo get_template_directory_uri();?>/images/tmp/bg_tariffs.png" alt="" class="bg lozad">
</section>


<section class="portfolio tabs_container" id="portfolio">
    <div class="cont">
        <div class="head">
            <div class="block_title">Портфолио</div>

            <div class="tabs">
                <button data-content="#level1_tab1" data-level="level1" class="active">Новостройка</button>
                <button data-content="#level1_tab2" data-level="level1">Вторичка</button>
            </div>
        </div>

        <div class="tab_content level1 active tabs_container" id="level1_tab1">
            <div class="tabs">
                <?php $k=0; if( have_rows('novostrojki') ): ?>
                <?php while( have_rows('novostrojki') ): the_row(); 
                    $metrazh = get_sub_field('metrazh'); $k++;
                    ?>
                <button data-content="#level2_tab1_<?php echo $k; ?>" data-level="level2" <?php if($k==1) { ?>class="active" <?php } ?>><?php echo $metrazh; ?>м²</button>
                <?php endwhile; ?>
                <?php endif; ?>   
            </div>

            <?php $k=0; if( have_rows('novostrojki') ): ?>
            <?php while( have_rows('novostrojki') ): the_row(); 
                $gallery = get_sub_field('gallery');
                $parametry = get_sub_field('parametry');
                $name = get_sub_field('name'); $k++;
                ?>
            <div class="tab_content level2 <?php if($k==1) { ?>active<?php } ?>" id="level2_tab1_<?php echo $k; ?>">
                <div class="portfolio_item">
                    <div class="data">
                        <div class="name"><?php echo $name; ?></div>

                        <div class="rating">
                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_star"></use></svg>
                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_star"></use></svg>
                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_star"></use></svg>
                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_star"></use></svg>
                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_star"></use></svg>
                        </div>

                        <div class="features">
                            <?php foreach ($parametry as $value) { ?>  
                            <div>
                                <b><?php echo $value["name"]; ?>:</b>
                                <span><?php echo $value["desc"]; ?></span>
                            </div>
                            <?php } ?>
                        </div>

                        <button class="consult_btn modal_btn" data-content="#callback_modal">Консультация</button>
                    </div>

                    <div class="slider">
                        <div class="big">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <?php foreach ($gallery as $value) { ?>    
                                    <div class="slide swiper-slide">
                                        <div class="image">
                                            <img data-src="<?php echo $value["sizes"]["gallery_big"] ?>" alt="" class="lozad">
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>

                                <div class="swiper-button-prev">
                                    <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_slider_arrow"></use></svg>
                                </div>

                                <div class="swiper-button-next">
                                    <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_slider_arrow"></use></svg>
                                </div>
                            </div>
                        </div>

                        <div class="thumbs">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">

                                    <?php foreach ($gallery as $value) { ?>     
                                    <div class="slide swiper-slide">
                                        <div class="image">
                                            <img data-src="<?php echo $value["sizes"]["gallery_small"] ?>" alt="" class="lozad">
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>


        <div class="tab_content level1 tabs_container" id="level1_tab2">
            <div class="tabs">
                <?php $k=0; if( have_rows('vtorichka') ): ?>
                <?php while( have_rows('vtorichka') ): the_row(); 
                    $metrazh = get_sub_field('metrazh'); $k++;
                    ?>
                <button data-content="#level2_tab2_<?php echo $k; ?>" data-level="level2" <?php if($k==1) { ?>class="active" <?php } ?>><?php echo $metrazh; ?>м²</button>
                <?php endwhile; ?>
                <?php endif; ?>   
            </div>


            <?php $k=0; if( have_rows('vtorichka') ): ?>
            <?php while( have_rows('vtorichka') ): the_row(); 
                $gallery = get_sub_field('gallery');
                $parametry = get_sub_field('parametry');
                $name = get_sub_field('name'); $k++;
                ?>
            <div class="tab_content level2 <?php if($k==1) { ?>active<?php } ?>" id="level2_tab2_<?php echo $k; ?>">
                <div class="portfolio_item">
                    <div class="data">
                        <div class="name"><?php echo $name; ?></div>

                        <div class="rating">
                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_star"></use></svg>
                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_star"></use></svg>
                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_star"></use></svg>
                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_star"></use></svg>
                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_star"></use></svg>
                        </div>

                        <div class="features">
                            <?php foreach ($parametry as $value) { ?>  
                            <div>
                                <b><?php echo $value["name"]; ?>:</b>
                                <span><?php echo $value["desc"]; ?></span>
                            </div>
                            <?php } ?>
                        </div>

                        <button class="consult_btn modal_btn" data-content="#callback_modal">Консультация</button>
                    </div>

                    <div class="slider">
                        <div class="big">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <?php foreach ($gallery as $value) { ?>     
                                    <div class="slide swiper-slide">
                                        <div class="image">
                                            <img data-src="<?php echo $value["sizes"]["gallery_big"] ?>" alt="" class="lozad">
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>

                                <div class="swiper-button-prev">
                                    <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_slider_arrow"></use></svg>
                                </div>

                                <div class="swiper-button-next">
                                    <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_slider_arrow"></use></svg>
                                </div>
                            </div>
                        </div>

                        <div class="thumbs">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">

                                    <?php foreach ($gallery as $value) { ?>     
                                    <div class="slide swiper-slide">
                                        <div class="image">
                                            <img data-src="<?php echo $value["sizes"]["gallery_small"] ?>" alt="" class="lozad">
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

    <img src="<?php echo get_template_directory_uri();?>/images/portfolio_bg_text.svg" alt="" class="lozad bg_text">
</section>


<section class="credit">
    <div class="cont row">
        <div class="image">
            <img src="<?php echo get_template_directory_uri();?>/images/tmp/credit_img.png" alt="">

            <div class="text">
                <p>План Ремонта не оказывает финансовые и Банковские услуги самостоятельно. Услуги по предоставлению кредита или рассрочки предоставляются Банками РФ в соответствии с законодательством РФ. Условия предоставления рассрочки без процентов или кредитные условия индивидуально рассчитываются банками исходя из требований законодательства, документов и иных условий.</p>

                <p>План Ремонта не принимает решение и не несет ответственности за решения, принятые банком относительно физического лица. Информация о финансовых услугах, указанная на сайте, не является публичной офертой.</p>
            </div>
        </div>


        <div class="data">
            <div class="head">
                <div class="block_title">Выгодная<br> рассрочка</div>
                <div class="percents"><b>0</b>%</div>
            </div>

            <button class="order_btn modal_btn" data-content="#callback_modal">Оставить заявку на рассрочку</button>

            <div class="pluses">
                <div>
                    <div class="icon">
                        <svg><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_check"></use></svg>
                    </div>
                    <span>Без первоначального взноса</span>
                </div>

                <div>
                    <div class="icon">
                        <svg><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_check"></use></svg>
                    </div>
                    <span>Незаметно для семейного бюджета</span>
                </div>

                <div>
                    <div class="icon">
                        <svg><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_check"></use></svg>
                    </div>
                    <span>Оформление в офисе за 20 минут</span>
                </div>

                <div>
                    <div class="icon">
                        <svg><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_check"></use></svg>
                    </div>
                    <span>Сроком до 12 месяцев</span>
                </div>
            </div>
        </div>
    </div>

    <img src="<?php echo get_template_directory_uri();?>/images/credit_bg_text.svg" alt="" class="lozad bg_text">
</section>


<section class="bonuses" id="bonuses">
    <div class="cont row">
        <div class="block_head">
            <div class="title"><span>Бонусы</span> от План Ремонта</div>

            <div class="desc">Выбери 6 сервисов<br> вместо скидки</div>
        </div>

        <div class="swiper-container">
            <div class="swiper-wrapper">

                <?php if( have_rows('bonusy') ): ?>
                <?php while( have_rows('bonusy') ): the_row(); 
                    $name = get_sub_field('name');
                    $foto = get_sub_field('foto');
                    ?>
                <div class="slide swiper-slide">
                    <button class="item modal_btn" data-content="#callback_modal">
                        <div class="thumb">
                            <img data-src="<?php  echo $foto["sizes"]["bonus"]; ?>" alt="" class="lozad">
                            <div class="overlay"><div>Оставить заявку</div></div>
                        </div>
                        <div class="name"><?php echo $name; ?></div>
                    </button>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>   

            </div>

            <div class="swiper-button-prev">
                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_slider_arrow"></use></svg>
            </div>

            <div class="swiper-button-next">
                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_slider_arrow"></use></svg>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </div>

    <img src="<?php echo get_template_directory_uri();?>/images/bonuses_bg_text.svg" alt="" class="lozad bg_text">
</section>


<section class="objects" id="objects">
    <div class="cont">
        <div class="block_head white">
            <div class="title">Сейчас мы работаем<br> <span>на объектах</span></div>
        </div>

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php if( have_rows('raboty') ): ?>
                <?php while( have_rows('raboty') ): the_row(); 
                    $logotip = get_sub_field('logotip');
                    $foto = get_sub_field('foto');
                    $nazvanie = get_sub_field('nazvanie');
                    $adres = get_sub_field('adres');
                    $opisanie = get_sub_field('opisanie');
                    $foto_mastera = get_sub_field('foto_mastera');
                    $imya_mastera = get_sub_field('imya_mastera');
                    $czitata = get_sub_field('czitata');
                    ?>
                <div class="slide swiper-slide">
                    <div class="object">
                        <div class="thumb">
                            <img data-src="<?php echo $foto["sizes"]["job"]; ?>" alt="" class="lozad">

                            <div class="logo">
                                <img data-src="<?php echo $logotip["sizes"]["logo"]; ?>" alt="" class="lozad">
                            </div>
                        </div>

                        <div class="info">
                            <div class="object_name"><?php echo $nazvanie; ?></div>

                            <div class="location">
                                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_location"></use></svg>
                                <span><?php echo $adres; ?></span>
                            </div>

                            <div class="desc"><?php echo $opisanie; ?></div>

                            <div class="manager">
                                <div class="photo">
                                    <img data-src="<?php echo $foto_mastera["sizes"]["photo"]; ?>" alt="" class="lozad">
                                </div>

                                <div>
                                    <div class="name"><?php echo $imya_mastera; ?></div>
                                    <div class="exp"><?php echo $czitata; ?></div>
                                </div>
                            </div>

                            <button class="order_btn modal_btn" data-content="#callback_modal">Оставить заявку</button>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>   

            </div>

            <div class="swiper-button-prev">
                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_slider_arrow"></use></svg>
            </div>

            <div class="swiper-button-next">
                <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_slider_arrow"></use></svg>
            </div>
        </div>


        <div class="confidence" id="confidence">
            <div class="block_head white">
                <div class="title">Почему нам доверили ремонт <span>2750 человек за 5 лет</span></div>
            </div>

            <div class="manager">
                <div class="message">
                    <b>Предлагаем посмотреть лично на процесс ремонта</b><br> Показываем объекты на разных этапах работ. Оцените качество работ, уровень мастеров, задайте вопросы по своему ремонту
                </div>

                <div class="photo">
                    <img data-src="<?php echo get_template_directory_uri();?>/images/tmp/manager_photo2.jpg" alt="" class="lozad">
                </div>

                <div>
                    <div class="name">Никоноров Евгений</div>
                    <div class="post">Главный инженер</div>
                </div>
            </div>

            <img src="<?php echo get_template_directory_uri();?>/images/confidence_bg_text.svg" alt="" class="lozad bg_text">
        </div>


        <div class="order">
            <div class="data">
                <div class="title">Запишитесь<br> на просмотр объекта</div>

                <div action="" class="form">
                    <div class="line row">
                        <div class="label">Выберите район Москвы</div>

                        <div class="field">
                            <select name="">
                            	<option value="Выберите вариант" selected>Выберите вариант</option>
                                <option value="Центральный административный округ">Центральный административный округ</option>
                                <option value="Северный административный округ">Северный административный округ</option>
                                <option value="Северо-Восточный административный округ">Северо-Восточный административный округ</option>
                                <option value="Восточный административный округ">Восточный административный округ</option>
                                <option value="Юго-Восточный административный округ">Юго-Восточный административный округ</option>
                                <option value="Южный административный округ">Южный административный округ</option>
                                <option value="Юго-Западный административный округ">Юго-Западный административный округ</option>
                                <option value="Западный административный округ">Западный административный округ</option>
                                <option value="Северо-Западный административный округ">Северо-Западный административный округ</option>
                                <option value="Зеленоградский административный округ">Зеленоградский административный округ</option>
                                <option value="Новомосковский административный округ">Новомосковский административный округ</option>
                            </select>

                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_select_arrow"></use></svg>
                        </div>
                    </div>

                    <div class="line row">
                        <div class="label">Какие этапы работ интересны?</div>

                        <div class="field">
                            <select name="">
                            	<option value="Выберите вариант" selected>Выберите вариант</option>
                                <option value="Подготовительный этап (демонтаж)">Подготовительный этап (демонтаж)</option>
                                <option value="Черновая отделка">Черновая отделка</option>
                                <option value="Предчистовая отделка">Предчистовая отделка</option>
                                <option value="Чистовая отделка">Чистовая отделка</option>
                            </select>

                            <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_select_arrow"></use></svg>
                        </div>
                    </div>

                    <div class="submit">
                        <button type="submit" class="submit_btn  modal_btn" data-content="#callback_modal">Записаться на просмотр</button>
                    </div>

                    <div class="exp">*Показываем объекты только с согласия клиентов</div>
                </div>
            </div>


            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php 
                    $images = get_field('gallery');
                    if( $images ): ?>
                    <?php foreach( $images as $image ): ?>

                    <div class="slide swiper-slide">
                        <div class="image">
                            <img data-src="<?php echo esc_url($image['sizes']['gallery']); ?>" alt="" class="lozad">
                        </div>
                    </div>
                    <?php endforeach; ?>                        
                    <?php endif; ?>

                </div>

                <div class="swiper-button-prev">
                    <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_slider_arrow"></use></svg>
                </div>

                <div class="swiper-button-next">
                    <svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_slider_arrow"></use></svg>
                </div>
            </div>
        </div>
    </div>

    <img data-src="<?php echo get_template_directory_uri();?>/images/tmp/bg_objects.jpg" alt="" class="bg lozad">
</section>


<section class="guarantees" id="guarantees">
    <div class="cont row">
        <div class="image">
            <img src="<?php echo get_template_directory_uri();?>/images/tmp/guarantees_img.png" alt="">
        </div>

        <div class="data">
            <div class="block_title"><b>Гарантии</b><br> и ответственность</div>

            <div class="desc">
                <div><b>Даем гарантию на все работы 3 года</b></div>
                <div>Мы работаем от одного юр. лица по фактическому адресу</div>
            </div>

            <!-- <div class="download_link">
                <a href="/">
                    <img src="<?php echo get_template_directory_uri();?>/images/ic_pdf.svg" alt="" class="icon">
                    <span>Свидетельство СРО</span>
                </a>
            </div> -->

            <div class="boss">
                <div class="name">Симаков Эрнест Альбертович </div>
                <div class="post">Генеральный директор</div>
            </div>

            <button class="feedback_btn modal_btn" data-content="#callback_modal">Написать</button>
        </div>
    </div>

    <img src="<?php echo get_template_directory_uri();?>/images/guarantees_bg_text.svg" alt="" class="lozad bg_text">
</section>



<!-- <section class="team" id="team">
    <div class="cont">
        <div class="block_head center">
            <div class="title">Команда</div>
        </div>

        <img src="<?php echo get_template_directory_uri();?>/images/tmp/team_img.png" alt="">
    </div>
</section> -->
<style>
    @media print, (max-width: 767px)
    {
        .wrap{
            min-width: auto;
        }
    }
    
</style>

<?php get_footer(); ?>