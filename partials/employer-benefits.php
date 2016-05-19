
<div class="employer-benefits">
	<div class="benefit-category">
		<h6>Ett gruppnamn</h6>
		<p class="benefit-confirmed">En bekräftad förmån</p>
		<p class="benefit-not-confirmed">En EJ bekräftad förmån</p>
	</div>
</div>


<?php
//function benefits() {
	//hämta alla förmåner per employer
	//skriv ut
	$benefits = do_benefits();
	//print_r($benefits);

	$output = '';
	foreach($benefits as $benefit=>$category) {
		$output.=
		'<div class="employer-benefits">
			<div class="benefit-category">

				<h6>'. $category .'</h6>';

				//$confirmed 	TODO
				if($benefit == $confirmed) {
					$output .= '<p class="benefit-confirmed">'. $benefit.'</p>';
				}
				else {
					$output .= '<p class="benefit-not-confirmed">'. $benefit .'</p>';
				}
			$output .=
			'</div>
		</div>';
	}
	echo $output;

//}

function do_benefits() {
	//hämtar alla förmåner som finns, ska ju bara ha dem till detta företag
    $raw_benefits = get_terms(array(
        'taxonomy' => 'benefit',
        'orderby' => 'meta_value',
        'hide_empty' => false,
        //'meta_value' => 'Försäkringar & Hälsa',        //search by category name
    ));
	$benefits_from_answers = null;
    $benefits = [];
    foreach ($benefits_from_answers as &$benefit) {
        $id = $benefit['anwser'];		//en massa term_id:n
		$category = get_term_meta($benefit->term_id, 'benefit-category', $single = true);
        //array_push($benefits, $name=>$category);
        $benefits[$name] = $category;
    }

    return $benefits;
}