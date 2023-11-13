@extends('layouts.admin')

@section('content')
<div class="container">

    <h1 class="py-4">Trashed project</h1>

    @if (session('message'))
    <div class="alert alert-success" role="alert">
        <strong>Success!</strong> {{ session('message') }}
    </div>
    @endif



    <table class="table table-primary table-hover table-striped table-bordered">

        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Description</th>
                <th scope="col">Deleted</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        {{-- /thead --}}

        <tbody class="table-group-divider">
            @forelse ($trash_project as $project)

            <tr>
                <td scope="row"> {{$project->id}} </td>
                <td> {{$project->title}} </td>

                <td>
                    <img width="100" class="img-fluid" src="{{$project->thumb}}" alt="">
                </td>

                <td> {{$project->description}} </td>

                <td class="text-center">
                    <div>{{$project->deleted_at->format('d-m-Y')}}</div>
                    <div>{{$project->deleted_at->format('H:i')}}</div>
               </td>

                <td>

                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalId-restore-{{$project->id}}">
                            <i class="fa-solid fa-recycle"></i>
                        </button>


                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div class="modal fade" id="modalId-restore-{{$project->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$project->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100" id="modalTitleId-{{$project->id}}">
                                            <i class="fa-solid fa-triangle-exclamation text-warning"></i> Warning <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                                        </h5>
                                    </div>
                                    {{-- /.modal-header --}}

                                    <div class="modal-body text-center">
                                        Are you sure to restore?
                                    </div>
                                    {{-- /.modal-body --}}

                                    <div class="modal-footer d-flex justify-content-center align-items-center gap-3">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        <form action="{{ route('admin.restore', ['project' => $project->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <button type="submit" class="btn btn-success">Restore</button>
                                        </form>

                                    </div>
                                    {{-- /.modal-footer --}}


                                </div>
                                {{-- /.modal-content --}}

                            </div>
                            {{-- /.modal-dialog --}}

                        </div>

                        {{-- /.modal --}}

                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalId-delete-{{$project->id}}">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>


                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div class="modal fade" id="modalId-delete-{{$project->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$project->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100" id="modalTitleId-{{$project->id}}">
                                            <i class="fa-solid fa-triangle-exclamation text-warning"></i> Warning <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                                        </h5>
                                    </div>
                                    {{-- /.modal-header --}}

                                    <div class="modal-body">
                                        Are you sure to delete? Irreversible action.
                                    </div>
                                    {{-- /.modal-body --}}

                                    <div class="modal-footer d-flex justify-content-center align-items-center gap-3">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        <form action="{{ route('admin.forceDelete', ['project' => $project->id]) }}" method="POST">
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
                    </div>

                </td>

            </tr>
            @empty
            <tr>
                <td>No project trashed</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection