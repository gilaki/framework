<?php

// get the feedback (they are arrays, to make multiple positive/negative messages possible)
$feedback_negative = Session::get('feedback_negative');
$feedback_position = Session::get('feedback_position');


// echo out negative messages
if (isset($feedback_negative)) {
    foreach ($feedback_negative as $feedback => $value) {
      if ($value !=''){
        echo '<div style="display: block" class="alert alert-danger">'.$value.'</div>';
      }
    }
}
if (isset($feedback_position)) {
    foreach ($feedback_position as $feedback => $value) {
      if ($value !=''){
        echo '<div style="display: block" class="alert alert-success">'.$value.'</div>';
      }
    }
}

