CREATE DATABASE worldy;

USE worldy;

CREATE TABLE `continents` (
    `id_Continent` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `nom` enum(
        'Asie',
        'Afrique',
        'Amérique',
        'Antarctique',
        'Europe',
        'Australie'
    ),
    `c_description` text DEFAULT NULL,
    `img_continent` varchar(225) NOT NULL
);

CREATE TABLE `pays` (
    `id_pays` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `nom` varchar(255) NOT NULL,
    `population` int NOT NULL,
    `langues_officielles` text DEFAULT NULL,
    `p_description` text DEFAULT NULL,
    `continent` enum(
        'Asie',
        'Afrique',
        'Amérique',
        'Antarctique',
        'Europe',
        'Australie'
    ),
    `img_pays` varchar(225) NOT NULL,
    `id_continent_fk` int(11),
    FOREIGN KEY (`id_continent_fk`) REFERENCES `continents`(`id_continent`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `villes` (
    `id_ville` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `nom` varchar(255) NOT NULL,
    `v_description` text DEFAULT NULL,
    `type` enum('capitale', 'autre'),
    `img_ville` varchar(225) NOT NULL,
    `id_pays_fk` int(11),
    FOREIGN KEY (`id_pays_fk`) REFERENCES `pays`(`id_pays`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `user` (
    `id_user` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `type` ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);


-- Insert data into `continents`
INSERT INTO `continents` (`nom`, `c_description`, `img_continent`) VALUES
('Asie', 'The largest continent, home to diverse cultures and landscapes.', 'asie.jpg'),
('Afrique', 'Known for its rich natural resources and diverse wildlife.', 'afrique.jpg'),
('Amérique', 'Includes North and South America with a wide range of climates.', 'amerique.jpg'),
('Antarctique', 'The coldest continent, covered almost entirely in ice.', 'antarctique.jpg'),
('Europe', 'A continent rich in history and culture.', 'europe.jpg'),
('Australie', 'A unique continent and country known for its biodiversity.', 'australie.jpg');


-- Insert data into `pays`
INSERT INTO `pays` (`nom`, `population`, `langues_officielles`, `p_description`, `continent`, `img_pays`, `id_continent_fk`) VALUES
('China', 1444216107, 'Chinese', 'The most populous country in the world.', 'Asie', 'china.jpg', 1),
('India', 1393409038, 'Hindi, English', 'Known for its cultural diversity.', 'Asie', 'india.jpg', 1),
('Japan', 126050000, 'Japanese', 'An archipelago with advanced technology and tradition.', 'Asie', 'japan.jpg', 1),
('Nigeria', 223804632, 'English', 'Africa\'s most populous country.', 'Afrique', 'nigeria.jpg', 2),
('Egypt', 109262178, 'Arabic', 'Known for its ancient pyramids and history.', 'Afrique', 'egypt.jpg', 2),
('South Africa', 60042000, 'English, Afrikaans, Zulu', 'A country with diverse cultures and landscapes.', 'Afrique', 'south_africa.jpg', 2),
('Brazil', 215353593, 'Portuguese', 'The largest country in South America.', 'Amérique', 'brazil.jpg', 3),
('USA', 331893745, 'English', 'The third most populous country in the world.', 'Amérique', 'usa.jpg', 3),
('Canada', 38005238, 'English, French', 'Known for its natural landscapes and multiculturalism.', 'Amérique', 'canada.jpg', 3),
('France', 67413000, 'French', 'Known for its art, culture, and history.', 'Europe', 'france.jpg', 5),
('Germany', 83155031, 'German', 'Europe\'s largest economy.', 'Europe', 'germany.jpg', 5),
('Italy', 60461828, 'Italian', 'Known for its rich history and cuisine.', 'Europe', 'italy.jpg', 5),
('Australia', 26839823, 'English', 'Known for its unique biodiversity.', 'Australie', 'australia.jpg', 6),
('New Zealand', 5125000, 'English, Māori', 'Famous for its stunning landscapes.', 'Australie', 'new_zealand.jpg', 6),
('Russia', 144104080, 'Russian', 'The largest country by land area.', 'Europe', 'russia.jpg', 5),
('Mexico', 128932753, 'Spanish', 'Known for its vibrant culture and history.', 'Amérique', 'mexico.jpg', 3),
('Argentina', 45605823, 'Spanish', 'Home to tango and diverse landscapes.', 'Amérique', 'argentina.jpg', 3),
('Morocco', 37731328, 'Arabic', 'Known for its vibrant markets and culture.', 'Afrique', 'morocco.jpg', 2),
('Kenya', 53771296, 'English, Swahili', 'Famous for its wildlife safaris.', 'Afrique', 'kenya.jpg', 2),
('South Korea', 51780579, 'Korean', 'A technologically advanced nation.', 'Asie', 'south_korea.jpg', 1);


-- Insert data into `villes`
INSERT INTO `villes` (`nom`, `v_description`, `type`, `img_ville`, `id_pays_fk`) VALUES
('Beijing', 'Capital city of China.', 'capitale', 'beijing.jpg', 1),
('Shanghai', 'Largest city in China.', 'autre', 'shanghai.jpg', 1),
('New Delhi', 'Capital city of India.', 'capitale', 'new_delhi.jpg', 2),
('Mumbai', 'Financial hub of India.', 'autre', 'mumbai.jpg', 2),
('Tokyo', 'Capital city of Japan.', 'capitale', 'tokyo.jpg', 3),
('Osaka', 'Major economic center in Japan.', 'autre', 'osaka.jpg', 3),
('Lagos', 'Largest city in Nigeria.', 'autre', 'lagos.jpg', 4),
('Abuja', 'Capital city of Nigeria.', 'capitale', 'abuja.jpg', 4),
('Cairo', 'Capital city of Egypt.', 'capitale', 'cairo.jpg', 5),
('Alexandria', 'Historic city in Egypt.', 'autre', 'alexandria.jpg', 5),
('Cape Town', 'Tourist city in South Africa.', 'autre', 'cape_town.jpg', 6),
('Pretoria', 'Capital city of South Africa.', 'capitale', 'pretoria.jpg', 6),
('Brasilia', 'Capital city of Brazil.', 'capitale', 'brasilia.jpg', 7),
('São Paulo', 'Largest city in Brazil.', 'autre', 'sao_paulo.jpg', 7),
('Washington, D.C.', 'Capital city of the USA.', 'capitale', 'washington.jpg', 8),
('New York', 'Largest city in the USA.', 'autre', 'new_york.jpg', 8),
('Ottawa', 'Capital city of Canada.', 'capitale', 'ottawa.jpg', 9),
('Toronto', 'Largest city in Canada.', 'autre', 'toronto.jpg', 9),
('Paris', 'Capital city of France.', 'capitale', 'paris.jpg', 10),
('Marseille', 'Major port city in France.', 'autre', 'marseille.jpg', 10),
('Berlin', 'Capital city of Germany.', 'capitale', 'berlin.jpg', 11),
('Munich', 'Economic hub in Germany.', 'autre', 'munich.jpg', 11),
('Rome', 'Capital city of Italy.', 'capitale', 'rome.jpg', 12),
('Milan', 'Fashion capital of Italy.', 'autre', 'milan.jpg', 12),
('Canberra', 'Capital city of Australia.', 'capitale', 'canberra.jpg', 13),
('Sydney', 'Major city in Australia.', 'autre', 'sydney.jpg', 13),
('Wellington', 'Capital city of New Zealand.', 'capitale', 'wellington.jpg', 14),
('Auckland', 'Largest city in New Zealand.', 'autre', 'auckland.jpg', 14),
('Moscow', 'Capital city of Russia.', 'capitale', 'moscow.jpg', 15),
('Saint Petersburg', 'Historic city in Russia.', 'autre', 'st_petersburg.jpg', 15),
('Mexico City', 'Capital city of Mexico.', 'capitale', 'mexico_city.jpg', 16),
('Guadalajara', 'Major cultural center in Mexico.', 'autre', 'guadalajara.jpg', 16),
('Buenos Aires', 'Capital city of Argentina.', 'capitale', 'buenos_aires.jpg', 17),
('Cordoba', 'Historic city in Argentina.', 'autre', 'cordoba.jpg', 17),
('Rabat', 'Capital city of Morocco.', 'capitale', 'rabat.jpg', 18),
('Casablanca', 'Largest city in Morocco.', 'autre', 'casablanca.jpg', 18),
('Nairobi', 'Capital city of Kenya.', 'capitale', 'nairobi.jpg', 19),
('Mombasa', 'Coastal city in Kenya.', 'autre', 'mombasa.jpg', 19),
('Seoul', 'Capital city of South Korea.', 'capitale', 'seoul.jpg', 20),
('Busan', 'Major port city in South Korea.', 'autre', 'busan.jpg', 20);

