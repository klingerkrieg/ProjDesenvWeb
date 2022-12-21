@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>

                <div class="card-body">

                    @if ($data->id == "")
                        <form id="main" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">

                    @else
                        <form id="main" method="POST" action="{{ route('category.update',$data) }}" enctype="multipart/form-data">
                        @method('PUT')
                    @endif

                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $data->name) }}"  autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="post_id" class="col-md-4 col-form-label text-md-end">
                                {{ __('Posts') }}</label>

                            <div class="col-md-6">
                            <select class="form-select @error('post_id') is-invalid @enderror"
                                    id="post_id"
                                    name="post_id" >
                                    <option value=''>{{__("Select one option")}}</option>
                                    {{--<option value='50'>Opção invalida</option>--}}
                                @foreach($postsList as $post)

                                    <option value='{{$post->id}}'
                                        @if (old('post_id',$data->post_id) == $post->id)
                                            selected
                                        @endif
                                        >{{$post->subject}}</option>
                                @endforeach
                            </select>
                            @error('post_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>



                        @if($data->exists)
                            <ol>
                            @foreach ($posts as $post)
                            <li>
                                <a href='{{route('post.edit',$post)}}'>{{ $post->subject }}</a>
                                <a href="{{route('category.desvincular',$post->category_posts_id)}}">Desvincular</a>
                            </li>
                            @endforeach
                            </ol>
                        {{-- comente a linha a seguir, se nao tiver usado paginação --}}
                        {{ $posts->links() }}
                        @endif




                    </form>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" form="main">
                                    {{ __('Save') }}
                                </button>

                                {{--<a class="btn btn-secondary" href='{{route("category.create")}}'>
                                    {{ __('New User') }}
                                </a>--}}


                                @if ($data->id != "")
                                <form name='delete' action="{{route('category.destroy',$data)}}"
                                    method="category"
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
