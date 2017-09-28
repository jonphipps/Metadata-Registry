{{-- select_from_array column --}}
<td>
	<?php
		if ($entry->{$column['name']} !== null) {
	    	echo $column['options'][$entry->{$column['name']}];
	    } else {
	    	echo "-";
	    }
	?>
</td>
