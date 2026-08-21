<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Template Name: Search Results
 * Description: English Version
 */

get_header(); ?>

<div style="background-color: #ffffff; padding: 40px 0 20px 0; margin-bottom: 20px; border-bottom: 1px solid #eee;">
    <div class="container">
        <p style="font-size: 0.85rem; color: #888; margin-bottom: 5px; text-transform: uppercase;">
            Search Results For:
        </p>
        <h1 style="font-size: 2rem; color: var(--se-dark);">
            "<?php echo esc_html( get_search_query() ); ?>"
        </h1>
    </div>
</div>

<div class="container" style="min-height: 400px; padding-bottom: 60px;">
    
    <?php if ( have_posts() ) : ?>
        <div class="features-grid">
            <?php while ( have_posts() ) : the_post(); ?>
                
                <article class="card" style="display: flex; flex-direction: column;">
                    <h3 style="margin-bottom: 10px;">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div style="font-size: 0.9rem; color: #666; margin-bottom: 15px; flex-grow: 1;">
                        <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" style="color:var(--se-green); font-weight:bold; font-size: 0.85rem;">
                        View Details &rarr;
                    </a>
                </article>

            <?php endwhile; ?>
        </div>

        <div style="margin-top: 40px; text-align: center;">
            <?php the_posts_pagination(); ?>
        </div>

    <?php else : ?>

        <div style="text-align: center; padding: 50px 0;">
            <h2 style="color: #ccc; margin-bottom: 20px;">Sorry, no results found.</h2>
            <p>Please try again with different keywords.</p>
            
            <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>" style="max-width: 400px; margin: 20px auto; display:flex; gap:10px;">
                <input type="search" class="search-field" placeholder="Search again..." name="s" />
                <button type="submit" class="search-submit">Search</button>
            </form>
        </div>

    <?php endif; ?>

</div>

<?php get_footer(); ?>