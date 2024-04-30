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
          <a href="{{ url(ADMINPATH.'cms-list') }}" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          View Cms Pages
          </a>
        </div>
        <div class="card-header">
          <form>
            <input type="hidden" id='cms_id' value="{{$id}}">
            <div class="row mt-2">
              <div class="col-sm-3 mb-2">
                <label for="page_name">Page Name <span class="text-danger">*</span></label>
                <select name="page_name" id="page_name" class="form-control select2" required onchange="return getSlug(this.value)">
                    <option value="">Select Page Name</option>
                    <option value="About Me" <?=!empty($page_name) && ($page_name == "About Me") ? "selected" : ""?>>About Me</option>
                    <option value="Contact Me" <?=!empty($page_name) && ($page_name == "Contact Me") ? "selected" : ""?>>Contact Me</option>
                    <option value="Portfolio" <?=!empty($page_name) && ($page_name == "Portfolio") ? "selected" : ""?>>Portfolio</option>
                </select>
              </div>
              <div class="col-sm-3 mb-2">
                <label for="page_slug">Page Slug <span class="text-danger">*</span></label>
                <input type="text" name="page_slug" id="page_slug" required placeholder="Enter Page Slug" class="form-control" value="{{$page_slug}}"/>
              </div>
              <div class="col-sm-6 mb-2">
                <label for="meta_title">Meta Title <span class="text-danger">*</span></label>
                <input type="text" name="meta_title" id="meta_title" required placeholder="Enter Meta Title" class="form-control" value="{{$meta_title}}"/>
              </div>
              <div class="col-sm-6 mb-2">
                <label for="meta_description">Meta Description <span class="text-danger">*</span></label>
                <input type="text" name="meta_description" id="meta_description" required placeholder="Enter Meta Description" class="form-control" value="{{$meta_description}}"/>
              </div>
              <div class="col-sm-6 mb-2">
                <label for="meta_keywords">Meta Keywords <span class="text-danger">*</span></label>
                <input type="text" name="meta_keywords" id="meta_keywords" required placeholder="Enter Meta Keywords" class="form-control" value="{{$meta_keywords}}"/>
              </div>
              <div class="col-sm-12 mb-2">
                <label for="short_description">Short Description <span class="text-danger">*</span></label>
                <input type="text" name="short_description" id="short_description" required placeholder="Enter Short Description" class="form-control" value="{{$short_description}}"/>
              </div>
              <div class="col-sm-6">
                <label for="status" class="col-form-label">Status</label>
                <div class="row mt-2">
                  <div class="col-2">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input status" name="status" <?= ($status == 'Active') ? 'checked' : '' ?> type="radio" id="checkStatus1" value="Active" checked>
                      <label for="checkStatus1" class="custom-control-label">Active</label>
                    </div>
                  </div>
                  <div class="col-2">
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
                  <button type="button" id="submit" onclick="return validateCms()" class="btn btn-success">Submit</button>
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
    function validateCms() {
    var cms_id = $('#cms_id').val().trim();
    var page_name = $('#page_name').val();
    var page_slug = $('#page_slug').val().trim();
    var meta_title = $('#meta_title').val().trim();
    var meta_description = $('#meta_description').val().trim();
    var meta_keywords = $('#meta_keywords').val().trim();
    var short_description = $('#short_description').val().trim();
    var status = $('.status:checked').val().trim();


    if (page_name === "") {
        toastr.error("Enter Page Name");
        return false;
    } else if (page_slug === "") {
        toastr.error("Enter Page Slug");
        return false;
    } else if (meta_title === "") {
        toastr.error("Enter Meta Title");
        return false;
    } else if (meta_description === "") {
        toastr.error("Enter Meta Description");
        return false;
    } else if (meta_keywords === "") {
        toastr.error("Enter Meta Keywords");
        return false;
    } else if (short_description === "") {
        toastr.error("Enter Short Description");
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
                    url: '{{ url(ADMINPATH.'save-cms') }}', // Replace this with the actual backend endpoint URL
                    type: 'POST',
                    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
                    data: {
                        'id': cms_id,
                        'page_name': page_name,
                        'page_slug': page_slug,
                        'meta_title': meta_title,
                        'meta_description': meta_description,
                        'meta_keywords': meta_keywords,
                        'short_description': short_description,
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