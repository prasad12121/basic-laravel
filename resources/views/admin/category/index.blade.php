<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{--  {{ __('Dashboard') }}--}}
            {{--   HI...<b>{{ \Illuminate\Support\Facades\Auth::user()->name() }}</b>--}}
        <b>All categories</b>
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                            @if(session('success'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        <div class="card-header">All Category</div>


                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col"> Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                   {{-- @php($i=1)--}}
                    @foreach($category as $categoory)
                    <tr>
                        <th scope="row">{{$category->firstItem()+$loop->index}}</th>
                        <td>{{$categoory->category_name}}</td>
                        <td>{{$categoory->user->name}}</td>

                        <td>
                            @if($categoory->created_at == NULL)
                                <span>No date</span>
                            @else
                            {{$categoory->created_at->DiffForHumans()}}
                          @endif
                        </td>
                        <td>
                            <a href="{{url('category/edit/'.$categoory->id )}}" class="btn btn-info">Edit</a>
                            <a href="{{url('category/softdelete/'.$categoory->id )}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
                        {{$category->links()}}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">



                        <form action="{{route('store.category')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Category name</label>
                                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>

{{--Thrashed part--}}
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">



                    <div class="card-header">Thrash list</div>


                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Sl No</th>
                            <th scope="col"> Category Name</th>
                            <th scope="col">User</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- @php($i=1)--}}
                        @foreach($trashCat as $categoory)
                            <tr>
                                <th scope="row">{{$category->firstItem()+$loop->index}}</th>
                                <td>{{$categoory->category_name}}</td>
                                <td>{{$categoory->user->name}}</td>

                                <td>
                                    @if($categoory->created_at == NULL)
                                        <span>No date</span>
                                    @else
                                        {{$categoory->created_at->DiffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('category/restore/'.$categoory->id )}}" class="btn btn-info">restore</a>
                                    <a href="{{url('category/pdelete/'.$categoory->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{$trashCat->links()}}
                </div>
            </div>

            <div class="col-md-4">

            </div>
        </div>
    </div>
    </div>

<!--  end thrashed -->



    </div>
</x-app-layout>
