<?php
get_header();
?>

<main class="outing-reg"> 
        <section class="outing-reg__organisation">
            <h1 class="outing-reg__organisation__page__title">Envie d'organiser une sortie ? Vous êtes au bon endroit ! </h1>
        </section>
        <form class="outing-reg__creation" action="" method="post" enctype="multipart/form-data">            
            <div class="outing-reg__title">
                <input class="outing-reg__input" type="text" id="outing_name" name="outing_name" placeholder="Nom de la sortie">
            </div>
            <div class="outing-reg__top__form">
                <div class="outing-reg__left">
                    <div class="outing-reg__rdv">
                        <label for="hour">Date</label>
                        <input  class="outing-reg__input" type="date" id="date" name="date">
                        <label for="hour">Choix de l'heure</label>
                        <input class="outing-reg__input" type="time" id="hour" name="time">
                    </div>
                    <div class="outing-reg__length">
                        <label for="distance">Distance du parcours</label>
                        <input class="outing-reg__input" type="number" id="length" name="distance" placeholder="Distance (en km)">
                    </div>
                    <div class="outing-reg__location">
                        <label for="address">Lieu de Rendez-vous</label>
                        <input class="outing-reg__input" type="text" id="address" name="address" placeholder="Lieu du rendez-vous (ne pas oublier le code postal">
                    </div>
                </div>
                <div class="outing-reg__practice">
                    <label for="cycling">Vélo</label>
                    <input class="outing-reg__input" type="radio" id="cycling" name="practiced_sport" value="1">
                        <!-- Select à afficher uniquement si le bouton est coché - A voir en JS-->
                    <select class=" outing-reg__select" name="cycling_level">
                        <option class="default__select"value="" selected>Niveau de la sortie</option>
                        <option value="1">Loisirs (-15km)</option>
                        <option value="2">Régulier (15-30km)</option>
                        <option value="3">Avancé (30-60km)</option>
                        <option value="4">Intensif (+60km)</option>
                    </select>
                    <label for="running">Course à pieds</label>
                    <input class="outing-reg__input" type="radio" id="running" name="practiced_sport" value="2">
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
                    <label for="outing-image">Image associée au parcours ou itinéraire</label>
                    <input class="outing-reg__input" type="file" id="image" name="picture" alt="image du parcours" src="">
                </div>
            </div>
            <div class="outing-reg__description">
                <label for="description">Description de la sortie</label>
                <textarea name="description" id="description" cols="30" rows="5" placeholder=""></textarea>
            </div>
            <div class="outing-reg__course">
            </div>
            <div class="outing-reg__submit">
                <input class="outing-reg__input__submit" type="submit" value="Valider la sortie">
            </div>
        </form>
