@extends('layouts.app')

@section('title', $page->title . ' - PT. Berkah Cipta Persada')

@section('content')
<section class="hero-banner" style="padding: 50px 20px;">
    <div class="container">
        <h1>{{ $page->title }}</h1>
        @if($page->meta_description)
            <p>{{ $page->meta_description }}</p>
        @endif
    </div>
</section>

<section style="padding: 60px 0;">
    <div class="container" style="max-width:950px;">
        <div style="background:#fff; border:1px solid #eee; padding:35px; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05); line-height:1.8; color:#333;">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endsection
