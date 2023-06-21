<div class="container">
    <!-- <br><br><br> -->
    <!-- <br><br><br> -->

    <div class="row">

        <div class="col-12 col-sm-2 col-md-3"></div>
        <div class="col-12 col-sm-8 col-md-6">
            <div class="row card_work">

                <div class="col-12 text-center">
                    <br>
                    <img class="img text-center" src="<?= PROJECT_LOGO ?>" alt="<?= PROJECT_TITLE ?> Logo" width="150px" height="150px">
                </div>
                <br>
                <br>
                <div class="col-12 text-center text-secondary">
                    <p>
                        <span class="alt_dflt" style="font-family: myFirstFont; font-size: 3em;"> <?= 'Dr. ' . ucfirst(PROJECT_TITLE) ?> </span>
                    </p>
                </div>
                <hr>
                <form class="col-12" id="loginForm" action="login" method="get" style="border-radius: 7px;">
                    <?php if ($data['error'] == true) : ?>
                        <div id="login_message" class="message alert alert-danger">
                            <h6><?= $data['message'] ?></h6>
                        </div>
                    <?php endif; ?>
    
                    <div class="form-row align-items-center">
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text text-warning"> <i class="fa fa-user input_color"></i> </div>
                                </div>
                                <input type="username" autocomplete="username" class="form-control shadow-none" id="username" name="username" placeholder="Username" required>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-row align-items-center">
                        <div class="col-12">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text text-warning"> <i class="fas fa-unlock-alt input_color"></i> </div>
                                </div>
                                <input type="password" autocomplete="password" class="form-control shadow-none" id="password" name="password" required>
                            </div>
                        </div>
                    </div>
    
                    <button id="submitForm" type="submit" class="btn btn-secondary btn-sm col-12" style="border-radius: 12px; font-weight: bolder;">Submit</button>
                    <br><br>
                </form>



            </div>

        </div>
        <div class="col-12 col-sm-2 col-md-3"></div>
    </div>
</div>