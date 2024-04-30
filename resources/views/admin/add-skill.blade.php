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
          <a href="{{ url(ADMINPATH.'skill-list') }}" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          View Skills
          </a>
        </div>
        <div class="card-header">
          <form>
            <input type="hidden" id='skill_id' value="{{$id}}">
            <div class="row mt-2">
              
              <div class="col-sm-3 mb-2">
                <label for="skill_name">Skill Name <span class="text-danger">*</span></label>
                <input type="text" name="skill_name" id="skill_name" required placeholder="Enter Skill Name" class="form-control" value="{{$skill_name}}"/>
              </div>
              <div class="col-sm-3 mb-2">
                <label for="percentage">Percentage <span class="text-danger">*</span></label>
                <input type="text" name="percentage" id="percentage" required placeholder="Enter Percentage" class="form-control notzero numbersWithZeroOnlyInput" maxlength="2" value="{{$percentage}}"/>
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
    var skill_id = $('#skill_id').val().trim();
    var skill_name = $('#skill_name').val();
    var percentage = $('#percentage').val().trim();
    
    var status = $('.status:checked').val().trim();


    if (skill_name === "") {
        toastr.error("Enter Skill Name");
        return false;
    } else if (percentage === "") {
        toastr.error("Enter Percentage");
        return false;
    }  else {
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
                    url: '{{ url(ADMINPATH.'save-skill') }}', // Replace this with the actual backend endpoint URL
                    type: 'POST',
                    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
                    data: {
                        'id': skill_id,
                        'skill_name': skill_name,
                        'percentage': percentage,
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