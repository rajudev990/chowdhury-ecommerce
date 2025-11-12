@extends('admin.layouts.app')

@section('title', 'Sizes List')

@section('content')
<div class="container-fluid py-4">
    {{-- Card Wrapper --}}
    <div class="card shadow-lg rounded-3">
        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">Sizes List</h5>
            <a href="{{ route('admin.sizes.create') }}" class="btn btn-light btn-sm">
                <i class="fa fa-plus me-1"></i> Add Size
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
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sizes as $size)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $size->name }}</td>
                            <td>
                                <span class="badge {{ $size->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $size->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    {{-- Edit --}}
                                    <a href="{{ route('admin.sizes.edit', $size->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form id="delete-form-{{ $size->id }}" action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" data-id="{{ $size->id }}" class="btn btn-danger btn-sm delete-btn">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-2">No sizes found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-3">
                {{ $sizes->links() }}
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
            if (confirm('Are you sure you want to delete this size?')) {
                document.getElementById('delete-form-' + id)?.submit();
            }
        });
    });
</script>
@endsection
