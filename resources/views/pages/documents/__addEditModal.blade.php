<div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="modal_title">Add Document</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <form action="{{ route('document.store') }}" method="POST" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="method_sec">
                    </div>
                    <div class="row">
                        <div class="col-12 mb-20">
                            <label for="name"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Document Name</label>
                            <input type="text" class="form-control radius-8" name="name" id="name"
                                placeholder="Enter Name">
                        </div>
                        <div class="col-12 mb-20">
                            <label for="employee_id"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Document File</label>
                            <div class="upload-image-wrapper d-flex align-items-center gap-3">
                                <div
                                    class="uploaded-img d-none position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                    <button type="button"
                                        class="uploaded-img__remove position-absolute top-0 end-0 z-1 text-2xxl line-height-1 me-8 mt-8 d-flex">
                                        <iconify-icon icon="radix-icons:cross-2"
                                            class="text-xl text-danger-600"></iconify-icon>
                                    </button>
                                    <img id="uploaded-img__preview" class="w-100 h-100 object-fit-cover"
                                        src="assets/images/user.png" alt="image">
                                </div>

                                <label
                                    class="upload-file h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1"
                                    for="upload-file">
                                    <iconify-icon icon="solar:camera-outline"
                                        class="text-xl text-secondary-light"></iconify-icon>
                                    <span class="fw-semibold text-secondary-light">Upload</span>
                                    <input id="upload-file" type="file" hidden name="file">
                                </label>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                            <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8"> 
                                Reset
                            </button>
                            <button type="submit" id="submitBtn" class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8"> 
                                Save Change
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
