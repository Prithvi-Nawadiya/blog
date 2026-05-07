@extends('layouts.app')

@section('content')
<div class="fade-in-up">
    <!-- Dashboard Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 pb-3 glass-panel p-4 shadow-sm border-0" style="border-radius: 16px;">
        <div>
            <h2 class="fw-bold mb-1 text-white" style="letter-spacing: -0.5px; font-size: 1.8rem;"><i class="fa-solid fa-shapes me-3" style="color: #a8b2d1;"></i>Creator Studio</h2>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">Manage and refine your elegant stories</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('admin.create') }}" class="btn btn-premium shadow-sm py-2 px-4"><i class="fa-solid fa-pen-nib me-2"></i> Write New Story</a>
        </div>
    </div>

    <!-- Dashboard Table -->
    <div class="glass-panel overflow-hidden p-0 border-0 shadow-sm" style="border-radius: 16px;">
        <div class="table-responsive">
            <table class="table table-borderless table-hover align-middle mb-0 bg-transparent">
                <thead style="background: rgba(255,255,255,0.02); border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <tr>
                        <th class="py-3 ps-4 text-muted fw-bold text-uppercase tracking-wider" style="font-size: 0.8rem;">Story Details</th>
                        <th class="py-3 text-muted fw-bold text-uppercase tracking-wider" style="font-size: 0.8rem;">Category</th>
                        <th class="py-3 text-muted fw-bold text-uppercase tracking-wider" style="font-size: 0.8rem;">Published Date</th>
                        <th class="py-3 pe-4 text-end text-muted fw-bold text-uppercase tracking-wider" style="font-size: 0.8rem;">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.03); transition: background 0.2s;">
                            <td class="py-3 ps-4">
                                <div class="d-flex align-items-center">
                                    @if($blog->image_url)
                                        <img src="{{ $blog->image_url }}" alt="img" class="rounded-3 object-fit-cover shadow-sm me-3 border border-secondary border-opacity-25" style="width: 80px; height: 56px;">
                                    @else
                                        <div class="rounded-3 shadow-sm me-3 d-flex align-items-center justify-content-center border border-secondary border-opacity-25" style="width:80px; height:56px; background: rgba(255,255,255,0.02);">
                                            <i class="fa-regular fa-image text-muted fs-4"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold text-white mb-1" style="font-size: 1rem; letter-spacing: -0.2px;">{{ $blog->title }}</div>
                                        <div class="text-muted text-truncate" style="font-size: 0.85rem; max-width: 300px;">{{ Str::limit($blog->content, 60) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3"><span class="badge-pastel border-0 shadow-sm">{{ $blog->category }}</span></td>
                            <td class="py-3 text-muted fw-medium" style="font-size: 0.9rem;"><i class="fa-regular fa-calendar-check me-2 opacity-50"></i>{{ $blog->created_at->format('F j, Y') }}</td>
                            <td class="py-3 pe-4 text-end">
                                <a href="{{ route('admin.edit', $blog->id) }}" class="btn btn-light rounded-circle shadow-sm me-2 text-white" style="width:36px; height:36px; padding: 0; display: inline-flex; align-items: center; justify-content: center; transition: 0.2s;"><i class="fa-solid fa-pen" style="font-size: 0.8rem;"></i></a>
                                <form action="{{ route('admin.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this story forever?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light rounded-circle shadow-sm text-danger" style="width:36px; height:36px; padding: 0; display: inline-flex; align-items: center; justify-content: center; transition: 0.2s;"><i class="fa-solid fa-trash-can" style="font-size: 0.8rem;"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="opacity-75 py-5 my-3">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width:80px; height:80px; background: rgba(255,255,255,0.03);">
                                        <i class="fa-solid fa-feather fs-2 text-muted"></i>
                                    </div>
                                    <h3 class="fw-bold text-white mb-2" style="font-size: 1.5rem;">Your canvas is blank</h3>
                                    <p class="text-muted mb-4" style="font-size: 0.95rem;">You haven't published any stories yet.</p>
                                    <a href="{{ route('admin.create') }}" class="btn btn-premium shadow-sm py-2 px-4">Start Writing</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($blogs->hasPages())
            <div class="p-4" style="background: rgba(255,255,255,0.02); border-top: 1px solid rgba(255,255,255,0.03);">
                {{ $blogs->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
