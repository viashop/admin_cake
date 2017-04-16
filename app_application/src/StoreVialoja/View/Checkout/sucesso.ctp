<section id="columns" class="offcanvas-siderbars">
    <div class="container">
        <div class="visible-xs">
            <div class="offcanvas-sidebars-buttons">                    
                <button type="button" data-for="column-right" class="pull-right btn btn-danger">Sidebar Right <i class="glyphicon glyphicon-indent-right"></i></button>
            </div>
        </div>
        <div class="breadcrumbs">
            <ul>
                <li class="home">
                    <a href="http://venusdemo.com/magento/superstore/index.php/" title="Go to Home Page">Home</a>
                    <span>/ </span>
                </li>
                <li class="cms_page">
                    <strong></strong>
                </li>
            </ul>
        </div>
        <div class="row col2-right-layout">
            <section class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right main-column">
                <div id="content">
                    <div class="page-title">
                        <h1>Your order has been received.</h1>
                    </div>
                    <h2 class="sub-title">Thank you for your purchase!</h2>
                    <p>Your order # is: 100000017.</p>
                    <p>You will receive an order confirmation email with details of your order and a link to track its progress.</p>
                    <div class="buttons-set">
                        <button type="button" class="button" title="Continue Shopping" onclick="window.location='http://venusdemo.com/magento/superstore/index.php/'"><span><span>Continue Shopping</span></span></button>
                    </div>
                </div>
            </section>
            <aside class="col-lg-3 col-md-3 col-sm-12 col-xs-12 offcanvas-sidebar" id="ves-columns-right">
                <div id="columns-right" class="sidebar">
                    <div class="block block-list block-compare">
                        <div class="block-title">
                            <strong><span>Compare Products                    </span></strong>
                        </div>
                        <div class="block-content">
                            <p class="empty">You have no items to compare.</p>
                        </div>
                    </div>
                    <script type="text/javascript">
                        //<![CDATA[
                            function validatePollAnswerIsSelected()
                            {
                                var options = $$('input.poll_vote');
                                for( i in options ) {
                                    if( options[i].checked == true ) {
                                        return true;
                                    }
                                }
                                return false;
                            }
                        //]]>
                    </script>
                    <div class="block block-poll">
                        <div class="block-title">
                            <strong><span>Community Poll</span></strong>
                        </div>
                        <form id="pollForm" action="http://venusdemo.com/magento/superstore/index.php/poll/vote/add/poll_id/2/" method="post" onsubmit="return validatePollAnswerIsSelected();">
                            <div class="block-content">
                                <p class="block-subtitle">What is your favorite Magento feature?</p>
                                <ul id="poll-answers">
                                    <li class="odd">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_5" value="5">
                                        <span class="label"><label for="vote_5">Layered Navigation</label></span>
                                    </li>
                                    <li class="even">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_6" value="6">
                                        <span class="label"><label for="vote_6">Price Rules</label></span>
                                    </li>
                                    <li class="odd">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_7" value="7">
                                        <span class="label"><label for="vote_7">Category Management</label></span>
                                    </li>
                                    <li class="last even">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_8" value="8">
                                        <span class="label"><label for="vote_8">Compare Products</label></span>
                                    </li>
                                </ul>
                                <script type="text/javascript">decorateList('poll-answers');</script>
                                <div class="actions">
                                    <button type="submit" title="Vote" class="button"><span><span>Vote</span></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>