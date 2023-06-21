
  <div id="survey_div" class="col-12" style="background: #fff; padding-top: 25px; border-radius: 35px;">
    <!-- Nav tabs -->
    <div class="col-12" style="padding: 15px 15px;">
      <ul class="nav nav-pills" id="myTab" role="tablist">
        <li class="nav-item">
          <a onclick="changeURL('user')" class="nav-link <?=( ( (isset($_GET['tab']) && $_GET['tab'] == 'user') || !isset($_GET['tab']) )?'active':'') ?>" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">User Info</a>
        </li>
        <li class="nav-item">
          <a onclick="changeURL('personal')" class="nav-link <?=((isset($_GET['tab']) && $_GET['tab'] == 'personal' )?'active':'') ?>" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">Personal Info</a>
        </li>
        <li class="nav-item">
          <a onclick="changeURL('partner')" class="nav-link <?=((isset($_GET['tab']) && $_GET['tab'] == 'partner' )?'active':'') ?>" id="partner-tab" data-toggle="tab" href="#partner" role="tab" aria-controls="partner" aria-selected="true">Partner Info</a>
        </li>
        <li class="nav-item">
          <a onclick="changeURL('disclaimer')" class="nav-link <?=((isset($_GET['tab']) && $_GET['tab'] == 'disclaimer')?'active':'' ) ?>" id="disclaimer-tab" data-toggle="tab" href="#disclaimer" role="tab" aria-controls="disclaimer" aria-selected="false">Disclaimer</a>
        </li>
        <li class="nav-item">
          <a onclick="changeURL('results')" class="nav-link <?=((isset($_GET['tab']) && $_GET['tab'] == 'results')?'active':'' ) ?>" id="results-tab" data-toggle="tab" href="#results" role="tab" aria-controls="results" aria-selected="false">Results</a>
        </li>
        <li class="nav-item">
          <a onclick="changeURL('payment')" class="nav-link <?=((isset($_GET['tab']) && $_GET['tab'] == 'payment')?'active':'' ) ?>" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment</a>
        </li>
      </ul>

    </div>

    <!-- Tab panes -->
    <div class="tab-content">
      <!-- User Questionnaire -->
      <div class="tab-pane <?=(((isset($_GET['tab']) && $_GET['tab'] == 'user') || !isset($_GET['tab']) )?'active':'') ?>" id="user" role="tabpanel" aria-labelledby="user-tab">

        <div class="row" style="font-family: Lato;">
          <h3 class="col-12 text-center">
            <br>
            Update your personal information
            <br>
          </h3>
          <div class="col-12 text-center">
            <p class="text-muted">This information will be used to match you with your potential partner</p>
            <hr>
            <br>
          </div>

          <div class="col-12">
            <div class="row">

              <div class="col-md-6 col-12">
                <form id="" class="col-12" action="index.html" method="post">
                  <label for="contact">Gender information</label>
                  <div class="form-row align-items-center">
                    <div class="col-auto contact_radio" style="">
                      <label for="contact">I am a ?</label>
                      <br>
                      <div class=" custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="gender_user" id="user_woman" value="Woman" <?=((isset($user_qdta['gender']) && $user_qdta['gender'] == 'Woman')?'checked':'') ?>>
                        <label class="custom-control-label text-muted" for="user_woman">Woman</label>
                      </div>&emsp;
                      <div class=" custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="gender_user" id="user_man" value="Man" <?=((isset($user_qdta['gender']) && $user_qdta['gender'] == 'Man')?'checked':'') ?>>
                        <label class="custom-control-label text-muted" for="user_man">Man</label>
                      </div>&emsp;
                    </div>
                  </div>
                  <br>
                  <div class="form-row align-items-center">
                    <div class="col-auto contact_radio" style="">
                      <label for="contact">I am looking for a ?</label>
                      <br>
                      <div class=" custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="gender_request" id="partner_woman" value="Woman" <?=((isset($user_qdta['gender_interest']) && $user_qdta['gender_interest'] == 'Woman')?'checked':'') ?>>
                        <label class="custom-control-label text-muted" for="partner_woman">Woman</label>
                      </div>&emsp;
                      <div class=" custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="gender_request" id="partner_man" value="Man" <?=((isset($user_qdta['gender_interest']) && $user_qdta['gender_interest'] == 'Man')?'checked':'') ?>>
                        <label class="custom-control-label text-muted" for="partner_man">Man</label>
                      </div>&emsp;
                    </div>
                  </div>
                </form>
              </div>

              <div class="col-md-6 col-12">
                <form id="form_img" class="" action="index.html" method="post">
                  <label for="contact" class="text-center">Profile Image</label>
                  <div class="col-md-12" align="center" id="product_preview">
                    <?php $user_img = get_user_by_id($_SESSION['user_id'])['user_image']; ?>
                    <img class="img-thumbnail" src="<?='img' . DS . 'users' . DS . (($user_img == '' || $user_img == 'profile.png')?$user_img:$_SESSION['user_id'] . DS . $user_img) ;  ?>" style="height: 150px; width: 150px;" alt="User Image">
                  </div>
                  <div class="" style="padding: 3px;"></div>
                  <div class="input-group mb-3/" id="">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="product_image" id="product_image" accept="image/*">
                      <label class="custom-file-label file_label_2" for="product_image"><i class="fa fa-upload"></i> <span id="label_span_1">&emsp;Profile Image</span></label>
                    </div>
    						   </div>
                </form>
              </div>

            </div>
          </div>

          <form id="userForm" class="form col-12" action="index.html" method="post">
            <br>
            <hr>

            <label for="contact">User information</label>
            <div class="form-row align-items-center">
              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-user input_color"></i> </div>
                  </div>
                  <input type="text" class="form-control" id="username_user" name="username" value="<?=((isset($user_qdta['username']))?$user_qdta['username']:'') ?>" placeholder="Username">
                </div>
                <small style="padding-left: 15px;">Username</small>
              </div>
              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-user input_color"></i> </div>
                  </div>
                  <input type="text" class="form-control mb-2/" id="name" name="name" value="<?=((isset($user_qdta['name']))?$user_qdta['name']:'') ?>" placeholder="Name">
                </div>
                <small style="padding-left: 15px;">Name</small>
              </div>
              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-user input_color"></i> </div>
                  </div>
                  <input type="text" class="form-control mb-2/" id=last_"name" name="last_name" value="<?=((isset($user_qdta['last_name']))?$user_qdta['last_name']:'') ?>" placeholder="Last Name">
                </div>
                <small style="padding-left: 15px;">Last Name</small>
              </div>
            </div>
            &nbsp;

            <div class="form-row align-items-center">
              <div class="col-auto">
                <!-- <label class="sr-only/" for="email">Email</label> -->
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-arrow-up input_color"></i> </div>
                  </div>
                  <input type="number" class="form-control" id="user_height" name="user_height" value="<?=((isset($user_qdta['user_height']))?$user_qdta['user_height']:'') ?>" placeholder="Height (in Metres)">
                </div>
                <small style="padding-left: 15px;">Height</small>
              </div>

              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-calendar input_color"></i> </div>
                  </div>
                  <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?=((isset($user_qdta['date_of_birth']))?date('Y-m-d', strtotime($user_qdta['date_of_birth'])):'') ?>" placeholder="YY-mm-dd">
                </div>
                <small style="padding-left: 15px;">Date of birth</small>
              </div>
            </div>&nbsp;

            <div class="form-row align-items-center">
              <div class="col-auto contact_radio" style="">
                <label for="contact">Level of Education</label>
                <br>
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="level_of_education" id="basic" value="Basic" <?=((isset($user_qdta['level_of_education']) && $user_qdta['level_of_education'] == 'Basic')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="basic">Basic Education</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="level_of_education" id="matric" value="Matric" <?=((isset($user_qdta['level_of_education']) && $user_qdta['level_of_education'] == 'Matric')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="matric">Matric</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="level_of_education" id="degree" value="Degree" <?=((isset($user_qdta['level_of_education']) && $user_qdta['level_of_education'] == 'Degree')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="degree">Degree</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="level_of_education" id="professional" value="Professional" <?=((isset($user_qdta['level_of_education']) && $user_qdta['level_of_education'] == 'Professional')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="professional">Professional</label>
                </div>&emsp;

              </div>
            </div>&nbsp;

            <div class="form-row align-items-center">
              <div class="col-auto contact_radio" style="">
                <label for="contact">Marital Status</label>
                <br>
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="marital_status" id="marital_single" value="Single" <?=((isset($user_qdta['marital_status']) && $user_qdta['marital_status'] == 'Single')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="marital_single">Single</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="marital_status" id="marital_divorced" value="Divorced" <?=((isset($user_qdta['marital_status']) && $user_qdta['marital_status'] == 'Divorced')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="marital_divorced">Divorced</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="marital_status" id="marital_widowed" value="Widowed" <?=((isset($user_qdta['marital_status']) && $user_qdta['marital_status'] == 'Widowed')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="marital_widowed">Widowed</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="marital_status" id="marital_married" value="Married" <?=((isset($user_qdta['marital_status']) && $user_qdta['marital_status'] == 'Married')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="marital_married">Married</label>
                </div>&emsp;

              </div>
            </div>&nbsp;

            <div class="form-row align-items-center">
              <div class="col-auto contact_radio" style="">
                <label for="contact">Ethnic Group</label>
                <br>
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="ethnicity" id="ethnic_black" value="Black" <?=((isset($user_qdta['ethnicity']) && $user_qdta['ethnicity'] == 'Black')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="ethnic_black">Black</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="ethnicity" id="ethnic_assian" value="Assian" <?=((isset($user_qdta['ethnicity']) && $user_qdta['ethnicity'] == 'Assian')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="ethnic_assian">Assian</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="ethnicity" id="ethnic_colored" value="Colored" <?=((isset($user_qdta['ethnicity']) && $user_qdta['ethnicity'] == 'Colored')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="ethnic_colored">Colored</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="ethnicity" id="ethnic_white" value="White" <?=((isset($user_qdta['ethnicity']) && $user_qdta['ethnicity'] == 'White')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="ethnic_white">White</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="ethnicity" id="ethnic_other" value="Other" <?=((isset($user_qdta['ethnicity']) && $user_qdta['ethnicity'] == 'Other')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="ethnic_other">Other</label>
                </div>&emsp;

              </div>
            </div>&nbsp;

            <div class="form-row align-items-center">
              <div class="col-auto contact_radio" style="">
                <label for="contact">Religion</label>
                <br>
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="religion" id="religion_christianity" value="Christianity" <?=((isset($user_qdta['religion']) && $user_qdta['religion'] == 'Christianity')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="religion_christianity">Christianity</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="religion" id="religion_islam" value="Islam" <?=((isset($user_qdta['religion']) && $user_qdta['religion'] == 'Other')?'Islam':'') ?>>
                  <label class="custom-control-label text-muted" for="religion_islam">Islam</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="religion" id="religion_hindu" value="Hinduism" <?=((isset($user_qdta['religion']) && $user_qdta['religion'] == 'Hinduism')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="religion_hindu">Hinduism</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="religion" id="religion_buddhism" value="Budhism" <?=((isset($user_qdta['religion']) && $user_qdta['religion'] == 'Budhism')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="religion_buddhism">Budhism</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="religion" id="religion_spirituality" value="New Age Sirituality" <?=((isset($user_qdta['religion']) && $user_qdta['religion'] == 'New Age Sirituality')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="religion_spirituality">New Age Sirituality</label>
                </div>&emsp;
                <div class=" custom-control custom-radio">
                  <input class="custom-control-input" type="radio" name="religion" id="religion_other" value="Other" <?=((isset($user_qdta['religion']) && $user_qdta['religion'] == 'Other')?'checked':'') ?>>
                  <label class="custom-control-label text-muted" for="religion_other">Other</label>
                </div>&emsp;

              </div>
            </div>&nbsp;

            <div class="form-row align-items-center">
              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-flag input_color"></i> </div>
                  </div>
                  <select type="text" class="form-control mb-2/" id="country_of_birth" name="country_of_birth">
                    <option value=""></option>
                    <?php foreach ($countries_array as $key => $value): ?>
                      <option value="<?=$key ?>" <?=(($user_qdta['country_of_birth'] == $key)?"selected":'') ?>><?=$value ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <small style="padding-left: 15px;">Country of Birth</small>

              </div>
              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-map-marker input_color"></i> </div>
                  </div>
                  <input type="text" class="form-control mb-2/" id="city_of_birth" name="city_of_birth" value="<?=((isset($user_qdta['city_of_birth']))?date('Y-m-d', strtotime($user_qdta['city_of_birth'])):'') ?>" placeholder="City Of Birth">
                </div>
                <small style="padding-left: 15px;">City of Birth</small>
              </div>
            </div> &nbsp;

            <div class="form-row align-items-center">
              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-flag input_color"></i> </div>
                  </div>
                  <select type="text" class="form-control mb-2/" id="current_country" name="current_country">
                    <option value=""></option>
                    <?php foreach ($countries_array as $key => $value): ?>
                      <option value="<?=$key ?>" <?=(($user_qdta['current_country'] == $key)?"selected":'') ?>><?=$value ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <small style="padding-left: 15px;">Current Country</small>

              </div>
              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-map-marker input_color"></i> </div>
                  </div>
                  <input type="text" class="form-control mb-2/" id="current_city" name="current_city" value="<?=((isset($user_qdta['current_city']))?$user_qdta['current_city']:'') ?>" placeholder="Current City">
                </div>
                <small style="padding-left: 15px;">Current City</small>
              </div>
            </div>&nbsp;

            <div class="form-row align-items-center">
              <div class="col-auto">
                <!-- <label class="sr-only/" for="email">Email</label> -->
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-briefcase input_color"></i> </div>
                  </div>
                  <input type="text" class="form-control" id="occupation" name="occupation" value="<?=((isset($user_qdta['occupation']))?$user_qdta['occupation']:'') ?>" placeholder="Occupation">
                </div>
                <small style="padding-left: 15px;">Occupation</small>

              </div>

              <div class="col-auto">
                <!-- <label class="sr-only/" for="email">Email</label> -->
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-credit-card input_color"></i> </div>
                  </div>
                  <input type="number" class="form-control" id="income" name="income" value="<?=((isset($user_qdta['income']))?$user_qdta['income']:'') ?>" placeholder="Gross Income (in Rands)">
                </div>
                <small style="padding-left: 15px;">Gross annual income?</small>
              </div>
            </div>&nbsp;
            <br>

            <label for="contact">Contact information</label>
            <br>
            <div class="form-row align-items-center">
              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-envelope input_color"></i> </div>
                  </div>
                  <input type="email" class="form-control" id="email" name="email" value="<?=((isset($user_qdta['email']))?$user_qdta['email']:'') ?>" placeholder="Email" disabled>
                </div>
              </div>
              <div class="col-auto">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text text-default-cstm"> <i class="fa fa-phone input_color"></i> </div>
                  </div>
                  <input type="tel" class="form-control" id="contact" name="contact" value="<?=((isset($user_qdta['contact']))?$user_qdta['contact']:'') ?>" placeholder="Contact">
                </div>
              </div>
            </div>
            &nbsp;

            <hr>
            <div id="surveyMessege" class=""></div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" name="consent_check" type="checkbox" id="userForm_consent">
                <label class="form-check-label" for="consentCheck">
                  By submitting this information, you are agreeing that the information provided here is accurate and that you have read the <a href="home?tab=disclaimer">disclaimer</a>.
                </label>
              </div>
            </div>
            <input type="hidden" name="form_type" value="user_info">
            <button type="button" onclick="surveySubmit('surveyMessege', 'userForm');" class="btn btn-warning" style="padding: 5px 45px; border-radius: 35px;">Update information</button>

          </form>

        </div>
      </div>

      <!-- Personal Questionnaire -->
      <div class="tab-pane <?=(( isset($_GET['tab']) && $_GET['tab'] == 'personal')?'active':'') ?>" id="personal" role="tabpanel" aria-labelledby="personal-tab">

        <div class="row" style="font-family: Lato;">
          <h3 class="col-12 text-center">
            <br>
            Update your personality information
            <br>
          </h3>
          <div class="col-12 text-center">
            <p class="text-muted">This information will be used to further assess you and your potential partner</p>
          </div>

          <form id="userForm2" class="form col-12" action="index.html" method="post">
            <hr>
            <br>

            <?php $q_cnt = 0; ?>
            <?php foreach ($personal_questions as $question_key => $question_value) {
              $cnt = 0;
              $q_cnt ++;
              ?>

              <div class="form-row align-items-center">
                <div class="col-auto question_radio" style="">
                  <label for="contact"><?=$q_cnt.'. &emsp; '.$question_value['question'] ?></label>
                  <br>
                  <?php if ($question_value['type'] == 'radio'): ?>
                    <?php foreach ($question_value['data'] as $value): ?>
                      <div class="custom-control custom-radio">
                        &emsp; &ensp;<input id="<?=$question_key.'_'.$cnt ?>" class="custom-control-input" type="radio" name="<?=$question_key ?>" value="<?=$value ?>" <?=((isset($prsnl_qdta[$question_key]) && $prsnl_qdta[$question_key] == $value)?'checked':'') ?>>
                        <label for="<?=$question_key.'_'.$cnt ?>" class="custom-control-label text-muted"><?=$value ?></label>
                      </div>
                      <?php $cnt++ ?>
                    <?php endforeach; ?>
                  <?php elseif ($question_value['type'] == 'full_text'): ?>
                    <div class="col-12" style="padding-left: 35px;">
                      <textarea class="form-control col-12" name="<?=$question_key ?>" rows="8" cols="80" value=""><?=((isset($prsnl_qdta[$question_key]))?$prsnl_qdta[$question_key]:'') ?></textarea>
                    </div>
                  <?php else: ?>
                    <div class="col-12" style="padding-left: 35px;">
                      <input class="form-control col-12" type="text" name="<?=$question_key ?>" value="<?=((isset($prsnl_qdta[$question_key]))?$prsnl_qdta[$question_key]:'') ?>">
                    </div>
                  <?php endif; ?>
                </div>
              </div>&nbsp;

              <?php
            } ?>

            <hr>
            <div id="surveyMessege2" class=""></div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" name="consent_check" type="checkbox" id="userForm2_consent">
                <label class="form-check-label" for="consentCheck">
                  By submitting this information, you are agreeing that the information provided here is accurate and that you have read the <a href="home?tab=disclaimer">disclaimer</a>.
                </label>
              </div>
            </div>
            <input type="hidden" name="form_type" value="prefer_info">
            <button type="button" onclick="surveySubmit('surveyMessege2', 'userForm2');" class="btn btn-warning" style="padding: 5px 45px; border-radius: 35px;">Update information</button>


          </form>

        </div>
      </div>

      <!-- Partner Questionnaire -->
      <div class="tab-pane <?=(( isset($_GET['tab']) && $_GET['tab'] == 'partner')?'active':'') ?>" id="partner" role="tabpanel" aria-labelledby="partner-tab">

        <div class="row" style="font-family: Lato;">
          <h3 class="col-12 text-center">
            <br>
            Update your preferential partner information
            <br>
          </h3>
          <div class="col-12 text-center">
            <p class="text-muted">This information will be used to assess your potential partner</p>
          </div>

          <form id="userForm3" class="form col-12" action="" method="post">
            <hr>
            <br>

            <?php $q_cnt = 0; ?>
            <?php foreach ($partner_questions as $question_key => $question_value) {
              $cnt = 0;
              $q_cnt ++;
              ?>

              <div class="form-row align-items-center">
                <div class="col-auto question_radio" style="">
                  <label for="<?=$question_key ?>"><?=$q_cnt.'. &emsp; '.$question_value['question'] ?></label>
                  <br>
                  <?php if ($question_value['type'] == 'radio'): ?>
                    <?php foreach ($question_value['data'] as $value): ?>
                      <div class="custom-control custom-radio">
                        &emsp; &ensp;<input id="<?=$question_key.'_'.$cnt ?>1" class="custom-control-input" type="radio" name="<?=$question_key ?>" value="<?=$value ?>" <?=$value ?>" <?=((isset($prtnr_qdta[$question_key]) && $prtnr_qdta[$question_key] == $value)?'checked':'') ?>>
                        <label for="<?=$question_key.'_'.$cnt ?>1" class="custom-control-label text-muted"><?=$value ?></label>
                      </div>
                      <?php $cnt++ ?>
                    <?php endforeach; ?>

                  <?php elseif ($question_value['type'] == 'full_text'): ?>
                    <div class="col-12" style="padding-left: 35px;">

                      <textarea class="form-control col-12" name="<?=$question_key ?>" rows="8" cols="80"><?=((isset($prtnr_qdta[$question_key]))?$prtnr_qdta[$question_key]:'') ?></textarea>
                    </div>
                  <?php else: ?>
                    <div class="col-12" style="padding-left: 35px;">

                      <input class="form-control col-12" type="text" name="<?=$question_key ?>" value="<?=((isset($prtnr_qdta[$question_key]))?$prtnr_qdta[$question_key]:'') ?>">
                    </div>
                  <?php endif; ?>

                </div>
              </div>&emsp;

              <?php
            } ?>

            <hr>
            <div id="surveyMessege3" class=""></div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" name="consent_check" type="checkbox" id="userForm3_consent">
                <label class="form-check-label" for="consentCheck">
                  By submitting this information, you are agreeing that the information provided here is accurate and that you have read the <a href="home?tab=disclaimer">disclaimer</a>.
                </label>
              </div>
            </div>
            <input type="hidden" name="form_type" value="partner_info">
            <button type="button" onclick="surveySubmit('surveyMessege3', 'userForm3');" class="btn btn-warning" style="padding: 5px 45px; border-radius: 35px;">Update information</button>

          </form>

        </div>
      </div>

      <!-- personal and disclaimer -->
      <div class="tab-pane <?=((isset($_GET['tab']) && $_GET['tab'] == 'disclaimer')?'active':'' ) ?>" id="disclaimer" role="tabpanel" aria-labelledby="disclaimer-tab">
        <div class="row" style="font-family: Lato;">
          <h3 class="col-12 text-center">
            <br>
            ASHEN Speed Dating disclaimer
            <br>
          </h3>
          <div class="col-12 text-center">
            <p class="text-muted">Please read and understand the information on this page</p>
          </div>
          <div class="col-12" style="padding/: 15px;"><hr></div>

          <!-- <div class="col-12">
            <h5>Questionaire Instructions</h5>

            <ul class="col text-blck" style="padding-left: 25px;">
              <li>Please answer all questions from the survey questionnaire</li>
              <li>Please read the questions carefully, and answer them honestly</li>
              <li>Each question consists of three options, and you can only select one option</li>
            </ul>

            <br>
          </div> -->

          <!-- <div class="col-12">
            <h5>Why we conduct the survey</h5>
            <p class="text-blck">
              The reason for conducting this survey is to track Zimbabwe's Consumer Confidence on the monthly basis, allowing you to better understand the economic health of Zimbabwe.
              <br>
              We invite all people in Zimbabwe from all economic background to participate in our Consumer Confidence Survey.
              <br>

              The survey results will be emailed directly to anyone who has subscribed for email notifications and will also be available online.
            </p>
            <br>
          </div> -->

          <div class="col-12">
            <h5>Participation</h5>
            <p class="text-blck">
              Your participation in the Questionaire is purely voluntary. If you wish, you may stop the questionaire at any point.
            </p>
          </div>

          <div class="col-12">
            <h5>Privacy consent</h5>
            <p class="text-blck">
              <!-- To help protect your confidentiality, the survey does not contain information that will personally identify you, such as your name, email address, except your IP address, which helps us prevent survey duplications, which could distort the results of the survey.
              <br> -->
              Any collected identifying information will be encrypted and stored in a password protected electronic format.
            </p>
            <!-- <p class="text-blck">
              The results of the survey will be used for research purposes and will be available to the public, and to anyone who has email subscription with us.
            </p> -->
            <p></p>
            <br>
          </div>

          <div class="col-12">
            <br><hr>
            <p class="text-muted text-center">
              If you have any questions, please contact <a class="link" href="mailto:<?=$_ENV['MAIL_MAIL'] ?>"><?=$_ENV['MAIL_USER']  ?></a>.
            </p>
          </div>
        </div>
      </div>
      <!-- Survey Results -->
      <div class="tab-pane <?=((isset($_GET['tab']) && $_GET['tab'] == 'results')?'active':'' ) ?>" id="results" role="tabpanel" aria-labelledby="results-tab">
        <div class="row" style="font-family: Lato;">
          <h3 class="col-12 text-center">
            <br>
            Potential partners
            <!-- Survey Results -->
            <br>
          </h3>

          <div class="col-12 text-center">
            <p class="text-muted"> Here you will see your potetial partners that match your prefferences</p>
          </div>

          <div class="col-12" style="padding/: 15px;"><hr></div>
          <div class class="text-muted"="col-12" style="padding: 15px;"></div>
          <div class="col-12 alert/ text-danger">

          <h6 class="text-center text-danger/">There is no data to display at the moment!</h6>

          </div>


        </div>
      </div>

      <!-- Payment -->
      <div class="tab-pane <?=((isset($_GET['tab']) && $_GET['tab'] == 'payment')?'active':'' ) ?>" id="payment" role="tabpanel" aria-labelledby="payment-tab">
        <div class="row" style="font-family: Lato;">
          <h3 class="col-12 text-center">
            <br>
            Payment Details
            <!-- Survey Results -->
            <br>
          </h3>

          <div class="col-12 text-center">
            <p class="text-muted">
              Please Note that for ASHEN Love Connection to propose potential partners, you need to make a payment.
              <br>
              <b>Use the bankigng information below</b>
            </p>
          </div>

          <div class="col-12" style="padding/: 15px;"><br></div>
          <div class class="text-muted"="col-12" style="padding: 15px;"></div>
          <div class="col-12 alert/ text-danger" style="padding/: 0; margin/: 0;">

            <div class="row/" style="border: 1px solid #ddd; border-radius: 15px; padding-top: 15px;">
              <table class="col-12 table table-striped">
                <thead class="thead-dark/ bg-secondary" style="color: #eee; font-size: 1.1em;">
                  <tr>
                    <th>Banking Details</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>Bank Name</th>
                    <td>First National Bank (FNB)</td>
                  </tr>
                  <tr>
                    <th>Account Number</th>
                    <td> 000 124 1235 </td>
                  </tr>
                  <tr>
                    <th>Ammount Due</th>
                    <td>R 560.00</td>
                  </tr>
                  <tr>
                    <th>Refference Statement</th>
                    <td><?=get_user_by_id($_SESSION['user_id'])['payment_code'] ?></td>
                  </tr>
                  <tr>
                    <th>Branch Code</th>
                    <td>14587</td>
                  </tr>
                </tbody>
              </table>

            </div>


          </div>

          <div class="col-12 text-center">
            <br><br>
            <h5 class="col"> --- &emsp; Or Alternatively Use &emsp; ---</h5>
            <div class="col">
              <br>
              <img src="./img/home/PF-website-logo-current-site-2.png" height="90"alt="">
            </div>
          </div>


        </div>
      </div>

    </div>

    <br><br>
  </div>
