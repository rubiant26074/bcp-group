@extends('layouts.app')

@section('title', 'News & Updates - PT Berkah Cipta Pratama')

@section('content')
<section class="hero-banner" style="padding: 50px 20px;">
    <div class="container">
        <h1>Company News & Updates</h1>
        <p>Stay informed with latest technological advances, project achievements, and company announcements.</p>
    </div>
</section>

<section style="padding: 50px 0;">
    <div class="container">
        <div class="card-grid">
            @forelse($articles as $art)
            <div class="card">
                <div class="card-body">
                    <span style="font-size:0.8rem; color:#888;">{{ $art->published_at ? $art->published_at->format('d M Y') : '' }}</span>
                    <h3 class="card-title" style="margin-top:5px;">{{ $art->title }}</h3>
                    <p class="card-text">{{ $art->summary }}</p>
                    <a href="{{ route('news.show', $art->slug) }}" style="color:var(--se-green); font-weight:700; display:inline-block; margin-top:15px;">Read Full Story &rarr;</a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align:center; padding:40px; color:#888;">
                No articles published yet.
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
