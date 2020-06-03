<?php


get_header();

if(! is_user_logged_in()){
    // retrieving the id of the custom home page
    $login = get_permalink(5);
    //automatic redirection
    header("Location: $login");
}

?>

<body>
    <h1>Les sorties organisées</h1>
    <!-- Form to apply filters -->
    <form class="outing-filters" action="" method="post">
        <section class="filter-outing">
            <p>Filtrer par ...</p>
            <div class="sport">
                <p>Sport pratiqué</p>
                <label for="cycling">Sorties vélo</label>
                <input type="radio" name="practicedSport" value="1">
                <label for="running">Sorties course à pieds</label>
                <input type="radio"  name="practicedSport" value="2">
            </div>
            <div class="level">
                <p>Niveau de la sortie</p>
                <label for="">Loisirs (vélo:-15km / running:-5km)</label>
                <input type="radio" name="level" id="level" value="1">
                <label for="">Régulier (vélo:15-30km / running:5-10km )</label>
                <input type="radio" name="level" id="level" value="2">
                <label for="">Avancé (vélo:30-60km / running:10-50km)</label>
                <input type="radio" name="level" id="level" value="3">
                <label for="">Intensif (vélo:+60km / running:+15km)</label>
                <input type="radio" name="level" id="level" value="4">
            </div>
            <label for="date">Date</label>
            <input type="date" id="date" name="date">
        </section>
        <div class="filter__submit">
            <input type="submit" value="Appliquer les filtres">
        </div>
    </form>