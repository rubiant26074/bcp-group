<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Template Part: Section Gallery
 * Description: Menampilkan galeri foto proyek dan fasilitas perusahaan
 */

$lang = get_bloginfo('language'); 
$is_indo = ( strpos($lang, 'id') !== false );

$title = $is_indo ? 'Galeri Dokumentasi & Fasilitas' : 'Documentation & Facility Gallery';
$desc  = $is_indo 
    ? 'Dokumentasi proyek, fasilitas produksi, dan aktivitas integrasi sistem kelistrikan PT. Berkah Cipta Persada.'
    : 'Project documentation, production facilities, and electrical system integration activities of PT. Berkah Cipta Persada.';
?>

<!-- PAGE TITLE -->
<div class="page-title-bar">
    <div class="container">
        <h1 class="page-title"><?php echo esc_html($title); ?></h1>
        <p style="color:#666; max-width:700px; margin-top:10px;">
            <?php echo esc_html($desc); ?>
        </p>
    </div>
</div>

<!-- GALLERY CONTENT -->
<div class="container" style="padding: 60px 20px;">
    
    <?php
    $gallery_query = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 12,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    if ($gallery_query->have_posts()) :
    ?>
        <div class="features-grid">
            <?php
            while ($gallery_query->have_posts()) : $gallery_query->the_post();
                
                if (has_post_thumbnail()) {
                    $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                } else {
                    $img_url = bcp_get_first_image_from_content(get_the_ID());
                }

                if (!$img_url) {
                    $img_url = 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80';
                }
            ?>
                <article class="solution-card">
                    <div style="position:relative; overflow:hidden; height:220px;">
                        <img src="<?php echo esc_url($img_url); ?>" 
                             alt="<?php the_title_attribute(); ?>" 
                             class="solution-img"
                             style="width:100%; height:100%; object-fit:cover; transition:transform 0.4s ease;">
                    </div>
                    <div class="solution-content" style="padding: 20px;">
                        <h3 style="font-size: 1.1rem; margin-bottom: 10px;">
                            <a href="<?php the_permalink(); ?>" style="color:inherit; text-decoration:none;">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <p style="font-size:0.85rem; color:#888; margin-bottom:15px;">
                            📅 <?php echo get_the_date(); ?>
                        </p>
                        <a href="<?php the_permalink(); ?>" style="font-weight:bold; color:var(--se-green); font-size:0.9rem;">
                            <?php echo $is_indo ? 'Lihat Detail →' : 'View Detail →'; ?>
                        </a>
                    </div>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    <?php else : ?>
        <div style="text-align:center; padding:60px 0; color:#999;">
            <p><?php echo $is_indo ? 'Belum ada dokumentasi galeri yang diunggah.' : 'No gallery documentation available yet.'; ?></p>
        </div>
    <?php endif; ?>

</div>
