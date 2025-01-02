(function() {
    tinymce.PluginManager.add('kale_lt_recipe_button', function( editor, url ) {
        editor.addButton( 'kale_lt_recipe_button', {
            title: 'Kale Pro - Recipe Shortcode',
            icon: 'icon dashicons-carrot',
            onclick: function() {
                //editor.insertContent('Hello World!');
                editor.windowManager.open( {
                    title: 'Insert Recipe Shortcode',
                    body: [{
                        type: 'textbox',
                        name: 'recipe_name',
                        label: 'Recipe Name*',
                        onclick: function(e) {
                            jQuery(e.target).css('border-color', '');
                        }
                    },
                    {
                        type: 'button', 
                        label: 'Recipe Image',
                        name: 'recipe_image_button', 
                        text: 'Upload / Select',
                        onclick: kale_lt_shortcode_upload_file				
                    },
                    {
                        type: 'textbox',
                        name: 'recipe_image_url',
                        classes: 'recipe_image_url',
                        label: 'Recipe Image URL'
                    },
                    {
                        type: 'textbox',
                        name: 'recipe_servings',
                        label: 'Servings'
                    },
                    {
                        type   : 'container',
                        name   : 'recipe_help_1',
                        label  : 'Tip:',
                        html   : 'For the time values below, use H for hours and M for minutes. <br />Example: <em>1H30M</em> for <em>1 hr and 30 min</em>, <em>45M</em> for 45 min.'
                    },
                    {
                        type: 'textbox',
                        name: 'recipe_prep_time',
                        label: 'Prep Time'
                    },
                    {
                        type: 'textbox',
                        name: 'recipe_cook_time',
                        label: 'Cook Time'
                    },
                    {
                        type: 'textbox',
                        name: 'recipe_total_time',
                        label: 'Total Time'
                    },
                    {
                        type: 'textbox',
                        name: 'recipe_difficulty',
                        label: 'Difficulty'
                    },
                    {
                        type: 'textbox',
                        name: 'recipe_summary',
                        label: 'Summary',
                        multiline: true,
                    },
                    {
                        type: 'checkbox',
                        name: 'recipe_print',
                        label: 'Show Print Option?',
                        checked : true
                    },
                    {
                        type   : 'container',
                        name   : 'recipe_help_2',
                        label  : 'Note:',
                        html   : 'Enter each ingredient and step in the instructions in a new line.'
                    },
                    {
                        type: 'textbox',
                        name: 'recipe_ingredients',
                        label: 'Ingredients*',
                        multiline: true,
                        minWidth: 300,
                        minHeight: 100,
                        onclick: function(e) {
                            jQuery(e.target).css('border-color', '');
                        }
                    },
                    {
                        type: 'textbox',
                        name: 'recipe_instructions',
                        label: 'Instructions*',
                        multiline: true,
                        minWidth: 300,
                        minHeight: 100,
                        onclick: function(e) {
                            jQuery(e.target).css('border-color', '');
                        }
                    },
                    
                    ],
                    onsubmit: function( e ) {
                        if(e.data.recipe_name === '' || e.data.recipe_ingredients === '' || e.data.recipe_instructions === '') {
                            var window_id = this._id;
                            var inputs = jQuery('#' + window_id + '-body').find('.mce-formitem input');
                            var textareas = jQuery('#' + window_id + '-body').find('.mce-formitem textarea');
                            editor.windowManager.alert('Please fill the name, ingredients, and instructions.');
                            if(e.data.recipe_name === '') {
                                jQuery(inputs.get(0)).css('border-color', 'red');
                            }
                            if(e.data.recipe_ingredients === '') {
                                jQuery(textareas.get(1)).css('border-color', 'red');
                            }
                            if(e.data.recipe_instructions === '') {
                                jQuery(textareas.get(2)).css('border-color', 'red');
                            }
                            return false;
                        }

                        var html_output = '';
                        var recipe_name = e.data.recipe_name;
                        var recipe_image_url = e.data.recipe_image_url;
                        var recipe_servings = e.data.recipe_servings;
                        var recipe_prep_time = e.data.recipe_prep_time.toUpperCase();
                        var recipe_cook_time = e.data.recipe_cook_time.toUpperCase();
                        var recipe_total_time = e.data.recipe_total_time.toUpperCase();
                        var recipe_difficulty = e.data.recipe_difficulty;
                        var recipe_summary = e.data.recipe_summary;
                        var recipe_print = e.data.recipe_print;
                        var recipe_ingredients = e.data.recipe_ingredients; lines = recipe_ingredients.split(/\r\n|\r|\n/); recipe_ingredients = lines.join(";");
                        var recipe_instructions = e.data.recipe_instructions; lines = recipe_instructions.split(/\r\n|\r|\n/); recipe_instructions = lines.join(";");
                        
                        var html_output = '[lt_recipe ';
                        if(recipe_name != '')           html_output = html_output + ' name="' + recipe_name + '"';
                        if(recipe_servings != '')       html_output = html_output + ' servings="' + recipe_servings + '"';
                        if(recipe_prep_time != '')      html_output = html_output + ' prep_time="' + recipe_prep_time + '"';
                        if(recipe_cook_time != '')      html_output = html_output + ' cook_time="' + recipe_cook_time + '"';
                        if(recipe_total_time != '')     html_output = html_output + ' total_time="' + recipe_total_time + '"';
                        if(recipe_difficulty != '')     html_output = html_output + ' difficulty="' + recipe_difficulty + '"';
                        if(recipe_summary != '')        html_output = html_output + ' summary="' + recipe_summary + '"';
                        if(recipe_print)                html_output = html_output + ' print="' + 'yes' + '"';
                        if(recipe_image_url != '')      html_output = html_output + ' image="' + recipe_image_url + '"';
                        if(recipe_ingredients != '')    html_output = html_output + ' ingredients="' + recipe_ingredients + '"';
                        if(recipe_instructions != '')   html_output = html_output + ' ]' + recipe_instructions + '[/lt_recipe]';
                        editor.insertContent(html_output);
                    }
                });
            }
        });
    });
})();



function kale_lt_shortcode_upload_file(e){
	wp.media.editor.open();
	window.send_to_editor = function(html) {
		var recipe_image_url = jQuery(html).attr('src');
		jQuery(".mce-recipe_image_url").val(recipe_image_url);
	}
}