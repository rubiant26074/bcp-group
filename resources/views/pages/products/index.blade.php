@extends('layouts.app')

@section('title', 'Products & Solutions Catalog - PT Berkah Cipta Pratama')

@section('content')
<section class="hero-banner" style="padding: 50px 20px;">
    <div class="container">
        <h1>Products & Systems Catalog</h1>
        <p>Premium electrical solutions engineered for heavy industrial and utility projects.</p>
    </div>
</section>

<section style="padding: 50px 0;">
    <div class="container">
        
        <!-- CATEGORY FILTERS -->
        <div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:30px; justify-content:center;">
            <a href="{{ route('products.index') }}" class="btn-primary" style="background: {{ !request('category') ? 'var(--se-green)' : '#666' }}; padding:8px 16px; font-size:0.9rem;">All Products</a>
            @foreach($categories as $cat)
                <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="btn-primary" style="background: {{ request('category') === $cat->slug ? 'var(--se-green)' : '#666' }}; padding:8px 16px; font-size:0.9rem;">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        <div class="card-grid">
            @forelse($products as $prod)
            <div class="card">
                <div class="card-body">
                    <span style="font-size:0.8rem; font-weight:700; color:var(--se-green); text-transform:uppercase;">{{ $prod->category->name }}</span>
                    <h3 class="card-title" style="margin-top:5px;">{{ $prod->title }}</h3>
                    <p class="card-text">{{ $prod->summary }}</p>
                    <a href="{{ route('products.show', $prod->slug) }}" class="btn-primary" style="margin-top:15px; font-size:0.9rem; padding:8px 16px;">Technical Details</a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align:center; padding:40px; color:#888;">
                No products found in this category.
            </div>
            @endforelse
        </div>

        <div style="margin-top:40px; display:flex; justify-content:center;">
            {{ $products->links() }}
        </div>

    </div>
</section>
@endsection
