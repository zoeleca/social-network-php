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

    <address><a href="wall.php?user_id=<?php echo $post['user_id']; ?>"><?php echo $post['author_name'] ?> </a></address>
    <div>
        <p><?php echo $post['content'] ?></p>
    </div>
zz
    <footer>
        <!-- debut du form pour les likes -->
        <form action="like.php" method="post">
            <button type= 'submit'>♥ <?php echo $post['like_number'] ?></button>
        </form>
        <a href=""><?php echo $post['taglist'] ?></a>
    </footer>