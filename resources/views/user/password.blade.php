@extends('oxygen::layouts.master-frontend')
@section ('pageTitle','My Clients')
@section('contents')
    <div class="container" style="margin-top:100px;">
        <div class="row justify-content-center" style="display: flex;">
            <div class="col-md-7" style="margin-bottom: 100px;  margin: auto;">
                <div class="card sign-up-card profile-details-card" style="background:#FAFAFB;">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if (Session::has('alert'))

                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <span>{{ Session::get('alert') }}</span>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <strong>Whoops!</strong> There were some problems.<br>
                            @if (is_array(Session::get('error')))
                                <span>{{ implode(' ', Session::get('error')) }}</span>
                            @else
                                <span>{{ Session::get('error') }}</span>
                            @endif
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('status'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <span>{{ Session::get('status') }}</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <p class="manage-your-profile">Change your password below</p>
                        @include('user.password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('styles')
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
            /* height: 470px;	 */
            /* width: 688px;	 */
            background-color: #FAFAFB;
            box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.1);
            background: #FAFAFB;
            padding-top: 30px;
            padding-bottom: 40px;
            padding-left: 100px;
            padding-right: 100px;
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
            background-color: #5ABF5A;
            color: #FFFFFF;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 0.22px;
            text-align: center;
        }

        .manage-your-profile {
            color: #1B2031;
            /* font-family: Montserrat;	 */
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.24px;
            line-height: 24px;
        }

        .password-inputs {
            height: 55px;
            /* width: 450px; */
            border: 1px solid #989AA1;
            border-radius: 6px;
            background-color: #EEF1F9;
        }

        .tableFixHead {
            overflow-y: auto;
            height: 70vh;
        }

        .tableFixHead th {
            position: sticky;
            top: 0;
        }
    </style>
@endsection
