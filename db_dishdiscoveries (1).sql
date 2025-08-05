-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 04:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dishdiscoveries`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contactus`
--

CREATE TABLE `tbl_contactus` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contactus`
--

INSERT INTO `tbl_contactus` (`ID`, `Name`, `Email`, `Subject`, `Message`, `CreatedDate`) VALUES
(19, 'Ambreen', 'ambreenambi04@gmail.com', 'Muffin\'s Recipe', 'Please add a recipe of muffins on your page.', '2024-12-27 18:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dessertreviews`
--

CREATE TABLE `tbl_dessertreviews` (
  `id` int(11) NOT NULL,
  `reviewtitle` text NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_dessertreviews`
--

INSERT INTO `tbl_dessertreviews` (`id`, `reviewtitle`, `rating`, `review`, `created_at`, `user_id`) VALUES
(1, 'Banana PanCake', 5, 'Amazing recipe. ', '2024-12-29 08:35:58', 3),
(2, 'Chocolate Cake', 3, 'Good.', '2024-12-29 09:06:11', 3),
(3, 'Molten Lava Cake', 5, 'Good.', '2024-12-29 09:10:55', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recipesharing`
--

CREATE TABLE `tbl_recipesharing` (
  `recipetitle` text NOT NULL,
  `recipecategory` varchar(30) NOT NULL,
  `titlerecipeimage` varchar(250) NOT NULL,
  `recipeimage` varchar(255) DEFAULT NULL,
  `recipedescription` varchar(150) NOT NULL,
  `keyrecipeingredients` varchar(100) NOT NULL,
  `recipeingredients` varchar(1000) NOT NULL,
  `recipeinstructions` varchar(4000) NOT NULL,
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_recipesharing`
--

INSERT INTO `tbl_recipesharing` (`recipetitle`, `recipecategory`, `titlerecipeimage`, `recipeimage`, `recipedescription`, `keyrecipeingredients`, `recipeingredients`, `recipeinstructions`, `id`, `userid`) VALUES
('Loaded Fries', 'maincourse', 'DishDiscoveries/6762d9a06f14c-Loaded fries.png', 'DishDiscoveries/6762d9a06f56a-Loaded.jpg', 'Loaded fries is French fries topped with a combination of cheese, sauces, chicken & vegetables.', 'Fries chicken cheese onions', '2 tablespoons cooking oil or ghee\r\n•1 medium onion, finely chopped\r\n•2 garlic cloves, minced\r\n•1-inch piece of ginger, grated\r\n•2 medium tomatoes, finely chopped or blended\r\n•2 teaspoons curry powder or garam masala\r\n•1 teaspoon turmeric powder\r\n•1 teaspoon cumin powder\r\n•1/2 teaspoon chili powder (adjust to taste)\r\n•1/2 cup plain yogurt or coconut milk\r\n•500g (1 lb) chicken (boneless or bone-in), cut into pieces\r\n•1 cup water or chicken broth\r\n•Salt to taste\r\n•Fresh cilantro (coriander) leaves, for garnish', 'Cook the Fries: Preheat the oven to 200°C (400°F) or use an air fryer.\n          Spread the fries on a baking sheet in a single layer and cook according to package instructions (or until golden and crispy if using fresh fries).\n          Prepare Toppings: While the fries cook, shred the cheese and cook the chicken until crispy. Crumble the chicken into small pieces.\n          Assemble the Fries: Once the fries are cooked, transfer them to an oven-safe dish or keep them on the baking tray.\n          Sprinkle the cheese evenly over the fries.\n          Add the crumbled chicken on top.\n          Melt the Cheese: Place the fries back in the oven for 5 minutes, or until the cheese is melted and bubbly.\n          Add Final Toppings: Drizzle with sour cream and sprinkle chopped green onions or chives over the top.\n          Add any other desired toppings, like diced tomatoes or jalapeños.\n          Serve Immediately: Serve hot, straight from the tray, with extra dips like ranch or guacamole on the side.', 1, 6),
('Napoleon Chicken', 'maincourse', 'DishDiscoveries/6762dac5ed65a-Napoleon chicken.jpg', 'DishDiscoveries/6762dac5edac3-Napoleon.jpg', 'Deep fried cheesy batter with parmesan, mozzarella, cheddar and cream cheese stuffing.', 'Puff-pastry chicken butter cheese', '2 large chicken breasts (butterflied or thinly sliced)\r\n•1/2 cup all-purpose flour\r\n•2 large eggs (beaten)\r\n•1 cup breadcrumbs (panko or regular)\r\n•1/2 cup grated Parmesan cheese\r\n•1/2 teaspoon garlic powder\r\n•1/2 teaspoon paprika\r\n•1/4 teaspoon black pepper\r\n•1/2 teaspoon salt\r\n•1 cup shredded mozzarella cheese\r\n•1/2 cup cream cheese (softened)\r\n•1/4 cup shredded cheddar cheese\r\n•2 tablespoons butter (for frying)\r\n•2 sheets of puff pastry (thawed, optional for layering)\r\n•Cooking oil (for frying)', 'Prepare the Chicken: Butterfly or thinly slice the chicken breasts to create even pieces.\r\n          Season the chicken with salt, pepper, garlic powder, and paprika on both sides.\r\n          2. Set Up Breading Station:Place flour in one bowl.\r\n          In a second bowl, beat the eggs.\r\n          In a third bowl, combine breadcrumbs and Parmesan cheese.\r\n          3. Bread the Chicken: Dredge each chicken piece in flour, shaking off excess.\r\n          Dip into the beaten eggs.\r\n          Coat thoroughly in the breadcrumb mixture.\r\n          4. Cook the Chicken: Heat butter and a little oil in a large skillet over medium heat.\r\n          Fry the chicken until golden brown and cooked through, about 4-5 minutes per side.\r\n          Remove and set on a paper towel to drain excess oil.\r\n          5. Prepare the Cheese Filling: In a small bowl, mix cream cheese, mozzarella, and cheddar cheese until smooth.\r\n          6. Assemble the Napoleon Chicken (Optional): If using puff pastry, bake it according to package instructions until golden.\r\n          Layer a piece of cooked chicken, a dollop of cheese filling, and a piece of puff pastry.\r\n          Repeat for additional layers, ending with a pastry top.\r\n          7. Serve: Serve hot with a side of vegetables, mashed potatoes, or a fresh salad.', 2, 6),
('Breakfast Wrap', 'maincourse', 'DishDiscoveries/6762dc1075237-Breakfast wrap.jpg', 'DishDiscoveries/6762dc10756aa-Breakfast.jpg', 'A tortilla wrap filled with a freshly cracked egg, cheese and a sauce of your choice.', 'Tortilla eggs omlette cheese', '1 large tortilla or flatbread\r\n•2 large eggs (or 1 egg and 2 egg whites)\r\n•2 slices of cooked chicken, sausage\r\n•1/4 cup shredded cheese (cheddar, mozzarella, or your choice)\r\n•1/4 cup diced vegetables (e.g., bell peppers, spinach, onions, or tomatoes)\r\n•1 tablespoon butter or oil (for cooking)\r\n•1 tablespoon mayonnaise, ketchup, or hot sauce (optional)\r\n•Salt and pepper to taste', '1. Prepare the Filling: Heat a non-stick skillet over medium heat and add butter or oil.\r\n          Add the diced vegetables and sauté for 1-2 minutes until softened.\r\n          Beat the eggs in a bowl, season with salt and pepper, and pour them into the skillet.\r\n          Scramble the eggs gently, mixing in the cooked vegetables, until fully cooked.\r\n          2. Heat the Tortilla: Warm the tortilla in a clean skillet for about 10-15 seconds on each side until pliable.\r\n          3. Assemble the Wrap: Spread a thin layer of mayonnaise, ketchup, or hot sauce on the tortilla if desired.\r\n          Layer the scrambled eggs, bacon/sausage/ham, and shredded cheese in the center of the tortilla.\r\n          Fold the sides of the tortilla inward, then roll it tightly from the bottom up to form a wrap.\r\n          4. Toast (Optional): Place the wrap seam-side down in the skillet and toast for 1-2 minutes on each side until golden and crispy.\r\n          5. Serve: Cut the wrap in half and serve hot. Pair it with fresh fruit, coffee, or a smoothie for a complete breakfast.', 3, 6),
('Finger Fish', 'maincourse', 'DishDiscoveries/6762ddba04a84-Finger fish.jpeg', 'DishDiscoveries/6762ddba04f04-Finger.jpg', 'Finger fish are a processed food made with a batter formed into a rectangular shape.', 'Fish breadcrumbs eggs', '500g (1 lb) white fish fillets (cod, tilapia, or haddock)•2 large eggs (or 1 egg and 2 egg whites)\r\n•1 cup breadcrumbs (panko or regular)\r\n•½ cup all-purpose flour\r\n•2 large eggs, beaten\r\n•1 tsp garlic powder\r\n•½ tsp black pepper\r\n•½ tsp salt\r\n•1 tbsp lemon juice\r\n•Oil for frying (or baking/air-frying option)', 'Prepare the Fish: Rinse the fish fillets and pat them dry.\r\n          Slice them into thin, finger-like strips.\r\n          Marinate with lemon juice, salt, and pepper for 10-15 minutes.\r\n          Set Up the Coating Station: Place flour in one bowl.\r\n          Beat the eggs in a second bowl.\r\n          Mix breadcrumbs, garlic powder, paprika, and a pinch of salt in a third bowl.\r\n          Coat the Fish: Dip each fish strip first into the flour, then into the beaten eggs, and finally coat it well with the breadcrumb mixture.\r\n          Cook the Fish: Frying: Heat oil in a skillet over medium heat. Fry the fish fingers in batches for 2-3 minutes on each side until golden and crispy. Drain on paper towels.\r\n          Baking: Preheat the oven to 200°C (400°F). Arrange the fish on a greased baking tray and bake for 15-20 minutes, flipping halfway through.\r\n          Air Frying: Cook at 200°C (400°F) for 12-15 minutes, shaking halfway through.\r\n          Serve Hot: Serve with tartar sauce, ketchup, or a squeeze of lemon. Add fries or a salad for a complete meal.', 4, 6),
('Banana Pancakes', 'dessert', 'DishDiscoveries/6762df004db0d-Banana pancakes.jpg', 'DishDiscoveries/6762df004dfad-Banana.jpg', 'Pancake is a flat cake, thin & round, prepared from a batter and cooked on a hot surface.', 'Banana eggs butter oil', '1 ripe banana\r\n•1 cup all-purpose flour\r\n•1 tablespoon sugar (optional)\r\n•1 teaspoon baking powder\r\n•1/2 teaspoon baking soda\r\n•1/4 teaspoon salt\r\n•1 egg\r\n•1/2 cup milk\r\n•2 tablespoons melted butter (or vegetable oil)\r\n•1 teaspoon vanilla extract (optional)\r\n•Butter or oil for cooking', 'Mash the Banana: In a bowl, mash the ripe banana with a fork until smooth. \r\n          Leave some small chunks for texture if desired.\r\n          Mix Dry Ingredients: In a separate bowl, whisk together the flour, sugar, baking powder, baking soda, and salt.\r\n          Combine Wet Ingredients: In another bowl, whisk together the egg, milk, melted butter, and vanilla extract (if using). Stir in the mashed banana.\r\n          Combine Wet and Dry Ingredients: Pour the wet ingredients into the dry ingredients and stir gently to combine. Be careful not to overmix. The batter will be a little lumpy, which is fine.\r\n          Cook the Pancakes: Heat a non-stick skillet or griddle over medium heat and lightly grease with butter or oil. Pour about 1/4 cup of batter onto the skillet for each pancake. Cook until bubbles form on the surface (about 2-3 minutes), then flip and cook for another 1-2 minutes, or until golden brown and cooked through.\r\n          Serve: Serve the banana pancakes warm with maple syrup, fresh fruit, or a dollop of whipped cream.', 5, 6),
('Chocolate Mousse', 'dessert', 'DishDiscoveries/6762e0d3de19f-Chocolate mousse.jpg', 'DishDiscoveries/6762e0d3de603-Chocolate.jpg', 'Chocolate mousse is a chocolate desserts. Its texture is light & airy look.', 'Dark-chocolate cream sugar', '200g (7 oz) dark chocolate (70% cocoa or more)\r\n•1 cup heavy cream (whipping cream)\r\n•2 tablespoons sugar (optional, depending on sweetness preference)\r\n•1 teaspoon vanilla extract (optional)\r\n•Pinch of salt', 'Melt the Chocolate: Break the dark chocolate into small pieces and place it in a heatproof bowl.\r\n          Melt the chocolate either in a microwave in 20-30 second intervals, stirring each time, or using the double boiler method (placing the bowl over simmering water, ensuring the bowl doesn’t touch the water). Stir until smooth and fully melted. Let it cool for a few minutes.\r\n          Whip the Cream: In a separate bowl, pour the heavy cream. Whip the cream with an electric mixer or by hand until soft peaks form. If you want sweeter mousse, you can add sugar as you whip. Add the vanilla extract and a pinch of salt.\r\n          Combine the Chocolate and Cream: Gently fold the melted chocolate into the whipped cream using a spatula. Be careful not to deflate the cream—fold slowly until well combined and smooth.\r\n          Chill: Spoon the mousse into serving cups or bowls. Refrigerate for at least 1-2 hours to allow it to set.\r\n          Serve: Before serving, you can garnish with grated chocolate, whipped cream, berries, or a sprinkle of cocoa powder.', 6, 6),
('Molten Lava Cake', 'dessert', 'DishDiscoveries/6762e21168e6f-Molten lava.jpeg', 'DishDiscoveries/6762e21169295-Molten.jpg', 'Molten chocolate cake or runny core cake consists of a chocolate cake with a liquid chocolate core.', 'Chocolate egg sugar flour', '1/4 cup (60g) unsalted butter\r\n•1/4 cup (45g) semi-sweet chocolate chips or chopped chocolate\r\n•1/4 cup (30g) powdered sugar\r\n•1 large egg\r\n•1 large egg yolk\r\n•1/4 Pinch of salt\r\n•1/4 cup (30g) all-purpose flour\r\n•Optional: ice cream or whipped cream for serving', 'Preheat the Oven: Preheat your oven to 425°F (220°C). Grease two ramekins (about 6 oz each) with butter, and dust them lightly with cocoa powder to ensure the cakes don’t stick.\r\n          Melt the Chocolate: In a microwave-safe bowl, melt the butter and chocolate together. Microwave in 20-second intervals, stirring after each, until fully melted and smooth.\r\n          Mix the Batter: Stir the powdered sugar into the melted chocolate mixture.\r\n          Whisk in the egg and egg yolk until well combined.\r\n          Add the vanilla extract and a pinch of salt.\r\n          Gently fold in the flour until just combined (do not overmix).\r\n          Fill the Ramekins: Divide the batter evenly between the two prepared ramekins.\r\n          Bake: Place the ramekins on a baking sheet and bake for 12-14 minutes. The edges should be firm, but the center will look slightly undercooked. Do not overbake, as you want the center to remain gooey.\r\n          Serve: Let the cakes cool in the ramekins for 1 minute. Then, carefully run a knife around the edges to loosen the cakes. Invert each ramekin onto a plate and gently lift the ramekin off.\r\n          Serve immediately with vanilla ice cream, whipped cream, or fresh berries.', 7, 6),
('Tiramisu', 'dessert', 'DishDiscoveries/6762e34f74092-Tiramisu.jpg', 'DishDiscoveries/6762e34f744b3-Tiramisu1.jpg', 'Tiramisù is a layered no-bake dessert consisting of ladyfingers soaked with coffee & whipped sugar.', 'Cream sugar ladyfingers cocoa-powder', '1 cup (240ml) heavy cream\r\n•1 cup (240g) mascarpone cheese (softened)\r\n•1/2 cup (60g) powdered sugar\r\n•1 teaspoon vanilla extract\r\n•1 cup (240ml) strong brewed coffee (cooled)\r\n•2 tablespoons coffee liqueur (optional)\r\n•24-30 ladyfingers (savoiardi biscuits)\r\n•Unsweetened cocoa powder (for dusting)\r\n•Shaved chocolate or chocolate chips (optional for garnish)', 'Prepare the Coffee Mixture: Brew a cup of strong coffee and let it cool to room temperature.\r\n          If desired, add 2 tablespoons of coffee liqueur (like Kahlúa) to the coffee for an extra kick.\r\n          Make the Cream Mixture: In a large bowl, whisk the mascarpone cheese and powdered sugar together until smooth.\r\n          In another bowl, whip the heavy cream and vanilla extract until stiff peaks form.\r\n          Gently fold the whipped cream into the mascarpone mixture until well combined.\r\n          Assemble the Tiramisu: Quickly dip each ladyfinger into the coffee mixture (do not soak them; just dip them briefly to avoid them becoming soggy).\r\n          Layer the dipped ladyfingers in the bottom of a serving dish (about 9x9-inch or similar size).\r\n          Spread half of the mascarpone mixture over the ladyfingers layer.\r\n          Second Layer: Repeat with another layer of dipped ladyfingers and the remaining mascarpone mixture on top.\r\n          Chill: Cover the tiramisu and refrigerate for at least 4 hours, but preferably overnight, to allow the flavors to meld together.\r\n          Serve: Before serving, dust the top with cocoa powder using a fine sieve, and optionally, garnish with shaved chocolate or chocolate chips.', 8, 6),
('Grilled Cheese Sandwich', 'maincourse', 'DishDiscoveries/6762e5d3853cd-Grilled cheese sandwich.jpg', 'DishDiscoveries/6762e5d385c6d-Sandwich.jpg', 'A grilled cheese sandwich is made by placing a cheese filling, between two slices of bread.', 'Bread cheese butter', '2 boneless, skinless chicken breasts (pounded thin or butterflied)\r\n•2 sandwich buns or rolls\r\n•2 slices of cheese (cheddar, Swiss, or your choice)\r\n•2 lettuce leaves\r\n•2 slices of tomato\r\n•2 tablespoons mayonnaise (or your preferred sauce)\r\n•1 tablespoon olive oil (for grilling)\r\n•1 teaspoon garlic powder\r\n•1 teaspoon paprika\r\n•1/2 teaspoon salt\r\n•1/4 teaspoon black pepper\r\n•Optional: pickles, onions, or avocado slices for garnish', '1. Prepare the Chicken: In a small bowl, mix garlic powder, paprika, salt, and black pepper.\r\n          Rub the seasoning mix onto both sides of the chicken breasts.\r\n          2. Cook the Chicken: Heat a grill pan or outdoor grill over medium heat. Add olive oil to the pan if needed.\r\n          Grill the chicken for 5-6 minutes per side, or until fully cooked (internal temperature of 165°F / 74°C).\r\n          During the last minute of cooking, place a slice of cheese on each chicken breast to melt.\r\n          3. Toast the Buns: Lightly toast the sandwich buns on the grill or in a skillet until golden.\r\n          4. Assemble the Sandwich: Spread mayonnaise (or your preferred sauce) on the inside of the buns.\r\n          Layer the bottom bun with lettuce, the grilled chicken breast with melted cheese, tomato slices, and any optional toppings.\r\n          Place the top bun over the assembled sandwich.\r\n          5. Serve: Serve hot with a side of fries, chips, or a fresh salad.', 9, 6),
('Chicken Curry', 'maincourse', 'DishDiscoveries/6762e7603de37-Chicken curry.jpg', 'DishDiscoveries/6762e7603e295-Chicken.jpg', 'Chicken curry has chicken stewed in a tomato sauce seasoned with aromatic spices.', 'Chicken onion tomato spices', '2 tablespoons cooking oil or ghee\r\n•1 medium onion, finely chopped\r\n•2 garlic cloves, minced\r\n•1-inch piece of ginger, grated\r\n•2 medium tomatoes, finely chopped or blended\r\n•2 teaspoons curry powder or garam masala\r\n•1 teaspoon turmeric powder\r\n•1 teaspoon cumin powder\r\n•1/2 teaspoon chili powder (adjust to taste)\r\n•1/2 cup plain yogurt or coconut milk\r\n•500g (1 lb) chicken (boneless or bone-in), cut into pieces\r\n•1 cup water or chicken broth\r\n•Salt to taste\r\n•Fresh cilantro (coriander) leaves, for garnish', '1. Sauté Aromatics: Heat the oil or ghee in a large skillet or pan over medium heat.\r\n          Add the chopped onion and sauté until golden brown, about 5-7 minutes.\r\n          Stir in the minced garlic and grated ginger, and cook for another minute until fragrant.\r\n          2. Add Spices and Tomatoes: Add curry powder, turmeric, cumin, and chili powder to the pan. Stir and cook for 1 minute to toast the spices.\r\n          Add the chopped or blended tomatoes and cook until the mixture thickens and the oil begins to separate, about 5-6 minutes.\r\n          3. Cook the Chicken: Add the chicken pieces to the pan and mix well, ensuring they are coated in the spice mixture.\r\n          Cook for 3-4 minutes, stirring occasionally.\r\n          4. Add Yogurt and Simmer: Lower the heat and stir in the yogurt (or coconut milk) to create a creamy sauce.\r\n          Add water or chicken broth, cover, and simmer for 15-20 minutes, or until the chicken is tender and cooked through.\r\n          5. Season and Garnish: Taste and adjust salt as needed.\r\n          Garnish with fresh cilantro leaves.\r\n          6. Serve: Serve hot with steamed rice, naan, or roti.', 10, 6),
('Spaghetti Aglio e Olio', 'maincourse', 'DishDiscoveries/6762e8f906832-Spaghetti.png', 'DishDiscoveries/6762e8f906cf4-Spaghetti.jpg', 'Spaghetti is a pasta made with spaghetti, olive oil, garlic, and seasonings.', 'Spaghetti garlic olive oil cheese', '200g (7 oz) spaghetti\r\n•3 tablespoons olive oil\r\n•4 garlic cloves, thinly sliced\r\n•1/2 teaspoon red chili flakes (adjust to taste)\r\n•Salt, to taste\r\n•Fresh parsley, chopped (optional)\r\n•Grated Parmesan cheese (optional)', '1. Cook the Spaghetti: Bring a large pot of salted water to a boil. Add the spaghetti and cook according to the package instructions until al dente.\r\n          Reserve 1/2 cup of pasta water before draining.\r\n          2. Prepare the Garlic and Oil: Heat the olive oil in a large skillet over medium heat.\r\n          Add the sliced garlic and sauté gently until golden and fragrant (about 1-2 minutes). Be careful not to burn the garlic.\r\n          Stir in the red chili flakes and cook for another 30 seconds.\r\n          3. Combine with Pasta: Add the drained spaghetti to the skillet and toss well to coat in the garlic oil.\r\n          If the pasta looks dry, add a splash of the reserved pasta water to loosen it up.\r\n          4. Season and Garnish: Taste and season with salt as needed.\r\n          Garnish with fresh parsley and grated Parmesan cheese, if desired.\r\n          5. Serve: Serve hot with a drizzle of olive oil for extra flavor.', 11, 6),
('Pizza', 'maincourse', 'DishDiscoveries/676ea69e84593-Pizza.jpg', 'DishDiscoveries/676ea69e84272-Pizza1.jpg', 'Pizza is a baked dish of flatbread dough topped with tomato sauce, cheese, and other ingredients.', 'Flour cheese yeast oil', '2 1/4 teaspoons (1 packet) active dry yeast •1 teaspoon sugar •3/4 cup warm water (110°F or 45°C) •2 cups all-purpose flour •1 teaspoon salt •2 tablespoons olive oil •1/2 cup pizza sauce (store-bought or homemade) •1 1/2 cups shredded mozzarella cheese •Your choice of toppings (pepperoni, veggies, mushrooms, olives, etc.) •1 teaspoon dried oregano or Italian seasoning', '1. Make the Dough: In a small bowl, combine warm water, yeast, and sugar. Let it sit for 5-10 minutes until frothy. In a large mixing bowl, combine flour and salt. Add the yeast mixture and olive oil. Mix until a dough forms, then knead on a floured surface for about 5-7 minutes until smooth and elastic. Place the dough in a lightly greased bowl, cover with a clean towel, and let it rise for 1 hour or until it doubles in size. 2. Preheat Oven: Preheat your oven to 475°F (245°C). Place a pizza stone or baking sheet in the oven to heat up. 3. Roll Out the Dough: Punch down the risen dough and roll it out on a floured surface into a 12-inch circle. Transfer the rolled dough to a piece of parchment paper for easy handling. 4. Add Sauce and Toppings: Spread pizza sauce evenly over the dough, leaving a small border for the crust. Sprinkle mozzarella cheese over the sauce. Add your favorite toppings and sprinkle with oregano or Italian seasoning. 5. Bake the Pizza: Carefully slide the parchment paper with the pizza onto the preheated stone or baking sheet. Bake for 10-12 minutes or until the crust is golden and the cheese is bubbly and slightly browned. 6. Serve: Let the pizza cool for a minute, slice it up, and enjoy!', 12, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `id` int(11) NOT NULL,
  `reviewtitle` text NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`id`, `reviewtitle`, `rating`, `review`, `created_at`, `user_id`) VALUES
(0, 'Pizza Recipe', 4, 'Your recipe was amazing.', '2024-12-29 08:35:16', 3),
(0, 'Finger Fish ', 5, 'Recipe was good.', '2024-12-29 08:50:42', 3),
(0, 'Macroni', 3, 'Amazing', '2024-12-29 08:53:21', 3),
(0, 'Breakfast Wrap', 5, 'Amazing.', '2024-12-29 09:10:15', 4),
(0, 'Loaded Fries Review', 5, 'Yummy!\r\n', '2025-01-02 08:43:37', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`ID`, `FirstName`, `LastName`, `Email`, `Phone`, `Gender`, `Password`) VALUES
(3, 'Sana', 'Rao', 'sana2000@gmail.com', '03065454555', 'Female', '$2y$10$ELwOr13qkhTGZFmD54fpHug9WbZdsYSfoAR7nDYpS7x4UU7Rj/TnW'),
(4, 'Azlan', 'Rao', 'azlan@gmail.com', '03065454555', 'Male', '$2y$10$BJK2imo..2dyNDXNnpC4PeUDOFjbV9Gp9h6XTUET4KhisK6xk/3sG'),
(5, 'Haseeb', 'Ashraf', 'haseebrao1996@gmail.com', '03077131298', 'Male', '$2y$10$x6fU8aEeUdtDyjHg2Vr.feoAfwfYeHbpeUvpzkGHmvGFbr1T0SIPW'),
(6, 'Ambreen', 'Akhtar', 'ambreenambi04@gmail.com', '03316272003', 'Female', '$2y$10$O33A1E/7geQqC5nN1tF.xeXgShKMCj3Ir74vzanAnAXijTxDnaqOS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_contactus`
--
ALTER TABLE `tbl_contactus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_dessertreviews`
--
ALTER TABLE `tbl_dessertreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_recipesharing`
--
ALTER TABLE `tbl_recipesharing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recipetitle` (`recipetitle`(255));

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_contactus`
--
ALTER TABLE `tbl_contactus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_dessertreviews`
--
ALTER TABLE `tbl_dessertreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_recipesharing`
--
ALTER TABLE `tbl_recipesharing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
