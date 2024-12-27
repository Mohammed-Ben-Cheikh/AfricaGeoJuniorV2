<?php
require_once '../../model/Continent.php';

// Récupérer l'ID du continent à éditer
$id_continent = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id_continent) {
    header('Location: ../../../index.php?error=no_id');
    exit;
}

// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $nom = $_POST['continent-name'];
    $description = $_POST['continent-description'];
    $img_continent = $_POST['Continent-img'];

    $continent = new Continents($id_continent, $nom, $description, $img_continent);
    $result = $continent->update();

    if ($result) {
        header('Location: ../../../index.php?success=update');
        exit;
    } else {
        header('Location: ../../../index.php?error=update');
        exit;
    }
}

// Récupérer les données du continent
$continent_data = Continents::getById($id_continent);

if (!$continent_data) {
    header('Location: ../../../index.php?error=not_found');
    exit;
}
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
        <h1 class="font-bold text-white  text-2xl py-4 text-center mt-4 mb-4 ">Edit Country Information</h1>
        <section class="pb-20 ">
            <form class="flex flex-col gap-4 mx-auto w-full md:w-[800px] bg-gray-50 p-8 rounded shadow" method="POST">
                <label for="continent-name" class="font-semibold">Continent Name:</label>
                <select name="continent-name" id="continent-name" class="p-2 border border-green-900 rounded" required>
                    <option value="Asie" <?php echo $continent_data['nom'] === 'Asie' ? 'selected' : ''; ?>>Asie</option>
                    <option value="Afrique" <?php echo $continent_data['nom'] === 'Afrique' ? 'selected' : ''; ?>>Afrique</option>
                    <option value="Amérique" <?php echo $continent_data['nom'] === 'Amérique' ? 'selected' : ''; ?>>Amérique</option>
                    <option value="Antarctique" <?php echo $continent_data['nom'] === 'Antarctique' ? 'selected' : ''; ?>>Antarctique</option>
                    <option value="Europe" <?php echo $continent_data['nom'] === 'Europe' ? 'selected' : ''; ?>>Europe</option>
                    <option value="Australie" <?php echo $continent_data['nom'] === 'Australie' ? 'selected' : ''; ?>>Australie</option>
                </select>

                <label for="continent-description" class="font-semibold">Continent Description:</label>
                <textarea name="continent-description" id="continent-description"
                    class="p-2 border border-green-900 rounded" required><?php echo htmlspecialchars($continent_data['c_description']); ?></textarea>

                <label for="Continent-img" class="font-semibold">Continent Image URL:</label>
                <input type="text" name="Continent-img" id="Continent-img" 
                    class="p-2 border border-green-900 rounded"
                    value="<?php echo htmlspecialchars($continent_data['img_continent']); ?>" required>

                <button type="submit" name="submit"
                    class="mt-4 bg-black text-white py-2 px-4 rounded hover:bg-white hover:text-black border-black transform duration-300">
                    Update Continent
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
            <div class="flex gap-28 text-black md:flex-row"></div></div>
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
                <div class="mb-4"></div>
                    <h1 class="text-xl font-medium pb-2">Social Media</h1>
                    <ul></ul>
                        <li class="pb-1 hover:underline transition-all duration-400 hover:cursor-pointer"><i
                                class="fa-brands fa-facebook pr-2"></i><a href="#">Facebook</a></li>
                        <a href="#"></a>
                            <li class="pb-1 hover:underline transition-all duration-400 hover:cursor-pointer"><i
                                    class="fa-brands fa-instagram pr-2"></i><a href="#">Instagram</a></li>
                            <a href="#"></a>
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