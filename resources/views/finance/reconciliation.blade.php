@extends('layouts.master')

@section('breadcrumb')
<ol class="breadcrumb hide-phone p-0 m-0">
    <li class="active">
    	<a href="{{ url('/dashboard') }}"> Dashboard</a>/
        <a href="{{ url('/finance') }}"> Finance</a>
    </li>
</ol>
@stop
@section('page_title') Finance @stop
@section('content')
 
<div class="col-md-2">
    @include('finance.layout.nav')
</div>
<div class="col-md-10">
    <div class="card-box">
        <div class="row">
            <div class="col-md-6">
                <h5>BANK</h5>
                <legend></legend>
                @foreach($transactions as $transaction)
                    @if($transaction->type=='BANK')
                    <div class="row">
                        <div class="col-sm-3">
                            {{$transaction->receipt_no}}
                        </div>
                        <div class="col-sm-3">
                            {{$transaction->account}}
                        </div>
                        <div class="col-sm-3">
                            {{$transaction->amount}}
                        </div>
                        <div class="col-sm-3">
                            {{$transaction->reason}}
                        </div>
                    </div>
                    <legend></legend>
                    @endif
                @endforeach
            </div>
            <div class="col-md-6">
                <h5>VOTEHEAD</h5>
                <legend></legend>
                @foreach($transactions as $transaction)
                    @if($transaction->type=='VOTEHEAD')
                    <div class="row">
                        <div class="col-sm-3">
                            {{$transaction->receipt_no}}
                        </div>
                        <div class="col-sm-3">
                            {{$transaction->account}}
                        </div>
                        <div class="col-sm-3">
                            {{$transaction->amount}}
                        </div>
                        <div class="col-sm-3">
                            {{$transaction->reason}}
                        </div>
                    </div>
                    <legend></legend>
                    @endif
                @endforeach
            </div>
        </div>

        {{ $transactions->render() }}
                            
                            
    </div>
</div>                      

@stop