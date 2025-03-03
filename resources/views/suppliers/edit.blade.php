@extends('layouts.app')

@section('content')
    <h2>Edit Supplier</h2>

    <form id="editSupplierForm" action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $supplier->email }}" required>
        </div>

        <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="contact_number" class="form-control" value="{{ $supplier->contact_number }}" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control">{{ $supplier->address }}</textarea>
        </div>

        <div class="form-group">
            <label>Company Name</label>
            <input type="text" name="company_name" class="form-control" value="{{ $supplier->company_name }}">
        </div>

        <div class="form-group">
            <label>GST Number</label>
            <input type="text" name="gst_number" class="form-control" value="{{ $supplier->gst_number }}">
        </div>

        <div class="form-group">
            <label>Website</label>
            <input type="url" name="website" class="form-control" value="{{ $supplier->website }}">
        </div>

        <div class="form-group">
            <label>Country</label>
            <input type="text" name="country" class="form-control" value="{{ $supplier->country }}">
        </div>

        <div class="form-group">
            <label>State</label>
            <input type="text" name="state" class="form-control" value="{{ $supplier->state }}">
        </div>

        <div class="form-group">
            <label>City</label>
            <input type="text" name="city" class="form-control" value="{{ $supplier->city }}">
        </div>

        <div class="form-group">
            <label>Postal Code</label>
            <input type="text" name="postal_code" class="form-control" value="{{ $supplier->postal_code }}">
        </div>

        <div class="form-group">
            <label>Contact Person</label>
            <input type="text" name="contact_person" class="form-control" value="{{ $supplier->contact_person }}">
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="active" {{ $supplier->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $supplier->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="form-group">
            <label>Contract Start Date</label>
            <input type="date" name="contract_start_date" class="form-control" value="{{ $supplier->contract_start_date }}">
        </div>

        <div class="form-group">
            <label>Contract End Date</label>
            <input type="date" name="contract_end_date" class="form-control" value="{{ $supplier->contract_end_date }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    	
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editSupplierForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    contact_number: {
                        required: true,
                        digits: true
                    },
                    // Add more validation rules as needed
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        method: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
    $('#formErrors').html('<div class="alert alert-success">Supplier updated successfully!</div>');

    // Show a Toastr success notification
    toastr.success("Supplier updated successfully!", "Success");

    // Redirect after 2 seconds
    setTimeout(function() {
        window.location.href = "{{ route('suppliers.index') }}";
    }, 2000);
},

            error: function(xhr) {
                $('#submitBtn').prop('disabled', false).text('Submit');

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value + '</li>';
                        toastr.error(value, "Error"); // Show Toastr error for each validation error
                    });
                    errorHtml += '</ul></div>';
                    $('#formErrors').html(errorHtml);
                } else {
                    toastr.error("An unexpected error occurred. Please try again.", "Error");
                }
            }
                    });
                }
            });
        });
    </script>
@endsection