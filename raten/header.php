<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<!-- Адаптирование страницы для мобильных устройств -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<!-- Запрет распознования номера телефона -->
		<meta name="format-detection" content="telephone=no">
		<meta name="SKYPE_TOOLBAR" content ="SKYPE_TOOLBAR_PARSER_COMPATIBLE">

		<!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri();?> /images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri();?>/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_template_directory_uri();?>/images/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri();?>/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri();?>/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri();?>/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri();?>/images/favicon/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">

		<!-- Подключение шрифтов с гугла -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

		<!-- Подключение файлов стилей -->
		<!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/swiper-bundle.min.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/swiper.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ion.rangeSlider.css"> -->
		<!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/fancybox.css"> -->
		<!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/styles.css"> -->

		<!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/response_1217.css" media="print, (max-width: 1217px)">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/response_1023.css" media="print, (max-width: 1023px)">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/response_767.css" media="print, (max-width: 767px)"> -->
		<?php wp_head(); ?>
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
<!-- calltouch -->
<script type="text/javascript">
(function(w,d,n,c){w.CalltouchDataObject=n;w[n]=function(){w[n]["callbacks"].push(arguments)};if(!w[n]["callbacks"]){w[n]["callbacks"]=[]}w[n]["loaded"]=false;if(typeof c!=="object"){c=[c]}w[n]["counters"]=c;for(var i=0;i<c.length;i+=1){p(c[i])}function p(cId){var a=d.getElementsByTagName("script")[0],s=d.createElement("script"),i=function(){a.parentNode.insertBefore(s,a)},m=typeof Array.prototype.find === 'function',n=m?"init-min.js":"init.js";s.type="text/javascript";s.async=true;s.src="https://mod.calltouch.ru/"+n+"?id="+cId;if(w.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded",i,false)}else{i()}}})(window,document,"ct","znlpqgtz");
</script>
<!-- calltouch -->
	</head>

	<body>
		<div class="wrap">
			<div class="main">
				<header>
					<div class="top">
						<div class="cont">
							<nav class="menu row">
								<button class="btn scroll_btn" data-anchor="#plan">План ремонта</button>
								<button class="btn scroll_btn" data-anchor="#quality_control">Контроль качества</button>
								<button class="btn scroll_btn" data-anchor="#tariffs">Цена</button>
								<button class="btn scroll_btn" data-anchor="#calc">Калькулятор</button>
								<button class="btn scroll_btn" data-anchor="#portfolio">Портфолио</button>
								<button class="btn scroll_btn" data-anchor="#bonuses">Бонусы</button>
								<!-- <button class="btn scroll_btn" data-anchor="#confidence">Траст</button> -->
								<button class="btn scroll_btn" data-anchor="#objects">Процесс работы</button>
								<button class="btn scroll_btn" data-anchor="#guarantees">Гарантии</button>
								<!-- <button class="btn scroll_btn" data-anchor="#team">Команда</button> -->
								<button class="btn scroll_btn" data-anchor="#contacts_info">Контакты</button>
							</nav>
						</div>
					</div>

					<div class="info">
						<div class="cont row">
							<a href="<?php bloginfo('siteurl'); ?>" class="logo">
								<img src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="">
								<div>Лучшая компания по ремонту<br> квартир по версии<br> Российского Строительного Олимпа</div>
							</a>

							<div class="phone">
								<div class="time">Ежедневно с 9 00 до 21 00</div>

								<div class="number">
									<svg class="icon"><use xlink:href="<?php echo get_template_directory_uri();?>/images/sprite.svg#ic_phone"></use></svg>
									<a href="tel:<?php echo edit_phone(get_field("phone", "option")); ?>"><?php the_field("phone", "option") ?></a>
								</div>
							</div>

							<button class="callback_btn modal_btn" data-content="#callback_modal">Заказать звонок</button>
						</div>
					</div>
				</header>