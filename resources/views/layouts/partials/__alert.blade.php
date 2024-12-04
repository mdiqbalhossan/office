@if (session('status'))
<div class="alert alert-primary bg-transparent text-primary-600 border-primary-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
    {{ session('status') }}
    <button class="remove-button text-primary-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger bg-transparent text-danger-600 border-danger-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
    {{ session('error') }}
    <button class="remove-button text-danger-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
</div>
@endif

@if (session('success'))
<div class="alert alert-success bg-transparent text-success-600 border-success-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
    {{ session('success') }}
    <button class="remove-button text-success-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
</div>
@endif

@if (session('warning'))
<div class="alert alert-warning bg-transparent text-warning-600 border-warning-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
    {{ session('warning') }}
    <button class="remove-button text-warning-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
</div>
@endif


