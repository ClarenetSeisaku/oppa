<?php

/**
 *　情報誌「大阪港」 詳細ページ
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
      <li><a href="<?= esc_url(home_url('joho')) ?>">情報誌「大阪港」一覧</a></li>
      <li><?php the_title(); ?></li>
    </ul>
  </div>

  <section id="joho_single">
    <div class="sec_inner">
      <div class="joho_contents">
        <h2 class="joho_main_ttl"><?php the_title(); ?></h2>
        <span class="joho_category">
          <?php
          // 年度
          $years = get_the_terms(get_the_ID(), 'joho-year');
          if (!empty($years) && !is_wp_error($years)) {
            foreach ($years as $term) {
              echo '<span class="cat-item year-' . esc_attr($term->slug) . '">';
              echo esc_html($term->name);
              echo '</span>';
            }
          }

          // 著者
          $authors = get_the_terms(get_the_ID(), 'joho-author');
          if (!empty($authors) && !is_wp_error($authors)) {
            foreach ($authors as $term) {
              echo '<span class="cat-item author-' . esc_attr($term->slug) . '">';
              echo esc_html($term->name);
              echo '</span>';
            }
          }
          ?>
        </span>
        <div class="single_inner">
          <div class="grid_box_list grid_2_1">
            <div class="box">
              <figure>
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('medium'); ?>
                <?php else: ?>
                  <img src="<?php echo imdir(); ?>/joho/joho_dummy.png" alt="ダミー画像">
                <?php endif; ?>
              </figure>
            </div>
            <div class="box">
              <?php
              $type = get_field('description_type');

              // デフォルトを text に
              if (!$type) {
                $type = 'text';
              }

              if ($type === 'list' && have_rows('description_list')) :

                echo '<ul class="description_list disc_list">';
                while (have_rows('description_list')) {
                  the_row();
                  $item = get_sub_field('item');
                  if ($item) {
                    echo '<li>' . esc_html($item) . '</li>';
                  }
                }
                echo '</ul>';

              else :

                // text（デフォルト含む）
                $text = get_field('description_text');
                if ($text) {
                  echo '<div class="description_text">';
                  echo wp_kses_post($text);
                  echo '</div>';
                }

              endif;
              ?>
            </div>
          </div>
          <?php the_content(); ?>
        </div>
        <div class="btn_inner">
          <!-- 一覧へボタン -->
          <a href="<?= esc_url(home_url('joho')) ?>" class="commonBtn center">
            <span>情報誌「大阪港」一覧へ戻る</span>
          </a>
        </div>
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
          <a href="#" class="sidebar_btn commonBtn"><span>要旨</span></a>
          <a href="#" class="sidebar_btn commonBtn link_btn"><span>Take of contents<br>"Osaka Port"</span></a>
          <a href="#" class="sidebar_btn commonBtn"><span>大阪港を読む</span></a>
        </div>

      </aside>
    </div>
  </section>

</main>
<?php
get_footer();
?>