<script>
    function notify() {
        Notification.requestPermission(function () {
            var notification = new Notification("Título da notificação", {
                icon: 'http://localhost/intranet/themes/intranet/images/icon/labo.png',
                body: "Texto da notificação"
            });
            notification.onclick = function () {
                window.open("http://localhost/intranet");
            };
        });
    }

    notify();
</script>