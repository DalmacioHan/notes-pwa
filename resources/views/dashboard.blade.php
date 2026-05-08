<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes Dashboard</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>

        body {
            font-family: Poppins, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #dbe2ef;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 28px 16px;
        }
        .glass {
            width: 100%;
            max-width: 420px;
            margin: 0;
            padding: 22px;
            border-radius: 20px;
            background: white;
            border: 2px solid #e0e0e0;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 18px;
            color: #333;
        }
        .header h6 {
            margin: 0;
            font-weight: 700;
            line-height: 1.35;
        }
        .header small {
            display: inline-block;
            margin-top: 6px;
            color: #666;
            font-weight: 500;
        }
        .note-card {
            background: #fff;
            border: 2px solid #e0e0e0;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 12px;
            color: #333;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
        }
        .note-title { font-size: 1rem; font-weight: 700; margin-bottom: 4px;}
        .note-content { font-size: 0.92rem; color: #555; margin-bottom: 10px; white-space: pre-wrap;}
        .empty-message {
            color: #666;
            text-align: center;
            opacity: 0.95;
            margin-top: 18px;
            padding: 18px 12px;
            border: 1px dashed #cfd6e4;
            border-radius: 14px;
            background: #f8faff;
        }
        .add-note-card {
            background: #fff;
            border: 2px solid #e0e0e0;
            border-radius: 18px;
            padding: 16px;
            margin-bottom: 14px;
            color: #333;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        }
        .add-note-card input, .add-note-card textarea {
            background: #fff;
            border: 2px solid #e0e0e0;
            color: #333;
        }
        .add-note-card input:focus, .add-note-card textarea:focus {
            background: #fff;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .add-note-card input::placeholder, .add-note-card textarea::placeholder {
            color: #777;
        }
        .add-note-card .btn-primary {
            background: blue;
            border-color: blue;
            font-weight: 600;
        }
        .add-note-card .btn-primary:hover {
            background: #0056d6;
            border-color: #0056d6;
        }
        .btn-outline-primary {
            color: blue;
            border-color: blue;
        }
        .btn-outline-primary:hover {
            background: blue;
            border-color: blue;
            color: #fff;
        }
        .note-card .btn-danger {
            font-weight: 600;
        }
        .note-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(0, 0, 255, 0.08);
            color: #0056d6;
            font-size: 0.78rem;
            font-weight: 700;
        }
    </style>
</head>
<body>
<div class="glass">
    <!-- Header -->
    <div class="header">
        <h6>
            @php $user = auth()->user(); @endphp
            @if($user->role == 1)
                Hello, {{$user->name}}, these are all the notes and their authors
            @else
                Hello, {{$user->name}}
            @endif
            <small>Write, keep, and remove notes from one place.</small>
        </h6>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-sign-out-alt"></i></button>
        </form>
    </div>
    <div class="add-note-card">
        <form method="POST" action="/notes">
            @csrf
            <div class="mb-2">
                <input type="text" name="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="mb-2">
                <textarea name="content" class="form-control" rows="3" placeholder="Content" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-plus"></i> Add Note</button>
        </form>
    </div>

    @if(isset($notes) && count($notes) > 0)

        @foreach($notes as $note)
            <div class="note-card">
                <div class="note-title">{{ $note->title }}</div>
                <div class="note-content">{{ $note->content }}</div>
                @if(auth()->user()->role == 1)
                    <small class="text-muted">
                        <strong>Author:</strong> {{ $note->user->name }}
                    </small>
                @endif
                <form method="POST" action="/notes/{{ $note->id }}" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger w-100"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </div>
        @endforeach
    @else
        <div class="empty-message">No notes yet. Add one above!</div>
    @endif
</div>
</body>
</html>
