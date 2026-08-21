<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Template Name: News & Updates Page
 * Description: Menampilkan berita & update internal perusahaan
 */

get_header();
?>

<!-- PAGE TITLE -->
<div class="page-title-bar">
    <div class="container">
        <h1 class="page-title">News & Updates</h1>
    </div>
</div>

<!-- NEWS CONTENT -->
<div class="container news-page">
    <div class="news-grid">

        <?php
        $news_query = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 6,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        if ($news_query->have_posts()) :
            while ($news_query->have_posts()) : $news_query->the_post();

                // PRIORITAS THUMBNAIL
                if (has_post_thumbnail()) {
                    $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                } else {
                    $thumb_url = bcp_get_first_image_from_content(get_the_ID());
                }
                ?>

                <article class="news-card">

                    <?php if ($thumb_url) : ?>
                        <div class="news-thumb">
                            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                        </div>
                    <?php endif; ?>

                    <h3><?php the_title(); ?></h3>

                    <p class="news-meta">
                        <?php echo get_the_date(); ?>
                    </p>

                    <p class="news-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 28); ?>
                    </p>

                    <a href="<?php the_permalink(); ?>" class="read-more">
                        Read More →
                    </a>

                </article>

            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>No updates available.</p>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
