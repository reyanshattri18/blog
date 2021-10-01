@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Posts</h2>
            </div>
            <div class="pull-right">
                @can('post-create')
                <a class="btn btn-success my-2" href="{{ route('posts.create') }}"> Create New Post</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    @if($posts->count() > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Publication</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($posts as $post)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->publication_date }}</td>
                <td>
                    <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('posts.show',$post->id) }}">Show</a>
                        @can('post-edit')
                        <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('post-delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    @else
        No Record Found!!
    @endif


    {!! $posts->links() !!}


@endsection