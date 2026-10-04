<?php
declare(strict_types=1);

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/validacao.php';
require_once __DIR__ . '/includes/brinquedos.php';

$tituloPagina = 'Cadastrar brinquedo';
$erros = [];
$dados = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfValido($_POST['csrf'] ?? null)) {
        $erros['geral'] = 'Requisição inválida. Recarregue a página e tente novamente.';
        $dados = $_POST;
    } else {
        [$erros, $dados] = validarBrinquedo($_POST);

        if (empty($erros)) {
            try {
                criarBrinquedo(conectar(), $dados);
                definirMensagem('sucesso', 'Brinquedo cadastrado com sucesso!');
                redirecionar('index.php');
            } catch (PDOException $ex) {
                error_log('[cadastrar] ' . $ex->getMessage());
                $erros['geral'] = 'Erro ao salvar o brinquedo. Tente novamente mais tarde.';
            }
        }
    }
}

require __DIR__ . '/includes/header.php';
?>
<h1>Cadastrar brinquedo</h1>
<?php if (isset($erros['geral'])): ?>
    <div class="alerta alerta-erro"><?= e($erros['geral']) ?></div>
<?php endif; ?>
<?php $textoBotao = 'Cadastrar'; require __DIR__ . '/includes/form_brinquedo.php'; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
