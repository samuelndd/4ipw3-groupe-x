<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Samuel L. Jackson Tribute</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<canvas id="stars"></canvas>

<div id="app">
    <h1>Samuel L. Jackson</h1>
    <nav>
        <button onclick="showSection('biography')">Biography</button>
        <button onclick="showSection('pulp')">Pulp Fiction</button>
        <button onclick="showSection('marvel')">Marvel (Nick Fury)</button>
        <button onclick="showSection('django')">Django Unchained</button>
        <button onclick="showSection('coach')">Coach Carter</button>
        <button onclick="showSection('incassable')">Incassable</button>
    </nav>
    <section id="content"></section>
</div>

<script src="script.js"></script>
</body>
</html>
