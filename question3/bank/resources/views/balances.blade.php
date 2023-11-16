@extends('layout')
@section('title', 'Balances')
@section('content')
    <div class="container">
        <h1>Balances</h1>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Amount</th>
                <th scope="col">Balances</th>
                <th scope="col">Time</th>
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