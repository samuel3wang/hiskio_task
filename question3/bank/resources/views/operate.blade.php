@extends('layout')
@section('title', 'Balances')
@section('content')
    <form action="{{route('operate.post')}}" method="POST" class="ms-auto me-auto mt-auto" style="width: 500px">
        @csrf
        <div class="container">
            <h1>Operate</h1>
        </div>
        <div class="container">
            <select class="form-select" name="method" aria-label="Default select example">
                <option selected>Seclect the Method (Deposit or Withdrawal)</option>
                <option value="deposit">+ Deposit</option>
                <option value="withdrawal">- Withdrawal</option>
            </select>
        </div>
        <br/>
        <div class="input-group mb-3 container">
            <span class="input-group-text">$</span>
            <input type="text" name="amount" class="form-control" aria-label="Amount (to the nearest dollar)">
        </div>
        <div class="container">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection