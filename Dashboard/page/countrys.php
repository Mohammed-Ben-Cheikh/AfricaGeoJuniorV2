<?php
require_once '../../app/model/Continent.php';
require_once '../../app/model/Pays.php';

// Validate ID parameter
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('Invalid continent ID');
}

$continent = Continents::getById($_GET['id']);
if (!$continent || !is_array($continent)) {
    die('Continent not found');
}

$pays = Pays::getByCountry($_GET['id']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AFRINOVA</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <section class="bg-[url('<?php echo htmlspecialchars($continent['img_continent']); ?>')] pt-6 flex flex-col items-center h-[350px]">
        <div class="flex rounded-3xl w-[85%]  justify-around gap-24 items-center py-3 px-4 md:px-24 bg-white">
            <a href="/TEST2"><img class="w-[160px]"
                    src="../public/img/Black White Stylish Minimalist Small World Logo.png" alt="logo"></a>
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
        <div
            class="text-black bg-white/70 rounded-3xl flex flex-col md:flex-row items-center px-4 py-8 md:px-20 gap-4 md:gap-20 mt-16">
            <h1 class="text-6xl text-start"><?php echo htmlspecialchars($continent['nom'] ?? ''); ?></h1>
        </div>
    </section>
    <section class="bg-white">
        <div class="py-8">
            <div class="flex items-center gap-4 ml-16">
                <h1 class="bg-slate-100/15 text-black px-2 py-1">Countries:</h1>
                <a href="../../app/action/pays/add.php?id=<?php echo htmlspecialchars($_GET['id']); ?>"
                    class="text-black text-sm border-2 px-2 py-1 hover:text-white hover:bg-green-950 hover:border-white transform duration-300 drop-shadow-2xl">
                    Add Country <i class="ri-add-line"></i>
                </a>
            </div>
        </div>
        <?php if ($pays): ?>
            <?php foreach ($pays as $country): ?>
                <div
                    class=" p-4 flex md:flex-row flex-col items-center md:justify-center border-2  border-slate-300 gap-20 w-[full]">
                    <img class="w-[300px] flex rounded-xl" src="<?php echo htmlspecialchars($country['img_pays']); ?>"
                        alt="<?php echo htmlspecialchars($country['nom']); ?>">
                    <div>
                        <div class=" flex justify-between items-center ">
                            <h1 class=" text-lg font-semibold pb-2"><?php echo htmlspecialchars($country['nom']); ?>
                            </h1>
                            <div>
                                <a href="../../app/action/pays/edit.php?id=<?php echo htmlspecialchars($country['id_pays']); ?>"><i
                                        class="ri-edit-fill text-sm text-black  hover:text-green-900 transform duration-300"></i></a>
                                <a href="../../app/action/pays/delete.php?id=<?php echo htmlspecialchars($country['id_pays']); ?>"><i
                                        class="ri-delete-bin-7-fill text-sm text-black  hover:text-green-900 transform duration-300"></i></a>
                            </div>
                        </div>
                        <P class="text-lg pb-4 md:w-[600px]"><?php echo htmlspecialchars($country['p_description']); ?>
                        </P>
                        <a href="cities.php?id=<?php echo $country['id_pays']; ?>"
                            class="block text-center bg-black text-white py-2 px-4 hover:bg-white hover:text-black border-2 border-black transition duration-300">
                            Explore cities
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">No countries found for this continent.</p>
            </div>
        <?php endif; ?>
    </section>
    <!-- FOOTER -->
    <footer class="bg-slate-100">
        <div class="container flex justify-around items-center p-8 flex-col md:flex-row">
            <div class="bg-white p-4 flex flex-col items-center">
                <img class="w-40 pb-2 " src="../public/img/Black White Stylish Minimalist Small World Logo.png"
                    alt="logo" />
                <p class="text-xs w-32 text-center text-black">Thank you for visiting our website! We appreciate your
                    time and support. If you have any questions or feedback, feel free to reach out. We look forward to
                    having you back soon!</p>
            </div>
            <div class="flex gap-28 text-green-950 md:flex-row">
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