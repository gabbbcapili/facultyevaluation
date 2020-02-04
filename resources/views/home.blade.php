@inject('request', 'Illuminate\Http\Request')
@extends('layouts.base')
@section('title', 'Home')

@section('content')
   <!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Home
      </h1>
    </section>
    <!-- Main content -->
    <section class="content no-print">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Home</h3>
            </div> <!-- /.box-header -->
             <div class="box-body">
              @if($request->user()->isStudent())
                @if($evaluations->count() == 0)
                <h3>No evaluation started yet.</h3> 
                @else
                <div class="row">
                @foreach($evaluations as $evaluation)
                  
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3 style="font-size:24px; word-break: break-word !important; white-space: normal !important; ">
                            {{ $evaluation->faculty->getFullName() }}
                            <sup style="font-size: 20px"></sup></h3>
                          <p>{{ $evaluation->department->name }}</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ action('EvaluationListController@create', ['e_id' => $evaluation->id]) }}" class="small-box-footer">Evaluate now! <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                @endforeach
                </div>
                @endif
              @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
