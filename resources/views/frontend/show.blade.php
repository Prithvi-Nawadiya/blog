@extends('layouts.app')

@section('content')
<div class="row justify-content-center fade-in-up">
    <div class="col-lg-9 col-xl-8">
        <div class="glass-panel overflow-hidden border-0 p-0 shadow-sm mb-5" style="border-radius: 16px;">
                @php
                    $defaultImg = 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
                    $coverImage = $blog->image_url ?: $defaultImg;
                @endphp
            <div class="position-relative" style="height: 450px;">
                <img src="{{ $coverImage }}" class="w-100 h-100 object-fit-cover" alt="{{ $blog->title }}">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(9,9,11,1));"></div>
                
                <div class="position-absolute top-0 start-0 w-100 p-4">
                    <a href="{{ route('frontend.index') }}" class="btn btn-light rounded-pill px-4 py-2 shadow-sm fw-medium border-0" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); color: #fff !important; font-size: 0.9rem;"><i class="fa-solid fa-arrow-left me-2"></i>Back</a>
                </div>
                
                <div class="position-absolute bottom-0 start-0 w-100 p-4 p-md-5 text-white">
                    <div class="container-fluid px-0" style="max-width: 800px; margin: 0 auto;">
                        <span class="badge-pastel mb-3 px-3 py-1 rounded-pill shadow-sm fw-medium border-0" style="font-size: 0.8rem;">{{ $blog->category }}</span>
                        <h1 class="fw-bold mb-3 text-white" style="letter-spacing: -1px; text-shadow: 0 4px 15px rgba(0,0,0,0.5); font-size: 2.8rem; line-height: 1.15;">{{ $blog->title }}</h1>
                        <div class="d-flex align-items-center opacity-75 fw-medium" style="font-size: 0.95rem;">
                            <i class="fa-regular fa-calendar me-2"></i> {{ $blog->created_at->format('F j, Y') }}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-4 p-md-5 position-relative" style="background: var(--bg-card);">
                <div class="container-fluid px-0" style="max-width: 800px; margin: 0 auto;">
                    <div class="article-content text-main rendered-content" style="line-height: 1.8; font-size: 1.1rem; font-weight: 300; letter-spacing: -0.01em;">
                        {!! $blog->content !!}
                    </div>
                    
                    <hr class="my-5 border-2 border-dark opacity-50" style="margin-top: 60px !important; margin-bottom: 60px !important;">
                    
                    <div class="d-flex justify-content-between align-items-center rounded-4 p-4" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);">
                        <div>
                            <h4 class="fw-bold mb-1 text-white" style="font-size: 1.2rem;">Loved this update?</h4>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">Share it with your network.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-light rounded-circle shadow-sm text-white border-0 d-flex align-items-center justify-content-center" style="width:40px; height:40px; background: rgba(255,255,255,0.05) !important;"><i class="fa-brands fa-twitter fs-5"></i></button>
                            <button class="btn btn-light rounded-circle shadow-sm text-white border-0 d-flex align-items-center justify-content-center" style="width:40px; height:40px; background: rgba(255,255,255,0.05) !important;"><i class="fa-brands fa-linkedin-in fs-5"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
