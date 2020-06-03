<?php

/*
Template Name: Outing Details 
*/

get_header();

if(! is_user_logged_in()){
    // retrieving the id of the custom home page
    $login = get_permalink(5);
    //automatic redirection
    header("Location: $login");
}

?>

<main class="details">
    <div class="details__header">
      <img class="details__header__img" src="images/avatar.png" alt="">
      <h2 class="details__header__title">Détails de la sortie</h2>
    </div>
    <div class="details__content">
      <section class="details__content__informations">
        <h3 class="details__content__informations__title">Titre de la sortie</h3>
        <p class="details__content__informations__date">Date</p>
        <div class="details__content__informations__author">
          <h3 class="details__content__informations__author__title">Sortie proposée par :</h3>
          <img src="images/avatar.png" alt="" class="details__content__informations__author__img">
          <p class="details__content__informations__author__pseudo">pseudo de l'organisateur</p>
        </div>
        <div class="details__content__informations__practice">
          <div class="details__content__informations__practice__div">
            <h4 class="details__content__informations__practice__div__choice">Activité</h4>
            <img src="images/Running.svg" alt="" class="details__content__informations__practice__div__svg">
            <img src="images/Cycling.svg" alt="" class="details__content__informations__practice__div__svg">
          </div> 
          <div class="details__content__informations__level">
            <h4 class="details__content__informations__level__choice">Niveau</h4>
            <p class="details__content__informations__level_selected">Confirmé</p>
          </div>  
        </div>
        <div class="details__content__informations__rdv">
          <h4 class="details__content__informations__rdv__title">Lieu de Rendez-vous</h4>
          <p class="details__content__informations__rdv__adress">85 place de la rose trémière, 77900 Cesson sur issole</p>
        </div>
        <div class="details__content__informations__description">
          <h4 class="details__content__informations__description__title">DESCRIPTION</h4>
          <p class="details__content__informations__description__text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam nostrum repudiandae eaque, hic cupiditate minima tempore dolorum minus atque similique itaque voluptatem, debitis quisquam dignissimos incidunt totam veniam laudantium.</p>
        </div>
      </section>
      <aside class="details__content__map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d46603.441767461125!2d5.850215753874818!3d43.110501634411385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e1!4m5!1s0x12c91b0fd79f6773%3A0x3524575272a0b303!2sPlace%20de%20la%20Libert%C3%A9%2C%2083000%20Toulon!3m2!1d43.1259535!2d5.9306111999999995!4m5!1s0x12c90160c00be73b%3A0x40819a5fd8fc8b0!2sSix-Fours-les-Plages!3m2!1d43.093061999999996!2d5.839225!5e0!3m2!1sfr!2sfr!4v1590561716077!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <button class="details__content__map__button"><a class="details__content__map__button__content" href="RETOUR VERS PAGE PROFILE OU HOME PERSO">Je participe</a></button>
      </aside>
    </div>
  
  </main>

