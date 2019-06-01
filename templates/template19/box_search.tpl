<script language="javascript">
sflag=false;
function sopen()
{
	if(sflag==true)
	{
		$('#search_menu_content').slideUp("fast");
		sflag=false;
	}
	else
	{
		$('#search_menu_content').slideDown("fast");
		sflag=true;
	}
}

function snumbers()
{
	x=0;
	if(document.getElementById('sphoto') && document.getElementById('sphoto').checked){x++;}
	if(document.getElementById('svideo') && document.getElementById('svideo').checked){x++;}
	if(document.getElementById('saudio') && document.getElementById('saudio').checked){x++;}
	if(document.getElementById('svector') && document.getElementById('svector').checked){x++;}
	
	if(x=={XSEARCH})
	{
		sword="{WORD_ALL}";
	}
	else
	{
		sword="{WORD_TYPES}"+": "+x;
	}

	document.getElementById('stl').innerHTML=sword;
}

function search_go(value)
{
	document.getElementById('search').value=value;
	$('#site_search').submit();
}

function show_search()
{
	var req = new JsHttpRequest();
	
	 req.onreadystatechange = function()
    {
        if (req.readyState == 4)
        {
			search_result=req.responseText
			if(search_result!="")
			{
				$('#instant_search').slideDown("fast");
				document.getElementById('instant_search').innerHTML =search_result;
			}
			else
			{
				document.getElementById('instant_search').style.display='none';
			}
        }
    }
    req.open(null, '{SITE_ROOT}members/search_lite.php', true);
    req.send( { search: document.getElementById('search').value } );
}
</script>
<form method='get' action='{SITE_ROOT}index.php' id='site_search'>
	<div class="ibox_search">
		<input type='text' name='search' id="search" value='{SEARCH}' onClick="this.value='';" autocomplete="off">
	</div>
	<div class="search_menu">
		<div>
			<a href="javascript:sopen()"  id="stl">{WORD_ALL}</a><span>&nbsp;</span>
		</div>
	</div>
	<input class="ibox_search_submit" type='submit' value='{lang.Search}'>

	<div id="search_menu_content">
		<ul>
			{if sitephoto}<li><input id="sphoto" name="sphoto" type="checkbox" {PHOTO_CHECKED} onClick="snumbers()"><label for="sphotos">Photos</label></li>{/if}
			{if sitevideo}<li><input id="svideo" name="svideo" type="checkbox" {VIDEO_CHECKED} onClick="snumbers()"><label for="svideos">Videos</label></li>{/if}
			{if siteaudio}<li><input id="saudio" name="saudio" type="checkbox" {AUDIO_CHECKED} onClick="snumbers()"><label for="saudio">Audio</label></li>{/if}
			{if sitevector}<li><input id="svector" name="svector" type="checkbox" {VECTOR_CHECKED} onClick="snumbers()"><label for="svector">Vector</label></li>{/if}
		</ul>
	</div>
</form>
<div id="instant_search"></div>