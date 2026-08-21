<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 
// Mendeteksi bahasa dari Polylang / Setting WP
$lang = get_bloginfo('language'); 
$is_indo = ( strpos($lang, 'id') !== false ); // True jika Indonesia

// Teks dinamis berdasarkan bahasa
$txt_search_btn = $is_indo ? 'Cari' : 'Search';
$txt_placeholder = $is_indo ? 'Ketik kata kunci...' : 'Type keywords...';
$txt_search_submit = $is_indo ? 'Cari' : 'Search';
?>

<header class="site-header">
    <div class="container header-inner">
        
        <div class="logo">
            <?php if ( has_custom_logo() ) { the_custom_logo(); } ?>
            <div class="logo-text">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <span class="site-title-text"><?php bloginfo( 'name' ); ?></span>
                    <span class="site-tagline-text"><?php bloginfo( 'description' ); ?></span>
                </a>
            </div>
        </div>

        <button class="menu-toggle" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>

        <nav class="main-nav">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'menu',
                'fallback_cb'    => false,
                'depth'          => 0,
            ) );
            ?>
        </nav>
        
        <div class="header-actions" style="display:flex; gap:15px; align-items:center;">
            
            <div class="search-wrapper">
                <button id="search-btn" aria-label="Search">
                    <span style="font-size:16px; margin-right:5px;">&#128269;</span> 
                    <?php echo esc_html( $txt_search_btn ); ?>
                </button>
                
                <div class="search-dropdown">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr( $txt_placeholder ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
                        <button type="submit" class="search-submit"><?php echo esc_html( $txt_search_submit ); ?></button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</header>