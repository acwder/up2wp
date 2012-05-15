<form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
    <div>
        <input type="text" onblur="if (this.value == '') {this.value = 'Sök..';}" onfocus="if (this.value == 'Sök..') {this.value = '';}" value="<?php if ($_REQUEST['s']) { the_search_query(); } else { echo 'Sök..'; } ?>" name="s" id="s" />
        
    </div>
</form>

