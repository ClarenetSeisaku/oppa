<?php
/*
 *
 * 新着情報 タクソノミー
 *
 */
?>
<?php get_header(); ?>
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
            <li><a href="<?= esc_url(home_url('news')) ?>">お知らせ一覧</a></li>
            <li><?php
                $cat = get_queried_object();
                if ($cat) {
                    echo esc_html($cat->name);
                }
                ?></li>

        </ul>
    </section>
    <section class="middle_ttl_sec">
        <div class="sec_inner">
            <h2 class="page_ttl"><?php
                                    $cat = get_queried_object();
                                    if ($cat) {
                                        echo esc_html($cat->name);
                                    }
                                    ?></h2>
            <p class="page_sub_ttl">News</p>
        </div>
    </section>


    <section id="news_all">
        <div class="sec_inner">
            <ul class="news_list">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
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
                            <?php
                            $link = get_field('news_link');
                            $blank = get_field('news_link_blank');
                            ?>

                            <p>
                                <?php if ($link): ?>
                                    <a href="<?php echo esc_url($link); ?>" <?php if ($blank): ?>target="_blank" rel="noopener noreferrer" <?php endif; ?>>
                                        <?php the_title(); ?>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                <?php endif; ?>
                            </p>
                        </li>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
            <?php if (function_exists('wp_pagenavi')) :
                wp_pagenavi();
            endif; ?>
        </div>
    </section>
</main>
<?php
get_footer();
?>