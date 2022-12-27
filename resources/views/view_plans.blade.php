@extends('layouts.master')
@section('content')

<div class="container mt-5">
    <div class="row">
        @foreach ($plans as $plan)
        <div class="col-md-4">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">{{$plan->name}}</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">${{$plan->price}}<small class="text-muted fw-light">/mo</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>10 users included</li>
                <li>2 GB of storage</li>
                <li>Email support</li>
                <li>Help center access</li>
              </ul>
              <a href="{{route('register')}}" type="button" class="w-100 btn btn-lg btn-outline-primary">Buy</a>
            </div>
          </div>
      </div>
        @endforeach
    </div>
</div>

@stop