<?php

/*

    Template Name: Custom Home

*/

get_header();


if(! is_user_logged_in()){
  // retrieving the id of the custom home page
  $login = get_permalink(5);
  //automatic redirection
  header("Location: $login");
}

//? FIND USER INFORMATION:

$id = get_current_user_id();
$postcodeId = get_user_meta($id, 'postcode');
$department = substr($postcodeId[0], 0, -3);
// TODO rajouter un filtre aussi pour ne pas prendre le numéro de la rue mais uniquement le code postal (version ultérieure)

//? FIND THE LAST 3 OUTINGS CREATED NEAR THE USER'S HOME:

global $wpdb;

$wp_outings = $wpdb->prefix . 'outings';

$outings_query = $wpdb->get_results(
    "SELECT *
    FROM $wp_outings
    WHERE `address` LIKE '%$department%'
    ORDER BY outing_id DESC
    LIMIT 3",
    $output = ARRAY_A   
);

//? FIND NEWS ABOUT 3 OUTINGS IN WICH CURRENT USER IS A PARTICIPANT 

$wp_participations = $wpdb->prefix . 'participations';
$wp_users = $wpdb->prefix . 'users';
$currentDateTime = date('Y-m-d');
//var_dump($currentDateTime); 

$outings_participations = $wpdb->get_results(
  "SELECT *
  FROM $wp_outings
  INNER JOIN $wp_participations
    ON $wp_outings.`outing_id` = $wp_participations.`outing_id`
  INNER JOIN $wp_users
    ON $wp_users.`ID` = $wp_participations.`user_id`
  WHERE $wp_users.`ID` = $id AND $wp_outings.`date` >= $currentDateTime
  ORDER BY `date` ASC
  LIMIT 3",
  ARRAY_A  
);


?>



<main class="custom-home__main">

    <!-- NEW OUTINGS-->
  <section class="custom-home__section">
    <h2 class="custom-home__title"> Nouvelles sorties...</h2>
    <?php if(empty($outings_query)) {
      echo '<div class="messageEmpty">';
      echo '<div class="messageEmpty__content">Ah mince ! Personne n\'a encore proposé une sortie dans votre département ! Pourquoi ne pas être le(la) premier(e) à en proposer une ?</div>';
      echo '<a class="btn btn-primary message__button" style="text-align:center;" href="' . get_bloginfo('url') . '/outing-registration/' . '">Organiser une sortie</a>';
      echo '</div>';
    }else { ?>
      <div class="custom-home__wrap">

      <?php foreach($outings_query as $key => $value): 
    
    
          $outingName=$value['outing_name'];
          $outingDate= date("d-m-Y", strtotime($value['date']));
          $outingAddress= $value['address'];
          $outingSportName= getPracticedSport($value['practiced_sport']);
          $outingLevel= getLevel($value['level'], $value['practiced_sport']);
    
          if($outingSportName == 'course à pied'){
            $outingSportName= 'running';
          } elseif( $outingSportName == 'vélo') {
            $outingSportName= 'cycling';
          }
    
      ?>
        <!--OUTING-->
        <article class="card outing">
        <img src="<?= get_stylesheet_directory_uri(). '/public/images/'. $outingSportName .'.svg'?>" class=" outing__attachments__pycto" alt="...">
          <div class="outing__attachments">
            <img  src="<?= $value['picture']; ?>" class="card-img-top outing__attachments__image" alt="...">
          </div>
          <div class="card-body outing__body" style="width:50%;" >
            <h5 class="card-title outing__body__title"><?= $outingName ?></h5>
            <p class="card-text outing__body__text">Le <?= $outingDate ?></p>
            <p class="card-text outing__body__text">Rdv : <?= $outingAddress ?></p>
            <p class="card-text outing__body__text">Niveau : <?= $outingLevel ?></p>


            <a href="<?= get_bloginfo('url') . '/outing-details/?outingId=' . $value['outing_id']; ?>" class="btn btn-primary outing__button">Details</a>
          </div>
        </article>
      <?php endforeach; ?>
      </div>
    <?php } ?>

  </section>


  <section class="custom-home__section">

     <!--NEWS ABOUT MY OUTINGS -->
    <h2 class="custom-home__title"> J'y participe prochainement...</h2>
    <?php if(empty($outings_participations)) {
      echo '<div class="messageEmpty">';
      echo '<div class="messageEmpty__content">Vous n\'êtes encore inscrit à aucune sortie. Joignez-vous à nous en cliquant sur l\'une des sorties ci-dessus ou en cliquant sur le lien ci-dessous</div>';
      echo '<a class="btn btn-primary outing__button" href="' . get_bloginfo('url') . '/participation-outing/' . '">Participer à une sortie</a>';
      echo '</div>';
    }else { ?> 
      <div class="custom-home__wrap">      

        <?php foreach ($outings_participations as $index => $currentValue):

          $outingWichUserParticipate_Id = $currentValue['outing_id'];
          $outingWichUserParticipate_Name = $currentValue['outing_name'];
          $outingWichUserParticipate_Date = date("d-m-Y", strtotime($currentValue['date']));
          $outingWichUserParticipate_Address = $currentValue['address'];
          $outingWichUserParticipate_Level = getLevel($currentValue['level'], $currentValue['practiced_sport']);
          $outingWichUserParticipate_Sport = getPracticedSport($currentValue['practiced_sport']);
          $outingWichUserParticipate_Picture = $currentValue['picture'];

          

          if($outingWichUserParticipate_Sport == 'course à pied'){
            $outingWichUserParticipate_Sport= 'running';
          } elseif( $outingWichUserParticipate_Sport == 'vélo') {
            $outingWichUserParticipate_Sport= 'cycling';
          }


          $numberParticipants = $wpdb->get_results(
          "SELECT COUNT(*)
            FROM $wp_participations
            WHERE `outing_id` = $outingWichUserParticipate_Id",
            ARRAY_A
          );
      ?>

      <!--OUTING-->
        
      <article class="card outing">
      <img src="<?= get_stylesheet_directory_uri(). '/public/images/'. $outingWichUserParticipate_Sport .'.svg'?>" class=" outing__attachments__pycto" alt="...">
        <div class="outing__attachments">
          <img  src="<?= $outingWichUserParticipate_Picture; ?>" class="card-img-top outing__attachments__image" alt="...">
        </div>
        <div class="card-body outing__body" style="width:50%;" >
          <h5 class="card-title outing__body__title"><?= $outingWichUserParticipate_Name  ?></h5>
          <p class="card-text outing__body__text"><?= $outingWichUserParticipate_Date  ?></p>
          <p class="card-text outing__body__text"><?= $outingWichUserParticipate_Address  ?></p>
          <p class="card-text outing__body__text"><?= $outingWichUserParticipate_Level ?></p>
      <?php foreach ($numberParticipants as $key => $nbrRows): ?>    
          <p class="card-text outing__body__text">participants : <?= $nbrRows['COUNT(*)']  ?></p>
      <?php endforeach; ?>
          <a href="<?= get_bloginfo('url') . '/outing-details/?outingId=' . $currentValue['outing_id']; ?>" class="btn btn-primary outing__button">Details</a>
        </div>
      </article>      
      <?php endforeach; ?>      
      </div>
    <?php } ?>
  </section>
  </main>
  <script src="js/app.js"></script>
</body>
</html>


<?php

get_footer();
