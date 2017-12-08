@extends('layouts.admin')




@section('content')



    <h1>Media</h1>

    <form action="delete/media" method="post" class="form-inline">

        {{csrf_field()}}
        {{method_field('delete')}}
        <div class="form-group">
            <select name="checkBoxArray" id="" class="form-control">

                <option value="delete">Delete</option>
                
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn-primary">
        </div>



    @if($photos)

        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="options"></th>
                <th>Id</th>
                <th>Name</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>

            @foreach($photos as$photo)
                <tr>
                    <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
                    <td>{{$photo->id}}</td>
                    <td><img height="50" src="{{$photo->file}}" alt="no image"></td>
                    <td>{{$photo->created_at ? $photo->created_at : "no date" }}</td>
                    <td>

                             {!! Form::open(['method'=>'DELETE','action'=>['AdminMediasController@destroy',$photo->id]]) !!}

                                        <div class="form-group">
                                             {!! Form::submit('Delete Media',['class'=>'btn btn-danger ']) !!}
                                         </div>
                                   {!! Form::close() !!}


                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    @endif

    </form>



@stop

@section('scripts')

<script>
    $(document).ready(function () {

    $('#options').click(function () {

        if(this.checked){

            $('.checkBoxes').each(function () {

                this.checked = true;
                
            })

        }else {

            $('.checkBoxes').each(function () {

                this.checked = false;

            })
        }

        console.log('it works');

    });

    });
</script>

@stop