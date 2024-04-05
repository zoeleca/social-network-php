<h3>
  <time>
    <?php $date = new DateTime($post['created']);
    /* :: = . en js ; critère format françasi  */
    $timeZone = (iterator_to_array(IntlTimeZone::createEnumeration('FR')));
    $tz = reset($timeZone);
    $formatter = IntlDateFormatter::create(
      'fr_FR',
      /*date */
      IntlDateFormatter::FULL,
      /*heure */
      IntlDateFormatter::SHORT,
      $tz,
      /*calendrier utilisé */
      IntlDateFormatter::GREGORIAN
    ); ?>
    <?php echo ucwords($formatter->format($date)) ?>
  </time>
</h3>

<address><a href="../Pages/wall.php?user_id=<?php echo $post['user_id']; ?>">
    <?php echo $post['author_name'] ?>
  </a></address>
<div>
  <p>
    <?php echo $post['content'] ?>
  </p>
</div>
<footer>
  <!-- debut du form pour les likes -->
  <form action="like.php" method="post">
    <input type="hidden" name="like_number" value="<?php echo $post['like_number']; ?>">
    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>"> 
    <button type="submit">♥ <?php echo $post['like_number']; ?></button>
  </button>
</form>
  <a href="../Pages/tags.php?tag_id=<?php echo $post['tag_ids'] ?>">
    <?php echo $post['taglist'] ?>
  </a>
</footer>