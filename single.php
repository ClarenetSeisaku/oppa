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
        <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
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
      </span>
      <?php $link = get_field('news_link'); ?>
      <h2 class="news_main_ttl">
        <?php if ($link): ?>
          <a href="<?php echo esc_url($link); ?>">
            <?php the_title(); ?>
          </a>
        <?php else: ?>
          <?php the_title(); ?>
        <?php endif; ?>
      </h2>
      <div class="single_inner">
        <?php the_content(); ?>
      </div>
      <div class="btn_inner">
        <!-- 一覧へボタン -->
        <a href="<?= esc_url(home_url('news')) ?>" class="commonBtn center">
          <span>新着情報一覧へ戻る</span>
        </a>
      </div>
    </div>
  </section>

</main>
<?php
get_footer();
?>