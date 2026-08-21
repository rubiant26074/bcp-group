<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * The main template file
 * FINAL – OPSI 2
 */

get_header(); 

// --- LOGIKA BAHASA ---
$lang = get_bloginfo('language'); 
$is_indo = ( strpos($lang, 'id') !== false );

// Judul Section
$sec_title = $is_indo ? 'Jelajahi Solusi Kami' : 'Explore Our Solutions';
$sec_desc  = $is_indo 
    ? 'Kami menyediakan berbagai layanan teknis integrasi kelistrikan dan manufaktur.' 
    : 'We provide various technical services for electrical integration and manufacturing needs.';

// Label Tombol
$btn_label = $is_indo ? 'Selengkapnya' : 'Learn More';
?>

<!-- ================= HERO SLIDER ================= -->
<?php
$slider_height = get_theme_mod('se_hero_slider_height', '60vh');
$slides        = [];

/* SLIDE (1–10) DARI CUSTOMIZER */
for ( $i = 1; $i <= 10; $i++ ) {

    $img = get_theme_mod("hero_slide_image_$i");
    if ( empty($img) ) continue;

    $overlay_val = get_theme_mod("hero_slide_overlay_$i", '0.55');
    $bg_size     = get_theme_mod("hero_slide_bg_size_$i", 'cover');
    $bg_pos      = get_theme_mod("hero_slide_bg_pos_$i", 'center center');
    $btn_align   = get_theme_mod("hero_slide_btn_align_$i", 'auto');

    $title = get_theme_mod("hero_slide_title_$i");
    $desc  = get_theme_mod("hero_slide_desc_$i");

    // Perataan otomatis atau manual
    $align_class = 'slide-content--align-left';
    if ( $btn_align === 'center' || ($btn_align === 'auto' && empty($title) && empty($desc)) ) {
        $align_class = 'slide-content--align-center';
    } elseif ( $btn_align === 'right' ) {
        $align_class = 'slide-content--align-right';
    }

    $slides[] = [
        'image'       => $img,
        'title'       => $title,
        'desc'        => $desc,
        'btn_text'    => get_theme_mod("hero_slide_btn_text_$i"),
        'btn_url'     => get_theme_mod("hero_slide_btn_url_$i"),
        'overlay'     => $overlay_val,
        'bg_size'     => $bg_size,
        'bg_pos'      => $bg_pos,
        'align_class' => $align_class,
    ];
}
?>

<?php if ( !empty($slides) ) : ?>
<div class="swiper hero-slider" style="height:<?php echo esc_attr($slider_height); ?>;">
    <div class="swiper-wrapper">

        <?php foreach ( $slides as $slide ) : ?>
        <div class="swiper-slide"
             style="background-image:url('<?php echo esc_url($slide['image']); ?>'); background-size:<?php echo esc_attr($slide['bg_size']); ?>; background-position:<?php echo esc_attr($slide['bg_pos']); ?>; background-repeat:no-repeat;">

            <div class="overlay" style="background: rgba(0,0,0,<?php echo esc_attr($slide['overlay']); ?>);"></div>

            <div class="container slide-content <?php echo esc_attr( $slide['align_class'] ); ?>">

                <?php if (!empty($slide['title'])) : ?>
                    <h1><?php echo wp_kses_post($slide['title']); ?></h1>
                <?php endif; ?>

                <?php if (!empty($slide['desc'])) : ?>
                    <div class="hero-desc">
                        <?php echo wp_kses_post($slide['desc']); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($slide['btn_text'])) : ?>
                    <a href="<?php echo esc_url($slide['btn_url']); ?>" class="btn-se">
                        <?php echo esc_html($slide['btn_text']); ?>
                    </a>
                <?php endif; ?>

            </div>
        </div>
        <?php endforeach; ?>

    </div>

    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
<?php endif; ?>
<!-- ================= END HERO SLIDER ================= -->


<!-- ================= SOLUTIONS SECTION ================= -->
<section class="solutions-section">
    <div class="container">

        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:30px;">
            <div style="max-width:700px;">
                <h2 style="font-size:2rem; margin-bottom:10px;">
                    <?php echo esc_html($sec_title); ?>
                </h2>
                <p style="color:#666;">
                    <?php echo esc_html($sec_desc); ?>
                </p>
            </div>

            <div class="slider-nav-btns mobile-hide">
                <button class="slider-btn" onclick="document.querySelector('.solutions-slider').scrollBy({left:-360,behavior:'smooth'})">&larr;</button>
                <button class="slider-btn" onclick="document.querySelector('.solutions-slider').scrollBy({left:360,behavior:'smooth'})">&rarr;</button>
            </div>
        </div>

        <div class="solutions-slider">
        <?php for ( $k = 1; $k <= 6; $k++ ) : 

            $s_img      = get_theme_mod("sol_img_$k");
            $s_cat_id   = get_theme_mod("sol_cat_id_$k", "Kategori $k");
            $s_cat_en   = get_theme_mod("sol_cat_en_$k", "Category $k");
            $s_title_id = get_theme_mod("sol_title_id_$k", "Judul Solusi $k");
            $s_title_en = get_theme_mod("sol_title_en_$k", "Solution Title $k");
            $s_desc_id  = get_theme_mod("sol_desc_id_$k", "Deskripsi singkat layanan.");
            $s_desc_en  = get_theme_mod("sol_desc_en_$k", "Short service description.");
            $s_link     = get_theme_mod("sol_link_$k", '#');

            $show_cat   = $is_indo ? $s_cat_id : $s_cat_en;
            $show_title = $is_indo ? $s_title_id : $s_title_en;
            $show_desc  = $is_indo ? $s_desc_id : $s_desc_en;

            if(empty($s_img)) {
                $s_img = 'https://via.placeholder.com/600x400/eeeeee/cccccc?text=No+Image';
            }
        ?>
            <div class="solution-card">
                <img src="<?php echo esc_url($s_img); ?>" 
                     alt="<?php echo esc_attr($show_title); ?>" 
                     class="solution-img">

                <div class="solution-content">
                    <h4 style="color:var(--se-green); font-size:0.8rem; font-weight:800; margin-bottom:10px;">
                        <?php echo esc_html($show_cat); ?>
                    </h4>

                    <h3 style="margin-bottom:15px;">
                        <a href="<?php echo esc_url($s_link); ?>" style="color:inherit; text-decoration:none;">
                            <?php echo esc_html($show_title); ?>
                        </a>
                    </h3>

                    <p style="font-size:0.9rem; color:#666; margin-bottom:25px; line-height:1.6;">
                        <?php echo esc_html($show_desc); ?>
                    </p>

                    <a href="<?php echo esc_url($s_link); ?>" style="font-weight:bold; color:var(--se-dark);">
                        <?php echo esc_html($btn_label); ?> →
                    </a>
                </div>
            </div>
        <?php endfor; ?>
        </div>

    </div>
</section>
<!-- ================= END SOLUTIONS ================= -->


<!-- ================= NEWS & LATEST UPDATES ================= -->
<section class="container" style="padding:60px 20px;">
    <h2 style="margin-bottom:30px; font-size:2rem;">
        <?php echo $is_indo ? 'Berita & ' : 'News & '; ?>
        <strong style="color:var(--se-green);">
            <?php echo $is_indo ? 'Update Terbaru' : 'Latest Updates'; ?>
        </strong>
    </h2>

    <div class="news-grid">
    <?php
    $home_news = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 2,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    if ($home_news->have_posts()) :
        while ($home_news->have_posts()) : $home_news->the_post();

            if (has_post_thumbnail()) {
                $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            } else {
                $thumb_url = bcp_get_first_image_from_content(get_the_ID());
            }
    ?>
        <article class="news-card news-card--spin">

            <?php if ($thumb_url) : ?>
                <div class="news-thumb">
                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                </div>
            <?php endif; ?>

            <h3><?php the_title(); ?></h3>

            <p class="news-excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 22); ?>
            </p>

            <a href="<?php the_permalink(); ?>" class="read-more">
                <?php echo $is_indo ? 'Baca Selengkapnya' : 'Read More'; ?> →
            </a>

        </article>
    <?php endwhile; wp_reset_postdata(); else : ?>
        <p style="color:#999;">
            <?php echo $is_indo ? 'Belum ada berita.' : 'No news available.'; ?>
        </p>
    <?php endif; ?>
    </div>
</section>
<!-- ================= END NEWS ================= -->

<?php get_footer(); ?>
