<?php

/*

    Template Name: Custom Home

*/

if(is_user_logged_in()){
    wp_loginout(home_url());
    
} else {
    header('Location: http://localhost/Projets/projet-cycl-o-run/cyclorun/login/');
}

echo 'Je suis la Home Personalisé';


?>

</article>        
      </div>
    </section>
    <!-- Participation section -->
    <section class="outing">
      <h2 class="outing__title"><em>Prochainement ...... </em>Les sorties auxquelles je participe</h2>
      <div class="outing__section">
        <article class="outing__article">
          <div class="outing__article__image">
            <img class="outing__article__img" src="images/logo-o.png" alt="">
          </div>
          <div>
            <h3 class="outing__article__title">Nom de la sortie</h3>
            <p class="outing__article__date">date</p>
            <p class="outing__article__location">Lieu</p>
            <p class="outing__article__distance">Distance</p>
            <p class="outing__article__level">intensif</p>
            <button class="outing__article__button" type="button">Etat de la sortie</button>
          </div>
        </article>
        <article class="outing__article">
          <div class="outing__article__image">
            <img class="outing__article__img" src="images/logo-o.png" alt="">
          </div>
          <div>
            <h3 class="outing__article__title">Nom de la sortie</h3>
            <p class="outing__article__date">date</p>
            <p class="outing__article__location">Lieu</p>
            <p class="outing__article__distance">Distance</p>
            <p class="outing__article__level">intensif</p>
            <button class="outing__article__button" type="button">Etat de la sortie</button>
          </div>
        </article>
        <article class="outing__article">
          <div class="outing__article__image">
            <img class="outing__article__img" src="images/logo-o.png" alt="">
          </div>
          <div>
            <h3 class="outing__article__title">Nom de la sortie</h3>
            <p class="outing__article__date">date</p>
            <p class="outing__article__location">Lieu</p>
            <p class="outing__article__distance">Distance</p>
            <p class="outing__article__level">intensif</p>
            <button class="outing__article__button" type="button">Etat de la sortie</button>
          </div>
        </article>
      </div>
    </section>
  </main>
  <script src="js/app.js"></script>
</body>
</html>