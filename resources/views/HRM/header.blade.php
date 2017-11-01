<nav class="navbar navbar-static-top" role="navigation">
    <a href="{{url('/')}}" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        <img src="{{url('img/logo1.png')}}" alt="logo" />
    </a>
    <!-- Header Navbar: style can be found in header-->
    <!-- Sidebar toggle button-->
    <!-- Sidebar toggle button-->
    <div>
        <a href="javascript:void(0)" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i class="fa fa-fw ti-menu"></i>
        </a>

    </div>
	<a href="javascript:void(0)" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i class="fa-1x fa-fw text-white">HRM</i></a>
	<div class="navbar-right">
        <ul id="header" class="nav navbar-nav">

        </ul>
    </div>
</nav>
<script>
	var xhr = new XMLHttpRequest();
    //setInterval(function(){
    	xhr.open('GET', "/inbox", true);
    	xhr.send();
    	xhr.onreadystatechange = processRequest;
    //}, 300000);

    function processRequest(e) {
		if (xhr.readyState == 4 && xhr.status == 200) {
            var res_data = JSON.parse(xhr.responseText);
			var res=res_data.pesan;
			var user=res_data.user;
			var header=$('#header');
			header.append(`<li class="dropdown messages-menu">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-fw ti-email black"></i>
                    <span id="msg_cnt" class="label label-success">0</span>
                </a>
                <ul id="msg" class="dropdown-menu dropdown-messages table-striped">
                </ul>
            </li>`)
            document.getElementById("msg_cnt").innerHTML=res.length;
			var msg=$('#msg');
    		msg.empty();
			msg.append('<li class="dropdown-title">New Messages</li>');
    		for(var i=0;i<res.length;i++){
    			if(i%2==0){
    				msg.append(`<li>
    					<a href="" class="message striped-col">
    						<div class="message-body">
    							<strong>`+res[i].nama+`</strong>
    							<br> `+res[i].text_pesan+`
    							<br>
    							<small>`+res[i].tgl_pesan_masuk+`</small>
    						</div>
    					</a>
    				</li>`);
    			}else{
    				msg.append(`<li>
    					<a href="" class="message ">
    						<div class="message-body">
    							<strong>`+res[i].nama+`</strong>
    							<br> `+res[i].text_pesan+`
    							<br>
    							<small>`+res[i].tgl_pesan_masuk+`</small>
    						</div>
    					</a>
    				</li>`);
    			}
    		}
    		msg.append('<li class="dropdown-footer"><a href="/hrm/management/pesan">View All messages</a></li>');

			if(user.uri_img_profile!=null){
				header.append(`<li class="dropdown user user-menu">
	                <a href="javascript:void(0)" class="dropdown-toggle padding-user" data-toggle="dropdown">
	                    <img src="/uploads/profil/`+user.uri_img_profile+`" width="35" class="img-circle img-responsive pull-left" height="35" alt="User Image">
	                    <div class="riot">
	                        <div>
	                            `+user.user_name+`
	                            <span><i class="caret"></i></span>
	                        </div>
	                    </div>
	                </a>
	                <ul class="dropdown-menu" >
						<li class="user-header">
							<img src="/uploads/profil/`+user.uri_img_profile+`" class="img-circle" alt="User Image">
							<p> `+user.user_name+`</p>
						</li>
						<!-- Menu Body -->
						<li class="p-t-3">
							<a href="/hrm/profil/user/profil">
								<i class="fa fa-fw ti-user"></i> My Profile
							</a>
						</li>
						<li role="presentation"></li>
						<li>
							<a href="/hrm/profil/user/password">
								<i class="fa fa-fw ti-settings"></i> Change Password
							</a>
						</li>
						<li role="presentation" class="divider"></li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<a href="/logout">
								<i class="fa fa-fw ti-shift-right"></i> Logout
							</a>
						</li>
					</ul>
				</li>`);
			}else{
				header.append(`<li class="dropdown user user-menu">
	                <a href="javascript:void(0)" class="dropdown-toggle padding-user" data-toggle="dropdown">
	                    <img src="{{url('img/authors/avatar1.jpg')}}" width="35" class="img-circle img-responsive pull-left" height="35" alt="User Image">
	                    <div class="riot">
	                        <div>
	                            `+user.user_name+`
	                            <span><i class="caret"></i></span>
	                        </div>
	                    </div>
	                </a>
	                <ul class="dropdown-menu" >
						<li class="user-header">
							<img src="{{url('img/authors/avatar1.jpg')}}" class="img-circle" alt="User Image">
							<p> `+user.user_name+`</p>
						</li>
						<!-- Menu Body -->
						<li class="p-t-3">
							<a href="/hrm/profil/user/profil">
								<i class="fa fa-fw ti-user"></i> My Profile
							</a>
						</li>
						<li role="presentation"></li>
						<li>
							<a href="/hrm/profil/user/password">
								<i class="fa fa-fw ti-settings"></i> Change Password
							</a>
						</li>
						<li role="presentation" class="divider"></li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<a href="/logout">
								<i class="fa fa-fw ti-shift-right"></i> Logout
							</a>
						</li>
					</ul>
				</li>`);
			}
        }
    }
</script>
