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
          <a href="{{ url(ADMINPATH.'education-list') }}" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          View Education List
          </a>
        </div>
        <div class="card-header">
          <form>
            <input type="hidden" id='education_id' value="{{$id}}">
            <div class="row mt-2">
            <div class="col-sm-3 mb-2">
                <label for="title">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" required placeholder="Enter Title" class="form-control" value="{{$education_title}}"/>
              </div>
              <div class="col-sm-3 mb-2">
                <label for="institution">Institution <span class="text-danger">*</span></label>
                <input type="text" name="institution" id="institution" required placeholder="Enter Institution" class="form-control ucwords restrictedInput" value="{{$institution}}"/>
              </div>
              <div class="col-sm-3 mb-2">
                <label for="institution_place">Institution Place <span class="text-danger">*</span></label>
                <input type="text" name="institution_place" id="institution_place" required placeholder="Enter Institution Place" class="form-control ucwords restrictedInput" value="{{$institution_place}}"/>
              </div>
              <div class="col-sm-3 mb-2">
                <label for="pass_year">Pass Year <span class="text-danger">*</span></label>
                <input type="text" name="pass_year" id="pass_year" required placeholder="Enter From Year" class="form-control"  value="{{$pass_year}}"/>
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
                  <button type="button" id="submit" onclick="return validateEducation()" class="btn btn-success">Submit</button>
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
    function validateEducation() {
    var education_id = $('#education_id').val().trim();
    var title = $('#title').val();
    var institution = $('#institution').val().trim();
    var pass_year = $('#pass_year').val().trim();
    var institution_place = $('#institution_place').val().trim();
    var status = $('.status:checked').val().trim();


    if (title === "") {
        toastr.error("Enter Title");
        return false;
    } else if (institution === "") {
        toastr.error("Enter From Year");
        return false;
    } else if (institution_place === "") {
        toastr.error("Enter Institution Place");
        return false;
    } else if (pass_year === "") {
        toastr.error("Enter Pass Out Year");
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
                    url: '{{ url(ADMINPATH.'save-education') }}', // Replace this with the actual backend endpoint URL
                    type: 'POST',
                    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
                    data: {
                        'id': education_id,
                        'title': title,
                        'institution': institution,
                        'institution_place': institution_place,
                        'pass_year': pass_year,
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