<div class="container">
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center">Registo de Novo Cliente</h3>

            <form action="?a=criar_cliente" method="post">
                <div class="my-3">
                    <label>Email</label>
                    <input type="email" name="text_email" placeholder="Email" class="form-control" required>
                </div>
                <div class="my-3">
                    <label>Senha</label>
                    <input type="password" name="text_senha1" placeholder="Senha" class="form-control" required>
                </div>
                <div class="my-3">
                    <label>Repetir Senha</label>
                    <input type="password" name="text_senha2" placeholder="Repetir Senha" class="form-control" required>
                </div>
                <div class="my-3">
                    <label>Nome completo</label>
                    <input type="text" name="text_nome_completo" placeholder="Nome completo" class="form-control" required>
                </div>
                <div class="my-3">
                    <label>Morada</label>
                    <input type="text" name="text_morada" placeholder="Morada" class="form-control" required>
                </div>
                <div class="my-3">
                    <label>Cidade</label>
                    <input type="text" name="text_cidade" placeholder="Cidade" class="form-control" required>
                </div>
                <div class="my-3">
                    <label>Telefone</label>
                    <input type="text" name="text_telefone" placeholder="Telefone" class="form-control">
                </div>
                <div class="my-4">
                    <input type="submit" value="Criar conta" class="btn btn-primary">
                </div>

                <?php if(isset($_SESSION['erro'])): ?>
                    <div class="alert alert-danger text-center">
                        <?= $_SESSION['erro'];?>
                        <?php unset($_SESSION['erro']);?>
                    </div>
                <?php endif; ?>
            </form>

            
        </div>
    </div>
</div>

<!--
email*
senha1*
senha2*
nome_completo*
morada*
cidade*
telefone*

-->