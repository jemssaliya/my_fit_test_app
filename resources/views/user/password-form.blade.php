<?php
/*
|--------------------------------------------------------------------------
| IMPORTANT: READ THIS
|-------------------------------------------------------------------------
|
| This form is used by users and admins to edit user passwords.
| Any change made here will alter how the form appear for both types.
|
*/
?>
<div class="card">
    <div class="card-body">

        <form class="form-horizontal" role="form" method="POST" action="/account/password/edit">
            {{ method_field('put') }}
            @csrf

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="password" class="form-control password-inputs" id="current_password"
                           name="current_password" placeholder="Current password" required autofocus>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="password" class="form-control password-inputs" id="password" name="password"
                           placeholder="New password" required autofocus>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="password" class="form-control password-inputs" id="password_confirmation"
                           name="password_confirmation" placeholder="Confirm new password" required autofocus>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-12" style="text-align: center;">
                    <button type="submit" class="btn-save">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
