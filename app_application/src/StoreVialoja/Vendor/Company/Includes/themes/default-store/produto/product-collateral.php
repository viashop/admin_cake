<?php
if (isset($GLOBALS['ShopProduto']['descricao_completa']) && !empty($GLOBALS['ShopProduto']['descricao_completa']) 
    || isset($GLOBALS['Shop']['comentarios_produtos']) && $GLOBALS['Shop']['comentarios_produtos'] == 'True') {
?>

<div class="tabs-group product-collateral">
    <div class="row">

        <?php /* ?>

        <div id="tabs" class="htabs col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <?php if (!empty($GLOBALS['ShopProduto']['descricao_completa'])): ?>

            <a rel="nofollow" href="#tab-description">Descrição</a>

            <?php endif ?>
             
            <?php 
            /**
            *<a href="#tab-tags">Product Tags</a>
            **\/            
            ?> 

            <?php if ($GLOBALS['Shop']['comentarios_produtos'] == 'True'): ?>                                    
            <a rel="nofollow" href="#tab-reviews">Comentários <?php echo \Lib\Tools::totalComentariosUrlFacebook(); ?></a>

            <?php endif ?>

        </div>

        <?php */ ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <?php if (!empty($GLOBALS['ShopProduto']['descricao_completa'])): ?>

            <div id="tab-description" class="tab-content box-description">
                <h2>Informações do produto</h2>
                <div class="std">
                    <?php
                    echo \Lib\Tools::htmlentitiesDecodeUTF8( $GLOBALS['ShopProduto']['descricao_completa'] );
                    ?>
                </div>
                <br class="clear clr"/>
            </div>

            <?php endif ?>

             <?php 
            /*            
            ?> 
            <div id="tab-tags" class="tab-content">
                <div class="box-collateral box-tags">
                    <h2>Tags</h2>
                    <form id="addTagForm" action="/superstore/index.php/tag/index/save/product/200/uenc/aHR0cDovL3ZlbnVzZGVtby5jb20vbWFnZW50by9zdXBlcnN0b3JlL2luZGV4LnBocC9kZXNrdG9wcy03L2ZyYW1lZC1zbGVldmUtbWlkLmh0bWw,/" method="get">
                        <div class="form-add">
                            <label for="productTagName">Add Your Tags:</label>
                            <div class="input-box">
                                <input type="text" class="input-text required-entry" name="productTagName" id="productTagName" />
                            </div>
                            <button type="button" title="Add Tags" class="button" onclick="submitTagForm()">
                            <span>
                            <span>Add Tags</span>
                            </span>
                            </button>
                        </div>
                    </form>
                    <p class="note">Use spaces to separate tags. Use single quotes (') for phrases.</p>
                    <script type="text/javascript">
                        //<![CDATA[
                            var addTagFormJs = new VarienForm('addTagForm');
                            function submitTagForm(){
                                if(addTagFormJs.validator.validate()) {
                                    addTagFormJs.form.submit();
                                }
                            }
                        //]]>
                    </script>
                </div>
                <br class="clear clr"/>
            </div>

            <?php 
           
            */            
            ?> 

            <?php if ($GLOBALS['Shop']['comentarios_produtos'] == 'True'): ?>

            <div id="tab-reviews" class="tab-content">
                <div class="box-collateral box-reviews" id="customer-reviews">
                    <h2>Comentários do Facebook</h2>                    

                    <?php

                    echo \Lib\Tools::boxComentarioFacebook();

                    /*

                    <div class="pager">                        



                        <p class="amount">
                            <strong>1 Item(s)</strong>
                        </p>
                        <div class="limiter">
                            <label>Show</label>
                            <select onchange="setLocation(this.value)">
                                <option value="/superstore/index.php/desktops-7/framed-sleeve-mid.html?limit=10" selected="selected">
                                    10            
                                </option>
                                <option value="/superstore/index.php/desktops-7/framed-sleeve-mid.html?limit=20">
                                    20            
                                </option>
                                <option value="/superstore/index.php/desktops-7/framed-sleeve-mid.html?limit=50">
                                    50            
                                </option>
                            </select>
                            per page    
                        </div>
                    </div>
                    <dl>
                        <dt>
                            <a href="/superstore/index.php/review/product/view/id/57/">demo</a> Review by <span>demo</span>            
                        </dt>
                        <dd>
                            <table class="ratings-table">
                                <col width="1" />
                                <col />
                                <tbody>
                                    <tr>
                                        <th>Price</th>
                                        <td>
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Value</th>
                                        <td>
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Quality</th>
                                        <td>
                                            <div class="rating-box">
                                                <div class="rating" style="width:80%;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            demo                <small class="date">(Posted on 3/17/2014)</small>
                        </dd>
                    </dl>
                    <div class="pager">
                        <p class="amount">
                            <strong>1 Item(s)</strong>
                        </p>
                        <div class="limiter">
                            <label>Show</label>
                            <select onchange="setLocation(this.value)">
                                <option value="/superstore/index.php/desktops-7/framed-sleeve-mid.html?limit=10" selected="selected">
                                    10            
                                </option>
                                <option value="/superstore/index.php/desktops-7/framed-sleeve-mid.html?limit=20">
                                    20            
                                </option>
                                <option value="/superstore/index.php/desktops-7/framed-sleeve-mid.html?limit=50">
                                    50            
                                </option>
                            </select>
                            per page    
                        </div>
                    </div>
                    <div class="form-add">
                        <h2>Write Your Own Review</h2>
                        <form action="/superstore/index.php/review/product/post/id/200/" method="post" id="review-form">
                            <input name="form_key" type="hidden" value="zsXfCIrUAlJPi0ry" />
                            <h3>You're reviewing: <span>Framed-Sleeve Mid</span></h3>
                            <h4>How do you rate this product? <em class="required">*</em></h4>
                            <span id="input-message-box"></span>
                            <div class="table-responsive">
                                <table class="data-table table" id="product-review-table">
                                    <col />
                                    <col width="1" />
                                    <col width="1" />
                                    <col width="1" />
                                    <col width="1" />
                                    <col width="1" />
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th><span class="nobr">1 star</span></th>
                                            <th><span class="nobr">2 stars</span></th>
                                            <th><span class="nobr">3 stars</span></th>
                                            <th><span class="nobr">4 stars</span></th>
                                            <th><span class="nobr">5 stars</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Price</th>
                                            <td class="value"><input type="radio" name="ratings[3]" id="Price_1" value="11" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[3]" id="Price_2" value="12" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[3]" id="Price_3" value="13" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[3]" id="Price_4" value="14" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[3]" id="Price_5" value="15" class="radio" /></td>
                                        </tr>
                                        <tr>
                                            <th>Value</th>
                                            <td class="value"><input type="radio" name="ratings[2]" id="Value_1" value="6" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[2]" id="Value_2" value="7" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[2]" id="Value_3" value="8" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[2]" id="Value_4" value="9" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[2]" id="Value_5" value="10" class="radio" /></td>
                                        </tr>
                                        <tr>
                                            <th>Quality</th>
                                            <td class="value"><input type="radio" name="ratings[1]" id="Quality_1" value="1" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[1]" id="Quality_2" value="2" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[1]" id="Quality_3" value="3" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[1]" id="Quality_4" value="4" class="radio" /></td>
                                            <td class="value"><input type="radio" name="ratings[1]" id="Quality_5" value="5" class="radio" /></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="validate_rating" class="validate-rating" value="" />
                            <script type="text/javascript">decorateTable('product-review-table')</script>
                            <ul class="form-list">
                                <li>
                                    <label for="nickname_field" class="required"><em>*</em>Nickname</label>
                                    <div class="input-box">
                                        <input type="text" name="nickname" id="nickname_field" class="input-text required-entry" value="" />
                                    </div>
                                </li>
                                <li>
                                    <label for="summary_field" class="required"><em>*</em>Summary of Your Review</label>
                                    <div class="input-box">
                                        <input type="text" name="title" id="summary_field" class="input-text required-entry" value="" />
                                    </div>
                                </li>
                                <li>
                                    <label for="review_field" class="required"><em>*</em>Review</label>
                                    <div class="input-box">
                                        <textarea name="detail" id="review_field" cols="5" rows="3" class="required-entry"></textarea>
                                    </div>
                                </li>
                            </ul>
                            <div class="buttons-set">
                                <button type="submit" title="Submit Review" class="button"><span><span>Submit Review</span></span></button>
                            </div>
                        </form>
                        <script type="text/javascript">
                            //<![CDATA[
                                var dataForm = new VarienForm('review-form');
                                Validation.addAllThese(
                                [
                                       ['validate-rating', 'Please select one of each of the ratings above', function(v) {
                                            var trs = $('product-review-table').select('tr');
                                            var inputs;
                                            var error = 1;
                            
                                            for( var j=0; j < trs.length; j++ ) {
                                                var tr = trs[j];
                                                if( j > 0 ) {
                                                    inputs = tr.select('input');
                            
                                                    for( i in inputs ) {
                                                        if( inputs[i].checked == true ) {
                                                            error = 0;
                                                        }
                                                    }
                            
                                                    if( error == 1 ) {
                                                        return false;
                                                    } else {
                                                        error = 1;
                                                    }
                                                }
                                            }
                                            return true;
                                        }]
                                ]
                                );
                            //]]>
                        </script>
                    </div>
                

                    <?php */ ?>
                </div>
            </div>

            <?php endif ?>

        </div>
    </div>
</div>
<?php
}
?>