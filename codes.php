<?php
// awcr rating
// type = totalRating, averageRating, ratingBar, (singleRating, rating='5')
echo apply_filters( 'the_content'," [awcr_rating type='ratingBar'] ");
echo apply_filters( 'the_content'," [awcr_rating type='singleRating' rating='5'] ");

// awcr template
echo apply_filters( 'the_content'," [awcr_google_histogram] ");
echo apply_filters( 'the_content'," [awcr_google_histogram type='dynamic'] ");
echo apply_filters( 'the_content'," [awcr_gauge_chart] ");
echo apply_filters( 'the_content'," [awcr_gaming_bar] ");