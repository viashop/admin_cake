<div class="admin index large-9 medium-8 columns content">

    <div class="row">

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active" ><a href="#tab-ticket" data-toggle="tab">Ticket</a></li>
                    <li  ><a href="#tab-comments" data-toggle="tab">Comments</a></li>
                    <li  ><a href="#tab-notes" data-toggle="tab">Notes</a></li>
                    <li  ><a href="#tab-rules" data-toggle="tab">Rules</a></li>
                    <div class="btn-group pull-right" style="padding:6px;">
                        <button data-toggle='tooltip' title='Insert Predefined Reply' onClick='showM("?modal=preplies/insert");return false' type="button" class="btn btn-default btn-sm"><i class="fa fa-arrow-right fw"></i> Predefined Reply</button>
                        <button data-toggle='tooltip' title='Edit Ticket' onClick='showM("index.php?modal=tickets/edit&reroute=tickets/manage&routeid=60&id=60&section=");return false' type="button" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></button>                            <a data-toggle='tooltip' title='New Comment' class="btn btn-default btn-sm " href="#" onClick='showM("index.php?modal=comments/add&reroute=tickets/manage&routeid=60&projectid=0&ticketid=60&section=");return false' class='btn btn-xs text-dark'><i class='fa fa-comment'></i></a>                            <a data-toggle='tooltip' title='New Rule' class="btn btn-default btn-sm " href="#" onClick='showM("index.php?modal=escalationrules/add&reroute=tickets/manage&routeid=60&ticketid=60&section=");return false' class='btn btn-xs text-dark'><i class='fa fa-level-up'></i></a>
                        <a data-toggle='tooltip' title='Assign to me' href="?qa=ticketAssignToMe&reroute=tickets/manage&routeid=60&id=60" class="btn btn-default btn-sm"><i class="fa fa-thumb-tack"></i></a>                                                           <a data-toggle='tooltip' title='Close Ticket' href="?qa=ticketClose&reroute=tickets/manage&routeid=60&id=60" class="btn btn-default btn-sm"><i class="fa fa-close"></i></a>
                        <button data-toggle='tooltip' title='Delete Ticket' onClick='showM("?modal=tickets/delete&reroute=tickets/active&routeid=&section=&id=60");return false' type="button" class="btn btn-default btn-sm"><i class="fa fa-trash text-red"></i></button>                     
                    </div>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-ticket">
                        <form role="form" method="post" enctype="multipart/form-data">



                            <div class="form-group">


                                <textarea id="editor1" name="editor1" rows="10" cols="80">
                                    This is my textarea to be replaced with CKEditor.
                                </textarea>

                                
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="checkbox"><label><input type="checkbox" style="margin-top:2px;" name="notificacoes" value="true" checked> Enviar notificações por email</label></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="file" id="file" name="file[]" multiple>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <select class="form-control" id="status" name="status">
                                        <option value="Answered">Respondida</option>
                                        <option value="Closed">Fechado</option>
                                        <option value="In Progress">Em Andamento</option>
                                        <option value="Reopened">Reabrir Ticket</option>
                                    </select>
                                </div>
                                <div class="col-md-3 text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-reply"></i> Responder</button>
                                </div>
                            </div>
                            <input type="hidden" name="action" value="addTicketReply">
                            <input type="hidden" name="ticketid" value="60">
                            <input type="hidden" name="peopleid" value="1">
                            <input type="hidden" name="route" value="tickets/manage">
                            <input type="hidden" name="routeid" value="60">
                        </form>
                        <!-- /.form -->
                        <ul class="timeline" style="margin-top:25px;">
                            <li>
                                <!-- timeline icon -->
                                <img src="https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?d=mm&s=32" class="img-circle timeline-image" style="margin-left: 17px; height:32px;width:32px;" />
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2016-10-06 05:23:11</span>
                                    <h3 class="timeline-header"><a href="#">Demo Admin [Staff]</a> 2 seconds ago</h3>
                                    <div class="timeline-body">

                                        <ul class="todo-list list-inline" id="fileslist">
                                            <li id="" style="width:90%;margin:10px;padding:12px;">
                                                <div class="row">
                                                    <div class="col-xs-1" style="vertical-align:middle"><i class="fa fa-file-image-o"></i></div>
                                                    <div class="col-xs-10">
                                                        13754309_1729628677300180_8727099969778030169_n-19.jpg                                                                  
                                                    </div>
                                                </div>
                                                <div class="pull-right">
                                                    <a href="?qa=download&id=19" class='btn-right text-dark'><i class='fa fa-download'></i></a>&nbsp;
                                                    <a href="#" onClick='showM("?modal=files/delete&reroute=tickets/manage&routeid=60&id=19&section=");return false' class='btn-right text-red'><i class='fa fa-trash-o'></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <img src="https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?d=mm&s=32" class="img-circle timeline-image" style="margin-left: 17px; height:32px;width:32px;" />
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2016-10-06 05:22:40</span>
                                    <h3 class="timeline-header"><a href="#">Demo Admin [Staff]</a> 33 seconds ago</h3>
                                    <div class="timeline-body">
                           
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <img src="https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?d=mm&s=32" class="img-circle timeline-image" style="margin-left: 17px; height:32px;width:32px;" />
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2016-10-06 05:20:56</span>
                                    <h3 class="timeline-header"><a href="#">Demo Admin [Staff]</a> 2 minutes ago</h3>
                                    <div class="timeline-body">
                                
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <img src="https://www.gravatar.com/avatar/b58996c504c5638798eb6b511e6f49af?d=mm&s=32" class="img-circle timeline-image" style="margin-left: 17px; height:32px;width:32px;" />
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2016-10-05 02:04:10</span>
                                    <h3 class="timeline-header"><a href="#">Demo User [User]</a> 1 day ago</h3>
                                    <div class="timeline-body">
                                      
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <img src="https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?d=mm&s=32" class="img-circle timeline-image" style="margin-left: 17px; height:32px;width:32px;" />
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2016-09-28 15:00:37</span>
                                    <h3 class="timeline-header"><a href="#">Demo Admin [Staff]</a> 7 days ago</h3>
                                    <div class="timeline-body">
                                    
                                        <ul class="todo-list list-inline" id="fileslist">
                                            <li id="" style="width:90%;margin:10px;padding:12px;">
                                                <div class="row">
                                                    <div class="col-xs-1" style="vertical-align:middle"><i class="fa fa-file-image-o"></i></div>
                                                    <div class="col-xs-10">
                                                        06-new-new-new-new-15.jpg                                                                   
                                                    </div>
                                                </div>
                                                <div class="pull-right">
                                                    <a href="?qa=download&id=15" class='btn-right text-dark'><i class='fa fa-download'></i></a>&nbsp;
                                                    <a href="#" onClick='showM("?modal=files/delete&reroute=tickets/manage&routeid=60&id=15&section=");return false' class='btn-right text-red'><i class='fa fa-trash-o'></i></a>
                                                </div>
                                            </li>
                                            <li id="" style="width:90%;margin:10px;padding:12px;">
                                                <div class="row">
                                                    <div class="col-xs-1" style="vertical-align:middle"><i class="fa fa-file-image-o"></i></div>
                                                    <div class="col-xs-10">
                                                        QuickMemo+_2016-06-07-19-35-44-1-16.png                                                                 
                                                    </div>
                                                </div>
                                                <div class="pull-right">
                                                    <a href="?qa=download&id=16" class='btn-right text-dark'><i class='fa fa-download'></i></a>&nbsp;
                                                    <a href="#" onClick='showM("?modal=files/delete&reroute=tickets/manage&routeid=60&id=16&section=");return false' class='btn-right text-red'><i class='fa fa-trash-o'></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <img src="https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?d=mm&s=32" class="img-circle timeline-image" style="margin-left: 17px; height:32px;width:32px;" />
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2016-09-28 14:58:54</span>
                                    <h3 class="timeline-header"><a href="#">Demo Admin [Staff]</a> 7 days ago</h3>
                                    <div class="timeline-body">
                                        
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <img src="https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?d=mm&s=32" class="img-circle timeline-image" style="margin-left: 17px; height:32px;width:32px;" />
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2016-09-24 22:31:23</span>
                                    <h3 class="timeline-header"><a href="#">Demo Admin [Staff]</a> 11 days ago</h3>
                                    <div class="timeline-body">
                                        
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <img src="https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?d=mm&s=32" class="img-circle timeline-image" style="margin-left: 17px; margin-left: 17px; height:32px;width:32px;" />
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2016-09-24 22:08:30</span>
                                    <h3 class="timeline-header"><a href="#">Demo Admin [Staff]</a> 11 days ago</h3>
                                    <div class="timeline-body">
                                        
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <img src="https://www.gravatar.com/avatar/b58996c504c5638798eb6b511e6f49af?d=mm&s=32" class="img-circle timeline-image" style="margin-left: 17px; height:32px;width:32px;" />
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2016-09-24 22:05:22</span>
                                    <h3 class="timeline-header"><a href="#">Demo User [User]</a> 11 days ago</h3>
                                    <div class="timeline-body">
                                        
                                    </div>
                                </div>
                            </li>
                            <li><i class="fa fa-arrow-up bg-gray"></i></li>
                        </ul>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane " id="tab-comments">
                        <p>No comments have been added.</p>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane " id="tab-notes">
                        <form role="form" method="post">
                            <div class="form-group">
                                <textarea class="form-control summernote" rows="5" id="notes" name="notes"></textarea>
                            </div>
                            <input type="hidden" name="action" value="updateTicketNotes">
                            <input type="hidden" name="id" value="60">
                            <input type="hidden" name="route" value="tickets/manage">
                            <input type="hidden" name="routeid" value="60">
                            <input type="hidden" name="section" value="">
                            <div class="pull-right"><button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button></div>
                            <div style="clear:both"></div>
                        </form>
                        <!-- /.form -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane " id="tab-rules">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <p>No Records Found</p>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ticket Details</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="ticketDetailsTable" class="table table-striped table-hover text-right">
                        <tbody>
                            <tr>
                                <td>
                                    <span class='badge bg-teal'>Respondida</span>                                                                                                                 
                                </td>
                            </tr>
                            <tr>
                                <td>return</td>
                            </tr>
                            <tr>
                                <td>Alta</td>
                            </tr>
                            <tr>
                                <td>2016-09-24 22:05:22</td>
                            </tr>
                            <tr>
                                <td>user@example.com</td>
                            </tr>
                            <tr>
                                <td><b>User</b></td>
                            </tr>
                            <tr>
                                <td>Demo User</td>
                            </tr>
                            <tr>
                                <td><b>Assigned To</b></td>
                            </tr>
                            <tr>
                                <td>Demo Admin</td>
                            </tr>
                            <tr>
                                <td><b>CC Recipients</b></td>
                            </tr>
                            <tr>
                                <td>dasda@gmail.com </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>