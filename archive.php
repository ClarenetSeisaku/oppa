<?php

/**
 *　新着情報　一覧
 *
 */
?>
<?php
get_header();
?>
<main class="middle">
    <section class="middle_mv">
        <!-- アニメーション装飾エリア -->
        <div class="middle_mv__decoration">

            <!-- 波 -->
            <div class="middle_mv__wave-sway">
                <div class="middle_mv__wave-move">
                </div>
            </div>
        </div>

    </section>


    <section class="pankuzu_wrap">
        <ul class="pankuzu sec_inner">
            <li><a href="<?= esc_url(home_url()) ?>">TOP</a></li>
            <li>お知らせ一覧</li>
        </ul>
    </section>
    <section class="middle_ttl_sec">
        <div class="sec_inner">
            <h2 class="page_ttl">新着情報</h2>
            <p class="page_sub_ttl">News</p>
        </div>
    </section>

    <section id="news_all">
        <div class="sec_inner">
            <?php
            $categories = get_categories();

            echo '<ul class="category-list">';

            echo '<li><a href="' . esc_url(home_url('/')) . '">すべて</a></li>';

            if ($categories) {
                foreach ($categories as $cat) {
                    echo '<li>';
                    echo '<a href="' . esc_url(get_category_link($cat->term_id)) . '">';
                    echo esc_html($cat->name);
                    echo '</a>';
                    echo '</li>';
                }
            }

            echo '</ul>';
            ?>
            <ul class="news_list">
                <?php
                $topics = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 10,
                    'paged' => $paged,
                ));
                ?>
                <?php
                if ($topics->have_posts()) :
                ?>
                    <?php
                    while ($topics->have_posts()) :
                        $topics->the_post();
                    ?>
                        <li>

                            <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y.n.j'); ?></time>
                            <span class="news_category">
                                <?php
                                $cats = get_the_category();
                                if ($cats) {
                                    foreach ($cats as $cat) {
                                        $cat_link = get_category_link($cat->term_id);

                                        echo '<a href="' . esc_url($cat_link) . '" class="cat-item cat-' . esc_attr($cat->slug) . '">';
                                        echo esc_html($cat->name);
                                        echo '</a>';
                                    }
                                }
                                ?>
                            </span>
                            <?php $link = get_field('news_link'); ?>
                            <p>
                                <?php if ($link): ?>
                                    <a href="<?php echo esc_url($link); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                <?php endif; ?>
                            </p>
                        </li>
                <?php endwhile;
                endif;
                wp_reset_postdata(); ?>
            </ul>
            <?php if (function_exists('wp_pagenavi')) :
                wp_pagenavi(array('query' => $topics));
            endif; ?>
        </div>
    </section>

</main>
<?php
get_footer();
?>