@extends('oxygen::layouts.master-frontend')

@section ('pageTitle','My Clients')

@section('contents')
    <div class="container" style="margin-top:100px;">
        <div class="row justify-content-center" style="display: flex;">
            <div class="col-md-10 col-lg-8 col-xl-6" style="margin-bottom: 100px;">
                <div class="card sign-up-card profile-details-card" style="background:#FAFAFB;">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <h3 class="mb-4">Manage your profile details below</h3>
                        <form method="POST" action="/account/profile" enctype="multipart/form-data">
                            {{ method_field('put') }}
                            @csrf

                            @include('user.profile_form_fields')

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <a href="/user/password/edit" class="btn btn-outline-success btn-block mb-2">
                                        <i class="fas fa-key"></i> {{ __('Change Password') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fas fa-save"></i> {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="/bower_components/font-awesome/web-fonts-with-css/css/fontawesome-all.min.css"/>
    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css"/>

    <style scoped>
        .table-seperated {
            border-collapse: separate;
            border-spacing: 0em 0.5em;
        }

        .td {
            background: #d6ddea;
            background-color: #FAFAFB;
        }

        thead {
            display: none !important;
        }

        .table tr {
            background-color: #FAFAFB;
        }

        .table th {
            background-color: #FAFAFB;
        }

        .btn-edit {
            height: 33px;
            width: 78px;
            border: 1px solid #2784C9;
            border-radius: 3px;
            background-color: #55A2DC;
            margin-left: 5px;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 0.14px;
            line-height: 15px;
            text-align: center;
        }

        .btn-delete {
            height: 33px;
            width: 78px;
            border: 1px solid #C92C36;
            border-radius: 3px;
            background-color: #EE5C65;
            margin-left: 5px;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 0.14px;
            line-height: 15px;
            text-align: center;
        }

        .profile-details-card {
            background: #FAFAFB;
            box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.1);
            padding: 3em;
        }

        .profile-name {
            height: 55px;
            /* width: 215px;	 */
            border: 1px solid #989AA1;
            border-radius: 6px;
            background-color: #EEF1F9;
        }

        .profile-inputs {
            height: 55px;
            /* width: 450px;	 */
            border: 1px solid #989AA1;
            border-radius: 6px;
            background-color: #EEF1F9;
        }

        .btn-change-password {
            height: 53px;
            width: 215px;
            border: 1px solid #5ABF5A;
            border-radius: 4px;
            background-color: transparent;
            color: #0FD50F;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 0.22px;
            text-align: center;
        }

        .btn-save {
            height: 53px;
            width: 215px;
            border-radius: 4px;
            background-color: #989AA1;
            color: #FFFFFF;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 0.22px;
            text-align: center;
        }

        h3 {
            color: #1B2031;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.24px;
            line-height: 24px;
        }

        .tableFixHead {
            overflow-y: auto;
            height: 70vh;
        }

        .tableFixHead th {
            position: sticky;
            top: 0;
        }

        .select2-container .select2-selection--single {
            height: 55px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 55px;

        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #989AA1;
            background-color: #eef1f9;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 55px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #1976D2;
        }

        .thumbnail {
            position: relative;
        }

        #logo_image_thumb {
            width: 200px;
            height: 130px;
            border-bottom-left-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .caption {
            width: 200px;
            position: absolute;
            bottom: -2.5rem;
            left: 0;
            padding: 0.25rem;
            background: #607d8b7d;
            color: #fff;
            text-shadow: 0 0 3px #000000;
            font-weight: 500;
            line-height: 1rem;
            cursor: pointer;
            opacity: 0.6;
            border-bottom-left-radius: .25rem !important;
            border-bottom-right-radius: .25rem !important;
        }

        .custom-control-label, .cursor-pointer {
            cursor: pointer;
        }

        .close {
            position: absolute;
            background: #E91E63 !important;
            border-radius: 50%;
            padding-right: 0.25rem !important;
            padding-left: 0.25rem !important;
            top: -10px;
            right: -10px;
            border: 2px solid #000000 !important;
            color: #000000;
            cursor: pointer;
            z-index: 9999;
        }
    </style>
@endsection

@section('scripts')
    <script src="/bower_components/select2/dist/js/select2.full.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('.select2').select2();
        });

        //Logo Image Handler
        $(function () {
            $(".custom-file-input").on("change", function () {
                const fileName = $(this).val().split("\\").pop();

                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            $("#logo").change(function () {
                readURL(this);

                if (this.files.length) {
                    $('#remove-image').removeClass('d-none').addClass('d-block');
                }
            });
        });


        /**
         * Handle Image Thumbnail generate
         *
         * @returns void
         */
        function readURL(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    $('#logo_image_thumb').attr('src', e.target.result);
                }

                return reader.readAsDataURL(input.files[0]);
            }
        }

        /**
         * Handle Remove Thumbnail Image
         *
         * @returns {jQuery}
         */
        $('#remove-image').click(function () {
            if ($(this).data('remove-status') === false) {
                const permission = confirm('Are you sure want to remove the image?');

                if (permission) {
                    return $.post('/user/profile', {'_method': 'delete', '_token': `{{csrf_token()}}`})
                        .done(data => {
                            removeThumbImage().data('remove-status', true);

                            return alert(data.message);
                        }).fail(err => {
                            alert('Something went wrong. Please try again later.');
                        });
                }

                return false;
            }

            return removeThumbImage();
        });

        /**
         * Handle Remove Button visibility
         *
         * @returns {jQuery}
         */
        function removeThumbImage() {
            $("#logo").val('');

            //Set Default Image for placeholder
            $('#logo_image_thumb').attr('src', '/images/no-image-placeholder.png');

            return $('#remove-image')
                .removeClass('d-block')
                .addClass('d-none');
        }
    </script>
@endsection


