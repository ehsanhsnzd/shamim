<div class="page_internal">
<div class="row-fluid">
	<div class="col-lg-3 col-md-3">
		<div class="portfolio_left">

{IMAGE}

<div class="portfolio_title">{lang.contacts information}</div>
<div class="portfolio_box">
	<div><b>{lang.name}:</b> {NAME}</div>
	<div><b>{lang.address}:</b> {CITY}, {COUNTRY}</div>
	<div><b>{lang.website}:</b> {WEBSITE}</div>
	<div><b>{lang.date}:</b> {DATE}</div>
	<div><b>{lang.company}:</b> {COMPANY}</div>
	{if rating}
		{RATING}
	{/if}
</div>


{if notuser}
	<div class="portfolio_title">{lang.tools}</div>
	<div class="portfolio_box">
		{if friends}<div class="box_members" id="friendbox" name="friendbox"><a href="{FRIEND_LINK}">{FRIEND}</a></div>{/if}
		{if messages}<div class="box_members"><a href="{MAIL_LINK}">{lang.sitemail to user}</a></div>{/if}
		{if testimonials}<div class="box_members"><a href="{TESTIMONIAL_LINK}">{lang.add a testimonial}</a></div>{/if}
	</div>
{/if}
{if seller}
	<div class="portfolio_title">{lang.portfolio}</div>
	<div class="portfolio_box">
		{if sitephoto}<div><b>{lang.photos}:</b> <a href="{SITE_ROOT}/index.php?user={USERID}&portfolio=1&sphoto=1">{PHOTO}</a></div>{/if}
		{if sitevideo}<div><b>{lang.video}:</b> <a href="{SITE_ROOT}/index.php?user={USERID}&portfolio=1&svideo=1">{VIDEO}</a></div>{/if}
		{if siteaudio}<div><b>{lang.audio}:</b> <a href="{SITE_ROOT}/index.php?user={USERID}&portfolio=1&saudio=1">{AUDIO}</a></div>{/if}
		{if sitevector}<div><b>{lang.vector}:</b> <a href="{SITE_ROOT}/index.php?user={USERID}&portfolio=1&svector=1">{VECTOR}</a></div>{/if}
		<div><b>{lang.viewed}:</b> {VIEWED}</div>
		<div><b>{lang.downloads}:</b> {DOWNLOADS}</div>
	</div>


{/if}


		</div>
		</div>
		<div class="col-lg-9 col-md-9">
			<div class="portfolio_right">
			<h1>{AUTHOR}</h1>




