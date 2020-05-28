<?php

/*
Plugin Name: CRUD SORTIE
Description: Plugin permettant d'ajouter, editer, supprimer des sorties.
Version: 1.0
Author: Cristiana
*/

if (!defined('WPINC')){
    die;
}


register_activation_hook( __FILE__, 'crudOutingTable');
function crudOutingTable() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'outing';
  $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->base_prefix}outing` (        
    `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `outing_name` varchar(64) NOT NULL,
    `author` varchar(64) NOT NULL,
    `address` varchar(255) NOT NULL,
    `lat` float(10.6) NOT NULL,
    `long` float(10.6) NOT NULL,
    `level` int(6) UNSIGNED NOT NULL,
    `date` DATE NOT NULL,
    `time` TIME NOT NULL,
    `distance` int(6) NOT NULL,
    `practiced_sport` int(6) NOT NULL,
    `picture` varchar(255),
    `course` varchar(255) NOT NULL,
  
    PRIMARY KEY  (`id`)

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
  $table_name = $wpdb->prefix . 'outing';
  if (isset($_POST['newsubmit'])) {
   
    $outing_name = $_POST['outing_name'];
    $author = $_POST['author'];
    $address = $_POST['address'];
    $lat = $_POST['lat'];
    $long= $_POST['long'];
    $level = $_POST['level'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $distance = $_POST['distance'];
    $practiced_sport = $_POST['practiced_sport'];
    $picture = $_POST['picture'];
    $course = $_POST['course'];
    
    


    $wpdb->query("INSERT INTO $table_name(outing_name,author,address,lat,long,level,date,time,distance,practiced_sport,picture,course,user_id,created_at,updated_at) VALUES('$outing_name','$author','$address', '$lat', '$long', '$level', '$date', '$time', '$distance', '$practiced_sport', '$picture', '$course')");
    echo "<script>location.replace('admin.php?page=outing2.php%2Fouting2.php');</script>";
  }
  if (isset($_POST['uptsubmit'])) {
    $id = $_POST['uptid'];
    $outing_name = $_POST['uptouting_name'];
    $author = $_POST['uptauthor'];
    $address = $_POST['uptaddress'];
    $lat = $_POST['uptlat'];
    $long = $_POST['uptlong'];
    $level = $_POST['uptlevel'];
    $date = $_POST['uptdate'];
    $time = $_POST['upttime'];
    $distance= $_POST['uptdistance'];
    $practiced_sport = $_POST['uptpracticed_sport'];
    $picture= $_POST['uptpicture'];
    $course = $_POST['uptcourse'];
    
    
    $wpdb->query("UPDATE $table_name SET outing_name='$outing_name', author='$author', address='$address', lat='$lat', long='$long', level=''$level, date='$date', time='$time', distance='$distance', practiced_sport='$practiced_sport', picture='$picture', course='$course' WHERE user_id='$id'");
    echo "<script>location.replace('admin.php?page=outing2.php%2Fouting2.php');</script>";
  }
  if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $wpdb->query("DELETE FROM $table_name WHERE user_id='$del_id'");
    echo "<script>location.replace('admin.php?page=outing2.php%2Fouting2.php');</script>";
  }
  ?>
  <div class="wrap">
    <h2>Ajouter une sortie</h2>
    <table class="wp-list-table widefat striped">
      <thead>
        <tr>
          <th width="25%">User ID</th>
          <th width="25%">Nom de la sortie</th>
          <th width="25%">Author</th>
          <th width="25%">Address</th>
          <th width="25%">Latitude</th>
          <th width="25%">Longitude</th>
          <th width="25%">Niveau</th>
          <th width="25%">Date</th>
          <th width="25%">Heure</th>
          <th width="25%">Distance</th>
          <th width="25%">Sport Pratique</th>
          <th width="25%">Photo</th>
          <th width="25%">Course</th>
          
        </tr>
      </thead>
      <tbody>
        <form action="" method="post">
          <tr>
            <td><input type="text" value="AUTO_GENERATED" disabled></td>
            <td><input type="text" id="newouting_name" name="newouting_name"></td>
            <td><input type="text" id="newauthor" name="newauthor"></td>
            <td><input type="text" id="newaddress" name="newaddress"></td>
            <td><input type="text" id="newlat" name="newlat"></td>
            <td><input type="text" id="newlat" name="newlat"></td>
            <td><input type="text" id="newlong" name="newlong"></td>
            <td><input type="text" id="newdate" name="newdate"></td>
            <td><input type="text" id="newtime" name="newetime"></td>
            <td><input type="text" id="newdistance" name="newdistance"></td>
            <td><input type="text" id="newpracticed_sport" name="newpracticed_sport"></td>
            <td><input type="text" id="newpicture" name="newpicture"></td>
            <td><input type="text" id="newcourse" name="newcourse"></td>
            
            
            <td><button id="newsubmit" name="newsubmit" type="submit">INSERT</button></td>
          </tr>
        </form>
        <?php
          $result = $wpdb->get_results("SELECT * FROM $table_name");
          foreach ($result as $print) {
            echo "
              <tr>
                <td width='25%'>$print->user_id</td>
                <td width='25%'>$print->outing_name</td>
                <td width='25%'>$print->author</td>
                <td width='25%'>$print->address</td>
                <td width='25%'>$print->lat</td>
                <td width='25%'>$print->long</td>
                <td width='25%'>$print->date</td>
                <td width='25%'>$print->time</td>
                <td width='25%'>$print->practiced_sport</td>
                <td width='25%'>$print->picture</td>
                <td width='25%'>$print->course</td>
                
                <td width='25%'><a href='admin.php?page=outing2.php%2Fouting2.php&upt=$print->user_id'><button type='button'>UPDATE</button></a> <a href='admin.php?page=outing2.php%2Fouting2.php&del=$print->user_id'><button type='button'>DELETE</button></a></td>
              </tr>
            ";
          }
        ?>
      </tbody>  
    </table>
    <br>
    <br>
    <?php
      if (isset($_GET['upt'])) {
        $upt_id = $_GET['upt'];
        $result = $wpdb->get_results("SELECT * FROM $table_name WHERE user_id='$upt_id'");
        foreach($result as $print) {
          
                $outing_name=$print->outing_name;
                $author=$print->author;
                $address=$print->address;
                $lat=$print->lat;
                $long=$print->long;
                $date=$print->date;
                $time=$print->time;
                $practiced_sport=$print->practiced_sport;
                $picture=$print->picture;
                $course=$print->course;
        }
        echo "
        <table class='wp-list-table widefat striped'>
          <thead>
            <tr>
            <th width='25%'>User ID</th>
            <th width='25%'>Nom de la sortie</th>
            <th width='25%'>Author</th>
            <th width='25%'>Address</th>
            <th width='25%'>Latitude</th>
            <th width='25%'>Longitude</th>
            <th width='25%'>Niveau</th>
            <th width='25%'>Date</th>
            <th width='25%'>Heure</th>
            <th width='25%'>Distance</th>
            <th width='25%'>Sport Pratique</th>
            <th width='25%'>Photo</th>
            <th width='25%'>Course</th>
            </tr>
          </thead>
          <tbody>
            <form action='' method='post'>
              <tr>
                <td width='25%'>$print->user_id <input type='hidden' id='uptid' name='uptid' value='$print->user_id'></td>
                <td width='25%'><input type='text' id='uptouting_name' name='uptouting_name' value='$print->outing_name'></td>
                <td width='25%'><input type='text' id='uptaddress' name='uptaddress' value='$print->address'></td>
                <td width='25%'><input type='text' id='uptlat' name='uptlat' value='$print->lat'></td>
                <td width='25%'><input type='text' id='uptlong' name='uptlong' value='$print->long'></td>
                <td width='25%'><input type='text' id='uptdate' name='uptdate' value='$print->date'></td>
                <td width='25%'><input type='text' id='upttime' name='upttime' value='$print->time'></td>
                <td width='25%'><input type='text' id='uptracticed_sport' name='uptpracticed_sport' value='$print->practiced_sport'></td>
                <td width='25%'><input type='text' id='uptpicture' name='uptpicture' value='$print->picture'></td>
                <td width='25%'><input type='text' id='uptcourse' name='uptcourse' value='$print->course'></td>

                <td width='25%'><button id='uptsubmit' name='uptsubmit' type='submit'>UPDATE</button> <a href='admin.php?page=outing2.php%2Fouting2.php'><button type='button'>CANCEL</button></a></td>
              </tr>
            </form>
          </tbody>
        </table>";
      }
    ?>
  </div>
  <?php
}