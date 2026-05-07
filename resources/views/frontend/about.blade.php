@extends('layouts.app')

@section('content')
<div class="hero-section fade-in-up" style="padding: 60px 0 40px;">
    <h1 class="hero-title">About JobYaari</h1>
    <p class="text-muted fs-5 mb-0 mx-auto" style="max-width: 650px; line-height: 1.6;">
        Learn more about our mission to help students and job seekers find their path.
    </p>
</div>

<section id="about" class="about-section container-fluid px-0 fade-in-up mt-4">
    <div class="mx-auto" style="max-width: 1100px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-heading">Our Mission</h2>
            <p class="text-muted mx-auto" style="max-width: 880px; line-height: 1.7;">
                JobYaari is a modern career and update portal designed to help students, freshers, and job seekers stay informed with the latest opportunities. From government jobs and internships to admit cards and exam results, JobYaari brings all important updates together in one clean and easy-to-access platform.
            </p>
            <p class="text-muted mx-auto" style="max-width: 880px; line-height: 1.7;">
                Our goal is to provide fast, reliable, and user-friendly access to career-related information without unnecessary clutter. Whether you are preparing for competitive exams, searching for internships, or tracking recruitment notifications, JobYaari helps you stay ahead.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="about-cards feature-grid mb-4">
            <div class="about-card feature-card">
                <div class="icon"><i class="fa-solid fa-bolt"></i></div>
                <h4>Fast Updates</h4>
                <p>Get the latest job notifications, internships, admit cards, and exam results quickly.</p>
            </div>
            <div class="about-card feature-card">
                <div class="icon"><i class="fa-solid fa-shield-check"></i></div>
                <h4>Verified Information</h4>
                <p>All updates are curated carefully from trusted and official sources.</p>
            </div>
            <div class="about-card feature-card">
                <div class="icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
                <h4>Mobile Friendly</h4>
                <p>Seamless experience across desktop, tablet, and mobile devices.</p>
            </div>
        </div>

        <!-- More -->
        <div class="more-section glass-panel p-3 p-md-4">
            <h5 class="text-heading fw-bold">Continuous Evolution</h5>
            <p class="text-muted mb-0">JobYaari is continuously evolving to provide a better experience for users looking for career opportunities and educational updates. More features, smarter filters, and enhanced user experience improvements will be added in future updates.</p>
        </div>
    </div>
</section>
@endsection
