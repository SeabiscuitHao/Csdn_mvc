var user = new Vue({
	el: "#user",
	data: {
		blogList: [],
	},
	mounted: function(){
		this.getUsermes();
	},
	methods: {
		getUsermes: function(){
			var that = this;
			$.ajax({
				url: "http://blog.com/api/collect/lists",
				type: "post",
				dataType: "json",
				data: {
					user_id: window.localStorage.user_id
				},
				success: function(res){
					that.blogList = res.data.blog_lists;
				},
				error: function(){
					alert(xxxx);
				}
			})
		}
	}
})