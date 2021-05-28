
@extends('admin.admin_master')
@section('admin')
    <div>
    <h4>Home sliders</h4>

    <a href="" style="float: right"><button class="btn btn-info" >Add Sliders</button></a>
    </div>
    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        <div class="card-header">All Sliders</div>


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Sl No</th>
                                <th scope="col">Title</th>
                                <th scope="col">description</th>
                                <th scope="col">image</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @php($i=1)--}}
                            @foreach($sliders as $slider)
                                <tr>
                                    <th scope="row">{{$sliders->firstItem()+$loop->index}}</th>
                                    <td>{{$slider->title}}</td>
                                    <td>{{$slider->description}}</td>
                                    <td><img src="{{asset($slider->image)}}" style="height: 70px;width: 100px"></td>


                                    <td>
                                        <a href="{{url('slider/edit/'.$slider->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{url('slider/delete/'.$slider->id)}}"  onclick="return confirm('Are you sure want to delete this slider')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>


            </div>
        </div>
    </div>



    </div>
@endsection
