<?php
// Define a URL base para facilitar a criação de links
// Detecta se está usando HTTPS
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
// Pega o nome do host
$host = $_SERVER['HTTP_HOST'];
// Pega o diretório onde o script está rodando (remove o nome do script se houver)
$script_dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
// Monta a URL base - Certifique-se que o diretório está correto
$baseUrl = $protocol . $host . $script_dir;

$paginaAtual = $_GET['pagina'] ?? 'home';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0"> <?php // Links principais à esquerda (se logado) ?>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo ($paginaAtual === 'home') ? 'active' : ''; ?>" href="index.php?pagina=home">
                   <i class="fas fa-home me-1"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($paginaAtual === 'cadastro_funcionario') ? 'active' : ''; ?>" href="index.php?pagina=cadastro_funcionario">
                    <i class="fas fa-user-plus me-1"></i> Funcionários
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($paginaAtual === 'cadastro_tarefa') ? 'active' : ''; ?>" href="index.php?pagina=cadastro_tarefa">
                   <i class="fas fa-plus-circle me-1"></i> Nova Tarefa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($paginaAtual === 'gerenciar_tarefas') ? 'active' : ''; ?>" href="index.php?pagina=gerenciar_tarefas">
                    <i class="fas fa-clipboard-list me-1"></i> Gerenciar Tarefas
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <ul class="navbar-nav ms-auto"> <?php // Links à direita (login/logout/usuário) ?>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user me-1"></i> <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                <li><a class="dropdown-item" href="index.php?pagina=logout"><i class="fas fa-sign-out-alt me-1"></i> Sair</a></li>
                <?php /* Adicionar link para 'Meu Perfil' aqui no futuro */ ?>
              </ul>
            </li>
            <?php else: ?>
             <li class="nav-item">
                <a class="nav-link <?php echo ($paginaAtual === 'login') ? 'active' : ''; ?>" href="index.php?pagina=login">
                   <i class="fas fa-sign-in-alt me-1"></i> Login
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link <?php echo ($paginaAtual === 'registro') ? 'active' : ''; ?>" href="index.php?pagina=registro">
                   <i class="fas fa-user-plus me-1"></i> Registrar
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>

    <div class="container mt-4">
        <?php
        // Exibe mensagens de feedback (se houver)
        if (isset($_SESSION['mensagem_sucesso'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $_SESSION['mensagem_sucesso'] . '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            unset($_SESSION['mensagem_sucesso']); // Limpa a mensagem após exibir
        }
        if (isset($_SESSION['mensagem_erro'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $_SESSION['mensagem_erro'] . '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            unset($_SESSION['mensagem_erro']); // Limpa a mensagem após exibir
        }
        ?>