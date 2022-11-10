@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">

                    @if ($data->id == "")
                        <form id="main" method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">

                    @else
                        <form id="main" method="POST" action="{{ route('post.update',$data) }}" enctype="multipart/form-data">
                        @method('PUT')
                    @endif

                        @csrf

                        <div class="row mb-3">
                            <label for="subject" class="col-md-4 col-form-label text-md-end">{{ __('Subject') }}</label>

                            <div class="col-md-6">
                                <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror"
                                        name="subject" value="{{ old('subject', $data->subject) }}"  autofocus>

                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="publish_date" class="col-md-4 col-form-label text-md-end">{{ __('Publish date') }}</label>

                            <div class="col-md-6">
                                <input id="publish_date" type="date" class="form-control @error('publish_date') is-invalid @enderror"
                                        name="publish_date" value="{{ old('publish_date',$data->publish_date == "" ? "" : $data->publish_date->format('Y-m-d')) }}" >

                                @error('publish_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" value="{{ old('image') }}" >

                                @if ($data->id)
                                    <img src="{{asset($data->image)}}" class="rounded" width='200'/>
                                @endif


                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="slug" class="col-md-4 col-form-label text-md-end">{{ __('Slug') }}</label>

                            <div class="col-md-6">
                                <input id="slug" type="text" class="form-control "
                                       readonly disabled value="{{ old('slug',$data->slug) }}"  >
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="text" class="col-md-4 col-form-label text-md-end">{{ __('Text') }}</label>

                            <div class="col-md-6">

                                <textarea id="text" name="text" class="form-control @error('text') is-invalid @enderror">{{ old('text', $data->text) }}</textarea>

                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" form="main">
                                    {{ __('Save') }}
                                </button>

                                <a class="btn btn-secondary" href='{{route("post.create")}}'>
                                    {{ __('New Post') }}
                                </a>


                                @if ($data->id != "")
                                <form name='delete' action="{{route('post.destroy',$data)}}"
                                    method="post"
                                    style='display: inline-block;'>
                                    @csrf
                                    @method("DELETE")
                                    <button type="button" onclick="confirmDeleteModal(this)" class="btn btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
