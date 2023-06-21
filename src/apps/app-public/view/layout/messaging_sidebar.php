  <div id="messaging_users" class="fixed-plugin">
      <div class="card shadow-lg mt-5">
          <div class="card-header pb-0 pt-3 ">
              <div class="float-end mt-4">
                  <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                      <i class="fa fa-close"></i>
                  </button>
              </div>
              <!-- End Toggle Button -->
              <div class="float-start">
                  <h5 class="mt-3 mb-0"> <i class="fab fa-telegram-plane"></i> &nbsp; Messages</h5>
              </div>
          </div>
          <hr class="horizontal dark my-1">
          <div class="card-body pt-sm-3 pt-0">

              <?php require_once $config['PARSERS_PATH'] . 'messaging' . DS . 'modal_model.php' ?>
              <div id="msg_user_ul" class="col-12">
                  <ul id="msg_user_list" class="navbar-nav justify-content-end">
                      <?php require_once $config['PARSERS_PATH'] . 'messaging' . DS . 'users_list.php' ?>
                  </ul>
                  <?php $side_user_id = ((isset($_SESSION['merchant_id'])) ? $_SESSION['merchant_id'] : ((isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '')) ?>
                  <input type="hidden" id="ses_user_input" name="type" value="<?= ((isset($_SESSION['merchant_id'])) ? $_SESSION['merchant_id'] : ((isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '')) ?>">
                  <input type="hidden" id="unreadmsg_nums" class="unreadmsg_nums" name="type" value="<?= ((!empty($side_user_id)) ? messages_count_unread($side_user_id, $ses_user_type) : '') ?>">

              </div>
          </div>
      </div>
  </div>