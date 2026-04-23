<?php

/**
 *　情報誌「大阪港」　カテゴリー一覧
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
            <li><a href="<?= esc_url(home_url('joho')) ?>">情報誌「大阪港」一覧</a></li>
            <li><?php single_term_title(); ?></li>
        </ul>
    </section>
    <section class="middle_ttl_sec">
        <div class="sec_inner">
            <h2 class="page_ttl"><?php single_term_title(); ?></h2>
            <p class="page_sub_ttl">Magazine</p>
        </div>
    </section>

    <section id="joho_all">
        <div class="sec_inner">
            <div class="joho_contents">
                <ul class="joho_list grid_box_list grid_3_2_1">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
                                    <figure>
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium'); ?>
                                        <?php else: ?>
                                            <img src="<?php echo imdir(); ?>/joho/joho_dummy.png" alt="ダミー画像">
                                        <?php endif; ?>
                                    </figure>
                                    <p class="joho_ttl"><?php the_title(); ?></p>
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
            <aside class="sidebar">
                <h3>キーワード検索</h3>

                <!-- 検索 -->
                <form method="get" action="<?php echo get_post_type_archive_link('joho'); ?>" class="sidebar_search">
                    <input type="text" name="s" placeholder="キーワードを入力">
                    <input type="hidden" name="post_type" value="joho">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M6.66667 13.3333C8.14581 13.333 9.58234 12.8379 10.7475 11.9267L14.4108 15.59L15.5892 14.4117L11.9258 10.7483C12.8375 9.58305 13.333 8.1462 13.3333 6.66667C13.3333 2.99083 10.3425 0 6.66667 0C2.99083 0 0 2.99083 0 6.66667C0 10.3425 2.99083 13.3333 6.66667 13.3333ZM6.66667 1.66667C9.42417 1.66667 11.6667 3.90917 11.6667 6.66667C11.6667 9.42417 9.42417 11.6667 6.66667 11.6667C3.90917 11.6667 1.66667 9.42417 1.66667 6.66667C1.66667 3.90917 3.90917 1.66667 6.66667 1.66667Z" fill="#244668" />
                        </svg>
                    </button>
                </form>

                <!-- 年度 -->
                <div class="sidebar_block js-accordion">
                    <div class="sidebar_block__head">
                        年度別
                        <span class="icon">－</span>
                    </div>

                    <div class="sidebar_block__body">
                        <?php
                        $years = get_terms([
                            'taxonomy' => 'joho-year',
                            'hide_empty' => false,
                        ]);
                        foreach ($years as $year) :
                        ?>
                            <a href="<?php echo get_term_link($year); ?>"
                                class="sidebar_tag <?php if (is_tax('joho-year', $year->slug)) echo 'is-active'; ?>">
                                <?php echo esc_html($year->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- 著者 -->
                <div class="sidebar_block js-accordion">
                    <div class="sidebar_block__head">
                        著者別索引
                        <span class="icon">－</span>
                    </div>

                    <div class="sidebar_block__body author_list">
                        <?php
                        $authors = get_terms([
                            'taxonomy' => 'joho-author',
                            'hide_empty' => false,
                        ]);
                        foreach ($authors as $author) :
                        ?>
                            <a href="<?php echo get_term_link($author); ?>"
                                class="sidebar_tag <?php if (is_tax('joho-author', $author->slug)) echo 'is-active'; ?>">
                                <?php echo esc_html($author->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- ボタン -->
                <div class="sidebar_buttons">
                    <a href="<?= esc_url(home_url('/')) ?>joho-category/yousi" class="sidebar_btn commonBtn"><span>要旨</span></a>
                    <a href="https://osakaportmagazine.blogspot.com/" class="sidebar_btn commonBtn link_btn" target="_blank"><span>Take of contents<br>"Osaka Port"</span></a>
                    <a href="<?= esc_url(home_url('/')) ?>joho-category/readosakaport" class="sidebar_btn commonBtn"><span>大阪港を読む</span></a>
                </div>

            </aside>
        </div>
    </section>

</main>
<?php
get_footer();
?>