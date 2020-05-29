<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cycl'O'run</title>
</head>
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
            <label for="running">Vélo</label>
            <input type="radio" id="running" name="practicedSport" value="vélo">
                <!-- Select à afficher uniquement si le bouton est coché - A voir en JS-->
                <select class="form-control" name="level">
                    <option value="" selected>Niveau de la sortie</option>
                    <option value="Loisirs (-15km)">Loisirs (-15km)</option>
                    <option value="Régulier (15-30km)">Régulier (15-30km)</option>
                    <option value="Avancé (30-60km)">Avancé (30-60km)</option>
                    <option value="Intensif (+60km)">Intensif (+60km)</option>
                </select>
            <label for="cycling">Course à pieds</label>
            <input type="radio" id="cycling" name="practicedSport" value="course à pieds">
                <!-- Select à afficher uniquement si le bouton est coché-->
                <select class="form-control" name="level">
                    <option value="" selected>Niveau de la sortie</option>
                    <option value="Loisirs (-5km)">Loisirs (-5km)</option>
                    <option value="Régulier (5-10km)">Régulier (5-10km)</option>
                    <option value="Avancé (10-50km)">Avancé (10-50km)</option>
                    <option value="Intensif (+15km)">Intensif (+15km)</option>
                </select>
        </div>    
        <div class="outing__image">
            <label for="outing-image">Insérez ici l'image du parcours</label>
            <input type="file" id="image" name="picture" alt="image du parcours" src="">
        </div>
        <!-- Le visuel du point de départ se verra uniquement sur la page détails de la course
            <div class="outing__map">
                <label for="outing-map">Insérez ici une map pour la sortie</label>
            </div>     
        -->
        <div class="outing__description">
            <label for="description">Saisir la description de la sortie</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="outing__course">
        </div>
        <div class="outing__submit">
            <input type="submit" value="valider la course">
        </div>
    </form>    
</body>
</html>