<?php
/*
 *
 * 新着情報 タクソノミー
 *
 */
?>
<?php get_header(); ?>
<main>
    <section class="middle_mv">
        <picture>
            <source media="(min-width: 769px)" srcset="<?php echo imdir(); ?>/news/news_mv.jpg">
            <img src="<?php echo imdir(); ?>/news/news_mv.jpg" alt="NEWS">
        </picture>
        <div class="page_ttl">
            <h1 class="page_ttl_main">NEWS</h1>
        </div>
    </section>
    <section class="pankuzu_wrap">
        <ul class="pankuzu">
            <li><a href="<?= esc_url(home_url()) ?>">TOP</a></li>
            <li><a href="<?= esc_url(home_url('news')) ?>">お知らせ一覧</a></li>
            <li><?php single_cat_title(); ?></li>

        </ul>
    </section>


    <section class="newsPage archivePage">

        <article>
            <div class="head">
                <h2 class="box_ttl"><?php single_cat_title(); ?>一覧</h2>
                <ul class="sns">
                    <li><a href=""><img src="<?php echo imdir(); ?>/icon/instagram.svg" alt="Instagram"></a></li>
                    <li><a href=""><img src="<?php echo imdir(); ?>/icon/x.svg" alt="X"></a></li>
                </ul>
            </div>
            <ul class="newsList">
                <?php
                $topics = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 12,
                    'paged' => $paged,
                    'cat' => get_query_var('cat')
                ));
                ?>
                <?php
                if ($topics->have_posts()) :
                ?>
                <?php
                    while ($topics->have_posts()) :
                        $topics->the_post();
                    ?>
                <li><a href="<?php the_permalink(); ?>" class="arrow">
                        <dl>
                            <dt><time><?php echo get_the_date('Y.n.j'); ?></time>
                                <div class="cat_name"><?php $categories = get_the_category();
foreach($categories as $cat) {
    //(例)classにスラッグを指定したカテゴリーのラベル
    echo '<span class="'.$cat->slug.'">'.$cat->name.'</span>';
}?></div>
                            </dt>
                            <dd><?php the_title(); ?> </dd>
                        </dl>
                    </a></li>
                <?php endwhile; ?>
                <?php endif; ?>
                <?php
                if (function_exists('wp_pagenavi')) :
                    wp_pagenavi(array('query' => $topics)); ////wp_pagenavi()の呼び出し(ただし、引数の指定が必要！)
                endif;
                ?>
                <?php wp_reset_postdata(); ?>
            </ul>

        </article>
        <?php get_sidebar(); ?>

    </section>
</main>
<?php
get_footer();
?>