@extends('layouts.app')

@section('content')
<div class="hero-section fade-in-up pb-5">
    <h1 class="hero-title text-start mb-2" style="font-size: 3.5rem;">Explore Blogs</h1>
    <p class="text-muted fs-5 mb-0 text-start" style="max-width: 700px; line-height: 1.6;">
        Stay updated with the latest job alerts, results, admit cards, and career opportunities from across the industry.
    </p>
</div>
    
<!-- Modern Search/Filter Bar -->
<div class="glass-panel p-3 shadow-sm mb-5 fade-in-up" style="border-radius: 12px; margin-top: -20px; position: relative; z-index: 10;">
    <div class="d-flex filter-bar align-items-center gap-3">
        <div class="position-relative flex-grow-1">
            <i class="fa-solid fa-magnifying-glass position-absolute text-muted fs-6" style="left: 18px; top: 18px;"></i>
            <input type="text" id="searchInput" class="form-control filter-control ps-5" style="height: 54px; font-size: 1rem;" placeholder="Search for jobs, results, or articles..." aria-label="Search" autocomplete="off">
            <div id="searchSuggestions" class="search-suggestions d-none" aria-hidden="true"></div>
        </div>

        <div style="min-width: 240px;">
            <select id="categoryFilter" class="form-select filter-control fw-medium text-muted" style="height: 54px;" aria-label="Category filter">
                <option value="">All Categories</option>
                <option value="Admit Cards">Admit Cards</option>
                <option value="Results">Results</option>
                <option value="Latest Jobs">Latest Jobs</option>
                <option value="Government Jobs">Government Jobs</option>
            </select>
        </div>

        <div style="min-width: 180px;">
            <input id="dateFilter" type="date" class="form-control filter-control text-muted" style="height: 54px;" aria-label="Exact publish date" />
        </div>

        <div style="width:54px;">
            <button id="clearDateBtn" type="button" class="btn btn-light filter-control border-0 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;" title="Clear date"><i class="fa-solid fa-xmark text-muted fs-5"></i></button>
        </div>
        
        <button class="btn btn-premium d-flex align-items-center gap-2" style="height: 54px; padding: 0 30px;">
            <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>
    </div>
</div>


<!-- Trending topics removed per request -->

<!-- Featured section removed to avoid duplicate blog rendering. All blogs are rendered via the premium AJAX card grid. -->

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
                        <article class="horizontal-card fade-in-up" style="animation-delay: ${delay}s;">
                            <div class="img-wrap">
                                <img src="${imageUrl}" class="card-img-top" alt="${blog.title}">
                            </div>
                            <div class="card-body">
                                <div>
                                    <span class="badge-pastel mb-3">${blog.category}</span>
                                    <h2 class="card-title">${blog.title}</h2>
                                    <p class="card-text">${contentSnippet}</p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <div class="text-muted d-flex align-items-center gap-3" style="font-size: 0.9rem;">
                                        <span><i class="fa-regular fa-calendar-days me-2"></i>${date}</span>
                                        <span class="opacity-25">|</span>
                                        <span><i class="fa-regular fa-user me-2"></i>By Admin</span>
                                    </div>
                                    <a href="/blog/${blog.id}" class="btn btn-premium btn-sm px-4 py-2" style="border-radius: 8px;">Read More <i class="fa-solid fa-arrow-right ms-2"></i></a>
                                </div>
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
