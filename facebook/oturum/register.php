
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap demo</title>
	<!-- Bootstrap Css-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<!-- style.css -->
	<link rel="stylesheet" href="style.css">
</head>

<body class="">
	<!-- Header -->
	<?php include("../inc/header.php"); ?>
	<!-- Header -->
	<!-- Main -->
	<main>
		<div class="container mt-5">
			<?php
			if (
				isset($_POST["kullanici_adi"], $_POST["email"], $_POST["parola"]) &&
				($_POST["kullanici_adi"] === '' || $_POST["email"] === '' || $_POST["parola"] === '')
			) {
			?>
				<div class="alert alert-danger" role="alert">
					Lütfen boş alan bırakmayınız.
				</div>
			<?php } ?>
			<form class="row g-3" method="post">
				<div class="col-6">
					<label for="" class="mb-2">İsim</label>
					<input type="text" name="isim" class="form-control" placeholder="İsim" aria-label="Başlık">
				</div>
				<div class="col-6">
					<label for="" class="mb-2">Soy İsim</label>
					<input type="text" name="soyisim" class="form-control" placeholder="Soy İsim" aria-label="Başlık">
				</div>
				<div class="col-6">
					<label for="" class="mb-2">Kullanıcı Adı</label>
					<input type="text" name="kullanici_adi" class="form-control" placeholder="Kullanıcı Adı" aria-label="Başlık">
				</div>
				<div class="col-6">
					<label for="" class="mb-2">E-posta</label>
					<input type="email" name="eposta" class="form-control" placeholder="e-posta" aria-label="Başlık">
				</div>
				<div class="col-6">
					<label for="" class="mb-2">Parola</label>
					<input type="password" name="parola" class="form-control" placeholder="Parola" aria-label="Başlık">
				</div>
				<div class="col-6">
					<label for="" class="mb-2">Doğum tarihi</label>
					<input type="date" name="dogum_tarihi" class="form-control" placeholder="Doğum tarihi" aria-label="Başlık">
				</div>
				<div class="col-12">
					<button type="submit" name="kayitol" class="btn btn-primary">Kayit Ol</button>
				</div>
			</form>
		</div>
	</main>
	<!-- Main -->


	<!-- Bootstrap Script -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>