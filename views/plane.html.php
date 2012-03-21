<?php
$title = $plane->getName();
$blocks = $plane->getBlocks();
$prev = $plane->getPrev();
$next = $plane->getNext();
include "header.php";
$nav = array();
if ($prev) {
    $nav["prev"] = '<a rel="prev" href="'.q($router->getUrl($prev)).'">'.q($prev->name).'</a>';
}
$nav["up"] = '<a rel="up" href="'.q($router->getUrl()).'">Unicode</a>';
if ($next) {
    $nav["next"] = '<a rel="next" href="'.q($router->getUrl($next)).'">'.q($next->name).'</a>';
}
include "nav.php";
?>
<div class="payload plane">
  <h1><?php e($title);?></h1>
  <p>From U+<?php f('%04X', $plane->first)?>
     to U+<?php f('%04X', $plane->last)?></p>
  <h2>Blocks in this plane</h2>
  <ol>
    <?php foreach ($blocks as $b):?>
      <li><?php bl($b)?> <small>(U+<?php $l = $b->getBlockLimits(); f('%04X', $l[0])?> to <?php f('%04X', $l[1])?>)</small></li>
    <?php endforeach?>
  </ol>
</div>
<?php include "footer.php"?>
