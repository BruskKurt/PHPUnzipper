<?php 
/* 
PHPUnzipper - Unzip your files with PHP ! 
This little tool let you unzip files when you don't have an SSH access to your host server.

PHPUnzipper -Dézipper vos fichiers avec PHP !
Ce petit outil vous permet de dezipper vos fichiers lorsque vous n'avez pas d'accès SSH sur votre serveur.

Feel free to donate at / N'hésitez pas à faire une donation : https://www.paypal.me/KurtBrusk
*/

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>PHPUnzipper - Décompressez vos fichiers via PHP!</title>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified JavaScript -->
	
</head>
<body>
	<header>
		<nav class="light-blue lighten-1" role="navigation">
			<div class="nav-wrapper container"><span id="logo-container" class="brand-logo">PHPUnzipper</span>
				<ul class="right hide-on-med-and-down">
					<li><a href="http://twitter.com/bruskkurt" target="_blank">par @BruskKurt</a></li>
					<li><a href="https://www.paypal.me/KurtBrusk" target="_blank">Faire une donation</a></li>
				</ul>

				<ul id="nav-mobile" class="side-nav">
					<li><a href="https://www.paypal.me/KurtBrusk" target="_blank">Faire une donation</a></li>
					<p class="versionMobile">PHPUnzipper - Version 1.0</p>
				</ul>
				<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
			</div>
		</nav>
	</header>
	
	<main>
		<div class="mainWrap section no-pad-bot" id="index-banner">
			<div class="container">
			<div class="row">
        <div class="col s12">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Let's get started.</span>
              <p>Bienvenue sur PHPUnzipper! Avant de démarrer, je vous invite à prendre en compte ces deux petites choses:<br />

						- <b>Déplacez ce fichier dans le même dossier</b> que votre fichier ZIP. (nécessaire pour fonctionner)<br />
						- Une fois que vous avez terminé d'utiliser PHPUnzipper, veuillez <b>supprimer le fichier</b> pour des questions de sécurité (évitez qu'un rigolo ne s'amuse à décompresser x fois partout)<br /><br />

						<i>Si vous avez des suggestions pour améliorer l'outil, n'hésitez pas à utiliser le lien "Suggérer une amélioration" dans le footer. Merci!</i></p>
            </div>
          </div>
        </div>
      </div>



					<form class="col s12" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<div class="row">
							<div class="input-field col l6 m6 s12">
								<select name="file">
									<option value="" disabled selected>Sélectionnez un fichier zip</option>
									<?php 
									foreach (glob("*.zip") as $filename) {
										echo '<option value="' . $filename . '">' . $filename . '</option> <br />';
									}
									?>
								</select>
								<label>Sélectionnez le fichier zip</label>
							</div>
							<div class="input-field col l6 m6 s12">
								<select name="folder">
									<option selected value="b5c0b187fe309af0f4d35982fd961d7e">Même dossier que le fichier</option>
									<?php 
									$dirs = array_filter(glob('*'), 'is_dir');
									foreach ($dirs as $folder) {
										echo '<option value="' . $folder . '">' . $folder . '</option> <br />';
									}
									?>
								</select>
								<label>Sélectionnez le dossier de destination</label>
							</div>

							<p class="submitbtn"><input type="submit" name="magic" class="waves-effect waves-light btn" value="Décompresser" /></p>
							<br />
						</div> 	
					</form>
					<?php 

					if(isset($_POST['magic'])){
						$file = $_POST['file'];
						$path = $_POST['folder'];

						if($path == "b5c0b187fe309af0f4d35982fd961d7e"){
							$path = pathinfo(realpath($file), PATHINFO_DIRNAME);
						}	

						if($file == ""){
							echo "Vous n'avez pas choisis de fichier zip. Veuillez recommencez...";
						}
						else{
							echo "<h6>Traitement des données envoyées...</h6>";
							echo "<h6>Le contenu de l'archive $file est en train d'être décompressé dans : $path</h6>";

							$zip = new ZipArchive;
							$res = $zip->open($file);

							if($res === TRUE){
								$zip->extractTo($path);
								$zip->close();
								echo "<h6>Great ! Le contenu de  $file est désormais disponible dans :  $path ! Have fun :-)</h6>";
							}
							else{
								echo "<h6>OH MON DIEU! Il y a eu une erreur. Normalement il n'y a jamais d'erreur si vous n'avez pas bidouillé (j'ai pas sécurisé le script ^^). Si ce message s'affiche alors que vous n'avez pas votre hacker, n'hésitez pas à me contacter pour me faire remonter le bug : hello@brusk.me </h6>";
							}			
						}


					}


					?>
				</div>
			</div>
		</div>
		</main>


		<footer class="page-footer light-blue lighten-1">
			<div class="container">
				<div class="row">
					<div class="col l9 s12">
						<h5 class="white-text">PHPUnzipper</h5>
						<p class="grey-text text-lighten-4">
							PHPUnzipper est un petit outil vous permettant de décompresser un fichier sur votre serveur.
							L'utilité de PHPUnzipper est de palier à l'absence d'un accès SSH à votre serveur pour vous permettre de décompresser
							un fichier zip avec seulement un accès FTP.<br /><br /><br />
						</p>
					</div>
					<div class="col l3 s12">
						<h5 class="white-text">Actions</h5>
						<ul>
							<li><a class="white-text" href="https://brusk.me/phpunzipper-decompressez-vos-zip-via-ftp-ssh/" target="_blank">Lien de l'article</a></li>
							<li><a class="white-text" href="http://disq.us/t/2bsw4ud" target="_blank">Suggérer une amélioration</a></li>
							<li><b>Version de PHPUnzipper : 1.0</b></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					PHPUnzipper par <a class="black-text text-lighten-3" href="http://twitter.com/bruskkurt" target="_blank">@BruskKurt</a>.
				</div>
			</div>
		</footer>

		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
		<script>
			$(document).ready(function() {
				$('select').material_select();
				 $('.button-collapse').sideNav();
			});
		</script>

		<style>
			body {
				display: flex;
				min-height: 100vh;
				flex-direction: column;
				background: #67777d;
			}

			main {
				flex: 1 0 auto;
			}

			.mainWrap{
				background: white;
			}
			.info{
				padding-bottom: 15px;
				margin-bottom: 70px;
			}
			.submitbtn{
				text-align: center;

			}
			.versionMobile{
				text-align: center;
				color:black;
			}
		</style>



	</body>
	</html>
