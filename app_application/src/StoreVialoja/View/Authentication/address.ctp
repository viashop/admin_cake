<section id="breadcrumb" class="clearfix">
    <div class="container">
        <div class="row">
            <!-- Breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/" title="Return to Home">Home</a>
                <span class="navigation-pipe" >/</span>
                <span class="navigation_page">Your addresses</span>
            </div>
            <!-- /Breadcrumb -->
        </div>
    </div>
</section>
<!-- Content -->
<section id="columns" class="columns-container">
    <div class="container">
        <div class="row">
            <!-- Center -->
            <section id="center_column" class="col-md-12">
                <div class="box">
                    <h1 class="page-subheading">Your addresses</h1>
                    <p class="info-title">
                        To add a new address, please fill out the form below.
                    </p>
                    <p class="required"><sup>*</sup>Required field</p>
                    <form action="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/address" method="post" class="std form-horizontal" id="add_address">
                        <!--h3 class="page-subheading">Your address</h3-->
                        <div class="required form-group">
                            <label class="control-label col-sm-4 col-md-4" for="firstname">First name <sup>*</sup></label>
                            <div class="col-sm-6 col-md-6">
                                <input class="is_required validate form-control" data-validate="isName" type="text" name="firstname" id="firstname" value="Teste" />
                            </div>
                        </div>
                        <div class="required form-group">
                            <label class="control-label col-sm-4 col-md-4" for="lastname">Last name <sup>*</sup></label>
                            <div class="col-sm-6 col-md-6">
                                <input class="is_required validate form-control" data-validate="isName" type="text" id="lastname" name="lastname" value="tetes" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4 col-md-4" for="company">Company</label>
                            <div class="col-sm-6 col-md-6">
                                <input class="form-control validate" data-validate="isGenericName" type="text" id="company" name="company" value="" />
                            </div>
                        </div>
                        <div class="required form-group">
                            <label class="control-label col-sm-4 col-md-4" for="address1">Address <sup>*</sup></label>
                            <div class="col-sm-6 col-md-6">
                                <input class="is_required validate form-control" data-validate="isAddress" type="text" id="address1" name="address1" value="" />
                            </div>
                        </div>
                        <div class="required form-group">
                            <label class="control-label col-sm-4 col-md-4" for="address2">Address (Line 2)</label>
                            <div class="col-sm-6 col-md-6">
                                <input class="validate form-control" data-validate="isAddress" type="text" id="address2" name="address2" value="" />
                            </div>
                        </div>
                        <div class="required form-group">
                            <label class="control-label col-sm-4 col-md-4" for="city">City <sup>*</sup></label>
                            <div class="col-sm-6 col-md-6">
                                <input class="is_required validate form-control" data-validate="isCityName" type="text" name="city" id="city" value="" maxlength="64" />
                            </div>
                        </div>
                        <div class="required id_state form-group">
                            <label class="control-label col-sm-4 col-md-4" for="id_state">State <sup>*</sup></label>
                            <div class="col-sm-6 col-md-6">
                                <select name="id_state" id="id_state" class="form-control">
                                    <option value="">-</option>
                                </select>
                            </div>
                        </div>
                        <div class="required postcode form-group unvisible">
                            <label class="control-label col-sm-4 col-md-4" for="postcode">Zip / Postal Code <sup>*</sup></label>
                            <div class="col-sm-6 col-md-6">
                                <input class="is_required validate form-control" data-validate="isPostCode" type="text" id="postcode" name="postcode" value="" />
                            </div>
                        </div>
                        <div class="required form-group">
                            <label class="control-label col-sm-4 col-md-4" for="id_country">Country<sup>*</sup></label>
                            <div class="col-sm-6 col-md-6">
                                <select id="id_country" class="form-control" name="id_country">
                                    <option value="21" >United States</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group phone-number">
                            <label class="control-label col-sm-4 col-md-4" for="phone">Home phone <sup>**</sup></label>
                            <div class="col-sm-6 col-md-6">
                                <input class="is_required validate form-control" data-validate="isPhoneNumber" type="tel" id="phone" name="phone" value=""  />
                            </div>
                        </div>
                        <div class="inline-infos required"><label class="col-sm-offset-4 col-sm-6">** You must register at least one phone number.</label></div>
                        <div class="clearfix"></div>
                        <div class="required form-group">
                            <label class="control-label col-sm-4 col-md-4" for="phone_mobile">Mobile phone <sup>**</sup></label>
                            <div class="col-sm-6 col-md-6">
                                <input class="validate form-control" data-validate="isPhoneNumber" type="tel" id="phone_mobile" name="phone_mobile" value="" />
                            </div>
                        </div>
                        <div class="required dni form-group unvisible">
                            <label class="control-label col-sm-4 col-md-4" for="dni">Identification number <sup>*</sup></label>
                            <div class="col-sm-6 col-md-6">
                                <input class="is_required form-control" data-validate="isDniLite" type="text" name="dni" id="dni" value="" />
                                <span class="form_info">DNI / NIF / NIE</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4 col-md-4" for="other">Additional information</label>
                            <div class="col-sm-6 col-md-6">
                                <textarea class="validate form-control" data-validate="isMessage" id="other" name="other" cols="26" rows="3" ></textarea>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="required form-group" id="adress_alias">
                            <label class="control-label col-sm-4 col-md-4" for="alias">Please assign an address title for future reference. <sup>*</sup></label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" id="alias" class="is_required validate form-control" data-validate="isGenericName" name="alias" value="My address" />
                            </div>
                        </div>
                        <p class="submit2 text-right">
                            <input type="hidden" name="id_address" value="0" />			<input type="hidden" name="back" value="order.php?step=1&amp;multi-shipping=0" />						<input type="hidden" name="select_address" value="0" />			<input type="hidden" name="token" value="5771fa59620f25a620a58629d536021c" />		
                            <button type="submit" name="submitAddress" id="submitAddress" class="btn btn-default button button-medium">
                            <span>
                            Save
                            <i class="icon-chevron-right right"></i>
                            </span>
                            </button>
                        </p>
                    </form>
                </div>
                <ul class="footer_links clearfix">
                    <li class="pull-left">
                        <a href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/addresses">
                        <span><i class="icon-user"></i> Back to your addresses</span>
                        </a>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</section>