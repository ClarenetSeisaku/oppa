<?php

/**
 *　情報誌「大阪港」　一覧
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
            <li>情報誌「大阪港」一覧</li>
        </ul>
    </section>
    <section class="middle_ttl_sec">
        <div class="sec_inner">
            <h2 class="page_ttl">情報誌「大阪港」</h2>
            <p class="page_sub_ttl">Magazine</p>
        </div>
    </section>

    <section id="magazine_all">
        <div class="sec_inner">
            <div class="magazine_contents">
                <ul class="magazine_list grid_box_list grid_3_2_1">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>" class="arrow">
                                    <figure>
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium'); ?>
                                        <?php else: ?>
                                            <img src="<?php echo imdir(); ?>/common/oppa_magazine_dummy.png" alt="ダミー画像">
                                        <?php endif; ?>
                                    </figure>
                                    <p class="magazine_ttl"><?php the_title(); ?></p>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>現在情報誌「大阪港」はありません。</p>
                    <?php endif; ?>
                </ul>
                <?php if (function_exists('wp_pagenavi')) : ?>
                    <?php wp_pagenavi(); ?>
                <?php endif; ?>
            </div>
            <aside>
                <form method="get" action="<?php echo home_url('/'); ?>" class="search_box">

                    <!-- キーワード検索 -->
                    <input type="text" name="s" placeholder="キーワードを入力" value="<?php echo get_search_query(); ?>">

                    <!-- 投稿タイプ固定 -->
                    <input type="hidden" name="post_type" value="magazine">

                    <!-- 年度 -->
                    <div class="search_block">
                        <p>年度別</p>
                        <?php
                        $years = get_terms([
                            'taxonomy' => 'year',
                            'hide_empty' => false,
                        ]);
                        foreach ($years as $year) :
                        ?>
                            <label>
                                <input type="radio" name="year" value="<?php echo esc_attr($year->slug); ?>"
                                    <?php checked($_GET['year'] ?? '', $year->slug); ?>>
                                <?php echo esc_html($year->name); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- 著者 -->
                    <div class="search_block">
                        <p>著者別索引</p>
                        <?php
                        $authors = get_terms([
                            'taxonomy' => 'authorindex',
                            'hide_empty' => false,
                        ]);
                        foreach ($authors as $author) :
                        ?>
                            <label>
                                <input type="radio" name="authorindex" value="<?php echo esc_attr($author->slug); ?>"
                                    <?php checked($_GET['authorindex'] ?? '', $author->slug); ?>>
                                <?php echo esc_html($author->name); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <button type="submit">検索</button>
                </form>
            </aside>
        </div>
    </section>

</main>
<?php
get_footer();
?>