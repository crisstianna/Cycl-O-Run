<<<<<<< HEAD
=======
<?php
get_header();
?>

<body>
    <form class="outing__creation" action="" method="post">
        <div class="outing__location">
            <input type="text" id="outing_name" name="outing_name" placeholder="Nom de la sortie">
        </div>
        <div class="outing__rdv">
            <input type="date" id="date" name="date">
            <label for="hour">Choix de l'heure</label>
            <input type="time" id="hour" name="time">
        </div>
        <div class="outing__length">
            <input type="number" id="length" name="distance" placeholder="Distance du parcours (en km)">
        </div>
        <div class="outing__location">
            <label for="location">Lieu de Rendez-vous</label>
            <input type="text" id="address" name="address" placeholder="Lieu du rendez-vous (ne pas oublier le code postal">
        </div>
        <div class="outing__practice">
            <label for="cycling">Vélo</label>
            <input type="radio" id="cycling" name="practicedSport" value="1">
                <!-- Select à afficher uniquement si le bouton est coché - A voir en JS-->
                <select class="form-control" name="level">
                    <option value="" selected>Niveau de la sortie</option>
                    <option value="1">Loisirs (-15km)</option>
                    <option value="2">Régulier (15-30km)</option>
                    <option value="3">Avancé (30-60km)</option>
                    <option value="4">Intensif (+60km)</option>
                </select>
            <label for="running">Course à pieds</label>
            <input type="radio" id="running" name="practicedSport" value="2">
                <!-- Select à afficher uniquement si le bouton est coché-->
                <select class="form-control" name="level">
                    <option value="" selected>Niveau de la sortie</option>
                    <option value="1">Loisirs (-5km)</option>
                    <option value="2">Régulier (5-10km)</option>
                    <option value="3">Avancé (10-15km)</option>
                    <option value="4">Intensif (+15km)</option>
                </select>
        </div>    
        <div class="outing__image">
            <label for="outing-image">Insérez ici l'image du parcours</label>
            <input type="file" id="image" name="picture" alt="image du parcours" src="">
        </div>
        <div class="outing__description">
            <label for="description">Description de la sortie</label>
            <textarea name="description" id="description" cols="30" rows="10" placeholder=""></textarea>
        </div>
        <div class="outing__course">
        </div>
        <div class="outing__submit">
            <input type="submit" value="Valider la sortie">
        </div>
    </form>   
    
    <template class="last-outings">
        
    </template>
</body>
</html>
>>>>>>> Dev
