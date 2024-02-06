    <h3>
        <time> <?php $date = new DateTime($post['created']);
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
    
    <address><a href="wall.php?user_id=<?php echo $userId; ?>"><?php echo $post['author_name'] ?> </a></address>
    <div>
        <p><?php echo $post['content'] ?></p>
    </div>
    <footer>
        <small>♥ <?php echo $post['like_number'] ?></small>
        <a href=""><?php echo $post['taglist'] ?></a>
    </footer>

    