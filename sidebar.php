<aside>
    <h2>カテゴリ</h2>
    <ul class="side_cat">
        <?php $args = array(
        'title_li' => '', //見出し削除
        'show_count' => '',
        );
        wp_list_categories($args); ?>
    </ul>

</aside>