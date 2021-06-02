@extends('layout.app')

@section('title', 'List')

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <div class="alert alert-success mt-5"> {{ Session::get('message') }}</div>
        @endif

        <h1>List Of All Books</h1>
        <table class="table table-striped d-flex flex-wrap overflow-scroll d-sm-table">
            <thead>
                <tr>
                    <th scope="col">Srno</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    <th scope="col">View</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td scope="row">{{ $loop->index + 1 }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->category }}</td>
                        <td><img src="{{ Storage::url($book->image) }}" alt="" height="60" width="60"></td>
                        <td><a href="{{ route('book.edit', [$book->id]) }}" class="btn btn-success">Edit</a></td>
                        <td>
                            <form action="{{ route('book.delete', [$book->id]) }}" method="post" class="d-inline-flex">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th scope="row" colspan="4">No record found</th>

                    </tr>
                @endforelse


            </tbody>
        </table>
        {{ $books->links() }}
    </div>

@endsection
