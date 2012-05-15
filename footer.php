
   
<div id="footer">
    <div id="footer_left">
    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Left Footer Widget')) : else : ?>
        <?php endif; ?>
    </div>
    <div id="footer_right">
       <div class="right_footer_widget"><h2>Lokalavdelningar</h2></div>
        <div id="map_canvas" class="right_footer_widget"></div>
    </div>
</div>
</div>
<div id="below_footer"></div>
</div>
</div></div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<div id="fb-root"></div>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/footerBasedJs.js"></script>

<?php wp_footer(); ?>
</body>

</html>
