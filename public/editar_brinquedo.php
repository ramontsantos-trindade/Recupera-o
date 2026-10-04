<?php
declare(strict_types=1);

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/validacao.php';
require_once __DIR__ . '/includes/brinquedos.php';

$tituloPagina = 'Editar brinquedo';
$id = validarId($_GET['id'] ?? $_POST['id'] ?? null);

if ($id === null) {
    definirMensagem('erro', 'Brinquedo inválido.');
    redirecionar('index.php');
}

$erros = [];
$dados = [];

try {
    $pdo = conectar();
    $brinquedo = buscarBrinquedo($pdo, $id);

    if ($brinquedo === null) {
        definirMensagem('erro', 'Brinquedo não encontrado.');
        redirecionar('index.php');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!csrfValido($_POST['csrf'] ?? null)) {
            $erros['geral'] = 'Requisição inválida. Recarregue a página e tente novamente.';
            $dados = $_POST;
        } else {
            [$erros, $dados] = validarBrinquedo($_POST);

            if (empty($erros)) {
                atualizarBrinquedo($pdo, $id, $dados);
                definirMensagem('sucesso', 'Brinquedo atualizado com sucesso!');
                redirecionar('index.php');
            }
        }
    } else {
        $dados = $brinquedo; 
    }
} catch (PDOException $ex) {
    error_log('[editar] ' . $ex->getMessage());
    $erros['geral'] = 'Erro ao acessar o banco de dados. Tente novamente mais tarde.';
    $dados = $dados ?: $_POST;
}

require __DIR__ . '/includes/header.php';
?>
<h1>Editar brinquedo #<?= e($id) ?></h1>
<?php if (isset($erros['geral'])): ?>
    <div class="alerta alerta-erro"><?= e($erros['geral']) ?></div>
<?php endif; ?>
<?php $textoBotao = 'Salvar alterações'; require __DIR__ . '/includes/form_brinquedo.php'; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>