<?php snippet('header') ?>

<style>
    .dot {
        stroke: #000;
        stroke-width: 1px;
    }

    .line {
        stroke: black;
        stroke-width: 2px;
    }

    .connection {
        stroke: url(#gradient) red;
        stroke-width: 2px;
        animation: dash 5s linear infinite;
        stroke-dashoffset: 2px;

    }

    #gradient {
        /* stop-color: #fff;
        stop-color: #000;

        stop-opacity: 1; */

        --color-stop: orange;
        --color-stop: #73675d;
        --color-bot: blue;
    }

    @keyframes dash {
        from {
            stroke-width: 10px;
        }

        to {
            stroke-width: 0px;
        }
    }
</style>
<main>
    <?= svg('assets/img/logo-1.svg') ?>
    <div id="container">

    </div>
    <script type="module">
        import * as d3 from "https://cdn.jsdelivr.net/npm/d3@7/+esm";
    </script>


    <svg class="dynamic" width="800" height="600"></svg>
    <!-- <li>- This could also just be the front page</li>
    <li>- Poster or animation, and text, with all the info of the program launch event</li>
    <li>- Page will disappear or be archived for the March website update</li> -->


    <div id="visualization"></div>
    <?=
    // js('assets/js/d3-script.js')
    js('assets/js/d3-script-trace-paths.js')
    ?>

</main>

<?php snippet('footer') ?>