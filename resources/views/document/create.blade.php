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
    <form action="{{route('document.store')}}" method="POST">
        @CSRF
        <label> titre </label>
        <input type="text" name="titre">
        <label> le type </label>
        <select name="type_document" id="">
            <option value="teacher"> teacher</option>
            <option value="student"> student</option>
        </select>
        <label> nom d'editeur </label>
        <input type="text" name="nom_editeur">
        <label> auteur </label>
        <input type="text" name="auteur_principal">
        <label> periodicity </label>
        <input type="text" name="periodicite_parution">
        <label> cote </label>
        <input type="text" name="cote">
        <button type="submit">submit</button>
    </form>
    
</body>
</html>