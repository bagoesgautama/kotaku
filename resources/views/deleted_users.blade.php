@extends('layouts/default') {{-- Page title --}} @section('title') Deleted Users @stop {{-- local styles --}} @section('header_styles') @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Deleted Users</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Pages</li>
        <li class="active">
            Deleted Users
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-user" data-size="18" data-c="#ffffff" data-hc="#ffffff"></i> Deleted Users
                                List
                            </h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr class="filters">
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User E-mail</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Adele</td>
                                <td>Becker</td>
                                <td>otis98@hotmail.com</td>
                                <td>2 weeks ago</td>
                                <td>
                                    <a href="{{url('users')}}"><i class="fa ti-user" data-c="#6699cc" data-hc="#6699cc" data-size="18" title="Restore"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Adan</td>
                                <td>Schmeler</td>
                                <td>arnoldo19@gmail.com</td>
                                <td>2 weeks ago</td>
                                <td>
                                    <a href="{{url('users')}}"><i class="fa ti-user" data-c="#6699cc" data-hc="#6699cc" data-size="18" title="Restore"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Abbey</td>
                                <td>Conn</td>
                                <td>lehner.rhianna@christiansenwill.info</td>
                                <td>2 weeks ago</td>
                                <td>
                                    <a href="{{url('users')}}"><i class="fa ti-user" data-c="#6699cc" data-hc="#6699cc" data-size="18" title="Restore"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts') @stop
