@extends ('layouts.admin')


@section('content')

    <h1>posts</h1>

    <table class="table">
       <thead>
         <tr>
             <th>Post_id</th>
            <th>title</th>
            <th>body</th>
             <th>Post page</th>
             <th>Comments</th>
            <th>categoy_id</th>
             <th>owner</th>
             <th>photo_id</th>
             <th>created_at</th>
             <th>updated_at</th>
        </tr>
       </thead>
       <tbody>
       @if($posts)
       @foreach($posts as $post)
         <tr>
            <td>{{$post->id}}</td>
            <td><a href="{{route('admin.posts.edit',$post->id)}}">{{$post->title}}</a></td>
            <td>{{str_limit($post->body, 7)}}</td>
             <td><a href="{{route('home.post',$post->slug)}}">view post</a></td>
             <td><a href="{{route('admin.comments.show',$post->id)}}">view comments</a></td>
            <td>{{$post->category ? $post->category->name : "Uncategorized"}}</td>
            <td>{{$post->user->name}}</td>
            <td><img height="50" src="{{$post->photo ? $post->photo ->file :'http://via.placeholder.com/400x400'}}" alt=""></td>
            <td>{{$post->created_at->diffForHumans()}}</td>
             <td>{{$post->updated_at->diffForHumans()}}</td>

         </tr>
       @endforeach
       @endif
      </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">

            {{$posts->render()}}

        </div>
    </div>


@stop



















