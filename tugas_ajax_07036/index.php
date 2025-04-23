<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Live Search Mahasiswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    #loading {
      display: none;
    }

    #search {
      border-radius: 0.5rem;
    }

    thead {
      background-color: #0d6efd;
      color: white;
    }

    table tr td {
      vertical-align: middle;
    }
  </style>
</head>
<body class="p-4">
  <div class="container">
    <div class="card p-4">
      <h3 class="mb-4 text-center">🔍 Live Search Mahasiswa(AJAX + MySQL)</h3>

      <input type="text" id="search" class="form-control mb-3 shadow-sm" placeholder="Cari berdasarkan nama, NIM, atau jurusan...">

      <!-- Spinner Bootstrap -->
      <div id="loading" class="text-center my-3">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <p class="text-muted mt-2">Sedang mencari data...</p>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped mb-0">
          <thead>
            <tr>
              <th>NIM</th>
              <th>Nama</th>
              <th>Jurusan</th>
            </tr>
          </thead>
          <tbody id="result"></tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    const searchBox = document.getElementById("search");
    const result = document.getElementById("result");
    const loading = document.getElementById("loading");

    searchBox.addEventListener("keyup", function () {
      const keyword = searchBox.value.trim();
      if (keyword.length === 0) {
        result.innerHTML = "";
        return;
      }

      loading.style.display = "block";

      fetch("search.php?keyword=" + encodeURIComponent(keyword))
        .then(res => res.json())
        .then(data => {
          setTimeout(() => {
            loading.style.display = "none";
            result.innerHTML = "";

            if (data.length === 0) {
              result.innerHTML = "<tr><td colspan='3' class='text-center text-muted'>Data tidak ditemukan</td></tr>";
            } else {
              data.forEach(row => {
                const rowHtml = `<tr style="display: none">
                  <td>${row.nim}</td>
                  <td>${row.nama}</td>
                  <td>${row.jurusan}</td>
                </tr>`;
                result.insertAdjacentHTML('beforeend', rowHtml);
                $('#result tr:last-child').fadeIn(300);
              });
            }
          }, 200);
        });
    });
  </script>
</body>
</html>
