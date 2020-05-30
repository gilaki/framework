

<?php ob_start();
$captcha = new Captcha();
$captcha->build(); ?>

  <div dir="rtl" id="alert" style="margin-top: 60px; text-align: right" class="col-md-8 offset-md-2">
      <?php $this->renderFeedbackMessage()?>
  </div>
        <!-- Icon -->
<div class="container">
  <div class="text-center">
    <h2>دریافت ایمیل فعال سازی</h2><br/>
  </div><br>
  <form action="<?=Config::get('URL')?>/getVerifyLink" method="post">
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken()?>">
    <div class="row">
      <div class="col-md-4 col-sm-4"></div>
      <div class="text-right form-group col-md-4 col-sm-4">
        <label dir="rtl" for="Email">ایمیل:</label>
        <input type="text" class="form-control" name="email">
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4"></div>
      <div class="text-right form-group col-md-4 col-sm-4">
        <label dir="rtl" for="captcha">کد امنیتی:</label>
        <div class="text-right">
          <img id="captchaOld" class="" src="/captcha/captcha.jpg">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4"></div>
      <div class="col-md-4 col-sm-4">
        <div class="text-right form-group ">
          <input type="text"  class="form-control" name="captcha">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4"></div>
      <div class="text-center form-group col-md-4 col-sm-4">
        <button type="submit" class="btn btn-success">دریافت لینک فعال سازی</button>
      </div>
    </div>
  </form>
</div>

<?php $content = ob_get_clean();
ob_start()?>
<script>

</script>
<?php $script = ob_get_clean()?>
<?= IncludeFile::SendContent('layouts/master',['content'=>$content,'script'=>$script]);?>
