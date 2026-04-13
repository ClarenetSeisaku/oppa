<?php

/**
 *　グッズ・刊行物　カテゴリー一覧
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
            <li><a href="<?= esc_url(home_url('press')) ?>">グッズ・刊行物一覧</a></li>
            <li><?php single_term_title(); ?></li>
        </ul>
    </section>
    <section class="middle_ttl_sec">
        <div class="sec_inner">
            <h2 class="page_ttl"><?php single_term_title(); ?></h2>
            <p class="page_sub_ttl">Goods and Publications</p>
        </div>
    </section>

    <section id="press_all">
        <div class="sec_inner">
            <ul class="press_list grid_box_list grid_3_2_1">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" class="arrow">
                                <figure>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium'); ?>
                                    <?php else: ?>
                                        <img src="<?php echo imdir(); ?>/common/oppa_press_dummy.png" alt="ダミー画像">
                                    <?php endif; ?>
                                </figure>
                                <p class="press_ttl"><?php the_title(); ?></p>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>現在グッズ・刊行物はありません。</p>
                <?php endif; ?>
            </ul>
            <?php if (function_exists('wp_pagenavi')) : ?>
                <?php wp_pagenavi(); ?>
            <?php endif; ?>
        </div>
    </section>

</main>
<?php
get_footer();
?>