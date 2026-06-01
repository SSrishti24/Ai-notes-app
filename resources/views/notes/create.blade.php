<!DOCTYPE html>
<html>
<head>

    <title>Create Note</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <h2>Create Note</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="/store">

        @csrf

        <div class="mb-3">

            <label>Title</label>

            <input
                type="text"
                name="title"
                class="form-control"
            >

        </div>

        <div class="mb-3">

            <label>Content</label>

            <textarea
                name="content"
                class="form-control"
                rows="5"
            ></textarea>

        </div>

        <button class="btn btn-primary">

            Save Note

        </button>

    </form>

</div>

</body>
</html>