

<div class="row">
    <div class="col-lg-6 mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ ( isset($userDetail) ? $userDetail->name: old('name') )}}" required autocomplete="off" placeholder="Enter name">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ ( isset($userDetail) ? $userDetail->email: old('email') )}}" required autocomplete="off" placeholder="Enter email">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ ( isset($userDetail) ? $userDetail->username: old('username') )}}" required autocomplete="off" placeholder="Enter username">
    </div>

    @if(!isset($userDetail))
        <div class="col-lg-6 mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="" autocomplete="off" placeholder="Enter  password" required>
        </div>
    @endif

    <div class="col-lg-6 mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" value=" {{ ( isset($userDetail) ? ($userDetail->address): old('address') )}}" required autocomplete="off" placeholder="Enter Employee Address">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="dob" class="form-label"> Date Of Birth</label>
        <input type="date" class="form-control" id="dob" name="dob" value="{{ ( isset($userDetail) ? ($userDetail->dob): old('dob') )}}" required autocomplete="off" placeholder="">
    </div>



    <div class="col-lg-6 mb-3">
        <label for="number" class="form-label">Phone No</label>
        <input type="number" class="form-control" id="phone" name="phone" value="{{ isset($userDetail)? $userDetail->phone: old('phone') }}" required autocomplete="off" placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select" id="gender" name="gender"  required>
            <option value="" {{isset($userDetail) ? '' : 'selected'}}  disabled>Select Gender</option>
            @foreach(\App\Models\User::GENDER as $value)
                <option value="{{$value}}" {{ isset($userDetail) && ($userDetail->gender ) == $value ? 'selected': '' }}>
                    {{ucfirst($value)}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-6 mb-3">
        <label for="designation" class="form-label">Designation</label>
        <input type="text" class="form-control" id="designation" required name="designation" value="{{ ( isset($userDetail) ? $userDetail->designation: old('designation') )}}"  autocomplete="off" placeholder="Enter designation">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-select" id="role" name="role" required>
            <option value="" {{isset($userDetail) ? '': 'selected'}}  disabled>Select Role</option>
            @foreach(\App\Models\User::ROLE as $value)
                <option value="{{$value}}" {{ isset($userDetail) && ($userDetail->role ) == $value ? 'selected': '' }}>
                    {{ucfirst($value)}}
                </option>
            @endforeach
        </select>
    </div>


    <div class="col-lg-6 mb-3">
        <label for="is_active" class="form-label">User Status</label>
        <select class="form-select" id="is_active" name="is_active" required>
            <option value="" {{isset($userDetail) ? '': 'selected'}}  disabled>select status </option>
            <option value="1" {{ isset($userDetail) && ($userDetail->is_active ) == 1 ? 'selected': old('is_active') }}>Active</option>
            <option value="0" {{ isset($userDetail) && ($userDetail->is_active ) == 0 ? 'selected': old('is_active') }}>Inactive</option>
        </select>
    </div>

    <div class="col-lg-12 mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" required minlength="50" id="tinymceExample" rows="2">{{ ( isset($userDetail) ? $userDetail->description: old('description') )}}</textarea>
    </div>



    <div class="col-lg-12 mb-3">
        <label for="avatar" class="form-label">Upload Avatar</label>
        <input class="form-control" type="file" id="avatar" name="avatar" value="{{ isset($userDetail) ? $userDetail->avatar: old('avatar') }}" {{isset($userDetail) ? '': 'required'}} >
        @if(isset($userDetail) && $userDetail->avatar)
            {{--            {{dd(asset(\App\Models\User::AVATAR_UPLOAD_PATH.$userDetail->avatar))}}--}}
            <img  src="{{asset(\App\Models\User::AVATAR_UPLOAD_PATH.$userDetail->avatar)}}"
                  alt="" class=" wd-100 mt-3" style="object-fit: contain"
                  >
        @endif
    </div>


    <div class="text-center">
        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($userDetail)? 'Update':'Create'}} User</button>
    </div>
</div>



