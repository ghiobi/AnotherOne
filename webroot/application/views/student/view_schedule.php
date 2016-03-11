<main class="container">
    <div class="row">
        <div class="col-md-12" id="theSchedule">

        </div>
    </div>
</main>

<script src="<?= base_url('resources/js/schedule.js') ?>"></script>
<script>
    var json = <?= $schedule ?>;
    var schedule = new Schedule(document.getElementById('theSchedule'), null, null, null, json, null, false);
    schedule.render();
</script>