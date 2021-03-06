<?php
/**
 * Example wp code
 * ---------------------------------------------------------------------------------------------------------------------
 */?>



<?php  /************** ------- выведет первую букву строки в переменной ------- **************/?>
<?php mb_substr($value, 0, 1) ?>



<?php  /************** ------- Статический текст ------- **************/?>
<?php _e('текст', 'static_strings') ?>




<?php  /************** ------- получает урл на root сайта ------- **************/?>
<?php echo get_home_url(); ?>



<?php  /************** ------- Указание название шаблона стр ------- **************/?>
<?php
/*
Template Name: page_template name
*/
?>



<?php  /************** ------- вывод шорткода из php ------- **************/?>
<?= do_shortcode('[shortcode]');?>




<?php  /************** ------- Запись и присвоение переменной из глобального масива wp - в виде ключа и значения в масиве глобальная переменная ------- **************/
$GLOBALS['name'] = $name;
$name = $GLOBALS['name']
 /************** ------- Запись и присвоение переменной из глобального масива wp - в виде ключа и значения в масиве глобальная переменная ------- **************/?>




<?php  /************** ------- получает урл до дериктории темы ------- **************/?>
<?= get_template_directory_uri(); ?>



<?php  /************** ------- проверка на каком языке находимся ------- **************/?>
<?=  get_locale(); // получим 'ru_RU', если сайт на русском ?>




<?php  /************** ------- получение обьекта кастомной таксономии (кастомная таксономия)  ------- **************/?>
<?php $terms = wp_get_post_terms( $post_id, $taxonomy, $args ); ?>
<?php get_category_link( wp_get_post_terms(get_the_ID(), ['taxonomy'=>'card_category'])[0]->term_id ); // пример получения ссылки кастомной таксономии через wp_get_post_terms ?>
<?php wp_get_post_terms(get_the_ID(), ['taxonomy'=>'custom_category'])[0]->name; // Получим имя текущей кастомной категории custom_category в цикле или на стр. ?>




<?php  /************** ------- подключает отдельный файл php к данному месту - писать имя файла без .php  ------- **************/?>
<?php  /************** ------- comment ------- **************/
    get_template_part('template/file-name'); ?>
<?php include (TEMPLATEPATH . '/part/file-name.php'); ?>





<?php  /************** ------- проверка на роль юзера - залогиненного ------- **************/?>
<?php
if( current_user_can('subscriber') )
    echo 'данный пользователь подписчик';
else
    echo 'данный пользователь не подписчик';
// current_user_can('administrator')
// current_user_can('editor')
// current_user_can('contributor')
// current_user_can('subscriber')
?>





<?php
/**
 * ACF выводы полей в группах и тд
 * ---------------------------------------------------------------------------------------------------------------------
 **/?>


<?php  /************** ------- вывод в цикле повторителя в повторителе ------- **************/?>
<?php if( have_rows('repeater_1') ) { // проверяем что в repeater_1 есть елементы для вывода?>
    <?php while (have_rows('repeater_1')){ the_row(); // выводим в цикле первый повторитель с его саб полями?>

        <?php the_sub_field('sub_field_1'); // саб поле первого репитера?>


        <?php if (have_rows('repeater_2')) { // проверяем что в repeater_2 есть елементы для вывода?>
            <?php while (have_rows('repeater_2')){ the_row(); // выводим в цикле второй повторитель с его саб полями?>

                <?php the_sub_field('sub_field_1'); // саб поле второго репитера?>

            <?php };
        };?>

    <?php };
};?>


<?php  /************** ------- вывод в цикле повторителя в повторителе из массива - не acf плагин------- **************/?>
<?php foreach( CFS()->get('block_5_loop') as $slide): ; // выводим в цикле первый повторитель с его саб полями?>
    <div class="swiper-slide">
        <?php foreach($slide['txtarea_item_loop'] as $service): ?>
            <div class="thumb-service">
                <i class="ic-ser-arrow">
                    <svg>
                        <use xlink:href="<?= get_template_directory_uri() ?>/img/sprite-inline.svg#ic-service-arrow"></use>
                    </svg>
                </i>
                <h3><?= $service['_item_services'] ?></h3>
                <p><?= $service['_txtarea_item_services'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>


<?php  /************** ------- вывод в цикле повторителя с (группы) ------- **************/?>
<?php foreach (get_field('group')['txt_block_left'] as $key => $value): ?>
    <?= $value['txt'] ?>
<?php endforeach ?>

<?php  /************** ------- вывод в цикле повторителя с (простого поля повторителя) ------- **************/?>
<?php foreach (get_field('sub_title') as $key => $value): ?>
    <?= $value['txt'] ?>
<?php endforeach ?>

<?php  /**  Вывод кастомного поля в группе - нужно создать поле тип (группа) и в нем создавать поля с разными значениями  **/?>
<?= get_field('группа')['значение_поля_в_группе'];  ?>

<?php  /************** ------- простой вывод поля ------- **************/?>
<?= get_field('имя_поля'); ?>

<?= the_field('имя_поля'); ?>






<?php
/************** ------- Получает обьек кастомной таксономии  ------- **************/
$categories = get_terms($args = array(
    'taxonomy' => 'custom_taxonomy', //Название таксономии с которой работать. Можно указать несколько названий в виде массива.
    // С версии WP 4.5, до этого названия таксономий указывались в первом параметре самой функции.
    'number' => 999, //Максимальное количество элементов, которые будут получены. Лимит
    'hide_empty' => false, //Скрывать ли термины в которых нет записей. 1(true) - скрывать пустые, 0(false) - показывать пустые.
)); // https://wp-kama.ru/function/get_terms

// Пример использования вывод таксономии в виде карточки категории с произвольными полями
echo '<div class="category-goods-col">
    <div class="category-goods-item category-goods-big">
        <div class="category-goods-img">
            <img src="'.get_field('custom_field', $category).'" alt="' . sprintf( __( "изображение из  %s" ), $category->name ) . '">
        </div>
        <a href="' . get_category_link( $category->term_id ) . '" class="category-goods-link"></a>
        <a href="' . get_category_link( $category->term_id ) . '" class="category-goods-name">' . $category->name.'</a>
    </div>
</div>';

echo wp_get_post_terms(get_the_ID(), ['taxonomy'=>'custom_taxonomy'])[0]->name; // пример вывода названия текущей таксономии
echo get_category_link( wp_get_post_terms(get_the_ID(), ['taxonomy'=>'custom_taxonomy'])[0]->term_id ); // пример вывода ссылки текущей таксономии

?>







<?php
/************** ------- Выводит количество записей произвольного типа: ------- **************/
$posts = get_posts('post_type=post_type&status=new');
$count = count($posts);
echo $count; ?>





<?php
/************** ------- Вывод последних записей 5 шт ------- **************/
$the_query = new WP_Query('showposts=5'); ?>

<?php
while ($the_query->have_posts()) : $the_query->the_post();

    //подключаем шаблон с контентом и тд поста
    get_template_part('template/post');
    echo mb_strcut(strip_tags($post->post_content), 0, 250); // обрезка превью текста поста до 250 символов

endwhile;
/************** ------- Вывод последних записей 5 шт ------- **************/
?>







<?php
/************** ------- Вывод постов на главной - простой цкл - вернет посты с типом post - работает только для вывода на главной стр ------- **************/
while (have_posts()) : the_post(); ?>
    <section class="section-article">
        <div class="container">
            <h2 class="title"><?php the_title(); //Title post main page ?></h2>
            <div class="content-main-page">
                <?php the_content(); //Content post main page ?>
            </div>
        </div>
    </section>
<?php endwhile;
/************** ------- Вывод постов на главной - простой цкл - вернет посты с типом post - работает только для вывода на главной стр ------- **************/ ?>






<?php
/************** ------- Вывод постов query_posts способом  ------- **************/
/************** ------- Вывод постов на любой странице с шаблоном  - вернет посты с указанным типом post_type  ------- **************/
$args = array(
    'post_type' => 'post', // Тип поста
    'publish' => true, // Только опубликованные
    'posts_per_page' => 7, // Количевство постов на странице
    'paged' => get_query_var('paged'), // Пагинация через $wp_query
);

$query_posts = query_posts($args);

while ($query_posts->have_posts()){
    $query_posts->the_post();

    //подключаем шаблон с контентом и тд поста
    get_template_part('template/post');

};
wp_reset_postdata(); // сбрасываем глобальную переменную
/************** ------- Вывод постов на любой странице с шаблоном  - вернет посты с указанным типом post_type ------- **************/ ?>








<?php
/************** ------- Вывод постов WP_Query способом ------- **************/
/************** ------- Вывод постов на любой странице с шаблоном  - вернет посты с указанным типом post_type - ВАРИАНТ WP_Query ------- **************/

$args = array(
    'post_type' 	 => 'post', // Тип поста
    'posts_per_page' => 12, // Количевство постов на странице
    'order' 	     => 'DESC', // Сортировка постов
    'publish'        => true, // Только опубликованные
    'paged'	         => get_query_var('paged') ? get_query_var('paged') : 1 // передается текущая страница или первая если не передается страница выше первой
);

$my_query = new WP_Query( $args );


while ( $my_query->have_posts() ) {
    $my_query->the_post();

    /************** ------- вывод отзывов  ------- **************/
    get_template_part('template/reviews-post');

};

wp_reset_query();


/************** ------- Вывод постов на любой странице с шаблоном  - вернет посты с указанным типом post_type - ВАРИАНТ wp_query ------- **************/ ?>














<?php
/************** ------- Вывод постов WP_Query способом ------- **************/
/************** ------- Вывод постов на любой странице с шаблоном  - вернет похожие посты по категории данного поста ------- **************/

$categories = get_the_category($post->ID); // получаем id поста для дальнейшей передачи в $categories
if ($categories): // условие если мы на странице поста и у $categories есть категория переданна выше
    $category_ids = array(); // передаем id категории в цикл для вывода ее в $category_ids (для сортировки вывода постов по id)
    foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;
    $args = array(
        'category__in' => $category_ids, // Сортировка производится по категориям
        'orderby' => 'rand', // Условие сортировки рандом
        'post__not_in' => array($post->ID), // Передаем id категории поста на котором мы находимся
        'showposts' => 15, // Количество выводимых записей
        'caller_get_posts' => 1 // Запрещаем повторение ссылок
    );

    $my_query = new WP_Query($args);

    while ($my_query->have_posts()): $my_query->the_post();

        /************** ------- вывод отзывов  ------- **************/
        get_template_part('template/reviews-post');

    endwhile;
    wp_reset_query();
endif;
/************** ------- Вывод постов на любой странице с шаблоном  - вернет похожие посты по категории данного поста ------- **************/ ?>







<?php
/************** ------- вывод стандартной пагинации ------- **************/
$args = array(
    'show_all' => False, // показаны все страницы участвующие в пагинации
    'end_size' => 1,     // количество страниц на концах
    'mid_size' => 1,     // количество страниц вокруг текущей
    'prev_next' => True,  // выводить ли боковые ссылки «предыдущая/следующая страница».
    'prev_text' => __('«предыдущая'),
    'next_text' => __('следующая страница»'),
    'add_args' => False,
    'add_fragment' => 'текст',     // Текст который добавиться ко всем ссылкам в href в конце.
    'screen_reader_text' => __('Posts navigation'),
);

the_posts_pagination($args); // Вывод пагинации с параметрами переданными в $args - https://wp-kama.ru/function/the_posts_pagination


// вывод атрибутов ссылок - html ссылок пагинации
$args = array(
    'show_all' => False, // показаны все страницы участвующие в пагинации
    'end_size' => 1,     // количество страниц на концах
    'mid_size' => 7,     // количество страниц вокруг текущей
    'prev_next' => False,//True,  // выводить ли боковые ссылки «предыдущая/следующая страница».
    'prev_text' => __('назад'), // так же можно передавать html теги и текст или картинки
    'next_text' => __('вперед'),
    'add_args' => False,
    'screen_reader_text' => __('Posts navigation'),
);

$pag = get_the_posts_pagination($args); // записывает пагинацию get_the_posts_pagination с переданными $args в the_posts_pagination
$pag = str_replace('<a ', '<a rel="nofollow"', $pag); // добавляет  rel="nofollow" к ссылкам пагинации и выводит пагинацию с переданными $args
// str_replace - выполняет поиск по значению первой строки и заменяет найденное значением второй строки и затем передается переменная $pag
echo $pag;
/************** ------- вывод стандартной пагинации ------- **************/ ?>







<?php
/************** ------- вывод Рубрик на страницу шаблона ------- **************/

$args = array(
    'show_option_all' => '',
    'show_option_none' => __('Категории отсутствуют'),
    'orderby' => 'name',
    'order' => 'ASC',
    'show_last_update' => 0,
    'style' => 'list',
    'show_count' => 0,
    'hide_empty' => 1,
    'use_desc_for_title' => 1,
    'child_of' => 0,
    'feed' => '',
    'feed_type' => '',
    'feed_image' => '',
    'exclude' => '',
    'exclude_tree' => '',
    'include' => '',
    'hierarchical' => true,
    'title_li' => __(''),
    'number' => NULL,
    'echo' => 1,
    'depth' => 0,
    'current_category' => 0,
    'pad_counts' => 0,
    'taxonomy' => 'category',
    'walker' => 'Walker_Category',
    'hide_title_if_empty' => false,
    'separator' => '',
);


echo wp_list_categories($args); ?>







<?php
/************** ------- вывод Рубрик на страницу шаблона ------- **************/
/** show_option_all(строка)---------------------------------------------------------------------
 * Если передать не пустую строку, например 'Все категории', то будет добавлена ссылка на все категории (часто это ссылка на главную страницу блога). Текстом ссылки станет текст переданный параметру, в данном случае Все категории.
 * По умолчанию: ''
 * show_option_none(строка)---------------------------------------------------------------------
 * Если функция не нашла ни одной категории для показа, то будет показан этот текст.
 * По умолчанию: 'Нет рубрик'
 * orderby(строка)---------------------------------------------------------------------
 * Сортировка списка по определенным критериям. Например по количеству постов в каждой категории или по названию категорий. Доступны следующие критерии:
 *
 * ID - сортировка по ID;
 * name - сортировка по названию (по умолчанию);
 * slug - сортировка по алт. имени (slug);
 * count - по количеству записей в категории;
 * term_group - по группе.
 * По умолчанию: 'name'
 * order(строка)---------------------------------------------------------------------
 * Направление сортировки:
 *
 * ASC - по порядку, от меньшего к большему (1, 2, 3; a, b, c);
 * DESC - в обратном порядке, от большего к меньшему (3, 2, 1; c, b, a).
 * По умолчанию: 'ASC'
 * show_last_update(логический)---------------------------------------------------------------------
 * Показать последнее обновление категории 1 - да, 0 - нет (у меня при изменении параметра ничего не поменялось).
 * style(строка)---------------------------------------------------------------------
 * Стиль вывода списка. 'list' - означает, что нужно выводить списком в теге <li>, вложенность категорий будет соблюдена. Если указать 'none', то будут выведены только ссылки на категории (<a>) разделенные тегом <br>.
 * По умолчанию: 'list'
 * show_count(логический)---------------------------------------------------------------------
 * Показывать (1) или нет (0) количество записей в категории. Число записей будет показано после названия категории в скобках (например, Психология (16)).
 *
 * 1 (true) - показывать количество записей;
 * 0 (false) - не показывать количество записей.
 * hide_empty(логический)
 * Скрывать ли категории в которых нет записей?
 *
 * 0 (false) - показывать пустые (не скрывать);
 * 1 (true) - не показывать пустые категории (скрывать).
 * По умолчанию: 1
 * use_desc_for_title(логический)---------------------------------------------------------------------
 * Вставлять ли описание категории в атрибут title у ссылки (<a title="Описание категории" href="...):
 *
 * 1 (true) - да, вставлять описание в title, если оно есть;
 * 0 (false) - нет, не использовать описание (будет: Посмотреть все записи в рубрике "название категории").
 * По умолчанию: true
 * child_of(число)---------------------------------------------------------------------
 * Показать дочерние категории. В параметре указывается ID родительской категории (категория, вложенные категории которой нужно показать).
 * feed(логический)---------------------------------------------------------------------
 * Показать ли рядом с названием ссылку на RSS фид (rrs-2) категории. Текст переданный в этом параметре станет текстом ссылки.
 * По умолчанию: ''
 * feed_type(строка)---------------------------------------------------------------------
 * Тип фида
 * По умолчанию: 'rss-2'
 * feed_image(строка)---------------------------------------------------------------------
 * Показать ли рядом с названием ссылку-картинку на RSS фид (rrs-2) категории. В параметре нужно указать ссылку на картинку. Если этот параметр указан, параметр $feed будет отменен.
 * По умолчанию: ''
 * exclude(строка)---------------------------------------------------------------------
 * Исключить категории из списка. Нужно указывать ID категорий через запятую.
 *
 * Если этот параметр указан, параметр child_of будет отменен.
 * Если параметр heiararchical равен true, то будет исключаться вся ветка. Если heiararchical равен false, то для исключения ветки используйте параметр exclude_tree.
 * По умолчанию: ''
 * exclude_tree(строка)---------------------------------------------------------------------
 * Исключить дерево категорий из списка. Указывайте ID категорий через запятую. Параметр include должен быть пустым. Если параметр heirarchical равен true, то используйте exclude вместо exclude_tree. С версии 2.7.1.
 * По умолчанию: ''
 * include(строка)---------------------------------------------------------------------
 * Вывести списком только указанные категории. Указывать нужно ID категорий через запятую.
 * По умолчанию: ''
 * hierarchical(логический)---------------------------------------------------------------------
 * Показывать категории как дерево. Показывать вложенные (дочерние категории), как вложенный список.
 *
 * 1 (true) - да, древовидный тип отображения;
 * 0 (false) - нет, показать сплошным типом.
 * По умолчанию: true
 * title_li(строка)---------------------------------------------------------------------
 * Установить заголовок списка. Если изменить этот параметр на '' (title_li=), то заголовок не будет выводиться вовсе.
 * По умолчанию: 'Категории'
 * number(число)---------------------------------------------------------------------
 * Установить максимальное количество отображаемых категорий (SQL LIMIT). По умолчанию выводится без ограничений.
 * По умолчанию: ''
 * echo(логический)---------------------------------------------------------------------
 * Выводить на экран или возвращать для обработки.
 *
 * 1 (true) - да, выводить на экран;
 * 0 (false) - нет, просто возвратить данные.
 * По умолчанию: true
 * depth(число)---------------------------------------------------------------------
 * Этот параметр контролирует глубину вложенности категорий, которые будут показаны. По умолчанию 0- показывать все уровни вложенности (все дочерние категорий). С версии 2.5.
 *
 * 0 - все уровни вложенности (По умолчанию);
 * -1 - показать все дочерние категории, но без вложенности li списков. Отменяет параметр hierarchical;
 * 1 - показать только категории первого уровня (все виды вложенных категорий не будут показываться);
 * n - число - глубина вложенности которую нужно показывать. 2 - покажет категорий первого и второго уровня.
 * current_category(строка/массив)---------------------------------------------------------------------
 * ID категории или массив из ID. К которым нужно добавить класс current-cat (class="current-cat"). Это нужно, чтобы подсветить категорию через CSS стили. В нормальном режиме такой класс добавляется к текущей категории на странице категорий. Этот параметр нужен, чтобы, например, добавить этот класс на отдельных страницах, которые не относятся к текущей категории. Добавлен с версии 2.6.
 * С версии 4.4. в этот параметр можно передавать массив ID.
 * По умолчанию: ''
 * pad_counts(логический)---------------------------------------------------------------------
 * Считать общее количество постов во вложенных категориях и показывать это число рядом с родительской категорией. Параметр включается автоматически при включенных show_counts и hierarchical. Добавлен с версии 2.9.
 * По умолчанию: 0 (false)
 * hide_title_if_empty(логический)---------------------------------------------------------------------
 * Нужно ли прятать $title_li если в списке нет элементов. С версии 4.4.
 * По умолчанию: false (всегда будет показываться)
 * separator(строка)---------------------------------------------------------------------
 * Разделитель между элементами. С версии 4.4.
 * По умолчанию: '<br />'
 * taxonomy(строка)---------------------------------------------------------------------
 * Название таксономии, которую нужно обрабатывать.
 * По умолчанию: 'category'
 * walker(объект)---------------------------------------------------------------------
 * Расширение объекта (класса), который предназначен для создание списка категорий. Передаваемый параметру объект - это расширение для класса Walker_Category или Walker.
 * По умолчанию: 'Walker_Category'
 *******/

/************** ------- вывод Рубрик на страницу шаблона ------- **************/ ?>




<?php
/************** ------- Подгрузка постов с WP_Query ------- **************/

/***************************************************************************************************************************************
 * Данный код проверяет, сколько у нас страниц содержит блог наш, если больше одной, выводит кнопку, меньше, не выводит.

ajaxurl – Это обработчик AJAX-запросов в WordPress.

true_posts – Сериализованный массив, содержащий все необходимые параметры запроса, является свойством класса WP_Query.

current_page – Номер текущей страницы.
 ****************************************************************************************************************************************/

if ( $wp_query->max_num_pages > 1 ) : ?>
    <script>
        var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
        var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
        var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
        var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
    </script>
    <div class="sphere-center">
        <button class="btn btn_transparent" id="true_loadmore">Загрузить еще новости</button>
    </div>
<?php endif;
wp_reset_query(); ?>

<?php
/************** ------- добавить скрипт в funcions.php для передачи постов в js и получения аргументов для выдачи следующих постов ------- **************/

function true_load_posts(){
    global $post;
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1; // следующая страница
    $args['post_status'] = 'publish';
    $q = new WP_Query($args);
    if( $q->have_posts() ):
        while($q->have_posts()): $q->the_post();
            $cat = get_the_category();  ?>
            <div class="newslist-item">
                <div class="newslist-item__left"><div class="newslist-item__tag newslist-item__tag_<?=  get_field('color', $cat[0]) ?>"> <?= wp_get_post_terms(get_the_ID(), ['taxonomy'=>'category'])[0]->name?>
                        <span class="newslist-item__date">
                                            <?php the_time(' j F Y года '); ?></span> </div><a href="<?php the_permalink(); ?>">
                        <h2><?php the_title(); ?></h2></a></div>
                <div class="newslist-item__right">
                    <div class="newslist-item__excerpt"><?php echo mb_strcut(strip_tags($post->post_content), 0, 250); ?>
                    </div><a class="newslist-item__more" href="<?php the_permalink(); ?>">Читать подробнее</a>
                </div>
            </div>
        <?php
        endwhile;
    endif;
    wp_reset_postdata();
    wp_die();
}


add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts'); ?>

<?php /************** ------- js скрипт который возвращает ответ в виде верстки из цыкла WP_Query функции true_load_posts() - только после jquery ------- **************/ ?>
<script>
    jQuery(function($){
        $('#true_loadmore').click(function(){
            $(this).text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
            var data = {
                'action': 'loadmore',
                'query': true_posts,
                'page' : current_page
            };
            $.ajax({
                url:ajaxurl, // обработчик
                data:data, // данные
                type:'POST', // тип запроса
                success:function(data){
                    if( data ) {
                        $('.sphere-center').before(data);
                        $('#true_loadmore').text('Загрузить еще новости'); // вставляем новые посты
                        current_page++; // увеличиваем номер страницы на единицу
                        if (current_page == max_pages) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
                    }
                }
            });
        });
    });
</script>





<?php
/************** ------- Подгрузка данных из поля get_field('add_video_block',2); после девятого элемента масива ------- **************/

function load_video_callback() {
    $last = $_REQUEST['last'];
    $videos = get_field('add_video_block',2);
    $result = [];
    for($temp = $last; $last < $temp + 9; $last++){
        if(!isset($videos[$last])){
            $last--;
            break;
        }
        $result[] = $videos[$last];
    }
    return wp_send_json_success(['videos' => $result, 'last' => $last]);

}
add_action( 'wp_ajax_load_video', 'load_video_callback' );
add_action('wp_ajax_nopriv_load_video', 'load_video_callback');



function load_product_callback() {
    $last = $_REQUEST['last'];
    $products = get_field('add_product',2);

    $result = [];
    for($temp = $last; $last < $temp + 9; $last++){
        if(!isset($products[$last])){
            $last--;
            break;
        }
        $result[] = $products[$last];
    }
    return wp_send_json_success(['products' => $result, 'last' => $last]);

}
add_action( 'wp_ajax_load_product', 'load_product_callback' );
add_action('wp_ajax_nopriv_load_product', 'load_product_callback'); ?>

<?php /************** ------- js скрипт который возвращает ответ в виде верстки из функции renderProduct() - только после jquery ------- **************/ ?>
<script>
    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php'; //если в футере
    /************** ------- или как ниже в function.php ------- **************/

    add_action( 'wp_enqueue_scripts', 'myajax_data', 99 ); //подключаю скрипты myajax к теме через свои скрипты - скрипты подключать только через  wp_enqueue_scripts
    function myajax_data(){


        wp_localize_script( 'vendor', 'myajax',  // подключаю myajax с скрипту с хендллером main.js
            array(
                'url' => admin_url('admin-ajax.php') //забираю данные js которые в js файле передаются в wp http:\/\/blufixx\/wp-admin\/admin-ajax.php
    ))}



    jQuery(function($){
        $('#load_more').click(function(){
            $(this).text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер

            var wp_data = {
                action: 'load_product',
                last: 9
            };
            $.ajax({
                url: myajax.url,
                data: wp_data,
                method: 'POST',
                success: function(response){
                    response.data.products.map(renderProduct);
                    wp_data.last = response.data.last;
                }
            })

        });
    });


    function renderProduct(product){
        var html = "<div class=\"col-md-4 col-sm-6 col-xs-12\">\n" +
            "                    <div class=\"thumb-goods\">\n" +
            "                        <div class=\"thumb-goods__image\">\n" +
            "                            <img src=\""+ product.img+"\" alt=\""+ product.title+"\">\n" +
            "                        </div>\n" +
            "                        <div class=\"thumb-goods__description\">\n" +
            "                            <div class=\"thumb-goods__description-title\">"+ product.title+"</div>\n" +
            "                            <p>"+ product.txt+"</p>\n" +
            "                            <div class=\"result\">\n" +
            "                                <span>$"+ product.price+"</span>\n" +
            "                                <a class=\"btn btn-buy\" href=\""+ product.amazon_url+"\">\n" +
            "                                    <img src=\"<?= get_template_directory_uri(); ?>/img/pages/elems/amazon_button.png\" alt=\"amazon\">\n" +
            "                                </a>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                </div>";
        $('.goods .lg-container .row-flex').append(html);
    }
</script>



