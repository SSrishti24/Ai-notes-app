<!DOCTYPE html>
<html>
<head>
    <title>AI Notes App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-4">
        <h2>AI Notes App</h2>

        <a href="/create" class="btn btn-primary">
            Create Note
        </a>
        
    </div>

    <form action="/" method="GET" class="mb-4">
        <input
            type="text"
            class="form-control"
            placeholder="Search notes..."
            name="search"
        >
    </form>

    @foreach($notes as $note)

        <div class="card mb-3">

            <div class="card-body">

                <h5>{{ $note->title }}</h5>

                <p>{{ $note->content }}</p>

                @if($note->summary)
                    <div class="alert alert-success">
                        <strong>Summary:</strong>
                        {{ $note->summary }}
                    </div>
                @endif

               <div class="d-flex gap-2">

                <a
                    href="/summary/{{ $note->id }}"
                    class="btn btn-success btn-sm"
                >
                    Summary
                </a>

                <a
                    href="/edit/{{ $note->id }}"
                    class="btn btn-warning btn-sm"
                >
                    Edit
                </a>

                <form
                    method="POST"
                    action="/delete/{{ $note->id }}"
                >
                    @csrf

                    <button
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete note?')"
                    >
                        Delete
                    </button>
                </form>

            </div>

          </div>

        </div>

    @endforeach

    {{ $notes->links() }}

</div>

</body>
</html>