<article>
  <h3>
    <time>
      <?php
      $date = new DateTime($user['created']);
      $timeZone = (iterator_to_array(IntlTimeZone::createEnumeration('FR')));
      $tz = reset($timeZone);
      $formatter = IntlDateFormatter::create(
        'fr_FR',
        IntlDateFormatter::FULL,
        IntlDateFormatter::SHORT,
        $tz,
        IntlDateFormatter::GREGORIAN
      ) ?>
      <?php echo ucwords($formatter->format($date)) ?>
    </time>
  </h3>
  <address>par
    <?php echo $user['alias'] ?>
  </address>
  <div>
    <p>
      <?php echo $user['content'] ?>
    </p>
  </div>
  <?php
  include 'footer.php';
  ?>
</article>