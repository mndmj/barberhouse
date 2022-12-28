<?= $this->extend('template/t_admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-3 col-12">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Barbershop</h3>
                <p>Jumlah : 12</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-scissors"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-12">
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>Menu</h3>
                <p>Jumlah : 12</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-rectangle-list"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-12">
        <div class="small-box bg-olive">
            <div class="inner">
                <h3>Antrian</h3>
                <p>Jumlah : 12</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-people-arrows"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>