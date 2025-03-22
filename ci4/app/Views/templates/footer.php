</div>
<script src="<?= base_url() ?>assets/js/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/feather.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/morris/morris.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?= base_url() ?>assets/js/script.js"></script>
<script>
    $(".alert").fadeTo(3000, 500).slideUp(500, function() {
        $(".alert").slideUp(500);
        $(".alert").remove();
    });
</script>


<?php if (service('uri')->getSegment(1) == 'dashboard') : ?>
    <script>
        window.mA = Morris.Area({
            element: 'morrisArea',
            data: [
                <?php foreach ($requestsChart as $request) : ?> {
                        date: '<?= date('Y-m-d', strtotime($request['date'])) ?>',
                        requests: <?= $request['total'] ?>
                    },
                <?php endforeach; ?>
            ],
            xkey: 'date',
            ykeys: ['requests'],
            labels: ['Requests'],
            lineColors: ['#1b5a90'],
            lineWidth: 2,
            fillOpacity: 0.5,
            gridTextSize: 10,
            hideHover: 'auto',
            resize: true,
            redraw: true,
            xLabels: 'day',
            // xLabelAngle: 45,
            dateFormat: function(x) {
                var date = new Date(x);
                return date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
            },
            padding: 50 // adjust padding if necessary
        });
    </script>
<?php endif; ?>

</body>

</html>