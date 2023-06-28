<div id="contact_elem" class="container pt-10 min-vh-100">
    <div class="page-header min-height-300 border-radius-xl/ mt-4 wait-2s" data-animation="animated pulse" style="border-radius: 35px;">
        <span class="mask opacity-6" style="background-color: rgb(31, 40, 57, .5); ">
            <div class="p-0">
                <div class="text-center py-3 pt-5">
                    <h3 class="font-weight-bolder text-white"> <span class="me-2"> Contact </span> </h3>
                    <small class="m-0 text-light font-weight-bold">
                        To book Peter Ndoro for your next event or to inquire about his availability and rates, <br> please contact us using the information provided below.
                    </small>
                </div>
            </div>
        </span>
    </div>

    <div class="card card-body/ blur shadow-blur mx-4 mt-n6 overflow-hidden" style="border-radius: 20px;">

        <div class="row gx-4">
            <div class="col-12 col-xl-8">

                <div class="row">
                    <div class="col-12 px-3 border">
                        <div class="row">
                            <div class="col-12 text-center py-5">
                                <h3 class="font-weight-bolder text-dark"> Do you have any enquiry? </h3>
                                <small class="m-0 text-dark"> Enquire or contact us directly using any of the methods below </small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-2 col-lg-3"></div>
                            <div class="col-12 col-md-8 col-lg-6">
                                <div class="text-center mb-4">
                                    <p class="p-3 mb-3" style="color: #777;">
                                        <h6 class="">Get in touch, and we will get back to you</h6>
                                        <a class="p-2" style="font-size: .8rem" href="mailto:info@<?= $_ENV['PROJECT_HOST'] ?>"> <i class="fa-solid fa-envelope me-1"></i> <?= $contact_tabs['client']['mail'] ?> </a>
                                        <br>
                                    </p>
                                </div>
                                <div id="message_booking_con" class=""></div>
                                <input type="hidden" name="form_type" value="booking_form">

                                <button type="button" class="btn btn-dark col-12 border-radius-lg" style="border-radius: 12px;" onclick="requestModal(post_modal[9], post_modal[9], {})">Online Booking</button>
                            </div>
                            <div class="col-12 col-md-2 col-lg-3"></div>

                            <div class="col-12 mt-3 px-4">
                                
                                <div class="text-center bg-light p-3 border-radius-xl mb-3">
                                    <p class="p-0 font-weight-bolder"> Follow me  </p>
                                    <hr class="horizontal dark mt-0">

                                    <?php foreach ($social_media as $key => $social) : ?>
                                        <a class="text-dark me-4" href="<?= $social['link'] ?>" target="_blank"><i class="<?= $social['font'] ?> fa-2x"></i></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div id="get_in_touch" class="col-12 col-xl-4 hover_inimate px-0">
                <div class="card/ h-100 bg-dark wait-1s border-radius-none p-3" data-animation="animated/ shake/">

                    <div class="card-body p-3">

                        <div class="form-row align-items-center">
                            <div class="col-12">
                                <div class="input-group mb-2">
                                    <span class="input-group-text text-dark" style="border-right: none;"><i class="fa fa-user input_color"></i></span>
                                    <input type="text" class="form-control shadow-none" id="name" name="name" placeholder="Full Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <span class="input-group-text text-dark" style="border-right: none;"><i class="fa fa-envelope input_color"></i></span>
                                <input type="email" class="form-control shadow-none" id="email" name="feedbackemail" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <span class="input-group-text text-dark" style="border-right: none;"><i class="fa fa-comment input_color"></i></span>
                                <textarea class="form-control shadow-none" id="message" name="message" placeholder="Message ..." rows="4" required></textarea>
                            </div>
                        </div>
                        
                        <div id="feedbackErrors" class=""></div>

                        <div class="text-center" style="border-radius: 3px;">
                            <button type="button" class="btn btn-block rounded-0 btn-white btn-sm shadow-none col-12" style="border-radius: 12px !important;" onclick="postCheck('feedbackErrors', {email: $('#email').val(), name: $('#name').val(), last_name: $('#last_name').val(), message: $('#message').val(), 'form_type':'feedback_form'});">
                                Submit
                            </button>
                        </div>

                        <div class="col-12 text-center">
                            <br>
                            <small class="text-light" style="font-size: .7rem;">
                                Please note that any collected identifying information will be encrypted and stored in a password protected electronic format, <br> thus you can rest assured that your identifying information will be securely stored
                            </small>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

