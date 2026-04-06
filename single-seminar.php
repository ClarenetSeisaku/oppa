<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main class="middle">

    <div class="pankuzu_wrap">
        <ul class="pankuzu sec_inner">
            <li><a href="<?= esc_url(home_url()) ?>">TOP</a></li>
            <li><a href="<?= esc_url(home_url('seminar')) ?>">Seminars / Events</a></li>
            <li><?php the_title(); ?></li>
        </ul>
    </div>

    <?php while (have_posts()) : the_post(); ?>
        <div class="section-wrap">
            <p class="section-wrap__subtitle">サブタイトルが入ります。ダミーです。</p>
            <h1 class="section-wrap__title"><?php the_title(); ?></h1>

            <section class="section-wrap__card section-wrap__card--detail">
                <h2 class="section-wrap__heading">セミナー・イベント詳細</h2>
                <div class="section-wrap__content">
                    <?php if (trim((string) get_the_content()) !== '') : ?>
                        <?php the_content(); ?>
                    <?php else : ?>
                        <p>公益社団法人大阪港振興協会と大阪港埠頭株式会社は、国際港湾協会(IAPH)の活動に 14 年間の長き
                            にわたり携わり、同協会副会長を務められた篠原正治氏をお招きし、「世界のコンテナ港湾について
                            ～14 年間の国際港湾協会活動で学んだこと ～」と題した講演会を開催いたします。
                            同氏は長年港湾行政の第一線で活躍されるとともに、世界の港湾事情に精通され、豊富な実務経験と
                            高い学識を兼ね備えた港湾分野の第一人者です。
                            本講演では、IAPH の活動概要とその中で得られた教訓をはじめ、世界の自動化ターミナルの最新動
                            向、ロサンゼルス港・ロングビーチ港（LA・LB）などに見られる近接港湾における協調と競争の関係、
                            さらに、篠原氏が提唱された「Total Yard Move」という考え方に基づく、コンテナターミナルの生産性・効率性評価などについて、具体的な事例を交えながらお話しいただきます。</p>
                    <?php endif; ?>
                </div>
            </section>

            <section class="section-wrap__card section-wrap__card--speaker">
                <div class="section-wrap__speaker-main">
                    <h2 class="section-wrap__heading">講師</h2>
                    <p class="section-wrap__speaker-role">前国際港湾協会副会長、放送大学客員教授
                    </p>
                    <h3 class="section-wrap__speaker-name">篠原 正治氏</h3>
                    <p class="section-wrap__speaker-bio">講師の説明が入ります。ダミーです。講師の説明が入ります。ダミーです。講師の説明が入ります。ダミーです。講師の説明が入ります。ダミーです。講師の説明が入ります。ダミーです。講師の説明が入ります。ダミーです。講師の説明が入ります。ダミーです。講師の説明が入ります。ダミーです。
                        講師の説明が入ります。ダミーです。講師の説明が入ります。ダミーです。講師の説明が入ります。ダミーです。</p>
                </div>
                <div class="section-wrap__speaker-image" aria-hidden="true"></div>
            </section>

            <section class="section-wrap__card section-wrap__card--summary">
                <h2 class="section-wrap__heading">概要</h2>
                <p class="section-wrap__summary-status">本セミナーは終了しました</p>

                <table class="section-wrap__summary-table">
                    <tr>
                        <td>開催日時</td>
                        <td>令和8年2月25日（水）15:30～17:00</td>
                    </tr>
                    <tr>
                        <td>開催場所</td>
                        <td>
                            第一大阪港ビル8階会議室<br>
                            （大阪市港区築港2-1-2
                            大阪メトロ中央線「大阪港駅」下車、④番出口50m）
                        </td>
                    </tr>
                    <tr>
                        <td>応募人数</td>
                        <td>80人</td>
                    </tr>
                    <tr>
                        <td>参加費</td>
                        <td>
                            大阪港振興協会会員：無料<br>
                            会員外：1人 2,000円（当日受付にて支払い）
                        </td>
                    </tr>
                    <tr>
                        <td>申込方法</td>
                        <td><a href="#">申込みフォームから</a>お申込みください。</td>
                    </tr>
                    <tr>
                        <td>申込締切</td>
                        <td>令和8年2月18日（水）※定員になり次第締め切り</td>
                    </tr>
                    <tr>
                        <td>事務局</td>
                        <td>
                            公益社団法人大阪港振興協会
                            TEL：06-6575-9575
                            FAX：06-6575-9576
                        </td>
                    </tr>
                    <tr>
                        <td>主催</td>
                        <td>公益社団法人大阪港振興協会・大阪港埠頭</td>
                    </tr>

                </table>

                <a href="#" class="section-wrap__summary-link">
                    <span>タイトルが入りますダミーですタイトルが入りますダミーです</span>
                </a>
            </section>
        </div>

        <section class="seminar-entry">
            <h2 class="seminar-entry__title">タイトルが入ります。ダミーです。タイトルが入ります。</h2>
            <h3 class="seminar-entry__subtitle">お申込みフォーム</h3>
            <?php echo do_shortcode('[seminar_entry_form]'); ?>
        </section>
    <?php endwhile; ?>


</main>
<?php get_footer(); ?>