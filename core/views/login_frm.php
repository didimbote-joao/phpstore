<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">

            <h3 class="text-center">Login</h3>

            <form action="?a=login_submit" method="post">
                <div class="my-3">
                    <label>Usuário:</label>
                    <input type="email" name="text_email" placeholder="Usuário" class="form-control" required>
                </div>
                <div class="my-3">
                    <label>Senha:</label>
                    <input type="password" name="text_password" placeholder="Senha" class="form-control" required>
                </div>
                <div class="my-3 text-center">
                    <input type="submit" class="btn btn-primary " value="Entrar" required>
                </div>
            </form>
            <?php if(isset($_SESSION['erro'])):?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['erro'];?>
                    <?php unset($_SESSION['erro']);?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>