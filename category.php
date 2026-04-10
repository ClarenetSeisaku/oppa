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
                    <svg class="middle_mv__wave" viewBox="0 0 1440 150" preserveAspectRatio="none">
                        <path d="M 0,60 Q 360,100 720,60 T 1440,60 L 1440,150 L 0,150 Z"></path>
                    </svg>
                    <svg class="middle_mv__wave" viewBox="0 0 1440 150" preserveAspectRatio="none">
                        <path d="M 0,60 Q 360,100 720,60 T 1440,60 L 1440,150 L 0,150 Z"></path>
                    </svg>
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
                            <a href="<?php the_permalink(); ?>" class="arrow">
                                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y.n.j'); ?></time>

                                <span class="news_category">
                                    <?php
                                    $cats = get_the_category();
                                    if ($cats) {
                                        foreach ($cats as $cat) {
                                            echo '<span class="cat-item cat-' . esc_attr($cat->slug) . '">';
                                            echo esc_html($cat->name);
                                            echo '</span>';
                                        }
                                    }
                                    ?>
                                </span>

                                <p><?php the_title(); ?></p>
                            </a>
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