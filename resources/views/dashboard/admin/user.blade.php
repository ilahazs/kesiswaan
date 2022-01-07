@extends('dashboard.layouts.main')
@section('heading-title', 'Admin Page')
@section('container')

   <div class="card card-shadow mb-5" style="border-radius: 25px">
      <div class="card-body" style="background-color: white">
         <div class="container rounded bg-white my-2">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th scope="col">#</th>
                     <th scope="col">Name</th>
                     <th scope="col">Username</th>
                     <th scope="col">Email</th>
                     <th scope="col">Role</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($users as $user)
                     <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
@endsection
