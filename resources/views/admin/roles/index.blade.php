@extends('admin.layouts.app')

@section('title')
Roles List
@endsection


@section('content')


<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">


            <div class="col-md-12">

                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Roles List</h3>
                        @can('create role')

                        <a href="{{ route('admin.roles.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"> Add Role</i></a>

                        @endcan

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                @can('view role')
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                        <span class="badge bg-primary me-1">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>

                                    <td class="text-center">
                                        @can('edit role')
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete role')
                                        <form id="delete-form-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <a href="#" class="btn btn-sm btn-danger delete-btn" data-id="{{ $role->id }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                                @endcan
                                @endforeach


                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>



        </div>

    </div>
</section>



@endsection