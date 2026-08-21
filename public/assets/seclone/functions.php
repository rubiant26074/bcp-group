<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Functions.php - Logika Utama Tema SE Clone
 * Update: Menambahkan dukungan Upload Logo & Keamanan
 */

if ( ! function_exists( 'se_clone_setup' ) ) :

    function se_clone_setup() {
        
        // 1. Title Tag: Membiarkan WordPress mengatur judul di tab browser
        add_theme_support( 'title-tag' );

        // 2. Post Thumbnails: Mengaktifkan Gambar Unggulan untuk artikel/produk
        add_theme_support( 'post-thumbnails' );

        // 3. Custom Logo: Mengaktifkan menu "Logo" di Site Identity
        add_theme_support( 'custom-logo', array(
            'height'      => 80,    // Tinggi rekomendasi
            'width'       => 250,   // Lebar rekomendasi
            'flex-height' => true,  // Izinkan tinggi fleksibel (auto)
            'flex-width'  => true,  // Izinkan lebar fleksibel (auto)
        ) );

        // 4. Register Menus: Mendaftarkan lokasi menu
        register_nav_menus( array(
            'primary' => __( 'Primary Menu (Header Utama)', 'se-clone' ),
            'footer'  => __( 'Footer Links', 'se-clone' ),
        ) );
    }

endif;
// Hook fungsi setup agar berjalan saat tema diaktifkan
add_action( 'after_setup_theme', 'se_clone_setup' );


/**
 * Memuat CSS dan Script
 */
function se_clone_scripts() {
    // Memuat Swiper Slider CDN secara resmi
    wp_enqueue_style( 'swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );
    wp_enqueue_script( 'swiper-script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );

    // Memuat style.css utama
    wp_enqueue_style( 'se-style', get_stylesheet_uri(), array( 'swiper-style' ), microtime() );
}
add_action( 'wp_enqueue_scripts', 'se_clone_scripts' );

/**
 * ==========================================
 * CUSTOMIZER: PENGATURAN SLIDER (Hingga 10 Slot)
 * ==========================================
 */
function se_clone_customize_register( $wp_customize ) {

    // 1. Buat Bagian (Section) Baru
    $wp_customize->add_section( 'se_hero_slider_section', array(
        'title'       => __( 'Hero Slider Setting', 'se-clone' ),
        'description' => 'Upload gambar, atur kecerahan, ukuran fit foto, dan teks slider di sini (Hingga 10 Slide).',
        'priority'    => 30,
    ) );

    // --- PENGATURAN GLOBAL: TINGGI SLIDER ---
    $wp_customize->add_setting( 'se_hero_slider_height', array(
        'default'           => '60vh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'se_hero_slider_height', array(
        'label'       => __( 'Tinggi Hero Slider (Ukuran Layar)', 'se-clone' ),
        'description' => 'Pilih tinggi area slider pada tampilan website.',
        'section'     => 'se_hero_slider_section',
        'type'        => 'select',
        'priority'    => 1,
        'choices'     => array(
            '60vh'  => '📐 Standar (Tinggi 60% Layar / ±500px)',
            '80vh'  => '📐 Layar Hampir Penuh (Tinggi 80% Layar)',
            '100vh' => '📐 Full Screen (Tinggi 100% Layar Penuh)',
            '500px' => '📐 Ukuran Khusus: 500px',
            '400px' => '📐 Ukuran Khusus: 400px (Ringkas)',
            '650px' => '📐 Ukuran Khusus: 650px (Besar)',
        ),
    ) );

    // 2. Loop untuk membuat 10 Slot Slide
    for ( $i = 1; $i <= 10; $i++ ) {
        
        // --- A. Upload Gambar ---
        $wp_customize->add_setting( "hero_slide_image_$i", array(
            'default'           => '',
            'transport'         => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "hero_slide_image_$i", array(
            'label'    => __( "Slide $i - Gambar Background", 'se-clone' ),
            'section'  => 'se_hero_slider_section',
            'settings' => "hero_slide_image_$i",
        ) ) );

        // --- A2. Tingkat Kegelapan / Kecerahan Foto (Overlay) ---
        $wp_customize->add_setting( "hero_slide_overlay_$i", array(
            'default'           => '0.55',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "hero_slide_overlay_$i", array(
            'label'       => __( "Slide $i - Tingkat Kegelapan Foto (Overlay)", 'se-clone' ),
            'description' => 'Pilih mencerahkan atau menggelapkan foto slide ini.',
            'section'     => 'se_hero_slider_section',
            'type'        => 'select',
            'choices'     => array(
                '0'    => '☀️ Terang Asli (Tanpa Gelap / 0%)',
                '0.2'  => '🌤️ Redup Terang (Kegelapan 20%)',
                '0.4'  => '🌥️ Sedang Terang (Kegelapan 40%)',
                '0.55' => '⚖️ Standar (Kegelapan 55%)',
                '0.7'  => '🌙 Agak Gelap (Kegelapan 70%)',
                '0.85' => '🌑 Sangat Gelap (Kegelapan 85%)',
            ),
        ) );

        // --- A3. Mode Fit Foto (Cover / Contain / Fit Utuh / Stretch) ---
        $wp_customize->add_setting( "hero_slide_bg_size_$i", array(
            'default'           => 'cover',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "hero_slide_bg_size_$i", array(
            'label'       => __( "Slide $i - Mode Tampilan Foto (Fit / Scale)", 'se-clone' ),
            'description' => 'Pilih cara foto ditampilkan dalam slide.',
            'section'     => 'se_hero_slider_section',
            'type'        => 'select',
            'choices'     => array(
                'cover'     => '🖼️ Cover / Full Crop (Memenuhi area slider)',
                'contain'   => '🖼️ Contain / Fit Utuh (Tampilkan seluruh foto tanpa terpotong)',
                '100% 100%' => '🖼️ Stretch Full (Foto diregangkan memenuhi area)',
                'auto'      => '🖼️ Ukuran Asli (Auto)',
            ),
        ) );

        // --- A4. Posisi Fokus Foto ---
        $wp_customize->add_setting( "hero_slide_bg_pos_$i", array(
            'default'           => 'center center',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "hero_slide_bg_pos_$i", array(
            'label'       => __( "Slide $i - Posisi Fokus Foto", 'se-clone' ),
            'description' => 'Atur titik fokus tampilan foto.',
            'section'     => 'se_hero_slider_section',
            'type'        => 'select',
            'choices'     => array(
                'center center' => '🎯 Tengah (Center)',
                'top center'    => '⬆️ Atas Tengah (Top Center)',
                'bottom center' => '⬇️ Bawah Tengah (Bottom Center)',
                'center left'   => '⬅️ Kiri Tengah (Left Center)',
                'center right'  => '➡️ Kanan Tengah (Right Center)',
            ),
        ) );

        // --- B. Judul (Title) ---
        $wp_customize->add_setting( "hero_slide_title_$i", array(
            'default'           => $i <= 3 ? "Judul Slide $i Disini" : "",
            'sanitize_callback' => 'wp_kses_post',
        ) );
        $wp_customize->add_control( "hero_slide_title_$i", array(
            'label'       => __( "Slide $i - Judul Utama", 'se-clone' ),
            'description' => 'Gunakan tag &lt;br&gt; untuk baris baru dan &lt;strong&gt; untuk teks tebal.',
            'section'     => 'se_hero_slider_section',
            'type'        => 'text',
        ) );

        // --- C. Deskripsi (Textarea) ---
        $wp_customize->add_setting( "hero_slide_desc_$i", array(
            'default'           => $i <= 3 ? "Deskripsi singkat untuk slide ini." : "",
            'sanitize_callback' => 'wp_kses_post',
        ) );
        $wp_customize->add_control( "hero_slide_desc_$i", array(
            'label'   => __( "Slide $i - Deskripsi", 'se-clone' ),
            'section' => 'se_hero_slider_section',
            'type'    => 'textarea',
        ) );

        // --- D. Teks Tombol ---
        $wp_customize->add_setting( "hero_slide_btn_text_$i", array(
            'default'           => $i <= 3 ? "Pelajari Lebih Lanjut" : "",
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "hero_slide_btn_text_$i", array(
            'label'   => __( "Slide $i - Teks Tombol", 'se-clone' ),
            'section' => 'se_hero_slider_section',
            'type'    => 'text',
        ) );

        // --- E. Link Tombol ---
        $wp_customize->add_setting( "hero_slide_btn_url_$i", array(
            'default'           => "#",
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "hero_slide_btn_url_$i", array(
            'label'   => __( "Slide $i - Link Tombol", 'se-clone' ),
            'section' => 'se_hero_slider_section',
            'type'    => 'url',
        ) );

        // --- E2. Posisi Perataan Tombol ---
        $wp_customize->add_setting( "hero_slide_btn_align_$i", array(
            'default'           => 'auto',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "hero_slide_btn_align_$i", array(
            'label'       => __( "Slide $i - Posisi Perataan Tombol", 'se-clone' ),
            'description' => 'Posisi tombol CTA pada slide ini.',
            'section'     => 'se_hero_slider_section',
            'type'        => 'select',
            'choices'     => array(
                'auto'   => '🤖 Otomatis (Tengah jika tanpa teks, Kiri jika ada teks)',
                'center' => '🎯 Selalu di Tengah (Center)',
                'left'   => '⬅️ Selalu di Kiri (Left)',
                'right'  => '➡️ Selalu di Kanan (Right)',
            ),
        ) );
    }
}
add_action( 'customize_register', 'se_clone_customize_register' );

/**
 * ==========================================
 * FUNGSI SANITASI IFRAME AMAN (Google Maps)
 * ==========================================
 */
function se_sanitize_iframe( $input ) {
    $allowed_tags = array(
        'iframe' => array(
            'src'             => array(),
            'width'           => array(),
            'height'          => array(),
            'style'           => array(),
            'frameborder'     => array(),
            'allowfullscreen' => array(),
            'loading'         => array(),
            'referrerpolicy'  => array(),
        ),
    );
    return wp_kses( $input, $allowed_tags );
}

/**
 * ==========================================
 * CUSTOMIZER: PENGATURAN HALAMAN KONTAK (LENGKAP)
 * ==========================================
 */
function se_contact_customizer_register( $wp_customize ) {

    // 1. Buat Section Baru
    $wp_customize->add_section( 'se_contact_section', array(
        'title'       => __( 'Contact Page Setting', 'se-clone' ),
        'description' => 'Isi data alamat, kontak, dan peta Google Maps di sini.',
        'priority'    => 35,
    ) );

    // --- A. Nama Perusahaan ---
    $wp_customize->add_setting( 'se_contact_company', array(
        'default'           => 'PT. BERKAH CIPTA PERSADA',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'se_contact_company', array(
        'label'   => 'Nama Perusahaan',
        'section' => 'se_contact_section',
        'type'    => 'text',
    ) );

    // --- B. Alamat Lengkap ---
    $wp_customize->add_setting( 'se_contact_address', array(
        'default'           => "Kawasan Industri Jababeka 1\nJl. Jababeka Raya Blok B No. 12\nCikarang, Bekasi",
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'se_contact_address', array(
        'label'   => 'Alamat Lengkap',
        'section' => 'se_contact_section',
        'type'    => 'textarea',
    ) );

    // --- C. Telepon ---
    $wp_customize->add_setting( 'se_contact_phone', array(
        'default'           => '(021) 8983-xxxx',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'se_contact_phone', array(
        'label'       => 'Nomor Telepon',
        'description' => 'Tekan Enter untuk menambah nomor baru ke bawah.',
        'section'     => 'se_contact_section',
        'type'        => 'textarea',
    ) );

    // --- D. Email ---
    $wp_customize->add_setting( 'se_contact_email', array(
        'default'           => 'sales@berkahcipta.co.id',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'se_contact_email', array(
        'label'   => 'Alamat Email',
        'section' => 'se_contact_section',
        'type'    => 'text',
    ) );

    // --- E. Google Maps Embed ---
    $wp_customize->add_setting( 'se_contact_map', array( 
        'default'           => '',
        'sanitize_callback' => 'se_sanitize_iframe',
    ) );
    $wp_customize->add_control( 'se_contact_map', array(
        'label'       => 'Kode Embed Google Maps',
        'description' => 'Copy kode HTML <iframe...> dari Google Maps (Share > Embed a map) dan paste di sini.',
        'section'     => 'se_contact_section',
        'type'        => 'textarea',
    ) );

    // --- F. Shortcode Contact Form 7 ---
    $wp_customize->add_setting( 'se_cf7_shortcode', array(
        'default'           => '[contact-form-7 id="fe32a01" title="Contact form 1"]',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'se_cf7_shortcode', array(
        'label'       => 'Shortcode Contact Form 7',
        'description' => 'Masukkan shortcode form kontak (Contoh: [contact-form-7 id="xxx"...])',
        'section'     => 'se_contact_section',
        'type'        => 'text',
    ) );

}
add_action( 'customize_register', 'se_contact_customizer_register' );

/**
 * ==========================================
 * CUSTOMIZER: PENGATURAN SOLUTIONS SLIDER (6 SLOT)
 * ==========================================
 */
function se_solutions_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'se_solutions_section', array(
        'title'       => __( 'Solutions Slider Setting', 'se-clone' ),
        'description' => 'Atur 6 kartu solusi/layanan di halaman depan (Gambar & Teks 2 Bahasa).',
        'priority'    => 32,
    ) );

    // DATA DEFAULT UNTUK 6 SLIDE
    $defaults = array(
        1 => array( 'cat'=>'Layanan', 'title'=>'Electrical Integration', 'desc'=>'Integrasi sistem kelistrikan yang efisien dan aman.' ),
        2 => array( 'cat'=>'Fasilitas', 'title'=>'Sheet Metal Machine', 'desc'=>'Fasilitas pemotongan logam presisi tinggi.' ),
        3 => array( 'cat'=>'Perawatan', 'title'=>'Retrofit & Retrofill', 'desc'=>'Pembaruan komponen lama dengan teknologi terbaru.' ),
        4 => array( 'cat'=>'Produk', 'title'=>'Switchgear', 'desc'=>'Perangkat pemutus dan pengontrol aliran listrik tegangan menengah/rendah.' ),
        5 => array( 'cat'=>'Produk', 'title'=>'Busway', 'desc'=>'Sistem distribusi daya listrik yang fleksibel dan efisien.' ),
        6 => array( 'cat'=>'Produk', 'title'=>'Neutral Grounding Resistor', 'desc'=>'Perangkat pengaman sistem tenaga listrik dari arus gangguan tanah.' ),
    );

    // LOOP MEMBUAT 6 SLOT PENGATURAN
    for ( $i = 1; $i <= 6; $i++ ) {
        
        $wp_customize->add_setting( "sep_sol_$i", array('default'=>'') );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "sep_sol_$i", array(
            'section' => 'se_solutions_section',
            'type'    => 'hidden',
            'label'   => "--- KARTU NOMOR $i ---"
        ) ) );

        // 1. GAMBAR
        $wp_customize->add_setting( "sol_img_$i", array('default' => '', 'sanitize_callback' => 'esc_url_raw') );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "sol_img_$i", array(
            'label'    => "Gambar Solusi $i",
            'section'  => 'se_solutions_section',
        ) ) );

        // 2. KATEGORI (ID/EN)
        $wp_customize->add_setting( "sol_cat_id_$i", array('default' => $defaults[$i]['cat'], 'sanitize_callback' => 'sanitize_text_field') );
        $wp_customize->add_control( "sol_cat_id_$i", array('label' => "Kategori (Indo)", 'section' => 'se_solutions_section', 'type' => 'text') );
        
        $wp_customize->add_setting( "sol_cat_en_$i", array('default' => 'Category', 'sanitize_callback' => 'sanitize_text_field') );
        $wp_customize->add_control( "sol_cat_en_$i", array('label' => "Category (English)", 'section' => 'se_solutions_section', 'type' => 'text') );

        // 3. JUDUL (ID/EN)
        $wp_customize->add_setting( "sol_title_id_$i", array('default' => $defaults[$i]['title'], 'sanitize_callback' => 'sanitize_text_field') );
        $wp_customize->add_control( "sol_title_id_$i", array('label' => "Judul (Indo)", 'section' => 'se_solutions_section', 'type' => 'text') );

        $wp_customize->add_setting( "sol_title_en_$i", array('default' => $defaults[$i]['title'], 'sanitize_callback' => 'sanitize_text_field') );
        $wp_customize->add_control( "sol_title_en_$i", array('label' => "Title (English)", 'section' => 'se_solutions_section', 'type' => 'text') );

        // 4. DESKRIPSI (ID/EN)
        $wp_customize->add_setting( "sol_desc_id_$i", array('default' => $defaults[$i]['desc'], 'sanitize_callback' => 'sanitize_textarea_field') );
        $wp_customize->add_control( "sol_desc_id_$i", array('label' => "Deskripsi (Indo)", 'section' => 'se_solutions_section', 'type' => 'textarea') );

        $wp_customize->add_setting( "sol_desc_en_$i", array('default' => 'Description in English...', 'sanitize_callback' => 'sanitize_textarea_field') );
        $wp_customize->add_control( "sol_desc_en_$i", array('label' => "Description (English)", 'section' => 'se_solutions_section', 'type' => 'textarea') );

        // 5. LINK
        $wp_customize->add_setting( "sol_link_$i", array('default' => '#', 'sanitize_callback' => 'esc_url_raw') );
        $wp_customize->add_control( "sol_link_$i", array('label' => "Link Tujuannya", 'section' => 'se_solutions_section', 'type' => 'text') );
    }
}
add_action( 'customize_register', 'se_solutions_customize_register' );

/**
 * PENGATURAN WHATSAPP FLOATING
 */
function se_whatsapp_customizer( $wp_customize ) {
    $wp_customize->add_setting( 'se_wa_number', array(
        'default'           => '6281234567890',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'se_wa_number', array(
        'label'       => 'Nomor WhatsApp (Floating)',
        'description' => 'Gunakan format internasional (Contoh: 62812... bukan 0812...). Kosongkan jika ingin menyembunyikan tombol.',
        'section'     => 'se_contact_section',
        'type'        => 'text',
        'priority'    => 100,
    ) );
}
add_action( 'customize_register', 'se_whatsapp_customizer' );

/**
 * ==========================================
 * CUSTOMIZER: PENGATURAN BUSINESS LINE UP (6 SLOT)
 * ==========================================
 */
function se_featured_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'se_featured_section', array(
        'title'       => __( 'Business Line Up Setting', 'se-clone' ),
        'description' => 'Atur 6 produk unggulan di halaman depan.',
        'priority'    => 33,
    ) );

    $f_defaults = array(
        1 => array( 't_id'=>'Medium Voltage Switchgear', 't_en'=>'Medium Voltage Switchgear' ),
        2 => array( 't_id'=>'Kontaktor & Relay', 't_en'=>'Contactors & Relays' ),
        3 => array( 't_id'=>'MCB Proteksi', 't_en'=>'MCB for Protection' ),
        4 => array( 't_id'=>'Variable Speed Drives', 't_en'=>'Variable Speed Drives' ),
        5 => array( 't_id'=>'Sistem Busway', 't_en'=>'Busway Systems' ),
        6 => array( 't_id'=>'Otomasi PLC', 't_en'=>'PLC Automation' ),
    );

    for ( $i = 1; $i <= 6; $i++ ) {
        
        $wp_customize->add_setting( "sep_feat_$i", array('default'=>'') );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "sep_feat_$i", array(
            'section' => 'se_featured_section',
            'type'    => 'hidden',
            'label'   => "--- PRODUK NO. $i ---"
        ) ) );

        // 1. GAMBAR
        $wp_customize->add_setting( "feat_img_$i", array('default' => '', 'sanitize_callback' => 'esc_url_raw') );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "feat_img_$i", array(
            'label'    => "Gambar Produk $i",
            'section'  => 'se_featured_section',
        ) ) );

        // 2. JUDUL
        $wp_customize->add_setting( "feat_title_id_$i", array('default' => $f_defaults[$i]['t_id'], 'sanitize_callback' => 'sanitize_text_field') );
        $wp_customize->add_control( "feat_title_id_$i", array('label' => "Judul (Indo)", 'section' => 'se_featured_section', 'type' => 'text') );

        $wp_customize->add_setting( "feat_title_en_$i", array('default' => $f_defaults[$i]['t_en'], 'sanitize_callback' => 'sanitize_text_field') );
        $wp_customize->add_control( "feat_title_en_$i", array('label' => "Title (English)", 'section' => 'se_featured_section', 'type' => 'text') );

        // 3. LINK
        $wp_customize->add_setting( "feat_link_$i", array('default' => '#', 'sanitize_callback' => 'esc_url_raw') );
        $wp_customize->add_control( "feat_link_$i", array('label' => "Link Tujuannya", 'section' => 'se_featured_section', 'type' => 'text') );
    }
}
add_action( 'customize_register', 'se_featured_customize_register' );

/* Ambil gambar pertama dari konten jika featured image tidak ada */
if ( ! function_exists( 'bcp_get_first_image_from_content' ) ) {
    function bcp_get_first_image_from_content($post_id) {
        $post = get_post($post_id);
        if (!$post) return false;

        preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        return $matches[1] ?? false;
    }
}

/* ===============================
   CUSTOM POST TYPE: CAREER
   =============================== */
function bcp_register_career_post_type() {

    register_post_type('career', [
        'labels' => [
            'name'          => 'Careers',
            'singular_name' => 'Career',
            'add_new_item'  => 'Add New Job Vacancy',
            'edit_item'     => 'Edit Job Vacancy',
        ],
        'public'       => true,
        'menu_icon'    => 'dashicons-businessperson',
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail'],
        'has_archive'  => false,
        'rewrite'      => ['slug' => 'career'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'bcp_register_career_post_type');

?>


