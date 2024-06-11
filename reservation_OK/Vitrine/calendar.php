<?php
// Inclure le fichier functions.php pour avoir accès aux fonctions
include ('functions.php');

$reservations = getReservations();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des covoiturages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
</head>

<body>
    <?php genererNavigation(); ?>

    <div id="calendar"></div>

    <!-- Div pour afficher les détails de l'annonce -->
    <div id="annonceDetails"></div>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var reservations = <?php echo $reservations; ?>;

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: reservations,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Aujourd\'hui',
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour'
                },
                locale: 'fr',
                dayMaxEventRows: true,
                height: 'auto',
                eventDisplay: 'block',
                eventTextColor: '#ffffff',
                eventBackgroundColor: '#007bff',
                eventClick: function (info) {
                    // Récupérer l'ID de l'annonce
                    var annonceId = info.event.title.match(/\(ID: (\d+)\)/)[1];

                    // Charger les détails de l'annonce et les afficher
                    $.ajax({
                        url: 'annonce_details.php?id=' + annonceId, // Remplacez annonce_details.php par le script qui récupère les détails de l'annonce
                        success: function (data) {
                            $('#annonceDetails').html(data);
                        }
                    });
                },
                eventContent: function (info) {
                    var content = '<div class="text-center">' + info.timeText + '</div>';
                    content += '<div class="text-center">' + info.event.title + '</div>';
                    content += '<div class="text-center"><button class="btn btn-primary btn-sm" onclick="showDetails(\'' + info.event.id + '\')">Détails</button></div>';
                    return { html: content };
                }
            });

            calendar.render();
        });

        function showDetails(eventId) {
            // Récupérer l'ID de l'annonce
            var annonceId = eventId.match(/\(ID: (\d+)\)/)[1];

            // Charger les détails de l'annonce et les afficher
            $.ajax({
                url: 'annonce_details.php?id=' + annonceId, // Remplacez annonce_details.php par le script qui récupère les détails de l'annonce
                success: function (data) {
                    $('#annonceDetails').html(data);
                }
            });
        }
    </script>
</body>

</html>