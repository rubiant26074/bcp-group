<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Template Name: Single Post
 * Description: English Version
 */

get_header(); ?>

<div style="background-color: #ffffff; padding: 40px 0 20px 0; margin-bottom: 20px;">
    <div class="container">
        <p style="font-size: 0.85rem; color: var(--se-green); margin-bottom: 10px; text-transform: uppercase; font-weight: bold;">
            News & Updates
        </p>
        <h1 style="font-size: 2.2rem; color: var(--se-dark); line-height: 1.3;">
            <?php the_title(); ?>
        </h1>
    </div>
</div>

<div class="container">
    <div style="display: flex; flex-wrap: wrap; gap: 40px;">
        
        <main style="flex: 3; min-width: 300px;">
            <?php 
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>">
                        <div style="margin-bottom: 20px; font-size: 0.9rem; color: #888; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                            <span style="margin-right: 15px;">&#128197; <?php echo get_the_date(); ?></span>
                            <span>&#128100; <?php the_author(); ?></span>
                        </div>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div style="margin-bottom: 30px;">
                                <?php the_post_thumbnail( 'large', array( 'style' => 'width:100%; height:auto; border-radius:4px;' ) ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content" style="line-height: 1.8; color: #333; font-size: 1.1rem;">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php 
                endwhile; 
            endif; 
            ?>
        </main>

        <aside style="flex: 1; min-width: 250px;">
            <div style="background: #fcfcfc; padding: 25px; border-radius: 4px; border: 1px solid #eee;">
                <h4 style="margin-bottom: 15px; border-bottom: 2px solid var(--se-green); display:inline-block; padding-bottom:5px; font-size: 1rem;">Recent News</h4>
                <ul style="list-style: none; padding: 0;">
                    <?php
                    $recent_posts = new WP_Query( array( 'posts_per_page' => 5, 'post__not_in' => array( get_the_ID() ) ) );
                    
                    if ( $recent_posts->have_posts() ) :
                        while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                            <li style="margin-bottom: 15px; font-size: 0.9rem; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px;">
                                <a href="<?php the_permalink(); ?>" style="color: #444; font-weight: 600; display:block; margin-bottom:5px;">
                                    <?php the_title(); ?>
                                </a>
                                <span style="font-size: 0.8rem; color: #999;"><?php echo get_the_date(); ?></span>
                            </li>
                        <?php endwhile;
                        wp_reset_postdata();
                    else : ?>
                        <li>No recent news available.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </aside>

    </div>
</div>

<div style="margin-top: 80px;"></div>

<?php get_footer(); ?>