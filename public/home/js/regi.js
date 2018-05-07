var regi = new Vue({
	el: "#regi",
	data: {
		phone: '',
		username: '',
		userPassword: ''
	},
	methods: {
		clickRegi: function(){
			if ( (this.phone != "")&&(this.username != "")&&(this.userPassword != "")){
				$.ajax({
					// url: "http://my.blog.com/index.php?c=user&a=doReg",
					url: "http://blog.com/api/user/doReg",
					type: "post",
					dataType: "json",
					data: {
						phone: this.phone,
						uname: this.username,
						password: this.userPassword,
						format: 'json'
					},
					success: function(res){
						if ( res.error_code == 0 ){
							alert("注册成功");
							location.href="./login.html";
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
				alert("电话/用户名/密码不能为空");
			}
		}
	}
})