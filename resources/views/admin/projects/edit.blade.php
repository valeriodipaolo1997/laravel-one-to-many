@extends('layouts.admin')

@section('content')

<section class="create py-5 col-8 mx-auto">
    <div class="container">

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="pb-4">
        <h2 class="text-muted text-uppercase">Edit project ID: {{$project->id}}</h2>
        </div>

        <form action=" {{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="" aria-describedby="helpId" value=" {{old('title', $project->title)}}" required>
                <small id="titleHelper" class="text-muted">Type a title of Project</small>
                @error('title')
                <div class="text-danger"> {{$message}} </div>
                @enderror
            </div>

            <div class="mb-3 d-flex gap-5">
                <div>
                    <label for="thumb" class="form-label">New Image</label>
                    <input type="file" name="thumb" id="thumb" class="form-control @error('thumb') is-invalid @enderror" placeholder="" aria-describedby="helpId" required>
                    <small id="imageHelper" class="text-muted">Upload an image</small>
                    @error('thumb')
                    <div class="text-danger"> {{$message}} </div>
                    @enderror
                </div>
                <div>
                    @if(!in_array('The thumb field is required.',$errors->all()))
                    <div class="text-center">Old image</div>
                    <img width="300" class="img-fluid" src="{{$project->thumb}}" alt="">
                    @endif
                </div>
            </div>

            <div class="mb-5">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5" placeholder="Type a description" required>{{old('title', $project->description)}}</textarea>
                @error('description')
                <div class="text-danger"> {{$message}} </div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="5" placeholder="Type a content" required>{{old('title', $project->content)}}</textarea>
                @error('content')
                <div class="text-danger"> {{$message}} </div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="project_url" class="form-label">Project Url</label>
                <input type="url" name="project_url" id="project_url" class="form-control @error('project_url') is-invalid @enderror" placeholder="" aria-describedby="helpId" value=" {{old('project_url', $project->project_url)}}">
                <small id="project_urlHelper" class="text-muted">Type a Project Url</small>
                @error('project_url')
                <div class="text-danger"> {{$message}} </div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="git_url" class="form-label">Git Url</label>
                <input type="url" name="git_url" id="git_url" class="form-control @error('git_url') is-invalid @enderror" placeholder="" aria-describedby="helpId" value=" {{old('git_url', $project->git_url)}}">
                <small id="git_urlHelper" class="text-muted">Type a Project git Url</small>
                @error('git_url')
                <div class="text-danger"> {{$message}} </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
            <a class="text-decoration-none btn btn-primary" href="{{ route('admin.projects.index') }}">Torna alla lista</a>

        </form>
    </div>
</section>


@endsection