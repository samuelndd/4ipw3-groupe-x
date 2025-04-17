<?php
function html_login_form($message = '') {
    ob_start();
    ?>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container" style="max-width: 500px;">
            <div class="shadow-lg p-4">
                <!-- Si un message est passé en paramètre, je l'affiche dans une alerte--->
                <?php if ($message != ''): ?>
                    <div class="alert alert-info"><?= $message ?></div>
                <?php endif; ?>
            <!--Je vérifie ici si l'utilisateur n'est pas connecté.
                Si la session "user" n'est pas définie, alors on affiche le formulaire de connexion.--->
                <?php if (!isset($_SESSION['user'])): ?>
                    <h2 class="text-center mb-4">Connexion</h2>

                    <form method="post">
                        <div class="mb-3">
                            <!-- Champ pour saisir le nom d'utilisateur -->
                            <label for="avatar" class="form-label">Nom d'utilisateur</label>
                            <input id="avatar" name="avatar" required type="text" class="form-control" placeholder="avatar">
                        </div>
                        <div class="mb-3">
                            <!-- Champ pour saisir le mot de passe -->
                            <label for="passwd" class="form-label">Mot de passe</label>
                            <input id="passwd" name="passwd" required type="password" class="form-control" placeholder="Mot de passe">
                        </div>
                        <div class="d-grid">
                            <button name="login" type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </form>
                <?php else: ?>
                    <form method="post" class="text-center">
                        <h2 class="text-center mb-4">Connecté</h2>
                        <button name="logout" type="submit" class="btn btn-danger">Se déconnecter</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
