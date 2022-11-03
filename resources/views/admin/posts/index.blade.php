@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">

                    <form method="GET" action="{{ route('post.list') }}">
                        @csrf



                        <div class="row mb-3">
                            <label for="subject" class="col-md-4 col-form-label text-md-end">{{ __('Subject') }}</label>

                            <div class="col-md-6">
                                <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror"
                                        name="subject" value="{{ old('subject') }}" required autofocus>

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
                                        name="publish_date" value="{{ old('publish_date') }}" required>

                                @error('publish_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="text" class="col-md-4 col-form-label text-md-end">{{ __('Text') }}</label>

                            <div class="col-md-6">

                                <input id="text" name="text" class="form-control @error('text') is-invalid @enderror"
                                        type="text"
                                        value="{{ old('text') }}">

                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>


                                <a class="btn btn-link" href="{{ route('post.create') }}">
                                    {{ __('Cadastrar novo') }}
                                </a>
                            </div>
                        </div>
                    </form>


                    <ul>

                        @foreach ($listaPaginada as $item)
                        <li>

                            <a href="{{route("post.edit",$item)}}" class="btn btn-primary">
                                {{ __('Edit') }}
                            </a>


                            {{$item->subject}} | {{$item->slug}} | {{$item->text}} |

                            <form action="{{route('post.destroy',$item)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    {{ $listaPaginada->links() }}




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
