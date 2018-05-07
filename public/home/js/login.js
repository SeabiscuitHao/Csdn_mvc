var login = new Vue({
	el: '#login',
	data: {
		username: '',
		userPassword: ''
	},
	mounted: function(){},
	methods: {
		clickLogin: function(){
			if ( (this.username != "") && (this.userPassword != "") ){
				$.ajax({
					// url: "http://my.blog.com/index.php?c=user&a=doLogin",
					url: "http://blog.com/api/user/doLogin",
					type: "post",
					dataType: "json",
					data: {
						phone: this.username,
						password: this.userPassword,
						format: 'json'
					},
					success: function(res){
						if ( res.error_code == 0 ){
							alert("登录成功");
							location.href="./csdn.html";
							localStorage.setItem("user_id",res.data.user.userid);
							localStorage.setItem("user_img",res.data.user.userimg);
							localStorage.setItem("user_name",res.data.user.username);
						}
						else {
							alert("失败");
						}
					},
					error: function(res){
						alert("xxxxxxxx");
					}
				})
			}
			else {
				alert("用户名或密码不能为空");
			}
		}
	}
})