@extends('layouts.app')

@section('content')
<div class="hero-section fade-in-up">
    <div class="d-flex justify-content-center mb-3">
        <span class="badge-pastel px-3 py-1 fs-6 border rounded-pill shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 0.8rem !important;">
            <span class="spinner-grow spinner-grow-sm" role="status" style="width: 6px; height: 6px; color: var(--accent-muted);"></span> 
            HireOn is live
        </span>
    </div>
    
    <h1 class="hero-title">Thoughts, stories and ideas.</h1>
    <p class="text-muted fs-5 mb-4 mx-auto" style="max-width: 650px; line-height: 1.6;">
        Immerse yourself in a beautifully crafted reading experience. Discover the latest insights on design, engineering, and startups.
    </p>
    
    <div class="glass-panel p-2 mx-auto shadow-sm" style="max-width: 900px; border-radius: 12px; margin-bottom: 30px;">
        <div class="d-flex filter-bar align-items-center" style="gap:10px;">
            <div class="position-relative flex-grow-1" style="min-width: 160px;">
                <i class="fa-solid fa-magnifying-glass position-absolute text-muted fs-6" style="left: 16px; top: 12px;"></i>
                <input type="text" id="searchInput" class="form-control form-control-sm filter-control ps-5" placeholder="Search curated articles..." aria-label="Search" autocomplete="off">
                <div id="searchSuggestions" class="search-suggestions d-none" aria-hidden="true"></div>
            </div>

            <div style="min-width: 200px;">
                <select id="categoryFilter" class="form-select form-select-sm filter-control fw-medium text-muted" aria-label="Category filter">
                    <option value="">All Topics</option>
                    <option value="Admit Cards">Admit Cards</option>
                    <option value="Results">Results</option>
                    <option value="Latest Jobs">Latest Jobs</option>
                </select>
            </div>

            <div style="min-width: 170px;">
                <input id="dateFilter" type="date" class="form-control form-control-sm filter-control text-muted" aria-label="Exact publish date" />
            </div>

            <div style="width:44px;">
                <button id="clearDateBtn" type="button" class="btn btn-light filter-control border-0 d-flex align-items-center justify-content-center" title="Clear date"><i class="fa-solid fa-xmark text-muted"></i></button>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- About Section -->
<section id="about" class="about-section container-fluid px-0 fade-in-up">
    <div class="mx-auto" style="max-width: 1100px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-heading">About Hireon</h2>
            <p class="text-muted mx-auto" style="max-width: 880px; line-height: 1.7;">
                Hireon is a modern career and update platform designed to help students, freshers, and job seekers stay informed with the latest opportunities. From government jobs and internships to admit cards and exam results, Hireon brings all important updates together in one clean and easy-to-access platform.
            </p>
            <p class="text-muted mx-auto" style="max-width: 880px; line-height: 1.7;">
                Our goal is to provide fast, reliable, and user-friendly access to career-related information without unnecessary clutter. Whether you are preparing for competitive exams, searching for internships, or tracking recruitment notifications, Hireon helps you stay ahead.
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
            <div class="about-card feature-card">
                <div class="icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                <h4>Smart Search</h4>
                <p>Quickly search for jobs, results, and updates using responsive AJAX-powered search.</p>
            </div>
            <div class="about-card feature-card">
                <div class="icon"><i class="fa-solid fa-filter"></i></div>
                <h4>Category Filters</h4>
                <p>Browse updates easily with dedicated categories like Jobs, Results, and Admit Cards.</p>
            </div>
            <div class="about-card feature-card">
                <div class="icon"><i class="fa-solid fa-desktop"></i></div>
                <h4>Responsive UI</h4>
                <p>Modern dark premium interface optimized for both laptops and smartphones.</p>
            </div>
            <div class="about-card feature-card">
                <div class="icon"><i class="fa-solid fa-route"></i></div>
                <h4>Easy Navigation</h4>
                <p>Simple and clean layout for smooth browsing experience.</p>
            </div>
            <div class="about-card feature-card">
                <div class="icon"><i class="fa-solid fa-bolt-lightning"></i></div>
                <h4>Real-Time Access</h4>
                <p>Stay updated with newly published opportunities and announcements instantly.</p>
            </div>
        </div>

        <!-- Why Choose Hireon -->
        <div class="why-choose mb-4">
            <h5 class="text-heading fw-bold mb-3">Why Choose Hireon</h5>
            <ul class="why-list text-muted">
                <li>Clean and modern interface</li>
                <li>Faster access to important updates</li>
                <li>Responsive and user-friendly experience</li>
                <li>Organized job and result categories</li>
                <li>Easy filtering and searching system</li>
                <li>Designed for students and job seekers</li>
            </ul>
        </div>

        <!-- More -->
        <div class="more-section glass-panel p-3 p-md-4">
            <h5 class="text-heading fw-bold">More</h5>
            <p class="text-muted mb-0">Hireon is continuously evolving to provide a better experience for users looking for career opportunities and educational updates. More features, smarter filters, and enhanced user experience improvements will be added in future updates.</p>
        </div>
    </div>
</section>

<!-- Trending topics removed per request -->

@if(isset($featured) && $featured->count())
<div class="row g-4 mb-5 fade-in-up">
    @foreach($featured as $f)
        <div class="col-md-4">
            <div class="card featured-card h-100">
                @php $img = $f->image_url ?: 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'; @endphp
                <img src="{{ $img }}" class="card-img-top" alt="{{ $f->title }}">
                <div class="card-body">
                    <span class="badge-pastel mb-2 px-3 py-1 rounded-pill shadow-sm fw-medium border-0" style="font-size: 0.75rem;">{{ $f->category }}</span>
                    <h5 class="fw-bold" style="font-size: 1.05rem;">{{ $f->title }}</h5>
                    <div class="text-muted mt-2" style="font-size: 0.85rem;"><i class="fa-regular fa-calendar me-1"></i> {{ $f->created_at->format('F j, Y') }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif

<div id="loading" class="text-center d-none my-5 py-4">
    <div class="spinner-grow opacity-75" style="width: 2rem; height: 2rem; color: var(--accent-muted);" role="status"></div>
</div>

<!-- Refined Grid Space -->
<div class="card-grid mt-2" id="blogList">
    <!-- AJAX Cards injected here -->
</div>

<div id="emptyState" class="text-center d-none my-5 py-5 glass-panel fade-in-up shadow-sm border-0" style="padding: 60px 0;">
    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width:60px; height:60px; background: rgba(255,255,255,0.03);">
        <i class="fa-solid fa-layer-group fs-3 text-muted"></i>
    </div>
    <h3 class="fw-bold mb-2 fs-3 text-heading">No stories found</h3>
    <p class="text-muted mb-0 fs-6" style="max-width: 400px; margin: 0 auto;">Try adjusting your search keywords or browsing a different topic.</p>
</div>

<div class="text-center mt-4 pt-4 d-none" id="loadMoreContainer">
    <button id="loadMoreBtn" class="btn btn-light px-4 py-2 fs-6 shadow-sm fw-medium">Load More Stories <i class="fa-solid fa-arrow-down ms-2"></i></button>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let currentPage = 1;
    let hasMorePages = true;

    function fetchBlogs(page = 1, append = false) {
        let search = $('#searchInput').val();
        let category = $('#categoryFilter').val();
    let dateFilter = $('#dateFilter').val();

        if (!append) {
            $('#blogList').empty();
            $('#loading').removeClass('d-none');
            $('#emptyState').addClass('d-none');
            $('#loadMoreContainer').addClass('d-none');
        }

        $.ajax({
            url: '/filter',
            type: 'GET',
            data: { search: search, category: category, page: page, date: dateFilter },
            success: function(response) {
                if (!append) $('#loading').addClass('d-none');
                
                let blogs = response.data.data;
                hasMorePages = response.data.current_page < response.data.last_page;
                
                if (blogs.length === 0 && !append) {
                    $('#emptyState').removeClass('d-none');
                    return;
                }

                blogs.forEach(function(blog, index) {
                    let date = new Date(blog.created_at).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
                    let imageUrl = (blog.image_url && blog.image_url.length) ? blog.image_url : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                    let contentSnippet = $('<div>').html(blog.content).text();
                    if (contentSnippet.length > 140) contentSnippet = contentSnippet.substring(0, 140) + '...';
                    let delay = index * 0.04;

                    let card = `
                        <article class="premium-card fade-in-up" style="animation-delay: ${delay}s;">
                            <div class="position-relative">
                                <img src="${imageUrl}" class="card-img-top w-100" alt="${blog.title}">
                                <span class="position-absolute top-0 end-0 m-3 badge-pastel shadow-sm">${blog.category}</span>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">${blog.title}</h4>
                                <p class="card-text">${contentSnippet}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <div class="text-muted" style="font-size: 0.85rem; font-weight: 500;"><i class="fa-regular fa-clock me-1"></i> ${date}</div>
                                <a href="/blog/${blog.id}" class="text-decoration-none fw-semibold px-3 py-1 rounded-pill" style="background: rgba(255,255,255,0.03); color: var(--text-main); transition: 0.2s; font-size: 0.85rem; border: 1px solid var(--border-dark);">Read</a>
                            </div>
                        </article>
                    `;
                    $('#blogList').append(card);
                });

                if (hasMorePages) {
                    $('#loadMoreContainer').removeClass('d-none');
                } else {
                    $('#loadMoreContainer').addClass('d-none');
                }
            },
            error: function() {
                $('#loading').addClass('d-none');
                alert('Error loading blogs from API.');
            }
        });
    }

    fetchBlogs();

    let typingTimer;
    $('#searchInput').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function() {
            currentPage = 1;
            fetchBlogs(currentPage);
        }, 400);
    });

    // Live search suggestions (small result set)
    let suggestionTimer;
    $('#searchInput').on('input', function(e){
        clearTimeout(suggestionTimer);
        const q = $(this).val().trim();
        const box = $('#searchSuggestions');
        if (!q) { box.addClass('d-none'); return; }
        suggestionTimer = setTimeout(function(){
            $.ajax({ url: '/filter', type: 'GET', data: { search: q, page: 1, per_page: 5 }, success: function(res){
                const items = res.data.data || [];
                if (!items.length) { box.addClass('d-none'); return; }
                box.empty();
                items.forEach(function(b){
                    const el = $('<div>').addClass('item d-flex');
                    const inner = `<div style="flex:1"><div class=\"title\">${b.title}</div><div class=\"meta\">${b.category} · ${new Date(b.created_at).toLocaleDateString()}</div></div>`;
                    el.html(inner);
                    el.on('click', function(){ window.location = '/blog/' + b.id; });
                    box.append(el);
                });
                box.removeClass('d-none');
            } });
        }, 250);
    });

    // Hide suggestions when clicking outside
    $(document).on('click', function(e){ if (!$(e.target).closest('#searchSuggestions, #searchInput').length) { $('#searchSuggestions').addClass('d-none'); } });

    $('#categoryFilter').on('change', function() {
        currentPage = 1;
        fetchBlogs(currentPage);
    });

    $('#dateFilter').on('change', function() {
        currentPage = 1;
        fetchBlogs(currentPage);
    });

    $('#clearDateBtn').on('click', function() {
        $('#dateFilter').val('');
        currentPage = 1;
        fetchBlogs(currentPage);
    });

    $('#loadMoreBtn').on('click', function() {
        if (hasMorePages) {
            currentPage++;
            fetchBlogs(currentPage, true);
        }
    });
});
</script>
@endpush
