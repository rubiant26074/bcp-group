@extends('layouts.app')

@section('title', $product->title . ' - PT Berkah Cipta Pratama')

@section('content')
<section class="hero-banner" style="padding: 40px 20px;">
    <div class="container">
        <span style="color:var(--se-green); font-weight:700; text-transform:uppercase;">{{ $product->category->name }}</span>
        <h1 style="margin-top:10px;">{{ $product->title }}</h1>
    </div>
</section>

<section style="padding: 50px 0;">
    <div class="container">
        <div style="background:#fff; border:1px solid #eee; padding:35px; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
            <div style="font-size:1.05rem; line-height:1.8; color:#333;">
                {!! $product->content !!}
            </div>

            <hr style="margin:40px 0; border:0; border-top:1px solid #eee;">

            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px;">
                <div>
                    <h4 style="margin-bottom:5px;">Interested in this product?</h4>
                    <p style="color:#666; font-size:0.95rem;">Request technical consolidated documentation and official price estimation from our sales engineers.</p>
                </div>
                <a href="{{ route('contact', ['subject' => 'Inquiry: ' . $product->title]) }}" class="btn-primary" style="padding:12px 28px; font-size:1rem;">Request Quotation</a>
            </div>
        </div>

        @if($relatedProducts->count() > 0)
        <div style="margin-top:50px;">
            <h3 style="font-size:1.5rem; font-weight:700; margin-bottom:20px;">Related Products</h3>
            <div class="card-grid">
                @foreach($relatedProducts as $rel)
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $rel->title }}</h4>
                        <p class="card-text">{{ $rel->summary }}</p>
                        <a href="{{ route('products.show', $rel->slug) }}" style="color:var(--se-green); font-weight:700; display:inline-block; margin-top:10px;">View Details &rarr;</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>
@endsection
