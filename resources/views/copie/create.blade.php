<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>ajouter un livre</h1>
    <form action="{{route('copie.store')}}" method="POST">
        @CSRF
        <label> document_id </label>
        <input type="text" name="document_id">
        <label> cote </label>
        <input type="text" name="cote">
        <label for="disponible">Disponible:</label>
        <input type="checkbox" name="disponible" id="disponible" value="1" {{ old('disponible') ? 'checked' : '' }}>
        <button type="submit">submit</button>
    </form>
    
</body>
</html>