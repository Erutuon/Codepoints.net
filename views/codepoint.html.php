<?php
$title = 'U+' . $codepoint->getId('hex');
$headdata = '';
$prev = $codepoint->getPrev();
$next = $codepoint->getNext();
$props = $codepoint->getProperties();
if ($prev):
    $headdata .= '<link href="' . $prev . '" rel="prev">';
endif;
if ($next):
    $headdata .= '<link href="' . $next . '" rel="next">';
endif;
include "header.php";
?>
    <h1>Codepoint <?php echo $title?></h1>
    <p><?php if ($props['gc'][0] === 'C'):?>
      <span class="Cc">&lt;control&gt;</span>
    <?php else:?>
      <b>&#<?php echo $codepoint->getId()?>;</b>
    <?php endif?>
    </p>
    <dl>
      <dt>Nº</dt>
      <dd><?php echo $codepoint->getId()?></dd>
      <dt>UTF-8</dt>
      <dd><?php echo $codepoint->getRepr('UTF-8')?></dd>
      <dt>UTF-16</dt>
      <dd><?php echo $codepoint->getRepr('UTF-16')?></dd>
      <dt>UTF-32</dt>
      <dd><?php echo $codepoint->getRepr('UTF-32')?></dd>
      <?php if ($prev):?>
        <dt>Previous</dt>
        <dd><a href="<?php echo $prev?>"><?php echo $prev?></a></dd>
      <?php endif?>
      <?php if ($next):?>
        <dt>Next</dt>
        <dd><a href="<?php echo $next?>"><?php echo $next?></a></dd>
      <?php endif?>
      <dt>Block</dt>
      <dd><?php $block = $codepoint->getBlock();
        printf('<a href="%s">%s</a>', u($block->getName()), $block->getName());
      ?></dd>
      <dt>Plane</dt>
      <dd><?php $plane = $codepoint->getPlane();
        printf('<a href="%s">%s</a>', u($plane->name), $plane->name);
      ?></dd>
      <dt>Aliases</dt>
      <dd>
        <table>
          <thead>
            <tr>
              <th>Type</th>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
            <?php $alias = $codepoint->getALias();
            foreach ($alias as $a):?>
              <tr>
                <th><?php echo $a['type']?></th>
                <td><?php if ($a['type'] === 'html') {
                    echo '&amp;';
                }
                echo $a['name'];
                if ($a['type'] === 'html') {
                    echo ';';
                }?></td>
              </tr>
            <?php endforeach?>
          </tbody>
        </table>
      </dd>
    </dl>
    <table>
      <tbody>
        <?php foreach ($props as $k => $v):
              if ($v !== NULL && $k !== 'cp'):?>
          <tr class="p_<?php echo $k?>">
            <td><?php echo array_key_exists($k, $properties)?
                            str_replace('_', ' ', $properties[$k]) :
                            $k?></td>
            <td>
              <?php echo $v?>
            </td>
          </tr>
        <?php endif; endforeach?>
      </tbody>
    </table>
<?php include "footer.php"?>
