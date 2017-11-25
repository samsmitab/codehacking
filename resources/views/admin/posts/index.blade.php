@extends ('layouts.admin')


@section('content')

    <h1>posts</h1>

    <table class="table">
       <thead>
         <tr>
             <th>Post_id</th>
            <th>title</th>
            <th>body</th>
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
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
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


@stop



















