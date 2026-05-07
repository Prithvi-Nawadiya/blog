@extends('layouts.app')

@section('content')
<div class="row justify-content-center fade-in-up">
    <div class="col-md-10 col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light rounded-circle shadow-sm me-3 text-white d-flex align-items-center justify-content-center" style="width:40px; height:40px; transition: 0.2s;"><i class="fa-solid fa-arrow-left fs-6"></i></a>
                <div>
                    <h2 class="fw-bold mb-0 text-white" style="letter-spacing: -0.5px; font-size: 1.8rem;">Edit Story</h2>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">Update your perspective</p>
                </div>
            </div>
            <button type="submit" form="editForm" class="btn btn-premium shadow-sm py-2 px-4 fw-medium d-none d-md-block">Update Story <i class="fa-solid fa-check ms-2"></i></button>
        </div>

        <div class="glass-panel p-4 p-md-5 border-0 shadow-sm" style="border-radius: 16px;">
            <form id="editForm" action="{{ route('admin.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4 mb-4">
                    <div class="col-md-8">
                        <label class="form-label fw-bold text-muted ms-1 small text-uppercase tracking-wider" style="font-size: 0.75rem;">Story Title</label>
                        <input type="text" name="title" class="form-control shadow-sm @error('title') is-invalid @enderror" value="{{ old('title', $blog->title) }}" required>
                        @error('title') <div class="invalid-feedback fw-medium ms-1 mt-1">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-muted ms-1 small text-uppercase tracking-wider" style="font-size: 0.75rem;">Category</label>
                        <select name="category" class="form-select shadow-sm @error('category') is-invalid @enderror" required>
                            <option value="">Select category</option>
                            <option value="Latest Jobs" {{ old('category', $blog->category) == 'Latest Jobs' ? 'selected' : '' }}>Latest Jobs</option>
                            <option value="Admit Cards" {{ old('category', $blog->category) == 'Admit Cards' ? 'selected' : '' }}>Admit Cards</option>
                            <option value="Results" {{ old('category', $blog->category) == 'Results' ? 'selected' : '' }}>Results</option>
                        </select>
                        @error('category') <div class="invalid-feedback fw-medium ms-1 mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-muted ms-1 small text-uppercase tracking-wider" style="font-size: 0.75rem;">Content</label>
                    <textarea id="contentEditor" name="content" rows="12" class="form-control shadow-sm @error('content') is-invalid @enderror" style="line-height: 1.7; font-size: 1rem; padding: 1.5rem;">{{ old('content', $blog->content) }}</textarea>
                    <!-- client-side placeholder for CKEditor validation (always present) -->
                    <div id="clientContentError" class="invalid-feedback fw-medium ms-1 mt-1" style="display:none"></div>
                    @error('content') <div class="invalid-feedback fw-medium ms-1 mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="mb-2 p-4 rounded-3 text-center" style="background: rgba(255,255,255,0.02); border: 2px dashed rgba(255,255,255,0.1); transition: 0.2s;">
                    @if($blog->image_url)
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted d-block mb-3" style="font-size: 0.85rem;">Current Image</label>
                            <img src="{{ $blog->image_url }}" alt="Current Cover" class="rounded-3 shadow-sm border border-secondary border-opacity-25 object-fit-cover" style="width: 200px; height: 120px;">
                        </div>
                    @else
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width:60px; height:60px; background: rgba(255,255,255,0.05);">
                            <i class="fa-solid fa-cloud-arrow-up fs-3 text-white"></i>
                        </div>
                    @endif
                    <label class="form-label fw-bold text-white d-block mb-1 fs-5">Upload New Image (Optional)</label>
                    <p class="text-muted mb-4" style="font-size: 0.85rem;">High quality JPG, PNG or GIF. Max 2MB.</p>
                    <input type="file" name="image" class="form-control form-control-sm shadow-sm mx-auto p-2 @error('image') is-invalid @enderror" accept="image/*" style="max-width: 400px; background: rgba(0,0,0,0.2) !important;">
                    @error('image') <div class="text-danger fw-medium mt-2" style="font-size: 0.85rem;">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end d-md-none mt-4 pt-4 border-top border-dark">
                    <button type="submit" class="btn btn-premium w-100 py-3 fw-medium">Update Story <i class="fa-solid fa-check ms-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        let editEditorInstance;
        ClassicEditor.create(document.querySelector('#contentEditor'), {
            toolbar: [ 'heading','|','bold','italic','link','bulletedList','numberedList','|','insertTable','blockQuote','code','undo','redo','imageUpload' ],
            heading: { options: [ { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' }, { model: 'heading1', view: 'h2', title: 'Heading 1', class: 'ck-heading_heading1' }, { model: 'heading2', view: 'h3', title: 'Heading 2', class: 'ck-heading_heading2' } ] },
            simpleUpload: {
                uploadUrl: '{{ route('admin.upload-image') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        }).then(editor => {
            editEditorInstance = editor;

            // helper to strip HTML and check for meaningful text
            function stripHtml(html) {
                const tmp = document.createElement('div');
                tmp.innerHTML = html;
                return (tmp.textContent || tmp.innerText || '');
            }

            const form = document.getElementById('editForm');
            const textarea = document.querySelector('#contentEditor');
            const clientError = document.getElementById('clientContentError');

            // remove client error when user types
            editor.model.document.on('change:data', function() {
                const text = stripHtml(editor.getData()).trim();
                if (text.length > 0) {
                    clientError.style.display = 'none';
                    clientError.textContent = '';
                    textarea.classList.remove('is-invalid');
                }
            });

            if (form) {
                form.addEventListener('submit', function(e){
                    if (editEditorInstance) {
                        const data = editEditorInstance.getData();
                        // sync editor data back to textarea so server receives it
                        textarea.value = data;

                        const text = stripHtml(data).trim();
                        if (text.length === 0) {
                            // prevent native form submit and show friendly message
                            e.preventDefault();
                            clientError.textContent = 'Please enter some content for your story.';
                            clientError.style.display = 'block';
                            textarea.classList.add('is-invalid');
                            // focus the editor so user can start typing
                            try { editEditorInstance.editing.view.focus(); } catch(err) { /* ignore */ }
                            return false;
                        }
                    }
                });
            }
        }).catch( error => { console.error(error); } );
    });
</script>
@endpush
