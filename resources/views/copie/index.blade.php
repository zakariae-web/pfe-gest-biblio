<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{route('copie.create')}}">ajouter un livre</a>
    @foreach($copie as $copie)
    <tr>
        <td>{{ $copie->id }}</td>
        <td>{{ $copie->cote }}</td>
        <td>{{ $copie->disponible ? 'Oui' : 'Non' }}</td>
        <td>{{ $copie->document->titre }}</td>
        <td>{{ $copie->document->type_document }}</td>
        <td>
            <a href="{{ route('copie.edit', $copie->id) }}" class="btn btn-primary">Modifier</a>
            <form action="{{ route('copie.destroy', $copie->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </td>
    </tr>
    @endforeach
</body>
</html>