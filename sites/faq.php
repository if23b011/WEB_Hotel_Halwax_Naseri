<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Tropicana - FAQ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <!-- Navigation-->
  <?php include '../utils/navbar.php'; ?>
  <!-- Content-->
  <div class="container" style="margin-bottom: 100px;">
    <h1>FAQs</h1>
    <div class="accordion" id="accordionPanelsStayOpenExample" data-bs-theme="dark">
      <div class="accordion-item">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
          <h3>Häufig gestellte Fragen vor Ort</h3>
        </button>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
          <div class="accordion-body">
            <h3>Wie buche ich ein Zimmer?</h3>
            <p>Am einfachsten buchst du über unsere Webseite. Du kannst uns auch eine E-Mail an <a
                href="mailto:office@hoteltropicana.at">office@hoteltropicana.at</a> schreiben oder unter <a
                href="tel:+436604206969">+43 660 4206969</a> anrufen.</p>
            <h3>Welche Leistungen kann ich optional dazubuchen?</h3>
            <p>Frühstück, Parkplatz in unserer Tiefgarage und die Mitnahme von Haustieren kannst du dir optional
              dazubuchen.</p>
            <h3>Wie lange können wir kostenlos stornieren?</h3>
            <p>Alle Buchungen können bis zu 3 Tagen vor Anreise kostenlos storniert werden.</p>
          </div>
        </div>
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
          <h3>Häufig gestellte Frage beim Check-In/Check-Out</h3>
        </button>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
          <div class="accordion-body">
            <h3>Welche Arten der Bezahlung erlauben sie?</h3>
            <p>Wir erlauben Bargeld, Mastercard, Visa, American Express und Diners Karten.</p>
            <h3>Wie sind Check-In und Check-Out Zeiten bei Ihnen?</h3>
            <p>Check-Out bis 11 Uhr & Check-In ab 15 Uhr</p>
            <h3>Kann ich meine Koffer abstellen, wenn ich früher ankomme, oder verspätet abreisen möchte?</h3>
            <p>Ja, wir bieten Ihnen ein kostenloses abgeschlossenes Gepäcksdepot an.</p>
          </div>
        </div>
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
          aria-controls="panelsStayOpen-collapseThree">
          <h3>Häufige Fragen über die Anreise</h3>
        </button>
        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
          <div class="accordion-body">
            <h3>Wie komme ich am einfachsten zum Hotel Tropicana?</h3>
            <p>Bestenfalls fahren Sie mit der U3 bis zur Endstation Simmering, fahren mit dem 73A zur Station
              Florian-Hedorfer-Straße und gehen den Rest zu Fuß.</p>
            <h3>Wie weit ist der nächste Flughafen entfernt?</h3>
            <p>Wien-Schwechat - Der City Airport Train (CAT) fährt von der Station Wien Mitte alle 30 Minuten zum
              Flughafen.</p>
            <h3>Wie weit ist es zum nächsten Bahnhof?</h3>
            <p>Internationale Züge fahren vom Hauptbahnhof und Westbahnhof ab. Beide Bahnhöfe sind gut mit öffentlichen
              Verkehrsmitteln oder einer kurzen Taxifahrt erreichbar.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer-->
  <?php include '../utils/footer.php'; ?>
  <!-- Bootstrap JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>