<?php
function my_theme_enqueue_assets()
{

    // =========================
    // front-pageだけ読み込む
    // =========================
    if (is_front_page()) {

        // slick CSS
        wp_enqueue_style(
            'slick-css',
            'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css'
        );

        // slick JS
        wp_enqueue_script(
            'slick-js',
            'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
            array('jquery'),
            '1.8.1',
            true
        );

        // matchHeight
        wp_enqueue_script(
            'matchheight-js',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js',
            array('jquery'),
            '0.7.2',
            true
        );

        // top.js
        wp_enqueue_script(
            'top-script',
            get_template_directory_uri() . '/assets/js/top.js',
            array('jquery', 'slick-js'), // slickの後に読み込む
            filemtime(get_template_directory() . '/assets/js/top.js'),
            true
        );
    }
    // =========================
    // shipページだけ読み込む
    // =========================
    if (is_page('ship')) {
        wp_enqueue_style(
            'scroll-hint-css',
            'https://unpkg.com/scroll-hint@1.1.10/css/scroll-hint.css'
        );
        wp_enqueue_script(
            'ship-script',
            get_template_directory_uri() . '/assets/js/ship.js',
            array('jquery'),
            filemtime(get_template_directory() . '/assets/js/ship.js'),
            true
        );
        wp_enqueue_script(
            'scroll-hint',
            'https://unpkg.com/scroll-hint@1.1.10/js/scroll-hint.min.js',
            [],
            null,
            true
        );
    }
    // =========================
    // joinページだけ読み込む
    // =========================
    if (is_page('join')) {
        // matchHeight
        wp_enqueue_script(
            'matchheight-js',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js',
            array('jquery'),
            '0.7.2',
            true
        );
        wp_enqueue_script(
            'join-script',
            get_template_directory_uri() . '/assets/js/join.js',
            array('jquery'),
            filemtime(get_template_directory() . '/assets/js/join.js'),
            true
        );
    }
    // =========================
    // johoページだけ読み込む
    // =========================
    if (is_post_type_archive("joho") || is_singular("joho") || is_tax("joho-year") || is_tax("joho-author")) {
        wp_enqueue_script(
            'joho-script',
            get_template_directory_uri() . '/assets/js/joho.js',
            array('jquery'),
            filemtime(get_template_directory() . '/assets/js/joho.js'),
            true
        );
    }
    // =========================
    // membership_formページだけ読み込む
    // =========================
    if (is_page('membership_form')) {
        wp_enqueue_script(
            'ajaxzip3',
            'https://ajaxzip3.github.io/ajaxzip3.js',
            array(),
            null,
            true
        );
        wp_enqueue_script(
            'membership_form-script',
            get_template_directory_uri() . '/assets/js/membership_form.js',
            array('jquery'),
            filemtime(get_template_directory() . '/assets/js/membership_form.js'),
            true
        );
    }
    // 1. CSS（SCSSからコンパイルされたやつ）の読み込み
    wp_enqueue_style(
        'my-main-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/style.css')
    );

    // 2. JavaScriptの読み込み
    wp_enqueue_script(
        'my-main-script',
        get_template_directory_uri() . '/assets/js/common.js',
        array('jquery'),
        '1.0.0',
        true
    );
}
// WordPressの実行タイミングに登録
add_action('wp_enqueue_scripts', 'my_theme_enqueue_assets');



/**
 * スタイルとスクリプトから不要な type 属性を完全に消し去る
 */
add_action('after_setup_theme', function () {
    // HTML5の形式をサポートすることを宣言する
    add_theme_support('html5', array('script', 'style'));
});

// 万が一、上の設定を無視する頑固なプラグインがいる場合の強制排除
add_filter('style_loader_tag', 'remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'remove_type_attr', 10, 2);

function remove_type_attr($tag, $handle)
{
    return str_replace(" type='text/css'", '', str_replace(' type="text/javascript"', '', $tag));
}
