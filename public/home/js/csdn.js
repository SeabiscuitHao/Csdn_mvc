var data = new Vue({
	el: '#csdn',
	data: {
		infoList: [],
		bannerList: [],
		navList: []
	},
	mounted: function(){
		this.getData();
		this.showBtn();
		var mySwiper = new Swiper('.swiper-container', {
			autoplay: 2000,//可选选项，自动滑动
			loop: true,
			// pagination : '.swiper-pagination',
			observer:true,//修改swiper自己或子元素时，自动初始化swiper 
			observeParents:false,//修改swiper的父元素时，自动初始化swiper 
		})
	},
	methods: {
		getData: function(obj){
			var that = this;
			$.ajax({
				// url: 'http://my.blog.com/index.php?c=blog&a=lists',
				url: 'http://blog.com/api/index/index',
				type: 'get',
				dataType: 'json',
				data: obj,
				success: function(res){
					that.infoList = res.data.blog_lists;
					that.bannerList = res.data.banner;
					that.navList = res.data.classify_lists;
				},
				error: function(res){
				}
			})
		},
		showBtn: function(){
			if( window.localStorage.user_id ){
				this.$refs.login.style.display = "none";
				this.$refs.user.style.display = "block";
				this.$refs.publish.style.display = "block";
				// this.$refs.user.innerHTML = window.localStorage.user_name;
			}
			else {
				this.$refs.login.style.display = "block";
				this.$refs.user.style.display = "none";
			}
		},
		infoType: function(item){
			var that = this;
			$.ajax({
				url: "http://blog.com/api/blog/lists",
				type: "get",
				dataType: "json",
				data: {
					classify_id: item.classify_id
				},
				success: function(res){
					that.infoList = res.data.blog_lists;
				},
				error: function(){

				}
			})
		}
	}
})