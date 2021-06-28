@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <table class="table table-bordered dataTable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                       <tbody>
                           <tr>
                               <td>{{Auth::guard('admin')->user()->name}}</td>
                               <td>{{Auth::guard('admin')->user()->email}}</td>
                               <td>
                                   <a href="{{route('admin.logout')}}"  onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Logout</a>
                                   <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                               </td>
                           </tr>
                       </tbody>
                              
                    </table>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection