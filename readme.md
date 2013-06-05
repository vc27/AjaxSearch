# AjaxSearch #

Ajax Search is an addon that gives basic functionality for an ajax search via WP_Query. The default search is specific to the post-type "page". The structure of the code is relative to my current style of coding. There are literally dozens of ways to write this functionality, if you feel the need to re-arrange the code and find a better configuration I would love to see it! I'm all about learning new stuff!

# Adding the code #

I use a directory called "addons" in my child themes. This code base is designed to live there. 

Example: wp-content/themes/MyChildTheme/addons/AjaxSearch/initiate.php

You may move the code where ever you please. If you do move the code you will need to change the 'template_directory' variable in AjaxSearchVCWP class in the __construct method.

# There are three elements #

1. HTML form
2. JavaScript
3. Php classes to handle initiation and ajax calls.

# There are two template files.# 

1. tpl-search.php which is a dummy template file to get you off the ground quick.
2. form-search.php which is a simple form that is recognized by the javascript class.

# Adding Form Fields #

If you intend to add form fields you will need to add each field to all three elements in their own respective way. 

1. HTML form will require the html for the field
2. JavaScript will require the field to be added to the 'data' object.
3. Php class DoAjaxVCWP will require you utilize the field as you see fit to produce the desired result.