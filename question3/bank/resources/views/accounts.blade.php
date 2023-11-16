@extends('layout')
@section('title', 'Accounts')
@section('content')
    <div class="container">
        <h1>Accounts</h1>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Account</th>
                <th scope="col">Balances</th>
                <th scope="col">More Info</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>{{auth()->user()->id}}</td>
                <td>{{auth()->user()->account}}</td>
                <td>{{auth()->user()->balance}}</td>

                </tr>
            </tbody>
        </table>
    </div>
@endsection