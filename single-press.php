<?php

/**
 *　トピックス 詳細ページ
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
      <li><a href="<?= esc_url(home_url('press')) ?>">グッズ・刊行物一覧</a></li>
      <li><?php the_title(); ?></li>
    </ul>
  </div>

  <section id="press_single">
    <div class="sec_inner sec_size02">
      <div class="grid_box_list grid_2_1">
        <div class="box text_box">
          <h2 class="press_main_ttl"><?php the_title(); ?></h2>
          <div class="press_flex">
            <p class="press_tag">販売価格</p>
            <div class="press_price_box">
              <?php if (get_field('memberprice_text')): ?>
                <dl>
                  <dt>会員価格</dt>
                  <dd><span><?php the_field('memberprice_text'); ?></span>円</dd>
                </dl>
              <?php endif; ?>
              <?php if (get_field('generalprice')): ?>
                <dl>
                  <dt>一般価格</dt>
                  <dd><span><?php the_field('generalprice'); ?></span>円</dd>
                </dl>
              <?php endif; ?>
            </div>
          </div>
          <?php
          $press_explanation = get_field('press_explanation');
          $asterisk_rows = get_field('asterisk_repeat');

          if ($press_explanation || $asterisk_rows):
          ?>
            <div class="light_blue_box">
              <?php if ($press_explanation): ?>
                <p><?php echo nl2br(esc_html($press_explanation)); ?></p>
              <?php endif; ?>

              <?php if ($asterisk_rows): ?>
                <ul class="mt20">
                  <?php foreach ($asterisk_rows as $row): ?>
                    <li class="asterisk">
                      <?php echo esc_html($row['asterisk_text']); ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="box img_box"><?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium'); ?>
          <?php else: ?>
            <img src="<?php echo imdir(); ?>/press/good_dummy.png" alt="ダミー画像">
          <?php endif; ?>
        </div>
      </div>
      <div class="press_contents" id="purchase">
        <div class="light_blue_box">
          <h3 class="sec_ttl03">ご購入について</h3>
          <h4 class="sec_ttl05 border_bottom">購入場所</h4>
          <p>公益社団法人大阪港振興協会事務所内<br>
            〒552-0021 大阪府大阪市港区築港2-1-2　第一大阪港ビル７階</p>
          <h4 class="sec_ttl05 border_bottom">郵送をご希望の方</h4>
          <p class="press_num_list mb20"><span class="num">1</span><span class="text">
              下記連絡先のいずれかよりお客様のお名前（フリガナ）、郵便番号、ご住所、連絡先電話番号、ご希望の商品名、数量をご連絡ください。
              商品代金に加え、別途送料が必要となりますのでご連絡いただきましたら送料をおしらせいたします。
            </span></p>
          <div class="press_indent_box">
            <a href="" class="commonBtn pdf mb20">
              <span>ご注文 申込書PDF（メールまたはFAXにて受付します。）</span>
            </a>
            <div class="press_flex mb20">
              <p class="press_tag">ご連絡先</p>
              <div class="press_price_box">
                <dl>
                  <dt>E-mail</dt>
                  <dd>goods@oppa.or.jp</dd>
                </dl>
                <dl>
                  <dt>FAX番号</dt>
                  <dd>06-6575-9576</dd>
                </dl>
                <dl>
                  <dt>電話番号</dt>
                  <dd>06-6575-9575</dd>
                </dl>
              </div>
            </div>
          </div>
          <p class="press_num_list mb20"><span class="num">2</span><span class="text">代金の入金確認後、商品を発送いたします。</span></p>
          <div class="press_indent_box">
            <p class="press_blue_ttl">入金方法</p>
            <div class="white_box mb10">
              <p class="press_blue_ttl">現金書留の場合</p>
              <p class="press_ttl02">現金書留送付先</p>
              <p class="mb10">〒552-0021　大阪府大阪市港区築港2-1-2　第一大阪港ビル７階<br>
                公益社団法人大阪港振興協会</p>
              <p>TEL：06-6575-9575</p>
            </div>
            <div class="white_box mb10">
              <p class="press_blue_ttl">銀行振込の場合</p>
              <p class="press_ttl02">振込先</p>
              <p class="mb10">三井住友銀行　港支店　普通預金<br>
                口座番号　1113098<br>
                口座名義　公益社団法人　大阪港振興協会（オオサカコウシンコウキョウカイ）</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

</main>
<?php
get_footer();
?>