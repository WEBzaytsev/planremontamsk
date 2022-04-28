<?php

define('API_USER_ID', '5d359f117a7cad304c6fdd56c335bd5a');
define('API_SECRET', '2fa0a9824eee59314435a65e1ffadea1');
define('PATH_TO_ATTACH_FILE', __FILE__);

use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;


define( 'THEME_SLUG',       'root' );
define( 'THEME_TEXTDOMAIN', 'raten');

add_theme_support('menus');

add_theme_support( 'post-thumbnails' );
function peepsakes_custom_excerpt_length( $length ) {
	return 40;
}

add_image_size( 'gallery_big', 630, 390, true);
add_image_size( 'gallery_small', 144, 89, true);
add_image_size( 'bonus', 270, 270, true);

add_image_size( 'logo', 81, 81, true);
add_image_size( 'job', 358, 250, true);
add_image_size( 'photo', 70, 70, true);

add_image_size( 'gallery', 744, 390, true);

function plural_form($number,$before) {
  $cases = array(2,0,1,1,1,2);
  echo $before[($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)]].'  '.$after[($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)]];
}

function artabr_opengraph_fix_yandex($lang) {
 $lang_prefix = 'prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#  profile: http://ogp.me/ns/profile# fb: http://ogp.me/ns/fb#"';
 $lang_fix = preg_replace('!prefix="(.*?)"!si', $lang_prefix, $lang);
 return $lang_fix;
 }
add_filter( 'language_attributes', 'artabr_opengraph_fix_yandex',20,1);

add_filter( 'disable_wpseo_json_ld_search', '__return_true' );
remove_action('wp_head','feed_links_extra', 3); // ссылки на дополнительные rss категорий
remove_action('wp_head','feed_links', 2); //ссылки на основной rss и комментарии
remove_action('wp_head','rsd_link');  // для сервиса Really Simple Discovery
remove_action('wp_head','wlwmanifest_link'); // для Windows Live Writer
remove_action('wp_head','wp_generator');  // убирает версию wordpress

remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
 
// убираем разные ссылки при отображении поста - следующая, предыдущая запись, оригинальный url и т.п.
remove_action('wp_head','start_post_rel_link',10,0);
remove_action('wp_head','index_rel_link');
remove_action('wp_head','rel_canonical');
remove_action( 'wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head','wp_shortlink_wp_head', 10, 0 );


function new_excerpt_more2($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more2');


if( function_exists('acf_add_options_page') ) {
    
    if(!current_user_can('subscriber'))
    {
     acf_add_options_page(array('page_title' => __('Опции')));
    }
}

function my_revisions_to_keep( $revisions ) {
    return 0;
}
add_filter( 'wp_revisions_to_keep', 'my_revisions_to_keep' );

/*
function new_excerpt_length($length) {
	return 10; }
add_filter('excerpt_length', 'new_excerpt_length');*/

function new_excerpt_more($excerpt) {
	return str_replace('[...]', '', $excerpt); }
add_filter('wp_trim_excerpt', 'new_excerpt_more');

function peepsakes_register_my_menus() 
{
    register_nav_menus
    (
        array( 'header-menu' => 'Главное меню', 'footer-menu' => 'Подвал', 'footer-menu-2' => 'Подвал 2', 'footer-menu-3' => 'Подвал 3')
    );
}

if (function_exists('register_nav_menus'))
{
	add_action( 'init', 'peepsakes_register_my_menus' );
}

add_filter( 'the_content_more_link', 'peepsakes_my_more_link', 10, 2 );

function peepsakes_my_more_link( $more_link, $more_link_text ) {
	return str_replace( $more_link_text, "$more_link_text", $more_link_text );
}

function nofollow_ext($matches){
 $a = $matches[0];
 $site_url = site_url();
 if (strpos($a, 'rel') === false){
 $a = preg_replace("%(href=\S(?!$site_url))%i", 'rel="nofollow" $1', $a);
 } elseif (preg_match("%href=\S(?!$site_url)%i", $a)){
 $a = preg_replace('/rel=S(?!nofollow)\S*/i', 'rel="nofollow"', $a);
 }
 return $a;
}
 
function nofollow_ext_links($content) {
 return preg_replace_callback('/<a[^>]+/', 'nofollow_ext', $content);
}
 
add_filter('the_content', 'nofollow_ext_links');



/* Подсчет количества посещений страниц 
---------------------------------------------------------- */  
add_action('wp_head', 'kama_postviews');  
function kama_postviews() {  
  
/* ------------ Настройки -------------- */  
$meta_key       = 'views';  // Ключ мета поля, куда будет записываться количество просмотров.  
$who_count      = 1;            // Чьи посещения считать? 0 - Всех. 1 - Только гостей. 2 - Только зарегистрированых пользователей.  
$exclude_bots   = 1;            // Исключить ботов, роботов, пауков и прочую нечесть :)? 0 - нет, пусть тоже считаются. 1 - да, исключить из подсчета.  
/* СТОП настройкам */  
  
global $user_ID, $post;  
    if(is_singular()) {  
        $id = (int)$post->ID;  
        static $post_views = false;  
        if($post_views) return true; // чтобы 1 раз за поток  
        $post_views = (int)get_post_meta($id,$meta_key, true);  
        $should_count = false;  
        switch( (int)$who_count ) {  
            case 0: $should_count = true;  
                break;  
            case 1:  
                if( (int)$user_ID == 0 )  
                    $should_count = true;  
                break;  
            case 2:  
                if( (int)$user_ID > 0 )  
                    $should_count = true;  
                break;  
        }  
        if( (int)$exclude_bots==1 && $should_count ){  
            $useragent = $_SERVER['HTTP_USER_AGENT'];  
            $notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - все равны Mozilla  
            $bot = "Bot/|robot|Slurp/|yahoo"; //Яндекс иногда как Mozilla представляется  
            if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )  
                $should_count = false;  
        }  
  
        if($should_count)  
            if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);  
    }  
    return true;  
}  


function wp_corenavi() {
  global $wp_query;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
  $a['mid_size'] = 0; //сколько ссылок показывать слева и справа от текущей
  $a['end_size'] = 0; //сколько ссылок показывать в начале и в конце
  $a['prev_text'] = ''; //текст ссылки "Предыдущая страница"
  $a['next_text'] = ''; //текст ссылки "Следующая страница"

  if ($max > 1) echo '<div class="pagination center">';
  if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
  echo $pages . paginate_links($a);
  if ($max > 1) echo '</div>';
}

function dimox_breadcrumbs() {

    /* === ОПЦИИ === */
    $tu = get_bloginfo('template_url');
    $text['home']     = 'Главная'; // текст ссылки "Главная"
    $text['category'] = '%s'; // текст для страницы рубрики
    $text['search']   = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
    $text['tag']      = 'Записи с тегом "%s"'; // текст для страницы тега
    $text['author']   = 'Статьи автора %s'; // текст для страницы автора
    $text['404']      = 'Ошибка 404'; // текст для страницы 404
    $text['page']     = 'Страница %s'; // текст 'Страница N'
    $text['cpage']    = 'Страница комментариев %s'; // текст 'Страница комментариев N'

    $wrap_before    = '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
    $wrap_after     = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
    $sep            = '<svg class="sep"><use xlink:href="'.$tu.'/images/sprite.svg#ic_arrow_right"></use></svg>'; // разделитель между "крошками"
    $before         = '<span class="breadcrumbs__current">'; // тег перед текущей "крошкой"
    $after          = '</span>'; // тег после текущей "крошки"

    $show_on_home   = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
    $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
    $show_current   = 1; // 1 - показывать название текущей страницы, 0 - не показывать
    $show_last_sep  = 1; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
    /* === КОНЕЦ ОПЦИЙ === */

    global $post;
    $home_url       = home_url('/');
    $link           = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link          .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
    $link          .= '<meta itemprop="position" content="%3$s" />';
    $link          .= '</span>';
    $parent_id      = ( $post ) ? $post->post_parent : '';
    $home_link      = sprintf( $link, $home_url, $text['home'], 1 );

    if ( is_home() || is_front_page() ) {

        if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;

    } else {

        $position = 0;

        echo $wrap_before;

        if ( $show_home_link ) {
            $position += 1;
            echo $home_link;
        }

        if ( is_category() ) {
            $parents = get_ancestors( get_query_var('cat'), 'category' );
            foreach ( array_reverse( $parents ) as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $cat = get_query_var('cat');
                echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_search() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $show_home_link ) echo $sep;
                echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['search'], get_search_query() ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_year() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_time('Y') . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_month() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_day() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
            $position += 1;
            echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_single() && ! is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $position += 1;
                $post_type = get_post_type_object( get_post_type() );
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
                if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                elseif ( $show_last_sep ) echo $sep;
            } else {
                $cat = get_the_category(); $catID = $cat[0]->cat_ID;
                $parents = get_ancestors( $catID, 'category' );
                $parents = array_reverse( $parents );
                $parents[] = $catID;
                foreach ( $parents as $cat ) {
                    $position += 1;
                    if ( $position > 1 ) echo $sep;
                    echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                }
                if ( get_query_var( 'cpage' ) ) {
                    $position += 1;
                    echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
                    echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
                } else {
                    if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                    elseif ( $show_last_sep ) echo $sep;
                }
            }

        } elseif ( is_post_type_archive() ) {
            $post_type = get_post_type_object( get_post_type() );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . $post_type->label . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_attachment() ) {
            $parent = get_post( $parent_id );
            $cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
            $parents = get_ancestors( $catID, 'category' );
            $parents = array_reverse( $parents );
            $parents[] = $catID;
            foreach ( $parents as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            $position += 1;
            echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_page() && ! $parent_id ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_title() . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_page() && $parent_id ) {
            $parents = get_post_ancestors( get_the_ID() );
            foreach ( array_reverse( $parents ) as $pageID ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
            }
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_tag() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $tagID = get_query_var( 'tag_id' );
                echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_author() ) {
            $author = get_userdata( get_query_var( 'author' ) );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_404() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . $text['404'] . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( has_post_format() && ! is_singular() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            echo get_post_format_string( get_post_format() );
        }

        echo $wrap_after;

    }
} // end of dimox_breadcrumbs()


// Возвращаем сопоставление символов файлам
add_action( 'init', 'classic_smilies_init', 1 );
function classic_smilies_init() {
	global $wpsmiliestrans;
	$wpsmiliestrans = array(
    ':p'        => '20x20-adore.png',
    ':-p'        => '20x20-after_boom.png',  
    '8)'        => '20x20-ah.png',
    '8-)'        => '20x20-amazed.png', 
    ':lang:'      => '20x20-angry.png',
    ':lol:'      => '20x20-bad_smelly.png',
    ':-pp'        => 'smile1.png',  
	);
	add_filter( 'smilies_src', 'classic_smilies_src', 10, 2 );
 
// Отключаем загрузку скриптов и стилей Emoji
// remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
// remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
// remove_action( 'wp_print_styles', 'print_emoji_styles' );
// remove_action( 'admin_print_styles', 'print_emoji_styles' );	
// remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
// remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
// remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
// add_filter( 'tiny_mce_plugins', 'classic_smilies_rm_tinymce_emoji' );
// add_filter( 'the_content', 'classic_smilies_rm_additional_styles', 11 );
// add_filter( 'the_excerpt', 'classic_smilies_rm_additional_styles', 11 );
// add_filter( 'comment_text', 'classic_smilies_rm_additional_styles', 21 );
}
 
// Отключаем Emoji в визуальном редакторе TinyMCE
// function classic_smilies_rm_tinymce_emoji( $plugins ) {
// 	return array_diff( $plugins, array( 'wpemoji' ) );
// }
 
// Убираем размеры смайликов равные 1em (новые задаются для класса .wp-smiley)
// function classic_smilies_rm_additional_styles( $content ) {
// 	return str_replace( 'class="wp-smiley" style="height: 1em; max-height: 1em;"', 'class="wp-smiley"', $content );
// }


add_action( 'wp_enqueue_scripts', 'planremonta_scripts' );
function planremonta_scripts() {
	// отменяем зарегистрированный jQuery
	wp_deregister_script('jquery-core');
	wp_deregister_script('jquery');
	// регистрируем
	wp_register_script('jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js', false, null, true);
	wp_register_script('jquery', false, array('jquery-core'), null, true);
	// подключаем
	wp_enqueue_script( 'jquery' );

  // Other site scripts
  wp_enqueue_script('newscript', get_template_directory_uri() . '/js/lozad.min.js');
  wp_enqueue_script('lozad', get_template_directory_uri() . '/js/swiper-bundle.min.js');
  wp_enqueue_script('swiper-bundle', get_template_directory_uri() . '/js/inputmask.min.js');
  wp_enqueue_script('inputmask', get_template_directory_uri() . '/js/nice-select.js');
  wp_enqueue_script('nice-select', get_template_directory_uri() . '/js/ion.rangeSlider.min.js');
  wp_enqueue_script('ion-rangeSlider', get_template_directory_uri() . '/js/fancybox.min.js');
  wp_enqueue_script('fancybox.min.js', get_template_directory_uri() . '/js/parsley.min.js');
  wp_enqueue_script('parsley', get_template_directory_uri() . '/js/functions.js');
  wp_enqueue_script('functions', get_template_directory_uri() . '/js/scripts.js');
}    

add_action( 'wp_enqueue_scripts', 'planremonta' );
// add_action('wp_print_styles', 'planremonta'); // можно использовать этот хук он более поздний
function planremonta() {
    wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/styles.css', array(), '1.0.0');
    wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/fancybox.css', array(), '1.0.0');
    // responde
    wp_enqueue_style( 'response_1217', get_template_directory_uri() . '/css/response_1217.css', array(), '1.0.0', 'print (max-width: 1217px)');
    wp_enqueue_style( 'response_1023', get_template_directory_uri() . '/css/response_1023.css', array(), '1.0.0', 'print (max-width: 1023px)');
    wp_enqueue_style( 'response_767', get_template_directory_uri() . '/css/response_767.css', array(), '1.0.0', 'print (max-width: 767px)');
    // Sliders
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper.css', array(), '1.1.0');
    wp_enqueue_style( 'swiper-bundle', get_template_directory_uri() . '/css/swiper-bundle.min.css', array('swiper'), '1.0.0');
    wp_enqueue_style( 'ion-rangeSlider', get_template_directory_uri() . '/css/ion.rangeSlider.css', array(), '1.0.0');
}


 /* ноиндекс страницы пагинации */
function my_meta_noindex () {
		if (
			is_paged() // Все и любые страницы пагинации
		) {echo "".'<meta name="robots" content="noindex,nofollow" />'."\n";}
	}
add_action('wp_head', 'my_meta_noindex', 3); //


/*Обработка контактной формы */



/* Добавляем адаптивный контейнер для видео */
function alx_embed_html( $html ) {
return '<div class="video-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'alx_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'alx_embed_html' ); // Поддержка Jetpack

function div_wrapper($content) {
    // match any iframes
    $pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
    preg_match_all($pattern, $content, $matches);

    foreach ($matches[0] as $match) {
        // wrap matched iframe with div
        $wrappedframe = '<div class="video-container">' . $match . '</div>';

        //replace original iframe with new in content
        $content = str_replace($match, $wrappedframe, $content);
    }

    return $content;    
}
add_filter('the_content', 'div_wrapper');

// canonical для пагинации
function return_canon () {
	$canon_page = get_pagenum_link(0);
	return $canon_page;
}
 
function canon_paged() {
	if (is_paged()) {
		add_filter( 'wpseo_canonical', 'return_canon' );
	}
} 
add_filter('wpseo_head','canon_paged');


/*** удаляем replytocom ***/
function mayak_replycom_remove( $mayak_remove ) {
$cut = "!<a(.*?)href='(.*?)'(.*?)>(.*?)</a>!si";
$insert = "<span class='comment-reply-link' \\3>\\4</span>";
return preg_replace($cut, $insert, $mayak_remove);
}
add_filter( 'comment_reply_link', 'mayak_replycom_remove' );


function edit_phone($phone){
    $phone =  strip_tags($phone);
    $phone = str_replace("-", "", $phone);
    $phone = str_replace(" ", "", $phone);
    return  $phone;
}

add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){

    wp_localize_script('jquery', 'myajax', 
        array(
            'url' => admin_url('admin-ajax.php'),
            'template_url' => get_bloginfo('template_url')
        )
    );  
}


add_filter( 'get_the_archive_title', function( $title ){
    return preg_replace('~^[^:]+: ~', '', $title );
});


add_action( 'admin_menu', 'remove_menus' );
function remove_menus(){
    remove_menu_page( 'edit-comments.php' );          // Комментарии
}


add_filter( 'nav_menu_css_class', 'special_nav_class', 10, 2 );
function special_nav_class($classes, $item){
    $classes[] = "item"; 
    return $classes;
}


function wph_exclude_pages($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','wph_exclude_pages');


function is_mobile(){
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if(
        // добавить '|android|ipad|playbook|silk' в первую регулярку для определения еще и tablet
        preg_match(
            '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',
            $useragent
        )
        ||
        preg_match(
            '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',
            substr($useragent,0,4)
        )
    )
        return true;
    return false;   
}




add_action('wp_ajax_form', 'my_action_form');
add_action('wp_ajax_nopriv_form', 'my_action_form');
function my_action_form() {   

    $from  = 'admin@'.$_SERVER['HTTP_HOST'];      

    $title =trim($_POST['title']);
    
    if($_POST['name'])
    {
        $body .= "Имя: ".$_POST['name']." \n\n";   
    }

    if($_POST['phone'])
    {
        $body .= "Телефон: ".$_POST['phone']." \n\n";   
    }  

    if($_POST['email'])
    {
        $body .= "Почта: ".$_POST['email']." \n\n";   
    }  

    if($_POST['what'])
    {
        $body .= "Что нужно отремонтировать: ".$_POST['what']." \n\n";   
    }  

    if($_POST['type'])
    {
        $body .= "Вид ремонта: ".$_POST['type']." \n\n";   
    }  

    if($_POST['home'])
    {
        $body .= "Вид дома: ".$_POST['home']." \n\n";   
    }  

    if($_POST['area_range'])
    {
        $body .= "Площадь помещения: ".$_POST['area_range']." \n\n";   
    }  

    if($_POST['calc_area_range'])
    {
        $body .= "Площадь помещения: ".$_POST['calc_area_range']." \n\n";   
    }  

    if($_POST['room'])
    {
        $body .= "Количество комнат: ".$_POST['room']." \n\n";   
    }     

    
    $emailTo = get_option("admin_email");    
   
    $subject = $title;   
    
    $headers = 'From: '.$name.' <'.$from.'>' . "\r\n" . 'Reply-To: ' . $email;

    $emailSent =  wp_mail($emailTo, $subject, $body, $headers); 

    if($emailSent == true){
        echo 1; //Ваша заявка принята. Менеджер свяжется с Вами в ближайшее время.
    }
    else
    {
        echo 2; //Сообщение не отправлено...
    }
    // выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
    wp_die();
}


