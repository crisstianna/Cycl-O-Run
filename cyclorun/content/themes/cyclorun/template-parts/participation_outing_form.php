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
    <h1 class="outing-participation-page-title">Les sorties organisées</h1>
    <!-- Form to apply filters -->
    <form class="outing-filters" action="" method="post">
        <h3 class="filter-by">Filtrer par ...</h3>
        <section class="filter-outing">            
            <div class="filter-sport">
                <p class="participation-paragraph">Sport pratiqué</p>
                <div class="label-input">
                    <label for="cycling">Sorties vélo</label>
                    <input type="radio" name="practicedSport" value="1">
                </div>
                <div class="label-input">
                    <label for="running">Sorties course à pieds</label>
                    <input type="radio"  name="practicedSport" value="2">
                </div>
            </div>
            <div class="filter-level">
                <p class="participation-paragraph">Niveau de la sortie</p>
                <div class="label-input">
                    <label for="">Loisirs (vélo:-15km / running:-5km)</label>
                    <input type="radio" name="level" id="level" value="1">
                </div>
                <div class="label-input">
                    <label for="">Régulier (vélo:15-30km / running:5-10km )</label>
                    <input type="radio" name="level" id="level" value="2">
                </div>
                <div class="label-input">
                    <label for="">Avancé (vélo:30-60km / running:10-50km)</label>
                    <input type="radio" name="level" id="level" value="3">
                </div>
                <div class="label-input">
                    <label for="">Intensif (vélo:+60km / running:+15km)</label>
                    <input type="radio" name="level" id="level" value="4">
                </div>
            </div>
            <div class="filter-date">
                <p class="participation-paragraph" for="date">Date</p>
                <input class="filter-date-input" type="date" id="date" name="date">
            </div>
        </section>
        <div class="filter-submit">
            <input class="filter-button" type="submit" value="Appliquer les filtres">
        </div>
    </form>