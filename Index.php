<?php
require_once 'admin/config.php';
$buku_terbaru = $conn->query("SELECT * FROM buku ORDER BY id DESC LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lentera Aksara</title>
        
        <!-- bootsrtap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="assets/css/style.css">
        <script src="assets/js/script.js"></script>
    </head>

    <body id="body">
        <header>
            <nav class="navbar navbar-expand-sm bg-light navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="assets/images/logo.png" alt="Logo" style="width: 100px;">
                    </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                   
              
                <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                <!-- Bootstrap -->
                 <ul class="navbar-nav ms-auto d-flex flex-row gap-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#Dashboard">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#Koleksi">Koleksi</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#Katalog">Katalog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#Kategori">Kategori</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#Rekomendasi">Rekomendasi</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#Profil">Profil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#TentangKami">Tentang Kami</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#Kontak">Kontak</a>
                    </li>
                 </ul>
                </div>
                </div>
            </nav>
        </header> 

        <main>
            <!-- Section 1 -->
            <section id="Dashboard" class="py-5">
                <div class="container-fluid px-0">
                    <h2>Dashboard</h2>
                    <div class="card text-white">
                        <img class="card-img object-fit-cover" src="assets/images/Background.png" alt="Backgorund">
                        <div class="card-img-overlay">
                            <h5 class="display-4 fw-bold">Lentera Aksara</h5>
                            <p class="lead mb-4">Lentera Aksara: website company profile perpustakaan digital</p>
                    

                        <form class="d-flex w-50 bg-white rounded-pill shadow" role="search" style="max-width: 500px;">
                        
                            <input class="form-control border-0 rounded-pill px-4" type="search" placeholder="Search" aria-label="Search">
                        <button type="" class="btn btn-primary rounded-pill px-4">🔍
                        </button>
                        </form>
                    </div>
                    </div>
                </div>
            </section>

            <!-- Section 2 -->
            <section id="Koleksi">
                <div>
                    <h2>Koleksi</h2>
              
                <div class="row">
                <div class="col-sm-6">
                    <h2>BUKU FILSAFAT</h2>
                    <div class="card" style="width: 400px;">
                        <img class="card-img-top" src="assets/images/madilog.jpeg" alt="Madilog" style="width: 100%;">
                        <div class="card-body">
                            <h4 class="card-title">Madilog</h4>
                            <p class="card-text">Madilog (singkatan dari Materialisme, Dialektika, dan Logika) adalah magnum opus karya Tan Malaka. Diterbitkan pada tahun 1951, buku ini merupakan panduan berpikir rasional dan ilmiah yang bertujuan untuk membebaskan bangsa Indonesia dari 
                                cara berpikir feodal, takhayul, dan "logika mistika" agar mampu mandiri serta merdeka seutuhnya</p>
                            <a href="https://rowlandpasaribu.wordpress.com/wp-content/uploads/2013/09/tan-malaka-madilog.pdf" target="_blank" class="btn btn-primary">Detail Buku</a>
                        </div>
                    </div>
                </div>

                    <div class="col-sm-6">
                        <h2>NOVEL</h2>
                        <div class="card" style="width: 400px;">
                            <img class="card-img-top" src="assets/images/dearNathan.jpg" alt="dearNathan" style="width: 100%;">
                            <div class="card-body">
                                <h4 class="card-title">Dear Nathan</h4>
                                <p class="card-text">Dear Nathan adalah novel remaja populer karya Erisca Febriani yang kemudian diadaptasi menjadi film laris Indonesia. Ceritanya berfokus pada dinamika 
                                    asmara antara Salma, siswi teladan yang kaku, dan Nathan, siswa berandalan namun berhati lembut, yang saling mengubah hidup satu sama lain</p>
                                <a href="https://www.scribd.com/document/440175526/Dear-Nathan-Erisca-Febrian-pdf" target="_blank" class="btn btn-primary">Detail Buku</a>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section terbaru -->
            <section id="KoleksiTerbaru" class="py-4">
    <div class="container">
        <h2>Koleksi Terbaru</h2>
        <div class="row">
            <?php if ($buku_terbaru->num_rows > 0): ?>
                <?php while ($row = $buku_terbaru->fetch_assoc()): ?>
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="card h-100">
                            <?php 
                            // Cek apakah file gambar ada
                            $gambarPath = "uploads/" . $row['gambar'];
                            if (!empty($row['gambar']) && file_exists($gambarPath)) {
                                $imgSrc = $gambarPath;
                            } else {
                                $imgSrc = "assets/images/logo.png"; // gunakan logo yang pasti ada
                            }
                            ?>
                            <img src="<?= $imgSrc ?>" class="card-img-top" alt="<?= htmlspecialchars($row['judul']) ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['judul']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars(substr($row['deskripsi'], 0, 100)) ?>...</p>
                                <p class="card-text"><small class="text-muted">Kategori: <?= ucfirst($row['kategori']) ?></small></p>
                                <a href="#" class="btn btn-primary btn-sm">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-muted">Belum ada buku di database.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

            <!-- Section 3 -->
            <Section id="Katalog">
                <div>
                    <h2>Katalog</h2>
              
                <div class="row">
                <div class="col-sm-6">
                    <h2>BUKU FILSAFAT</h2>
                    <div class="card" style="width: 400px;">
                        <img class="card-img-top" src="assets/images/madilog.jpeg" alt="Madilog" style="width: 100%;">
                        <div class="card-body">
                            <h4 class="card-title">Madilog</h4>
                            <p class="card-text">Penulis : Tan Malaka</p>
                            <p class="card-text">Tahun Terbit: 1951</p>
                            <p class="card-text">Madilog (singkatan dari Materialisme, Dialektika, dan Logika) adalah magnum opus karya Tan Malaka. Diterbitkan pada tahun 1951, buku ini merupakan panduan berpikir rasional dan ilmiah yang bertujuan untuk membebaskan bangsa Indonesia dari 
                                cara berpikir feodal, takhayul, dan "logika mistika" agar mampu mandiri serta merdeka seutuhnya</p>
                        </div>
                    </div>
                    </div>


                    <div class="col-sm-6">
                        <h2>NOVEL</h2>
                        <div class="card" style="width: 400px;">
                            <img class="card-img-top" src="assets/images/dearNathan.jpg" alt="dear Nathan" style="width: 100%;">
                            <div class="card-body">
                                <h4 class="card-title">Dear Nathan</h4>
                                <p class="card-text">Penulis : Erisca Febriani</p>
                                <p class="card-text">Tahun Terbit : 2016</p>
                                <p class="card-text">Dear Nathan adalah novel remaja populer karya Erisca Febriani yang kemudian diadaptasi menjadi film laris Indonesia. Ceritanya berfokus pada dinamika 
                                    asmara antara Salma, siswi teladan yang kaku, dan Nathan, siswa berandalan namun berhati lembut, yang saling mengubah hidup satu sama lain</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </Section>


              <!-- Section 4 -->
              <Section id="Kategori">
                <div>
                    <h2>Kategori</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-body">
                                <img class="rounded float-start" src="assets/images/filsafat.jpg" alt="filsafat" style="width: 100%;">
                                <p class="card-text">FILSAFAT</p>
                            </div>
                        </div>
                  

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body"></div>
                            <img class="rounded float-end" src="assets/images/novel.png" alt="novel" style="width: 100%;">
                            <p class="card-text">NOVEL</p>
                        </div>
                    </div>
                </div>

                </div>


            <!-- Section 5 -->
            <Section id="Rekomendasi">
                <div>
                    <h2>Rekomendasi</h2>

                    <div class="box">
                        <h3>Laskar Pelangi</h3>
                        <img src="assets/images/Laskar Pelangi.jpg" alt="Laskar Pelangi">
                        <div class="star-rating">
                            <input type="radio" id="laskar-star5" name="rating-laskar" value="5">
                            <label for="laskar-star5" class="star">⭐</label>

                            <input type="radio" id="laskar-star4" name="rating-laskar" value="4">
                            <label for="laskar-star4" class="star">⭐</label>

                            <input type="radio" id="laskar-star3" name="rating-laskar" value="3">
                            <label for="laskar-star3" class="star">⭐</label>

                            <input type="radio" id="laskar-star2" name="rating-laskar" value="2">
                            <label for="laskar-star2" class="star">⭐</label>

                            <input type="radio" id="laskar-star1" name="rating-laskar" value="1">
                            <label for="laskar-star1" class="star">⭐</label>

                            <span class="rating-value" id="laskar-rating-value"></span>
                        </div>
                        <a href="https://online.fliphtml5.com/imzvb/nbmi/#p=2" target="_blank" class="btn btn-primary">Detail Buku</a>
                    </div>
                </div>

            </Section>


             <!-- Section 6 -->
             <Section id="Profil">
                <div class="hero-kiri">
                    <h2>Profil</h2>
                    <p>Saya Adalah Mahasiswa Informatika di Universitas Internasional Semen Indonesia. Sekarang saya semester 4 dan sedang mengerjakan UTS Pemrograman</p>
                </div>

                <div class="hero-kanan">
                    <img src="assets/images/profil.jpeg" width="512" height="256">
                </div>
                </Section>


             <!-- Section 7 -->
             <Section id="TentangKami">
                <div>
                    <h2>Tentang Kami</h2>
                    <p>Lentera Aksara adalah perpustakaan digital yang hadir untuk memberikan kemudahan akses literasi bagi semua kalangan. Kami menyediakan berbagai koleksi buku, novel, dan bacaan edukatif yang dapat membantu pengguna memperluas wawasan serta meningkatkan minat membaca.</p>
                    <p>Kami percaya bahwa membaca adalah jendela dunia, dan melalui Lentera Aksara kami ingin menjadi cahaya bagi generasi masa depan.</p>
                </div>

            </Section>


            <!-- Section 8 -->
            <Section id="Kontak">
                <div class="container mt-3">
                    <h2>Kontak</h2>
                    <form action="#">
                        <div class="mb-3 mt-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                        </div>

                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember">Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </Section>
        </main>        


    </body>
</html>