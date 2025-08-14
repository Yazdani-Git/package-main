<?php

$i=1;
if(first_number != 1 ){
	echo	"<span class='last_prev_pagination'>...</span>";
}
foreach($slice_post as $key=>$value){
	if($i <= 10){ ?>
<span class="pagi_num" data-page ="<?php echo $key+1  ?>"><?php echo $key+1  ?></span>
<?php	} ?>
<?php $i++; }
if($posts_number > 10 ){
	echo	"<span class='last_page_pagination'>...</span>";
}