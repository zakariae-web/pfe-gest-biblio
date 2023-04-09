<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{route('document.create')}}">ajouter un livre</a>
    @foreach($document as $document)
    <h1>{{$document['titre']}}</h1>
    <a href="{{route('document.edit', ['document' => $document->id])}}"><button> edit</button></a>
    <form method="POST" action="{{ route('document.destroy', ['document' => $document->id])}}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <form action="{{ route('documents.emprunter', $document->id) }}" method="POST">
    @csrf
    <button type="submit">Emprunter</button>
</form>

    @endforeach
</body>
</html>