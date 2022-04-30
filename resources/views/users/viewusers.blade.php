@extends('layouts.app')

@php

    //phpinfo();

@endphp

@section('page_css')
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/multi-form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/star-rating.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/krajee-fa/theme.css') }}" media="all" type="text/css"/>
@endsection

@section('content')

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  @if (session()->has('success_message'))
    <div class="alert alert-success">
           {{ session('success_message') }}

    </div>
@endif

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">VIEW USER</h3>
        </div>
        <div class="section-body" id="app">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-md-12">
               
                                        <div class="clearfix"></div>
                                        <br>
                                        <h3>View Users</h3>
                                        <form class="border p-4" action="" method="POST">
                                            @csrf
                                            <div class="mb-5" id="usertableapp">
                                               <table id="usertable" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Email</th>
                                                    <th>Verified</th>
                                                    <th>NIP</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Premium</th>
                                                    <th>Premium Access</th>
                                                    <th>Last Login</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($users as $user)
                                            
                                                    <tr>
                                                      <td>{{ $user->email }}</td>
                                                      <td>{{ $user->verified }}</td>
                                                      <td>{{ $user->nip }}</td>
                                                      <td>{{ $user->name }}</td>
                                                      <td>{{ $user->address }}</td>
                                                      @if ($user->premium == 0)
                                                      <td><a class="btn btn-secondary" href="{{ route('premiumuser',$user->id) }}">{{ $user->premium }}</a></td>
                                                      @else 
                                                      <td><a class="btn btn-primary" href="{{ route('premiumuser',$user->id) }}">{{ $user->premium }}</a></td>
                                                      @endif
                                                      <td>{{ $user->premium_access_until }}</td>
                                                      <td>{{ $user->last_login }}</td>
                                                      <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edituser"
                                                           data-id="{{ $user->id }}"
                            data-email="{{ $user->email }}"
                            data-verified="{{ $user->verified }}"
                            data-premium="{{ $user->premium }}"
                            data-name="{{ $user->name }}"
                                                        >  
               <i class=" fas fa-plus"></i></td>  

                                                    </tr>
                                                
                                                @endforeach
                                                  </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th> </th>
                                                            <th> </th>
                                                            <th> </th>
                                                            <th> </th>
                                                            <th> </th>
                                                            <th> </th>
                                                            <th> </th>
                                                            <th> </th>
                                                            
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                         
                                        </form>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="edituser" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form class="border p-4" action="{{ route('edituser',$user->id) }}" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         @csrf
           <div class="form-group">
            <label for="id">Id</label>
            <input type="id" class="form-control" id="id" name="id" readonly="">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="input" class="form-control" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="verified">Verified</label>
            <input type="input" class="form-control" id="verified" name="verified">
        </div>
        <div class="form-group">
            <label for="premium">Premium</label>
            <input type="input" class="form-control" id="premium" name="premium">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
 
  <!-- End To pending MODAL -->

@endsection

@section('page_js')
    <script src="{{ asset('assets/js/multi-form.js') }}"></script>
    <script src="{{ asset('assets/js/star-rating.min.js') }}"></script>
    <script src="{{ asset('themes/krajee-fa/theme.js') }}" type="text/javascript"></script>

    <script>
        $("#opinion-form").multiStepForm({}).navigateTo(0);
    </script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://unpkg.com/vue@next"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js" integrity="sha512-lTLt+W7MrmDfKam+r3D2LURu0F47a3QaW5nF0c6Hl0JDZ57ruei+ovbg7BrZ+0bjVJ5YgzsAWE+RreERbpPE1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#usertable').DataTable();
    } );
    </script>

    <script>
      $('#edituser').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var modal = $(this)
     
        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #email').val(button.data('email'))   
        modal.find('.modal-body #verified').val(button.data('verified')) 
        modal.find('.modal-body #premium').val(button.data('premium')) 
        modal.find('.modal-body #name').val(button.data('name')) 
      
    })

    </script>

  

@endsection

