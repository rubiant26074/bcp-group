<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Article;
use App\Models\Career;
use App\Models\Page;
use App\Models\MenuItem;
use App\Models\Slider;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@berkahcipta.co.id'],
            [
                'name' => 'Administrator BCP',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]
        );

        // Site Settings
        \App\Models\Setting::firstOrCreate(
            ['key' => 'maintenance_mode'],
            [
                'label' => 'Under Construction (Maintenance Mode)',
                'value' => 'false',
                'type' => 'boolean'
            ]
        );

        \App\Models\Setting::firstOrCreate(
            ['key' => 'contact_address'],
            [
                'label' => 'Office Address',
                'value' => "PT. Berkah Cipta Persada\nKawasan Industri Jababeka 1, Jl. Jababeka Raya Blok B No. 12, Cikarang, Bekasi",
                'type' => 'textarea'
            ]
        );

        \App\Models\Setting::firstOrCreate(
            ['key' => 'contact_phone'],
            [
                'label' => 'Sales Phone / WhatsApp',
                'value' => '(021) 8983-xxxx / +62 812-XXXX-XXXX',
                'type' => 'text'
            ]
        );

        \App\Models\Setting::firstOrCreate(
            ['key' => 'contact_email'],
            [
                'label' => 'Technical & Commercial Email',
                'value' => 'sales@berkahcipta.co.id / info@berkahcipta.co.id',
                'type' => 'text'
            ]
        );

        // Seed Hero Sliders
        Slider::firstOrCreate(
            ['title' => 'PT BERKAH CIPTA PERSADA'],
            [
                'subtitle' => 'Integrated electrical solutions built on precision, engineering innovation, and high reliability industrial power systems.',
                'button_text' => 'Explore Our Products',
                'button_url' => '/produk',
                'image' => 'sliders/01M0J27YXF69NX8S85B0SVFYW8.webp',
                'height' => 500,
                'overlay_opacity' => 35,
                'order' => 1,
                'is_active' => true
            ]
        );

        Slider::firstOrCreate(
            ['title' => 'PREMIUM BUSDUCT & SWITCHGEAR'],
            [
                'subtitle' => 'IP68 Cast Resin Busway System & MV/LV Switchgear Assemblies meeting international IEC standards.',
                'button_text' => 'View Busduct System',
                'button_url' => '/produk?category=busduct-system',
                'height' => 500,
                'overlay_opacity' => 45,
                'order' => 2,
                'is_active' => true
            ]
        );

        Slider::firstOrCreate(
            ['title' => 'SCADA & CONTROL PANELS'],
            [
                'subtitle' => 'Custom GCP Control Panels and Generator Circuit Breakers up to 15kV rated voltage.',
                'button_text' => 'Contact Sales Team',
                'button_url' => '/contact',
                'height' => 500,
                'overlay_opacity' => 45,
                'order' => 3,
                'is_active' => true
            ]
        );

        // Seed Pages
        Page::firstOrCreate(
            ['slug' => 'about-us'],
            [
                'title' => 'About Us - Company Profile',
                'content' => '<h2>BE CORE POWERED</h2><p>Centered on powerful integration. PT. Berkah Cipta Persada delivers premium electrical solutions built on precision, integrity, and innovation.</p>',
                'meta_description' => 'About PT. Berkah Cipta Persada company profile and vision mission.',
                'is_published' => true
            ]
        );

        Page::firstOrCreate(
            ['slug' => 'gallery'],
            [
                'title' => 'Project Gallery',
                'content' => '<p>Documentation of electrical fabrication, field integration, and project completions of PT. Berkah Cipta Persada.</p>',
                'meta_description' => 'PT. Berkah Cipta Persada project gallery and facility documentation.',
                'is_published' => true
            ]
        );

        // Seed Menu Items & Dropdowns
        $home = MenuItem::firstOrCreate(['url' => '/'], ['title' => 'Home', 'order' => 1]);
        
        $about = MenuItem::firstOrCreate(['url' => '/about-us'], ['title' => 'About Us', 'order' => 2]);
        MenuItem::firstOrCreate(['url' => '/about-us', 'parent_id' => $about->id], ['title' => 'Company Profile', 'order' => 1]);
        MenuItem::firstOrCreate(['url' => '/gallery', 'parent_id' => $about->id], ['title' => 'Project Gallery', 'order' => 2]);

        $products = MenuItem::firstOrCreate(['url' => '/produk'], ['title' => 'Our Products', 'order' => 3]);
        MenuItem::firstOrCreate(['url' => '/produk', 'parent_id' => $products->id], ['title' => 'All Products & Solutions', 'order' => 1]);
        MenuItem::firstOrCreate(['url' => '/produk?category=busduct-system', 'parent_id' => $products->id], ['title' => 'Busduct System', 'order' => 2]);
        MenuItem::firstOrCreate(['url' => '/produk?category=gcb', 'parent_id' => $products->id], ['title' => 'Generator Circuit Breaker (GCB)', 'order' => 3]);
        MenuItem::firstOrCreate(['url' => '/produk?category=switchgear', 'parent_id' => $products->id], ['title' => 'Switchgear', 'order' => 4]);
        MenuItem::firstOrCreate(['url' => '/produk?category=panel-control', 'parent_id' => $products->id], ['title' => 'Control Panel', 'order' => 5]);
        MenuItem::firstOrCreate(['url' => '/produk?category=vfd', 'parent_id' => $products->id], ['title' => 'Variable Frequency Drive (VFD)', 'order' => 6]);
        MenuItem::firstOrCreate(['url' => '/produk?category=soft-starter', 'parent_id' => $products->id], ['title' => 'Soft Starter', 'order' => 7]);
        MenuItem::firstOrCreate(['url' => '/produk?category=resistor-system', 'parent_id' => $products->id], ['title' => 'Resistor System', 'order' => 8]);
        MenuItem::firstOrCreate(['url' => '/produk?category=other-component', 'parent_id' => $products->id], ['title' => 'Other Components', 'order' => 9]);

        $news = MenuItem::firstOrCreate(['url' => '/news-updates'], ['title' => 'News & Updates', 'order' => 4]);
        $careers = MenuItem::firstOrCreate(['url' => '/careers'], ['title' => 'Careers', 'order' => 5]);
        $contact = MenuItem::firstOrCreate(['url' => '/contact'], ['title' => 'Contact Us', 'order' => 6]);

        $jsonPath = 'C:/Users/Budi R/.gemini/antigravity/brain/4225197f-a0dd-44f4-8f45-ad47af73af0b/scratch/seed_data.json';
        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true);

            // Seed Categories
            $categoryMap = [];
            foreach ($data['categories'] as $cat) {
                $categoryMap[$cat['slug']] = Category::firstOrCreate(['slug' => $cat['slug']], $cat);
            }

            // Seed Products
            foreach ($data['products'] as $prod) {
                $catSlug = $prod['category_slug'] ?? 'other-component';
                $category = $categoryMap[$catSlug] ?? Category::first();

                Product::firstOrCreate(
                    ['slug' => $prod['slug']],
                    [
                        'category_id' => $category->id,
                        'title' => $prod['title'],
                        'summary' => $prod['summary'],
                        'content' => $prod['content'],
                        'image' => $prod['image'] ?? null
                    ]
                );
            }

            // Seed Articles
            foreach ($data['articles'] as $art) {
                Article::firstOrCreate(
                    ['slug' => $art['slug']],
                    [
                        'title' => $art['title'],
                        'summary' => $art['summary'],
                        'content' => $art['content'],
                        'published_at' => $art['published_at'] ?? now()
                    ]
                );
            }

            // Seed Careers
            foreach ($data['careers'] as $car) {
                Career::firstOrCreate(['title' => $car['title']], $car);
            }
        }
    }
}
