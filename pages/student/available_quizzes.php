           <?php
            require_once '../../config/database.php';
            require_once '../../classes/Database.php';

            require_once '../../classes/Category.php';

            $id = $_GET["id"];
            $quizCat = new category();
            $dataQuizzes = $quizCat->getQuizzes($id);
            $titre = $quizCat->getCatTitre($id);
            ?>
           <!-- Category Quizzes List -->
           <?php include '../partials/header.php'; ?>
           <div id="categoryQuizzes" class="student-section ">
               <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white">
                   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                       <button class="text-white hover:text-green-100 mb-4">
                           <a href="dashboard.php"> <i class="fas fa-arrow-left mr-2"></i>Retour aux catégories</a>
                       </button>
                       <?php foreach ($titre as $titre): ?>
                           <h1 class="text-4xl font-bold mb-2" id="categoryTitle"><?= $titre['nom'] ?></h1>
                       <?php endforeach ?>
                       <p class="text-xl text-green-100">Sélectionnez un quiz pour commencer</p>
                   </div>
               </div>

               <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                   <div id="quizListContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                       <!-- Quiz cards will be loaded dynamically -->
                       <?php
                        // Sample data arrays
                        $colors = ['blue', 'green', 'purple', 'pink', 'indigo', 'red', 'yellow', 'teal'];
                        $logos = ['fas fa-question-circle', 'fas fa-brain', 'fas fa-book', 'fas fa-graduation-cap', 'fas fa-lightbulb', 'fas fa-puzzle-piece', 'fas fa-trophy', 'fas fa-star'];

                        // Loop through your quiz data
                        foreach ($dataQuizzes as $index => $quiz):
                            $color = $colors[$index % count($colors)];
                            $logo = $logos[$index % count($logos)];
                        ?>
                           <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group cursor-pointer">

                               <!-- Header Section with Gradient -->
                               <div class="bg-gradient-to-br from-<?= $color ?>-500 to-<?= $color ?>-600 p-6 text-white">
                                   <i class="<?= $logo ?> text-4xl mb-3"></i>
                                   <h3 class="text-xl font-bold"><?= $quiz['titre'] ?></h3>
                               </div>

                               <!-- Content Section -->
                               <div class="p-6">
                                   <p class="text-gray-600 mb-4"><?= $quiz['description'] ?></p>

                                   <!-- Footer Info -->
                                   <div class="flex justify-between items-center text-sm">
                                       <div class="flex gap-4">
                                           <span class="text-gray-500">
                                               <i class="fas fa-question mr-2"></i><?= $quiz['total_questions'] ?> Questions
                                           </span>
                                           <!-- <span class="text-gray-500">
                                               <i class="fas fa-clock mr-2"></i><= $quiz['duration'] ?> min
                                           </span> -->
                                       </div>
                                       <a href="quiz_details.php?id=<?= $quiz['id'] ?>"
                                           class="text-<?= $color ?>-600 font-semibold group-hover:translate-x-2 transition-transform">
                                           Start Quiz →
                                       </a>
                                   </div>
                               </div>
                           </div>
                       <?php endforeach; ?>

                       <!-- Optional: Grid Container (wrap your cards with this) -->
                       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                           <!-- Your cards go here -->
                       </div>
                   </div>
               </div>
           </div>