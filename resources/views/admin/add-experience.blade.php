<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="{{ url(ADMINPATH.'dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">
              <?= $menu ?>
            </li>
            <li class="breadcrumb-item active">
              <?= $title ?>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <a href="{{ url(ADMINPATH.'experience-list') }}" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          View Experiences
          </a>
        </div>
        <div class="card-header">
          <form action="{{url(ADMINPATH.'save-experience')}}" method="post">
          @csrf
            <input type="hidden" name="id" id='id' value="{{$id}}">
            <div class="row mt-2">
            <div class="col-sm-3 mb-2">
                <label for="company">Company <span class="text-danger">*</span></label>
                <input type="text" name="company" id="company" required placeholder="Enter Company" class="form-control ucwords" value="{{$company}}"/>
              </div>
              <div class="col-sm-3 mb-2">
                <label for="position">Position <span class="text-danger">*</span></label>
                <input type="text" name="position" id="position" required placeholder="Enter Position" class="form-control" value="{{$position}}"/>
              </div>
              <div class="col-sm-3 mb-2">
                <label for="from_year">From Year <span class="text-danger">*</span></label>
                <input type="text" name="from_year" id="from_year" required placeholder="Enter From Year" class="form-control"  value="{{$from_year}}"/>
              </div>
              <div class="col-sm-3 mb-2">
                <label for="to_year">To Year <span class="text-danger">*</span></label>
                <input type="text" name="to_year" id="to_year" required placeholder="Enter To Year" class="form-control" value="{{$to_year}}"/>
              </div>
              
              
              <div class="col-sm-12 mb-2">
                <label for="description">Description <span class="text-danger">*</span></label>
                <textarea name="description" id="description" class="description">{{$description}}</textarea>
              </div>
              <div class="col-sm-3">
                <label for="status" class="col-form-label">Status</label>
                <div class="row mt-2">
                  <div class="col-6">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input status" name="status" <?= ($status == 'Active') ? 'checked' : '' ?> type="radio" id="checkStatus1" value="Active" checked>
                      <label for="checkStatus1" class="custom-control-label">Active</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input status" name="status" <?= ($status == 'Inactive') ? 'checked' : '' ?> type="radio" id="checkStatus2" value="Inactive">
                      <label for="checkStatus2" class="custom-control-label">Inactive</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row mt-2">
              <div class="col-sm-12">
                <div class="custom-btn-group">
                  <button type="submit" id="submit"  class="btn btn-success">Submit</button>
                </div>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script>
    function validateExperience() {
    var experience_id = $('#experience_id').val().trim();
    var company = $('#company').val();
    var position = $('#position').val();
    var from_year = $('#from_year').val().trim();
    var to_year = $('#to_year').val().trim();
    var description = $('.description').val().trim();
      alert(description);
    var status = $('.status:checked').val().trim();


    if (company === "") {
        toastr.error("Enter Company");
        return false;
    } else if (position === "") {
        toastr.error("Enter Position");
        return false;
    } else if (from_year === "") {
        toastr.error("Enter From Year");
        return false;
    } else if (to_year === "") {
        toastr.error("Enter To Year");
        return false;
    } else {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You Want to Submit',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url(ADMINPATH.'save-experience') }}', // Replace this with the actual backend endpoint URL
                    type: 'POST',
                    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
                    data: {
                        'id': experience_id,
                        'company': company,
                        'position': position,
                        'from_year': from_year,
                        'to_year': to_year,
                        'description': description,
                        'status': status,
                        
                    },
                    cache: false,
                    dataType: "json",
                    beforeSend: function () {
                        $('#submit').text('Please Wait...');
                        $('#submit').prop("disabled", true);
                    },
                    success: function (response) {
                        if (response.status === false) {
                            toastr.error(response.message);
                            $('#submit').text('Submit');
                            $('#submit').prop("disabled", false);
                        } else if (response.status === true) {
                            toastr.success(response.message);
                            setTimeout(function () {
                                window.location.href = response.url;
                            }, 500);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error if necessary
                        console.error(xhr, status, error);

                        Swal.fire("Error occurred. Please try again.");
                        $('#submit').text('Submit');
                            $('#submit').prop("disabled", false); // Show a generic error message
                    }
                });
            }
        });
    }
}

</script>