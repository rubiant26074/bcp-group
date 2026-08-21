@extends('layouts.app')

@section('title', 'Contact Us - PT. Berkah Cipta Persada')

@section('content')
<section class="hero-banner" style="padding: 50px 20px;">
    <div class="container">
        <h1>Contact Our Team</h1>
        <p>Consult your electrical power systems & industrial project requirements with our engineering experts.</p>
    </div>
</section>

<section style="padding: 50px 0;">
    <div class="container">
        <div style="display:flex; flex-wrap:wrap; gap:40px;">
            
            <!-- CONTACT INFO -->
            <div style="flex:1; min-width:300px;">
                <h2 style="font-size:1.6rem; font-weight:700; margin-bottom:20px;">Contact Information</h2>
                
                <div style="margin-bottom:20px;">
                    <strong style="display:block; color:var(--se-dark); font-size:1.05rem;">Head Office & Works:</strong>
                    <p style="color:#555; margin-top:5px; line-height:1.6;">PT. Berkah Cipta Persada<br>Kawasan Industri Jababeka 1, Jl. Jababeka Raya Blok B No. 12, Cikarang, Bekasi</p>
                </div>

                <div style="margin-bottom:20px;">
                    <strong style="display:block; color:var(--se-dark); font-size:1.05rem;">Sales Phone / WhatsApp:</strong>
                    <p style="color:#555; margin-top:5px;">(021) 8983-xxxx / +62 812-XXXX-XXXX</p>
                </div>

                <div style="margin-bottom:20px;">
                    <strong style="display:block; color:var(--se-dark); font-size:1.05rem;">Technical & Commercial Email:</strong>
                    <p style="color:#555; margin-top:5px;">sales@berkahcipta.co.id / info@berkahcipta.co.id</p>
                </div>
            </div>

            <!-- FORM -->
            <div style="flex:1.5; min-width:320px; background:#fff; border:1px solid #eee; padding:35px; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
                <h2 style="font-size:1.6rem; font-weight:700; margin-bottom:20px;">Send an Inquiry</h2>

                @if(session('success'))
                <div style="background:#e6f9ed; border:1px solid var(--se-green); color:#1b7a31; padding:15px; border-radius:6px; margin-bottom:20px;">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div style="margin-bottom:15px;">
                        <label style="display:block; font-weight:600; margin-bottom:5px;">Full Name *</label>
                        <input type="text" name="name" required style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;" value="{{ old('name') }}">
                    </div>

                    <div style="display:flex; gap:15px; margin-bottom:15px;">
                        <div style="flex:1;">
                            <label style="display:block; font-weight:600; margin-bottom:5px;">Email Address *</label>
                            <input type="email" name="email" required style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;" value="{{ old('email') }}">
                        </div>
                        <div style="flex:1;">
                            <label style="display:block; font-weight:600; margin-bottom:5px;">Phone / WA Number</label>
                            <input type="text" name="phone" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;" value="{{ old('phone') }}">
                        </div>
                    </div>

                    <div style="margin-bottom:15px;">
                        <label style="display:block; font-weight:600; margin-bottom:5px;">Subject / Topic</label>
                        <input type="text" name="subject" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;" value="{{ request('subject') ?? old('subject') }}">
                    </div>

                    <div style="margin-bottom:20px;">
                        <label style="display:block; font-weight:600; margin-bottom:5px;">Project Details / Message *</label>
                        <textarea name="message" rows="5" required style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn-primary" style="width:100%; padding:12px; font-size:1rem; border:none; cursor:pointer;">Submit Inquiry</button>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
