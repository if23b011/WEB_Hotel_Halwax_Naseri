<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Tropicana - News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php' ?>
    <!-- Content-->
    <div style="margin-bottom: 100px;">
        <h1>NEWS</h1>
        <div class="d-grid col-12 mx-auto">
            <div class="mb-3 container">
                <div class="text-center">
                    <h3>
                        <?php
                        if (isset($_SESSION["title"])) {
                            echo $_SESSION["title"];
                        }
                        ?>
                    </h3>
                </div>
                <div class="text-center">
                    <?php
                    if (isset($_SESSION["fileToUpload"])) {
                        echo '<img src="../img/thumbnails/' . $_SESSION["fileToUpload"] . '" alt="Bild" width="500" height="auto" class="img-thumbnail">';
                    }
                    ?>
                </div>
                <p style="text-align: justify;">
                    <br>
                    <?php
                    if (isset($_SESSION["text"])) {
                        echo $_SESSION["text"] . "<br>";
                    }
                    ?>
                </p>
                <h3 class="text-center">
                    <?php
                    if (isset($_SESSION["newsDate"])) {
                        echo "News vom " . $_SESSION["newsDate"];
                    }
                    ?>
                </h3>
            </div>



            <div class="mb-3 container">
                <div class="text-center">
                    <h2>Nachhaltigkeitsinitiative im Hotel Tropicana: Ein grüner Schritt in die Zukunft</h2>
                </div>
                <div class="text-center mb-4">
                    <img src="../img/thumbnails/news2.jpg" alt="News1" width="500" height="auto" class="img-thumbnail">
                </div>
                <div class="alert alert-light" role="alert" data-bs-theme="dark">
                    <p style="text-align: justify;">
                        Das Hotel Tropicana gab heute bekannt, dass es eine umfassende Nachhaltigkeitsinitiative
                        gestartet
                        hat, um seinen ökologischen Fußabdruck zu reduzieren und einen Beitrag zum Umweltschutz zu
                        leisten.
                        Das Hotel hat sich das Ziel gesetzt, bis zum Jahr 2025 vollständig klimaneutral zu sein.

                        Die Maßnahmen umfassen die Installation von energieeffizienter Beleuchtung und Heizung, den
                        verstärkten Einsatz erneuerbarer Energien sowie die Reduzierung von Einwegplastik in allen
                        Bereichen
                        des Hotels. Zusätzlich hat das Hotel Tropicana Partnerschaften mit lokalen
                        Umweltschutzorganisationen geschlossen, um gemeinsam nachhaltige Projekte in der Gemeinde zu
                        fördern.

                        Die Gäste des Hotels werden ebenfalls in die Initiative einbezogen, da das Hotel Tropicana aktiv
                        dazu ermutigt, Ressourcen zu sparen und umweltfreundliche Praktiken zu unterstützen. Dazu
                        gehören
                        die Option, Handtücher und Bettwäsche auf Wunsch weniger häufig zu wechseln sowie die
                        Bereitstellung
                        von Recyclingbehältern in den Gästezimmern. Diese Initiative des Hotel Tropicana markiert einen
                        bedeutenden Schritt in Richtung nachhaltigen Tourismus und verdeutlicht das Engagement des
                        Hotels für Umweltschutz und soziale Verantwortung.
                    </p>
                    <h3>News vom 20.11.2023</h3>
                </div>
            </div>



            <div class="mb-3 container">
                <div class="text-center">
                    <h2>Grand Reopening des Hotel Tropicana nach aufwendiger Renovierung</h2>
                </div>
                <div class="text-center mb-4">
                    <img src="../img/thumbnails/news1.jpg" alt="News1" width="500" height:"auto" class="img-thumbnail">
                </div>
                <div class="alert alert-light" role="alert" data-bs-theme="dark">
                    <p style="text-align: justify;">
                        Das Hotel Tropicana feierte gestern Abend seine glanzvolle Wiedereröffnung nach einer
                        umfangreichen
                        Renovierung, die mehrere Monate in Anspruch nahm. Gäste wurden von einer atemberaubenden,
                        modernisierten Lobby empfangen, die nun mit zeitgemäßem Design, luxuriösen Möbeln und
                        hochmoderner
                        Technologie ausgestattet ist.

                        Die Zimmer wurden ebenfalls einem kompletten Makeover unterzogen, wobei der Fokus auf Komfort
                        und
                        Eleganz lag. Die Gäste können sich auf stilvolle, neu gestaltete Unterkünfte freuen, die den
                        zeitgenössischen Ansprüchen gerecht werden. Die Renovierungen erstreckten sich auch auf die
                        Außenanlagen, darunter der Poolbereich und die Gartenanlagen, die jetzt mit modernsten
                        Annehmlichkeiten ausgestattet sind.

                        Das Hotel Tropicana hat sich nicht nur äußerlich verändert, sondern auch sein kulinarisches
                        Angebot
                        aufgewertet. Die Gäste können nun eine breite Palette von internationalen Köstlichkeiten in den
                        neu
                        gestalteten Restaurants des Hotels genießen.

                        Die Wiedereröffnung lockte zahlreiche Gäste und lokale Persönlichkeiten an, die von der
                        Transformation des Hotels begeistert waren. Das Hotel Tropicana ist nun bereit, seinen Gästen
                        eine
                        noch luxuriösere und zeitgemäßere Erfahrung zu bieten.
                    </p>
                    <h3>News vom 11.11.2023</h3>
                </div>
            </div>
            <?php
            /* //TODO: Wieder anzeigen nach Video
            if (empty($_SESSION["title"]) && empty($_SESSION["fileToUpload"]) && empty($_SESSION["text"]) && empty($_SESSION["newsDate"])) {
                echo '<div class="text-center"><h2>Keine News vorhanden</h2></div>';
            }
            */
            ?>
        </div>
    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>