<div class="container">
  <div class="row">
    <div class="col-12 text-center">
      <br><br>
      <?php if (isset($_GET['unsubscribe'])): ?>
        <div class="alert alert-<?=($data['error'])?'warning':'success' ?>">
          <h6 style="font-size: 1.5em;"><?=$data['message'] ?></h6>
          <hr>
          <p></p>
        </div>
      <?php else: ?>
        <h5>
          <p><span>Confirm below if you would like to unsubscribe</span></p>
          <br>
          <a class="btn btn-block rounded-0 btn-warning shadow-none" href="?distroy=true&mail=<?=$_GET['mail'] ?>&unsubscribe=true" style="border-radius: 35px !important;">Unsubscribe</a>
        </h5>
      <?php endif; ?>
    </div>
  </div>
</div>
