<div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="modal_title">Add Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <form action="{{ route('department.store') }}" method="POST" id="form">
                    @csrf
                    <div id="method_sec">
                    </div>
                    <div class="row">   
                        <div class="col-6 mb-20">
                            <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Name </label>
                            <input type="text" class="form-control radius-8" name="name" id="name" placeholder="Enter Name">
                        </div>
                        <div class="col-6 mb-20">
                            <label for="department" class="form-label fw-semibold text-primary-light text-sm mb-8">Department</label>
                            <select class="form-control radius-8 form-select" id="department" name="department">
                                <option selected disabled>Select Department</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="col-6 mb-20">
                            <label for="status" class="form-label fw-semibold text-primary-light text-sm mb-8">Status </label>
                            <select class="form-control radius-8 form-select" id="status" name="status">
                                <option selected disabled>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>   
                        <div class="col-6 mb-20">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" cols="50" placeholder="Enter a description..."></textarea>
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