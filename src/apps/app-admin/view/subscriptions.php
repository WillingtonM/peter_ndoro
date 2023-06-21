<div class="container">
  <br><br>

  <div class="row">
    <div class="col-12 media_div" style="background: #fff;">
      <br>
      <?php if (isset($_GET['subs']) && $_GET['subs'] == 'all') : ?>
        <a class="text-warning" href="?subs=min">View Minimal</a>
      <?php else : ?>
        <a class="text-warning" href="?subs=all">View All</a>
      <?php endif; ?>
      <h3 class="float-right " style="font-size: 2.2em;"> <button class="btn btn-warning" onclick="requestModal(post_modal[8], post_modal[8], {})"> Add Subscriber</button> </h3>
      <br><br>
      <span class="" style="padding/: 25px 0 !important;"> Total Subs : <strong class="text-danger"><?= (($subscribers != null) ? count($cnt_res) : 0) ?></strong> </span>
      <div class="col-12" id="user_messages"></div>
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col" class=""><span class="float-right">Options</span> &emsp;</th>
          </tr>
        </thead>
        <tbody>

          <?php if ($subscribers != null) : ?>
            <?php foreach ($subscribers as $value) : ?>

              <tr>
                <th scope="row"><?= $count ?></th>
                <td><?= $value['subscription_name'] ?></td>
                <td><?= $value['subscription_last_name'] ?></td>
                <td><?= $value['subscription_email'] ?></td>
                <td class="text-<?= ($value['subscription_status'] == 1) ? 'info' : 'warning' ?>">
                  <?= ($value['subscription_status'] == 1) ? 'subscribed' : 'unsubscribed' ?> &nbsp;
                  <?= ($value['subscription_edit'] == 1) ? '<i class="fas fa-users-cog text-danger"></i>' : '' ?>
                </td>

                <td class="float-right">
                  <a type="buttton" class="btn shadow-none" onclick="postCheck('user_messages', {'subscribtion_remove': true, 'subscribtion_id': <?= ((isset($value['subscription_status'])) ? $value['subscription_id'] : '') ?>})"> <i class="fas fa-trash-alt text-danger"></i> </a>
                  <a type="buttton" class="btn shadow-none" onclick="requestModal(post_modal[8], post_modal[8], {'subscrb_id': <?= ((isset($value['subscription_status'])) ? $value['subscription_id'] : '') ?>})"> <i class="fas fa-edit text-warning"></i> </a>
                </td>
              </tr>
              <?php $count++ ?>
            <?php endforeach; ?>
          <?php endif; ?>

        </tbody>
      </table>

      <br>
      <?php if (isset($_GET['subs']) && $_GET['subs'] == 'all') : ?>
        <a class="text-warning" href="?subs=min">View Minimal</a>
      <?php else : ?>
        <a class="text-warning" href="?subs=all">View All</a>
      <?php endif; ?>

      <br><br>

    </div>
  </div>
  <br><br><br>
</div>