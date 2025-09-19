<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Directory</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=IM+Fell+English&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { font-family: 'IM Fell English', serif; background-color: #fae5b3; }
    .font-title { font-family: 'Cinzel Decorative', cursive; letter-spacing: 2px; }
    .btn-hover:hover { box-shadow: 0 0 12px gold, 0 0 24px crimson; transform: scale(1.05); }
  </style>
</head>
<body class="min-h-screen">

  <!-- Header -->
  <nav class="bg-gradient-to-r from-red-900 via-yellow-700 to-red-800 shadow-lg border-b-4 border-yellow-600">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-yellow-200 font-title text-2xl flex items-center gap-2">
        <i class="fa-solid fa-hat-wizard"></i> Student Directory
      </h1>
    </div>
  </nav>

  <!-- Content -->
  <div class="max-w-6xl mx-auto mt-10 px-4">
    <div class="bg-yellow-50 shadow-xl rounded-xl p-6 border-4 border-yellow-700">

      <!-- Top Actions -->
      <div class="flex justify-between items-center mb-6">
        <!-- Search -->
        <form action="<?=site_url('users')?>" method="get" class="flex gap-2">
          <input type="text" name="search" value="<?=html_escape($search)?>"
                 placeholder="Search student..."
                 class="px-3 py-2 rounded-lg border-2 border-yellow-700 focus:ring-2 focus:ring-red-700 w-64">
          <button type="submit"
                  class="btn-hover bg-yellow-700 text-white px-4 py-2 rounded-lg">
            <i class="fa-solid fa-magnifying-glass"></i> Search
          </button>
        </form>

        <!-- Add Button -->
        <a href="<?=site_url('users/create')?>"
           class="btn-hover inline-flex items-center gap-2 bg-gradient-to-r from-red-700 to-yellow-600 text-white font-bold px-5 py-2 rounded-lg shadow-md transition-all duration-300">
          <i class="fa-solid fa-user-plus"></i> Add New Student
        </a>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto rounded-xl border-4 border-yellow-700">
        <table class="w-full text-center border-collapse">
          <thead>
            <tr class="bg-gradient-to-r from-red-800 to-yellow-700 text-yellow-100 uppercase tracking-wider hp-title text-lg">
              <th class="py-3 px-4">ID</th>
              <th class="py-3 px-4">Lastname</th>
              <th class="py-3 px-4">Firstname</th>
              <th class="py-3 px-4">Email</th>
              <th class="py-3 px-4">Action</th>
            </tr>
          </thead>
          <tbody class="text-gray-900 text-sm" style="font-family:'IM Fell English', serif;">
            <?php if(!empty($users)): ?>
              <?php foreach(html_escape($users) as $user): ?>
                <tr class="hover:bg-yellow-200 transition duration-200">
                  <td class="py-3 px-4 font-medium"><?=($user['id']);?></td>
                  <td class="py-3 px-4"><?=($user['last_name']);?></td>
                  <td class="py-3 px-4"><?=($user['first_name']);?></td>
                  <td class="py-3 px-4"><?=($user['email']);?></td>
                  <td class="py-3 px-4 flex justify-center gap-3">
                    <a href="<?=site_url('users/update/'.$user['id']);?>"
                       class="btn-hover bg-green-700 hover:bg-green-800 text-yellow-100 px-3 py-1 rounded-lg shadow flex items-center gap-1">
                      <i class="fa-solid fa-pen-to-square"></i> Update
                    </a>
                    <a href="<?=site_url('users/delete/'.$user['id']);?>"
                       class="btn-hover bg-red-700 hover:bg-red-900 text-yellow-100 px-3 py-1 rounded-lg shadow flex items-center gap-1">
                      <i class="fa-solid fa-trash"></i> Delete
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="5" class="py-4 text-gray-600">No students found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="flex justify-center mt-6 gap-2">
        <?php for($i = 1; $i <= $total_pages; $i++): ?>
          <a href="<?=site_url('users?page='.$i.'&search='.$search)?>"
             class="px-4 py-2 rounded-lg border-2 <?=($current_page==$i?'bg-yellow-700 text-white border-yellow-700':'bg-white text-yellow-800 border-yellow-600')?> hover:bg-yellow-600 hover:text-white transition-all">
            <?=$i?>
          </a>
        <?php endfor; ?>
      </div>

    </div>
  </div>

</body>
</html>
