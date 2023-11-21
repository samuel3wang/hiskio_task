@extends('layout')
@section('title', 'Accounts')
@section('content')
    <div class="ms-auto me-auto mt-auto" style="width: 800px">
        <h1>Accounts</h1>
    </div>
    <div class="ms-auto me-auto mt-auto" style="width: 800px">
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
                @foreach($accounts as $account)
                    <tr>
                        <td>{{ $account->id }}</td>
                        <td>{{ $account->account }}</td>
                        @if(isset($total[$account->id]))
                            <td>{{ $total[$account->id]->balance }}</td>
                        @else
                            <td>No balance records for this account</td>
                        @endif
                        <td><a href="{{ route('balances', ['id' => $account->id]) }}">Details</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- <a href="{{ route('operate') }}" class="btn btn-primary">Operate</a> -->
    </div>
@endsection