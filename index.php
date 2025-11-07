<?php
session_start();

if (!empty($_SESSION['login_error'])) {
    $msg = htmlspecialchars($_SESSION['login_error'], ENT_QUOTES, 'UTF-8');
    echo "<div class=\"alert alert-danger\">{$msg}</div>"; // ajuste classes/HTML conforme seu layout
    unset($_SESSION['login_error']);
} elseif (!empty($_SESSION['login_success'])) {
    $msg = htmlspecialchars($_SESSION['login_success'], ENT_QUOTES, 'UTF-8');
    echo "<div class=\"alert alert-success\">{$msg}</div>"; // ajuste classes/HTML conforme seu layout
    unset($_SESSION['login_success']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/icone.png" type="image/png">
  <title>ELEJA - Login</title>

  <!-- Importando a fonte Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Configuração da fonte no Tailwind via CDN -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Montserrat', 'sans-serif'],
          },
        },
      },
    }
  </script>
</head>

<body class="font-sans bg-gray-200 text-black">
  <main class="min-h-screen flex items-center justify-center">
    <section class="bg-white px-10 py-6 rounded-lg border-2 shadow-xl w-full max-w-xl text-center">
      <header class="mb-4">
        <img src="assets/logo-sem-fundo.png" alt="Logo do sistema Eleja" class="mx-auto w-40" />
      </header>

      <form action="roteador.php?controller=Usuario&acao=login" method="post" class="text-left border px-8 py-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-4 text-center">Acesse para votar</h1>

        <label for="email" class="block mb-1">E-mail</label>
        <input type="email" id="email" name="email" required
          class="w-full px-4 py-2 border border-gray-300 rounded mb-4" />

        <label for="senha" class="block mb-1">Senha</label>
        <input type="password" id="senha" name="senha" required
          class="w-full px-4 py-2 border border-gray-300 rounded mb-2" />

        <a href="#" class="text-sm font-semibold text-[#b20000] hover:underline block mb-4">Esqueceu sua senha?</a>

        <button type="submit" class="w-full bg-[#b20000] hover:bg-red-500 text-white font-semibold py-3 rounded mb-4">ENTRAR</button>
        <a href="app/view/usuario/cadastrarView.php"><button type="button" class="w-full bg-[#091113] text-white hover:bg-opacity-90 font-semibold py-3 rounded">CADASTRAR-SE</button></a>
      </form>

      <footer class="mt-6">
        <p class="text-sm text-gray-600">Sistema de Votação Escolar</p>
      </footer>
    </section>
  </main>
</body>
</html>