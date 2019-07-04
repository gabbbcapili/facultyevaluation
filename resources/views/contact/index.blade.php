@extends('layouts.base')
@section('title', 'Contacts')

@section('content')

    <section class="content-header">
      <h1>
        Contacts
        <small>manage your contacts</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Contacts Table</h3>
              <a href="#" class="btn btn-sm btn-primary modal_button" data-href="{{ action('ContactController@getCSV') }} "><i class="fa fa-plus"></i> Upload CSV</a>
              <div class="box-tools">
                <div class="btn-group">
                <a href="#" class="btn btn-block btn-primary modal_button" data-href="{{ action('ContactController@create') }} "><i class="fa fa-plus"></i> Add Contact</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped datatable">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($contacts as $contact)
                  <tr>
                    <td> {{ $contact->id }} </td>
                    <td> {{ $contact->name }} </td>
                    <td> {{ $contact->phone_no }} </td>
                    <td>
                      <a href="#" class="btn modal_button" data-href="{{ action('ContactController@edit', $contact->id) }}"><i class="fa fa-edit"></i> </a>
                      <a href="#" data-href="{{ action('ContactController@delete', $contact->id) }}" class="btn confirmation" data-title="Are you sure to delete this contact?" data-text="If yes, you will not be able undo this action!"><i class="fa fa-trash"></i> </a>
                    </td>
                  </tr>
                  @endforeach
                </table>
              </div>
              <!-- table-responsive -->
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


@section('javascript')



@endsection
