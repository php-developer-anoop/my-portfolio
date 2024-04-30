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
          <a href="{{ url(ADMINPATH.'portfolio-list') }}" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          View Portfolio List
          </a>
        </div>
        <div class="card-header">
          <form>
            <input type="hidden" id='portfolio_id' value="{{$id}}">
            <div class="row mt-2">
              <div class="col-sm-4 mb-2">
                <label for="project_category">Project Category <span class="text-danger">*</span></label>
                <input type="text" name="project_category" id="project_category" required placeholder="Enter Project Category" class="form-control ucwords restrictedInput" value="{{$project_category}}"/>
              </div>
              <div class="col-sm-4 mb-2">
                <label for="project_name">Project Name <span class="text-danger">*</span></label>
                <input type="text" name="project_name" id="project_name" required placeholder="Enter Project Name" class="form-control ucwords restrictedInput" value="{{$project_name}}"/>
              </div>
              <div class="col-sm-4 mb-2">
                <label for="project_url">Project Url <span class="text-danger">*</span></label>
                <input type="text" name="project_url" id="project_url" required placeholder="Enter Project Url" class="form-control" value="{{$project_url}}"/>
              </div>
              <div class="col-sm-12 mb-2">
                <label for="short_description">Short Description<span class="text-danger">*</span></label>
                <textarea name="short_description" class="form-control" id="short_description" cols="5" rows="3">{{$short_description}}</textarea>
              </div>
              <div class="col-sm-4">
                <label for="project_image" class="col-form-label">Project Image</label>
                <input type="file" name="project_image" id="project_image" class="form-control" accept="image/png, image/jpg, image/jpeg">
              </div>
              @if (!empty($project_image))
              <div class="col-sm-2 mt-2">
                <img src="{{ asset('uploads/' . $project_image) }}" height="70px" width="100px" alt="Logo">
              </div>
              @endif
              </div>
              <div class="row mt-2">
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
                  <button type="button" id="submit" onclick="return validatePortfolio()" class="btn btn-success">Submit</button>
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
function validatePortfolio() {
    var portfolio_id = $('#portfolio_id').val().trim();
    var project_category = $('#project_category').val().trim();
    var project_name = $('#project_name').val().trim();
    var project_url = $('#project_url').val().trim();
    var short_description = $('#short_description').val().trim();
    var status = $('.status:checked').val().trim();
    var project_image = $('#project_image')[0].files[0];

    if (project_image) {
        var fileName = project_image.name;
        var fileExtension = fileName.split('.').pop().toLowerCase();
        var allowedExtensions = ['jpg', 'jpeg', 'png'];
        var maxSize = 1 * 1024 * 1024;

        if ($.inArray(fileExtension, allowedExtensions) === -1) {
            toastr.error('Invalid file type! Please select a JPG, JPEG, or PNG file.');
            return false;
        } else if (project_image.size > maxSize) {
            toastr.error('Please select a file less than 1 MB.');
            return false;
        }
    } 

    var formData = new FormData();
    formData.append('id', portfolio_id);
    formData.append('project_image', project_image);
    formData.append('project_category', project_category);
    formData.append('project_name', project_name);
    formData.append('project_url', project_url);
    formData.append('short_description', short_description);
    formData.append('status', status);

    if (project_category === "") {
        toastr.error("Enter Project Category");
        return false;
    } else if (project_name === "") {
        toastr.error("Enter Project Name");
        return false;
    } else if (project_url === "") {
        toastr.error("Enter Project URL");
        return false;
    } else if (short_description === "") {
        toastr.error("Enter Short Description");
        return false;
    } else {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to submit',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url(ADMINPATH.'save-portfolio') }}', // Replace this with the actual backend endpoint URL
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
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
                        console.error(xhr, status, error);
                        Swal.fire("Error occurred. Please try again.");
                        $('#submit').text('Submit');
                        $('#submit').prop("disabled", false);
                    }
                });
            }
        });
    }
}


</script>