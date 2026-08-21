@extends('layouts.app')

@section('title', 'Project Gallery - PT. Berkah Cipta Persada')

@section('content')
<section class="hero-banner" style="padding: 50px 20px;">
    <div class="container">
        <h1>Project & Installation Gallery</h1>
        <p>Documentation of electrical fabrication, field integration, and project completions of PT. Berkah Cipta Persada.</p>
    </div>
</section>

<section style="padding: 60px 0;">
    <div class="container">
        <div class="card-grid">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Busduct System Installation</h3>
                    <p class="card-text">Outdoor IP68 Cast Resin Busway System installation for manufacturing facility.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">MV/LV Switchgear Assembly</h3>
                    <p class="card-text">Factory acceptance testing and panel assembly at workshop.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Load Bank Resistor Commissioning</h3>
                    <p class="card-text">Capacity and periodic load testing for power generation plant.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
