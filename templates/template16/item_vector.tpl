<div class="file_image">
{IMAGE}
<div class="file_links">
<div id="favorite"><a href="{ADD_TO_FAVORITE_LINK}">{ADD_TO_FAVORITE}</a></div>
<div id="downloadsample">{if downloadsample}<a href="{DOWNLOADSAMPLE}">{WORD_DOWNLOADSAMPLE}</a>{/if}</div>
</div>
</div>
<div class="file_price">
{AUTHOR} 
<span><b>{WORD_ID}:</b> {ID}</span>
<div class="line"></div>
{SIZES}
</div>





<div class="file_bottom">

<div class="file_related">
{if related_items}
<div>
<h2>{WORD_RELATED_ITEMS}:</h2>
{RELATED_ITEMS}
</div>
{/if}
&nbsp;
<a name="reviews"></a><div id="reviewscontent" style="clear:both"></div>

</div>

<div class="file_details">
<h2>{WORD_FILE_DETAILS}:</h2>
<span><b>{WORD_PUBLISHED}:</b> {PUBLISHED}</span>
<span><table border="0" cellpadding="0" cellspacing="0"><tr><td><b>{WORD_RATING}:</b>&nbsp;</td><td style="padding-top:3px">{ITEM_RATING}</td></tr></table></span>
<span><b>{WORD_CATEGORY}:</b> {CATEGORY}</span>
<span><b>{WORD_VIEWED}:</b> {VIEWED}</span>
<span><b>{WORD_DOWNLOADS}:</b> {DOWNLOADS}</span>
<span><b>{WORD_KEYWORDS}</b> {KEYWORDS_LITE}</span>
<span><b>{WORD_DESCRIPTION}:</b> {DESCRIPTION}</span>
{if model}
{MODEL}
{/if}
{if flash_version}
<span><b>{WORD_FLASH_VERSION}:</b> {FLASH_VERSION}</span>
{/if}
{if script_version}
<span><b>{WORD_SCRIPT_VERSION}:</b> {SCRIPT_VERSION}</span>
{/if}


<div class="share_box">
	<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</div>

<div class="share_box" style="margin: 10px 3px 0px 10px">
	<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="{URL}" send="false" layout="box_count" show_faces="true" action="like" font=""></fb:like>
</div>

<div class="share_box">
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	<g:plusone size="tall"></g:plusone>
</div>



</div>
<div class="file_tools">

<h2>{WORD_TOOLS}:</h2>

{if back}<span><a href="{LINK_BACK}">{WORD_BACK}</a></span>{/if}
<span><a href="{PORTFOLIO_LINK}">{WORD_PORTFOLIO}</a></span>
{if messages}<span><a href="{MAIL_LINK}">{WORD_MAIL}</a></span>{/if}
{if reviews}<span><a href="#reviews" onclick="reviews_show({ID});">{WORD_REVIEWS}</a></span>{/if}
<span><a href="#reviews"  onclick="tell_show({ID});">{WORD_TELL_A_FRIEND}</a></span>
{if google}<span><a  href="#reviews" onclick="map_show({GOOGLE_X},{GOOGLE_Y});">{WORD_GOOGLE}</a></span>{/if}
<span><a href="#share"  onclick="share_show({ID});">{WORD_SHARE}</a></span>
<div id="share"></div>

</div>

</div>



<div class="file_clear"></div>


{if vector_previews}
<div class="content_body">
<h2 style="margin-bottom:6px;margin-top:0px">{WORD_PREVIEW}:</h2>
{PREVIEW_ITEMS}
</div>
{/if}







