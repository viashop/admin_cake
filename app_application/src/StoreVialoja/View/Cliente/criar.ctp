<section id="columns" class="offcanvas-siderbars">
    <div class="container">
        <div class="breadcrumbs">
            <ul>
                <li class="home">
                    <a href="/" title="Go to Home Page">Home</a>
                    <span>/ </span>
                </li>
                <li class="cms_page">
                    <strong></strong>
                </li>
            </ul>
        </div>
        <div class="row">
            <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="content">
                    <div class="account-create">
                        <div class="page-title">
                            <h1>Create an Account</h1>
                        </div>
                        <form action="/customer/account/createpost/" method="post" id="form-validate">
                            <div class="fieldset">
                                <input type="hidden" name="success_url" value="" />
                                <input type="hidden" name="error_url" value="" />
                                <h2 class="legend">Personal Information</h2>
                                <ul class="form-list">
                                    <li class="fields">
                                        <div class="customer-name">
                                            <div class="field name-firstname">
                                                <label for="firstname" class="required"><em>*</em>First Name</label>
                                                <div class="input-box">
                                                    <input type="text" id="firstname" name="firstname" value="" title="First Name" maxlength="255" class="input-text required-entry  form-control"  />
                                                </div>
                                            </div>
                                            <div class="field name-lastname">
                                                <label for="lastname" class="required"><em>*</em>Last Name</label>
                                                <div class="input-box">
                                                    <input type="text" id="lastname" name="lastname" value="" title="Last Name" maxlength="255" class="input-text required-entry form-control"  />
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="email_address" class="required"><em>*</em>Email Address</label>
                                        <div class="input-box">
                                            <input type="text" name="email" id="email_address" value="" title="Email Address" class="input-text validate-email required-entry" />
                                        </div>
                                    </li>
                                    <li class="control">
                                        <div class="input-box">
                                            <input type="checkbox" name="is_subscribed" title="Sign Up for Newsletter" value="1" id="is_subscribed" class="checkbox" />
                                        </div>
                                        <label for="is_subscribed">Sign Up for Newsletter</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="fieldset">
                                <h2 class="legend">Login Information</h2>
                                <ul class="form-list">
                                    <li class="fields">
                                        <div class="field">
                                            <label for="password" class="required"><em>*</em>Password</label>
                                            <div class="input-box">
                                                <input type="password" name="password" id="password" title="Password" class="input-text required-entry validate-password" />
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label for="confirmation" class="required"><em>*</em>Confirm Password</label>
                                            <div class="input-box">
                                                <input type="password" name="confirmation" title="Confirm Password" id="confirmation" class="input-text required-entry validate-cpassword" />
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div id="window-overlay" class="window-overlay" style="display:none;"></div>
                                <div id="remember-me-popup" class="remember-me-popup" style="display:none;">
                                    <div class="remember-me-popup-head">
                                        <h3>What's this?</h3>
                                        <a href="#" class="remember-me-popup-close" title="Close">Close</a>
                                    </div>
                                    <div class="remember-me-popup-body">
                                        <p>Checking &quot;Remember Me&quot; will let you access your shopping cart on this computer when you are logged out</p>
                                        <div class="remember-me-popup-close-button a-right">
                                            <a href="#" class="remember-me-popup-close button" title="Close"><span>Close</span></a>
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    //<![CDATA[
                                        function toggleRememberMepopup(event){
                                            if($('remember-me-popup')){
                                                var viewportHeight = document.viewport.getHeight(),
                                                    docHeight      = $$('body')[0].getHeight(),
                                                    height         = docHeight > viewportHeight ? docHeight : viewportHeight;
                                                $('remember-me-popup').toggle();
                                                $('window-overlay').setStyle({ height: height + 'px' }).toggle();
                                            }
                                            Event.stop(event);
                                        }
                                    
                                        document.observe("dom:loaded", function() {
                                            new Insertion.Bottom($$('body')[0], $('window-overlay'));
                                            new Insertion.Bottom($$('body')[0], $('remember-me-popup'));
                                    
                                            $$('.remember-me-popup-close').each(function(element){
                                                Event.observe(element, 'click', toggleRememberMepopup);
                                            })
                                            $$('#remember-me-box a').each(function(element) {
                                                Event.observe(element, 'click', toggleRememberMepopup);
                                            });
                                        });
                                    //]]>
                                </script>
                            </div>
                            <div class="buttons-set">
                                <p class="required">* Required Fields</p>
                                <p class="back-link"><a href="/customer/account/login/" class="back-link"><small>&laquo; </small>Back</a></p>
                                <button type="submit" title="Submit" class="button"><span><span>Submit</span></span></button>
                            </div>
                        </form>
                        <script type="text/javascript">
                            //<![CDATA[
                                var dataForm = new VarienForm('form-validate', true);
                                    //]]>
                        </script>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>