<?php snippet('header') ?>

<section class="projects">


    <?php if ($projects = page('projects')) : ?>
        <ul id="table-of-projects" class="tablesorter">

            <?php foreach ($projects->children() as $project) : ?>
                <a href="<?= $project->url() ?>">
                    <li class="project">
                        <?php if ($project->title()->isNotEmpty()) : ?>
                            <span><?= $project->title()->esc() ?></span>
                        <?php endif ?>



                    </li>
                </a>
            <?php endforeach ?>
        </ul>
    <?php endif ?>

</section>

<?php snippet('footer') ?>