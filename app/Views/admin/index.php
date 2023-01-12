<?= $this->extend('admin/layout/base') ?>
<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endsection() ?>
<?= $this->section('title-content') ?>
<?= $title ?>
<?= $this->endsection() ?>

<?= $this->section('css'); ?>
<?= $this->endsection(); ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Data News</h4>
            </div>
            <div class="card-body">
                <div id="chart-profile-visit"></div>
            </div>
        </div>
    </div>
</section>
<?= $this->endsection() ?>

<?= $this->section('js'); ?>
<script src="<?= base_url() ?>/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script>
    var optionsProfileVisit = {
        annotations: {
            position: "back",
        },
        dataLabels: {
            enabled: false,
        },
        chart: {
            type: "bar",
            height: 300,
        },
        fill: {
            opacity: 1,
        },
        plotOptions: {},
        series: [{
            name: "News",
            data: [<?php foreach ($news as $d) {
                        echo $d['count'] . ", ";
                    } ?>],
        }, ],
        colors: "#435ebe",
        xaxis: {
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
        },
    };
    var chartProfileVisit = new ApexCharts(
        document.querySelector("#chart-profile-visit"),
        optionsProfileVisit
    )
    chartProfileVisit.render();
</script>
<?= $this->endsection(); ?>