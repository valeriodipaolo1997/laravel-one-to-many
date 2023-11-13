@extends('layouts.admin')
@section('content')
<div class="container py-4">
    @if(session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Success!</strong> {{session('message')}}
    </div>

    @endif
    <h1>Projects table</h1>
    <div class="d-flex justify-content-between my-4">
        <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">Add New project</a>
        <a class="btn btn-danger" href="{{ route('admin.trash') }}">Trash</a>
    </div>
    <div class="pt-4"> {{$projects->links('pagination::bootstrap-5')}} </div>
    <div class="table-responsive">
        <table class="table table-primary table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Created</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($projects as $project)

                <tr>
                    <td scope="row"> {{$project->id}} </td>
                    <td> {{$project->title}} </td>
                    <td>
                        <img width="100" class="img-fluid" src="{{$project->thumb}}" alt="">

                    </td>

                    <td> {{$project->description}} </td>


                    <td class="text-center">
                        <div>{{$project->created_at->format('d-m-Y')}}</div>
                        <div>{{$project->created_at->format('H:i')}}</div>
                    </td>


                    <td>

                        <div class="d-flex gap-2">
                            <a href=" {{route('admin.projects.show', $project->slug)}} " class="btn btn-outline-primary">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href=" {{route('admin.projects.edit', $project->slug)}} " class="btn btn-outline-success">
                                <i class="fa-solid fa-file-pen"></i>
                            </a>

                            <!-- Modal trigger button -->
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{$project->id}}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div class="modal fade" id="modalId-{{$project->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$project->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100" id="modalTitleId-{{$project->id}}">
                                            <i class="fa-solid fa-triangle-exclamation text-warning"></i> Warning <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                                        </h5>
                                    </div>
                                    {{-- /.modal-header --}}
                                    <div class="modal-body text-center">
                                        Are you sure to delete?
                                    </div>
                                    {{-- /.modal-body --}}
                                    <div class="modal-footer d-flex justify-content-center align-items-center gap-3">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Confirm</button>
                                        </form>
                                    </div>
                                    {{-- /.modal-footer --}}
                                </div>
                                {{-- /.modal-content --}}
                            </div>
                            {{-- /.modal-dialog --}}
                        </div>
                        {{-- /.modal --}}
                    </td>

                </tr>

                @empty
                No projects yet
                @endforelse
            </tbody>
        </table>
        <div class="pt-4"> {{$projects->links('pagination::bootstrap-5')}} </div>
    </div>

</div>


@endsection