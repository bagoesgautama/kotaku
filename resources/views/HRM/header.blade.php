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
	<a href="javascript:void(0)" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i class="fa-1x fa-fw ti-user text-white">HRM</i></a>
	<div class="navbar-right">
        <ul class="nav navbar-nav">
            <li class="dropdown messages-menu">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-fw ti-email black"></i>
                    <span id="msg_cnt" class="label label-success">0</span>
                </a>
                <ul id="msg" class="dropdown-menu dropdown-messages table-striped">
                </ul>
            </li>
            <!-- User Account: style can be found in dropdown-->
            <li class="dropdown user user-menu">
                <a href="javascript:void(0)" class="dropdown-toggle padding-user" data-toggle="dropdown">
                    <img src="{{asset('img/original.jpg')}}" width="35" class="img-circle img-responsive pull-left" height="35" alt="User Image">
                    <div class="riot">
                        <div>
                            {{ $username }}
                            <span><i class="caret"></i></span>
                        </div>
                    </div>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="{{asset('img/original.jpg')}}" class="img-circle" alt="User Image">
                        <p> {{ $username }}</p>
                    </li>
                    <!-- Menu Body -->
                    <li class="p-t-3">
                        <a href="{{url('user_profile')}}">
                            <i class="fa fa-fw ti-user"></i> My Profile
                        </a>
                    </li>
                    <li role="presentation"></li>
                    <li>
                        <a href="/hrm/management/user/password">
                            <i class="fa fa-fw ti-settings"></i> Change Password
                        </a>
                    </li>
                    <li role="presentation" class="divider"></li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
						<a href="/logout">
							<i class="fa fa-fw ti-shift-right"></i> Logout
						</a>
                        <!--<div class="pull-right">

                        </div>-->
                    </li>
                </ul>
            </li>
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
        var res = JSON.parse(xhr.responseText);
        document.getElementById("msg_cnt").innerHTML=res.length;
		var msg=$("#msg");
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
		msg.append('<li class="dropdown-footer"><a href="javascript:void(0)">View All messages</a></li>');
    }
}
</script>
