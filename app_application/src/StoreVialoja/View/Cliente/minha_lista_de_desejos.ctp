<section class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right">
    <div id="content">
        <div class="my-account">
            <div class="my-wishlist">
                <div class="page-title title-buttons">
                    <h1>Minha Lista de Desejos</h1>
                </div>
                <ul class="messages">
                    <li class="success-msg">
                        <ul>
                            <li><span>Fauxwaii Shirt - Old has been added to your wishlist. Click <a href="/">here</a> to continue shopping.</span></li>
                        </ul>
                    </li>
                </ul>
                <form id="wishlist-view-form" action="/wishlist/index/update/wishlist_id/7/" method="post">
                    <fieldset>
                        <input name="form_key" type="hidden" value="XLgnfXA6ePqiyOFf" />
                        <table class="data-table" id="wishlist-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Details and Comment</th>
                                    <th>Add to Cart</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="item_8">
                                    <td><a class="product-image" href="/farlap-shirt-ruby-wines-388.html" title="Farlap Shirt - Ruby Wines">
                                        <img src="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/small_image/113x113/9df78eab33525d08d6e5fb8d27136e95/p/r/product-12-1-500x717_15.jpg" width="113" height="113" alt="Farlap Shirt - Ruby Wines" />
                                        </a>
                                    </td>
                                    <td>
                                        <h3 class="product-name"><a href="/farlap-shirt-ruby-wines-388.html" title="Farlap Shirt - Ruby Wines">Farlap Shirt - Ruby Wines</a></h3>
                                        <div class="description std">
                                            <div class="inner">Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</div>
                                        </div>
                                        <textarea name="description[8]" rows="3" cols="5" onfocus="focusComment(this)" onblur="focusComment(this)" title="Comment">Please, enter your comments...</textarea>
                                    </td>
                                    <td>
                                        <div class="cart-cell">
                                            <div class="price-box">
                                                <p class="old-price">
                                                    <span class="price-label">Regular Price:</span>
                                                    <span class="price" id="old-price-204">
                                                    $234.00                </span>
                                                </p>
                                                <p class="special-price">
                                                    <span class="price-label">Special Price</span>
                                                    <span class="price" id="product-price-204">
                                                    $190.00                </span>
                                                </p>
                                            </div>
                                            <div class="add-to-cart-alt">
                                                <input type="text" class="input-text qty validate-not-negative-number" name="qty[8]" value="1" />
                                                <button type="button" title="Add to Cart" onclick="addWItemToCart(8);" class="button btn-cart"><span><span>Add to Cart</span></span></button>
                                            </div>
                                            <p><a class="link-edit" href="/wishlist/index/configure/id/8/">Edit</a></p>
                                        </div>
                                    </td>
                                    <td><a href="/wishlist/index/remove/item/8/" onclick="return confirmRemoveWishlistItem();" title="Remove Item"
                                        class="btn-remove btn-remove2">Remove item</a></td>
                                </tr>
                                <tr id="item_9">
                                    <td><a class="product-image" href="/fauxwaii-shirt-old.html" title="Fauxwaii Shirt - Old">
                                        <img src="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/small_image/113x113/9df78eab33525d08d6e5fb8d27136e95/p/r/product-8-1-500x717_3.jpg" width="113" height="113" alt="Fauxwaii Shirt - Old" />
                                        </a>
                                    </td>
                                    <td>
                                        <h3 class="product-name"><a href="/fauxwaii-shirt-old.html" title="Fauxwaii Shirt - Old">Fauxwaii Shirt - Old</a></h3>
                                        <div class="description std">
                                            <div class="inner">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin</div>
                                        </div>
                                        <textarea name="description[9]" rows="3" cols="5" onfocus="focusComment(this)" onblur="focusComment(this)" title="Comment">Please, enter your comments...</textarea>
                                    </td>
                                    <td>
                                        <div class="cart-cell">
                                            <div class="price-box">
                                                <p class="old-price">
                                                    <span class="price-label">Regular Price:</span>
                                                    <span class="price" id="old-price-201">
                                                    $290.00                </span>
                                                </p>
                                                <p class="special-price">
                                                    <span class="price-label">Special Price</span>
                                                    <span class="price" id="product-price-201">
                                                    $200.00                </span>
                                                </p>
                                            </div>
                                            <div class="add-to-cart-alt">
                                                <input type="text" class="input-text qty validate-not-negative-number" name="qty[9]" value="1" />
                                                <button type="button" title="Add to Cart" onclick="addWItemToCart(9);" class="button btn-cart"><span><span>Add to Cart</span></span></button>
                                            </div>
                                            <p><a class="link-edit" href="/wishlist/index/configure/id/9/">Edit</a></p>
                                        </div>
                                    </td>
                                    <td><a href="/wishlist/index/remove/item/9/" onclick="return confirmRemoveWishlistItem();" title="Remove Item"
                                        class="btn-remove btn-remove2">Remove item</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <script type="text/javascript">
                            //<![CDATA[
                                decorateTable('wishlist-table');
                            
                                    
                                    function focusComment(obj) {
                                        if( obj.value == 'Please, enter your comments...' ) {
                                            obj.value = '';
                                        } else if( obj.value == '' ) {
                                            obj.value = 'Please, enter your comments...';
                                        }
                                    }
                                        
                                        function addWItemToCart(itemId) {
                                            var url = '/wishlist/index/cart/item/%item%/uenc/aHR0cDovL3ZlbnVzZGVtby5jb20vbWFnZW50by9zdXBlcnN0b3JlL2luZGV4LnBocC93aXNobGlzdC9pbmRleC9pbmRleC93aXNobGlzdF9pZC83Lz9fX19TSUQ9VSZfX19zdG9yZT1kZWZhdWx0/form_key/XLgnfXA6ePqiyOFf/';
                                            url = url.gsub('%item%', itemId);
                                            var form = $('wishlist-view-form');
                                            if (form) {
                                                var input = form['qty[' + itemId + ']'];
                                                if (input) {
                                                    var separator = (url.indexOf('?') >= 0) ? '&' : '?';
                                                    url += separator + input.name + '=' + encodeURIComponent(input.value);
                                                }
                                            }
                                            setLocation(url);
                                        }
                                        
                                    function confirmRemoveWishlistItem() {
                                        return confirm('Are you sure you want to remove this product from your wishlist?');
                                    }
                                    //]]>
                        </script>
                        <script type="text/javascript">decorateTable('wishlist-table')</script>
                        <div class="buttons-set buttons-set2">
                            <button type="submit" name="save_and_share" title="Share Wishlist" class="button btn-share"><span><span>Share Wishlist</span></span></button>
                            <button type="button" title="Add All to Cart" onclick="addAllWItemsToCart()" class="button btn-add"><span><span>Add All to Cart</span></span></button>
                            <button type="submit" name="do" title="Update Wishlist" class="button btn-update"><span><span>Update Wishlist</span></span></button>
                        </div>
                    </fieldset>
                </form>
                <form id="wishlist-allcart-form" action="/wishlist/index/allcart/" method="post">
                    <input name="form_key" type="hidden" value="XLgnfXA6ePqiyOFf" />
                    <div class="no-display">
                        <input type="hidden" name="wishlist_id" id="wishlist_id" value="7" />
                        <input type="hidden" name="qty" id="qty" value="" />
                    </div>
                </form>
                <script type="text/javascript">
                    //<![CDATA[
                        var wishlistForm = new Validation($('wishlist-view-form'));
                        var wishlistAllCartForm = new Validation($('wishlist-allcart-form'));
                    
                        function calculateQty() {
                            var itemQtys = new Array();
                            $$('#wishlist-view-form .qty').each(
                                function (input, index) {
                                    var idxStr = input.name;
                                    var idx = idxStr.replace( /[^\d.]/g, '' );
                                    itemQtys[idx] = input.value;
                                }
                            );
                    
                            $$('#qty')[0].value = JSON.stringify(itemQtys);
                        }
                    
                        function addAllWItemsToCart() {
                            calculateQty();
                            wishlistAllCartForm.form.submit();
                        }
                    //]]>
                </script>
            </div>
            <div class="buttons-set">
                <p class="back-link"><a href="/customer/account/"><small>&laquo; </small>Back</a></p>
            </div>
        </div>
    </div>
</section>