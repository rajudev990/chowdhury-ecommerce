@extends('admin.layouts.app')

@section('title', 'Categories List')

@section('content')
<div class="container-fluid py-4">
    {{-- Card Wrapper --}}
    <div class="card shadow-lg rounded-3">
        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">Categories List</h5>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-light btn-sm">
                <i class="fa fa-plus me-1"></i> Add Category
            </a>
        </div>

        {{-- Card Body --}}
        <div class="card-body p-0">
            {{-- Responsive Table --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" class="rounded-circle" style="width:50px;height:50px;object-fit:cover;">
                                @else
                                <span class="text-muted fst-italic small">No Image</span>
                                @endif
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <span class="badge {{ $category->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $category->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form id="delete-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" data-id="{{ $category->id }}" class="btn btn-danger btn-sm delete-btn">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            if(confirm('Are you sure you want to delete this category?')) {
                document.getElementById('delete-form-' + id)?.submit();
            }
        });
    });
</script>
@endsection
