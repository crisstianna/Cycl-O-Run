<?php

/*
Plugin Name: CRUD SORTIE
Description: Plugin permettant d'ajouter, editer, supprimer des sorties.
Version: 1.0
Author: Cristiana
*/


register_activation_hook( __FILE__, 'crudOperationsTable');
function crudOperationsTable() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'outings';
  $sql = "CREATE TABLE `$table_name` (
      `outing_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
      `outing_name` varchar(64) NOT NULL,
      `author` varchar(64) NOT NULL,
       `address` varchar(255) NOT NULL,
      `level` varchar(64) NOT NULL,
      `date` DATE NOT NULL,
      `time` TIME NOT NULL,
      `distance` int(6) NOT NULL,
      `practiced_sport` varchar(64) NOT NULL,
      `picture` varchar(255),
      `description` varchar(255),
      `created_at` TIMESTAMP NOT NULL,
      `updated_at` TIMESTAMP NOT NULL,
      PRIMARY KEY  (`outing_id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
  ";
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }
}
add_action('admin_menu', 'addAdminPageContent');
function addAdminPageContent() {
  add_menu_page('CRUD', 'CRUD', 'manage_options' ,__FILE__, 'crudAdminPage', 'dashicons-wordpress');
}
function crudAdminPage() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'outings';
    if (isset($_POST['submit'])) {
        $outingName = filter_input(INPUT_POST, 'outing_name');
        $address = filter_input(INPUT_POST, 'address');
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_FLOAT);
        $time = filter_input(INPUT_POST, 'time');
        $distance = filter_input(INPUT_POST, 'distance', FILTER_SANITIZE_NUMBER_INT);
        $practicedSport = filter_input(INPUT_POST, 'practicedSport');
        $level = filter_input(INPUT_POST, 'level');
        $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_URL);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
        $wpdb->query("INSERT INTO $table_name(outing_name,address,date,time,distance,practicedSport,level,picture,description) VALUES('$outingName','$address', '$date', '$time, '$distance', '$practicedSport', '$level', '$picture', '$description',)");
        echo "<script>location.replace('admin.php?page=crud%2Fcrud.php');</script>";
    }
     ?>
  <div class="wrap">
    <h2>CRUD Operations</h2>
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
            <label for="outing-image">Insérez ici ul'image du parcours</label>
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
    <?php
}