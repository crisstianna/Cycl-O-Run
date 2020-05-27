<?php 
/**
 * Template Name: Register-Form-Template
 */

 get_header(); ?>

<h1>Connexion</h1>
<form class="connexion" method="post">
  <div class="form-group connexion__email">
    <label for="exampleInputEmail1">Adresse mail</label>
    <input class="form-control connexion__email__input" id="exampleInputEmail1" aria-describedby="emailHelp" name="user_email">
  </div>
  <div class="form-group connexion__password">
    <label exampleInputPassword1">Mot de passe</label>
    <input type="password" class="form-control connexion__password__input" id="exampleInputPassword1"name="user_pass">
  </div>
  <!-- A rajouter lorsque nous gérerons la gestion du mdp oublié
    <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1"></label>
    <small id="emailHelp" class="form-text text-muted">Informations de connexion oubliées ?</small>
  </div> 
  -->
  <button type="submit" class="btn btn-primary connexion__button">CONNEXION</button>
  <a class="btn btn-primary" href="#" role="button">S'INSCRIRE</a>
</form>

<?php get_footer();