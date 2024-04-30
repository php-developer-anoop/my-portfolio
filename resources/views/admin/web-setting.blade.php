<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="<?= url('admin/dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">
              {{$title}}
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
          <form action="{{ url(ADMINPATH.'save-websetting') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ !empty($web['id']) ? $web['id'] : '' }}">
            <input type="hidden" name="old_profile_image" value="{{ !empty($web['profile_image']) ? $web['profile_image'] : '' }}">
            <input type="hidden" name="old_resume" value="{{ !empty($web['resume']) ? $web['resume'] : '' }}">
            <div class="row">
              <div class="col-sm-3">
                <label for="first_name" class=" col-form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control ucwords restrictedInput" placeholder="Enter First Name" required autocomplete="off" value="{{ !empty($web['first_name']) ? $web['first_name'] : '' }}">
              </div>
              <div class="col-sm-3">
                <label for="last_name" class=" col-form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control ucwords restrictedInput" placeholder="Enter Last Name" required autocomplete="off" value="{{ !empty($web['last_name']) ? $web['last_name'] : '' }}">
              </div>
              <div class="col-sm-3">
                <label for="age" class=" col-form-label">Age</label>
                <input type="text" name="age" id="age" class="form-control notzero numbersWithZeroOnlyInput" placeholder="Enter Age" required maxlength="2" autocomplete="off" value="{{ !empty($web['age']) ? $web['age'] : '' }}">
              </div>
              <div class="col-sm-3">
                <label for="experience" class=" col-form-label">Experience</label>
                <input type="text" name="experience" id="experience" class="form-control" placeholder="Enter Experience" required autocomplete="off" value="{{ !empty($web['experience']) ? $web['experience'] : '' }}">
              </div>
              <div class="col-sm-3">
                <label for="mobile_number" class=" col-form-label">Mobile Number</label>
                <input type="text" name="mobile_number" id="mobile_number" class="form-control notzero numbersWithZeroOnlyInput" placeholder="Enter Mobile Number" required maxlength="10" autocomplete="off" value="{{ !empty($web['mobile_number']) ? $web['mobile_number'] : '' }}">
              </div>
              <div class="col-sm-3">
                <label for="email" class="col-form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control emailInput" placeholder="Enter Email" required autocomplete="off" value="{{ !empty($web['email']) ? $web['email'] : '' }}">
              </div>
              <div class="col-sm-3">
                <label for="facebook_link" class="col-form-label">Facebook Link</label>
                <input type="text" name="facebook_link" id="facebook_link" class="form-control" placeholder="Enter Facebook Link" required autocomplete="off" value="{{ !empty($web['facebook_link']) ? $web['facebook_link'] : '' }}">
              </div>
              <div class="col-sm-3">
                <label for="twitter_link" class="col-form-label">Twitter Link</label>
                <input type="text" name="twitter_link" id="twitter_link" class="form-control" placeholder="Enter Twitter Link" required autocomplete="off" value="{{ !empty($web['twitter_link']) ? $web['twitter_link'] : '' }}">
              </div>
              <div class="col-sm-3">
                <label for="linkedin_link" class="col-form-label">LinkedIn Link</label>
                <input type="text" name="linkedin_link" id="linkedin_link" class="form-control" placeholder="Enter LinkedIn Link" required autocomplete="off" value="{{ !empty($web['linkedin_link']) ? $web['linkedin_link'] : '' }}">
              </div>
              <div class="col-sm-3">
                <label for="role" class="col-form-label">Role</label>
                <input type="text" name="role" id="role" class="form-control" placeholder="Enter Role" required autocomplete="off" value="{{ !empty($web['role']) ? $web['role'] : '' }}">
              </div>
              <div class="col-sm-6">
                <label for="full_address" class="col-form-label">Full Address</label>
                <input type="text" name="full_address" id="full_address" class="form-control" placeholder="Enter Full Address" required autocomplete="off" value="{{ !empty($web['address']) ? $web['address'] : '' }}">
              </div>
              <div class="col-sm-12">
                <label for="short_description" class="col-form-label">Short Description</label>
                <textarea name="short_description" id="short_description" class="form-control" placeholder="Enter Short Description" required autocomplete="off">{{ !empty($web['short_description']) ? $web['short_description'] : '' }}</textarea>
              </div>
              <div class="col-sm-4">
                <label for="profile_image" class="col-form-label">Profile Image</label>
                <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/png, image/jpg, image/jpeg">
              </div>
              @if (!empty($web['profile_image']))
              <div class="col-sm-2 mt-2">
                <img src="{{ asset('uploads/' . $web['profile_image']) }}" height="70px" width="100px" alt="Logo">
              </div>
              @endif
              <div class="col-sm-4">
                <label for="resume" class="col-form-label">Resume</label>
                <input type="file" name="resume" class="form-control" accept="application/pdf">
              </div>
              @if (!empty($web['resume']))
              <div class="col-sm-2 mt-4 ">
              <a href="{{ asset('uploads/' . $web['resume']) }}" class="btn btn-success btn-sm pt-10" target="_anoop"><i class="fa fa-eye"></i></a>
              </div>
              @endif
            </div>
            <div class="form-group row mt-2">
              <div class="col-sm-12">
                <div class="custom-btn-group">
                  <input type="submit" value="Submit" class="btn btn-success">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>