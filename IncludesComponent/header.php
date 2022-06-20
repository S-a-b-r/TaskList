<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">
            Task list (
            <?php echo htmlspecialchars($_SESSION['user'])?>
            )
        </span>
    </a>

    <?php if(isset($_SESSION['user'])){ ?>
    <ul class="nav nav-pills">
        <form action="/app/main.php" method="post">
            <li class="nav-item"><button type="submit" class="btn btn-outline-dark mx-4" name="action" value="logout">Выход</button></li>
        </form>
    </ul>
    <?php } ?>
</header>
