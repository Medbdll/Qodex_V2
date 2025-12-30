  <!DOCTYPE html>
  <html lang="fr">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>QuizMaster - Espace Etudiant</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  </head>

  <body class="bg-gray-50">


      <!-- ESPACE Etudiant -->
      <?php
        $currentPage = 'dashboard2';
        require_once '../../config/database.php';
        require_once '../../classes/Database.php';
        require_once '../partials/nav_etudiant.php';
        require_once '../../classes/Category.php';
        $showCategory = new category();
        $dataCategory = $showCategory->getCatCard();
        // print_r($dataCategory);
        ?>
      <!-- ESPACE ÉTUDIANT -->
      <div id="studentSpace" class=" pt-16">

          <!-- Student Dashboard -->
          <div id="studentDashboard" class="student-section">
              <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white">
                  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                      <h1 class="text-4xl font-bold mb-4">Espace Étudiant</h1>
                      <p class="text-xl text-green-100 mb-6">Passez des quiz et suivez votre progression</p>
                  </div>
              </div>

              <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                  <h2 class="text-3xl font-bold text-gray-900 mb-8">Catégories Disponibles</h2>

                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                      <?php
                        $colors = ['blue', 'purple', 'green', 'red', 'yellow', 'pink', 'indigo', 'teal'];
                        $logos = ['fa-solid fa-database', 'fa-regular fa-file-code', 'fa-brands fa-deviantart', 'fa-solid fa-terminal', 'fa-solid fa-microchip', 'fa-solid fa-server'];

                        
                        foreach ($dataCategory as $row => $cate):

                            $color = $colors[$row % count($colors)];
                            $logo = $logos[$row % count($logos)];
                        ?>
                          <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group cursor-pointer">

                              <div class="bg-gradient-to-br from-<?= $color ?>-500 to-<?= $color ?>-600 p-6 text-white">
                                  <i class="<?= $logo ?> text-4xl mb-3"></i>
                                  <h3 class="text-xl font-bold"><?= $cate['nom'] ?></h3>
                              </div>
                              <div class="p-6">
                                  <p class="text-gray-600 mb-4"><?= $cate['description'] ?></p>
                                  <div class="flex justify-between items-center text-sm">
                                      <span class="text-gray-500"><i class="fas fa-clipboard-list mr-2"></i><?= $cate['quiz_q'] ?></span>
                                      <a href="available_quizzes?id=<?= $cate['id'] ?>" class="text-green-600 font-semibold group-hover:translate-x-2 transition-transform">Explorer →</a>
                                  </div>
                              </div>
                          </div>
                      <?php endforeach; ?>

                  </div>

              </div>
          </div>






      </div>
  </body>

  </html>