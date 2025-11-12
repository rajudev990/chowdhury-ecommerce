@extends('admin.layouts.app')

@section('title', 'Vendor Sellers List')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

         {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">Vendor Sellers List</h5>
            <a href="{{  route('admin.all-sellers.create') }}" class="btn btn-light btn-sm">
                <i class="fa fa-plus me-1"></i> Add 
            </a>
        </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase text-secondary small">
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Shop Name</th>
                            <th scope="col">Shop Slug</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td class="text-center fw-medium">{{ $loop->iteration }}</td>
                            <td class="fw-semibold text-dark">{{ $item->shop_name }}</td>
                            <td>{{ $item->shop_slug }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                @if ($item->status === 'active')
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                        Active
                                    </span>
                                @elseif ($item->status === 'inactive')
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                        Pending
                                    </span>
                                @elseif ($item->status === 'banned')
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <a href="{{ route('admin.all-sellers.edit', $item->id) }}" 
                                       class="btn btn-sm btn-primary rounded-circle shadow-sm" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form id="delete-form-{{ $item->id }}" 
                                          action="{{ route('admin.all-sellers.destroy', $item->id) }}" 
                                          method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <button type="button" 
                                            class="btn btn-sm btn-danger rounded-circle shadow-sm delete-btn" 
                                            data-id="{{ $item->id }}" 
                                            title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-2">
                                No sellers found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

<!-- Optional delete confirmation script -->
@push('scripts')
<script>
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function () {
        const id = this.dataset.id;
        if (confirm('Are you sure you want to delete this seller?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
});
</script>
@endpush
@endsection
