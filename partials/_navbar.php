<link rel="stylesheet" href="css/navbar.css">

<nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav">
    <div class="container-fluid"> 
        <a class="navbar-brand" href="/">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" name="pesquisa">
            <form class="d-flex" id="form" action="procura.php" method="get">
            <input class="form-control me-2" type="search" placeholder="N.° Contrato" aria-label="Search" id="codigo" name="codigo" required>
            <button class="btn btn-outline-success" type="submit">Pesquisa</button>
        </form>
        </div>
    </div>
</nav>
