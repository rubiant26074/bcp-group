@extends('layouts.app')

@section('title', 'Careers & Opportunities - PT Berkah Cipta Pratama')

@section('content')
<section class="hero-banner" style="padding: 50px 20px;">
    <div class="container">
        <h1>Join Our Team</h1>
        <p>Build your professional career in cutting-edge industrial electrical systems integration.</p>
    </div>
</section>

<section style="padding: 50px 0;">
    <div class="container">
        <h2 style="font-size:1.8rem; font-weight:700; margin-bottom:30px;">Open Positions</h2>

        <div style="display:flex; flex-direction:column; gap:20px;">
            @forelse($careers as $job)
            <div style="background:#fff; border:1px solid #eee; border-radius:8px; padding:25px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:20px; box-shadow:0 2px 8px rgba(0,0,0,0.03);">
                <div>
                    <h3 style="font-size:1.3rem; font-weight:700; color:var(--se-dark);">{{ $job->title }}</h3>
                    <div style="display:flex; gap:15px; margin:8px 0; color:#666; font-size:0.9rem;">
                        <span>🏢 {{ $job->department }}</span>
                        <span>📍 {{ $job->location }}</span>
                        <span>⏱️ {{ $job->type }}</span>
                    </div>
                    <p style="color:#555; font-size:0.95rem; margin-top:10px;">{{ $job->description }}</p>
                </div>
                <div>
                    <a href="{{ route('contact', ['subject' => 'Job Application: ' . $job->title]) }}" class="btn-primary" style="padding:10px 22px;">Apply Now</a>
                </div>
            </div>
            @empty
            <div style="text-align:center; padding:40px; color:#888;">
                No open positions available at this moment.
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
