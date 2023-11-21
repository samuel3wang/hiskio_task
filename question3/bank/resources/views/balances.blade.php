@extends('layout')
@section('title', 'Balances')
@section('content')
    <div class="ms-auto me-auto mt-auto" style="width: 500px">
        <h1>Balances</h1>
    </div>
    <div class="ms-auto me-auto mt-auto" style="width: 500px">
        @if(session()->has('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
    </div>
    <div class="ms-auto me-auto mt-auto" style="width: 500px">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Method</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Balances</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($balances as $balance)
                    <tr>
                        <td>{{ $balance->method }}</td>
                        <td>{{ $balance->amount }}</td>
                        <td>{{ $balance->balance }}</td>
                        <td>{{ $balance->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('operate', ['id' => $account->id]) }}" class="btn btn-primary">Operate</a>
        <a href="{{ route('accounts') }}" class="btn btn-primary">Overview</a>
    </div>
@endsection