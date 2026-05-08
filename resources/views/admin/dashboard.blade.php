<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: Poppins;
            background: #dbe2ef;
            padding: 30px;
            min-height: 100vh;
        }


        .container-box {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 40px;
            border-radius: 20px;
            border: 2px solid #e0e0e0;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .container-box h5 {
            color: #333;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .container-box h5 small {
            color: #666;
            font-size: 14px;
            display: block;
            margin-top: 6px;
        }

        .note-card {
            background: #fff;
            border: 2px solid #e0e0e0;
            padding: 16px;
            border-radius: 16px;
            margin-bottom: 12px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
            color: #333;
        }

        .note-card h6 {
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .note-card p {
            color: #555;
            margin-bottom: 8px;
            white-space: pre-wrap;
        }

        .note-card small {
            color: #666;
        }

        .btn-danger {
            background: #dc3545;
            border-color: #dc3545;
            font-weight: 600;
        }

        .btn-danger:hover {
            background: #c82333;
            border-color: #c82333;
        }
    </style>
</head>
<body>


<div class="container-box">


    <div class="d-flex justify-content-between mb-3">
        <h5>
            Hello, {{ auth()->user()->name }}
            <br>
            <small>All notes and their authors</small>
        </h5>


        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>


    @foreach($notes as $note)
        <div class="note-card">
            <h6><strong>Title:</strong> {{ $note->title }}</h6>
            <p><strong>Description:</strong> {{ $note->content }}</p>


            <small><strong>Author:</strong> {{ $note->user->name }}</small>
        </div>
    @endforeach


</div>


</body>
</html>
