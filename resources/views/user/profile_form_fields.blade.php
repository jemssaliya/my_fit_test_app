<div class="form-group row">
    <div class="col-md-6">
        <input id="name" type="text"
               class="register-form-inputs form-control{{ $errors->has('name') ? ' is-invalid' : '' }}  profile-name"
               value="{{$user->first_name}}" name="name" placeholder="First Name" required autofocus>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-6">
        <input id="last_name" type="text"
               class="register-form-inputs form-control profile-name
                      {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
               value="{{$user->last_name}}" name="last_name" placeholder="Last Name" required autofocus>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <input id="phone" type="phone"
               class="register-form-inputs form-control{{ $errors->has('phone') ? ' is-invalid' : '' }} profile-inputs"
               value="{{$user->phone}}" name="phone" placeholder="Phone Number">

    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <select class="register-form-inputs form-control select2"
                name="timezone" id="timezone">
            @foreach(timezone_identifiers_list() as $time_zone)
                <option value="{{$time_zone}}"
                    {{   ($time_zone == $user->timezone) ? 'selected'
                        : (!$user->timezone && $time_zone =='Australia/Melbourne' ? 'selected' : '')
                     }}
                >
                    {{$time_zone}}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <input id="email" type="email"
               class="register-form-inputs form-control{{ $errors->has('email') ? ' is-invalid' : '' }} profile-inputs"
               value="{{$user->email}}" name="email" placeholder="Email" required>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

{{--User Logo--}}
<div class="form-group row">
    <div class="col-md-6">
        <div class="thumbnail" onclick="document.getElementById('logo').click()">
            <img
                id="logo_image_thumb" alt="User Logo" class="img-responsive rounded cursor-pointer d-block mb-5"
                src="{{$user->logo_url?: asset('images/no-image-placeholder.png')}}"
                title="To insert your logo, click here"
            >
            <div class="caption cursor-pointer">
                <p class="mb-0 text-white text-center"><i class="fas fa-cloud-upload-alt"></i>
                    To insert your logo, <br/> click here
                </p>
            </div>
        </div>
        <button id="remove-image" class="close {{!$user->logo_url?'d-none':''}}"
                data-remove-status="{{$user->logo_url? 'false':'true'}}" data-toggle="tooltip"
                title="Remove the image" type="button">
            <span>&times;</span>
        </button>
    </div>
    <div class="col-12">
        <input id="logo" accept="image/*"
               class="register-form-inputs form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}
                   profile-inputs d-none custom-file-input" name="logo" placeholder="Logo" type="file">

        <small class="help-block"
               role="alert">Supported Images - JPEG, JPG, PNG, GIF (Image Dimension 200 x 100)</small>
        @if ($errors->has('logo'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('logo') }}</strong>
            </span>
        @endif
    </div>
</div>
