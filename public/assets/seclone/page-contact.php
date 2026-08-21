<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Template Name: Contact Us Page
 * Description: Contact page with clickable Google Maps link (no embed)
 */

get_header(); 

// =====================================
// GET DATA FROM CUSTOMIZER
// =====================================
$company_name  = get_theme_mod('se_contact_company', 'PT. BERKAH CIPTA PERSADA');
$address       = get_theme_mod(
    'se_contact_address',
    "Kawasan Industri Jababeka 1\nJl. Jababeka Raya Blok B No. 12\nCikarang, Bekasi"
);
$phone         = get_theme_mod('se_contact_phone', '(021) 8983-xxxx');
$email         = get_theme_mod('se_contact_email', 'sales@berkahcipta.co.id');
$maps_embed    = get_theme_mod('se_contact_map', '');
$cf7_shortcode = get_theme_mod('se_cf7_shortcode', '[contact-form-7 id="fe32a01" title="Contact form 1"]');

// Google Maps link (short link / app link fallback)
$maps_link = 'https://maps.app.goo.gl/aM7Jij5xqzqUHyWa7';

// Format output
$address_html = nl2br( esc_html( $address ) );
$phone_html   = nl2br( esc_html( $phone ) );
?>

<!-- ==============================
PAGE TITLE
============================== -->
<div style="background:#ffffff; padding:40px 0 20px; border-bottom:1px solid #eee;">
    <div class="container">
        <h1 style="font-size:2.5rem; font-weight:700; color:var(--se-dark); margin:0;">
            <?php the_title(); ?>
        </h1>
    </div>
</div>

<!-- ==============================
CONTENT
============================== -->
<div class="container" style="padding:60px 20px;">

    <div class="contact-grid">

        <!-- ==============================
        CONTACT FORM
        ============================== -->
        <div class="contact-form-area">
            <h3 style="margin-bottom:20px;">Send Message</h3>
            <p style="margin-bottom:30px; color:#666;">
                Please fill out the form below to discuss your project needs.
            </p>

            <?php if ( ! empty( $cf7_shortcode ) ) : ?>
                <?php echo do_shortcode( wp_kses_post( $cf7_shortcode ) ); ?>
            <?php endif; ?>
        </div>

        <!-- ==============================
        CONTACT INFO
        ============================== -->
        <div class="contact-info-area">

            <div class="info-box">
                <h4>Head Office</h4>
                <p>
                    <strong><?php echo esc_html( $company_name ); ?></strong><br>
                    <?php echo $address_html; ?>
                </p>
            </div>

            <div class="info-box">
                <h4>Direct Contact</h4>
                <table style="width:100%; border-collapse:collapse; font-size:0.95rem; line-height:1.6;">
                    <tr>
                        <td style="width:25px; vertical-align:top; padding-bottom:10px;">📞</td>
                        <td style="width:100px; font-weight:bold; padding-bottom:10px;">Phone:</td>
                        <td style="color:#444; padding-bottom:10px;"><?php echo $phone_html; ?></td>
                    </tr>
                    <tr>
                        <td style="width:25px; vertical-align:top; padding-bottom:10px;">📧</td>
                        <td style="width:100px; font-weight:bold; padding-bottom:10px;">Email:</td>
                        <td style="color:#444; padding-bottom:10px;"><?php echo esc_html( $email ); ?></td>
                    </tr>
                    <tr>
                        <td style="width:25px; vertical-align:top;">🕐</td>
                        <td style="width:100px; font-weight:bold;">Office Hours:</td>
                        <td style="color:#444;">Monday – Saturday (08.00 – 16.00)</td>
                    </tr>
                </table>
            </div>

            <!-- ==============================
            GOOGLE MAPS EMBED / LINK
            ============================== -->
            <div class="map-box" style="margin-top:20px;">
                <?php if ( ! empty( $maps_embed ) ) : ?>
                    <div style="border:1px solid #ddd; border-radius:6px; overflow:hidden;">
                        <?php echo se_sanitize_iframe( $maps_embed ); ?>
                    </div>
                <?php else : ?>
                    <a 
                        href="<?php echo esc_url( $maps_link ); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        style="text-decoration:none; color:inherit;"
                    >
                        <div style="
                            border:1px solid #ddd;
                            border-radius:6px;
                            padding:20px;
                            background:#f9f9f9;
                            transition:all .3s ease;
                        "
                        onmouseover="this.style.background='#f1f1f1'"
                        onmouseout="this.style.background='#f9f9f9'"
                        >
                            <h4 style="margin-bottom:8px;">📍 View Location on Google Maps</h4>
                            <p style="margin:0; color:#666; font-size:0.95rem;">
                                PT. Berkah Cipta Persada – Deltamas, Cikarang
                            </p>
                            <p style="margin-top:8px; font-size:0.85rem; color:#999;">
                                Click to open directions & navigation
                            </p>
                        </div>
                    </a>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>

<?php get_footer(); ?>
