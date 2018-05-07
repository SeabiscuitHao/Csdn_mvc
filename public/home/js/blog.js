var blog = new Vue({
	el: '#info',
	data: {
		infoItem: {
			title: ''
		}
	},
	mounted: function(){
		this.getData();
	},
	methods: {
		getQuery: function(){
			var str = (location.search.length > 0 ? location.search.substring(1) : ''),
			args = {},
			items = str.length ? str.split("&") : [],
			item = null,
			name = null,
			value = null;
			for (i=0; i < items.length; i++){
				item = items[i].split("=");
				name = decodeURIComponent(item[0]);
				value = decodeURIComponent(item[1]);
				if (name.length) {
					args[name] = value;
				}
			}
			return args;
		},
		getData: function(){
			var infoId = this.getQuery().id;
			var that = this;
			$.ajax({
				// url: 'http://my.blog.com/index.php?c=blog&a=info',
				url: 'http://blog.com/api/blog/info',
				type: 'get',
				dataType: 'json',
				data: {
					id: infoId,
					user_id : window.localStorage.user_id
				},
				success: function(res){
					if( res.data.blog_info.collect_status == 1){
						that.$refs.collect.innerHTML = "已收藏";
					}
					else if ( res.data.blog_info.collect_status == -1){
						that.$refs.collect.innerHTML = "登录";
					};
					that.infoItem = res.data.blog_info;
				}
			})
		},
		collectInfo: function(){
			var that = this;
			var infoId = this.getQuery().id;
			var uid = window.localStorage.user_id;
			$.ajax({
				url: "http://blog.com/api/collect/add",
				type: "post",
				dataType: "json",
				data: {
					blog_id: infoId,
					user_id: uid
				},
				success: function(res){
					if ( res.error_code == 0 ) {
						that.$refs.collect.innerHTML = "已收藏";
					}
					else {
						that.$refs.collect.innerHTML = "收藏";
					}
				},
				error: function(res){
					alert("xxxxx");
				}
			})
		},
		colBtn: function(){

		}
	}
})