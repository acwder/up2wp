<ul class="social buttons">
    <li>
        <fb:like href="<?php the_permalink() ?>" send="true"
      showfaces="false" width="120" layout="button_count" style="margin-bottom: 2px;"
      action="like"/>
  </fb:like></li>
  <li>
    <a href="http://twitter.com/share" data-url="<?php the_permalink(); ?>"
      data-text="<?php the_title(); ?>" data-via="ung_pirat"
      class="twitter-share-button">Tweet</a>
  </li>
  <li>
    <g:plusone size="medium" callback="plusone_vote"></g:plusone>
  </li>
</ul>

