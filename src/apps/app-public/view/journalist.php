<div id="home-top" class="row">
    <div id="top_logo_text" class="container-fluid work_items hidden">
        <div class="col-12" style="padding: 35px;"></div>

        <div class="container">
            <div class="row p-3 mb-3">
                <div class="col-12 text-center left-1st mb-3" data-animation="animated slideInDown" style="border-radius: 35px; background: rgb(0, 0, 0, .3);">
                    <div class="card-body text-center">
                        <h3 class="card-title" style="color: #fff !important; font-weight: bolder;">Financial Journalist</h3>
                        <p class="card-text p-3 mb-3 text-white fs-6">
                            Fifi is an award winning journalist, who specialises in African financial markets.
                            <br>She is currently a news anchor at CNBC Africa, Africa’s largest business and financial news network.
                            <br>An economist at heart, Fifi has practised journalism for more than a decade acquiring skills across media fields from production,
                            <br>broadcast, online and print.
                        </p>
                        <!-- <a type="button" href="./media?tab=appearance" class="btn journo_btn" style="border-radius: 15px; padding: 5px 25px;">View Journalism Content</a> -->
                    </div>
                </div>
            </div>
            <div class="row text-center mb-3 p-3">
                <?php if (is_array($tvap_qry) || is_object($tvap_qry)) : ?>
                    <?php foreach ($tvap_qry as $key => $value) : ?>
                        <?php $media_date  = DateTime::createFromFormat('Y-m-d H:i:s', $value['media_publish_date']); ?>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="row card bg-none py-3 px-1 mx-0" style="background: none !important;">
                                <div class="col-12 py-2 px-1" style="border-radius: 15px">
                                    <div class="col-12" style="padding-top: 56.25%; height:fit-content">
                                        <?= $value['media_content'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="col-12 text-center mt-3">
                    <a href="./media?tab=appearance" class="text-white btn btn-secondary px-3 py-1">View More Journalism Content</a>
                </div>
            </div>
        </div>

    </div>

    <div id="carouselFade" class="carousel slide carousel-fade col-12" data-ride="carousel">
        <div class="carousel-inner">
            <!-- 1st carousel -->
            <div class="frst_crsl journalist_crsl carousel-item active" style="height: max-content;">
                <div class="text-center">
                    <div style="padding: 39px;"><br><br></div>
                    <div class="work_items" style="border-radius: 0;">
                        <div class="row" style="padding: 25px;"></div>

                        <div class="container">
                            <div class="row p-3 mb-3">
                                <div class="col-12 text-center left-1st mb-3" data-animation="animated slideInDown" style="border-radius: 35px; background: rgb(0, 0, 0, .3);">
                                    <div class="card-body text-center">
                                        <h3 class="card-title" style="color: #fff !important; font-weight: bolder;">Financial Journalist</h3>
                                        <p class="card-text p-3 mb-3 text-white fs-6">
                                            Fifi is an award winning journalist, who specialises in African financial markets.
                                            <br>She is currently a news anchor at CNBC Africa, Africa’s largest business and financial news network.
                                            <br>An economist at heart, Fifi has practised journalism for more than a decade acquiring skills across media fields from production,
                                            <br>broadcast, online and print.
                                        </p>
                                        <!-- <a type="button" href="./media?tab=appearance" class="btn journo_btn" style="border-radius: 15px; padding: 5px 25px;">View Journalism Content</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center mb-3 p-3">
                                <?php if (is_array($tvap_qry) || is_object($tvap_qry)) : ?>
                                    <?php foreach ($tvap_qry as $key => $value) : ?>
                                        <?php $media_date  = DateTime::createFromFormat('Y-m-d H:i:s', $value['media_publish_date']); ?>
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="row card bg-none py-3 px-1 mx-0" style="background: none !important;">
                                                <div class="col-12 py-2 px-1" style="border-radius: 15px">
                                                    <div class="col-12" style="padding-top: 56.25%; height:fit-content">
                                                        <?= $value['media_content'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <div class="col-12 text-center mt-3">
                                    <a href="./media?tab=appearance" class="text-white btn btn-secondary px-3 py-1">View More Journalism Content</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- 2nd carousel -->
            <div class="scnd_crsl carousel-item" style="height: max-content;">
                <div class="row">
                    <div class="col-12 bg-2_1 journalist_crsl_2_1 wait-1s" data-animation="animated fadeInLeft">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 bg-2_2 journalist_crsl_2_2 wait-1s" data-animation="animated fadeInRight">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 3rd carousel -->
            <div class="thrd_crsl carousel-item" style="width: 100%; height: max-content;">
                <div class="bg-3-0">
                    <div class="row">
                        <div class="col-12 bg-3_0 journalist_crsl_3 wait-1s" data-animation="animated">
                            <div class="">
                                <div style="padding: 40px;"><br><br></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 4th carousel -->
            <div class="frth_crsl carousel-item" style="height: max-content;">
                <div class="row">
                    <div class="col-6 bg-4_1 journalist_crsl_4_1 wait-1s" data-animation="animated rotateInDownLeft">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                            <br>
                        </div>
                    </div>
                    <div class="col-6 bg-4_2 journalist_crsl_4_2 wait-1s" data-animation="animated rotateInDownRight">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 5th carousel -->
            <div class="frth_crsl carousel-item" style="height: max-content;">
                <div class="">
                    <div class="row">
                        <div class="col-12 bg-5_0 journalist_crsl_5 wait-1s" data-animation="animated">
                            <div class="">
                                <div style="padding: 40px;"><br><br></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 6th carousel -->
            <div class="frth_crsl carousel-item" style="height: max-content;">
                <div class="row">
                    <div class="col-6 bg-6_1 journalist_crsl_6_1 wait-1s" data-animation="animated fadeInDown">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                        </div>
                    </div>
                    <div class="col-6 bg-6_2 journalist_crsl_6_2 wait-1s" data-animation="animated fadeInUp">
                        <div class="">
                            <div style="padding: 40px;"><br><br></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>