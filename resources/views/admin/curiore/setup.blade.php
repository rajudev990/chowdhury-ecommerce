@extends('admin.layouts.app')

@section('title', 'Update Couriers')

@section('content')
<div class="container py-5">

    <!-- StredFast -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Update StredFast</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.stredfast.update', $stredfast->id) }}">
                @csrf
              
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">API Base URL <span class="text-danger">*</span></label>
                        <input type="text" name="url" value="{{ old('url', $stredfast->url) }}" class="form-control" placeholder="Enter API Base URL" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">API Key <span class="text-danger">*</span></label>
                        <input type="text" name="api_key" value="{{ old('api_key', $stredfast->api_key) }}" class="form-control" placeholder="Enter API Key" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Secret Key <span class="text-danger">*</span></label>
                        <input type="text" name="secret_key" value="{{ old('secret_key', $stredfast->secret_key) }}" class="form-control" placeholder="Enter Secret Key" required>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple"><i class="fa fa-edit me-1"></i> Update StredFast</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pathau -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Update Pathau</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pathau.update', $pathau->id) }}">
                @csrf
              
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">API Base URL <span class="text-danger">*</span></label>
                        <input type="text" name="api_key" value="{{ old('api_key', $pathau->api_key) }}" class="form-control" placeholder="Enter API Key" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Store ID <span class="text-danger">*</span></label>
                        <input type="text" name="store_id" value="{{ old('store_id', $pathau->store_id) }}" class="form-control" placeholder="Enter Store ID" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Client ID <span class="text-danger">*</span></label>
                        <input type="text" name="client_id" value="{{ old('client_id', $pathau->client_id) }}" class="form-control" placeholder="Enter Client ID" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Client Secret <span class="text-danger">*</span></label>
                        <input type="text" name="secret_key" value="{{ old('secret_key', $pathau->secret_key) }}" class="form-control" placeholder="Enter Client Secret" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Client Email <span class="text-danger">*</span></label>
                        <input type="email" name="client_email" value="{{ old('client_email', $pathau->client_email) }}" class="form-control" placeholder="Enter Client Email" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Client Password <span class="text-danger">*</span></label>
                        <input type="text" name="client_password" value="{{ old('client_password', $pathau->client_password) }}" class="form-control" placeholder="Enter Client Password" required>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple"><i class="fa fa-edit me-1"></i> Update Pathau</button>
                </div>
            </form>
        </div>
    </div>

    <!-- REDX -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Update REDX</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.redx.update', $redx->id) }}">
                @csrf
              
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">API Base URL <span class="text-danger">*</span></label>
                        <input type="text" name="url" value="{{ old('url', $redx->url) }}" class="form-control" placeholder="Enter API Base URL" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Store ID <span class="text-danger">*</span></label>
                        <input type="text" name="store_id" value="{{ old('store_id', $redx->store_id) }}" class="form-control" placeholder="Enter Store ID" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">API Token <span class="text-danger">*</span></label>
                        <input type="text" name="api_token" value="{{ old('api_token', $redx->api_token) }}" class="form-control" placeholder="Enter API Token" required>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple"><i class="fa fa-edit me-1"></i> Update REDX</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Curiore -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Update Curiore</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.curiores.update', $curiore->id) }}">
                @csrf
              
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">API Base URL <span class="text-danger">*</span></label>
                        <input type="text" name="url" value="{{ old('url', $curiore->url) }}" class="form-control" placeholder="Enter API Base URL" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">API Key <span class="text-danger">*</span></label>
                        <input type="text" name="api_key" value="{{ old('api_key', $curiore->api_key) }}" class="form-control" placeholder="Enter API Key" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Secret Key <span class="text-danger">*</span></label>
                        <input type="text" name="secret_key" value="{{ old('secret_key', $curiore->secret_key) }}" class="form-control" placeholder="Enter Secret Key" required>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple"><i class="fa fa-edit me-1"></i> Update Curiore</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
