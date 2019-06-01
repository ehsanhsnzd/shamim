									<div class="header-top-dropdown text-right">

										<div class="btn-group">
											<a href="{SITE_ROOT}index.php" class="btn btn-default btn-sm"><i class="fa fa-home pr-10"></i> {lang.home}</a>
										</div>

										<div class="btn-group">
											<a href="{SITE_ROOT}fee.php" class="btn btn-default btn-sm"><i class="fa fa-info-circle pr-10"></i> {lang.fee}</a>
										</div>


										{if seller}
										<div class="btn-group">
											<a href="{SITE_ROOT}members/signup.php?utype=seller&step=1" class="btn btn-default btn-sm"><i class="fa fa-user pr-10"></i> {lang.Become a seller}</a>
										</div>
										{/if}
										{if affiliate}
										<div class="btn-group">
											<a href="{SITE_ROOT}members/signup.php?utype=affiliate&step=1" class="btn btn-default btn-sm"><i class="fa fa-user pr-10"></i> {lang.Become an affiliate}</a>
										</div>
										{/if}
										<div class="btn-group dropdown">
											<button type="button" class="btn dropdown-toggle btn-default btn-sm" data-toggle="dropdown"><i class="fa fa-lock pr-10"></i> {lang.Login}</button>
											<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
												<li>
													<form class="login-form margin-clear" method="post" action="{SITE_ROOT}members/check.php">
														<div class="form-group has-feedback">
															<label class="control-label">{lang.Username}</label>
															<input name="l"  type="text" class="form-control" placeholder="">
															<i class="fa fa-user form-control-feedback"></i>
														</div>
														<div class="form-group has-feedback">
															<label class="control-label">{lang.Password}</label>
															<input name="p" type="password" class="form-control" placeholder="">
															<i class="fa fa-lock form-control-feedback"></i>
														</div>
														<button type="submit" class="btn btn-gray btn-sm">{lang.Login}</button>
														<ul>
															<li><a href="{SITE_ROOT}members/forgot.php">{lang.Forgot password}?</a></li>
														</ul>


													</form>
												</li>
											</ul>
										</div>


										<div class="btn-group">
											<a href="{SITE_ROOT}members/signup.php" class="btn btn-default btn-sm"><i class="fa fa-user pr-10"></i> {lang.Sign up}</a>
										</div>
										<div class="btn-group">
											<a href="{SITE_ROOT}contact-us.php" class="btn btn-default btn-sm"><i class="fa fa-phone pr-10"></i> {lang.contact}</a>
										</div>
									</div>