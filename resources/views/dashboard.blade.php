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
            background: #b8d1ff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 30px;
        }
        .glass {
            width: 100%;
            max-width: 420px;
            margin: 16px;
            padding: 20px;
            border-radius: 20px;
            background: rgba(255, 254, 254, 0.804);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px rgba(0,0,0,.2);
        }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; color: #141313;}
        .header h6 { margin: 0; font-weight: 600;}
        .note-card { box-shadow: inset: 0 4px 15px rgba(0,0,0,.2); background: rgba(192, 201, 199, 0.83); border-radius: 14px; padding: 14px; margin-bottom: 12px; color: #070707; }
        .note-title { font-size: 0.95rem; font-weight: 600;}
        .note-content { font-size: 0.8rem; opacity: 0.85;}
        .fab { position: fixed; bottom: 20px; right: 20px; width: 56px; height: 56px; border-radius: 50%; background: #fff; color: #764ba2; font-size: 28px; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 20px rgba(0,0,0,.3); text-decoration: none;}
        .empty-message { color: #1a1515; text-align: center; opacity: 0.8; margin-top: 20px;}
        .add-note-card { box-shadow: inset: 0 4px 15px rgba(255, 254, 254, 0.804); background: rgba(192, 201, 199, 0.83); border-radius: 14px; padding: 14px; margin-bottom: 12px; color: #fff;}
        .add-note-card input, .add-note-card textarea { background: rgba(255, 255, 255, 0.623); border: none; color: #fff;}
        .add-note-card input::placeholder, .add-note-card textarea::placeholder { color: rgba(0, 0, 0, 0.644);}
        .fas-star { color: #f39c12;}
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
        </h6>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-sign-out-alt"></i></button>
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
                    <small class = "text-dark">
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
