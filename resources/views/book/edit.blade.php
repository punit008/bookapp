@extends('layout.app')

@section('title', 'Form')

@section('content')
    <div class="container">
        <div class="col-md-12 text-center mt-5">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
        </div>
        <form method="post" action="{{ route('book.update',[$books->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="NameOfBook" class="form-label">Name of book</label>
                <input type="text" class="form-control" id="NameOfBook" aria-describedby="name of book" name="name"
                    value="{{ $books->name }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="DescOfBook" class="form-label">Description of book</label>
                <textarea class="form-control" placeholder="Description of book" id="floatingTextarea2"
                    style="height: 100px" name="description">{{ $books->description }}</textarea>
                @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" name="category">
                    <option value="">Open this select menu</option>
                    <option value="frictional" @if ($books->category === 'frictional') selected @endif>Frictional Books</option>
                    <option value="biography" @if ($books->category === 'biography') selected @endif>Biography Books</option>
                    <option value="comedy" @if ($books->category === 'comedy') selected @endif>Comedy Books</option>
                </select>
                @if ($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image of book</label>
                <input type="file" class="form-control" id="image" aria-describedby="image" name="image">
                @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <br>
                <img src="{{ Storage::url($books->image) }}" alt="" height="60" width="60">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
