<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Template Name: Standard Page
 * Description: Template untuk halaman statis (About Us, Services, dll)
 */

get_header(); ?>

<div class="page-title-bar">
    <div class="container">
        <h1 class="page-title">
            <?php the_title(); ?>
        </h1>
    </div>
</div>

<div class="container" style="padding-bottom: 80px;">
    <div class="entry-content">
        <?php 
        if ( have_posts() ) : 
            while ( have_posts() ) : the_post(); 
                the_content(); 
            endwhile; 
        endif; 
        ?>
    </div>
</div>

<?php get_footer(); ?>
