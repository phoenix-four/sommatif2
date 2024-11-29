<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <div class='page'>
        <header>
            @include('fragments.entete')
        </header>
    </div>

    <main>
        @yield('contenu')
    </main>

    <footer>
        @include('fragments.pieddepage')
    </footer>

    @php
    //<script src="./js/validations.js"></script>
    @endphp

</body>

</html>