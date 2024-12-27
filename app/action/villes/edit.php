<?php
require_once '../../model/Ville.php';
require_once '../../model/Pays.php';

// Récupérer l'ID de la ville à éditer
$id_ville = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id_ville) {
    header('Location: ../../../index.php?error=no_id');
    exit;
}

// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $nom = $_POST['city-name'];
    $description = $_POST['city-description'];
    $type = $_POST['city-type'];
    $img_ville = $_POST['city-img'];
    $id_pays_fk = $_POST['id_pays'];

    $ville = new Villes($id_ville, $nom, $description, $type, $img_ville, $id_pays_fk);
    $result = $ville->update();

    if ($result) {
        header('Location: ../../../Dashboard/page/cities.php?id=' . $id_pays_fk);
        exit;
    } 
}

// Récupérer les données de la ville
$ville_data = Villes::getById($id_ville);
// Récupérer la liste des pays
$pays = Pays::getAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AFRINOVA</title>
    <link rel="stylesheet" href="../../../public/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- FIRST SECTION -->
    <section class="landingPage h-auto pt-6 flex flex-col items-center">
        <div class="flex rounded-3xl w-[85%]  justify-around gap-24 items-center py-3 px-4 md:px-24 bg-white">
            <a href="#"><img class="w-[160px]"
                    src="../../../public/img/Black White Stylish Minimalist Small World Logo.png" alt="logo"></a>
            <div class="flex gap-12 items-center">
                <a class=" bg-black text-white border-2 hover:bg-white hover:border-2 hover:text-black py-1 px-4 rounded-md transform duration-300"
                    href="">Home</a>
                <a href="">Continents</a>
                <a href="">About</a>
                <a href="">Services</a>
            </div>
            <div>
                <a href="#"
                    class="text-white text-lg bg-black border-2 rounded-3xl py-1 px-4 hover:text-black hover:bg-white hover:border-black transform duration-300  ">Contact
                    Us</a>
            </div>
        </div>
        <h1 class="font-bold text-white  text-2xl py-4 text-center mt-4 mb-4 ">Edit Information</h1>
        <section class="pb-20 ">
            <form class="flex flex-col gap-4 mx-auto w-full md:w-[800px] bg-gray-50 p-8 rounded shadow" method="POST">
                <label for="city-name" class="font-semibold">Nom de la ville:</label>
                <input type="text" name="city-name" id="city-name" class="p-2 border border-green-900 rounded"
                    value="<?php echo htmlspecialchars($ville_data['nom']); ?>" required>

                <label for="city-description" class="font-semibold">Description:</label>
                <input type="text" name="city-description" id="city-description" class="p-2 border border-green-900 rounded"
                    value="<?php echo htmlspecialchars($ville_data['v_description']); ?>" required>

                <label for="city-type" class="font-semibold">Type:</label>
                <select name="city-type" id="city-type" class="p-2 border border-green-900 rounded" required>
                    <option value="capitale" <?php echo $ville_data['type'] === 'capitale' ? 'selected' : ''; ?>>Capitale</option>
                    <option value="autre" <?php echo $ville_data['type'] === 'autre' ? 'selected' : ''; ?>>Autre</option>
                </select>

                <label for="id_pays" class="font-semibold">Pays:</label>
                <select name="id_pays" id="id_pays" class="p-2 border border-green-900 rounded" required>
                    <?php foreach ($pays as $p): ?>
                        <option value="<?php echo $p['id_pays']; ?>" 
                            <?php echo $p['id_pays'] === $ville_data['id_pays_fk'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($p['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="city-img" class="font-semibold">URL de l'image:</label>
                <input type="text" name="city-img" id="city-img" class="p-2 border border-green-900 rounded"
                    value="<?php echo htmlspecialchars($ville_data['img_ville']); ?>" required>

                <button type="submit" name="submit" 
                    class="mt-4 bg-black text-white py-2 px-4 rounded hover:bg-white hover:text-black border-black transform duration-300">
                    Mettre à jour la ville
                </button>
            </form>
        </section>
    </section>
    <!-- FOOTER -->
    <footer class="bg-slate-100">
        <div class="container flex justify-around items-center p-8 flex-col md:flex-row">
            <div class="bg-white p-4 flex flex-col items-center">
                <img class="w-40 pb-2 " src="../../../public/img/Black White Stylish Minimalist Small World Logo.png"
                    alt="logo" />
                <p class="text-xs w-32 text-center text-black">Thank you for visiting our website! We appreciate your
                    time and support. If you have any questions or feedback, feel free to reach out. We look forward to
                    having you back soon!</p>
            </div>
            <div class="flex gap-28 text-black md:flex-row">
                <div class="mb-4">
                    <h1 class="text-xl font-medium pb-2">Quick Links</h1>
                    <ul>
                        <li class="pb-1 hover:underline transition-all duration-400 hover:cursor-pointer"> <a
                                href="#">Home</a></li>
                        <li class="pb-1 hover:underline transition-all duration-400 hover:cursor-pointer"><a
                                href="#">About Us</a></li>
                        <li class="pb-1 hover:underline transition-all duration-400 hover:cursor-pointer"><a
                                href="#">Services</a></li>
                        <li class="pb-1 hover:underline transition-all duration-400 hover:cursor-pointer"><a
                                href="#">Account</a></li>
                        <li class="pb-1 hover:underline transition-all duration-400 hover:cursor-pointer"><a
                                href="#">Team</a></li>
                    </ul>
                </div>
                <div class="mb-4">
                    <h1 class="text-xl font-medium pb-2">Social Media</h1>
                    <ul>
                        <li class="pb-1 hover:underline transition-all duration-400 hover:cursor-pointer"><i
                                class="fa-brands fa-facebook pr-2"></i><a href="#">Facebook</a></li>
                        <a href="#">
                            <li class="pb-1 hover:underline transition-all duration-400 hover:cursor-pointer"><i
                                    class="fa-brands fa-instagram pr-2"></i><a href="#">Instagram</a></li>
                            <a href="#">
                                <li class="pb-1 hover:underline transition-all duration-400 hover:cursor-pointer"><i
                                        class="fa-brands fa-twitter pr-2"></i><a href="#">Twitter</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <p class="text-green-950 flex justify-end text-xs p-4">
            2024 Codeshogun. All rights reserved
        </p>
    </footer>
</body>

</html>