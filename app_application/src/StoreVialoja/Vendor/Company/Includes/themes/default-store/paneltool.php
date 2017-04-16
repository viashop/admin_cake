
            <script type="text/javascript">
                jQuery(document).ready( function (){
                	jQuery(".paneltool .panelbutton").click( function(){	
                		jQuery(this).parent().toggleClass("active");
                	} );
                } );
                
            </script>
            <div id="ves-paneltool" class="hidden-md hidden-sm hidden-xs">
                <div class="paneltool themetool">
                    <div class="panelbutton">
                        <i class="glyphicon glyphicon-cog"></i>
                    </div>
                    <div class="panelcontent ">
                        <div class="panelinner">
                            <h4>Panel Tool</h4>
                            <form action="/" method="post" class="clearfix" id="paneltool_form">
                                <div class="group-input">
                                    <div class="store-switcher">
                                        <label for="select-store">Select Store:</label>
                                        <select id="select-store" title="Select Store" onchange="location.href=this.value">
                                            <option value="/?___store=english2">Hitech</option>
                                            <option value="" selected="selected">Main Store</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="group-input">
                                    <label>Theme Skins</label>
                                    <select name="userparams[skin]">
                                        <option value="">default</option>
                                        <option value="cyan" >cyan</option>
                                        <option value="dark" >dark</option>
                                        <option value="hitech" >hitech</option>
                                        <option value="orange" >orange</option>
                                        <option value="red" >red</option>
                                    </select>
                                </div>
                                <p class="group-input">
                                    <label>Direction</label>
                                    <select name="userparams[direction]">
                                        <option value="ltr" >Left To Right</option>
                                        <option value="rtl" >Right To Left</option>
                                    </select>
                                </p>
                                <p class="group-input">
                                    <label>Layout</label>
                                    <select name="userparams[layout]">
                                        <option value="fullwidth"  selected="selected" >Full Width</option>
                                        <option value="boxed-lg" >Boxed Desktop Large</option>
                                        <option value="boxed-md" >Boxed Desktop Mediumn</option>
                                    </select>
                                </p>
                                <p class="group-input">
                                    <label>Header Layout</label>
                                    <select name="userparams[header_layout]">
                                        <option value="default" >Default</option>
                                    </select>
                                </p>
                                <p>
                                    <input type="hidden" value="0" id="vesreset" name="vesreset"/>
                                    <button value="Apply" class="btn btn-small" name="btn-save" type="submit">Apply</button>
                                    <a class="btn btn-small" href="javascript:;" onclick="jQuery('#vesreset').val(1);jQuery('#paneltool_form').submit() "><span>Reset</span></a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="paneltool editortool">
                    <div class="panelbutton">
                        <i class="glyphicon glyphicon-adjust"></i>
                    </div>
                    <div class="panelcontent editortool">
                        <div class="panelinner">
                            <h4>Live Theme Editor</h4>
                            <div class="clearfix" id="customize-body">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li><a href="#tab-selectors">Layout Selectors</a></li>
                                    <li><a href="#tab-elements">Layout Elements</a></li>
                                </ul>
                                <div class="tab-content" >
                                    <div class="tab-pane" id="tab-selectors">
                                        <div class="accordion">
                                            <div class="accordion-group  panel panel-default clearfix">
                                                <div class="accordion-heading panel-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordion" href="#collapsebody">
                                                    Body Content	 
                                                    </a>
                                                </div>
                                                <div id="collapsebody" class="accordion-body panel-collapse collapse  in ">
                                                    <div class="accordion-inner panel-body clearfix">
                                                        <div class="form-group">
                                                            <label>Background Color</label>
                                                            <input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group background-images">
                                                            <label>Background Image</label>
                                                            <a class="clear-bg label label-success" href="#">Clear</a>
                                                            <input value="" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body" data-attrs="background-image">
                                                            <div class="clearfix"></div>
                                                            <p><em style="font-size:10px">Those Images in folder YOURTHEME/images/patterns/</em></p>
                                                            <div class="bi-wrapper clearfix">
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern1.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern1.png" data-val="../../img/patterns/pattern1.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern10.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern10.png" data-val="../../img/patterns/pattern10.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern11.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern11.png" data-val="../../img/patterns/pattern11.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern12.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern12.png" data-val="../../img/patterns/pattern12.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern13.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern13.png" data-val="../../img/patterns/pattern13.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern14.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern14.png" data-val="../../img/patterns/pattern14.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern15.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern15.png" data-val="../../img/patterns/pattern15.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern16.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern16.png" data-val="../../img/patterns/pattern16.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern2.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern2.png" data-val="../../img/patterns/pattern2.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern3.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern3.png" data-val="../../img/patterns/pattern3.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern4.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern4.png" data-val="../../img/patterns/pattern4.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern5.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern5.png" data-val="../../img/patterns/pattern5.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern6.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern6.png" data-val="../../img/patterns/pattern6.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern7.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern7.png" data-val="../../img/patterns/pattern7.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern8.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern8.png" data-val="../../img/patterns/pattern8.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern9.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern9.png" data-val="../../img/patterns/pattern9.png"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Background Content</label>
                                                            <input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body #page" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group background-images">
                                                            <label>Background Image</label>
                                                            <a class="clear-bg label label-success" href="#">Clear</a>
                                                            <input value="" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body #page" data-attrs="background-image">
                                                            <div class="clearfix"></div>
                                                            <p><em style="font-size:10px">Those Images in folder YOURTHEME/images/patterns/</em></p>
                                                            <div class="bi-wrapper clearfix">
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern1.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern1.png" data-val="../../img/patterns/pattern1.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern10.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern10.png" data-val="../../img/patterns/pattern10.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern11.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern11.png" data-val="../../img/patterns/pattern11.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern12.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern12.png" data-val="../../img/patterns/pattern12.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern13.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern13.png" data-val="../../img/patterns/pattern13.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern14.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern14.png" data-val="../../img/patterns/pattern14.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern15.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern15.png" data-val="../../img/patterns/pattern15.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern16.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern16.png" data-val="../../img/patterns/pattern16.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern2.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern2.png" data-val="../../img/patterns/pattern2.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern3.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern3.png" data-val="../../img/patterns/pattern3.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern4.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern4.png" data-val="../../img/patterns/pattern4.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern5.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern5.png" data-val="../../img/patterns/pattern5.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern6.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern6.png" data-val="../../img/patterns/pattern6.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern7.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern7.png" data-val="../../img/patterns/pattern7.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern8.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern8.png" data-val="../../img/patterns/pattern8.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern9.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern9.png" data-val="../../img/patterns/pattern9.png"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Font-Size</label>
                                                            <select name="customize[body][]" data-match="body" class="input-setting" data-selector="body #page" data-attrs="font-size">
                                                                <option value="">Inherit</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                            </select>
                                                            <a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Text</label>
                                                            <input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body #page" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Link Color</label>
                                                            <input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body #page a" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Link Hover Color</label>
                                                            <input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="a:hover" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-group  panel panel-default clearfix">
                                                <div class="accordion-heading panel-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordion" href="#collapsetopbar">
                                                    TopBar	 
                                                    </a>
                                                </div>
                                                <div id="collapsetopbar" class="accordion-body panel-collapse collapse ">
                                                    <div class="accordion-inner panel-body clearfix">
                                                        <div class="form-group">
                                                            <label>Background Color</label>
                                                            <input value="" size="10" name="customize[topbar][]" data-match="topbar" type="text" class="input-setting" data-selector="#topbar" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Text</label>
                                                            <input value="" size="10" name="customize[topbar][]" data-match="topbar" type="text" class="input-setting" data-selector="#topbar" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Border Color</label>
                                                            <input value="" size="10" name="customize[topbar][]" data-match="topbar" type="text" class="input-setting" data-selector="#topbar" data-attrs="border-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Link</label>
                                                            <input value="" size="10" name="customize[topbar][]" data-match="topbar" type="text" class="input-setting" data-selector="#topbar a" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Link Hover</label>
                                                            <input value="" size="10" name="customize[topbar][]" data-match="topbar" type="text" class="input-setting" data-selector="#topbar a:hover" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Background Icon</label>
                                                            <input value="" size="10" name="customize[topbar][]" data-match="topbar" type="text" class="input-setting" data-selector=".cart-inner .fa" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Background Input Search</label>
                                                            <input value="" size="10" name="customize[topbar][]" data-match="topbar" type="text" class="input-setting" data-selector="#topbar .form-search #search" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Text Input Search</label>
                                                            <input value="" size="10" name="customize[topbar][]" data-match="topbar" type="text" class="input-setting" data-selector="#topbar .form-search #search" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-group  panel panel-default clearfix">
                                                <div class="accordion-heading panel-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordion" href="#collapseheader-main">
                                                    Header	 
                                                    </a>
                                                </div>
                                                <div id="collapseheader-main" class="accordion-body panel-collapse collapse ">
                                                    <div class="accordion-inner panel-body clearfix">
                                                        <div class="form-group">
                                                            <label>Background Color</label>
                                                            <input value="" size="10" name="customize[header-main][]" data-match="header-main" type="text" class="input-setting" data-selector="#header-main" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Text</label>
                                                            <input value="" size="10" name="customize[header-main][]" data-match="header-main" type="text" class="input-setting" data-selector="#header-main" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Link</label>
                                                            <input value="" size="10" name="customize[header-main][]" data-match="header-main" type="text" class="input-setting" data-selector="#header-main a" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Link Hover</label>
                                                            <input value="" size="10" name="customize[header-main][]" data-match="header-main" type="text" class="input-setting" data-selector="#header-main a:hover" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-group  panel panel-default clearfix">
                                                <div class="accordion-heading panel-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordion" href="#collapseves-mainnav">
                                                    MainMenu	 
                                                    </a>
                                                </div>
                                                <div id="collapseves-mainnav" class="accordion-body panel-collapse collapse ">
                                                    <div class="accordion-inner panel-body clearfix">
                                                        <div class="form-group">
                                                            <label>Background Color</label>
                                                            <input value="" size="10" name="customize[ves-mainnav][]" data-match="ves-mainnav" type="text" class="input-setting" data-selector="#ves-mainnav" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Link</label>
                                                            <input value="" size="10" name="customize[ves-mainnav][]" data-match="ves-mainnav" type="text" class="input-setting" data-selector="#ves-mainnav .navbar-nav > li > a" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Link Hover</label>
                                                            <input value="" size="10" name="customize[ves-mainnav][]" data-match="ves-mainnav" type="text" class="input-setting" data-selector="#ves-mainnav .navbar-nav > li > a:hover" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Border Color</label>
                                                            <input value="" size="10" name="customize[ves-mainnav][]" data-match="ves-mainnav" type="text" class="input-setting" data-selector="#ves-mainnav .navbar-inverse" data-attrs="border-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Dropdow - Background Color</label>
                                                            <input value="" size="10" name="customize[ves-mainnav][]" data-match="ves-mainnav" type="text" class="input-setting" data-selector="#ves-mainnav .navbar-nav > li .dropdown-menu" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-group  panel panel-default clearfix">
                                                <div class="accordion-heading panel-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordion" href="#collapsefooter">
                                                    Footer	 
                                                    </a>
                                                </div>
                                                <div id="collapsefooter" class="accordion-body panel-collapse collapse ">
                                                    <div class="accordion-inner panel-body clearfix">
                                                        <div class="form-group">
                                                            <label>Background Color</label>
                                                            <input value="" size="10" name="customize[footer][]" data-match="footer" type="text" class="input-setting" data-selector="#footer" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Text</label>
                                                            <input value="" size="10" name="customize[footer][]" data-match="footer" type="text" class="input-setting" data-selector="#footer, #footer span" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Icon Social</label>
                                                            <input value="" size="10" name="customize[footer][]" data-match="footer" type="text" class="input-setting" data-selector=".social .fa" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Title</label>
                                                            <input value="" size="10" name="customize[footer][]" data-match="footer" type="text" class="input-setting" data-selector=".custom-abs h3, .custom-footer-links h3" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Link</label>
                                                            <input value="" size="10" name="customize[footer][]" data-match="footer" type="text" class="input-setting" data-selector="#footer a, .custom-links a" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Link Hover</label>
                                                            <input value="" size="10" name="customize[footer][]" data-match="footer" type="text" class="input-setting" data-selector="#footer a:hover, .custom-links a:hover" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group background-images">
                                                            <label>Background Image</label>
                                                            <a class="clear-bg label label-success" href="#">Clear</a>
                                                            <input value="" name="customize[footer][]" data-match="footer" type="text" class="input-setting" data-selector="#footer" data-attrs="background-image">
                                                            <div class="clearfix"></div>
                                                            <p><em style="font-size:10px">Those Images in folder YOURTHEME/images/patterns/</em></p>
                                                            <div class="bi-wrapper clearfix">
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern1.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern1.png" data-val="../../img/patterns/pattern1.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern10.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern10.png" data-val="../../img/patterns/pattern10.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern11.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern11.png" data-val="../../img/patterns/pattern11.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern12.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern12.png" data-val="../../img/patterns/pattern12.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern13.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern13.png" data-val="../../img/patterns/pattern13.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern14.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern14.png" data-val="../../img/patterns/pattern14.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern15.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern15.png" data-val="../../img/patterns/pattern15.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern16.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern16.png" data-val="../../img/patterns/pattern16.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern2.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern2.png" data-val="../../img/patterns/pattern2.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern3.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern3.png" data-val="../../img/patterns/pattern3.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern4.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern4.png" data-val="../../img/patterns/pattern4.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern5.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern5.png" data-val="../../img/patterns/pattern5.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern6.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern6.png" data-val="../../img/patterns/pattern6.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern7.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern7.png" data-val="../../img/patterns/pattern7.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern8.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern8.png" data-val="../../img/patterns/pattern8.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern9.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern9.png" data-val="../../img/patterns/pattern9.png"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-group  panel panel-default clearfix">
                                                <div class="accordion-heading panel-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordion" href="#collapsepowered">
                                                    Powered	 
                                                    </a>
                                                </div>
                                                <div id="collapsepowered" class="accordion-body panel-collapse collapse ">
                                                    <div class="accordion-inner panel-body clearfix">
                                                        <div class="form-group">
                                                            <label>Background Color</label>
                                                            <input value="" size="10" name="customize[powered][]" data-match="powered" type="text" class="input-setting" data-selector="#powered" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Text</label>
                                                            <input value="" size="10" name="customize[powered][]" data-match="powered" type="text" class="input-setting" data-selector="#powered" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Link</label>
                                                            <input value="" size="10" name="customize[powered][]" data-match="powered" type="text" class="input-setting" data-selector="#powered a" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Link Hover</label>
                                                            <input value="" size="10" name="customize[powered][]" data-match="powered" type="text" class="input-setting" data-selector="#powered a:hover" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group background-images">
                                                            <label>Background Image</label>
                                                            <a class="clear-bg label label-success" href="#">Clear</a>
                                                            <input value="" name="customize[powered][]" data-match="powered" type="text" class="input-setting" data-selector="#powered" data-attrs="background-image">
                                                            <div class="clearfix"></div>
                                                            <p><em style="font-size:10px">Those Images in folder YOURTHEME/images/patterns/</em></p>
                                                            <div class="bi-wrapper clearfix">
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern1.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern1.png" data-val="../../img/patterns/pattern1.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern10.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern10.png" data-val="../../img/patterns/pattern10.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern11.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern11.png" data-val="../../img/patterns/pattern11.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern12.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern12.png" data-val="../../img/patterns/pattern12.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern13.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern13.png" data-val="../../img/patterns/pattern13.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern14.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern14.png" data-val="../../img/patterns/pattern14.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern15.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern15.png" data-val="../../img/patterns/pattern15.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern16.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern16.png" data-val="../../img/patterns/pattern16.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern2.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern2.png" data-val="../../img/patterns/pattern2.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern3.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern3.png" data-val="../../img/patterns/pattern3.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern4.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern4.png" data-val="../../img/patterns/pattern4.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern5.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern5.png" data-val="../../img/patterns/pattern5.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern6.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern6.png" data-val="../../img/patterns/pattern6.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern7.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern7.png" data-val="../../img/patterns/pattern7.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern8.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern8.png" data-val="../../img/patterns/pattern8.png"></div>
                                                                <div style="background:url('/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern9.png') no-repeat center center;" class="pull-left" data-image="/superstore/skin/frontend/default/ves_superstore/images/pattern/pattern9.png" data-val="../../img/patterns/pattern9.png"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-elements">
                                        <div class="accordion">
                                            <div class="accordion-group  panel panel-default clearfix">
                                                <div class="accordion-heading panel-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordion" href="#collapseproduct">
                                                    Products	 
                                                    </a>
                                                </div>
                                                <div id="collapseproduct" class="accordion-body panel-collapse collapse  in ">
                                                    <div class="accordion-inner panel-body clearfix">
                                                        <div class="form-group">
                                                            <label>Color Price</label>
                                                            <input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-block .price" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Special Price</label>
                                                            <input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".special-price .price" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Price Old</label>
                                                            <input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".old-price .price" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Price Tax</label>
                                                            <input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".price .price-tax" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>BgColor Cart</label>
                                                            <input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-block .actions button.btn-cart" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Cart</label>
                                                            <input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-block .actions button.btn-cart" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>BgColor Wishlist</label>
                                                            <input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-block .actions .add-to-links li.wishlist" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Wishlist Icon</label>
                                                            <input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-block .actions .add-to-links li.wishlist .fa" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>BgColor Compare</label>
                                                            <input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-block .actions .add-to-links li.compare" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Color Compare Icon</label>
                                                            <input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-block .actions .add-to-links li.compare .fa" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-group  panel panel-default clearfix">
                                                <div class="accordion-heading panel-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordion" href="#collapsemodules">
                                                    Modules in Sidebar	 
                                                    </a>
                                                </div>
                                                <div id="collapsemodules" class="accordion-body panel-collapse collapse ">
                                                    <div class="accordion-inner panel-body clearfix">
                                                        <div class="form-group">
                                                            <label>Heading Background</label>
                                                            <input value="" size="10" name="customize[modules][]" data-match="modules" type="text" class="input-setting" data-selector=".sidebar .block-title" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Heading Color</label>
                                                            <input value="" size="10" name="customize[modules][]" data-match="modules" type="text" class="input-setting" data-selector=".sidebar .block-title strong span" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Content Background</label>
                                                            <input value="" size="10" name="customize[modules][]" data-match="modules" type="text" class="input-setting" data-selector=".sidebar .block-content" data-attrs="background-color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Content Color</label>
                                                            <input value="" size="10" name="customize[modules][]" data-match="modules" type="text" class="input-setting" data-selector=".sidebar .block-content" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Link Color</label>
                                                            <input value="" size="10" name="customize[modules][]" data-match="modules" type="text" class="input-setting" data-selector=".block-layered-nav dd a" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Title Color</label>
                                                            <input value="" size="10" name="customize[modules][]" data-match="modules" type="text" class="input-setting" data-selector=".block-layered-nav dt, #ves-accordion > li > a" data-attrs="color"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Border Color</label>
                                                            <input value="" size="10" name="customize[modules][]" data-match="modules" type="text" class="input-setting" data-selector=".sidebar .block" data-attrs="border"><a href="#" class="clear-bg label label-success">Clear</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panelbutton label-customize"></div>
                </div>
            </div>
            <script type="text/javascript">
                jQuery('#myTab a').click(function (e) {
                	e.preventDefault();
                	jQuery(this).tab('show');
                })
                jQuery('#myTab a:first').tab('show'); 
                 
                
                var $MAINCONTAINER = jQuery("html");
                
                /**
                 * BACKGROUND-IMAGE SELECTION
                 */
                jQuery(".background-images").each( function(){
                	var $parent = this;
                	var $input  = jQuery(".input-setting", $parent ); 
                	jQuery(".bi-wrapper > div",this).click( function(){
                		 $input.val( jQuery(this).data('val') ); 
                		 jQuery('.bi-wrapper > div', $parent).removeClass('active');
                		 jQuery(this).addClass('active');
                
                		 if( $input.data('selector') ){  
                			jQuery($input.data('selector'), jQuery($MAINCONTAINER) ).css( $input.data('attrs'),'url('+ jQuery(this).data('image') +')' );
                		 }
                	} );
                } ); 
                
                jQuery(".clear-bg").click( function(){
                	var $parent = jQuery(this).parent();
                	var $input  = jQuery(".input-setting", $parent ); 
                	if( $input.val('') ) {
                		if( $parent.hasClass("background-images") ) {
                			jQuery('.bi-wrapper > div',$parent).removeClass('active');	
                			jQuery($input.data('selector'),jQuery("#main-preview iframe").contents()).css( $input.data('attrs'),'none' );
                		}else {
                			$input.attr( 'style','' )	
                		}
                		jQuery($input.data('selector'), jQuery($MAINCONTAINER) ).css( $input.data('attrs'),'inherit' );
                
                	}	
                	$input.val('');
                
                	return false;
                } );
                
                
                
                 jQuery('.accordion-group input.input-setting').each( function(){
                 	 var input = this;
                 	 jQuery(input).attr('readonly','readonly');
                 	 jQuery(input).ColorPicker({
                 	 	onChange:function (hsb, hex, rgb) {
                 	 		jQuery(input).css('backgroundColor', '#' + hex);
                 	 		jQuery(input).val( hex );
                 	 		if( jQuery(input).data('selector') ){  
                				jQuery( $MAINCONTAINER ).find(jQuery(input).data('selector')).css( jQuery(input).data('attrs'),"#"+jQuery(input).val() )
                			}
                 	 	}
                 	 });
                	} );
                 jQuery('.accordion-group select.input-setting').change( function(){
                	var input = this; 
                		if( jQuery(input).data('selector') ){  
                		var ex = jQuery(input).data('attrs')=='font-size'?'px':"";
                		jQuery( $MAINCONTAINER ).find(jQuery(input).data('selector')).css( jQuery(input).data('attrs'), jQuery(input).val() + ex);
                	}
                 } );
                 
                
            </script>