<div class="container">
    <div class="row">
        <div class="col-12 shadow border-radius-xl bg-white py-3">
            <h3 class="text-dark"> <i class="fas fa-columns me-3"></i> Dashboard </h3>
            <hr class="horizontal dark mt-0">

            <div class="row">
                <?php foreach ($admin_pages as $page_key => $a_page) : ?>
                    <div class="col-12 col-md-3 p-2">
                        <div class="card/ shadow-sm border-radius-xl">
                            <div class="card-body/">
                                <h5 class="card-title alert-light/ btn-secondary border-radius-md p-1 px-3"> <a href="<?= $page_key ?>" class="text-white"> <i class="me-2 <?= $a_page['imgs'] ?>"></i> <?= $a_page['short'] ?> </a> </h5>
                                <p class="text-secondary px-3 fs-6"> <?= $a_page['long'] ?> </p>
                                <hr class="horizontal dark mt-0">
                                <!-- <a href="<?= $page_key ?>" class="card-link"> Visit Page </a> -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>
</div>