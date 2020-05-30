<?php ob_start()?>
<div style="margin-top: 70px" class="form-group col-md-4 offset-md-4">

<input id="showInput" class="form-control" type="text">
<input id="show" class="form-control" type="text">
</div>
<?php $content = ob_get_clean()?>
<?php ob_start()?>
<script>
  $(function () {
    $('#showInput').keyup(function () {
      $.ajax('/app/index',{
        type: 'post',
        dataType: 'json',
        success:function (data) {
          $('#show').text(data);
          alert(data)
        }
      })
    })

  })
</script>
<?php $script = ob_get_clean()?>


<?= IncludeFile::SendContent('layouts/master',['content'=>$content,'script'=>$script]);?>