<?php

/**
 *　投稿 詳細ページ
 *
 */
?>

<?php
get_header();
?>
<main class="middle">
    <section class="middle_mv">
        <h2 class="page_ttl"><span>お知らせ</span></h2>
    </section>


    <div class="pankuzu_wrap">
    <ul class="pankuzu sec_inner">
        <li><a href="<?= esc_url(home_url()) ?>">TOP</a></li>
        <li><a href="<?= esc_url(home_url('news')) ?>">お知らせ一覧</a></li>
        <li><?php the_title(); ?></li>
    </ul>
    </div>

    <section id="news_single">
    <div class="sec_inner sec_size02">
      <span class="news_data">
         <time><?php echo get_the_date('Y.m.d'); ?></time>
      </span>
      <h2 class="border_ttl"><span><?php the_title(); ?></span></h2>
      <div class="single_inner">
        <?php the_content(); ?>
      </div>
      <ul class="single_pagenav">
        <li class="prev"><?php previous_post_link('%link', '前のお知らせ'); ?></li>
        <li><a href="<?= esc_url(home_url('news')) ?>">一覧</a></li>
        <li class="next"><?php next_post_link('%link', '次のお知らせ'); ?></li>
      </ul>
        </div>
    </section>
    
</main>
<?php
get_footer();
?>