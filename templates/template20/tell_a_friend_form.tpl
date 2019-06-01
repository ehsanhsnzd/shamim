<form name="telladd" id="telladd"  Enctype="multipart/form-data">
<input type="hidden" name="id" value="{ID}">

<div class="form_field">
<span>{lang.your name}:</span>
<input class='form-control' type="text" name="name" class="form-control" value="">
</div>

<div class="form_field">
<span>{lang.your e-mail}:</span>
<input class='form-control' type="text" name="email" class="form-control">
</div>

<div class="form_field">
<span>{lang.friend name}:</span>
<input class='form-control' type="text" name="name2" class="form-control">
</div>

<div class="form_field">
<span>{lang.friend e-mail}:</span>
<input class='form-control' type="text" name="email2" class="form-control">
</div>

<div class="form_field">
<img src="{SITE_ROOT}images/c{RR}.gif" width="80" height="30">
<input class='form-control' name="rn1" type="text" value=""><input name="rn2" type="hidden" value="{RR}">
</div>

<div class="form_field">
<input class='btn btn-primary' type="button" onClick="tell_add('telladd');" value="{lang.send}">
</div>

</form>