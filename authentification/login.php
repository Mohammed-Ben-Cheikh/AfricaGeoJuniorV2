<?php
session_start();
require_once '../app/model/User.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $user = User::getByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['user_type'] = $user['type'];
        header('Location: ../index.php');
        exit();
    } else {
        $error = 'Email ou mot de passe incorrect';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - AfricaGeoJunior</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[url('../public/img/background-1-Copie.jpg')] bg-cover bg-center">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="bg-gradient-to-t from-blue-500/30 to-black border-b-2 p-8 rounded-lg shadow-md">
                <h2 class="text-center text-3xl font-bold text-white mb-8">Connexion</h2>
                
                <?php if ($error): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-white">Email:</label>
                        <input type="email" name="email" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white">Mot de passe:</label>
                        <input type="password" name="password" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Se connecter
                    </button>
                </form>
                <p class="mt-4 text-center text-sm text-white">
                    Pas encore de compte? 
                    <a href="signup.php" class="font-medium text-white hover:text-black">S'inscrire</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>