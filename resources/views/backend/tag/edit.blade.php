@extends('backend.layout')

@section('title')
    <title>{{ config('blog.title') }} | Edit Tag</title>
@stop

@section('content')
    <section id="main">

        @include('backend.partials.sidebar-navigation')

        <section id="content">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <ol class="breadcrumb">
                            <li><a href="/admin">Home</a></li>
                            <li><a href="/admin/tag">Tags</a></li>
                            <li class="active">Edit Tag</li>
                        </ol>
                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="">Refresh Tag</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        @include('shared.errors')

                        @include('shared.success')

                        <h2>
                            Edit <em>{{ $title }}</em>
                            <small>
                                @if(isset($updated_at))
                                    Last edited on {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $updated_at)->format('M d, Y') }}
                                @else
                                    Last edited on {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $created_at)->format('M d, Y') }}
                                @endif
                            </small>
                        </h2>

                    </div>
                    <div class="card-body card-padding">
                        <form role="form" method="POST" id="tagUpdate" action="/admin/tag/{{ $id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="{{ $id }}">

                            @include('backend.tag.partials.form')

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-text">
                                    <i class="zmdi zmdi-floppy"></i> Save
                                </button>&nbsp;
                                <button type="button" class="btn btn-danger btn-icon-text" data-toggle="modal" data-target="#modal-delete">
                                    <i class="zmdi zmdi-delete"></i> Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>

    @include('backend.tag.partials.delete-modal')
@stop

@section('unique-js')
    {!! JsValidator::formRequest('App\Http\Requests\TagUpdateRequest', '#tagUpdate'); !!}
@stop