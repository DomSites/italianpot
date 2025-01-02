<?php

$custom_css_template['colors'] = "
body{color:~color_body~}
a:hover{color:~color_accent~}
.entry-title a{color:~color_accent~}
.tagline{color:~color_accent~}
";

$custom_css_template['fonts'] = 
"body{font-family: '~font_body_name~'; font-size:~font_body_size~; font-weight:~font_body_variant~; text-transform:~font_body_transform~}

h1,h2,h3,h4,h5,h6,
.form-label,
.navbar-nav > li > a,
.dropdown-menu>li>a,
.frontpage-slider .caption,
.pagination-blog-feed a,
.pagination-post a,
.recipe-index-feed .category-more a,
.recent-posts-widget-with-thumbnails .rpwwt-widget .rpwwt-post-title ,
.header-row-1 .widget_nav_menu .menu > li > a{font-family: '~font_heading_name~'; font-weight: ~font_heading_variant~; text-transform:~font_heading_transform~;}

h1{font-size:~font_h1_size~;}
h2{font-size:~font_h2_size~;}
h3{font-size:~font_h3_size~;}
h4{font-size:~font_h4_size~;}
h5{font-size:~font_h5_size~;}
h6{font-size:~font_h6_size~;}

.logo .header-logo-text{line-height:~font_logo_size~; font-size:~font_logo_size~; font-weight:~font_logo_variant~; font-family: '~font_logo_name~'; text-transform:~font_logo_transform~;}

.tagline{font-family: '~font_tagline_name~'; font-size:~font_tagline_size~; }
.tagline p{text-transform:~font_tagline_transform~;}
";