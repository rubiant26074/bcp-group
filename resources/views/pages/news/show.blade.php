@extends('layouts.app')

@section('title', $article->title . ' - PT Berkah Cipta Pratama')

@section('content')
<section class="hero-banner" style="padding: 40px 20px;">
    <div class="container">
        <span style="color:var(--se-green); font-size:0.9rem;">{{ $article->published_at ? $article->published_at->format('d M Y') : '' }}</span>
        <h1 style="margin-top:10px;">{{ $article->title }}</h1>
    </div>
</section>

<section style="padding: 50px 0;">
    <div class="container" style="max-width:900px;">
        <div style="background:#fff; border:1px solid #eee; padding:35px; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
            <div style="font-size:1.05rem; line-height:1.8; color:#333;">
                {!! $article->content !!}
            </div>
        </div>
    </div>
</section>
@endsection
