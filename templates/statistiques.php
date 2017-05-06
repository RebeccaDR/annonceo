<?php

function viewStatistiques ($statistiques) {
  echo '<div class="row">';
  foreach ($statistiques as $title => $widget) {
    echo '<div class="col-md-6 panel panel-default">
    <div class="panel-heading">' . $title . '</div>
    <div class="panel-body">
    <table>';
    foreach ($widget as $key => $item) {
      if ($key == 0) {
        echo '<tr>';
        foreach ($item as $column => $value) {
          echo '<th>';
          print_r($column);
          echo '</th>';
        }
        echo '</tr>';
      }
      echo '<tr>';
      foreach ($item as $column => $value) {
        echo '<td>';
        print_r($value);
        echo '</td>';
      }
      echo '</tr>';
    }
    echo '</table></div></div>';
  }
  echo '</div>';
}

// $statistiques = [
//   ''
//   ''
//   ''
// ];

function viewTopMembres ($membres) {
  ?>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Top 5 des membres les mieux notés</div>
      <div class="panel-body">
        <table class="col-md-12">
        <?php
          foreach($membres as $membre) {
            ?>
            <tr>
              <td>
                <?= $membre['id_membre'] ?> - <?= $membre['pseudo'] ?>
              </td>
              <td>
                <span class="badge" style="background-color: #FF685A;">
                  <?= $membre['note'] ?> étoiles, basé sur <?= $membre['base_sur'] ?> avis
                </span>
              </td>
            </tr>
            <?php
          }
        ?>
        </table>
      </div>
    </div>
    </div>
  <?php
}

function viewTopActifs ($membres) {
  ?>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Top 5 des membres les plus actifs</div>
      <div class="panel-body">
        <table class="col-md-12">
        <?php
          foreach($membres as $membre) {
            ?>
            <tr>
              <td>
                <?= $membre['id_membre'] ?> - <?= $membre['pseudo'] ?>
              </td>
              <td>
                <span class="badge" style="background-color: #FF685A;">
                  <?= $membre['nbAnnonces'] ?> annonce(s) publiée(s)
                </span>
              </td>
            </tr>
            <?php
          }
        ?>
        </table>
      </div>
    </div>
    </div>
  <?php
}

function viewTopCategories ($categories) {
  ?>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Top 5 des categories avec le plus d'annonces</div>
      <div class="panel-body">
        <table class="col-md-12">
        <?php
          foreach($categories as $categorie) {
            ?>
            <tr>
              <td>
                <?= $categorie['id_categorie'] ?> - <?= $categorie['titre'] ?>
              </td>
              <td>
                <span class="badge" style="background-color: #FF685A;">
                  <?= $categorie['nbAnnonces'] ?> annonce(s)
                </span>
              </td>
            </tr>
            <?php
          }
        ?>
        </table>
      </div>
    </div>
    </div>
  <?php
}

function viewTopAnnonce ($annonces) {
  ?>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Top 5 des annonces les plus commentées</div>
      <div class="panel-body">
        <table class="col-md-12">
        <?php
          foreach($annonces as $annonce) {
            ?>
            <tr>
              <td>
                <?= $annonce['id_annonce'] ?> - <?= $annonce['titre'] ?>
              </td>
              <td>
                <span class="badge" style="background-color: #FF685A;">
                  <?= $annonce['nbCommentaire'] ?> commentaire(s)
                </span>
              </td>
            </tr>
            <?php
          }
        ?>
        </table>
      </div>
    </div>
    </div>
  <?php
}
