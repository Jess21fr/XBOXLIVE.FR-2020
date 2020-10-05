<?php ob_start(); ?>

<div><h1>Inscription sur Xboxlive.fr</h1></div>

<form action="/register-confirm/" method="post">
  <div class="form-group">
  <label for="InputPseudo">Pseudo</label>
  <input type="text" class="form-control" id="InputPseudo" placeholder="Pseudo" name="xlfrnickname" required>

  </div>
  <div class="form-group">
  <label for="InputEmail">Adresse Email</label>
  <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="Entrez votre Email" name="xlfremail" required>

  </div>
  <div class="form-group">
  <label for="InputPassword1">Mot de Passe</label>
  <input type="password" minlength="8" class="form-control" id="InputPassword1" placeholder="Mot de Passe" name="xlfrpassword" required>
    <small id="emailHelp" class="form-text text-muted">Votre mot de passe doit comporter au minimum 8 caractères.</small>
  </div>

    <div class="form-group">
  <div class="g-recaptcha" data-sitekey="6Le8vQETAAAAAHryfCAGIOzU7mKLUx3_AsZxEeme"></div>
  </div>
  <button type="submit" class="btn btn-primary">M'inscrire</button>
</form>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
