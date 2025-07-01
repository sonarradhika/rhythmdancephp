<?php
include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/helpers.inc.php';

ob_start(); ?>
<section id="mainclasses">
    <h2>Dance Styles We Offer...</h2>
    <p>Explore a variety of dance styles, from graceful classical to energetic South Indian style, and
        everything in between.
        Whether you're looking to master elegant moves or express yourself with vibrant rhythms, we have a
        style for everyone!</p>
</section>

<section id="other">
    <?php foreach ($dancestyles as $dancestyle): ?>
        <article>
            <img src="../<?php htmlout($dancestyle['image']); ?>" alt="Dance Image">
            <blockquote>
                <p>
                    <?php htmlout($dancestyle['style_name']); ?><br>
                    <?php htmlout($dancestyle['description']); ?>
                </p>
            </blockquote>
        </article>
    <?php endforeach; ?>
</section>
<?php
$main = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/templates/template.php';
?>
