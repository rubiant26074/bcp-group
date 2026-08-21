<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT. Berkah Cipta Persada - BE CORE POWERED')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/seclone/bcp-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/seclone/bcp-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/seclone/bcp-logo.png') }}">

    <!-- Custom CSS from theme seclone -->
    <link rel="stylesheet" href="{{ asset('assets/seclone/style.css') }}">
    <style>
        :root {
            --se-green: #3dcd58;
            --se-dark: #2d2d2d;
            --se-gray: #f4f4f4;
            --text-color: #333;
            --container-width: 1400px;
        }

        .btn-primary {
            background-color: var(--se-green);
            color: #fff;
            padding: 10px 22px;
            border-radius: 4px;
            font-weight: 700;
            display: inline-block;
            transition: background 0.3s;
        }
        .btn-primary:hover {
            background-color: #32b54a;
            color: #fff;
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        .card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--se-dark);
        }
        .card-text {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        .hero-banner {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #fff;
            padding: 80px 20px;
            text-align: center;
        }
        .hero-banner h1 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 15px;
            color: #fff;
        }
        .hero-banner p {
            font-size: 1.2rem;
            color: #cbd5e1;
            max-width: 800px;
            margin: 0 auto 30px;
        }
        .arrow-down {
            display: inline-block;
            margin-left: 4px;
            font-size: 10px;
            transition: transform 0.2s ease;
        }
        .main-nav > ul > li:hover .arrow-down {
            transform: rotate(180deg);
        }
        .brand-logo-img {
            max-height: 48px;
            width: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        .brand-logo-img:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body>

    <!-- SITE HEADER -->
    <header class="site-header">
        <div class="container header-inner">
            <div class="logo">
                <a href="{{ route('home') }}" style="display:flex; align-items:center; gap:12px; text-decoration:none;">
                    <img src="{{ asset('assets/seclone/bcp-logo.png') }}" alt="PT. Berkah Cipta Persada Logo" class="brand-logo-img">
                    <div class="logo-text">
                        <span class="site-title-text">PT BERKAH CIPTA PERSADA</span>
                        <span class="site-tagline-text">BE CORE POWERED</span>
                    </div>
                </a>
            </div>

            <nav class="main-nav">
                <ul>
                    @if(isset($navMenuItems) && $navMenuItems->count() > 0)
                        @foreach($navMenuItems as $item)
                            <li>
                                <a href="{{ url($item->url) }}">
                                    {{ $item->title }}
                                    @if($item->children->count() > 0)
                                        <span class="arrow-down">&#9660;</span>
                                    @endif
                                </a>
                                @if($item->children->count() > 0)
                                    <ul>
                                        @foreach($item->children as $child)
                                            <li><a href="{{ url($child->url) }}">{{ $child->title }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>
                            <a href="{{ route('about') }}">About Us <span class="arrow-down">&#9660;</span></a>
                            <ul>
                                <li><a href="{{ route('about') }}">Company Profile</a></li>
                                <li><a href="{{ route('gallery') }}">Project Gallery</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('products.index') }}">Our Products</a></li>
                        <li><a href="{{ route('news.index') }}">News & Updates</a></li>
                        <li><a href="{{ route('careers') }}">Careers</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    @endif
                </ul>
            </nav>

            <div class="header-actions">
                <a href="{{ route('contact') }}" class="btn-primary">Contact Us</a>
            </div>
        </div>
    </header>

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container" style="padding-top:50px; padding-bottom:30px;">
            <div style="display:flex; flex-wrap:wrap; gap:30px; justify-content:space-between;">
                
                <div style="flex:2; min-width:250px;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:18px;">
                        <img src="{{ asset('assets/seclone/bcp-logo.png') }}" alt="BCP Logo" style="max-height:44px; width:auto; background:#fff; padding:3px 6px; border-radius:4px;">
                        <h4 style="color:var(--se-green); margin:0; text-transform:uppercase; font-weight:800; letter-spacing:1px;">
                            PT BERKAH CIPTA PERSADA
                        </h4>
                    </div>
                    <p style="color:#ccc; font-size:0.9rem; line-height:1.7; max-width:420px; text-align:justify;">
                        <strong style="font-weight:800; color:#ffffff; letter-spacing:0.5px;">BE CORE POWERED</strong>, centered on powerful integration. We deliver premium electrical solutions built on precision, integrity, and innovation. From fabrication to integration, our systems are crafted to meet the highest standards of quality and performance. We don’t just power systems, we empower progress.
                    </p>
                </div>

                <div style="flex:1; min-width:180px;">
                    <h4 style="margin-bottom:20px; border-bottom:2px solid var(--se-green); display:inline-block; padding-bottom:5px; color:#fff;">
                        Company
                    </h4>
                    <ul style="list-style:none; padding:0; font-size:0.9rem;">
                        <li style="margin-bottom:10px;"><a href="{{ route('about') }}" style="color:#bbb;">About Us</a></li>
                        <li style="margin-bottom:10px;"><a href="{{ route('careers') }}" style="color:#bbb;">Careers</a></li>
                        <li style="margin-bottom:10px;"><a href="{{ route('news.index') }}" style="color:#bbb;">News & Updates</a></li>
                        <li style="margin-bottom:10px;"><a href="{{ route('gallery') }}" style="color:#bbb;">Project Gallery</a></li>
                    </ul>
                </div>

                <div style="flex:1; min-width:180px;">
                    <h4 style="margin-bottom:20px; border-bottom:2px solid var(--se-green); display:inline-block; padding-bottom:5px; color:#fff;">
                        Support
                    </h4>
                    <ul style="list-style:none; padding:0; font-size:0.9rem;">
                        <li style="margin-bottom:10px;"><a href="{{ route('contact') }}" style="color:#bbb;">Contact Sales</a></li>
                        <li style="margin-bottom:10px;"><a href="{{ route('products.index') }}" style="color:#bbb;">Download Catalog</a></li>
                    </ul>
                </div>

            </div>

            <hr style="border:0; border-top:1px solid #444; margin:30px 0;">
            
            <div style="display:flex; justify-content:space-between; flex-wrap:wrap; font-size:0.85rem; color:#888;">
                <div>
                    &copy; {{ date('Y') }} <strong>PT BERKAH CIPTA PERSADA</strong>. All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
