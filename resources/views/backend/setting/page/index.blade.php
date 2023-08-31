
@extends('backend.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Page Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">All Page List Here</h3>
                          <a href="{{ route('page.create') }}" class="btn btn-info btn-sm" style="float: right"> + Add Page</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    {{-- <th>Page Position</th> --}}
                                    <th>Page Name</th>
                                    <th>Page Title</th>
                                    <th>Page Slug</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($page as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        {{-- <td>{{ $row->page_position }}</td> --}}
                                        <td>{{ $row->page_name }}</td>
                                        <td>{{ $row->page_title }}</td>
                                        <td>{{ $row->page_slug }}</td>
                                        <td>
                                            @if ($row->page_status == '1')
                                            <span class="btn btn-success">Active</span>
                                            @else
                                            <span class="btn btn-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td >
                                            @if ($row->page_status == '1')
                                                <a href="#"><i class="fa-solid fa-toggle-on fa-xl" title="Unactive"></i></a>
                                            @else
                                                <a href="#"><i class="fa-solid fa-toggle-on"></i></a>
                                                {{-- <a href="#"><i class="fa-solid fa-toggle-off fa-xl" title="Active"></i></a> --}}
                                            @endif
                                            <a href="{{ route('page.edit',$row->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('page.destroy',$row->id) }}" id="delete" class="btn btn-danger sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
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