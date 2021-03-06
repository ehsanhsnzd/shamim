<div class="file_image" style="text-align:left">
	<div class="t"><div class="b"><div class="l"><div class="r"><div class="bl"><div class="br"><div class="tl"><div class="tr">
		<div style="margin:0 0 10px 0px"><img src="{PHOTO}"></div>
		{PREVIEW}
	</div></div></div></div></div></div></div></div>
<div class="file_links" style="text-align:left">
<div id="favorite"><a href="{ADD_TO_FAVORITE_LINK}">{ADD_TO_FAVORITE}</a></div>
<div id="downloadsample">{if downloadsample}<a href="{DOWNLOADSAMPLE}">{lang.Download Sample}</a>{/if}</div>
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
<h2>{lang.Related items}:</h2>
{RELATED_ITEMS}
</div>
{/if}

<a name="reviews"></a><div id="reviewscontent" style="clear:both"></div>
&nbsp;
</div>

<div class="file_details">
<h2>{lang.File details}:</h2>
<span><b>{lang.Published}:</b> {PUBLISHED}</span>
<span><table border="0" cellpadding="0" cellspacing="0"><tr><td><b>{lang.Rating}:</b>&nbsp;</td><td style="padding-top:3px">{ITEM_RATING}</td></tr></table></span>
<span><b>{lang.Category}:</b> {CATEGORY}</span>
<span><b>{lang.Viewed}:</b> {VIEWED}</span>
<span><b>{lang.Downloads}:</b> {DOWNLOADS}</span>
<span><b>{lang.Keywords}</b> {KEYWORDS_LITE}</span>
<span><b>{lang.Description}:</b> {DESCRIPTION}</span>
{if duration}<span><b>{lang.Duration}:</b> {DURATION}</span>{/if}
{if format}<span><b>{lang.track format}:</b> {FORMAT}</span>{/if}
{if source}<span><b>{lang.track source}:</b> {SOURCE}</span>{/if}
{if holder}<span><b>{lang.Copyright holder}:</b> {HOLDER}</span>{/if}
{if model}
{MODEL}
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

<h2>{lang.Tools}:</h2>

{if back}<span><a href="{LINK_BACK}">{lang.Back}</a></span>{/if}
<span><a href="{PORTFOLIO_LINK}">{lang.Portfolio}</a></span>
{if messages}<span><a href="{MAIL_LINK}">{lang.Sitemail to user}</a></span>{/if}
{if reviews}<span><a href="#reviews" onclick="reviews_show({ID});">{lang.Reviews}</a></span>{/if}
<span><a href="#reviews"  onclick="tell_show({ID});">{lang.Tell a friend}</a></span>
{if google}<span><a  href="#reviews" onclick="map_show({GOOGLE_X},{GOOGLE_Y});">{lang.Show on Google map}</a></span>{/if}
<span><a href="#share"  onclick="share_show({ID});">{lang.Share this}</a></span>
<div id="share"></div>

</div>

</div>



<div class="file_clear"></div>


