<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Postagem</title>
</head>
<body>
    <div> Nova Postagem</div>

    <form action="/salva-post" method="POST">

    @csrf
    
        <textarea name="mensagem" id="mensagem" cols="30" rows="10"></textarea>

        <button type="submit">Postar</button>

    </form>

</body>
</html>