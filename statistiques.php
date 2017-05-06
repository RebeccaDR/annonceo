<?php

include ('./util/init.php');

redirectUnauthorizedUsers('admin_only');

viewTop();

$topMembres = getMembresTopNotes();
$topActifs = getMembresTopActifs();
$topCategories = getCategoriesTopAnnonces();
$topAnnonces = getAnnoncesTopCommentaires();

echo '<h2>Statistiques du site</h2>';

viewTopMembres($topMembres);
viewTopActifs($topActifs);
viewTopCategories($topCategories);
viewTopAnnonce($topAnnonces);

viewBottom();
 ?>
