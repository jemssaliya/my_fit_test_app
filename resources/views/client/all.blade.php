@extends('oxygen::layouts.master-frontend')
@section ('pageTitle','My Clients')
@section('contents')
    <div class="container container mt-5 py-5">
        <div class="row" style="margin: 0px!important; margin-bottom: 30px!important">
            <div class="col-6">
                <div class="row">
                    <span class="my-clients">My Clients</span>
                </div>
            </div>
            <div class="col-6">
                <a href="/add-client" class="float-right">
                    <button class="pull-right btn-add-new-client">Add New Client</button>
                </a>
            </div>
        </div>
        <div class="tableFixHead">
            <table class="table table-seperated ">
                <thead style="display: table-header-group!important;">
                <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Date of Birth</th>
                    <th>Number Of Tests</th>
                    <th style="width: 190px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td class="client-table-text">
                            {{ $clients->firstItem() +$loop->index }}
                        </td>
                        <td class="client-table-text">{{$client->name}}</td>
                        <td class="client-inverse">{{$client->gender}}</td>
                        <td class="client-age">{{$client->age}}</td>
                        <td class="client-inverse">{{ \Carbon\Carbon::parse($client->dob)->format('j\\/M\\/Y') }}</td>
                        <td class="client-table-text" style="color: #55A2DC;">{{$client->tests}}</td>
                        <td style="display: inline-flex; width: 100%;">
                            <a href="/clients/edit/{{$client->id}}">
                                <button class="btn-edit">Edit</button>
                            </a>
                            <form action="{{url('/clients',[$client->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn-delete">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-12 mt-2">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        @import url("https://fonts.googleapis.com/css?family=Montserrat:400,700");

        .client-table-text {
            /* height: 19px;	 */
            color: #1B2031;
            font-family: Montserrat !important;
            font-size: 16px;
            letter-spacing: 0.19px;
            line-height: 19px;
        }

        .btn-add-new-client {
            height: 33px;
            width: 140px;
            border: 1px solid #36A036;
            border-radius: 3px;
            background-color: #5ABF5A;
            color: #FFFFFF;
            font-family: Montserrat !important;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 0.14px;
            line-height: 15px;
            text-align: center;
        }

        .my-clients {
            height: 22px;
            /* width: 99px;	 */
            color: #000;
            font-family: Montserrat !important;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.22px;
            line-height: 22px;
        }

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

        .client-age {
            color: #989AA1;
            font-family: Montserrat !important;
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 0.18px;
            line-height: 19px;
        }

        .client-inverse {
            color: #989AA1;
            font-family: Montserrat !important;
            font-size: 15px;
            letter-spacing: 0.18px;
            line-height: 19px;
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
