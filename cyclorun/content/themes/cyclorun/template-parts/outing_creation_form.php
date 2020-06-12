<?php
get_header();
?>

<main class="outing-reg"> 
        <section class="outing-reg__organisation">
            <h1 class="outing-reg__organisation__page__title">Envie d'organiser une sortie ? Vous êtes au bon endroit ! </h1>
        </section>
        <div class="adviseForm">
                <img class="adviseForm__img" src="https://img.icons8.com/metro/26/000000/box-important.png"/>
                <p><span>*</span> Champs obligatoires - <span>**</span>  Choisir un sport et son niveau</p>                
        </div>
        <form class="outing-reg__creation" action="" method="post" enctype="multipart/form-data">            
            <div class="outing-reg__title">
                <label for="outing_name">Nom de la sortie <span>*</span></label>
                <input class="outing-reg__input__name" type="text" id="outing_name" name="outing_name" placeholder="ex : Balade autour du lac d'Annecy">
            </div>
            <div class="outing-reg__top__form">
                <div class="outing-reg__left">
                    <div class="outing-reg__rdv">
                      <div class="outing-reg__date">
                        <label for="date">Date <span>*</span></label>
                        <input  class="outing-reg__input__date" type="date" id="date" name="date">
                      </div>
                      <div class="outing-reg__time">
                        <label for="hour">Choix de l'heure <span>*</span></label>
                        <input class="outing-reg__input__time" type="time" id="hour" name="time">
                      </div>
                    </div>
                    <div class="outing-reg__length">
                        <label for="distance">Distance du parcours <span>*</span></label>
                        <input class="outing-reg__input__length" type="number" id="length" name="distance" placeholder=" en km">
                    </div>
                    <div class="outing-reg__location">
                        <label for="address">Lieu de Rendez-vous <span>*</span></label>
                        <input class="outing-reg__input" type="text" id="address" name="address" placeholder=" ne pas oublier le code postal">
                    </div>
                </div>
                <div class="outing-reg__practice">
                    <div>
                        <input class="outing-reg__input__radio" type="radio" id="cycling" name="practiced_sport" value="1">
                        <label for="cycling">Vélo <span>**</span></label>
                    </div>
                        <!-- Select à afficher uniquement si le bouton est coché - A voir en JS-->
                    <select class=" outing-reg__select" name="cycling_level">
                        <option class="default__select"value="" selected>Niveau de la sortie</option>
                        <option value="1">Loisirs (-15km)</option>
                        <option value="2">Régulier (15-30km)</option>
                        <option value="3">Avancé (30-60km)</option>
                        <option value="4">Intensif (+60km)</option>
                    </select>
                    <div>
                        <input class="outing-reg__input__radio" type="radio" id="running" name="practiced_sport" value="2">
                        <label for="running">Course à pied <span>**</span></label>
                    </div>
                        <!-- Select à afficher uniquement si le bouton est coché-->
                    <select class="outing-reg__select" name="running_level">
                        <option value="" selected>Niveau de la sortie</option>
                        <option value="11">Loisirs (-5km)</option>
                        <option value="12">Régulier (5-10km)</option>
                        <option value="13">Avancé (10-15km)</option>
                        <option value="14">Intensif (+15km)</option>
                    </select>
                </div>    
                <div class="outing-reg__image">
                    <label for="outing-image">Photo de votre choix</label>
                    <input class="outing-reg__input__picture" type="file" id="image" name="picture" alt="image du parcours" src="">
                </div>
            </div>
            <div class="outing-reg__description">
                <label for="description">Description de la sortie</label>
                <textarea class="outing-reg__input" name="description" id="description" cols="30" rows="5" placeholder=""></textarea>
            </div>
            <div class="outing-reg__course">
            </div>
            <div class="outing-reg__submit">
                <input class="outing-reg__input__submit" type="submit" value="Valider la sortie">
            </div>
        </form>
