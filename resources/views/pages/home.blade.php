@extends('layouts.app')

@section('title', 'PT. Berkah Cipta Persada - Industrial Power Solutions & Be Core Powered')

@section('content')

@php
    // Single Global Fixed Height for all Hero Slides
    $globalHeight = isset($sliders[0]) ? ($sliders[0]->height ?? 500) : 500;
@endphp

<!-- HERO SLIDER SECTION (GLOBAL FIXED HEIGHT, NO BOTTOM BAR) -->
<div class="slider-wrapper" style="height: {{ $globalHeight }}px;">
    <div class="slider-track" style="height: 100%;">
        @if(isset($sliders) && $sliders->count() > 0)
            @foreach($sliders as $index => $slide)
            @php
                $bgStyle = '';
                $opacity = ($slide->overlay_opacity ?? 40) / 100;
                
                if ($slide->image) {
                    $imgUrl = (str_starts_with($slide->image, 'http') || str_starts_with($slide->image, 'assets')) 
                        ? asset($slide->image) 
                        : asset('storage/' . $slide->image);
                    
                    if ($opacity > 0) {
                        $bgStyle = "background-image: linear-gradient(rgba(15, 23, 42, {$opacity}), rgba(15, 23, 42, {$opacity})), url('{$imgUrl}'); background-size: cover; background-position: center;";
                    } else {
                        $bgStyle = "background-image: url('{$imgUrl}'); background-size: cover; background-position: center;";
                    }
                } else {
                    $bgStyle = "background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.95) 100%);";
                }
            @endphp
            <div class="slide-item {{ $index === 0 ? 'active' : '' }}" style="{{ $bgStyle }} height: 100%;">
                <div class="slide-content">
                    <h1>{{ $slide->title }}</h1>
                    @if($slide->subtitle)
                        <p>{{ $slide->subtitle }}</p>
                    @endif
                    @if($slide->button_text && $slide->button_url)
                        <a href="{{ url($slide->button_url) }}" class="btn-primary" style="font-size:1.1rem; padding:12px 28px;">
                            {{ $slide->button_text }}
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        @else
            <div class="slide-item active" style="height: 100%;">
                <div class="slide-content">
                    <h1>PT BERKAH CIPTA PERSADA</h1>
                    <p>Integrated electrical solutions built on precision, engineering innovation, and high reliability industrial power systems.</p>
                    <a href="{{ route('products.index') }}" class="btn-primary" style="font-size:1.1rem; padding:12px 28px;">Explore Our Products</a>
                </div>
            </div>
        @endif
    </div>

    <!-- Navigation Arrows -->
    <button class="slider-btn prev-btn" onclick="moveSlide(-1)">&#10094;</button>
    <button class="slider-btn next-btn" onclick="moveSlide(1)">&#10095;</button>

    <!-- Dots Floating on Image -->
    <div class="slider-dots" id="sliderDots">
        @if(isset($sliders) && $sliders->count() > 1)
            @foreach($sliders as $index => $slide)
                <span class="dot {{ $index === 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})"></span>
            @endforeach
        @endif
    </div>
</div>

<style>
.slider-wrapper {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #0f172a;
}
.slider-track {
    position: relative;
    width: 100%;
    height: 100%;
}
.slide-item {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.8s ease-in-out, visibility 0.8s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    text-align: center;
    box-sizing: border-box;
}
.slide-item.active {
    opacity: 1;
    visibility: visible;
}
.slide-content {
    max-width: 900px;
    margin: 0 auto;
    color: #ffffff;
    text-shadow: 0 2px 8px rgba(0,0,0,0.5);
}
.slide-content h1 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 15px;
    color: #ffffff;
    letter-spacing: 0.5px;
}
.slide-content p {
    font-size: 1.2rem;
    color: #f1f5f9;
    line-height: 1.6;
    margin-bottom: 28px;
}
.slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.4);
    color: #fff;
    border: none;
    font-size: 22px;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border-radius: 50%;
    transition: background 0.3s, transform 0.2s;
    z-index: 10;
}
.slider-btn:hover {
    background: var(--se-green);
    transform: translateY(-50%) scale(1.1);
}
.prev-btn { left: 20px; }
.next-btn { right: 20px; }
.slider-dots {
    position: absolute;
    bottom: 25px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 10;
}
.dot {
    width: 12px;
    height: 12px;
    background: rgba(255, 255, 255, 0.5);
    border: 2px solid rgba(0,0,0,0.2);
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.3s, transform 0.3s;
}
.dot.active, .dot:hover {
    background: var(--se-green);
    transform: scale(1.3);
}
</style>

<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slide-item');
const dots = document.querySelectorAll('.dot');
let slideInterval;

function showSlide(index) {
    if (slides.length === 0) return;

    if (index >= slides.length) currentSlide = 0;
    else if (index < 0) currentSlide = slides.length - 1;
    else currentSlide = index;

    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === currentSlide);
    });

    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === currentSlide);
    });
}

function moveSlide(step) {
    showSlide(currentSlide + step);
    resetTimer();
}

function goToSlide(index) {
    showSlide(index);
    resetTimer();
}

function startTimer() {
    if (slides.length > 1) {
        slideInterval = setInterval(() => {
            showSlide(currentSlide + 1);
        }, 5000);
    }
}

function resetTimer() {
    clearInterval(slideInterval);
    startTimer();
}

document.addEventListener('DOMContentLoaded', startTimer);
</script>

<!-- CORE PRODUCT CATEGORIES -->
<section style="padding: 60px 0; background: var(--se-gray);">
    <div class="container">
        <h2 style="text-align:center; font-size:2rem; font-weight:800; margin-bottom:10px;">Core Product Categories</h2>
        <p style="text-align:center; color:#666; max-width:600px; margin:0 auto 40px;">Medium and low voltage electrical systems meeting international standards.</p>

        <div class="card-grid">
            @foreach($categories as $cat)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $cat->name }}</h3>
                    <p class="card-text">{{ $cat->description }}</p>
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}" style="color:var(--se-green); font-weight:700; display:inline-block; margin-top:15px;">View Products &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- FEATURED PRODUCTS -->
<section style="padding: 60px 0;">
    <div class="container">
        <h2 style="text-align:center; font-size:2rem; font-weight:800; margin-bottom:10px;">Featured Products</h2>
        <p style="text-align:center; color:#666; max-width:600px; margin:0 auto 40px;">Integrated solutions engineered for uninterrupted power performance.</p>

        <div class="card-grid">
            @foreach($featuredProducts as $prod)
            <div class="card">
                <div class="card-body">
                    <span style="font-size:0.8rem; font-weight:700; color:var(--se-green); text-transform:uppercase;">{{ $prod->category->name }}</span>
                    <h3 class="card-title" style="margin-top:5px;">{{ $prod->title }}</h3>
                    <p class="card-text">{{ $prod->summary }}</p>
                    <a href="{{ route('products.show', $prod->slug) }}" class="btn-primary" style="margin-top:15px; font-size:0.9rem; padding:8px 16px;">Technical Details</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- LATEST NEWS -->
@if($latestArticles->count() > 0)
<section style="padding: 60px 0; background: #fafafa;">
    <div class="container">
        <h2 style="text-align:center; font-size:2rem; font-weight:800; margin-bottom:40px;">Company News & Updates</h2>
        <div class="card-grid">
            @foreach($latestArticles as $art)
            <div class="card">
                <div class="card-body">
                    <span style="font-size:0.8rem; color:#888;">{{ $art->published_at ? $art->published_at->format('d M Y') : '' }}</span>
                    <h3 class="card-title" style="margin-top:5px;">{{ $art->title }}</h3>
                    <p class="card-text">{{ $art->summary }}</p>
                    <a href="{{ route('news.show', $art->slug) }}" style="color:var(--se-green); font-weight:700; display:inline-block; margin-top:15px;">Read Full Article &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
