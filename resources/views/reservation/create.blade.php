<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Nouvelle Réservation</h1>
    <form action="{{ route('reservation.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <label for="document_id">Document :</label>
        <select name="document_id" id="document_id">
            @foreach($documents as $document)
                <option value="{{ $document->id }}">{{ $document->titre }}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="start_date">Date de début :</label>
            <input type="datetime-local" name="start_date" id="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">Date de fin :</label>
            <input type="datetime-local" name="end_date" id="end_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    
</body>
</html>