<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Template Name: Career Page
 * Description: Halaman lowongan kerja PT. Berkah Cipta Persada
 */

get_header();
?>

<!-- PAGE TITLE -->
<div class="page-title-bar">
    <div class="container">
        <h1 class="page-title">Career</h1>
        <p style="color:#666; max-width:700px;">
            Join PT. Berkah Cipta Persada and grow your career with a professional
            manufacturing & electrical integration team.
        </p>
    </div>
</div>

<!-- CAREER LIST -->
<div class="container career-page">
    <div class="career-grid">

        <?php
        $career_query = new WP_Query([
            'post_type'      => 'career',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        if ($career_query->have_posts()) :
            while ($career_query->have_posts()) : $career_query->the_post();

                // PRIORITAS THUMBNAIL (Featured Image > Gambar Pertama Konten > Default Fallback)
                if (has_post_thumbnail()) {
                    $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                } else {
                    $thumb_url = bcp_get_first_image_from_content(get_the_ID());
                }

                if (!$thumb_url) {
                    $thumb_url = 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80';
                }
                ?>

                <article class="career-card">

                    <?php if ($thumb_url) : ?>
                        <div class="career-thumb">
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                        </div>
                    <?php endif; ?>

                    <h3 class="career-title">
                        <?php the_title(); ?>
                    </h3>

                    <div class="career-meta">
                        <span>📍 Bekasi</span>
                        <span>🕒 Full Time</span>
                    </div>

                    <p class="career-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                    </p>

                    <a href="<?php the_permalink(); ?>" class="career-btn">
                        View Detail →
                    </a>

                </article>

            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p style="color:#999;">
                Currently there are no job vacancies available.
            </p>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
