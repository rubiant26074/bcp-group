<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Footer.php - Complete Features
 * Features: Bilingual, Auto Slider, WA Chat Popup, Mobile Nav & Search Toggle
 */

// 1. LOGIKA BAHASA (BILINGUAL)
$lang = get_bloginfo('language'); 
$is_indo = ( strpos($lang, 'id') !== false );

// Kamus Kata Footer
$txt_company = $is_indo ? 'Perusahaan' : 'Company';
$txt_support = $is_indo ? 'Dukungan' : 'Support';
$txt_rights  = $is_indo ? 'Hak Cipta Dilindungi.' : 'All Rights Reserved.';
$txt_privacy = $is_indo ? 'Kebijakan Privasi' : 'Privacy Policy';
$txt_terms   = $is_indo ? 'Syarat Penggunaan' : 'Terms of Use';
?>

<footer>
    <div class="container">
        <div style="display:flex; flex-wrap:wrap; gap:30px; justify-content:space-between;">
            
            <!-- COMPANY DESC -->
            <div style="flex:2; min-width:250px;">
                <h4 style="
                    color:var(--se-green);
                    margin-bottom:20px;
                    text-transform:uppercase;
                    font-weight:800;
                    letter-spacing:1px;
                ">
                    <?php bloginfo('name'); ?>
                </h4>

                <p style="
                    color:#ccc;
                    font-size:0.9rem;
                    line-height:1.7;
                    max-width:350px;
                    text-align:justify;
                    text-justify:inter-word;
                ">
                    <strong style="font-weight:800; color:#ffffff; letter-spacing:0.5px;">
                        BE CORE POWERED
                    </strong>,
                    <?php echo $is_indo
                        ? 'Berpusat pada integrasi yang andal dan kuat. Kami menghadirkan solusi kelistrikan premium yang dibangun atas dasar presisi, integritas, dan inovasi. Dari proses fabrikasi hingga integrasi, sistem kami dirancang untuk memenuhi standar kualitas dan kinerja tertinggi. Kami tidak hanya menyalakan sistem, kami mendorong kemajuan.'
                        : 'Centered on powerful integration. We deliver premium electrical solutions built on precision, integrity, and innovation. From fabrication to integration, our systems are crafted to meet the highest standards of quality and performance. We don’t just power systems, we empower progress.';
                    ?>
                </p>
            </div>

            <!-- COMPANY MENU -->
            <div style="flex:1; min-width:180px;">
                <h4 style="margin-bottom:20px; border-bottom:2px solid var(--se-green); display:inline-block; padding-bottom:5px;">
                    <?php echo $txt_company; ?>
                </h4>
                <ul style="list-style:none; padding:0; font-size:0.9rem;">
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo esc_url( home_url( '/about-us' ) ); ?>" style="color:#bbb;"><?php echo $is_indo ? 'Tentang Kami' : 'About Us'; ?></a>
                    </li>
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo esc_url( home_url( '/careers' ) ); ?>" style="color:#bbb;"><?php echo $is_indo ? 'Lowongan' : 'Careers'; ?></a>
                    </li>
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo esc_url( home_url( '/news-updates' ) ); ?>" style="color:#bbb;"><?php echo $is_indo ? 'Berita' : 'News & Update'; ?></a>
                    </li>
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo esc_url( home_url( '/gallery' ) ); ?>" style="color:#bbb;"><?php echo $is_indo ? 'Galeri Proyek' : 'Project Gallery'; ?></a>
                    </li>
                </ul>
            </div>

            <!-- SUPPORT -->
            <div style="flex:1; min-width:180px;">
                <h4 style="margin-bottom:20px; border-bottom:2px solid var(--se-green); display:inline-block; padding-bottom:5px;">
                    <?php echo $txt_support; ?>
                </h4>
                <ul style="list-style:none; padding:0; font-size:0.9rem;">
                    <li style="margin-bottom:10px;">
                        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" style="color:#bbb;"><?php echo $is_indo ? 'Hubungi Sales' : 'Contact Sales'; ?></a>
                    </li>
                    <li style="margin-bottom:10px;">
                        <a href="#" style="color:#bbb;"><?php echo $is_indo ? 'Unduh Katalog' : 'Download Catalog'; ?></a>
                    </li>
                </ul>
            </div>

        </div>

        <hr style="border:0; border-top:1px solid #444; margin:30px 0;">
        
        <div style="display:flex; justify-content:space-between; flex-wrap:wrap; font-size:0.85rem; color:#888;">
            <div style="margin-bottom:10px;">
                &copy; <?php echo date('Y'); ?> <strong><?php bloginfo('name'); ?></strong>. <?php echo $txt_rights; ?>
            </div>
            <div>
                <a href="#" style="color:#888; margin-left:15px;"><?php echo $txt_privacy; ?></a>
                <a href="#" style="color:#888; margin-left:15px;"><?php echo $txt_terms; ?></a>
            </div>
        </div>
    </div>
</footer>

<!-- ===================== HERO SLIDER & UI INTERACTIONS ===================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    if (typeof Swiper !== 'undefined') {
        new Swiper('.hero-slider', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            speed: 800,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            }
        });
    }

    // Toggle Mobile Navigation
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav    = document.querySelector('.main-nav');
    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            mainNav.classList.toggle('active');
        });
    }

    // Toggle Search Popup
    const searchBtn      = document.getElementById('search-btn');
    const searchDropdown = document.querySelector('.search-dropdown');
    if (searchBtn && searchDropdown) {
        searchBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            searchDropdown.classList.toggle('active');
        });

        // Close search popup if clicked outside
        document.addEventListener('click', function (e) {
            if (!searchDropdown.contains(e.target) && e.target !== searchBtn) {
                searchDropdown.classList.remove('active');
            }
        });
    }

});
</script>

<?php wp_footer(); ?>

</body>
</html>

