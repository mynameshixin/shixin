(function(rt) {
	var templates = rt.templates,
		attrs = function() {
			return rt.attrs.apply(rt, arguments)
		},
		_ = function() {
			return rt._.apply(rt, arguments)
		},
		img = function() {
			return rt.img.apply(rt, arguments)
		},
		imgURL = function() {
			return rt.imgURL.apply(rt, arguments)
		},
		museImgUrl = function() {
			return rt.museImgUrl.apply(rt, arguments)
		},
		gifURL = function() {
			return rt.gifURL.apply(rt, arguments)
		},
		imgSuffixIsRetinaDisplay = function() {
			return rt.imgSuffixIsRetinaDisplay.apply(rt, arguments)
		},
		imgSize = function() {
			return rt.imgSize.apply(rt, arguments)
		},
		avatar = function() {
			return rt.avatar.apply(rt, arguments)
		},
		isVerified = function() {
			return rt.isVerified.apply(rt, arguments)
		},
		url = function() {
			return rt.url.apply(rt, arguments)
		},
		parseURL = function() {
			return rt.parseURL.apply(rt, arguments)
		},
		mkurl = function() {
			return rt.mkurl.apply(rt, arguments)
		},
		GACampaignURL = function() {
			return rt.GACampaignURL.apply(rt, arguments)
		},
		format_text = function() {
			return rt.format_text.apply(rt, arguments)
		},
		escape = function() {
			return rt.escape.apply(rt, arguments)
		},
		__t = rt.templates,
		emerge = function() {
			return rt.renderSync.apply(rt, arguments)
		};
	__t["base/404"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__), buf.push("<div"), buf.push(attrs({
				"class": "not-found-page"
			})), buf.push("><div"), buf.push(attrs({
				"class": "content"
			})), buf.push("><div"), buf.push(attrs({
				"class": "info"
			})), buf.push(">"), page.msg == "根据相关法律及政策，该搜索结果将不予显示，换个词试试吧" ? (buf.push("<p"), buf.push(attrs({
				"class": "search-writing"
			})), buf.push(">" + escape((interp = page.msg) == null ? "" : interp) + "</p>")) : ~page.msg.indexOf("你访问的帐号已经被禁用") ? (buf.push("<h2>你访问的用户主页已被禁止</h2><p"), buf.push(attrs({
				"class": "state"
			})), buf.push(">你可以<a"), buf.push(attrs({
				href: "/?md=404in",
				"class": "brown-link"
			})), buf.push(">返回花瓣首页</a>，也可以尝试搜索更有趣的内容。</p>")) : (buf.push("<h2>很抱歉，你访问的页面不存在</h2><p"), buf.push(attrs({
				"class": "state"
			})), buf.push(">输入地址有误或该地址已被删除，你可以<a"), buf.push(attrs({
				href: "/?md=404in",
				"class": "brown-link"
			})), buf.push(">返回花瓣首页</a>，也可以尝试搜索更有趣的内容。</p>")), buf.push("<div"), buf.push(attrs({
				"class": "search"
			})), buf.push("><form"), buf.push(attrs({
				id: "page_search_form",
				method: "get",
				action: page.query && page.query.type ? page.$url : "/search/"
			})), buf.push("><input"), buf.push(attrs({
				id: "query",
				placeholder: "输入一个词，更多精彩等着你",
				name: "q",
				"class": "clear-input search-input"
			})), buf.push("/><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "search-btn btn18 go btn rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 搜索</span></a></form><p"), buf.push(attrs({
				"class": "search-text"
			})), buf.push(">热门搜索：");
			var words = ["早餐", "海报", "婚纱", "喵星人", "狗", "彩妆"];
			for(var $index = 0, $$l = words.length; $index < $$l; $index++) {
				var word = words[$index];
				buf.push("<a"), buf.push(attrs({
					href: "/search/?q=" + encodeURIComponent(word) + "&md=404in",
					"class": "brown-link"
				})), buf.push(">" + escape((interp = word) == null ? "" : interp) + "</a>")
			}
			buf.push("</p></div></div></div>");
			if(page.imgs.length || page.keywords.length || page.words.length) {
				buf.push("<div"), buf.push(attrs({
					"class": "holder"
				})), buf.push("><div"), buf.push(attrs({
					"class": "recommend"
				})), buf.push("><div"), buf.push(attrs({
					"class": "title"
				})), buf.push("><h3>花瓣为您推荐</h3></div>");
				if(page.keywords.length || page.words.length) {
					buf.push("<div"), buf.push(attrs({
						"class": "suggestion-keywords"
					})), buf.push("><span>精彩推荐：</span>");
					for(var $index = 0, $$l = page.keywords.length; $index < $$l; $index++) {
						var word = page.keywords[$index];
						buf.push("<a"), buf.push(attrs({
							href: "/explore/" + word.slug + "/"
						})), buf.push(">" + escape((interp = word.keyword) == null ? "" : interp) + "</a>")
					}
					for(var $index = 0, $$l = page.words.length; $index < $$l; $index++) {
						var word = page.words[$index];
						buf.push("<a"), buf.push(attrs({
							href: word.url
						})), buf.push(">" + escape((interp = word.name) == null ? "" : interp) + "</a>")
					}
					buf.push("</div>")
				}
				if(page.imgs.length) {
					buf.push("<div"), buf.push(attrs({
						"class": "showcase"
					})), buf.push("><div"), buf.push(attrs({
						style: "left: 252px;",
						"class": "imgs"
					})), buf.push(">");
					for(var $index = 0, $$l = page.imgs.length; $index < $$l; $index++) {
						var img = page.imgs[$index],
							src = "https://" + img.file.bucket + ".b0.upaiyun.com/img/error_page/" + img.file.key + "_sq236";
						buf.push("<a"), buf.push(attrs({
							href: "" + img.url + ""
						})), buf.push("><img"), buf.push(attrs({
							src: "" + src + "",
							alt: "" + img.des + "",
							width: "235",
							height: "235",
							title: "" + img.des + "",
							"data-baiduimageplus-ignore": 1
						})), buf.push("/></a>")
					}
					buf.push("</div><div"), buf.push(attrs({
						"class": "covering left disable"
					})), buf.push("><i"), buf.push(attrs({
						"class": "arrow"
					})), buf.push("></i></div><div"), buf.push(attrs({
						"class": "covering right"
					})), buf.push("><i"), buf.push(attrs({
						"class": "arrow"
					})), buf.push("></i></div></div>")
				}
				buf.push("</div></div>")
			}
			buf.push('</div><style>html {background: white}\n</style><script>window._gaq_pageview_url="/404error/?url="+document.location.pathname+document.location.search+"&ref="+document.referrer,function(){app.initSearchForms("#page_search_form",{hintLimit:4});if(document.getElement(".not-found-page .showcase")){var a=document.getElement(".not-found-page .showcase"),b=a.getElement(".imgs"),c=a.getElement(".covering.left"),d=a.getElement(".covering.right"),e=(b.getElements("a").length-5)*-252,e=e>0?0:e,f=!1;a.addEvent("click:relay(.covering)",function(a){a.stop();if(f)return;if(this.hasClass("disable"))return;var g=b.style.left.toInt();f=!0;if(this.hasClass("left")){var h=g+252;h==252&&c.addClass("disable"),b.tween("left",h).get("tween").chain(function(){d.removeClass("disable"),f=!1})}else{var h=g-252;h==e&&d.addClass("disable"),b.tween("left",h).get("tween").chain(function(){c.removeClass("disable"),f=!1})}})}}()</script>')
		}
		return buf.join("")
	}, __t["base/appeal"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "Appeal"
			})), buf.push(">");
			var username = page.user && page.user.username ? page.user.username : null,
				disabled_username = username ? !0 : !1,
				email = page.user && page.user.email ? page.user.email : null,
				disabled_email = email ? !0 : !1,
				url = page.user && page.user.url ? page.user.url : null,
				disabled_url = url ? !0 : !1;
			buf.push("<h1>解冻申诉</h1><form"), buf.push(attrs({
				action: "",
				"class": "Form StaticForm nm"
			})), buf.push("><ul>");
			if(!page.user || username) buf.push("<li"), buf.push(attrs({
				"class": "nbt"
			})), buf.push("><input"), buf.push(attrs({
				id: "username",
				type: "text",
				name: "username",
				value: username,
				disabled: disabled_username,
				"class": "clear-input"
			})), buf.push("/><label>用户名</label><span"), buf.push(attrs({
				"class": "fff"
			})), buf.push("></span></li>");
			if(!page.user || url) buf.push("<li"), buf.push(attrs({
				"class": "nbt"
			})), buf.push("><input"), buf.push(attrs({
				id: "url",
				type: "text",
				name: "url",
				value: url,
				disabled: disabled_url,
				"class": "clear-input"
			})), buf.push("/><label>个性网址</label><span"), buf.push(attrs({
				"class": "fff"
			})), buf.push("></span></li>");
			if(!page.user || email) buf.push("<li"), buf.push(attrs({
				"class": "nbt"
			})), buf.push("><input"), buf.push(attrs({
				id: "email",
				type: "text",
				name: "email",
				value: email,
				disabled: disabled_email,
				"class": "clear-input"
			})), buf.push("/><label>Email</label><span"), buf.push(attrs({
				"class": "fff"
			})), buf.push("></span></li>");
			page.user || (buf.push("<li"), buf.push(attrs({
				"class": "nbt"
			})), buf.push("><p>请至少填写一项准确信息</p></li>")), buf.push("</ul><div"), buf.push(attrs({
				"class": "Submit"
			})), buf.push(">"), page.user ? (buf.push("<a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "btn btn18 rbtn"
			})), buf.push("><strong> 确认并提交</strong><span></span></a>")) : (buf.push("<a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "btn btn18 rbtn"
			})), buf.push("><strong> 提交</strong><span></span></a>")), buf.push('</div></form></div><script>(function(){var a=$("Appeal");if(a.retrieve("initialized"))return;var b=$("username"),c=$("url"),d=$("email");new Button(a.getElement(".Submit a"),{click:function(){var e=b?b.get("value").trim():"",f=c?c.get("value").trim():"",g=d?d.get("value").trim():"";if(e==""&&f==""&&g==""){app.showTip(b,"至少输入其中一项",{width:150}),app.showTip(c,"至少输入其中一项",{width:150}),app.showTip(d,"至少输入其中一项",{width:150});return}return this.disable(),(new Request.JSON({url:"/appeal",data:{username:e,url:f,email:g},onSuccess:function(b){b.err?app.error(b.msg||b.err):(a.innerHTML=\'<h1>已提交您的申诉，请耐心等待。</h1><h2>继续浏览<a href="/">花瓣网</a></h2>\',setTimeout(function(){location.href="/"},5e3))},onFailure:function(){app.error(app.COMMON_ERRMSG)},onComplete:function(){this.enable()}.bind(this)})).post(),!1}}),a.getElements("input").addEvent("blur",function(a){app.hideTip(a.target)}),a.store("initialized",!0)})()</script>')
		}
		return buf.join("")
	}, __t["base/baidu"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<script"), buf.push(attrs({
				type: "text/javascript"
			})), buf.push('>var inject=function(){var a=10,b="' + escape((interp = id) == null ? "" : interp) + '",c=window.setInterval(function(){var d=document.id(b);(d||!--a)&&window.clearInterval(c),d&&(d.show(),d.inject(document.id("' + escape((interp = attach) == null ? "" : interp) + '")))},1e3)};window.setTimeout(inject,500)</script>')
		}
		return buf.join("")
	}, __t["base/board_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, promt = typeof promotion == "undefined" || !promotion ? null : promotion,
				_fbtn = typeof fbtn == "undefined" ? !0 : fbtn,
				seq = promt ? "" : board.seq,
				extraCssClass = promt ? "promotion" : "",
				is_private = board.is_private === 2 ? "default-board" : "";
			buf.push("<div"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				"data-seq": "" + seq + "",
				"class": "Board wfc " + ("" + extraCssClass + "" + is_private + "")
			})), buf.push(">"), user && board.user_id == user.user_id && board.is_private !== 2 && (buf.push("<div"), buf.push(attrs({
				"class": "draglay"
			})), buf.push("></div><div"), buf.push(attrs({
				title: "拖动改变排序",
				"class": "drag-icon"
			})), buf.push("></div>"));
			var board_url = "/boards/" + board.board_id + "/",
				target_url = promt ? promt.url || board_url : board_url,
				target = promt ? promt.new_tab ? "_blank" : "_self" : "_self",
				extra_css_class = promt ? "promotion-url" : "";
			buf.push("<a"), buf.push(attrs({
				href: "" + target_url + "",
				target: "_blank",
				"class": "link " + ("" + extra_css_class + "") + " " + "x"
			})), buf.push(">");
			if(board.pins.length || board.cover)
				if(board.cover) {
					buf.push("<img"), buf.push(attrs({
						src: imgURL(board.cover.file, "sq235"),
						"data-baiduimageplus-ignore": 1,
						"class": "large"
					})), buf.push("/>");
					var Num = 0;
					for(var i = 0; i < 4; i++) board.pins[i] && board.pins[i].pin_id !== board.cover.pin_id && Num < 3 && (Num++, buf.push("<img"), buf.push(attrs({
						src: imgURL(board.pins[i].file, "sq75"),
						"data-baiduimageplus-ignore": 1
					})), buf.push("/>"))
				} else {
					buf.push("<img"), buf.push(attrs({
						src: imgURL(board.pins[0].file, "sq235"),
						"data-baiduimageplus-ignore": 1,
						"class": "large"
					})), buf.push("/>");
					for(var i = 1; i < 4; i++) board.pins[i] && (buf.push("<img"), buf.push(attrs({
						src: imgURL(board.pins[i].file, "sq75"),
						"data-baiduimageplus-ignore": 1
					})), buf.push("/>"))
				}
			buf.push("<div"), buf.push(attrs({
				"class": "shadows"
			})), buf.push("><div"), buf.push(attrs({
				"class": "large-shadow"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "shadow"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "shadow"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "shadow"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "over " + (board.pins.length ? "" : "empty-board")
			})), buf.push(">"), board.is_private == 2 ? (buf.push("<h3>待归类采集"), board.pin_count > 500 && buf.push("<span>（采集数已达上限）</span>"), buf.push("</h3>")) : buf.push("<h3>" + escape((interp = board.title) == null ? "" : interp) + "</h3><h4>" + escape((interp = board.description) == null ? "" : interp) + "</h4>"), typeof pin != "undefined" && pin.index_in_board ? (buf.push("<div"), buf.push(attrs({
				"class": "pin-count"
			})), buf.push(">" + escape((interp = pin.index_in_board) == null ? "" : interp) + "/" + escape((interp = board.pin_count) == null ? "" : interp) + "</div>")) : board.pin_count && (buf.push("<div"), buf.push(attrs({
				"class": "pin-count"
			})), buf.push(">" + escape((interp = board.pin_count) == null ? "" : interp) + "</div>")), buf.push("</div>"), user && board.user_id === user.user_id && locals.show_cover_button && board.pins.length && (buf.push("<div"), buf.push(attrs({
				"class": "board-cover-edit"
			})), buf.push("><div"), buf.push(attrs({
				href: "#",
				"class": "btn btn12"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push(">设置封面</span></div></div>")), buf.push("</a>"), board.extra && board.extra.is_creation && (buf.push("<span"), buf.push(attrs({
				"class": "creation-mark"
			})), buf.push("></span>"));
			for(var $index = 0, $$l = board.pins.length; $index < $$l; $index++) {
				var pin = board.pins[$index];
				buf.push("<a"), buf.push(attrs({
					href: "/pins/" + pin.pin_id + "",
					title: "" + pin.raw_text + "",
					"class": "hidden"
				})), buf.push("><img"), buf.push(attrs({
					title: "" + pin.raw_text + "",
					src: imgURL(pin.file, "sq75"),
					"data-baiduimageplus-ignore": 1
				})), buf.push("/></a>")
			}
			_fbtn && (user && board.user_id === user.user_id ? (buf.push("<div"), buf.push(attrs({
				"class": "FollowBoard"
			})), buf.push(">"), board.is_private !== 2 ? (buf.push("<a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/edit/",
				"class": "btn btn14 wbtn"
			})), buf.push("><strong> 编辑</strong><span></span></a>")) : (buf.push("<a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/edit/",
				onclick: "return false;",
				"class": "disabled btn btn14 wbtn"
			})), buf.push("><strong> 编辑</strong><span></span></a>")), buf.push("</div>")) : board.user ? (buf.push("<div"), buf.push(attrs({
				"class": "FollowBoard2"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(board.user.urlname) + "/",
				title: escape(board.user.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(board.user),
				"data-baiduimageplus-ignore": 1,
				"class": "BoardAvatar"
			})), buf.push("/></a><a"), buf.push(attrs({
				href: "/" + board.user.urlname + "/",
				"class": "BoardUserUrl x"
			})), buf.push(">" + escape((interp = board.user.username) == null ? "" : interp) + "</a>"), board.following ? (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "" + (board.is_private == 2 ? "disabled" : "unfollow") + "" + " " + "btn" + " " + "wbtn"
			})), buf.push("><strong> 已关注</strong><span></span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "" + (board.is_private == 2 ? "disabled" : "follow") + "" + " " + "btn" + " " + "wbtn"
			})), buf.push("><strong> 关注</strong><span></span></a>")), buf.push("</div>")) : (buf.push("<div"), buf.push(attrs({
				"class": "FollowBoard"
			})), buf.push(">"), board.following ? (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "" + (board.is_private == 2 ? "disabled" : "unfollow") + "" + " " + "btn" + " " + "btn14" + " " + "wbtn"
			})), buf.push("><strong> 取消关注</strong><span></span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "" + (board.is_private == 2 ? "disabled" : "follow") + "" + " " + "btn" + " " + "btn14" + " " + "wbtn"
			})), buf.push("><strong> 关注</strong><span></span></a>")), buf.push("</div>"))), promt && promt.show_icon && (buf.push("<div"), buf.push(attrs({
				"class": "promotion-icon"
			})), buf.push("></div>")), buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/board_item_ent"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, promt = typeof promotion == "undefined" || !promotion ? null : promotion,
				_fbtn = typeof fbtn == "undefined" ? !0 : fbtn,
				seq = promt ? "" : board.seq,
				user = req.user,
				is_invite_board = typeof invite == "undefined" || !invite ? "" : "is_invite",
				md = "?md=ent";
			this.page.$url.indexOf("life") != -1 && (md = "?md=life"), buf.push("<div"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				"data-seq": "" + seq + "",
				"class": "Board wfc " + ("" + is_invite_board + "")
			})), buf.push("><div"), buf.push(attrs({
				"class": "actions"
			})), buf.push("><div"), buf.push(attrs({
				"class": "right"
			})), buf.push(">"), req.user && board.user_id === req.user.user_id ? (buf.push("<a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/edit/",
				"class": "edit btn btn14"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push(">编辑</span></a>")) : board.liked ? (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "unlike-board btn btn14 wbtn"
			})), buf.push("><strong><em></em> " + escape((interp = board.like_count) == null ? "" : interp) + "喜欢</strong><span></span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "like-board btn btn14 wbtn"
			})), buf.push("><strong><em></em> " + escape((interp = board.like_count ? board.like_count : "") == null ? "" : interp) + "喜欢</strong><span></span></a>")), buf.push("</div></div>");
			var board_url = "/boards/" + board.board_id + "/",
				target_url = promt ? promt.promotion_url || board_url : board_url,
				extra_css_class = promt ? "promotion-url" : "";
			buf.push("<a"), buf.push(attrs({
				href: "" + target_url + "" + md + "",
				"class": "link " + ("" + extra_css_class + "")
			})), buf.push(">"), board.cover ? (buf.push("<img"), buf.push(attrs({
				src: imgURL(board.cover.file, "sq235"),
				"data-baiduimageplus-ignore": 1,
				"class": "large"
			})), buf.push("/>")) : board.pins.length && (buf.push("<img"), buf.push(attrs({
				src: imgURL(board.pins[0].file, "sq235"),
				"data-baiduimageplus-ignore": 1,
				"class": "large"
			})), buf.push("/>"));
			if(board.pins.length) {
				for(var i = 1; i < 4; i++) board.pins[i] && (buf.push("<img"), buf.push(attrs({
					src: imgURL(board.pins[i].file, "sq75"),
					"data-baiduimageplus-ignore": 1
				})), buf.push("/>"));
				is_invite_board && (buf.push("<div"), buf.push(attrs({
					"class": "recommend-icon"
				})), buf.push("><img"), buf.push(attrs({
					src: "/img/find/star.png",
					"data-baiduimageplus-ignore": 1
				})), buf.push("/></div>"))
			}
			buf.push("<div"), buf.push(attrs({
				"class": "shadows"
			})), buf.push("><div"), buf.push(attrs({
				"class": "large-shadow"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "shadow"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "shadow"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "shadow"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "over " + (board.pins.length ? "" : "empty-board")
			})), buf.push(">"), board.is_private == 2 ? (buf.push("<h3>待归类采集"), board.pin_count > 500 && buf.push("<span>（采集数已达上限）</span>"), buf.push("</h3>")) : (buf.push("<h3"), buf.push(attrs({
				title: "" + board.title + ""
			})), buf.push(">" + escape((interp = board.title) == null ? "" : interp) + "</h3><h4>" + escape((interp = board.description) == null ? "" : interp) + "</h4>")), typeof pin != "undefined" && pin.index_in_board ? (buf.push("<div"), buf.push(attrs({
				"class": "pin-count"
			})), buf.push(">" + escape((interp = pin.index_in_board) == null ? "" : interp) + "/" + escape((interp = board.pin_count) == null ? "" : interp) + "</div>")) : board.pin_count && (buf.push("<div"), buf.push(attrs({
				"class": "pin-count"
			})), buf.push(">" + escape((interp = board.pin_count) == null ? "" : interp) + "</div>")), buf.push("</div>"), user && board.user_id === user.user_id && locals.show_cover_button && board.pins.length && (buf.push("<div"), buf.push(attrs({
				"class": "board-cover-edit"
			})), buf.push("><div"), buf.push(attrs({
				href: "#",
				"class": "btn btn12"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push(">设置封面</span></div></div>")), buf.push("</a>");
			for(var $index = 0, $$l = board.pins.length; $index < $$l; $index++) {
				var pin = board.pins[$index];
				buf.push("<a"), buf.push(attrs({
					href: "/pins/" + pin.pin_id + "" + md + "",
					title: "" + pin.raw_text + "",
					"class": "hidden"
				})), buf.push("><img"), buf.push(attrs({
					title: "" + pin.raw_text + "",
					src: imgURL(pin.file, "sq75"),
					"data-baiduimageplus-ignore": 1
				})), buf.push("/></a>")
			}
			buf.push("<div"), buf.push(attrs({
				"class": "follow-like-count"
			})), buf.push("><div"), buf.push(attrs({
				title: "" + board.follow_count + "关注",
				"class": "follow-icon"
			})), buf.push("><span"), buf.push(attrs({
				"class": "icon"
			})), buf.push("></span><span"), buf.push(attrs({
				"class": "num"
			})), buf.push(">" + escape((interp = board.follow_count) == null ? "" : interp) + "</span></div><div"), buf.push(attrs({
				title: "" + board.like_count + "喜欢",
				"class": "like-icon"
			})), buf.push("><span"), buf.push(attrs({
				"class": "icon"
			})), buf.push("></span><span"), buf.push(attrs({
				"class": "num"
			})), buf.push(">" + escape((interp = board.like_count) == null ? "" : interp) + "</span></div></div>"), _fbtn && (user && board.user.user_id === user.user_id ? (buf.push("<div"), buf.push(attrs({
				"class": "FollowBoard"
			})), buf.push(">"), board.is_private == 0 ? (buf.push("<a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/edit/" + md + "",
				"class": "btn btn14 wbtn"
			})), buf.push("><strong>编辑</strong><span></span></a>")) : (buf.push("<a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/edit/" + md + "",
				onclick: "return false;",
				"class": "disabled btn btn14 wbtn"
			})), buf.push("><strong>编辑</strong><span></span></a>")), buf.push("</div>")) : board.user ? (buf.push("<div"), buf.push(attrs({
				"class": "FollowBoard2"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(board.user.urlname) + "/",
				title: escape(board.user.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(board.user),
				"data-baiduimageplus-ignore": 1,
				"class": "BoardAvatar"
			})), buf.push("/></a>"), is_invite_board ? (buf.push("<a"), buf.push(attrs({
				href: "/" + board.user.urlname + "/" + md + "",
				"class": "BoardUserUrl InviteUsername"
			})), buf.push(">" + escape((interp = board.user.username) == null ? "" : interp) + "</a>")) : (buf.push("<a"), buf.push(attrs({
				href: "/" + board.user.urlname + "/" + md + "",
				"class": "BoardUserUrl"
			})), buf.push(">" + escape((interp = board.user.username) == null ? "" : interp) + "</a>")), board.following ? (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "" + (board.is_private == 2 ? "disabled" : "unfollow") + "" + " " + "btn" + " " + "wbtn"
			})), buf.push("><strong>已关注</strong><span></span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "" + (board.is_private == 2 ? "disabled" : "follow") + "" + " " + "btn" + " " + "wbtn"
			})), buf.push("><strong>关注</strong><span></span></a>")), buf.push("</div>")) : (buf.push("<div"), buf.push(attrs({
				"class": "FollowBoard"
			})), buf.push(">"), board.following ? (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "" + (board.is_private == 2 ? "disabled" : "unfollow") + "" + " " + "btn" + " " + "btn14" + " " + "wbtn"
			})), buf.push("><strong>取消关注</strong><span></span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "" + (board.is_private == 2 ? "disabled" : "follow") + "" + " " + "btn" + " " + "btn14" + " " + "wbtn"
			})), buf.push("><strong>关注</strong><span></span></a>")), buf.push("</div>"))), promt && promt.show_icon && (buf.push("<div"), buf.push(attrs({
				"class": "promotion-icon"
			})), buf.push("></div>")), buf.push("<div"), buf.push(attrs({
				"class": "actions"
			})), buf.push("><a"), buf.push(attrs({
				data: "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				style: "display:none;",
				"class": "hide_el like-board btn wbtn"
			})), buf.push("><strong><em></em>喜欢</strong><span></span></a></div></div>")
		}
		return buf.join("")
	}, __t["base/board_list"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, _currentBoardId = "",
				_currentBoardTitle = "",
				_extraClass = "";
			locals.currentBoard && locals.currentBoard == "default" ? _extraClass = "use-default-board" : locals.currentBoard && (_currentBoardId = currentBoard.board_id, _currentBoardTitle = currentBoard.title);
			var _currentCategorys = locals.categorys ? locals.categorys + "" : "",
				_creationOnly = locals.creationOnly ? "true" : "",
				_boardCreatable = !1 === locals.boardCreatable ? "false" : "true",
				_creationAll = locals.creationAll ? "true" : "";
			buf.push("<div"), buf.push(attrs({
				"data-board-id": _currentBoardId,
				"data-categorys": _currentCategorys,
				"data-creation": _creationOnly,
				"data-board-creatable": _boardCreatable,
				"data-creation-all": _creationAll,
				"class": "board-list " + _extraClass
			})), buf.push("><div"), buf.push(attrs({
				"class": "current"
			})), buf.push("><div"), buf.push(attrs({
				"class": "name"
			})), buf.push(">" + escape((interp = _currentBoardTitle ? _currentBoardTitle : "选择画板...") == null ? "" : interp) + "</div><div"), buf.push(attrs({
				"class": "arrow"
			})), buf.push("></div></div><div"), buf.push(attrs({
				style: "display:none",
				"class": "drop-list"
			})), buf.push("><div"), buf.push(attrs({
				"class": "boards"
			})), buf.push("></div><div"), buf.push(attrs({
				style: "display: none",
				"class": "filtrate"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "filter"
			})), buf.push("><input"), buf.push(attrs({
				type: "text",
				placeholder: "快速筛选/创建画板",
				"class": "clear-input"
			})), buf.push('/></div></div></div><script>(function(){$$(".board-list:not(.inited)").each(function(a){var b=a.get("data-creation"),c=a.get("data-board-creatable"),d=a.get("data-creation-all");a.addClass("inited"),a.master=new BoardList(a,{creationOnly:!!b,boardCreatable:"false"===c?!1:!0,creationAll:!!d})})})()</script>')
		}
		return buf.join("")
	}, __t["base/board_list_cell"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			if(locals.recent) {
				buf.push("<div"), buf.push(attrs({
					"class": "group recent"
				})), buf.push("><div"), buf.push(attrs({
					"class": "side-title"
				})), buf.push("></div><div"), buf.push(attrs({
					"class": "selections"
				})), buf.push(">");
				for(var $index = 0, $$l = locals.recent.length; $index < $$l; $index++) {
					var board = locals.recent[$index];
					buf.push("<a"), buf.push(attrs({
						title: board.title,
						"data-board-id": board.board_id,
						"data-category": board.category_id,
						"class": "board"
					})), buf.push(">" + escape((interp = board.title) == null ? "" : interp) + "</a>")
				}
				buf.push("</div></div>")
			}
			if(locals.letters)
				for(var i = 0; i < letters.length; i++) {
					buf.push("<div"), buf.push(attrs({
						"class": "group"
					})), buf.push("><div"), buf.push(attrs({
						"class": "side-title"
					})), buf.push("><div"), buf.push(attrs({
						"class": "icon"
					})), buf.push(">" + escape((interp = letters[i].letter) == null ? "" : interp) + "</div></div><div"), buf.push(attrs({
						"class": "selections"
					})), buf.push(">");
					for(var $index = 0, $$l = letters[i].boards.length; $index < $$l; $index++) {
						var board = letters[i].boards[$index];
						buf.push("<a"), buf.push(attrs({
							title: board.title,
							"data-board-id": board.board_id,
							"data-category": board.category_id,
							"class": "board"
						})), buf.push(">" + escape((interp = board.title) == null ? "" : interp) + "</a>")
					}
					buf.push("</div></div>")
				}
			if(locals.num && locals.num.length) {
				buf.push("<div"), buf.push(attrs({
					"class": "group"
				})), buf.push("><div"), buf.push(attrs({
					"class": "side-title"
				})), buf.push("><div"), buf.push(attrs({
					"class": "icon"
				})), buf.push(">#</div></div><div"), buf.push(attrs({
					"class": "selections"
				})), buf.push(">");
				for(var $index = 0, $$l = locals.num.length; $index < $$l; $index++) {
					var board = locals.num[$index];
					buf.push("<a"), buf.push(attrs({
						title: board.title,
						"data-board-id": board.board_id,
						"data-category": board.category_id,
						"class": "board"
					})), buf.push(">" + escape((interp = board.title) == null ? "" : interp) + "</a>")
				}
				buf.push("</div></div>")
			}
			if(locals.other && locals.other.length) {
				buf.push("<div"), buf.push(attrs({
					"class": "group other"
				})), buf.push("><div"), buf.push(attrs({
					"class": "side-title"
				})), buf.push("><div"), buf.push(attrs({
					"class": "icon"
				})), buf.push(">?</div></div><div"), buf.push(attrs({
					"class": "selections"
				})), buf.push(">");
				for(var $index = 0, $$l = locals.other.length; $index < $$l; $index++) {
					var board = locals.other[$index];
					buf.push("<a"), buf.push(attrs({
						title: board.title,
						"data-board-id": board.board_id,
						"data-category": board.category_id,
						"class": "board"
					})), buf.push(">" + escape((interp = board.title) == null ? "" : interp) + "</a>")
				}
				buf.push("</div></div>")
			}
		}
		return buf.join("")
	}, __t["base/board_list_filtrate"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			boardCreatable && (buf.push("<div"), buf.push(attrs({
				"class": "group create"
			})), buf.push("><div"), buf.push(attrs({
				"class": "side-title"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "selections"
			})), buf.push("><a"), buf.push(attrs({
				"data-name": name,
				"class": "board create-board"
			})), buf.push(">创建画板“" + escape((interp = name) == null ? "" : interp) + "”</a></div></div>")), buf.push("<div"), buf.push(attrs({
				"class": "group"
			})), buf.push("><div"), buf.push(attrs({
				"class": "side-title"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "selections"
			})), buf.push(">");
			for(var $index = 0, $$l = locals.boards.length; $index < $$l; $index++) {
				var board = locals.boards[$index];
				buf.push("<a"), buf.push(attrs({
					title: board.title,
					"data-board-id": board.board_id,
					"class": "board"
				})), buf.push(">" + escape((interp = board.title) == null ? "" : interp) + "</a>")
			}
			buf.push("</div></div>")
		}
		return buf.join("")
	}, __t["base/board_picker"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, _currentBoard = typeof currentBoard == "undefined" ? !1 : currentBoard;
			buf.push("<div"), buf.push(attrs({
				"class": "BoardListOverlay"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "BoardSelector BoardPicker"
			})), buf.push("><div"), buf.push(attrs({
				"class": "current"
			})), buf.push("><span"), buf.push(attrs({
				data: _currentBoard || "",
				"class": "CurrentBoard"
			})), buf.push(">选择画板...</span><span"), buf.push(attrs({
				"class": "DownArrow"
			})), buf.push("></span></div><div"), buf.push(attrs({
				"class": "BoardList"
			})), buf.push("><div"), buf.push(attrs({
				"class": "BoardListBody"
			})), buf.push("><ul></ul></div><div"), buf.push(attrs({
				"class": "CreateBoard"
			})), buf.push("><input"), buf.push(attrs({
				id: "board_name_input",
				type: "text",
				placeholder: "创建新画板",
				"class": "clear-input"
			})), buf.push("/><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "nf btn btn18 wbtn"
			})), buf.push("><strong> 创建</strong><span></span></a><div"), buf.push(attrs({
				"class": "CreateBoardStatus"
			})), buf.push('></div></div></div></div><script>(function(){$$("div.BoardPicker").each(function(a){if(a.hasClass("CandidateBoardPicker"))return;if(a.retrieve("initialized"))return;var b=a.getElement("div.CreateBoard"),c=$("board_name_input"),d=b.getElement("a.btn"),e=b.getElement(".CreateBoardStatus"),f=$(document.body).getHeight()<400?5:8,g=new BoardPicker(a,{maxVisibleItems:f,currentBoard:a.getElement(".CurrentBoard").get("data")}),h=new FancyInput(c);(new Button(d,{click:function(){var a=c.get("value").trim();return a==""?(e.set("html","请输入名称"),!1):(this.disable(),(new Request.JSON({url:"/boards/",data:{title:a},onSuccess:function(a){a.err?alert(a.msg||app.COMMON_ERRMSG):g.add(a.board).hide()},onFailure:function(){alert(app.COMMON_ERRMSG)},onComplete:function(){h.setValue(""),this.enable()}.bind(this)})).post(),!1)}})).disable().bind(h),a.store("initialized",!0)})})()</script>')
		}
		return buf.join("")
	}, __t["base/board_view"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var board = page.board,
				user = board.user,
				user_url = "/" + user.urlname,
				board_url = "/boards/" + board.board_id,
				is_followers_page = !!page.followers;
			if(!board.is_private && req.user && !board.category_id) {
				buf.push("<div"), buf.push(attrs({
					id: "category_callout"
				})), buf.push("><div"), buf.push(attrs({
					"class": "wrapper"
				})), buf.push("><div"), buf.push(attrs({
					"class": "callout sheet"
				})), buf.push("><div"), buf.push(attrs({
					"class": "form clearfix"
				})), buf.push("><p>为这个画板添加个分类，让其他人更容易找到它。</p><div"), buf.push(attrs({
					"class": "picker"
				})), buf.push(">");
				var __val__ = emerge("base/category_picker");
				buf.push(null == __val__ ? "" : __val__), buf.push("</div><div"), buf.push(attrs({
					"class": "Submit"
				})), buf.push("><a"), buf.push(attrs({
					href: "#",
					onclick: "return false;",
					"class": "btn btn18 rbtn"
				})), buf.push("><span"), buf.push(attrs({
					"class": "text"
				})), buf.push("> 提交</span></a></div></div><div"), buf.push(attrs({
					"class": "clear"
				})), buf.push("></div></div></div></div>")
			}
			buf.push("<div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				id: "board_card"
			})), buf.push("><div"), buf.push(attrs({
				"class": "inner"
			})), buf.push("><div"), buf.push(attrs({
				"class": "head-line"
			})), buf.push("><h1"), buf.push(attrs({
				"class": "board-name"
			})), buf.push(">" + escape((interp = board.is_private == 2 ? "待归类采集" : board.title) == null ? "" : interp) + "</h1>"), board.is_private == 2 && board.pin_count > 500 && (buf.push("<div"), buf.push(attrs({
				"class": "board-status"
			})), buf.push(">待归类采集数已达500上限</div>")), board.category_id != null && (buf.push("<div"), buf.push(attrs({
				"class": "board-category"
			})), buf.push("><span>所属分类：</span>"), board.category_id == "beauty" ? (buf.push("<a"), buf.push(attrs({
				href: "/favorite/" + board.category_id + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = board.category_name) == null ? "" : interp) + "</a>")) : (buf.push("<a"), buf.push(attrs({
				href: "/favorite/" + board.category_id + "/",
				"class": "brown-link x"
			})), buf.push(">" + escape((interp = board.category_name) == null ? "" : interp) + "</a>")), buf.push("</div>")), buf.push("</div>");
			if(board.description) {
				buf.push("<div"), buf.push(attrs({
					"class": "board-description"
				})), buf.push(">");
				var __val__ = board.description.nl2br();
				buf.push(null == __val__ ? "" : __val__), buf.push("</div>")
			}
			buf.push("<div"), buf.push(attrs({
				"class": "action-buttons"
			})), buf.push(">"), req.user && board.user_id === req.user.user_id ? (board.is_private != 2 && (buf.push("<a"), buf.push(attrs({
				href: "" + board_url + "/edit/",
				"class": "edit btn btn14"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 编辑画板</span></a>")), board.pins && board.pins.length && (buf.push("<a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "organize btn btn14"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 批量管理采集</span></a>"))) : board.is_private != 2 && (board.following ? (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "follow-board " + ("" + (board.is_private == 2 ? "disabled" : "unfollow") + "") + " " + "btn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 取消关注此画板</span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "follow-board " + ("" + (board.is_private == 2 ? "disabled" : "") + "") + " " + "btn" + " " + "rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 关注此画板</span></a>")), board.is_private != 2 && (board.liked ? (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "unlike-board btn-with-icon btn"
			})), buf.push("><i"), buf.push(attrs({
				"class": !0
			})), buf.push("></i><span"), buf.push(attrs({
				"class": "text"
			})), buf.push(">" + escape((interp = board.like_count) == null ? "" : interp) + " 喜欢</span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "like-board btn-with-icon btn"
			})), buf.push("><i"), buf.push(attrs({
				"class": !0
			})), buf.push("></i><span"), buf.push(attrs({
				"class": "text"
			})), buf.push(">" + escape((interp = board.like_count ? board.like_count : "") == null ? "" : interp) + "喜欢</span></a>")))), board.is_private != 1 && (buf.push("<div"), buf.push(attrs({
				"class": "huaban-share-unit"
			})), buf.push("><span>分享</span><div"), buf.push(attrs({
				"class": "share-btns"
			})), buf.push("><a"), buf.push(attrs({
				"data-to": "weibo",
				title: "新浪微博",
				target: "_blank",
				href: "/boards/" + board.board_id + "/js-share/?to=weibo",
				"class": "share-btn weibo"
			})), buf.push("></a><a"), buf.push(attrs({
				"data-to": "qzone",
				title: "QQ空间",
				target: "_blank",
				href: "/boards/" + board.board_id + "/js-share/?to=qzone",
				"class": "share-btn qzone"
			})), buf.push("></a><a"), buf.push(attrs({
				"data-to": "weixin",
				title: "微信",
				target: "_blank",
				href: "/boards/" + board.board_id + "/js-share/?to=weixin",
				"class": "share-btn weixin"
			})), buf.push("></a><div"), buf.push(attrs({
				"class": "more"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "menu"
			})), buf.push("><a"), buf.push(attrs({
				"data-to": "tqq",
				title: "腾讯微博",
				target: "_blank",
				href: "/boards/" + board.board_id + "/js-share/?to=tqq",
				"class": "tqq"
			})), buf.push("><i></i>腾讯微博</a><a"), buf.push(attrs({
				"data-to": "qfriends",
				title: "QQ好友",
				target: "_blank",
				href: "/boards/" + board.board_id + "/js-share/?to=qfriends",
				"class": "qq"
			})), buf.push("><i></i>QQ 好友</a><a"), buf.push(attrs({
				"data-to": "douban",
				title: "豆瓣",
				target: "_blank",
				href: "/boards/" + board.board_id + "/js-share/?to=douban",
				"class": "douban"
			})), buf.push("><i></i>豆瓣</a><a"), buf.push(attrs({
				"data-to": "renren",
				title: "人人网",
				target: "_blank",
				href: "/boards/" + board.board_id + "/js-share/?to=renren",
				"class": "renren"
			})), buf.push("><i></i>人人网</a><div"), buf.push(attrs({
				"class": "arr"
			})), buf.push("></div></div></div>")), buf.push("</div></div><div"), buf.push(attrs({
				"class": "bar"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + board.user.urlname + "/",
				"class": "user-unit x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(board.user)
			})), buf.push("/><span"), buf.push(attrs({
				"class": "name"
			})), buf.push(">" + escape((interp = board.user.username) == null ? "" : interp) + ""), user.status.ban && user.status.ban > (new Date).getTime() && (buf.push("<sup"), buf.push(attrs({
				style: "color:red;"
			})), buf.push(">(已禁止)</sup>")), buf.push("</span>"), isVerified(page.user) && (buf.push("<img"), buf.push(attrs({
				src: "/img/icon_v.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon"
			})), buf.push("/>")), buf.push("</a><div"), buf.push(attrs({
				"class": "tabs"
			})), buf.push(">"), board.pin_count ? (buf.push("<a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/",
				"class": "tab pins " + (is_followers_page ? "" : "active")
			})), buf.push(">" + escape((interp = board.pin_count) == null ? "" : interp) + "采集</a>")) : (buf.push("<a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/",
				rel: "nofollow",
				"class": "tab pins " + (is_followers_page ? "" : "active")
			})), buf.push(">" + escape((interp = board.pin_count) == null ? "" : interp) + "采集</a>")), board.follow_count ? (buf.push("<a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/followers/",
				"class": "tab " + (is_followers_page ? "active" : "")
			})), buf.push(">被" + escape((interp = board.follow_count) == null ? "" : interp) + "人关注</a>")) : (buf.push("<a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/followers/",
				rel: "nofollow",
				"class": "tab " + (is_followers_page ? "active" : "")
			})), buf.push(">被" + escape((interp = board.follow_count) == null ? "" : interp) + "人关注</a>")), buf.push("</div></div></div><div"), buf.push(attrs({
				id: "waterfall"
			})), buf.push(">");
			if(is_followers_page) {
				for(var $index = 0, $$l = page.followers.length; $index < $$l; $index++) {
					var follower = page.followers[$index],
						__val__ = emerge("base/person_item", {
							user: follower,
							pins: follower.pins,
							req: req
						});
					buf.push(null == __val__ ? "" : __val__)
				}
				buf.push('<script>(function(){app.initPureFollowUserButtons({buttonSelector:".item-followuser",unfollowButtonClass:"item-unfollowuser"})})()</script>')
			} else if(board.pins) {
				req.user && req.user.user_id == board.user.user_id && board.is_private != 2 && (board.extra && board.extra.is_creation && !board.isMuseBoard || (buf.push("<div"), buf.push(attrs({
					onclick: "app.showDialogBox('upload', true);",
					"class": "add-pin wfc"
				})), buf.push("><div"), buf.push(attrs({
					"class": "inner"
				})), buf.push("><i></i><span>添加采集</span></div></div>")));
				for(var $index = 0, $$l = board.pins.length; $index < $$l; $index++) {
					var pin = board.pins[$index],
						__val__ = emerge("base/pin_item", {
							user: user,
							pin: pin,
							board: board,
							hide_user: !0
						});
					buf.push(null == __val__ ? "" : __val__)
				}
				buf.push('<script>(function(){app.initLikeButtons(),app.initAddCommentButtons(),app.initGifButtons();var a=document.getElement("#board_card .organize");a&&app.pinOrganizer(a)})()</script>')
			}
			buf.push("</div>"), board.pins && board.pins.length && board.user_id !== (req.user && req.user.user_id) && (buf.push("<div"), buf.push(attrs({
				id: "board_sns_overlay"
			})), buf.push("><div"), buf.push(attrs({
				"class": "content"
			})), buf.push("><span"), buf.push(attrs({
				"class": "words"
			})), buf.push(">这个画板不错吧？赶紧分享给小伙伴！</span><span>分享到：</span><a"), buf.push(attrs({
				href: "js-share/?to=weibo",
				target: "_blank",
				"class": "sns-icon weibo"
			})), buf.push(">新浪微博</a><a"), buf.push(attrs({
				href: "js-share/?to=qzone",
				target: "_blank",
				"class": "sns-icon qqzone"
			})), buf.push(">QQ空间</a></div></div>")), buf.push('</div><script>(function(){try{ga("set","dimension5",app.page.board.category_id||"")}catch(a){}app.initPureFollowBoardButtons({onFollowSuccess:function(a){a.removeClass("rbtn"),a.getElement(".text").innerHTML="取消关注此画板"},onUnfollowSuccess:function(a){a.addClass("rbtn"),a.getElement(".text").innerHTML="关注此画板"}}),function(){var b=document.getElement("#board_card .action-buttons");if(!b||b.retrieve("initialized"))return;b.addEvent("click:relay(a.like-board,a.unlike-board)",function(){var a=this;app.requireLogin(function(){var b=a.get("text"),c=b.toInt();c=isNaN(c)?0:c;var d=(new Button(a)).disable();a.hasClass("like-board")?(new Request.JSON({url:"/boards/"+app.page.board.board_id+"/like/",onSuccess:function(b){if(b.err)app.error(b.msg||app.COMMON_ERRMSG);else{a.addClass("unlike-board").removeClass("like-board"),c++,d.setTitle(c+"喜欢");function e(a){document.body.removeEvent("mouseup",e)}document.body.addEvent("mouseup",e)}},onComplete:function(){d.enable()}})).post():a.hasClass("unlike-board")&&(new Request.JSON({url:"/boards/"+app.page.board.board_id+"/unlike/",onSuccess:function(b){if(b.err)app.error(b.msg||app.COMMON_ERRMSG);else{a.addClass("like-board").removeClass("unlike-board"),c--;var e=c>0?c+"喜欢":"喜欢";d.setTitle(e)}},onComplete:function(){d.enable()}})).post()})}),b.store("initialized",!0)}(),function(){function f(){b.slide("out").get("slide").chain(function(){b.hide()})}var b=$("category_callout");if(!b||b.retrieve("initialized"))return;var c=b.getElement(".Submit a"),d=b.getElement(".form"),e=new CategoryPicker(b.getElement("div.CategoryPicker")),g=new Button(c,{click:function(){var a=e.getSelected();return a?(this.disable(),(new Request.JSON({url:"/boards/"+app.page.board.board_id+"/",data:{category:a},onSuccess:function(a){a.err?alert(a.msg||app.COMMON_ERRMSG):(d.hide(),f(),app.msg("已成功设置分类，感谢你的支持。"))},onFailure:function(){alert(app.COMMON_ERRMSG)},onComplete:function(){this.enable()}.bind(this)})).post(),!1):!1}});g.disable(),e.addEvent("select",function(){this.getSelected()?g.enable():g.disable()}),b.store("initialized",!0)}(),function(){var a=app.page.board.is_private;if(a)return;var b=document.getElement("#board_card .huaban-share-unit .more"),c=document.getElement("#board_card .huaban-share-unit .menu");new MenuController({menu:c,trigger:b})}()})(),function(){var a=document.id("board_sns_overlay");if(a){var b=!1;function c(e){var f=window.getSize().y;if(window.getScroll().y>f){if(b)return;b=!0,a.tween("height",[0,48]).get("tween").chain(function(){d(),app.view.removeEvent("mousewheel",c)})}}app.view.addEvent("mousewheel",c);function d(){function b(c){var d=window.getSize().y;window.getScroll().y>4*d&&a.getStyle("height").toInt()>0&&(a.tween("height",[48,0]),app.view.removeEvent("mousewheel",b))}app.view.addEvent("mousewheel",b)}a.addEvent("click:relay(.close)",function(b){return b.stop(),a.tween("height",[48,0]),!1})}}(),app._gaq_promotion&&app._gaq_promotion()</script>')
		}
		return buf.join("")
	}, __t["base/bookmarklet"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "bookmarklet"
			})), buf.push(">");
			var __val__ = emerge("base/pin_create", {
				text: page.description,
				req: req,
				media: page.media[0]
			});
			buf.push(null == __val__ ? "" : __val__), buf.push("</div><div"), buf.push(attrs({
				id: "bookmarklet_alert",
				style: "display: none"
			})), buf.push(">你所使用的浏览器不支持采集该图片所需的<a"), buf.push(attrs({
				href: "http://caniuse.com/#feat=x-doc-messaging",
				target: "_blank"
			})), buf.push(">特性</a><br"), buf.push(attrs({})), buf.push('/>请将 IE 浏览器升级至版本 10 以上，或者换用其它现代浏览器使用此功能</div><script>(function(){((function(){$("page").removeClass("page-min-width");var a={width:document.html.clientWidth,height:document.html.clientHeight};window.resizeBy(632-a.width,320-a.height)})).delay(300);var a=document.id("bookmarklet"),b=a.getElement(".text-block .description"),c=a.getElement(".board-list"),d=a.getElement(".action"),e=a.getElements(".shares .share"),f=a.getElement(".preview img"),g=app.page.media[0],h=document.id("bookmarklet_alert"),i=!1,j=!1;i=app.page.media[0]=="from_chrome_extension",j=app.page.media[0]=="base64image";if(j){if(Browser.ie&&Browser.version<10){h.show(),a.hide();return}var k=function(a){f.src=a.imgUrl};Element.NativeEvents.message=2,window.addEvent("message",function(a){var b=JSON.decode(a.event.data)||[];k(b[0])}),window.opener.postMessage("singleUnit","*")}d.addEvent("click",function(){if(this.hasClass("disabled"))return;var a=c.get("data-board-id");if(!a)return app.alert("请选择或者创建一个画板");var d={board_id:a,text:b.value,via:app.page.via||2,media_type:app.page.media_type||0,video:app.page.video||0,file_ticket:app.page.file_ticket||null,link:app.page.url,check:!0},g=0;e.each(function(a){if(!a.hasClass("active"))return;var b=a.get("data-key"),c=a.get("data-flag");d[b]=!0,g|=c;try{ga("send","event","SocialShare",b+":{api}","PinDialog:"+app.page.pin.source)}catch(e){}}),app.req.user.status.share=d.share_button=g,!j&&!i?m(d):n(f.src,function(a){if(a.err)return app.alert(a.msg||"上传文件失败");d.file_id=a.id,delete d.file_ticket,m(d)})});var l=!1,m=function(a){d.addClass("disabled").innerHTML="采集中...",(new Request.JSON({url:"/pins/",data:a,onSuccess:function(b){if(b.err&&b.msg&&typeof b.msg=="string"&&~b.msg.indexOf("抓取")&&f.src.indexOf("data\\:image")==0){if(l)return app.alert(b.msg);n(f.src,function(b){l=!0;if(b.err)return app.alert(b.msg||"上传文件失败");a.file_id=b.id,delete a.file_ticket,m(a)});return}if(b.err){app.error(b.msg||app.COMMON_ERRMSG),app.feedback(Object.merge(a,b));return}if(b.warning==100){app.confirm(\'你已经在画板<a target="_blank" href="/boards/\'+b.pin.board.board_id+\'/">\'+b.pin.board.title+"</a>中采集过这张图片，是否继续？",function(b){if(!b)return;delete a.check,m(a)});return}app.hideDialogBox("repin"),app.$pin=b.pin,app.route("/bookmarklet_success");if(!Browser.ie||Browser.version>=10)try{window.opener.postMessage("complete:"+g,"*"),window.opener.postMessage("singlePinComplete","*")}catch(c){}},onFailure:function(b){app.feedback(Object.merge(a,{err:b.status}))},onComplete:function(){d.removeClass("disabled").innerHTML="采下来"}})).post()},n=function(a,b){d.addClass("disabled"),(new Request.JSON({url:"/upload/",data:{file:a},onSuccess:b,onFailure:function(){app.alert("上传文件失败")}})).post()}})()</script>')
		}
		return buf.join("")
	}, __t["base/bookmarklet_fetching"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "bookmarklet",
				"class": "fetching"
			})), buf.push("><div"), buf.push(attrs({
				"class": "board_list"
			})), buf.push("><div"), buf.push(attrs({
				"class": "boarder"
			})), buf.push(">");
			var __val__ = emerge("base/board_list", {
				currentBoard: "default"
			});
			buf.push(null == __val__ ? "" : __val__), buf.push("</div><div"), buf.push(attrs({
				style: "display: none",
				"class": "info"
			})), buf.push("><span>采集完成</span><div"), buf.push(attrs({
				"class": "info-form"
			})), buf.push("><a"), buf.push(attrs({
				target: "_blank",
				"class": "go-board brown-link"
			})), buf.push(">查看画板</a><span>|</span><span></span><a"), buf.push(attrs({
				"class": "close-window brown-link"
			})), buf.push(">关闭窗口</a></div></div></div><div"), buf.push(attrs({
				"class": "form"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "pin_form clearfix"
			})), buf.push("><div"), buf.push(attrs({
				"class": "info-part"
			})), buf.push("><span>已选择<span style='color:#9a0000;'> 0 </span>张图片，一次最多可以选择10张图片</span></div><div"), buf.push(attrs({
				"class": "btn-part"
			})), buf.push("><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "btn18 disabled btn rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push('> 采下来</span></a></div></div></div><script>(function(){((function(){$("page").removeClass("page-min-width");var a={width:document.html.clientWidth,height:document.html.clientHeight};window.resizeBy(730-a.width,510-a.height)})).delay(300);var a=app.page.images,b=app.page.minWidth,c=app.page.minHeight,d=126,e=200,f,g=document.id("bookmarklet"),h=g.getElement(".form"),i=g.getElement(".wfc"),j=g.getElement(".info-part"),k=j.getElement("span"),l=g.getElement(".btn18"),m=g.getElement(".board-list"),n=g.getElement(".info"),o=g.getElement("span"),p=g.getElement(".go-board"),q=g.getElement(".close-window"),r=new Request.Queue({stopOnFailure:!1,concurrent:2}),s=function(){app.page.$waterfall=(new Waterfall("waterfall",{hibernate:!1,paddingBottom:!1,cellWidth:d,cellSpace:12,minCols:5,maxCols:5,containerSelector:"",container:"waterfall"})).reposition()},t=function(a,b,c){var d=a.getElement("img").get("src"),e=a.getElement("img").get("alt"),f={timeout:3e3,board_id:b,via:2,media_type:0,img_url:d,text:e,video:0,link:app.page.url};return c==1&&(f.check=!0),new Request.JSON({url:"/pins/",method:"post",data:f,onRequest:function(){x(a)},onComplete:function(b){b.warning==100&&b.pin?y(a,b.pin.pin_id):b.pin?z(a,b.pin.pin_id):y(a),u()||B()}})},u=function(){return!!r.hasNext()||!!Object.keys(r.getRunning()).length},v=function(a,b){a.each(function(a,c){var d=t(a,b,!0);r.addRequest(c,d).send(c)})},w=function(a){for(var b=0,c=a.length;b<c;b++)a[b].addClass("waiting"),a[b].getChildren(".selected_btn").hide(),h.removeEvent("click:relay(.wfc)")},x=function(a){a.removeClass("waiting").addClass("sending"),$$(".board-list").get("style")!="display: none;"&&(k.innerHTML="采集中...")},y=function(a,b){a.removeClass("sending").addClass("failed"),b&&a.addClass("duplicated")},z=function(a,b){a.removeClass("sending").addClass("finished"),a.set("href","/pins/"+b+"/"),a.set("target","_blank")},A=function(a){a.removeClass("failed").removeClass("duplicated").addClass("sending");var b=m.get("data-board-id");t(a,b,!1).send(),o.innerHTML="采集中..."},B=function(){var a=[];for(var b=0,c=$$(".select_btn").length;b<c;b++){var d=$$(".select_btn")[b],e=d.getParent(".wfc");e.hasClass("unit")==0&&e.addClass("noUse")}$$(".noUse").destroy(),s(),n.show(),m.hide(),j.addClass("info-part2");var f=h.getElements(".failed").length,g=h.getElements(".finished").length;g&&!f?k.innerHTML="<img src=\'/img/icon_succ.png\' />&nbsp;&nbsp;&nbsp;&nbsp;成功采集 "+g+" 张":f&&!g?k.innerHTML="<img src=\'/img/icon_lose.png\' />&nbsp;&nbsp;&nbsp;&nbsp;采集失败 "+f+" 张":f&&g&&(k.innerHTML="<img src=\'/img/icon_succ.png\' />&nbsp;&nbsp;&nbsp;&nbsp;成功采集 "+g+" 张，&nbsp;&nbsp;&nbsp;&nbsp;<img src=\'/img/icon_lose.png\' />&nbsp;&nbsp;&nbsp;&nbsp;失败 "+f+" 张"),o.innerHTML="采集完成",window.fireEvent("allComplete")},C=Asset.images(a.map(function(a){return a.src}),{onComplete:function(){function f(a,b){return a.height*a.width<b.height*b.width?1:-1}var a=C,g=[],i=[];for(var j=0,k=a.length;j<k;j++){var l=a[j];l.height>=c&&l.width>=b&&(l.height>=e?g.push(l):i.push(l))}a=g.sort(f).append(i.sort(f));var m=(new Element("div",{id:"waterfall","class":"waterfall"})).inject(h);a.each(function(a,b){var c=a.width,e=a.height;if(c>d){var f=c/d;e/=f,c=d}a.width=c,a.height=e;var g=a.alt,h=a.src,i=(new Element("div",{"class":"wfc"})).set("html",\'<img clss="image" src="\'+h+\'" alt="\'+g+\'" width="\'+c+\'" height="\'+e+\'" /><div class="select_btn"></div><a class="indicator" target="_blank"><i></i></a>\').inject(m)}),s()}}),D=function(a){a.toggleClass("selected_btn"),a.getParent(".wfc").toggleClass("unit"),selectedLength=$$(".selected_btn").length,k.innerHTML="已选择<span style=\'color:#9a0000;\'> "+selectedLength+" </span>张图片，一次最多可以选择10张图片",selectedLength>0?l.removeClass("disabled"):l.addClass("disabled")};h.addEvent("click:relay(.wfc)",function(){var a=this.getChildren(".select_btn"),b=this.getChildren(".selected_btn"),c=$$(".selected_btn").length;if(c<10)D(a);else if(c=9){var d=a.get("class")[0];d=="select_btn selected_btn"?D(a):k.innerHTML="您已经选择10张图片"}}),l.addEvent("click",function(){if(this.hasClass("disabled"))return;this.addClass("disabled"),h.addClass("started");var a=h.getElements(".unit");if(!a.length)return;var b=m.get("data-board-id");p.set("href","/boards/"+b+"/"),w(a),v(a,b),l.destroy()}),h.addEvent("click:relay(.cancel)",function(){this.getParent(".unit").dispose(),h.getElements(".unit").length||l.addClass("disabled")}),h.addEvent("click:relay(.failed .indicator)",function(a){var b=this.getParent(".unit");a.stop(),A(b)}),q.addEvent("click",function(){window.close()}),window.onbeforeunload=function(a){if(u())return"关闭窗口将会停止采集，确定关闭？"}})()</script>')
		}
		return buf.join("")
	}, __t["base/bookmarklet_multiple"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "bookmarklet_multiple"
			})), buf.push(">");
			var __val__ = emerge("base/board_list", {
				currentBoard: "default"
			});
			buf.push(null == __val__ ? "" : __val__), buf.push("<div"), buf.push(attrs({
				style: "display: none",
				"class": "status-bar"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "pin-units clearfix"
			})), buf.push("><div"), buf.push(attrs({
				"class": "unit"
			})), buf.push("><img"), buf.push(attrs({
				"data-baiduimageplus-ignore": 1
			})), buf.push("/><div"), buf.push(attrs({
				"class": "cancel"
			})), buf.push("></div><a"), buf.push(attrs({
				target: "_blank",
				"class": "indicator"
			})), buf.push("><i></i></a></div></div><div"), buf.push(attrs({
				"class": "bottom-part"
			})), buf.push("><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "go disabled btn btn18 rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 采下来</span></a></div><div"), buf.push(attrs({
				style: "display: none",
				"class": "info-part"
			})), buf.push("><span>采集成功</span><div"), buf.push(attrs({
				"class": "right"
			})), buf.push("><a"), buf.push(attrs({
				target: "_blank",
				"class": "go-board brown-link"
			})), buf.push(">查看画板</a><a"), buf.push(attrs({
				"class": "close-window brown-link"
			})), buf.push(">关闭窗口</a></div></div></div><div"), buf.push(attrs({
				id: "bookmarklet_multiple_alert",
				style: "display: none"
			})), buf.push(">你所使用的浏览器不支持批量采集所需的<a"), buf.push(attrs({
				href: "http://caniuse.com/#feat=x-doc-messaging",
				target: "_blank"
			})), buf.push(">特性</a><br"), buf.push(attrs({})), buf.push('/>请将 IE 浏览器升级至版本 10 以上，或者换用其它现代浏览器使用此功能</div><script>(function(){var a=document.id("bookmarklet_multiple"),b=a.getElement(".pin-units"),c=a.getElement(".unit").dispose(),d=a.getElement(".go"),e=a.getElement(".bottom-part"),f=a.getElement(".info-part"),g=f.getElement("span"),h=a.getElement(".close-window"),i=a.getElement(".go-board"),j=a.getElement(".board-list"),k=a.getElement(".status-bar"),l=document.id("bookmarklet_multiple_alert");if(Browser.ie&&Browser.version<10){l.show(),a.hide();return}var m=function(a){var d=c.clone().inject(b);d.setStyle("background-image","url("+a.imgUrl+")"),d.getElement("img").src=a.imgUrl,d.unit=a},n=new Request.Queue({stopOnFailure:!1,concurrent:2}),o=function(a){var b=a.unit,c=a.getElement("img");return new Request.JSON({url:"/pins/",method:"post",data:{timeout:3e3,board_id:b.toBoard,text:b.description,via:2,media_type:b.video?1:0,img_url:b.imgUrl,video:b.video||0,link:b.url,check:!0},onRequest:function(){u(a)},onComplete:function(d){var e=this;if(d.warning==100&&d.pin)v(a,d.pin.pin_id);else if(d.pin)w(a,d.pin.pin_id);else if(d.err&&d.msg&&~d.msg.indexOf("抓取")&&c.src.indexOf("data\\:image")==0){if(b.uploaded)return v(a);b.uploaded=!0,q(c,function(b){if(b.err)return v(a);e.options.data.file_id=b.id,delete e.options.data.file_ticket;var c=Math.floor(1e6*Math.random());n.addRequest(c,e).send(c)})}else v(a);p()||y()}})},p=function(){return!!n.hasNext()||!!Object.keys(n.getRunning()).length},q=function(a,b){var c=new Request.JSON({url:"/upload/",data:{file:a.src},onSuccess:b,onFailure:function(){v(a.getParent(".unit")),p()||y()}}),d=Math.floor(1e6*Math.random());n.addRequest(d,c).send(d)},r=function(a,b){a.each(function(a,c){a.unit.toBoard=b;var d=o(a);n.addRequest(c,d).send(c)})},s=function(a){if(!window.opener||!window.opener.postMessage)return;window.opener.postMessage("complete:"+a,"*")},t=function(a){a.addClass("waiting")},u=function(a){a.removeClass("waiting").addClass("sending"),j.hide(),k.show().innerHTML="正在采集..."},v=function(a,b){a.removeClass("sending").addClass("failed"),b&&(a.addClass("duplicated").getElement(".indicator").set("href","/pins/"+b+"/"),s(a.unit.imgUrl))},w=function(a,b){a.removeClass("sending").addClass("finished"),a.getElement(".indicator").set("href","/pins/"+b+"/"),s(a.unit.imgUrl)},x=function(a){a.removeClass("failed").addClass("sending"),o(a).send()},y=function(){e.hide(),f.show();var a=b.getElements(".failed").length,c=b.getElements(".finished").length;c&&!a?g.innerHTML="采集成功":a&&!c?g.innerHTML="采集失败":a&&c&&(g.innerHTML="采集成功 "+c+" 个，失败 "+a+" 个"),k.innerHTML="采集完成",window.fireEvent("allComplete")};Element.NativeEvents.message=2,window.addEvent("message",function(a){var b=JSON.decode(a.event.data);b.each(function(a){m(a)})}),window.opener.postMessage("multiUnits","*"),d.addEvent("click",function(){if(this.hasClass("disabled"))return;this.addClass("disabled"),b.addClass("started");var a=b.getElements(".unit");if(!a.length)return;var c=j.get("data-board-id");i.set("href","/boards/"+c+"/"),t(a),r(a,c)}),j.addEvent("select",function(){d.removeClass("disabled")}),b.addEvent("click:relay(.cancel)",function(){this.getParent(".unit").dispose(),b.getElements(".unit").length||d.addClass("disabled")}),b.addEvent("click:relay(.failed .indicator)",function(a){var b=this.getParent(".unit");if(b.hasClass("duplicated"))return;a.stop(),x(b)}),h.addEvent("click",function(){window.close()}),window.onbeforeunload=function(a){if(p())return"关闭窗口将会停止采集，确定关闭？"};var z=!0;window.addEvents({focus:function(){z=!0},blur:function(){z=!1},allComplete:function(){if($$(".unit.failed").length)return;setTimeout(function(){z||window.close()},6e3)}}),function(){$("page").removeClass("page-min-width");var a={width:document.html.clientWidth,height:document.html.clientHeight};window.resizeBy(500-a.width,350-a.height)}.delay(300),Asset.images(["/img/bookmarklet/icons.png","/img/bookmarklet/pin_motion.gif"])})()</script>')
		}
		return buf.join("")
	}, __t["base/bookmarklet_success"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, pin = app.$pin,
				bindings = app.req.user.bindings,
				boards = app.req.user.boards,
				board;
			for(var i = 0, l = boards.length; i < l; i++)
				if(boards[i].board_id == pin.board_id) {
					board = boards[i];
					break
				}
			var board_title = board.is_private == 2 ? "待归类采集" : board.title,
				apiShareButtons = [];
			bindings.weibo && apiShareButtons.push("weibo"), bindings.qzone && apiShareButtons.push("qzone"), bindings.renren && apiShareButtons.push("renren"), apiShareButtons = apiShareButtons.length <= 2 ? apiShareButtons : apiShareButtons.slice(0, 2);
			var jsShareButtons = ["weibo", "qzone", "tqq", "douban", "renren"];
			jsShareButtons = jsShareButtons.filter(function(e) {
				return !~apiShareButtons.indexOf(e)
			}), buf.push("<div"), buf.push(attrs({
				"class": "form"
			})), buf.push("><div"), buf.push(attrs({
				"class": "bookmarklet-done"
			})), buf.push("><h3>你已经成功采集到<a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/",
				target: "_blank",
				onclick: 'try{_czc.push(["_trackEvent", "bookmarklet", "click", "board", 1]);}catch(e){};',
				"class": "less"
			})), buf.push(">" + escape((interp = board_title) == null ? "" : interp) + "</a></h3><div"), buf.push(attrs({
				id: "pin_operations"
			})), buf.push("><a"), buf.push(attrs({
				id: "view_pin",
				href: "/pins/" + pin.pin_id + "/",
				onclick: 'try{_czc.push(["_trackEvent", "bookmarklet", "click", "pin", 1]);}catch(e){};'
			})), buf.push(">查看这个采集</a>&nbsp;|<div"), buf.push(attrs({
				"class": "pin_time"
			})), buf.push(">1 秒后自动</div><a"), buf.push(attrs({
				id: "close_window",
				href: "#"
			})), buf.push(">关闭窗口</a></div>");
			if(apiShareButtons.length > 0) {
				buf.push("<div"), buf.push(attrs({
					"class": "pin-share-description"
				})), buf.push("><p>据说这么好的东西是要分享给好友的～～～</p><textarea>" + escape((interp = pin.raw_text) == null ? "" : interp) + "</textarea>");
				var __val__ = img(pin.file, "sq75", {
					alt: ""
				});
				buf.push(null == __val__ ? "" : __val__), buf.push("</div><div"), buf.push(attrs({
					"class": "pin-share-buttons"
				})), buf.push("><div"), buf.push(attrs({
					"class": "pin-api-share-buttons"
				})), buf.push(">"), ~apiShareButtons.indexOf("weibo") && (buf.push("<a"), buf.push(attrs({
					href: "#",
					"class": "weibo share-button btn btn18 wbtn"
				})), buf.push("><strong><em></em> 分享至新浪微博</strong><span></span></a>")), ~apiShareButtons.indexOf("qzone") && (buf.push("<a"), buf.push(attrs({
					href: "#",
					"class": "qzone share-button btn btn18 wbtn"
				})), buf.push("><strong><em></em> 分享至QQ空间</strong><span></span></a>")), ~apiShareButtons.indexOf("douban") && (buf.push("<a"), buf.push(attrs({
					href: "#",
					"class": "douban share-button btn btn18 wbtn"
				})), buf.push("><strong><em></em> 分享至豆瓣</strong><span></span></a>")), ~apiShareButtons.indexOf("renren") && (buf.push("<a"), buf.push(attrs({
					href: "#",
					"class": "renren share-button btn btn18 wbtn"
				})), buf.push("><strong><em></em> 分享至人人</strong><span></span></a>")), buf.push("</div><div"), buf.push(attrs({
					"class": "pin-js-share-buttons"
				})), buf.push(">或:<ul>"), ~jsShareButtons.indexOf("weibo") && (buf.push("<li><a"), buf.push(attrs({
					href: "#",
					title: "分享到新浪微博",
					"data-to": "weibo",
					"class": "weibo share-button"
				})), buf.push(">分享到新浪微博</a></li>")), ~jsShareButtons.indexOf("qzone") && (buf.push("<li><a"), buf.push(attrs({
					href: "#",
					title: "分享到QQ空间",
					"data-to": "qzone",
					"class": "qzone share-button"
				})), buf.push(">分享到QQ空间</a></li>")), ~jsShareButtons.indexOf("tqq") && (buf.push("<li><a"), buf.push(attrs({
					href: "#",
					title: "分享到腾讯微博",
					"data-to": "tqq",
					"class": "tqq share-button"
				})), buf.push(">分享到腾讯微博</a></li>")), ~jsShareButtons.indexOf("douban") && (buf.push("<li><a"), buf.push(attrs({
					href: "#",
					title: "分享到豆瓣",
					"data-to": "douban",
					"class": "douban share-button"
				})), buf.push(">分享到豆瓣</a></li>")), ~jsShareButtons.indexOf("renren") && (buf.push("<li><a"), buf.push(attrs({
					href: "#",
					title: "分享到人人",
					"data-to": "renren",
					"class": "renren share-button"
				})), buf.push(">分享到人人</a></li>")), buf.push("</ul></div></div>")
			} else buf.push("<div"), buf.push(attrs({
				"class": "pin-js-share-buttons"
			})), buf.push("><a"), buf.push(attrs({
				href: "#",
				"data-to": "weibo",
				"class": "weibo share-button btn btn18 wbtn"
			})), buf.push("><strong><em></em> 分享到新浪微博</strong><span></span></a><a"), buf.push(attrs({
				href: "#",
				"data-to": "qzone",
				"class": "qzone share-button btn btn18 wbtn"
			})), buf.push("><strong><em></em> 分享到QQ空间</strong><span></span></a><a"), buf.push(attrs({
				href: "#",
				"data-to": "tqq",
				"class": "tqq share-button btn btn18 wbtn"
			})), buf.push("><strong><em></em> 分享到腾讯微博</strong><span></span></a><a"), buf.push(attrs({
				href: "#",
				"data-to": "douban",
				"class": "douban share-button btn btn18 wbtn"
			})), buf.push("><strong><em></em> 分享到豆瓣</strong><span></span></a></div>");
			buf.push('</div></div><script>(function(){var a={weibo:1,qzone:2,douban:8,renren:16},b=app.$pin,c=$("pin_success"),d=window.close,e=!1;c&&(d=function(){app.hideDialog()}),$("close_window").addEvent("click",function(){return d(),!1}),["weibo","qzone","douban","renren"].each(function(c){if(b.share_button/1&a[c]){var d=$$(".pin-api-share-buttons .share-button."+c);d[0]&&(new Button(d[0])).disable().setTitle("已成功分享")}}),$$(".pin-js-share-buttons .share-button").addEvent("click",function(){if(this.hasClass("disabled"))return;try{ga("send","event","SocialShare",shareType+":{js}","PinSuccess:"+app.page.pin.source)}catch(a){}var c=this.get("data-to");window.open("/pins/"+b.pin_id+"/js-share/?to="+c)}),$$(".pin-api-share-buttons .share-button").forEach(function(a){new Button(a,{disabledTitle:"分享中...",click:function(){this.disable();var a={},c=$$(".pin-share-description textarea")[0].value,d;this.element.hasClass("weibo")&&(a.weibo=!0,d="weibo"),this.element.hasClass("qzone")&&(a.qzone=!0,d="qzone"),this.element.hasClass("renren")&&(a.renren=!0,d="renren"),this.element.hasClass("douban")&&(a.douban=!0,d="douban");var f=c||"";f.length>45&&(f=f.substring(0,45)+"..."),f="这张图不错哦，分享给大家！"+f,a.description=f;try{ga("send","event","SocialShare",d+":{api}","PinSuccess:"+app.page.pin.source)}catch(g){}var h=this;return(new Request.JSON({url:"/pins/"+b.pin_id+"/share/",data:a,onSuccess:function(a){var b=!1;["weibo","qzone","douban","renren"].each(function(c){a[c]&&a[c].err&&(b=!0)}),b?a.weibo&&a.weibo.err&&[10024,20017,20046,20005,20006,20034,21332,21327,20003].indexOf(a.weibo.err)>=0?a.weibo.err==10024?(alert("请求频次超过上限"),h.enable()):[21327,20003,21332].indexOf(a.weibo.err)>=0?(e=!0,h.setTitle("分享失败"),document.getElement(".pin-share-buttons").innerHTML+=\'授权失败 <a href="/settings/#set_bindings" target="_blank"><strong>重新绑定新浪微博</strong></a>\'):(alert("分享失败"),h.enable()):(alert("分享失败"),h.enable()):h.setTitle("已成功分享")},onFailure:function(a){alert("分享失败"),h.enable()}})).post(),!1}})});if(!c){$("view_pin").set("target","_blank").addEvent("click",function(){setTimeout(d,100)}),e&&(clearTimeout(f),$$(".pin_time").hide());var f;(function h(a){if(a==0)return window.close(),!1;$$(".pin_time").set("text",a+" 秒后自动"),a--,f=setTimeout(h,1e3,a)})(5);var g=$$(".pin-share-description textarea")[0];g&&g.addEvent("focus",function(){clearTimeout(f),$$(".pin_time").hide()})}})()</script>')
		}
		return buf.join("")
	}, __t["base/categories"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__), buf.push("<div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				"class": "category-items clearfix"
			})), buf.push(">");
			for(var $index = 0, $$l = page.categories.length; $index < $$l; $index++) {
				var item = page.categories[$index];
				buf.push("<a"), buf.push(attrs({
					href: "/favorite/" + item.urlname + "/",
					"class": "category-item"
				})), buf.push("><div"), buf.push(attrs({
					"class": "category-item-title clearfix"
				})), buf.push("><div"), buf.push(attrs({
					"class": "category-item-name"
				})), buf.push(">");
				var __val__ = item.name;
				buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</div><div"), buf.push(attrs({
					"class": "category-item-arrow"
				})), buf.push("></div></div><div"), buf.push(attrs({
					"class": "category-item-cover clearfix"
				})), buf.push(">"), item.covers.length && item.covers.length === 3 && (buf.push("<img"), buf.push(attrs({
					src: "" + imgURL(item.covers[0].file, "sq180") + "",
					"data-baiduimageplus-ignore": 1,
					"class": "category-item-cover-left"
				})), buf.push("/><div"), buf.push(attrs({
					"class": "category-item-cover-right"
				})), buf.push("><img"), buf.push(attrs({
					src: "" + imgURL(item.covers[1].file, "sq75") + "",
					"data-baiduimageplus-ignore": 1,
					"class": "category-item-cover-right-top"
				})), buf.push("/><img"), buf.push(attrs({
					src: "" + imgURL(item.covers[2].file, "sq75") + "",
					"data-baiduimageplus-ignore": 1,
					"class": "category-item-cover-right-bottom"
				})), buf.push("/></div>")), buf.push("</div></a>")
			}
			buf.push("</div></div>");
			var __val__ = emerge("base/footer");
			buf.push(null == __val__ ? "" : __val__), buf.push('<script>(function(){var a,b=document.getElements(".wrapper"),c=document.getElements(".category-item"),d=function(){a=window.innerWidth,a<=1275?(b.setStyle("width",996),c.each(function(a,b){b%4===3?a.setStyle("margin-right","0"):a.setStyle("margin-right","16px")})):a>1275&&a<=1528?(b.setStyle("width",1244),c.each(function(a,b){b%5===4?a.setStyle("margin-right","0"):a.setStyle("margin-right","16px")})):(b.setStyle("width",1496),c.each(function(a,b){b%6===5?a.setStyle("margin-right","0"):a.setStyle("margin-right","16px")}))};d(),window.addEvent("resize",d)})()</script>')
		}
		return buf.join("")
	}, __t["base/categories_cell"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, cur = "all",
				cats = {},
				_categories = settings.categories.concat(settings.channels);
			_categories.unshift({
				id: "all",
				name: "全部"
			});
			for(var i = 0, l = _categories.length; i < l; i++) cats[_categories[i].id] = _categories[i];
			var cat_groups = [
					["all", "home", "travel_places", "food_drink", "pets", "people", "film_music_books", "photography", "desire", "architecture", "tips", "funny", "art", "other"],
					["illustration", "design", "web_app_icon"],
					["taomm", "modeling_hair", "wedding_events", "apparel", "kids", "diy_crafts"],
					["beauty", "cars_motorcycles", "data_presentation", "digital", "men", "sports"],
					["videos", "web_captures"]
				],
				keywords = typeof seo_keywords_dic == "undefined" ? {} : seo_keywords_dic;
			page.filter && ~page.filter.indexOf("category:") && (cur = page.filter.split(":").pop()), buf.push("<div"), buf.push(attrs({
				"class": "pin category wfc"
			})), buf.push(">");
			for(var i = 0, l = cat_groups.length; i < l; i++) {
				buf.push("<div"), buf.push(attrs({
					"class": "cats " + (i === l - 1 ? "last" : "")
				})), buf.push(">");
				for(var j = 0, sl = cat_groups[i].length; j < sl; j++) {
					var c = cats[cat_groups[i][j]],
						keyword = keywords[c.id] || "";
					buf.push("<a"), buf.push(attrs({
						href: "/" + (c.id === "beauty" ? "favorite" : "all") + "/" + c.id + "/",
						title: "" + keyword + "",
						"class": (cur === c.id ? "selected " : " ") + c.id
					})), buf.push("><span>");
					var __val__ = c.name;
					buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</span></a>")
				}
				buf.push("</div>")
			}
			cur == "web_captures" && (buf.push("<a"), buf.push(attrs({
				href: "https://huaban.com/about/goodies/chrome/",
				"class": "chrome_crx_ad"
			})), buf.push(">使用花瓣Chrome扩展 你也可以采集网页截图哦</a>")), buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/category_explore"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, explores = page.explores;
			buf.push("<div"), buf.push(attrs({
				"class": "category-image-box explore-category-image-box " + (req.user ? "" : "login-explore-category-image-box")
			})), buf.push(">");
			if(explores)
				for(var $index = 0, $$l = explores.length; $index < $$l; $index++) {
					var item = explores[$index];
					if(item == null) return;
					buf.push("<a"), buf.push(attrs({
						href: "/explore/" + item.urlname + "/",
						target: "_self",
						title: explores.name,
						"class": "category-image " + (req.user ? "" : "login-category-image")
					})), buf.push(">"), item.cover && (buf.push("<div"), buf.push(attrs({
						"class": "blur"
					})), buf.push("><img"), buf.push(attrs({
						src: imgURL(item.cover, "sq236bl4"),
						"data-baiduimageplus-ignore": 1
					})), buf.push("/></div>")), buf.push("<div"), buf.push(attrs({
						"class": "title"
					})), buf.push(">");
					var __val__ = item.name;
					buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</div></a>")
				}
			buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/category_picker"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, data = locals.data || "";
			buf.push("<div"), buf.push(attrs({
				"class": "BoardListOverlay"
			})), buf.push("></div><div"), buf.push(attrs({
				data: "" + data + "",
				"class": "BoardSelector BoardPicker CategoryPicker"
			})), buf.push("><div"), buf.push(attrs({
				"class": "current"
			})), buf.push("><span"), buf.push(attrs({
				"class": "CurrentBoard"
			})), buf.push(">选择分类</span><span"), buf.push(attrs({
				"class": "DownArrow"
			})), buf.push("></span></div><div"), buf.push(attrs({
				"class": "BoardList"
			})), buf.push("><div"), buf.push(attrs({
				"class": "BoardListBody"
			})), buf.push('><ul></ul></div></div></div><script>(function(){$$("div.CategoryPicker").each(function(a){if(a.retrieve("initialized"))return;(new CategoryPicker(a)).select(a.get("data")),a.store("initialized",!0)})})()</script>')
		}
		return buf.join("")
	}, __t["base/chrome_callout"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "chrome_callout",
				style: "display: none;",
				"class": "has-close phide"
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				"class": "intro sheet"
			})), buf.push("><span>安装花瓣的chrome采集工具，你可以方便地收集网络上的图片，<br"), buf.push(attrs({})), buf.push("/>视频及网页截图，这是花瓣的精髓所在。</span><a"), buf.push(attrs({
				target: "_blank",
				href: "#",
				onclick: "return false;",
				"class": "install-extension btn btn18 rbtn"
			})), buf.push("><strong> 安装花瓣Chrome扩展</strong><span></span></a><a"), buf.push(attrs({
				"class": "close"
			})), buf.push('></a></div></div></div><script>(function(){if(!Browser.chrome||Browser.version<18){document.id("chrome_callout").dispose();return}var a=Cookie.read("_hb_chrome_extention");$$("#chrome_callout .close").addEvent("click",function(){Cookie.write("_hb_chrome_extention",!0,{duration:365}),document.id("chrome_callout").hide()}),$$("#chrome_callout .install-extension").addEvent("click",function(){return installHuabanChromeAddon(),document.id("chrome_callout").hide(),!1})})()</script>')
		}
		return buf.join("")
	}, __t["base/cities_picker"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "CityPicker CategoryPicker province-selection"
			})), buf.push("><div"), buf.push(attrs({
				"class": "current"
			})), buf.push("><span"), buf.push(attrs({
				"class": "current-select"
			})), buf.push(">省</span><span"), buf.push(attrs({
				"class": "DownArrow"
			})), buf.push("></span></div><div"), buf.push(attrs({
				"class": "CityList"
			})), buf.push("><div"), buf.push(attrs({
				"class": "CityListBody"
			})), buf.push("><ul></ul></div></div></div><div"), buf.push(attrs({
				style: "display:none;",
				"class": "CityPicker CategoryPicker city-selection"
			})), buf.push("><div"), buf.push(attrs({
				"class": "current"
			})), buf.push("><span"), buf.push(attrs({
				"class": "current-select"
			})), buf.push(">市</span><span"), buf.push(attrs({
				"class": "DownArrow"
			})), buf.push("></span></div><div"), buf.push(attrs({
				"class": "CityList"
			})), buf.push("><div"), buf.push(attrs({
				"class": "CityListBody"
			})), buf.push('><ul></ul></div></div></div><script>(function(){var a=new Class({Extends:CategoryPicker,init:function(){var a=this.element;this._maxH=this.options.itemHeight*this.options.maxVisibleItems,this.curEl=a.getElement(".current-select"),this.popEl=a.getElement(".CityList"),this.bodyEl=a.getElement(".CityListBody"),this.listEl=this.bodyEl.getElement("ul"),this.popup=new PopupPicker(a,this.popEl,{onPick:this.select.bind(this)})},build:function(a){this._empty(),a.each(function(a,b){this._injectItem(b,a)},this)}}),b=function(){var a=document.id("home_designer");app.page.$waterfall.update(a),a.getSize().y>document.html.clientHeight?docScroller.toElementCenter(ta,"y"):docScroller.toElement(a,"y")};(new Request.JSON({url:"/home/address",onComplete:function(c){if(c&&!c.provinces&&!c.cities)return;app.page.cities=c.cities;var d=document.getElement(".province-selection"),e=document.getElement(".city-selection"),f=d.getElement("ul"),g=new a(d);g.build(c.provinces);var h;f.addEvent("click:relay(li)",function(){var c=parseInt(this.get("data"));h?($$(".city-selection .current-select").set("text","市"),h.build(app.page.cities[c])):(h=new a(e),h.build(app.page.cities[c]),$$(".city-selection, .home-design-community, .home-design-phone").show(),b())});var i=document.getElement(".home-design-community input"),j=document.getElement(".home-design-phone input"),k=document.getElement(".home-design-save .btn"),l,m,n=function(){l=i.get("value"),m=j.get("value"),l&&m?k.removeClass("disabled"):k.addClass("disabled")};i.addEvent("keyup",n),j.addEvent("keyup",n),k.addEvent("click",function(){if(this.hasClass("disabled"))return;this.addClass("disabled");var a=document.getElement(".province-selection .current-select").get("text"),b=document.getElement(".city-selection .current-select").get("text");if(!/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/.test(m)){app.error("手机格式有误，请重新输入。"),k.removeClass("disabled");return}(new Request.JSON({url:"/home/save_contact",method:"post",data:{province:a,city:b,community:l,phone:m},onSuccess:function(a){a.err?(app.error(a.msg||app.COMMON_ERRMSG),k.removeClass("disabled")):(app.alert({type:"success",text:"恭喜！提交完成！我们会安排专员第一时间与你取得联系。"}),i.set("value",""),j.set("value",""))}})).send()})}})).get()})()</script>')
		}
		return buf.join("")
	}, __t["base/comment_form"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			user = user || {
				urlname: "",
				username: ""
			}, buf.push("<div"), buf.push(attrs({
				id: "pin_view_add_comment",
				"data-id": pin.pin_id,
				"class": "clearfix"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(user.urlname) + "/",
				title: escape(user.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(user),
				"data-baiduimageplus-ignore": 1,
				"class": "avatar"
			})), buf.push("/></a><textarea"), buf.push(attrs({
				name: "caption",
				placeholder: "添加评论或把采集@给好友",
				"class": "clear-input"
			})), buf.push("></textarea><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "post disabled btn btn14"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push('> 添加评论</span></a></div><script>(function(){var a=document.id("pin_view_add_comment");if(a.retrieve("initialized"))return;var b=a.get("data-id"),c=a.getElement(".post"),d=document.getElement(".pin-view .info-piece .comments"),e=a.getElement("textarea");e.addEvent("focus",function(){c.show(),e.retrieve("registered-at")||(e.store("registered-at","registered"),new Autocompleter.Contacts.At(e))}),c.addEvent("click",function(){var a=e.value.trim();if(!a||this.hasClass("disabled"))return;this.addClass("disabled"),app.requireLogin(function(){(new Request.JSON({url:"/pins/"+b+"/comments/",data:{text:a},onSuccess:function(c){function f(a){var b=app.renderSync("base/comment_item",a.comment),c=Elements.from(b).inject(d);c.highlight(),e.value=""}c.err&&c.err==412?(app.$form={pinId:b,text:a},app.requireCaptcha(f)):c.err?app.error(c.msg||app.COMMON_ERRMSG):f(c)},onFailure:function(){app.error(app.COMMON_ERRMSG)},onComplate:function(){c.removeClass("disabled")}})).post()})}),e.addEvents({keydown:function(a){if(a.key=="enter"&&(!Browser.Platform.mac&&a.control||Browser.Platform.mac&&a.meta))return c.fireEvent("click"),!1},keyup:function(){this.value?c.removeClass("disabled"):c.addClass("disabled")}}),a.store("initialized",!0)})()</script>')
		}
		return buf.join("")
	}, __t["base/comment_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"data-id": comment_id,
				"class": "comment"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(user.urlname) + "/",
				title: escape(user.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(user),
				"data-baiduimageplus-ignore": 1,
				"class": "avatar"
			})), buf.push("/></a><div"), buf.push(attrs({
				"class": "meta"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + user.urlname + "/",
				"class": "author"
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + "</a>&nbsp;-&nbsp;<span"), buf.push(attrs({
				"data-ts": "" + created_at + "",
				"class": "ts-words"
			})), buf.push(">" + escape((interp = Date.timeAgo(created_at)) == null ? "" : interp) + "</span>说：</div><div"), buf.push(attrs({
				"class": "text"
			})), buf.push(">");
			var __val__ = format_text(raw_text, locals.text_meta || null);
			buf.push(null == __val__ ? "" : __val__), buf.push("</div><div"), buf.push(attrs({
				"class": "action-buttons"
			})), buf.push("><a"), buf.push(attrs({
				"data-name": user.username,
				title: "回复",
				"class": "reply-button"
			})), buf.push("></a>"), this.req.user && (user_id === this.req.user.user_id || pin_user_id === this.req.user.user_id) && (buf.push("<a"), buf.push(attrs({
				"data-url": "/pins/" + pin_id + "/comments/" + comment_id + "/",
				title: "删除",
				"class": "delete"
			})), buf.push("></a>"));
			if(!this.req.user || user_id !== this.req.user.user_id) buf.push("<a"), buf.push(attrs({
				title: "举报",
				"class": "report-button"
			})), buf.push("></a>");
			buf.push("</div></div>")
		}
		return buf.join("")
	}, __t["base/comment_item_convo"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, _metas = typeof text_meta == "undefined" ? null : text_meta,
				_lm = 128 - user.username.len();
			buf.push("<div"), buf.push(attrs({
				"class": "comment convo clearfix"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(user.urlname) + "/",
				title: escape(user.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(user),
				"data-baiduimageplus-ignore": 1,
				"class": "avt"
			})), buf.push("/></a>"), isVerified(page.user) && (buf.push("<img"), buf.push(attrs({
				src: "/img/icon_v.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon"
			})), buf.push("/>")), buf.push("<div"), buf.push(attrs({
				"class": "content"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + user.urlname + "/",
				"class": "author"
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + "</a>:&nbsp;");
			var __val__ = format_text(raw_text.brief(_lm), _metas);
			buf.push(null == __val__ ? "" : __val__), buf.push("</div><a"), buf.push(attrs({
				title: "回复",
				"class": "replyButton"
			})), buf.push("></a></div>")
		}
		return buf.join("")
	}, __t["base/creation_success"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "form"
			})), buf.push("><div"), buf.push(attrs({
				"class": "creation-done"
			})), buf.push("><h3><div"), buf.push(attrs({
				"class": "common-message success"
			})), buf.push(">你已经成功上传, 待审核中</div></h3><div"), buf.push(attrs({
				id: "pin_operations",
				style: "margin-top:24px;"
			})), buf.push("><a"), buf.push(attrs({
				id: "continue_upload",
				href: "#"
			})), buf.push(">继续上传原创作品</a>|<a"), buf.push(attrs({
				id: "manage_creations",
				href: "/cc/center/"
			})), buf.push(">管理原创作品</a>|<a"), buf.push(attrs({
				id: "close_window",
				href: "#"
			})), buf.push('>关闭窗口</a></div></div></div><script>(function(){var a=$("CreationSuccess"),b=window.close;a&&(b=function(){app.hideDialog()}),$("close_window").addEvent("click",function(){return b(),!1}),$("continue_upload").addEvent("click",function(){return b(),app.showUploadDialog(),!1})})()</script>')
		}
		return buf.join("")
	}, __t["base/ctx_bar"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, site = ~filter.indexOf("site:") ? filter.substr(9) : null;
			filter = filter.split(":");
			if(site) buf.push("<div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				id: "ctx_bar",
				"class": "board"
			})), buf.push("><p>来自<a"), buf.push(attrs({
				href: "http://" + site + "",
				target: "_blank",
				rel: "nofollow"
			})), buf.push(">" + escape((interp = site) == null ? "" : interp) + "</a>的采集<form"), buf.push(attrs({
				id: "search_from_sites",
				action: _url,
				"class": "search-item"
			})), buf.push("><input"), buf.push(attrs({
				value: "" + (qt || "") + "",
				name: "q",
				placeholder: "搜索你喜欢的",
				"class": "clear-input"
			})), buf.push("/><a"), buf.push(attrs({
				onclick: "return false;",
				"class": "go"
			})), buf.push("></a></form></p></div>"), qt && (buf.push("<div"), buf.push(attrs({
				"class": "search-status"
			})), buf.push(">找到 " + escape((interp = qn) == null ? "" : interp) + " 个与<strong>" + escape((interp = qt) == null ? "" : interp) + "</strong>相关的结果 |<a"), buf.push(attrs({
				href: "/from/" + site + "/"
			})), buf.push(">返回所有采集</a></div>")), buf.push("</div>");
			else if(filter[1] == "popular") buf.push("<div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				id: "ctx_bar"
			})), buf.push("><div"), buf.push(attrs({
				"class": "p"
			})), buf.push(">热门" + escape((interp = filter[0] == "pin" ? "采集" : filter[0] === "board" ? "画板" : "") == null ? "" : interp) + "<ul"), buf.push(attrs({
				"class": "pin-board-switcher clearfix"
			})), buf.push("><li"), buf.push(attrs({
				"class": "first " + (filter[0] == "pin" ? "selected" : "")
			})), buf.push("><a"), buf.push(attrs({
				href: "/popular/",
				"class": "pin-link"
			})), buf.push(">采集</a></li><li"), buf.push(attrs({
				"class": filter[0] == "board" ? "selected" : ""
			})), buf.push("><a"), buf.push(attrs({
				href: "/boards/popular/"
			})), buf.push(">画板</a></li><li"), buf.push(attrs({
				"class": "last " + (filter[0] == "user" ? "selected" : "")
			})), buf.push("><a"), buf.push(attrs({
				href: "/users/popular/",
				"class": "user-link"
			})), buf.push(">推荐用户</a></li></ul><div"), buf.push(attrs({
				"class": "right"
			})), buf.push(">"), promotion && (buf.push("<a"), buf.push(attrs({
				href: "" + promotion.url + "",
				target: promotion.new_tab ? "_blank" : "_self",
				"class": "promotion"
			})), buf.push(">" + escape((interp = promotion.sub_title) == null ? "" : interp) + "</a>")), filter[0] == "user" && (buf.push("<a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "self-promote btn wbtn"
			})), buf.push("><strong> 推荐自己</strong><span></span></a>")), buf.push("</div></div></div></div>");
			else if(filter[2] == "all" && filter[1] == "category" && settings && settings.categories) {
				var cates = settings.categories.filter(function(e) {
					return e.display !== !1
				});
				buf.push("<div"), buf.push(attrs({
					"class": "wrapper"
				})), buf.push("><div"), buf.push(attrs({
					id: "category_guide"
				})), buf.push("><div"), buf.push(attrs({
					"class": "unit"
				})), buf.push(">");
				for(var i = 0; i < cates.length / 5; i++) buf.push("<a"), buf.push(attrs({
					href: cates[i].nav_link,
					rel: "nofollow",
					"data-id": cates[i].id,
					"class": "x"
				})), buf.push(">" + escape((interp = cates[i].name) == null ? "" : interp) + "</a>");
				buf.push("</div><div"), buf.push(attrs({
					"class": "unit"
				})), buf.push(">");
				for(var i = Math.floor(cates.length / 5) + 1; i < cates.length * 2 / 5; i++) buf.push("<a"), buf.push(attrs({
					href: cates[i].nav_link,
					rel: "nofollow",
					"data-id": cates[i].id,
					"class": "x"
				})), buf.push(">" + escape((interp = cates[i].name) == null ? "" : interp) + "</a>");
				buf.push("</div><div"), buf.push(attrs({
					"class": "unit"
				})), buf.push(">");
				for(var i = Math.floor(cates.length * 2 / 5) + 1; i < cates.length * 3 / 5; i++) buf.push("<a"), buf.push(attrs({
					href: cates[i].nav_link,
					rel: "nofollow",
					"data-id": cates[i].id,
					"class": "x"
				})), buf.push(">" + escape((interp = cates[i].name) == null ? "" : interp) + "</a>");
				buf.push("</div><div"), buf.push(attrs({
					"class": "unit"
				})), buf.push(">");
				for(var i = Math.floor(cates.length * 3 / 5) + 1; i < cates.length * 4 / 5; i++) buf.push("<a"), buf.push(attrs({
					href: cates[i].nav_link,
					rel: "nofollow",
					"data-id": cates[i].id,
					"class": "x"
				})), buf.push(">" + escape((interp = cates[i].name) == null ? "" : interp) + "</a>");
				buf.push("</div><div"), buf.push(attrs({
					"class": "unit last"
				})), buf.push(">");
				for(var i = Math.floor(cates.length * 4 / 5) + 1; i < cates.length; i++) buf.push("<a"), buf.push(attrs({
					href: cates[i].nav_link,
					rel: "nofollow",
					"data-id": cates[i].id,
					"class": "x"
				})), buf.push(">" + escape((interp = cates[i].name) == null ? "" : interp) + "</a>");
				buf.push("</div><div"), buf.push(attrs({
					"class": "clear"
				})), buf.push("></div></div></div>")
			} else if(filter[2] == "videos") {
				buf.push("<div"), buf.push(attrs({
					"class": "wrapper"
				})), buf.push("><div"), buf.push(attrs({
					id: "ctx_bar"
				})), buf.push("><div"), buf.push(attrs({
					"class": "p"
				})), buf.push(">");
				if(qt) {
					buf.push("<a"), buf.push(attrs({
						href: "/all/videos/"
					})), buf.push(">视频</a>&nbsp;»&nbsp;");
					var __val__ = qt;
					buf.push(null == __val__ ? "" : __val__)
				} else buf.push("视频");
				buf.push("<div"), buf.push(attrs({
					"class": "right"
				})), buf.push("><form"), buf.push(attrs({
					id: "search_from_category",
					action: _url,
					"class": "search-item"
				})), buf.push("><input"), buf.push(attrs({
					value: "" + (qt || "") + "",
					name: "q",
					placeholder: "搜索你喜欢的",
					"class": "clear-input"
				})), buf.push("/><a"), buf.push(attrs({
					onclick: "return false;",
					"class": "go"
				})), buf.push("></a></form></div></div></div></div>")
			} else if(filter[1] == "category") {
				buf.push("<div"), buf.push(attrs({
					id: "category_nav_bar"
				})), buf.push("><div"), buf.push(attrs({
					"class": "wrapper"
				})), buf.push(">");
				var title = filter[2];
				buf.push("<div"), buf.push(attrs({
					"class": "title " + ("" + title + "")
				})), buf.push("></div><div"), buf.push(attrs({
					"class": "navs"
				})), buf.push("><a"), buf.push(attrs({
					"data-type": "pin",
					"data-id": filter[2],
					href: "/favorite/" + filter[2] + "/" + (qt ? "?q=" + qt : ""),
					"class": "x " + (filter[0] == "pin" ? "selected" : "")
				})), buf.push(">采集</a><a"), buf.push(attrs({
					"data-type": "board",
					"data-id": filter[2],
					href: "/boards/favorite/" + filter[2] + "/" + (qt ? "?q=" + qt : "") + "",
					"class": "x " + (filter[0] == "board" ? "selected" : "")
				})), buf.push(">推荐画板</a><a"), buf.push(attrs({
					"data-type": "user",
					"data-id": filter[2],
					href: "/users/favorite/" + filter[2] + "/",
					"class": filter[0] == "user" ? "selected" : ""
				})), buf.push(">推荐用户</a>");
				if(locals.suggests && suggests.navigations)
					for(var $index = 0, $$l = suggests.navigations.length; $index < $$l; $index++) {
						var n = suggests.navigations[$index];
						buf.push("<a"), buf.push(attrs({
							href: "" + n.url + "",
							target: "_blank"
						})), buf.push(">" + escape((interp = n.name) == null ? "" : interp) + "</a>")
					}
				buf.push('</div></div><script>(function(){var a=document.id("category_nav_bar").getElement(".navs a.selected"),b=a.get("data-id"),c=a.get("data-type");try{_czc.push(["_trackEvent","category_for_"+b,c,"click",1])}catch(d){}try{_czc.push(["_trackEvent","category_single",c,"click",1])}catch(d){}})()</script></div>')
			}
			buf.push('<script>(function(){app.initSearchForms("#search_from_sites, #search_from_category"),app.gaqTrackPromotion("#ctx_bar .right a.promotion",{category:"ctx_bar-promotions",useTargetUrlAsLabel:!0})})(),function(){var a=document.id("category_guide");if(!a)return;a.getElements(".unit a").each(function(a){app.cnzzTrackEvent(a,{category:"category_all",label:a.get("data-id")})})}(),function(){var a=document.getElement("#category_nav_bar .filter-button");if(!a)return;var b=a.getElement(".menu");new MenuController({menu:b,trigger:a}),b.addEvents({menu_show:function(){a.addClass("active")},menu_hide:function(){a.removeClass("active")}})}(),function(){var a=document.id("category_nav_bar");if(!a)return;if(!app.req.user)return a.addClass("unauth");var b="https://hbfile.b0.upaiyun.com/img/category_backgrounds/",c=["anime","apparel","architecture","art","beauty","cars_motorcycles","collocation","data_presentation","default","design","desire","diy_crafts","education","film_music_books","fitness","food_drink","funny","games","geek","home","illustration","industrial_design","kids","men","modeling_hair","other","people","pets","photography","quotes","sports","tips","travel_places","web_app_icon","wedding_events"],d="' + escape((interp = filter[2]) == null ? "" : interp) + '",e=b+(~c.indexOf(d)?d:"default")+".jpg"}()</script>')
		}
		return buf.join("")
	}, __t["base/design_copyright_register"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "unauth_callout",
				style: "display: none;",
				"class": "designer has-close"
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				id: "intro",
				"class": "sheet"
			})), buf.push("><h2>立即成为花瓣网认证设计师，赢得更多赞誉。</h2><p>欢迎参与花瓣网的原创版权计划，上传您的原创作品。</p><a"), buf.push(attrs({
				href: "/cc/register/",
				"class": "btn btn18 register"
			})), buf.push(">登记认证</a><a"), buf.push(attrs({
				id: "notdesigner",
				"class": "btn btn18"
			})), buf.push('>我不是设计师</a></div></div></div><script>(function(){document.id("unauth_callout").removeClass("has-close").show(),document.id("notdesigner").addEvent("click",function(){(new Request.JSON({url:"/cc/notdesigner/",onComplete:function(a){document.id("unauth_callout").setStyle("display","none")}})).post()})})()</script>')
		}
		return buf.join("")
	}, __t["base/dm_dialog_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			if(locals.system_dm_id) {
				buf.push("<div"), buf.push(attrs({
					"class": "system-message"
				})), buf.push("><div"), buf.push(attrs({
					"class": "text"
				})), buf.push(">");
				var __val__ = text.replace(/<img/g, "<img data-baiduimageplus-ignore");
				buf.push(null == __val__ ? "" : __val__), buf.push("</div><div"), buf.push(attrs({
					"data-ts": "" + created_at + "",
					"class": "time ts-words"
				})), buf.push(">");
				var __val__ = "管理员发送于 " + Date.timeAgo(created_at);
				buf.push(null == __val__ ? "" : __val__), buf.push("</div></div>")
			} else {
				buf.push("<div"), buf.push(attrs({
					"data-dm-id": locals.direct_message_id ? direct_message_id : "",
					"data-ts": created_at,
					"class": "message clearfix " + type
				})), buf.push(">");
				if(showTS) {
					buf.push("<div"), buf.push(attrs({
						"class": "ms-time"
					})), buf.push("><div"), buf.push(attrs({
						"class": "ms-time-text"
					})), buf.push(">");
					var __val__ = Date.formatMoment(created_at);
					buf.push(null == __val__ ? "" : __val__), buf.push("</div></div>")
				}
				buf.push("<a"), buf.push(attrs({
					href: "/" + from_user.urlname + "/"
				})), buf.push("><img"), buf.push(attrs({
					src: avatar(from_user),
					"class": "avt"
				})), buf.push("/></a><div"), buf.push(attrs({
					"class": "text"
				})), buf.push(">");
				var __val__ = text.nl2br();
				buf.push(null == __val__ ? "" : __val__), type == "received" && (buf.push("<div"), buf.push(attrs({
					title: "举报",
					"class": "report"
				})), buf.push("></div>")), buf.push("<svg"), buf.push(attrs({
					"class": "triangle"
				})), buf.push("><polygon"), buf.push(attrs({
					points: "0 0, 10 0, 10 10"
				})), buf.push("></polygon></svg></div></div>")
			}
		}
		return buf.join("")
	}, __t["base/dm_list_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			if(locals.system_dm_id) {
				buf.push("<div"), buf.push(attrs({
					"data-with-user-id": "system",
					"data-with-user-name": "系统通知",
					"data-updated-at": created_at,
					"class": "conversation system-dm-conversation " + (locals.unread ? "unread" : "")
				})), buf.push("><a"), buf.push(attrs({
					"class": "avt"
				})), buf.push("></a><div"), buf.push(attrs({
					"class": "title"
				})), buf.push("><span"), buf.push(attrs({
					"class": "name"
				})), buf.push(">系统通知</span><i"), buf.push(attrs({
					"class": "admin-icon"
				})), buf.push("></i><span"), buf.push(attrs({
					"data-ts": "" + created_at + "",
					"class": "ts-words time"
				})), buf.push(">");
				var __val__ = Date.timeAgo(created_at);
				buf.push(null == __val__ ? "" : __val__), buf.push("</span></div><div"), buf.push(attrs({
					"class": "content"
				})), buf.push(">" + escape((interp = locals.text ? locals.text.replace(/(<([^>]+)>)/ig, "") : "") == null ? "" : interp) + "</div><i"), buf.push(attrs({
					"class": "arrow"
				})), buf.push("></i></div>")
			} else {
				buf.push("<div"), buf.push(attrs({
					"data-with-user-id": with_user_id,
					"data-with-user-name": with_user.username,
					"data-updated-at": updated_at,
					"class": "conversation " + (locals.unread ? "unread" : "")
				})), buf.push("><a"), buf.push(attrs({
					href: "/" + with_user.urlname + "/",
					"class": "avt"
				})), buf.push("><img"), buf.push(attrs({
					src: avatar(with_user)
				})), buf.push("/></a><div"), buf.push(attrs({
					"class": "title"
				})), buf.push("><span"), buf.push(attrs({
					"class": "name"
				})), buf.push(">" + escape((interp = with_user.username) == null ? "" : interp) + "</span><span"), buf.push(attrs({
					"data-ts": "" + updated_at + "",
					"class": "ts-words time"
				})), buf.push(">");
				var __val__ = Date.timeAgo(updated_at);
				buf.push(null == __val__ ? "" : __val__), buf.push("</span><div"), buf.push(attrs({
					"class": "action"
				})), buf.push("><div"), buf.push(attrs({
					"class": "open"
				})), buf.push("></div><ul><li"), buf.push(attrs({
					"class": "block"
				})), buf.push(">屏蔽此人</li></ul></div></div><div"), buf.push(attrs({
					"class": "content"
				})), buf.push(">" + escape((interp = locals.last_message ? last_message.text : "") == null ? "" : interp) + "</div><i"), buf.push(attrs({
					"class": "arrow"
				})), buf.push("></i></div>")
			}
		}
		return buf.join("")
	}, __t["base/explore_board"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, exploreUrl = "/explore/" + explore.urlname + "/";
			buf.push("<div"), buf.push(attrs({
				"class": "explore-board wfc"
			})), buf.push("><div"), buf.push(attrs({
				"class": "actions"
			})), buf.push("><div"), buf.push(attrs({
				"class": "right"
			})), buf.push(">"), explore && explore.following ? (buf.push("<a"), buf.push(attrs({
				"data-urlname": "" + explore.urlname + "",
				href: "#",
				"class": "follow-explore unfollow-explore btn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push(">取消关注</span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-urlname": "" + explore.urlname + "",
				href: "#",
				"class": "follow-explore btn rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push(">关注</span></a>")), buf.push("</div></div><a"), buf.push(attrs({
				href: "" + exploreUrl + "",
				rel: "nofollow",
				"class": "link x"
			})), buf.push(">");
			if(explore.theme) var themeColor = explore.theme.hexToRgb(!0).join();
			else var themeColor = "120,120,120";
			buf.push("<div"), buf.push(attrs({
				style: "-webkit-box-shadow:inset 0 -140px 20px -20px rgba(" + themeColor + ",.8);-moz-box-shadow:inset 0 -140px 20px -20px rgba(" + themeColor + ",.8);box-shadow:inset 0 -140px 20px -20px rgba(" + themeColor + ",.8)",
				"class": "board-shadow"
			})), buf.push("></div><img"), buf.push(attrs({
				width: "236",
				src: imgURL(explore.cover, "fw236"),
				"data-baiduimageplus-ignore": 1
			})), buf.push("/><div"), buf.push(attrs({
				"class": "cover"
			})), buf.push("><div"), buf.push(attrs({
				"class": "smalls"
			})), buf.push(">");
			var num = explore.top_three ? explore.top_three.length : 0;
			for(var i = 0; i < num; i++) explore.top_three[i] && (buf.push("<img"), buf.push(attrs({
				src: imgURL(explore.top_three[i].file, "sq75"),
				"data-baiduimageplus-ignore": 1,
				"class": "small"
			})), buf.push("/>"));
			buf.push("</div><div"), buf.push(attrs({
				"class": "board-title with-line"
			})), buf.push(">");
			var __val__ = explore.name;
			buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</div></div></a></div>")
		}
		return buf.join("")
	}, __t["base/favorites_callout"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "favorites_callout",
				style: "display: none;",
				"class": "has-close"
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				"class": "intro sheet"
			})), buf.push(">");
			var from = "好123";
			app.req.from_123_360 == "360" ? from = "360安全网址" : app.req.from_123_360 == "tao123" ? from = "淘网址" : app.req.from_123_360 == "sogou" ? from = "搜狗网址导航" : app.req.from_123_360 == "qq" && (from = "QQ相册"), buf.push("<span"), buf.push(attrs({
				"class": "hi"
			})), buf.push(">hi，欢迎你从 " + escape((interp = from) == null ? "" : interp) + " 来到花瓣</span><span"), buf.push(attrs({
				"class": "favorite-notice"
			})), buf.push(">如果你喜欢这里，请把花瓣网添加到你的网页收藏夹吧，不担心以后找不到了。</span>"), Browser.Platform.mac ? (buf.push("<div"), buf.push(attrs({
				id: "command_d"
			})), buf.push("><span>把花瓣网加到你的浏览器收藏夹里</span></div>")) : (buf.push("<div"), buf.push(attrs({
				id: "ctrl_d"
			})), buf.push("><span>把花瓣网加到你的浏览器收藏夹里</span></div>")), buf.push("<a"), buf.push(attrs({
				"class": "close"
			})), buf.push('></a></div></div></div><script>(function(){Cookie.read("_hbfavorites")||(document.id("favorites_callout").removeClass("has-close").show(),(new Request.JSON({url:"/favorite_counter/show"})).post()),$$(".close").addEvent("click",function(){Cookie.read("_hbfavoritesed")?Cookie.write("_hbfavorites",!0,{duration:365}):(Cookie.write("_hbfavorites",!0,{duration:1}),Cookie.write("_hbfavoritesed",!0,{duration:365})),document.id("favorites_callout").hide(),(new Request.JSON({url:"/favorite_counter/close"})).post()}),document.addEvent("keydown",function(a){return a.code==68&&(a.meta||a.control)&&(Cookie.write("_hbfavorites",!0,{duration:365}),document.id("favorites_callout").hide(),(new Request.JSON({url:"/favorite_counter/fav"})).post()),!0})})()</script>')
		}
		return buf.join("")
	}, __t["base/floating_notice"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, main_id = Math.floor(1e6 * Math.random());
			buf.push("<div"), buf.push(attrs({
				id: "uniq_" + main_id + "",
				"class": "floating-notice"
			})), buf.push("><i"), buf.push(attrs({
				"class": "icon-" + locals.type + ""
			})), buf.push("></i>");
			var __val__ = locals.text;
			buf.push(null == __val__ ? "" : __val__), buf.push('</div><script>(function(){var a=document.id("uniq_' + escape((interp = main_id) == null ? "" : interp) + '");a.setStyle("margin-left",-Math.floor(a.getSize().x/2)).fade("show");var b=app.view.getElements(".dialog-boxes>div");b.length&&b.getStyle("display").some(function(a){return a=="block"})||!document.id("header")||document.id("pin_view_layer")?a.setStyle("top",0):a.setStyle("top","");var c=Number("' + escape((interp = locals.timeout) == null ? "" : interp) + '");c&&setTimeout(function(){a.fadeAndDestroy()},c)})()</script>')
		}
		return buf.join("")
	}, __t["base/footer"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "index_footer"
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper wrapper-996"
			})), buf.push("><div"), buf.push(attrs({
				"class": "column"
			})), buf.push("><a"), buf.push(attrs({
				href: "/",
				"class": "title"
			})), buf.push(">花瓣首页</a><a"), buf.push(attrs({
				href: "/about/goodies/",
				rel: "nofollow"
			})), buf.push(">花瓣采集工具</a><a"), buf.push(attrs({
				href: "http://blog.huaban.com/"
			})), buf.push(">花瓣官方博客</a></div><div"), buf.push(attrs({
				"class": "column"
			})), buf.push("><a"), buf.push(attrs({
				"class": "title"
			})), buf.push(">联系与合作</a><a"), buf.push(attrs({
				href: "/about/contact/",
				rel: "nofollow"
			})), buf.push(">联系我们</a><a"), buf.push(attrs({
				href: "/pins/53553/",
				rel: "nofollow"
			})), buf.push(">用户反馈</a><a"), buf.push(attrs({
				href: "/about/brand/",
				rel: "nofollow"
			})), buf.push(">花瓣 LOGO 标准文档</a></div><div"), buf.push(attrs({
				"class": "column"
			})), buf.push("><a"), buf.push(attrs({
				"class": "title"
			})), buf.push(">移动客户端</a><a"), buf.push(attrs({
				href: "/apps/#iphone",
				rel: "nofollow"
			})), buf.push(">花瓣 iPhone 版</a><a"), buf.push(attrs({
				href: "/apps/#android",
				rel: "nofollow"
			})), buf.push(">花瓣 Android 版</a><a"), buf.push(attrs({
				href: "/apps/#ipad",
				rel: "nofollow"
			})), buf.push(">花瓣 HD</a></div><div"), buf.push(attrs({
				"class": "column follow-us"
			})), buf.push("><a"), buf.push(attrs({
				"class": "title"
			})), buf.push(">关注我们</a><a"), buf.push(attrs({
				href: "http://weibo.com/huabanwang",
				target: "_blank",
				rel: "nofollow"
			})), buf.push(">新浪微博：@花瓣网</a><a>官方 QQ：188126952</a><a"), buf.push(attrs({
				"class": "weixin"
			})), buf.push(">官方微信：<img"), buf.push(attrs({
				src: "/img/about/about_footer_code.png",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/><img"), buf.push(attrs({
				src: "/img/about/weixin_huaban.png",
				"data-baiduimageplus-ignore": 1,
				"class": "code"
			})), buf.push("/></a></div></div><div"), buf.push(attrs({
				"class": "wrapper wrapper-996 bottom"
			})), buf.push(">&copy; Huaban 杭州纬聚网络有限公司 &nbsp;&nbsp;<span"), buf.push(attrs({
				"class": "divider"
			})), buf.push(">|</span>&nbsp;&nbsp;<a"), buf.push(attrs({
				target: "_blank",
				href: "http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=33010602001878"
			})), buf.push(">浙公网安备 33010602001878号</a></div></div>")
		}
		return buf.join("")
	}, __t["base/gift_features_rss"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<h3>");
			var __val__ = feature.description;
			buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</h3>");
			for(var $index = 0, $$l = feature.feature_items.length; $index < $$l; $index++) {
				var item = feature.feature_items[$index];
				buf.push("<p"), buf.push(attrs({
					style: "text-align: center;"
				})), buf.push(">");
				var link = item && item.data && item.data.link && item.data.link.link,
					target = item && item.data && item.data.link && item.data.link.type || "_blank";
				link = item.pin ? "http://" + host + "/pins/" + item.pin.pin_id + "/" : link, target = item.pin ? "_blank" : target;
				var description = item && item.data && item.data.description || item && item.pin && item.pin.raw_text || "";
				buf.push("<a"), buf.push(attrs({
					href: "" + link + "",
					target: "" + target + "",
					"class": "img"
				})), buf.push(">");
				if(item && item.pin && item.pin.file) {
					var __val__ = img(item.pin.file, "sq490", {
						alt: description
					}, "sq490");
					buf.push(null == __val__ ? "" : __val__)
				}
				buf.push("</a></p>");
				if(item.data && item.data.title) {
					buf.push("<p"), buf.push(attrs({
						style: "text-align: center;"
					})), buf.push(">");
					var __val__ = item.data.title;
					buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</p>")
				}
				if(item.data && item.data.description) {
					buf.push("<p"), buf.push(attrs({
						style: "text-align: center;"
					})), buf.push(">");
					var __val__ = item.data.description;
					buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</p>")
				}
				buf.push("<p"), buf.push(attrs({
					style: "text-align: center;"
				})), buf.push(">售价:" + escape((interp = item.price) == null ? "" : interp) + "元</p>")
			}
		}
		return buf.join("")
	}, __t["base/go"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__), buf.push("<div"), buf.push(attrs({
				id: "go_notifier",
				"data-link": page.link
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				"class": "title"
			})), buf.push(">您即将离开花瓣，跳转至其它页面</div><img"), buf.push(attrs({
				src: "/img/pink_pic.png",
				height: 178,
				"data-baiduimageplus-ignore": 1,
				"class": "main-img"
			})), buf.push("/><div"), buf.push(attrs({
				"class": "sub"
			})), buf.push("><span>3</span>秒后自动跳转</div><a"), buf.push(attrs({
				href: page.link,
				"class": "go btn btn18"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push('> 立刻前往</span></a></div></div><style>html { background: white; }\n.wrapper { width: 992px; }\n#unauth_callout { display: none; }</style><script>(function(){var a=document.id("go_notifier").get("data-link"),b=document.getElement("#go_notifier .sub span");if(!a)return;var c=null,d=function(){c=setTimeout(function(){b.innerHTML--,b.innerHTML==0?location.href=a:d()},1e3)},e=function(){c&&clearTimeout(c)};d(),document.getElement("#go_notifier .go").addEvent("click",e)})()</script>')
		}
		return buf.join("")
	}, __t["base/google"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": className
			})), buf.push("><div"), buf.push(attrs({
				"class": "pro-google"
			})), buf.push("><ins"), buf.push(attrs({
				style: "display:inline-block;width:" + width + "px;height:" + height + "px",
				"data-ad-client": "ca-pub-7707046226396289",
				"data-ad-slot": "" + slot + "",
				"class": "adsbygoogle"
			})), buf.push('></ins><script>Asset.javascript("//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js",{onLoad:function(){(adsbygoogle=window.adsbygoogle||[]).push({})}})</script></div></div>')
		}
		return buf.join("")
	}, __t["base/header"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, ads = page.ads || {
				fixedAds: [],
				normalAds: []
			};
			if("function" != typeof ads.getAd) {
				ads.normalAds = ads.normalAds.map(function(e, t) {
					var n = t * 10,
						r = n + 9,
						i = Math.floor(Math.random() * (r - n + 1) + n);
					return e.position = i, e
				}), ads = ads.fixedAds.concat(ads.normalAds);
				var MAX_INDEX = 10 * ads.length,
					onlyOne = page.$url.split("?")[0].match("/search/") || req.user && page.$url.split("?")[0] === "/";
				onlyONe = !0, page.ads = {
					currentIndex: 0,
					ads: ads,
					getAd: function() {
						var e = this,
							t = e.ads.filter(function(t) {
								if(e.currentIndex === 0) return !0;
								if(!onlyOne && e.currentIndex / 20 > 1) return t.position === e.currentIndex % 20
							});
						return ++e.currentIndex, t
					}
				}
			}
			var show_designer_regform = !1,
				url = page.$url.split("?")[0];
			url.match("/cc/") && !url.match("/cc/register/") && !url.match("/cc/center/") && (req.user && req.user.status && req.user.status.notdesigner ? show_designer_regform = !1 : req.user && req.user.status && !req.user.status.designer && (show_designer_regform = !0)), show_designer_regform = !1, isIndexPage = !req.user && url === "/" ? !0 : !1;
			if(req.promotions && req.promotions.top && req.promotions.top.length) {
				buf.push("<div"), buf.push(attrs({
					id: "top_promotion",
					style: "display: none"
				})), buf.push(">");
				for(var $index = 0, $$l = req.promotions.top.length; $index < $$l; $index++) {
					var promo = req.promotions.top[$index],
						image_url = "//" + this.settings.hbfile[promo.image.bucket] + "/img/promotion/" + promo.image.key;
					buf.push("<a"), buf.push(attrs({
						href: promo.url,
						target: promo.new_tab ? "_blank" : "_self",
						"data-ad-title": "" + promo.title + "",
						"data-ad-name": "_tp-" + promo.image.key + "",
						style: "background-image: url(" + image_url + "); display: none; height: " + promo.image.height + "px;",
						rel: "nofollow",
						"class": "inner"
					})), buf.push("></a>")
				}
				buf.push("<div"), buf.push(attrs({
					"class": "close"
				})), buf.push('></div><script>(function(){var a=document.id("top_promotion"),b=a.getElements(".inner"),c=a.getElement(".close"),d=null;b=b.filter(function(a){var b=a.get("data-ad-name");return!Cookie.read(b)}),b.length&&(d=b.getRandom().show(),a.show(),app.cnzzTrackExposition({category:"ads",label:"top_"+d.get("data-ad-title")})),c.addEvent("click",function(){a.fade("out").get("tween").chain(function(){a.hide()}),d&&Cookie.write(d.get("data-ad-name"),1,{duration:.5})})})()</script></div>')
			}
			buf.push("<div"), buf.push(attrs({
				id: "header",
				"class": isIndexPage ? "nologin-index hts" : ""
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				"class": "menu-bar"
			})), buf.push("><div"), buf.push(attrs({
				"class": "left-part"
			})), buf.push("><a"), buf.push(attrs({
				id: "huaban",
				href: "/"
			})), buf.push("></a>"), req.user && (buf.push("<a"), buf.push(attrs({
				href: "/",
				"data-title": "home",
				"class": "header-item " + (url === "/" ? "active" : "")
			})), buf.push(">首页</a>")), buf.push("<a"), buf.push(attrs({
				href: "/discovery/",
				"class": "header-item " + (url === "/discovery/" || url === "/" && !req.user ? "active" : "")
			})), buf.push(">发现</a><a"), buf.push(attrs({
				href: "/all/",
				"class": "header-item " + (url === "/all/" ? "active" : "")
			})), buf.push(">最新</a><a"), buf.push(attrs({
				href: "https://muse.huaban.com/",
				"class": "header-item meisi"
			})), buf.push(">美思<i"), buf.push(attrs({
				"class": "muse entrance"
			})), buf.push("></i></a><div"), buf.push(attrs({
				"class": "menu-nav"
			})), buf.push(">");
			var __val__ = emerge("base/header_main_menu", {
				settings: settings,
				req: req
			});
			buf.push(null == __val__ ? "" : __val__), buf.push("</div></div><div"), buf.push(attrs({
				"class": "right-part"
			})), buf.push("><a"), buf.push(attrs({
				style: "display: none",
				href: "#",
				onclick: "return false;",
				"class": "go-mobile btn rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 访问移动版</span></a>");
			if(req.user) {
				buf.push("<div"), buf.push(attrs({
					"class": "message-nav"
				})), buf.push("><a"), buf.push(attrs({
					title: "通知",
					"class": "nav-link"
				})), buf.push("><div"), buf.push(attrs({
					"class": "nav-icon"
				})), buf.push("></div><div"), buf.push(attrs({
					"class": "num hidden"
				})), buf.push(">0</div></a>");
				var __val__ = emerge("base/message_popup");
				buf.push(null == __val__ ? "" : __val__), buf.push("</div>")
			} else buf.push("<div"), buf.push(attrs({
				"class": "login-nav"
			})), buf.push("><a"), buf.push(attrs({
				href: "/signup/",
				onclick: "app.requireLogin();return false;",
				rel: "nofollow",
				"class": "register btn rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 注册</span></a><a"), buf.push(attrs({
				onclick: "app.requireLogin('', {to: 'login'});return false;",
				rel: "nofollow",
				href: "#",
				"class": "login btn wbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 登录</span></a></div>");
			req.user && (buf.push("<div"), buf.push(attrs({
				id: "nav_user"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + req.user.urlname + "/",
				"class": "nav-link dm-nav"
			})), buf.push("><img"), buf.push(attrs({
				width: 26,
				height: 26,
				src: avatar(req.user),
				"class": "avt"
			})), buf.push("/><div"), buf.push(attrs({
				"class": "arrow"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "num hidden"
			})), buf.push(">0</div></a><div"), buf.push(attrs({
				"class": "menu"
			})), buf.push("><div"), buf.push(attrs({
				"class": "group"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + req.user.urlname + "/"
			})), buf.push(">我的花瓣<i"), buf.push(attrs({
				"class": "mine"
			})), buf.push("></i></a><a"), buf.push(attrs({
				title: "私信",
				onclick: "app.page.dmController.openFreshList();",
				"class": "dm-nav"
			})), buf.push(">私信<i"), buf.push(attrs({
				"class": "messages"
			})), buf.push("></i><div"), buf.push(attrs({
				"class": "num in-line hidden"
			})), buf.push(">0</div></a><a"), buf.push(attrs({
				href: "/" + req.user.urlname + "/following/"
			})), buf.push(">我的关注<i"), buf.push(attrs({
				"class": "following"
			})), buf.push("></i></a></div><div"), buf.push(attrs({
				"class": "group"
			})), buf.push("><a"), buf.push(attrs({
				href: "/friends/weibo/"
			})), buf.push(">查找好友<i"), buf.push(attrs({
				"class": "friends"
			})), buf.push("></i></a></div><div"), buf.push(attrs({
				"class": "group"
			})), buf.push("><a"), buf.push(attrs({
				href: "/muse/register/"
			})), buf.push(">花瓣认证设计师<i"), buf.push(attrs({
				"class": "verified"
			})), buf.push("></i><label"), buf.push(attrs({
				"class": "new icon"
			})), buf.push("></label></a></div><div"), buf.push(attrs({
				"class": "group"
			})), buf.push("><a"), buf.push(attrs({
				href: "/settings/"
			})), buf.push(">帐号设置<i"), buf.push(attrs({
				"class": "settings"
			})), buf.push("></i></a><a"), buf.push(attrs({
				href: "/logout/"
			})), buf.push(">退出<i"), buf.push(attrs({
				"class": "exit"
			})), buf.push("></i></a></div></div></div>")), buf.push("</div><form"), buf.push(attrs({
				id: "search_form",
				method: "get",
				action: page.query && page.query.type ? url : "/search/",
				"class": "searching-unit"
			})), buf.push("><input"), buf.push(attrs({
				id: "query",
				type: "text",
				size: "27",
				name: "q",
				autocomplete: "off",
				placeholder: "搜索你喜欢的",
				value: page.query ? _(page.query.text) : ""
			})), buf.push("/><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "go"
			})), buf.push("></a></form></div></div></div>");
			if(req.from_123_360) {
				var __val__ = emerge("base/favorites_callout");
				buf.push(null == __val__ ? "" : __val__)
			} else if(!req.user && url !== "/") {
				var __val__ = emerge("base/unauth_callout");
				buf.push(null == __val__ ? "" : __val__)
			} else if(req.user && req.user.status.sts && 0) {
				var __val__ = emerge("base/user_fix_callout");
				buf.push(null == __val__ ? "" : __val__)
			} else if(show_designer_regform) {
				var __val__ = emerge("base/design_copyright_register");
				buf.push(null == __val__ ? "" : __val__)
			} else {
				var __val__ = emerge("base/chrome_callout");
				buf.push(null == __val__ ? "" : __val__)
			}
			var __val__ = emerge("base/header_side_menu", {
				settings: settings,
				req: req,
				page: page
			});
			buf.push(null == __val__ ? "" : __val__), buf.push('<script>(function(){var a=document.id("header"),b=a.getElement(".left-part a[data-title=home]");b&&app.cnzzTrackEvent(b,{category:"jump_home",label:"home"}),app.cnzzTrackEvent("#huaban",{category:"jump_logo",label:"huaban_logo"})})()</script><script>window.addEvent("domready",function(){var a=!app.req.user&&app.page.$url.split("?")[0]==="/"?!0:!1,b=a?200:0;app.page.$header=(new FixedHeader("header",{scrollOffset:b})).attach();var c=document.id("header");app.page.$header.addEvent("pin",function(){a&&c.removeClass("nologin-index"),document.getElements(".search-hint").each(function(a){var b=a&&a.getChildren();b&&b.length&&b.destroy()})}),app.page.$header.addEvent("unpin",function(){a&&c.addClass("nologin-index")});var d=document.getElement("#unauth_callout .floating");d&&app.page.$header.addEvent("tick",function(a){d.setStyle("left",-a.x+"px")}),a||document.id("page").addClass("page-with-header");var e=document.id("nav_user"),f=e?e.getElement(".menu"):null,g=document.getElement("#header .header-main-menu"),h=g.getParent(".menu-nav"),i=document.getElement("#header_side_menu .menu.more-links"),j=document.getElement("#header_side_menu .nav.more"),k=document.getElement("#header_side_menu .menu.info-links"),l=document.getElement("#header_side_menu .nav.info"),m=document.getElement(".menu-bar .add-nav"),n=m?m.getElement(".menu"):null;k.addEvent("menu_show",function(){i.hide()}),i.addEvent("menu_show",function(){k.hide()}),f&&f.addEvent("menu_show",function(){var a=document.id("message_popup");a&&a.getStyle("display")=="block"&&this.hide()}),g.addEvent("menu_show",function(){Cookie.write("_hmt",1,{duration:30}),app.blinkMenuButton("stop")}),h.addEvent("click",function(){g.show()}),e&&new MenuController({menu:f,trigger:e}),new MenuController({menu:g,trigger:h,showupDelay:200}),new MenuController({menu:i,trigger:j}),new MenuController({menu:k,trigger:l}),m&&(m.addEvent("click",function(){n.show()}),app.view.addEvent("click",function(a){a.target.getParent(".add-nav")||n.hide()}));var o=new SmoothNotification({styles:{"border-radius":"3px","line-height":"1","white-space":"nowrap",padding:"10px"},container:"#header_side_menu"}),p=document.getElements("#header_side_menu .nav a[data-title]");p.addEvents({mouseenter:function(){document.getElements("#header_side_menu .menu").hide(),o.show(this.get("data-title"),{relative:{to:this,position:"rightcenter",edge:"leftcenter",offset:{x:10,y:0}},duration:!1,arrow:"left",fadeType:"right"})},mouseleave:function(){o.hide()}}),app.switchHeaderTo=function(a){if(!a)return;a=="side"?(app.view.addClass("menu-bar-at-side"),$$(".header-item").hide()):a=="normal"&&(app.view.removeClass("menu-bar-at-side"),$$(".header-item").show()),d&&d.toggleClass("side-menu"),window.fireEvent("resize"),Cookie.write("_ht",a[0],{duration:30})},Cookie.read("_ht")=="s"&&!Browser.ie6&&app.switchHeaderTo("side")})</script>'), req.user && req.user.status && req.user.status.wc && !page.isQplus && (buf.push("<div"), buf.push(attrs({
				id: "newbies_welcome_overlay",
				style: "display: none;",
				"class": "phide overlay"
			})), buf.push('></div><script>(function(){app.render("newbies_welcome_overlay",function(a,b){$("newbies_welcome_overlay").set("html",b),a&&Browser.exec(a)})})()</script>')), req.user && buf.push('<script>app.renderDialogBox("dm",!0)</script>'), buf.push('<script>app.initSearchForms(".searching-unit"),app.gaqTrackPromotion("#top_promotion a",{category:"top_promotion",useTargetUrlAsLabel:!0}),app.gaqTrackEvent(".category-link, .top-module .app-link, .top-module .pin-link",{category:"main_menu_links",useTargetUrlAsLabel:!0}),app.cnzzTrackEvent("#top_promotion a",{category:"ads",label:"top"}),function(){var a=document.getElement(".menu-bar .go-mobile");Browser.isMobile&&a.show("inline-block"),a.addEvent("touchstart",function(){this.hide(),Cookie.dispose("_nmb"),location.reload()})}()</script>')
		}
		return buf.join("")
	}, __t["base/header_main_menu"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, categories = settings.categories,
				groups = [];
			for(var i = 0, l = categories.length; i < l; i++) {
				var category = categories[i];
				category.nav_link = "/favorite/" + category.id + "/";
				if(category.display === !1 || !category.col) continue;
				groups[category.col] = groups[category.col] || [], groups[category.col].push(category)
			}
			buf.push("<div"), buf.push(attrs({
				"class": "header-main-menu"
			})), buf.push("><div"), buf.push(attrs({
				"class": "top-module"
			})), buf.push("><a"), buf.push(attrs({
				href: "/apps/",
				rel: "nofollow",
				"class": "text app-link"
			})), buf.push(">移动应用</a><a"), buf.push(attrs({
				href: "/about/goodies/",
				rel: "nofollow",
				"class": "text app-link"
			})), buf.push(">采集工具</a><a"), buf.push(attrs({
				href: "/iwantyou/",
				rel: "nofollow",
				"class": "text pin-link"
			})), buf.push(">招聘</a></div><div"), buf.push(attrs({
				id: "category_more",
				"class": "middle-module clearfix"
			})), buf.push("><div"), buf.push(attrs({
				"class": "col-1 col"
			})), buf.push(">");
			for(var $index = 0, $$l = groups[1].length; $index < $$l; $index++) {
				var cat = groups[1][$index];
				buf.push("<a"), buf.push(attrs({
					href: cat.nav_link,
					rel: "nofollow",
					"data-id": cat.id,
					"class": "category-link"
				})), buf.push(">" + escape((interp = cat.name) == null ? "" : interp) + "</a>")
			}
			buf.push("</div><div"), buf.push(attrs({
				"class": "col-2 col"
			})), buf.push(">");
			for(var $index = 0, $$l = groups[2].length; $index < $$l; $index++) {
				var cat = groups[2][$index];
				buf.push("<a"), buf.push(attrs({
					href: cat.nav_link,
					rel: "nofollow",
					"data-id": cat.id,
					"class": "category-link"
				})), buf.push(">" + escape((interp = cat.name) == null ? "" : interp) + "</a>")
			}
			buf.push("<a"), buf.push(attrs({
				href: "/categories/",
				rel: "nofollow",
				"data-id": "more",
				"class": "all-categories-link category-link"
			})), buf.push(">兴趣/生活 »</a></div></div><div"), buf.push(attrs({
				"class": "bottom-module clearfix"
			})), buf.push("><div"), buf.push(attrs({
				icon: "pin-icon",
				onclick: "app.switchHeaderTo('side');return false;",
				"class": "to-side"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "links"
			})), buf.push("><a"), buf.push(attrs({
				href: "/activities/",
				rel: "nofollow"
			})), buf.push(">活动</a><span>·</span><a"), buf.push(attrs({
				href: "/weekly/",
				rel: "nofollow"
			})), buf.push(">周刊</a><span>·</span><a"), buf.push(attrs({
				href: "/about/",
				rel: "nofollow"
			})), buf.push(">关于</a><span>·</span><a"), buf.push(attrs({
				href: "/pins/53553/",
				rel: "nofollow"
			})), buf.push(">反馈</a><span>·</span><a"), buf.push(attrs({
				href: "http://blog.huaban.com/",
				rel: "nofollow",
				style: "margin-right: 0;"
			})), buf.push(">博客</a></div><div"), buf.push(attrs({
				"class": "up-arrow"
			})), buf.push('></div></div></div><script>(function(){var a=document.id("category_more");if(!a)return;a.getElements("a").each(function(a){app.cnzzTrackEvent(a,{category:"category_more",label:a.get("data-id")})})})()</script>')
		}
		return buf.join("")
	}, __t["base/header_side_menu"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, categories = settings.categories,
				groups = [],
				url = page.$url.split("?")[0];
			for(var i = 0, l = categories.length; i < l; i++) {
				var category = categories[i];
				category.nav_link = "/favorite/" + category.id + "/";
				if(category.display === !1 || !category.col) continue;
				groups[category.col] = groups[category.col] || [], groups[category.col].push(category)
			}
			var moreLinks_mixin = function() {
					buf.push("<div"), buf.push(attrs({
						"class": "menu more-links " + (req.user ? "" : "nologin")
					})), buf.push("><div"), buf.push(attrs({
						"class": "top-module"
					})), buf.push("><a"), buf.push(attrs({
						href: "/apps/",
						rel: "nofollow",
						"class": "text app-link"
					})), buf.push(">移动应用</a><a"), buf.push(attrs({
						href: "/about/goodies/",
						rel: "nofollow",
						"class": "text app-link"
					})), buf.push(">采集工具</a><a"), buf.push(attrs({
						href: "/iwantyou/",
						rel: "nofollow",
						"class": "text pin-link"
					})), buf.push(">招聘</a></div><div"), buf.push(attrs({
						"class": "middle-module clearfix"
					})), buf.push("><div"), buf.push(attrs({
						"class": "col-1 col"
					})), buf.push(">");
					for(var e = 0, t = groups[1].length; e < t; e++) {
						var n = groups[1][e];
						buf.push("<a"), buf.push(attrs({
							href: n.nav_link,
							rel: "nofollow",
							"class": "category-link"
						})), buf.push(">" + escape((interp = n.name) == null ? "" : interp) + "</a>")
					}
					buf.push("</div><div"), buf.push(attrs({
						"class": "col-2 col"
					})), buf.push(">");
					for(var e = 0, t = groups[2].length; e < t; e++) {
						var n = groups[2][e];
						buf.push("<a"), buf.push(attrs({
							href: n.nav_link,
							rel: "nofollow",
							"class": "category-link"
						})), buf.push(">" + escape((interp = n.name) == null ? "" : interp) + "</a>")
					}
					buf.push("<a"), buf.push(attrs({
						href: "/categories/",
						rel: "nofollow",
						"class": "all-categories-link category-link"
					})), buf.push(">兴趣/生活 »</a></div></div><div"), buf.push(attrs({
						"class": "pointer"
					})), buf.push("></div></div>")
				},
				infoLinks_mixin = function() {
					buf.push("<div"), buf.push(attrs({
						"class": "menu info-links"
					})), buf.push("><a"), buf.push(attrs({
						href: "/activities/",
						rel: "nofollow"
					})), buf.push(">活动</a><a"), buf.push(attrs({
						href: "/weekly/?md=top2",
						rel: "nofollow"
					})), buf.push(">周刊</a><a"), buf.push(attrs({
						href: "/about/join_us/",
						rel: "nofollow"
					})), buf.push(">关于</a><a"), buf.push(attrs({
						href: "/pins/53553/",
						rel: "nofollow"
					})), buf.push(">反馈</a><a"), buf.push(attrs({
						href: "http://blog.huaban.com/?md=top2",
						rel: "nofollow"
					})), buf.push(">博客</a><div"), buf.push(attrs({
						"class": "pointer"
					})), buf.push("></div></div>")
				};
			buf.push("<div"), buf.push(attrs({
				id: "header_side_menu"
			})), buf.push("><div"), buf.push(attrs({
				"class": "nav pinned"
			})), buf.push("><a"), buf.push(attrs({
				onclick: "app.switchHeaderTo('normal')",
				title: "解除锁定",
				rel: "nofollow",
				"class": "nav-link"
			})), buf.push("><i></i></a></div>"), req.user && (buf.push("<div"), buf.push(attrs({
				"class": "nav following " + (url === "/" ? "active" : "")
			})), buf.push("><a"), buf.push(attrs({
				href: "/",
				"data-title": "首页",
				rel: "nofollow",
				"class": "nav-link"
			})), buf.push("><i></i></a></div>")), buf.push("<div"), buf.push(attrs({
				"class": "nav explore " + (url === "/discovery/" ? "active" : url === "/" ? req.user ? "" : "active" : "")
			})), buf.push("><a"), buf.push(attrs({
				href: "/discovery/",
				"data-title": "发现",
				rel: "nofollow",
				"class": "nav-link"
			})), buf.push("><i></i></a></div><div"), buf.push(attrs({
				"class": "nav all " + (url === "/all/" ? "active" : "")
			})), buf.push("><a"), buf.push(attrs({
				href: "/all/",
				"data-title": "最新",
				rel: "nofollow",
				"class": "nav-link"
			})), buf.push("><i></i></a></div><div"), buf.push(attrs({
				"class": "nav more"
			})), buf.push("><a"), buf.push(attrs({
				"class": "nav-link"
			})), buf.push("><div"), buf.push(attrs({
				"class": "arrow"
			})), buf.push("></div><i></i></a></div><div"), buf.push(attrs({
				"class": "nav info"
			})), buf.push("><div"), buf.push(attrs({
				"class": "arrow"
			})), buf.push("></div><i></i></div>"), moreLinks_mixin(), infoLinks_mixin(), buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/home_designer_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "home-design-banner"
			})), buf.push("></div>");
			var __val__ = emerge("base/cities_picker");
			buf.push(null == __val__ ? "" : __val__), buf.push("<div"), buf.push(attrs({
				style: "display:none;",
				"class": "home-design-community"
			})), buf.push("><input"), buf.push(attrs({
				type: "text",
				placeholder: "小区名",
				value: ""
			})), buf.push("/></div><div"), buf.push(attrs({
				style: "display:none;",
				"class": "home-design-phone"
			})), buf.push("><input"), buf.push(attrs({
				type: "text",
				placeholder: "手机号",
				value: ""
			})), buf.push("/></div><div"), buf.push(attrs({
				"class": "home-design-save"
			})), buf.push("><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "rbtn btn18 disabled btn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 帮我推荐设计师</span></a></div>")
		}
		return buf.join("")
	}, __t["base/hotkeys"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "inner"
			})), buf.push("><h2>热键提示</h2><table"), buf.push(attrs({
				"class": "ln1"
			})), buf.push("><tbody><tr"), buf.push(attrs({
				"class": "title"
			})), buf.push("><td>全局</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">?</div></td><td>查看热键提示</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">Esc</div></td><td>取消焦点 / 退出</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">/</div></td><td>搜索</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">N</div></td><td>添加...</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">M</div></td><td>私信</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">T</div></td><td>回到顶部</td></tr><tr"), buf.push(attrs({
				"class": "title"
			})), buf.push("><td>瀑布流</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">.</div></td><td>显示新采集</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">J</div></td><td>向下滚动</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">K</div></td><td>向上滚动</td></tr></tbody></table><table"), buf.push(attrs({
				"class": "ln2"
			})), buf.push("><thead><tr"), buf.push(attrs({
				"class": "title"
			})), buf.push("><td>采集页</td></tr></thead><tbody><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">←</div></td><td>上一采集</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">➝</div></td><td>下一采集</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">F</div></td><td>查看大图  /  返回</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">O</div></td><td>打开来源网址</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">D</div></td><td>删除采集</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">R</div></td><td>转采</td></tr><tr><td><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">G</div><span"), buf.push(attrs({
				"class": "plus"
			})), buf.push("></span><div"), buf.push(attrs({
				"class": "hotkey"
			})), buf.push(">S</div></td><td>使用 Google 搜索</td></tr></tbody></table></div>")
		}
		return buf.join("")
	}, __t["base/image_promotions"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			if(promotions && promotions.length > 0) {
				var current_page = Math.floor(Math.random() * promotions.length + 1),
					promotion = promotions[current_page - 1],
					image_url = "",
					target = promotion.new_tab ? "_blank" : "_self";
				promotion.image && promotion.image.bucket && promotion.image.key && (image_url = "https://" + this.settings.hbfile[promotion.image.bucket] + "/img/promotion/" + promotion.image.key), buf.push("<div"), buf.push(attrs({
					"class": "image-promotions"
				})), buf.push("><a"), buf.push(attrs({
					href: "" + promotion.url + "",
					target: "" + target + "",
					rel: "nofollow"
				})), buf.push("><img"), buf.push(attrs({
					src: "" + image_url + "",
					alt: !0,
					width: "204",
					height: "330",
					"data-baiduimageplus-ignore": 1,
					"class": "promotion"
				})), buf.push("/></a>");
				if(promotions.length > 1) {
					buf.push("<ul"), buf.push(attrs({
						"class": "pager"
					})), buf.push(">");
					for(var i = 1, l = promotions.length; i <= l; i++) {
						var promotion = promotions[i - 1],
							image_url = "",
							target = promotion.new_tab ? "_blank" : "_self";
						promotion.image && (image_url = "https://" + this.settings.hbfile[promotion.image.bucket] + "/img/promotion/" + promotion.image.key);
						var li_class = "";
						i == current_page && (li_class = "current"), buf.push("<li"), buf.push(attrs({
							"data-url": "" + promotion.url + "",
							"data-target": "" + target + "",
							"data-image": "" + image_url + "",
							"class": "" + li_class + ""
						})), buf.push(">●</li>")
					}
					buf.push("</ul>")
				}
				buf.push("</div>")
			}
			buf.push('<script>(function(){var a=$$(".image-promotions ul.pager li");a.length>0&&a.addEvent("click",function(){if(this.hasClass("current"))return;var a=$$(".image-promotions ul.pager li.current")[0],b=$$(".image-promotions a")[0],c=$$(".image-promotions img.promotion")[0];a.removeClass("current"),b.set("href",this.get("data-url")),b.set("target",this.get("data-target")),c.set("src",this.get("data-image")),this.addClass("current")}),app.gaqTrackPromotion(".image-promotions a",{category:"category_image_promotions",useTargetUrlAsLabel:!0})})()</script>')
		}
		return buf.join("")
	}, __t["base/index"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, qt = page.query && escape(page.query.text),
				qn = page.query && page.query.total,
				suggests = page.suggests || {},
				categories = {};
			for(var i = 0; i < settings.categories.length; i++) categories[settings.categories[i].id] = settings.categories[i].name;
			page.filter && (category = page.filter.replace("pin:category:", ""));
			var __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/ctx_bar", {
				filter: page.filter,
				qt: qt,
				qn: qn,
				categories: categories,
				settings: settings,
				user_info: page.user_info,
				_url: page.$url,
				promotion: req.promotions ? req.promotions.ctxbar_promotions : !1,
				suggests: suggests
			});
			buf.push(null == __val__ ? "" : __val__);
			var _topLeftShowing = !1;
			if(page.promotions && page.promotions.left_img) {
				var left_promos = page.promotions.left_img,
					left_promo = Array.getRandom(left_promos);
				left_promo && (_topLeftShowing = !0)
			}
			Cookie.read("_tl0h") && (_topLeftShowing = !1);
			var topLeftPromotion_mixin = function() {
				buf.push("<a"), buf.push(attrs({
					href: left_promo.url,
					target: left_promo.new_tab ? "_blank" : "_self",
					"class": "top-left-prom"
				})), buf.push("><img"), buf.push(attrs({
					src: "https://" + settings.hbfile[left_promo.image.bucket] + "/img/promotion/" + left_promo.image.key,
					width: 236,
					height: left_promo.image.height,
					"data-baiduimageplus-ignore": 1
				})), buf.push("/><div"), buf.push(attrs({
					"class": "cls"
				})), buf.push('></div></a><script>(function(){var a=document.getElement(".top-left-prom");a.getSiblings().length||(a=a.getParent(".wfc"));var b=a.getElement(".cls");b.onclick=function(){return app.page.$waterfall.remove(a),Cookie.write("_tl0h",1,{duration:10}),!1}})()</script>')
			};
			buf.push("<div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push(">");
			if(suggests && suggests.images && suggests.images.length && !page.query) {
				buf.push("<div"), buf.push(attrs({
					"class": "category-image-box"
				})), buf.push(">");
				if(page.banner_box_promotion)
					for(var $index = 0, $$l = page.banner_box_promotion.length; $index < $$l; $index++) {
						var promotion = page.banner_box_promotion[$index];
						buf.push("<a"), buf.push(attrs({
							href: "" + promotion.url + "",
							target: "_blank",
							title: promotion.title,
							rel: "nofollow",
							"class": "category-image"
						})), buf.push(">");
						var image_url = "https://" + this.settings.hbfile[promotion.image.bucket] + "/img/promotion/" + promotion.image.key;
						buf.push("<img"), buf.push(attrs({
							width: "236",
							height: "126",
							src: image_url,
							"data-baiduimageplus-ignore": 1
						})), buf.push("/><div"), buf.push(attrs({
							"class": "title"
						})), buf.push(">");
						var __val__ = promotion.title;
						buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</div></a>")
					}
				for(var $index = 0, $$l = suggests.images.length; $index < $$l; $index++) {
					var image = suggests.images[$index];
					buf.push("<a"), buf.push(attrs({
						href: "" + image.url + "",
						target: "_blank",
						title: image.name,
						rel: "nofollow",
						"class": "category-image"
					})), buf.push("><img"), buf.push(attrs({
						width: "236",
						height: "126",
						src: "" + ("https://" + image.file.bucket + ".b0.upaiyun.com/img/category_page/" + image.file.key) + "",
						"data-baiduimageplus-ignore": 1
					})), buf.push("/></a>")
				}
				buf.push("</div>")
			}
			buf.push("<div"), buf.push(attrs({
				id: "waterfall"
			})), buf.push(">"), filter = page.filter || "", filters = page.filter.split(":");
			if(/^pin:category:\w+$/gi.test(filter) && "pin:category:all" !== filter) {
				page.users = page.users || [], page.boards = page.boards || [];
				if(page.users.length && page.boards.length) {
					buf.push("<div"), buf.push(attrs({
						"class": "pin wfc recommends"
					})), buf.push(">");
					if(page.users.length) {
						var __val__ = emerge("base/recommend_users", {
							users: page.users,
							filter: page.filter
						});
						buf.push(null == __val__ ? "" : __val__)
					}
					if(page.boards[0]) {
						var __val__ = emerge("base/recommend_boards", {
							board: page.boards[0],
							filter: page.filter
						});
						buf.push(null == __val__ ? "" : __val__)
					}
					buf.push("</div>")
				}
			}
			if("category" === filters[1] && "board" !== filters[0]) {
				var __val__ = emerge("base/google", {
					slot: "3169500859",
					width: 200,
					height: 200,
					className: ""
				});
				buf.push(null == __val__ ? "" : __val__)
			}
			if(page.user_info) {
				buf.push("<div"), buf.push(attrs({
					id: "user_info",
					"class": "pin wfc"
				})), buf.push(">");
				var __val__ = emerge("base/people_profile", {
					user_info: page.user_info,
					user: req.user,
					suggestion_friends: page.suggestion_friends || []
				});
				buf.push(null == __val__ ? "" : __val__), buf.push("</div>")
			} else if(~page.filter.indexOf("videos")) {
				buf.push("<div"), buf.push(attrs({
					"class": "pin video-category wfc"
				})), buf.push(">"), _topLeftShowing && topLeftPromotion_mixin();
				var current = "videos";
				~page.filter.indexOf("youku") && (current = "youku"), ~page.filter.indexOf("ku6") && (current = "ku6"), ~page.filter.indexOf("56") && (current = "56"), ~page.filter.indexOf("baomihua") && (current = "baomihua"), buf.push("<div"), buf.push(attrs({
					"class": "btns"
				})), buf.push("><a"), buf.push(attrs({
					href: "/all/videos/",
					"class": "all btn " + (current == "videos" ? "current" : "")
				})), buf.push(">全部视频</a><a"), buf.push(attrs({
					href: "/all/videos/youku/",
					"class": "youku btn " + (current == "youku" ? "current" : "")
				})), buf.push(">优酷精选</a><a"), buf.push(attrs({
					href: "/all/videos/ku6/",
					"class": "ku6 btn " + (current == "ku6" ? "current" : "")
				})), buf.push(">酷6精选</a><a"), buf.push(attrs({
					href: "/all/videos/56/",
					"class": "v56 btn " + (current == "56" ? "current" : "")
				})), buf.push(">56视频</a><a"), buf.push(attrs({
					href: "/all/videos/baomihua/",
					"class": "baomihua btn " + (current == "baomihua" ? "current" : "")
				})), buf.push(">爆米花</a></div></div>")
			} else _topLeftShowing && (buf.push("<div"), buf.push(attrs({
				"class": "pin wfc"
			})), buf.push(">"), topLeftPromotion_mixin(), buf.push("</div>"));
			if(page.promotions && (page.promotions.img_promotions || page.promotions.reading_promotions)) {
				var __val__ = emerge("base/promotions", {
					promotions: page.promotions
				});
				buf.push(null == __val__ ? "" : __val__)
			}
			var promt = page.promotions ? page.promotions.promotion : !1;
			if(promt && promt.pin && promt.type == "pin") {
				var pin = promt.pin,
					__val__ = emerge("base/pin_item", {
						user: pin.user,
						pin: pin,
						board: pin.board,
						promotion: promt
					});
				buf.push(null == __val__ ? "" : __val__)
			} else if(promt && promt.board && promt.type == "board") {
				var __val__ = emerge("base/board_item", {
					board: promt.board,
					user: req.user,
					promotion: promt
				});
				buf.push(null == __val__ ? "" : __val__)
			}
			if(page.pins)
				for(var $index = 0, $$l = page.pins.length; $index < $$l; $index++) {
					var pin = page.pins[$index];
					if(pin) {
						var ad = page.ads.getAd(),
							__val__ = emerge("base/pin_ad", {
								ad: ad,
								url: page.$url
							});
						buf.push(null == __val__ ? "" : __val__);
						var __val__ = emerge("base/pin_item", {
							user: pin.user,
							pin: pin,
							board: pin.board
						});
						buf.push(null == __val__ ? "" : __val__)
					}
				} else
					for(var $index = 0, $$l = page.boards.length; $index < $$l; $index++) {
						var board = page.boards[$index];
						if(board) {
							var __val__ = emerge("base/board_item", {
								board: board,
								user: req.user
							});
							buf.push(null == __val__ ? "" : __val__)
						}
					}
			buf.push('</div></div><script>(function(){app.initShowMoreButtons(),app.initLikeButtons(),app.initAddCommentButtons(),app.initFollowButtons(),app.initGifButtons()})(),function(){if(!Browser.isMobile||Cookie.read("_hmbc"))return;var a=navigator.userAgent.toLowerCase(),b=!!a.match(/ipad/),c={type:""};Browser.Platform.ios&&b?c.type="iPad":Browser.Platform.ios&&!b?c.type="iPhone":Browser.Platform.android?c.type="Android":c.type="other",document.id("elevator_item")&&document.id("elevator_item").hide(),app.render("base/mobile_callout",c,function(a,b){Elements.from(b).inject(document.body).getElement(".cls").addEvent("click",function(){document.id("mobile_callout").hide(),Cookie.write("_hmbc",1,{duration:3})}),document.getElement("#mobile_callout .back").addEvent("touchstart",function(a){document.getElement(".menu-bar .go-mobile").fireEvent("touchstart"),a.stop()})})}()</script><script>(function(){app._gaq_promotion&&app._gaq_promotion(),app.gaqTrackPromotion(".promotion .promotion-url",{category:"pin-board-promotions",useTargetUrlAsLabel:!0}),app.gaqTrackEvent(".promotion .promotion-url",{category:"Promotion"}),app.gaqTrackPromotion(".top-left-prom",{category:"top-left-promotion",useTargetUrlAsLabel:!0}),app.gaqTrackPromotion(".category-image-box .category-image",{category:"category_image_small",useTargetUrlAsLabel:!0})})()</script>')
		}
		return buf.join("")
	}, __t["base/login_frame"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "black-overlay"
			})), buf.push("><div"), buf.push(attrs({
				id: "login_frame"
			})), buf.push("><img"), buf.push(attrs({
				src: "/img/logo_2x.png",
				width: 106,
				height: 36,
				"data-baiduimageplus-ignore": 1,
				"class": "logo"
			})), buf.push("/><div"), buf.push(attrs({
				"class": "sign-up"
			})), buf.push("><div"), buf.push(attrs({
				"class": "holder"
			})), buf.push("><div"), buf.push(attrs({
				"class": "with-line"
			})), buf.push(">用第三方帐号注册花瓣</div><div"), buf.push(attrs({
				"class": "buttons"
			})), buf.push("><a"), buf.push(attrs({
				href: "/oauth/weibo/instant_login/?_ref=frame",
				title: "微博帐号登录",
				rel: "nofollow",
				"class": "weibo"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/qzone/instant_login/?_ref=frame",
				title: "QQ帐号登录",
				rel: "nofollow",
				"class": "qzone"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/wechat/instant_login/?_ref=frame",
				title: "微信帐号登录",
				rel: "nofollow",
				"class": "wechat"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/douban/instant_login/?_ref=frame",
				title: "豆瓣帐号登录",
				rel: "nofollow",
				"class": "douban"
			})), buf.push("></a></div><a"), buf.push(attrs({
				"class": "switch-email-signup brown-link"
			})), buf.push(">使用手机号/邮箱注册</a></div><div"), buf.push(attrs({
				"class": "switch"
			})), buf.push(">已有帐号？<a"), buf.push(attrs({
				"class": "brown-link"
			})), buf.push(">登录到花瓣</a></div></div><div"), buf.push(attrs({
				style: "display: none",
				"class": "login"
			})), buf.push("><div"), buf.push(attrs({
				"class": "holder"
			})), buf.push("><div"), buf.push(attrs({
				"class": "with-line"
			})), buf.push(">使用第三方帐号登录</div><div"), buf.push(attrs({
				"class": "buttons small"
			})), buf.push("><a"), buf.push(attrs({
				href: "/oauth/weibo/instant_login/?_ref=frame",
				title: "微博帐号登录",
				rel: "nofollow",
				"class": "weibo"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/qzone/instant_login/?_ref=frame",
				title: "QQ帐号登录",
				rel: "nofollow",
				"class": "qzone"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/wechat/instant_login/?_ref=frame",
				title: "微信帐号登录",
				rel: "nofollow",
				"class": "wechat"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/douban/instant_login/?_ref=frame",
				title: "豆瓣帐号登录",
				rel: "nofollow",
				"class": "douban"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/renren/instant_login/?_ref=frame",
				title: "人人帐号登录",
				rel: "nofollow",
				style: "margin-right: 0",
				"class": "renren"
			})), buf.push("></a></div><div"), buf.push(attrs({
				"class": "with-line"
			})), buf.push(">使用手机号/邮箱登录</div><form"), buf.push(attrs({
				action: "/auth/",
				method: "post",
				"class": "mail-login"
			})), buf.push("><input"), buf.push(attrs({
				type: "hidden",
				name: "_ref",
				value: "frame"
			})), buf.push("/><input"), buf.push(attrs({
				type: "text",
				name: "email",
				placeholder: "输入手机号或者邮箱",
				"class": "clear-input"
			})), buf.push("/><input"), buf.push(attrs({
				name: "password",
				type: "password",
				placeholder: "密码",
				"class": "clear-input"
			})), buf.push("/><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "btn btn18 rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 登录</span></a></form><a"), buf.push(attrs({
				"class": "reset-password red-link"
			})), buf.push(">忘记密码»</a><div"), buf.push(attrs({
				"class": "switch-back"
			})), buf.push(">还没有花瓣帐号？<a"), buf.push(attrs({
				"class": "red-link"
			})), buf.push(">点击注册»</a></div></div></div><div"), buf.push(attrs({
				style: "display: none",
				"class": "reset"
			})), buf.push("><div"), buf.push(attrs({
				"class": "holder"
			})), buf.push("><div"), buf.push(attrs({
				"class": "with-line"
			})), buf.push(">找回密码</div><form"), buf.push(attrs({
				"class": "reset-form"
			})), buf.push("><input"), buf.push(attrs({
				type: "text",
				name: "email",
				placeholder: "输入手机号或者邮箱",
				"class": "clear-input"
			})), buf.push("/><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "btn btn18 rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 重置</span></a></form><a"), buf.push(attrs({
				"class": "back red-link"
			})), buf.push(">又想起来了»</a></div></div><div"), buf.push(attrs({
				"class": "email-signup"
			})), buf.push("><div"), buf.push(attrs({
				style: "display: none",
				"class": "signup-success"
			})), buf.push("><div"), buf.push(attrs({
				"class": "with-line"
			})), buf.push(">注册成功</div><div"), buf.push(attrs({
				"class": "text"
			})), buf.push(">验证邮件已经发送到<span"), buf.push(attrs({
				"class": "email"
			})), buf.push(">email</span>，请<a"), buf.push(attrs({
				href: "",
				target: "_blank",
				"class": "check-mail red-link"
			})), buf.push(">点击查收邮件</a>激活账号。<br"), buf.push(attrs({})), buf.push("/>没有收到激活邮件？请耐心等待，或者<a"), buf.push(attrs({
				"class": "resend red-link disabled"
			})), buf.push(">重新发送<span>30</span></a></div><a"), buf.push(attrs({
				"class": "login-link red-link"
			})), buf.push(">« 返回登录页</a></div><div"), buf.push(attrs({
				style: "display: none",
				"class": "signup-form"
			})), buf.push("><div"), buf.push(attrs({
				"class": "holder"
			})), buf.push("><div"), buf.push(attrs({
				"class": "with-line"
			})), buf.push(">使用手机号/邮箱注册</div><form"), buf.push(attrs({
				action: "",
				method: "post"
			})), buf.push("><input"), buf.push(attrs({
				type: "text",
				name: "email",
				placeholder: "输入手机号或者邮箱",
				"class": "clear-input"
			})), buf.push("/><div"), buf.push(attrs({
				"class": "captcha"
			})), buf.push("></div><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "btn btn18 rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 注册</span></a></form><a"), buf.push(attrs({
				"class": "email-signup-back brown-link"
			})), buf.push(">« 返回第三方帐号登录</a></div></div></div><div"), buf.push(attrs({
				"class": "close"
			})), buf.push('><i></i></div></div></div><script>(function(){function C(a){if(a.err)return a.err==404?window.location.reload():(l.removeClass("disabled"),app.alert(a.msg));window.oauth_callback(a.user)}var a=800,b=document.id("login_frame"),c=b.getParent("div"),d=b.getElement(".switch"),e=b.getElement(".switch-email-signup"),f=b.getElement(".switch-back a"),g=b.getElement("a.email-signup-back"),h=b.getElement(".login"),i=b.getElement(".sign-up"),j=b.getElement(".email-signup"),k=i.getElement(".ds"),l=h.getElement(".mail-login .btn"),m=h.getElement(".mail-login"),n=h.getElement("input[name=email]"),o=j.getElement("input[name=email]"),p=h.getElement("input[name=password]"),q=h.getElement(".reset-password"),r=b.getElement(".reset"),s=r.getElement(".back"),t=r.getElement("form .btn"),u=j.getElement("form .btn"),v=r.getElement("input[name=email]"),w=j.getElement(".signup-success"),x=j.getElement(".signup-form"),y=j.getElement(".login-link"),z=b.getElement(".close"),A=function(){if($$(".signup-form .captcha")){var a=$$(".signup-form .captcha").getChildren(".gt_holder");a&&a.length&&a[0].dispose()}if($$(".reset .captcha")){var a=$$(".reset .captcha").getChildren(".gt_holder");a&&a.length&&a[0].dispose()}},B=c.switchTo=function(a){var c=new Elements([h,i,r,x,w]);typeof a=="string"&&(a=c[["login","signup","reset","emailSignup"].indexOf(a)]),c.hide(),A(),a.show(),b.erase("style"),a==h?(b.setStyles({"margin-top":-215}),n.focus()):a==r?(b.setStyles({height:214,"margin-top":-137}),app.gtRegister(function(a){window.captchaObj=a,a.appendTo(".reset .captcha")}),v.focus()):a==x?(app.gtRegister(function(a){window.captchaObj=a,a.appendTo(".signup-form .captcha")}),o.focus()):a==w&&I()};d.addEvent("click",function(){if(b.hasClass("switching"))return;b.addClass("switching"),function(){B(h)}.delay(a/2),function(){b.removeClass("switching")}.delay(a)}),f.addEvent("click",function(){if(b.hasClass("switching"))return;b.addClass("switching"),function(){B(i)}.delay(a/2),function(){b.removeClass("switching")}.delay(a)});var D=new Request.JSON({url:"/auth/",onSuccess:C,onFailure:function(a){l.removeClass("disabled")}}),E=new Request.JSON({withCredentials:!0,url:"https://"+app.host+"/auth/",onSuccess:C});window.oauth_callback=function(a){"string"==typeof a&&(a=JSON.parse(a)),app.req.user=a;if(app.$login_callback&&"/"!==app.page.$url){var b=app.$login_callback;b.reload?location.reload():b.redraw?app.redraw():"function"==typeof b?b():app.page.$url&&(window.location=app.page.$url),delete app.$login_callback}else window.location=app.page.$url},b.getElements(".login .buttons a, .sign-up .buttons a").addEvent("click",function(a){a.stop();var b=window.open(this.get("href"),"binding_win","status=no,resizable=no,scrollbars=yes,personalbar=no,directories=no,location=no,toolbar=no,menubar=no,width=680,height=500,left=50,top=40");window.focus&&b.focus()}),m.addEvent("keydown",function(a){a.key=="enter"&&l.click()}),l.addEvent("click",function(){if(this.hasClass("disabled"))return;var a=n.value.trim(),b=p.value.trim();return!Validator.isTel(a)&&!Validator.isEmail(a)?app.alert("请输入正确的邮箱或手机号"):Validator.isEmpty(b)?app.alert("请输入密码"):(this.addClass("disabled"),Browser.ie&&Browser.version<9?D.post({email:a,password:b,_ref:"frame"}):(E.onFailure=function(){D.post({email:a,password:b,_ref:"frame"}),l.removeClass("disabled")},E.post({email:a,password:b,_ref:"frame"})),!1)}),q.addEvent("click",function(){B(r)}),s.addEvent("click",function(){B(h)}),t.addEvent("click",function(){var a=v.value.trim(),b=this;if(b.hasClass("disabled"))return;if(Validator.isEmpty(a))return app.alert("请输入手机或邮箱");b.addClass("disabled"),Validator.isTel(a)?(new Request.JSON({url:"/password/reset/tel",data:{tel:a},onSuccess:function(a){window.location.href="/password/reset/tel/"},onFailure:function(a){app.alert(JSON.parse(a.response||"{}").error||app.COMMON_ERRMSG)},onComplete:function(){b.removeClass("disabled")}})).post():Validator.isEmail(a)?(new Request.JSON({url:"/password/reset/email/",data:{email:v.value},onSuccess:function(a){b.removeClass("disabled"),app.alert("重置密码的链接已被发送到你的邮箱"+(a.data.link?\'，请 <a target="_blank" class="red-link" href="http://\'+a.data.link+\'">点击查收邮件</a>以重置密码。\':"")),B(h)},onFailure:function(a){b.removeClass("disabled"),app.error(JSON.parse(a.response||"{}").error||app.COMMON_ERRMSG)}})).post():(b.removeClass("disabled"),app.alert("请输入正确的手机号或邮箱地址"))}),e.addEvent("click",function(){B(x)}),g.addEvent("click",function(){B(i)}),u.addEvent("click",function(){if(u.hasClass("disabled"))return;u.addClass("disabled");var a=captchaObj.getValidate();if(!a)return u.removeClass("disabled"),app.alert("请先拖动验证码到相应位置");var b=o.value.trim();if(!b)return u.removeClass("disabled"),app.alert("请输入正确注册内容");Validator.isTel(b)?(new Request.JSON({url:"/signup/tel/",data:{tel:b,validate:a},onSuccess:function(a){u.removeClass("disabled");if(a.err)return app.alert(a.msg);window.location.href="/signup/tel/"}})).post():Validator.isEmail(b)?(new Request.JSON({url:"/signup/email",data:{email:b,validate:a,_ref:"frame"},onComplete:function(a){u.removeClass("disabled"),a.err&&app.gtRefresh();if(a.err&&a.msg&&a.msg!=="email_exist")return app.alert(a.msg);if(a.msg=="email_exist")return app.alert("该邮箱已注册，请直接登录");var c=a.link?a.link:b.split("@")[1];w.getElement(".text span.email").set("text",b),w.getElement(".text a.check-mail").set("href","http://"+c),B(w)}})).post():app.alert("请输入正确的手机或邮箱")}),y.addEvent("click",function(){B(h)});var F=j.getElement(".resend"),G=F.getElement("span"),H=function(){G.innerHTML--,G.innerHTML=="0"?(G.hide(),F.removeClass("disabled")):setTimeout(H,1e3)},I=function(){G.show().innerHTML="30",setTimeout(H,1e3)};F.addEvent("click",function(){if(this.hasClass("disabled"))return;this.addClass("disabled"),app.gtRefresh(),I(),(new Request.JSON({url:"/signup/email/resend",onComplete:function(a){if(a.err&&a.msg&&a.msg!=="email_exist")return app.alert(a.msg);if(a.msg=="email_exist")return app.alert("此邮箱已经注册过花瓣账号啦，你可以直接使用它登录");app.alert("发送成功，请查收")}})).post()}),z.addEvent("click",function(){c.dispose()})})()</script>')
		}
		return buf.join("")
	}, __t["base/message_popup"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "message_popup",
				style: "display: none"
			})), buf.push("><div"), buf.push(attrs({
				"class": "bar"
			})), buf.push("><div"), buf.push(attrs({
				boxer: ".box-mentions",
				"class": "left barTitle active"
			})), buf.push(">消息<span></span></div><div"), buf.push(attrs({
				boxer: ".box-activities",
				"class": "right barTitle"
			})), buf.push(">动态<span></span></div></div><div"), buf.push(attrs({
				id: "boxer"
			})), buf.push("><div"), buf.push(attrs({
				"class": "box box-mentions"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "box box-activities hidden"
			})), buf.push("></div></div><a"), buf.push(attrs({
				href: "/message/",
				"class": "show-all"
			})), buf.push(">查看所有消息»</a><div"), buf.push(attrs({
				"class": "triangle"
			})), buf.push('></div></div><script>(function(){var a=$$(".barTitle");a.addEvent("click",function(a){var b=this.get("boxer");this.addClass("active"),this.getSiblings()[0].removeClass("active"),$$(b).removeClass("hidden"),$$(b).getSiblings()[0].addClass("hidden")});var b=new Class({initialize:function(a,b,c,d){this.mainEl=a,this.triggerButton=b,this.mentionsButton=c,this.activitiesButton=d,this.indicator=b.getElement(".num"),this.box=$$(".box"),this.mentionsBox=a.getElement(".box-mentions"),this.activitiesBox=a.getElement(".box-activities"),this.showAll=a.getElement(".show-all");var e=this;stopWindowScroll(this.box),b.addEvent("click",function(){e.open(),app.req.unread_activities!=0&&app.req.unread_mentions==0?d.click():c.click()}),c.addEvent("click",function(){e.load("mentions",".left>span","没有消息"),e.changeUnread("mentions"),e.showAll.set({href:"/message/?type=mentions",text:"查看所有消息»"})}),d.addEvent("click",function(){e.load("activities",".right>span","没有动态"),e.changeUnread("activities"),e.showAll.set({href:"/message/?type=activities",text:"查看所有动态»"})}),app.view.addEvent("click",function(a){a.target.match(".menu-bar .message-nav *")||($$(".right.barTitle").hasClass("click")[0]==1?(e.updateIndicator(0),e.messageTotle(0,".right>span")):(e.updateIndicator(app.req.unread_activities),e.messageTotle(0,".left>span")),e.close())}),this.updateIndicator(app.req.unread_messages||0),this.messageTotle(app.req.unread_mentions,".left>span"),this.messageTotle(app.req.unread_activities,".right>span")},fetch:function(){if(this.fetching)return;this.fetching=!0,(new Request.JSON({url:"/message/unreads/",noCache:!0,onSuccess:function(a){if(a.err)return;this.updateIndicator(a)}.bind(this),onComplete:function(){this.fetching=!1}.bind(this)})).get()},changeUnread:function(a){$$(".right.barTitle").hasClass("click")[0]==1?(this.updateIndicator(app.req.unread_mentions),app.req.unread_activities=0,this.messageTotle(0,".right>span")):$$(".left.barTitle").hasClass("click")[0]==1&&(this.updateIndicator(app.req.unread_activities),app.req.unread_mentions=0,this.messageTotle(0,".left>span")),a=="mentions"?$$(".left.barTitle").addClass("click"):$$(".right.barTitle").addClass("click")},updateIndicator:function(a){a>0?(a<100?this.indicator.innerHTML=a:this.indicator.innerHTML="99+",this.indicator.removeClass("hidden")):this.indicator.addClass("hidden")},load:function(a,b,c){a=="mentions"?this.box=this.mentionsBox:this.box=this.activitiesBox;var d=this;if(this.box.hasClass("loading-box"))return;this.box.addClass("loading-box"),this.box.empty(),(new Request.JSON({url:"/message/?type="+a,data:{per_page:20,page:1},onSuccess:function(a){if(a.messages){var e=[];a.messages.each(function(a){e.push(a)}),d.addItem(e,b,d.box,c)}}})).get()},messageTotle:function(a,b){a<100&&a>0?$$(b).set("text",a):a>=100?$$(b).set("text","99+"):a<=0&&$$(b).destroy()},addItem:function(a,b,c,d){var e=a.length;e==0&&(c.removeClass("loading-box"),(new Element("div.empty",{html:d})).inject(c));for(i=0;i<e;i++)c.removeClass("loading-box"),html=app.renderSync("base/message_popup_item",{message:a[i]}),Elements.from(html).inject(c)},open:function(){this.mainEl.show()},close:function(){this.mainEl.hide(),this.box.removeClass("loading-box")}});if(!app.page.messageController){var c=$("message_popup"),d=document.getElement(".menu-bar .message-nav .nav-link"),e=c.getElement(".left.barTitle"),f=c.getElement(".right.barTitle");app.page.messageController=new b(c,d,e,f)}})()</script>')
		}
		return buf.join("")
	}, __t["base/message_popup_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "item " + (message.unread ? "unread" : "")
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + message.extra.by_user.urlname + "/",
				"class": "avt"
			})), buf.push("><img"), buf.push(attrs({
				width: "75",
				height: "75",
				src: avatar(message.extra.by_user)
			})), buf.push("/></a>");
			if(message.type == "like_pin") buf.push("<div"), buf.push(attrs({
				"class": "details"
			})), buf.push(">"), message.extra.pin && message.extra.pin.raw_text ? (buf.push("<div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + message.extra.by_user.urlname + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.by_user.username.brief(12)) == null ? "" : interp) + "</a><span>喜欢了你的采集</span></div><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/pins/" + message.extra.pin.pin_id + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.pin.raw_text) == null ? "" : interp) + "</a></div>")) : (buf.push("<div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + message.extra.by_user.urlname + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.by_user.username.brief(12)) == null ? "" : interp) + "</a><span>喜欢了</span></div><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/pins/" + message.extra.pin.pin_id + "/",
				"class": "brown-link"
			})), buf.push(">你的采集</a></div>")), buf.push("</div><a"), buf.push(attrs({
				href: "/pins/" + message.extra.pin.pin_id + "/",
				"class": "pin-link"
			})), buf.push("><img"), buf.push(attrs({
				src: imgURL(message.extra.pin.file, "sq75sf"),
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a>");
			else if(message.type == "pin_text") {
				buf.push("<div"), buf.push(attrs({
					"class": "details"
				})), buf.push("><div"), buf.push(attrs({
					"class": "line"
				})), buf.push("><a"), buf.push(attrs({
					href: "/" + message.extra.by_user.urlname + "/",
					"class": "brown-link"
				})), buf.push(">" + escape((interp = message.extra.by_user.username.brief(12)) == null ? "" : interp) + "</a><span>采集了</span><a"), buf.push(attrs({
					href: "/pins/" + message.extra.pin.pin_id + "/",
					"class": "brown-link"
				})), buf.push(">" + escape((interp = message.extra.pin.raw_text.brief(20)) == null ? "" : interp) + "</a></div><div"), buf.push(attrs({
					"class": "main-content line"
				})), buf.push(">");
				var __val__ = format_text(message.extra.pin.raw_text, message.extra.pin.text_meta);
				buf.push(null == __val__ ? "" : __val__), buf.push("</div></div><a"), buf.push(attrs({
					href: "/pins/" + message.extra.pin.pin_id + "/",
					"class": "pin-link"
				})), buf.push("><img"), buf.push(attrs({
					src: imgURL(message.extra.pin.file, "sq75sf"),
					"data-baiduimageplus-ignore": 1
				})), buf.push("/></a>")
			} else if(message.type == "follow_user") buf.push("<div"), buf.push(attrs({
				"class": "details"
			})), buf.push("><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + message.extra.by_user.urlname + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.by_user.username.brief(12)) == null ? "" : interp) + "</a></div><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><span>关注了你</span></div></div>");
			else if(message.type == "repin") buf.push("<div"), buf.push(attrs({
				"class": "details"
			})), buf.push(">"), message.extra.pin && message.extra.pin.raw_text ? (buf.push("<div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + message.extra.by_user.urlname + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.by_user.username.brief(12)) == null ? "" : interp) + "</a><span>转采了你的采集</span></div><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/pins/" + message.extra.pin.pin_id + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.pin.raw_text) == null ? "" : interp) + "</a></div>")) : (buf.push("<div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + message.extra.by_user.urlname + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.by_user.username.brief(12)) == null ? "" : interp) + "</a><span>转采了</span></div><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/pins/" + message.extra.by_pin.pin_id + "/",
				"class": "brown-link"
			})), buf.push(">你的采集</a></div>")), buf.push("</div><a"), buf.push(attrs({
				href: "/pins/" + message.extra.by_pin.pin_id + "/",
				"class": "pin-link"
			})), buf.push("><img"), buf.push(attrs({
				src: imgURL(message.extra.by_pin.file, "sq75sf"),
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a>");
			else if(message.type == "repin_2nd") buf.push("<div"), buf.push(attrs({
				"class": "details"
			})), buf.push(">"), message.extra.pin && message.extra.pin.raw_text ? (buf.push("<div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + message.extra.by_user.urlname + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.by_user.username.brief(8)) == null ? "" : interp) + "</a><span>通过</span><a"), buf.push(attrs({
				href: "/" + message.extra.through_pin.user.urlname + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.through_pin.user.username.brief(8)) == null ? "" : interp) + "</a><span>转采了</span></div><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/pins/" + message.extra.pin.pin_id + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.pin.raw_text) == null ? "" : interp) + "</a></div>")) : (buf.push("<div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + message.extra.by_user.urlname + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.by_user.username.brief(12)) == null ? "" : interp) + "</a></div><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><span>转采了</span><a"), buf.push(attrs({
				href: "/pins/" + message.extra.by_pin.pin_id + "/",
				"class": "brown-link"
			})), buf.push(">你的采集</a></div>")), buf.push("</div><a"), buf.push(attrs({
				href: "/pins/" + message.extra.by_pin.pin_id + "/",
				"class": "pin-link"
			})), buf.push("><img"), buf.push(attrs({
				src: imgURL(message.extra.by_pin.file, "sq75sf"),
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a>");
			else if(message.type == "like_board") buf.push("<div"), buf.push(attrs({
				"class": "details"
			})), buf.push("><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + message.extra.by_user.urlname + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.by_user.username) == null ? "" : interp) + "</a></div><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><span>喜欢了你的画板</span><a"), buf.push(attrs({
				href: "/boards/" + message.extra.board.board_id + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.board.title) == null ? "" : interp) + "</a></div></div>");
			else if(message.type == "follow_board") buf.push("<div"), buf.push(attrs({
				"class": "details"
			})), buf.push("><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + message.extra.by_user.urlname + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.by_user.username) == null ? "" : interp) + "</a></div><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("><span>关注了你的画板</span><a"), buf.push(attrs({
				href: "/boards/" + message.extra.board.board_id + "/",
				"class": "brown-link"
			})), buf.push(">" + escape((interp = message.extra.board.title) == null ? "" : interp) + "</a></div></div>");
			else if(message.type == "comment") {
				buf.push("<div"), buf.push(attrs({
					"class": "details"
				})), buf.push("><div"), buf.push(attrs({
					"class": "line"
				})), buf.push("><a"), buf.push(attrs({
					href: "/" + message.extra.by_user.urlname + "/",
					"class": "brown-link"
				})), buf.push(">" + escape((interp = message.extra.by_user.username.brief(12)) == null ? "" : interp) + "</a><span>评论了</span>"), message.extra.pin && message.extra.pin.raw_text ? (buf.push("<a"), buf.push(attrs({
					href: "/pins/" + message.extra.pin.pin_id + "/",
					"class": "brown-link"
				})), buf.push(">" + escape((interp = message.extra.pin.raw_text.brief(20)) == null ? "" : interp) + "</a>")) : (buf.push("<a"), buf.push(attrs({
					href: "/pins/" + message.extra.pin.pin_id + "/",
					"class": "brown-link"
				})), buf.push(">采集</a>")), buf.push("</div><div"), buf.push(attrs({
					"class": "main-content line"
				})), buf.push(">");
				var __val__ = format_text(message.extra.comment.raw_text, message.extra.comment.text_meta);
				buf.push(null == __val__ ? "" : __val__), buf.push("</div></div><a"), buf.push(attrs({
					href: "/pins/" + message.extra.pin.pin_id + "/",
					"class": "pin-link"
				})), buf.push("><img"), buf.push(attrs({
					src: imgURL(message.extra.pin.file, "sq75sf"),
					"data-baiduimageplus-ignore": 1
				})), buf.push("/></a>")
			}
			buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/mobile_callout"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			type == "iPhone" ? (buf.push("<div"), buf.push(attrs({
				id: "mobile_callout",
				"class": "iphone"
			})), buf.push("><div"), buf.push(attrs({
				"class": "spacer"
			})), buf.push("></div><a"), buf.push(attrs({
				target: "_blank",
				href: "https://itunes.apple.com/cn/app/hua-ban-cai-ji-mei-hao-fen/id494813494",
				"class": "go"
			})), buf.push("></a><a"), buf.push(attrs({
				"class": "back"
			})), buf.push("></a><div"), buf.push(attrs({
				"class": "cls"
			})), buf.push("></div></div>")) : type == "Android" ? (buf.push("<div"), buf.push(attrs({
				id: "mobile_callout",
				"class": "android"
			})), buf.push("><div"), buf.push(attrs({
				"class": "spacer"
			})), buf.push("></div><a"), buf.push(attrs({
				target: "_blank",
				href: "//hbfile.b0.upaiyun.com/android/huaban-android.apk",
				"class": "go"
			})), buf.push("></a><a"), buf.push(attrs({
				"class": "back"
			})), buf.push("></a><div"), buf.push(attrs({
				"class": "cls"
			})), buf.push("></div></div>")) : type == "iPad" ? (buf.push("<div"), buf.push(attrs({
				id: "mobile_callout",
				"class": "ipad"
			})), buf.push("><div"), buf.push(attrs({
				"class": "spacer"
			})), buf.push("></div><a"), buf.push(attrs({
				target: "_blank",
				href: "https://itunes.apple.com/cn/app/hua-banhd-cai-ji-mei-hao-fen/id575435250",
				"class": "go"
			})), buf.push("></a><a"), buf.push(attrs({
				"class": "back"
			})), buf.push("></a><div"), buf.push(attrs({
				"class": "cls"
			})), buf.push("></div></div>")) : type == "other" && (buf.push("<div"), buf.push(attrs({
				id: "mobile_callout",
				"class": "other"
			})), buf.push("><div"), buf.push(attrs({
				"class": "spacer"
			})), buf.push("></div><a"), buf.push(attrs({
				"class": "back"
			})), buf.push("></a><div"), buf.push(attrs({
				"class": "cls"
			})), buf.push("></div></div>"))
		}
		return buf.join("")
	}, __t["base/muse_pin_success"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "form"
			})), buf.push("><div"), buf.push(attrs({
				"class": "pin-prompt"
			})), buf.push("><div"), buf.push(attrs({
				"class": "text"
			})), buf.push(">成功采集到<a"), buf.push(attrs({
				href: "#",
				"class": "brown-link prompt-board-link"
			})), buf.push("></a>|<a"), buf.push(attrs({
				href: "#",
				"class": "brown-link prompt-pin-link"
			})), buf.push(">查看该画板</a></div></div><div"), buf.push(attrs({
				"class": "pin-done"
			})), buf.push("><h3"), buf.push(attrs({
				"class": "recommend-title"
			})), buf.push("></h3><div"), buf.push(attrs({
				"class": "recommend-board clearfix"
			})), buf.push('></div></div></div><script>(function(){app.initFollowButtons();var a=$("pin_success"),b=a.getElement(".pin-done .recommend-board"),c=a.getElement(".pin-done .recommend-title"),d=app.$board_id;(new Request.JSON({url:"/boards/"+d+"/",onSuccess:function(d){if(d.err||!d.board)return;b.show();var e=d.board,f=a.getElement(".prompt-board-link"),g=a.getElement(".prompt-pin-link");f.set("text",e.title),f.set("href","/boards/"+e.board_id+"/"),g.set("href","/boards/"+e.board_id+"/"),c.set("text",e.title),app.render("base/board_item",{board:e,user:app.req.user},function(a,c){Elements.from(c).inject(b),a&&Browser.exec(a);var d=setTimeout(function(){app.hideDialogBox("pin_success"),clearTimeout(d)},5e3);app.gaqTrackEvent("#pin_success .recommend-board a.link",{category:"recommend_board_link"}),app.gaqTrackEvent("#pin_success .recommend-board .follow",{category:"recommend_board_follow"})})}})).get()})()</script>')
		}
		return buf.join("")
	}, __t["base/nav_bar"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, categories = settings.categories,
				groups = [],
				cats = {};
			if(page.filter) var filter = page.filter.split(":");
			else filter = ["", "", ""];
			for(var i = 0, l = categories.length; i < l; i++) {
				var category = categories[i];
				if(category.display === !1) continue;
				var now_link = "/favorite/";
				(filter[0] === "board" || filter[0] === "user") && (now_link = "/" + filter[0] + "s" + now_link), category.nav_link = now_link + category.id + "/", groups[category.group] = groups[category.group] || [], groups[category.group].push(category), cats[category.id] = category.name
			}
			var selected = "";
			filter[2] == "videos" ? selected = "videos" : filter[1] == "category" && filter[2] == "all" ? selected = "latest" : filter[1] == "following" && filter[2] == "all" ? selected = "following" : filter[1] == "popular" && (selected = "popular"), buf.push("<div"), buf.push(attrs({
				id: "shadow_nav",
				"class": navShowing ? "" : "closed"
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				"class": "tent"
			})), buf.push("><div"), buf.push(attrs({
				"class": "huaban-shadow-nav clearfix"
			})), buf.push("><div"), buf.push(attrs({
				"class": "unit"
			})), buf.push("><a"), buf.push(attrs({
				href: "/all/",
				rel: "nofollow",
				"class": "large-btn latest " + (selected == "latest" ? "active" : "")
			})), buf.push("><div"), buf.push(attrs({
				"class": "icon"
			})), buf.push("></div>最新</a><a"), buf.push(attrs({
				href: "/popular/",
				rel: "nofollow",
				"class": "large-btn hot " + (selected == "popular" ? "active" : "")
			})), buf.push("><div"), buf.push(attrs({
				"class": "icon"
			})), buf.push("></div>热门</a><a"), buf.push(attrs({
				href: "/all/videos/",
				rel: "nofollow",
				"class": "large-btn video " + (selected == "videos" ? "active" : "")
			})), buf.push("><div"), buf.push(attrs({
				"class": "icon"
			})), buf.push("></div>视频</a></div><div"), buf.push(attrs({
				"class": "border"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "unit unit0"
			})), buf.push("><ul"), buf.push(attrs({
				"class": "clearfix"
			})), buf.push(">");
			for(var $index = 0, $$l = groups[0].length; $index < $$l; $index++) {
				var cat = groups[0][$index];
				buf.push("<li><a"), buf.push(attrs({
					href: cat.nav_link,
					rel: "nofollow",
					"class": cat.id == filter[2] ? "onthis" : ""
				})), buf.push(">" + escape((interp = cat.name) == null ? "" : interp) + "</a></li>")
			}
			buf.push("</ul></div><div"), buf.push(attrs({
				"class": "border"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "unit unit1"
			})), buf.push("><ul"), buf.push(attrs({
				"class": "clearfix"
			})), buf.push(">");
			for(var $index = 0, $$l = groups[1].length; $index < $$l; $index++) {
				var cat = groups[1][$index];
				buf.push("<li><a"), buf.push(attrs({
					href: cat.nav_link,
					rel: "nofollow",
					"class": cat.id == filter[2] ? "onthis" : ""
				})), buf.push(">" + escape((interp = cat.name) == null ? "" : interp) + "</a></li>")
			}
			buf.push("</ul></div><div"), buf.push(attrs({
				"class": "line"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "unit unit2"
			})), buf.push("><ul"), buf.push(attrs({
				"class": "clearfix"
			})), buf.push(">");
			for(var $index = 0, $$l = groups[2].length; $index < $$l; $index++) {
				var cat = groups[2][$index];
				buf.push("<li><a"), buf.push(attrs({
					href: cat.nav_link,
					rel: "nofollow",
					"class": cat.id == filter[2] ? "onthis" : ""
				})), buf.push(">" + escape((interp = cat.name) == null ? "" : interp) + "</a></li>")
			}
			buf.push("</ul></div><div"), buf.push(attrs({
				"class": "border"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "unit unit3"
			})), buf.push("><ul"), buf.push(attrs({
				"class": "clearfix"
			})), buf.push(">");
			for(var $index = 0, $$l = groups[3].length; $index < $$l; $index++) {
				var cat = groups[3][$index];
				buf.push("<li><a"), buf.push(attrs({
					href: cat.nav_link,
					rel: "nofollow",
					"class": cat.id == filter[2] ? "onthis" : ""
				})), buf.push(">" + escape((interp = cat.name) == null ? "" : interp) + "</a></li>")
			}
			buf.push("</ul></div><div"), buf.push(attrs({
				"class": "border"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "unit unit4"
			})), buf.push("><ul"), buf.push(attrs({
				"class": "clearfix"
			})), buf.push(">");
			for(var $index = 0, $$l = groups[4].length; $index < $$l; $index++) {
				var cat = groups[4][$index];
				buf.push("<li><a"), buf.push(attrs({
					href: cat.nav_link,
					rel: "nofollow",
					"class": cat.id == filter[2] ? "onthis" : ""
				})), buf.push(">" + escape((interp = cat.name) == null ? "" : interp) + "</a></li>")
			}
			if(req.promotions && req.promotions.dropdown && req.promotions.dropdown.length) {
				buf.push("<li"), buf.push(attrs({
					"class": "promotion"
				})), buf.push(">");
				var _n = Math.floor(Math.random() * req.promotions.dropdown.length + 1) - 1,
					_promotion = req.promotions.dropdown[_n],
					_target = _promotion.new_tab ? "_blank" : "_self";
				if(_promotion.image && _promotion.image.key && _promotion.image.bucket) {
					var _promotion_icon = "//" + settings.hbfile[_promotion.image.bucket] + "/img/promotion/" + _promotion.image.key;
					buf.push("<a"), buf.push(attrs({
						style: "background-image:url('" + _promotion_icon + "');",
						href: "" + _promotion.promotion_url + "",
						target: "" + _target + "",
						"class": "with-img"
					})), buf.push(">" + escape((interp = _promotion.title) == null ? "" : interp) + "</a>")
				} else buf.push("<a"), buf.push(attrs({
					href: "" + _promotion.promotion_url + "",
					target: "" + _target + ""
				})), buf.push(">" + escape((interp = _promotion.title) == null ? "" : interp) + "</a>");
				buf.push("</li>")
			}
			buf.push("</ul></div></div></div></div></div>")
		}
		return buf.join("")
	}, __t["base/new_index"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "head-box"
			})), buf.push(">");
			if(!req.user) {
				var __val__ = emerge("base/new_index_header");
				buf.push(null == __val__ ? "" : __val__)
			}
			var __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__), buf.push("</div><div"), buf.push(attrs({
				"class": "wrapper-996 wrapper"
			})), buf.push(">");
			if(page.explores) {
				buf.push("<div"), buf.push(attrs({
					"class": "recommend-line"
				})), buf.push("><a>大家正在关注</a></div>");
				var __val__ = emerge("base/category_explore");
				buf.push(null == __val__ ? "" : __val__)
			}
			if(page.recommends) {
				buf.push("<div"), buf.push(attrs({
					"class": "recommend-line"
				})), buf.push("><a>为您推荐</a></div>");
				var __val__ = emerge("base/recommend", {
					recommends: page.recommends,
					rows: 0
				});
				buf.push(null == __val__ ? "" : __val__), buf.push("<div"), buf.push(attrs({
					"class": "get-more-line"
				})), buf.push("><a>加载更多</a></div>")
			}
			var __val__ = emerge("base/new_index_category");
			buf.push(null == __val__ ? "" : __val__), buf.push("</div>");
			var __val__ = emerge("base/footer");
			buf.push(null == __val__ ? "" : __val__), buf.push('<script>window.addEvent("domready",function(){document.getElement("#header .wrapper").addClass("wrapper-996"),function(){function c(a){var b=$$(".recommend-container-row").length,c=app.renderSync("base/recommend",{recommends:a,rows:b});Elements.from(c).inject("recommend_container","bottom")}var a=document.getElement(".get-more-line"),b=1;a.addEvent("click",function(){if(this.hasClass("disabled"))return;b++;var d=(new Request.JSON({url:"?page="+b,onComplete:function(d){c(d.recommends);if(d.recommends.length<15||b>=5)a.getElement("a").set("text","没有更多了"),a.addClass("disabled")}})).get()})}()})</script>')
		}
		return buf.join("")
	}, __t["base/new_index_category"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, categories = settings.categories,
				categoriesGroup = [];
			for(var k = 0; k < categories.length; k++) categories[k].display === !1 && categories.splice(k, 1);
			for(var i = 0; i < categories.length; i += 7) categoriesGroup.push(categories.slice(i, i + 7));
			buf.push("<div"), buf.push(attrs({
				"class": "new-index-category"
			})), buf.push("><div"), buf.push(attrs({
				"class": "new-index-category-head clearfix"
			})), buf.push("><div"), buf.push(attrs({
				"class": "title"
			})), buf.push("><span>以分类浏览花瓣</span></div><div"), buf.push(attrs({
				"class": "all-pins"
			})), buf.push("><a"), buf.push(attrs({
				href: "/all/"
			})), buf.push(">所有采集 »</a></div></div><div"), buf.push(attrs({
				"class": "new-index-category-body"
			})), buf.push(">");
			for(i = 0; i < categoriesGroup.length; i++) {
				buf.push("<ul"), buf.push(attrs({
					"class": "new-index-category-group"
				})), buf.push(">");
				for(k = 0; k < categoriesGroup[i].length; k++) {
					var item = categoriesGroup[i][k];
					buf.push("<li"), buf.push(attrs({
						"class": "new-index-category-item"
					})), buf.push("><a"), buf.push(attrs({
						href: "" + item.nav_link + ""
					})), buf.push(">" + escape((interp = item.name) == null ? "" : interp) + "</a></li>")
				}
				buf.push("</ul>")
			}
			buf.push("</div></div>")
		}
		return buf.join("")
	}, __t["base/new_index_header"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			if(page.banners) var banner = page.banner = page.banners[Math.floor(Math.random() * page.banners.length)];
			var url = page.$url;
			buf.push("<div"), buf.push(attrs({
				"class": "banner-background"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "mask"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "new-banner"
			})), buf.push("><div"), buf.push(attrs({
				"class": "title"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "search-box"
			})), buf.push("><form"), buf.push(attrs({
				method: "get",
				action: page.query && page.query.type ? page.$url : "/search/",
				"class": "new-searching-unit"
			})), buf.push("><input"), buf.push(attrs({
				id: "query",
				type: "text",
				size: "27",
				name: "q",
				autocomplete: "off",
				placeholder: "搜索你喜欢的",
				value: page.query ? _(page.query.text) : ""
			})), buf.push("/><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "go"
			})), buf.push("></a></form><div"), buf.push(attrs({
				"class": "hot-words"
			})), buf.push("><span>热门搜索：</span>");
			if(page.hot_words)
				for(var index = 0, $$l = page.hot_words.slice(0, 5).length; index < $$l; index++) {
					var item = page.hot_words.slice(0, 5)[index];
					buf.push("<a"), buf.push(attrs({
						href: "" + item.url + ""
					})), buf.push(">" + escape((interp = item.name) == null ? "" : interp) + "</a>"), index < page.hot_words.slice(0, 5).length - 1 && buf.push("<span>，</span>")
				}
			buf.push("</div></div>"), banner && banner.user && (buf.push("<div"), buf.push(attrs({
				"class": "author"
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper wrapper-996"
			})), buf.push("><span>图片：</span><a"), buf.push(attrs({
				href: "/" + banner.user.urlname + "/",
				rel: "nofollow"
			})), buf.push(">" + escape((interp = banner.user.username) == null ? "" : interp) + "</a></div></div>")), buf.push('</div><script>if(app.page.banner)var banner=app.page.banner,bannerImgUrl="//"+banner.cover.bucket+".b0.upaiyun.com"+banner.cover.path+banner.cover.key,myImage=Asset.image(bannerImgUrl,{onLoad:function(){var a=document.getElement(".banner-background");a.setStyles({"background-image":"url("+bannerImgUrl+")",opacity:"1"}),new Parallax(a)}});(function(){var a=$$(".hot-words");app.initSearchForms(".new-searching-unit",{placeholderColor:"#ededed",queryHintCallback:function(b){a&&(b.length?a.hide():a.show())}})})(),$(document.body).addEvent("click",function(a){!a.target.getParent(".search-hint")&&$$(".hot-words")&&$$(".hot-words").show()})</script>')
		}
		return buf.join("")
	}, __t["base/pager"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, base_url = base_url || "?page=%_page_&limit=%_limit_";
			base_url = base_url.replace("%_limit_", per_page);
			var num_records = parseInt(num_records) || 0,
				cur_page = parseInt(cur_page) || 1,
				per_page = parseInt(per_page) || 2,
				num_pages = Math.ceil(num_records / per_page);
			cur_page < 1 && (cur_page = 1), num_pages < 1 && (num_pages = 1), cur_page > num_pages && (cur_page = num_pages);
			if(num_pages > 1) {
				buf.push("<div"), buf.push(attrs({
					"class": "pager"
				})), buf.push("><div"), buf.push(attrs({
					"class": "pages"
				})), buf.push(">"), cur_page > 1 && (buf.push('<!--a.nextprev(href="#{base}?page=#{cur_page - 1}&limit=#{per_page}") 上一页--><a'), buf.push(attrs({
					href: "" + base_url.replace("%_page_", cur_page - 1) + "",
					"class": "nextprev"
				})), buf.push(">上一页</a>"));
				if(cur_page > 1)
					if(cur_page > 8) {
						for(var $index = 0, $$l = [1, 2].length; $index < $$l; $index++) {
							var n = [1, 2][$index];
							buf.push('<!--a(href="#{base}?page=#{cur_page}&limit=#{per_page}") #{n}--><a'), buf.push(attrs({
								href: "" + base_url.replace("%_page_", n) + ""
							})), buf.push(">" + escape((interp = n) == null ? "" : interp) + "</a>")
						}
						buf.push("<span"), buf.push(attrs({
							"class": "break"
						})), buf.push(">...</span>");
						var offset = cur_page - 3;
						cur_page > num_pages - 3 && (offset = num_pages - 6);
						for(offset; offset < cur_page; offset++) buf.push('<!--a(href="#{base}?page=#{offset}&limit=#{per_page}") #{offset}--><a'), buf.push(attrs({
							href: "" + base_url.replace("%_page_", offset) + ""
						})), buf.push(">" + escape((interp = offset) == null ? "" : interp) + "</a>")
					} else
						for(var n = 1; n < cur_page; n++) buf.push('<!--a(href="#{base}?page=#{n}&limit=#{per_page}") #{n}--><a'), buf.push(attrs({
							href: "" + base_url.replace("%_page_", n) + ""
						})), buf.push(">" + escape((interp = n) == null ? "" : interp) + "</a>");
				buf.push("<span"), buf.push(attrs({
					"class": "current"
				})), buf.push(">" + escape((interp = cur_page) == null ? "" : interp) + "</span>");
				if(num_pages - cur_page > 0)
					if(num_pages - cur_page > 8) {
						var offset = 7;
						cur_page > 3 && (offset = cur_page + 3);
						for(var n = cur_page + 1; n < offset; n++) buf.push('<!--a(href="#{base}?page=#{n}&limit=#{per_page}") #{n}--><a'), buf.push(attrs({
							href: "" + base_url.replace("%_page_", n) + ""
						})), buf.push(">" + escape((interp = n) == null ? "" : interp) + "</a>");
						buf.push("<span"), buf.push(attrs({
							"class": "break"
						})), buf.push(">...</span>");
						for(var n = num_pages - 1; n <= num_pages; n++) buf.push('<!--a(href="#{base}?page=#{n}&limit=#{per_page}") #{n}--><a'), buf.push(attrs({
							href: "" + base_url.replace("%_page_", n) + ""
						})), buf.push(">" + escape((interp = n) == null ? "" : interp) + "</a>")
					} else
						for(var n = cur_page + 1; n <= num_pages; n++) buf.push('<!--a(href="#{base}?page=#{n}&limit=#{per_page}") #{n}--><a'), buf.push(attrs({
							href: "" + base_url.replace("%_page_", n) + ""
						})), buf.push(">" + escape((interp = n) == null ? "" : interp) + "</a>");
				cur_page < num_pages && (buf.push('<!--a.nextprev(href="#{base}?page=#{cur_page + 1}&limit=#{per_page}") 下一页--><a'), buf.push(attrs({
					href: "" + base_url.replace("%_page_", cur_page + 1) + "",
					"class": "nextprev"
				})), buf.push(">下一页</a>")), buf.push("</div></div>")
			}
		}
		return buf.join("")
	}, __t["base/people_boards"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/people_layout", {
				req: req,
				user: page.user,
				settings: settings,
				ctx: "boards",
				body_tpl: "base/people_boards_body",
				page: page
			});
			buf.push(null == __val__ ? "" : __val__)
		}
		return buf.join("")
	}, __t["base/people_boards_body"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, self = req.user && req.user.user_id === user.user_id,
				is_sort_able = self ? "sortable" : "";
			buf.push("<div"), buf.push(attrs({
				id: "waterfall",
				"class": "sort-lists clearfix " + ("" + is_sort_able + "")
			})), buf.push(">"), self && (buf.push("<div"), buf.push(attrs({
				onclick: "app.requireLogin(function() {app.showDialogBox('create_board');});",
				"class": "wfc add-board"
			})), buf.push("><div"), buf.push(attrs({
				"class": "inner"
			})), buf.push("><i></i><span>创建画板</span></div></div>"));
			for(var $index = 0, $$l = user.boards.length; $index < $$l; $index++) {
				var b = user.boards[$index];
				if(b && (b.is_private != 2 || b.pin_count > 0 && b.pins && b.pins[0])) {
					var __val__ = emerge("base/board_item", {
						board: b,
						user: this.req.user,
						show_cover_button: !0
					});
					buf.push(null == __val__ ? "" : __val__)
				}
			}
			buf.push('</div><script>var main=document.getElement(".sortable");if(main){var sorting=!1,container=$$(".sortable")[0],sortable,cancelBtn,oldorder,ContainTop,ContainHeight,start=function(){sorting=!0;var a;sortable=new Sortables(".sortable",{clone:!0,childrenSelector:".Board:not(.default-board)",onStart:function(a,b){app.view.addEvent("mousemove",app.boardListScroll),a.setStyles({border:"dashed 3px #DDD",background:"transparent","box-shadow":"none",width:b.getStyle("width").toInt()-6,height:b.getStyle("height").toInt()-6}),a.getChildren().setStyles({visibility:"hidden"}),a.addClass("sort"),b.setStyles({"z-index":999999,opacity:.6,filter:"alpha(opacity=40)"})},onComplete:function(a){app.view.removeEvent("mousemove",app.boardListScroll),a.getChildren().setStyles({visibility:""}),a.set("style",""),complete()}}),oldorder=sortable.serialize(0,function(a){return a.get("data-id")})},complete=function(){var a=sortable.serialize(0,function(a){return a.get("data-id")});oldorder.join("-")!=a.join("-")?(new Request.JSON({url:"/boards/sort/",data:{ids:a.join(",")},onSuccess:onComplete(a,!0)})).post():onComplete(a,!0)},onComplete=function(a,b){oldorder=a,sorting=!1};app.boardListScroll=function(a){var b=window.innerHeight;ContainTop=container.getTop(),ContainHeight=container.getHeight();var c,d;b-a.client.y<50?(d=window.getScroll(),c=Math.min(d.y+50,ContainTop+ContainHeight-window.innerHeight),window.scrollTo(d.x,c)):a.client.y<50&&(d=window.getScroll(),c=Math.max(d.y-50,ContainTop-55),window.scrollTo(d.x,c))},sorting?complete():start()}(function(){var a=function(){var a=document.getElement("#waterfall");if(!document.getElement("#user_page .loading"))var c=(new Element("div",{"class":"loading"})).inject(a,"after").hide().set("html",\'<img src="/img/loading.gif"><span>正在加载...</span>\');else var c=document.getElement("#user_page .loading");var d=window.getSize().y,e=window.getScroll().y,f=a.getCoordinates().bottom;if(f-e-d<150&&!app.page.triggered&&!app.page.end){app.page.triggered=!0;if(!a.getElement(".Board")){app.page.end=!0;return}var g=a.getLast(".Board:not(.sort)").get("data-seq");(new Request.JSON({url:app.page.$url,data:{max:g,limit:10,wfl:1},noCache:!0,onRequest:function(){c.show()},onSuccess:function(d){c.hide();if(d.err){app.error(d.msg||app.COMMON_ERRMSG);return}if(d&&d.user&&d.user.boards.length>0){var e="";app.page.user&&app.page.user.boards&&(app.page.user.boards=app.page.user.boards.concat(d.user.boards)),d.user.boards.each(function(a){e+=app.renderSync("base/board_item",{board:a,user:app.req.user,show_cover_button:!0})}),Elements.from(e).inject(a),b()}else app.page.end=!0,c.set("html",\'<img src="/img/end.png">\').show()}})).get()}},b=function(){if(main){var a=$$(".sortable .Board:not(.inited)");sortable.addItems(a),a.addClass("inited")}app.page.triggered=!1};main&&$$(".sortable .Board").addClass("inited"),app.loadBoardEvent||(app.loadBoardEvent=function(){var b;window.clearTimeout(b),b=window.setTimeout(function(){a()},500)},window.addEvent("scroll",app.loadBoardEvent))})()</script>')
		}
		return buf.join("")
	}, __t["base/people_commodities"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/people_layout", {
				req: req,
				user: page.user,
				settings: settings,
				ctx: "commodities",
				body_tpl: "base/people_commodities_body",
				page: page
			});
			buf.push(null == __val__ ? "" : __val__)
		}
		return buf.join("")
	}, __t["base/people_commodities_body"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "waterfall"
			})), buf.push(">");
			for(var $index = 0, $$l = user.commodities.length; $index < $$l; $index++) {
				var pin = user.commodities[$index],
					__val__ = emerge("base/pin_item", {
						user: user,
						pin: pin,
						board: pin.board
					});
				buf.push(null == __val__ ? "" : __val__)
			}
			buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/people_creations"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/people_layout", {
				req: req,
				user: page.user,
				settings: settings,
				ctx: "creations",
				body_tpl: "base/people_creations_body",
				page: page
			});
			buf.push(null == __val__ ? "" : __val__)
		}
		return buf.join("")
	}, __t["base/people_creations_body"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "waterfall"
			})), buf.push(">");
			for(var $index = 0, $$l = user.creations.length; $index < $$l; $index++) {
				var pin = user.creations[$index],
					__val__ = emerge("base/pin_item", {
						user: user,
						pin: pin,
						board: pin.board
					});
				buf.push(null == __val__ ? "" : __val__)
			}
			buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/people_followers"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/people_layout", {
				req: req,
				user: page.user,
				settings: settings,
				ctx: "followers",
				body_tpl: "base/people_followers_body",
				page: page
			});
			buf.push(null == __val__ ? "" : __val__)
		}
		return buf.join("")
	}, __t["base/people_followers_body"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "desc-bar"
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + " 的所有粉丝</div><div"), buf.push(attrs({
				id: "waterfall"
			})), buf.push(">");
			for(var $index = 0, $$l = users.length; $index < $$l; $index++) {
				var u = users[$index],
					__val__ = emerge("base/person_item", {
						user: u,
						pins: u.pins,
						req: req
					});
				buf.push(null == __val__ ? "" : __val__)
			}
			buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/people_following"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/people_layout", {
				req: req,
				user: page.user,
				settings: settings,
				ctx: "following",
				body_tpl: "base/people_following_body",
				page: page
			});
			buf.push(null == __val__ ? "" : __val__)
		}
		return buf.join("")
	}, __t["base/people_following_body"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, user = locals.user,
				req = locals.req,
				users = locals.users;
			buf.push("<div"), buf.push(attrs({
				"class": "desc-bar"
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + " 的所有关注：<div"), buf.push(attrs({
				"class": "following-switcher"
			})), buf.push("><li"), buf.push(attrs({
				"data-item": "explores",
				"class": "following-explores first"
			})), buf.push("><a>兴趣点</a></li><li"), buf.push(attrs({
				"data-item": "",
				"class": "following-users selected"
			})), buf.push("><a>用户</a></li><li"), buf.push(attrs({
				"data-item": "boards",
				"class": "following-boards last"
			})), buf.push("><a>画板</a></li></div></div><div"), buf.push(attrs({
				id: "waterfall"
			})), buf.push(">");
			for(var $index = 0, $$l = users.length; $index < $$l; $index++) {
				var user = users[$index],
					__val__ = emerge("base/person_item", {
						user: user,
						pins: user.pins,
						req: req
					});
				buf.push(null == __val__ ? "" : __val__)
			}
			buf.push('</div><script>(function(){function e(c){c=c||"",b.getChildren().dispose().setStyle("height",0),app.page.$waterfall.destroy(),d.inject(b);var e=(new Request.JSON({url:"/"+a+"/following/"+c,onComplete:function(a){c===""&&(c="users"),f(c,a&&a[c])}})).get()}function f(e,f){if(!f.length){d.dispose(),c=!1;return}var g=function(a,b){return a==="explores"?app.renderSync("base/explore_board",{explore:b}):a==="users"?app.renderSync("base/person_item",{user:b,pins:b.pins,req:app.req}):a==="boards"?app.renderSync("base/board_item",{board:b,user:app.page.user}):""},h="";for(var i=0,j=f.length;i<j;i++)h+=g(e,f[i]);$$(".selected").hasClass("following-"+e)&&(b.getChildren().dispose(),d.dispose(),Elements.from(h).inject(b),Cookie.write("wft","1")),e==="explores"?app.page.$waterfall=(new Waterfall("waterfall",{cellSelector:"div.explore-board",loader:app.createCellLoader("/"+a+"/following/explores",20,1,function(a){return{data:a.explores}},{template:"base/explore_board"})})).reposition():e==="users"?app.page.$waterfall=(new Waterfall("waterfall",{cellSelector:"div.person-item",loader:app.createCellLoader("/"+a+"/following",20,function(a){return{data:a.users}},{template:"base/person_item"})})).reposition():e==="boards"&&(app.page.$waterfall=(new Waterfall("waterfall",{loader:app.createCellLoader("/"+a+"/following/boards",20,1,function(a){return app.page.boards&&Array.prototype.push.apply(app.page.boards,a.boards),{data:a.boards}})})).reposition()),c=!1}var a=app.page.user.urlname,b=document.id("waterfall"),c=!1,d=Elements.from(\'<div class="waterfall-loading"></div>\');$$(".following-switcher li").addEvent("click",function(){var a=this.get("data-item");!this.hasClass("selected")&&!c&&(c=!0,e(a),this.addClass("selected"),this.getSiblings().removeClass("selected"))})})()</script>')
		}
		return buf.join("")
	}, __t["base/people_layout"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, user_url = "/" + user.urlname,
				qt = page.people_query && escape(page.people_query.text),
				qn = page.people_query && page.people_query.total,
				is_owner = req.user && user.user_id === req.user.user_id,
				categories = {};
			settings.muse_categories.forEach(function(e) {
				categories[e.id] = e.name
			}), buf.push("<div"), buf.push(attrs({
				id: "user_page"
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper clearfix"
			})), buf.push("><div"), buf.push(attrs({
				id: "user_card"
			})), buf.push("><div"), buf.push(attrs({
				"class": "maozi"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "inner clearfix " + (user.repins_from && user.repins_from.length ? "" : "without-side")
			})), buf.push("><div"), buf.push(attrs({
				"class": "avatar-unit"
			})), buf.push("><div"), buf.push(attrs({
				"class": "img"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(user, "sq140sf"),
				"data-baiduimageplus-ignore": 1,
				"class": "current-avatar"
			})), buf.push("/><img"), buf.push(attrs({
				src: "/img/load2.gif",
				style: "display:none;",
				"data-baiduimageplus-ignore": 1,
				"class": "load"
			})), buf.push("/>"), is_owner && (buf.push("<div"), buf.push(attrs({
				"class": "change-avatar"
			})), buf.push("><a"), buf.push(attrs({
				"class": "btn wbtn btn12"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push(">更换头像</span></a></div>")), buf.push("</div>");
			if(req.user && req.user.user_id == 1 || user.user_id != 1) buf.push("<div"), buf.push(attrs({
				"class": "counts clearfix"
			})), buf.push(">"), user.follower_count ? (buf.push("<a"), buf.push(attrs({
				href: "" + user_url + "/followers/",
				"class": "followers"
			})), buf.push("><div"), buf.push(attrs({
				"class": "num"
			})), buf.push(">" + escape((interp = user.follower_count) == null ? "" : interp) + "</div><div"), buf.push(attrs({
				"class": "sub"
			})), buf.push(">粉丝</div></a>")) : (buf.push("<a"), buf.push(attrs({
				href: "" + user_url + "/followers/",
				rel: "nofollow",
				"class": "followers"
			})), buf.push("><div"), buf.push(attrs({
				"class": "num"
			})), buf.push(">" + escape((interp = user.follower_count) == null ? "" : interp) + "</div><div"), buf.push(attrs({
				"class": "sub"
			})), buf.push(">粉丝</div></a>")), user.following_count ? (buf.push("<a"), buf.push(attrs({
				href: "" + user_url + "/following/",
				"class": "follows"
			})), buf.push("><div"), buf.push(attrs({
				"class": "num"
			})), buf.push(">" + escape((interp = user.following_count) == null ? "" : interp) + "</div><div"), buf.push(attrs({
				"class": "sub"
			})), buf.push(">关注</div></a>")) : (buf.push("<a"), buf.push(attrs({
				href: "" + user_url + "/following/",
				rel: "nofollow",
				"class": "follows"
			})), buf.push("><div"), buf.push(attrs({
				"class": "num"
			})), buf.push(">" + escape((interp = user.following_count) == null ? "" : interp) + "</div><div"), buf.push(attrs({
				"class": "sub"
			})), buf.push(">关注</div></a>")), buf.push("</div>");
			buf.push("</div><div"), buf.push(attrs({
				"class": "head-line"
			})), buf.push("><div"), buf.push(attrs({
				"class": "name"
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + ""), user.status.ban && user.status.ban > (new Date).getTime() && (buf.push("<sup"), buf.push(attrs({
				style: "color:red;"
			})), buf.push(">(已禁止)</sup>")), buf.push("</div>");
			var show_verification = page.user.profile.show_verification;
			show_verification && page.user.bindings[show_verification] && page.user.bindings[show_verification].user_info.verified && (buf.push("<img"), buf.push(attrs({
				src: "/img/medals/icon_v.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon weibo"
			})), buf.push("/><div"), buf.push(attrs({
				"class": "medal-info weibo"
			})), buf.push("><div"), buf.push(attrs({
				"class": "medal-header"
			})), buf.push("><i"), buf.push(attrs({
				"class": "icon"
			})), buf.push("></i><span"), buf.push(attrs({
				"class": "title"
			})), buf.push(">认证活动</span></div>"), user.user_id == 1 ? (buf.push("<div"), buf.push(attrs({
				"class": "content"
			})), buf.push(">花瓣网（huaban.com）官方</div>")) : (buf.push("<div"), buf.push(attrs({
				"class": "content"
			})), buf.push(">" + escape((interp = page.user.bindings[show_verification].user_info.verified_reason) == null ? "" : interp) + "</div>")), buf.push("<i"), buf.push(attrs({
				"class": "arrow-top"
			})), buf.push("></i></div>"));
			if(user.museUser) {
				buf.push("<img"), buf.push(attrs({
					src: "/img/medals/icon_designer.png",
					"data-baiduimageplus-ignore": 1,
					"class": "v-icon verified"
				})), buf.push("/><div"), buf.push(attrs({
					"class": "muse medal-info verified"
				})), buf.push("><span>花瓣认证设计师</span><div"), buf.push(attrs({
					"class": "content"
				})), buf.push("><div"), buf.push(attrs({
					"class": "cc"
				})), buf.push(">");
				var userCategory = user.museUser.category || [];
				for(var $index = 0, $$l = userCategory.length; $index < $$l; $index++) {
					var cat = userCategory[$index];
					buf.push("<div"), buf.push(attrs({
						"class": "label"
					})), buf.push(">");
					var __val__ = categories[cat];
					buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</div>")
				}
				buf.push("</div><div"), buf.push(attrs({
					"class": "desc"
				})), buf.push(">" + escape((interp = user.museUser.desc) == null ? "" : interp) + "</div></div><i"), buf.push(attrs({
					"class": "arrow-top"
				})), buf.push("></i></div>")
			} else user.status && user.status.designer ? (buf.push("<img"), buf.push(attrs({
				src: "/img/medals/icon_designer.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon verified"
			})), buf.push("/><div"), buf.push(attrs({
				"class": "medal-info verified"
			})), buf.push("><span>花瓣认证设计师</span><i"), buf.push(attrs({
				"class": "arrow-top"
			})), buf.push("></i></div>")) : user.status && user.status.material ? (buf.push("<img"), buf.push(attrs({
				src: "/img/medals/icon_material.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon verified"
			})), buf.push("/><div"), buf.push(attrs({
				"class": "medal-info verified"
			})), buf.push("><span>花瓣认证版权网站</span><i"), buf.push(attrs({
				"class": "arrow-top"
			})), buf.push("></i></div>")) : req.user && req.user.user_id === user.user_id && (buf.push("<a"), buf.push(attrs({
				href: "/muse/register/",
				title: "成为认证设计师",
				target: "_blank"
			})), buf.push("><i"), buf.push(attrs({
				"class": "v-icon unverified"
			})), buf.push("></i></a>"));
			buf.push("</div><ul"), buf.push(attrs({
				"class": "introduction"
			})), buf.push(">"), Number(user.profile.sex) && (user.profile.sex - 1 ? (buf.push("<li><i"), buf.push(attrs({
				id: "intro_sex_woman"
			})), buf.push("></i><em>女</em></li>")) : (buf.push("<li><i"), buf.push(attrs({
				id: "intro_sex_man"
			})), buf.push("></i><em>男</em></li>"))), user.profile.location && (buf.push("<li><i"), buf.push(attrs({
				id: "intro_location"
			})), buf.push("></i><em>来自" + escape((interp = user.profile.location) == null ? "" : interp) + "</em></li>")), user.profile.birthday && typeof dateToHoroscope != "undefined" && (buf.push("<li><i"), buf.push(attrs({
				id: "intro_horoscope"
			})), buf.push("></i><em>" + escape((interp = dateToHoroscope(user.profile.birthday)) == null ? "" : interp) + "座</em></li>")), user.profile.job && (buf.push("<li><i"), buf.push(attrs({
				id: "intro_job"
			})), buf.push("></i><em>" + escape((interp = user.profile.job) == null ? "" : interp) + "</em></li>")), buf.push("</ul><div"), buf.push(attrs({
				"class": "about clearfix"
			})), buf.push(">" + escape((interp = user.profile.about) == null ? "" : interp) + "</div><div"), buf.push(attrs({
				"class": "action-buttons"
			})), buf.push(">");
			if(is_owner) buf.push("<a"), buf.push(attrs({
				href: "/settings/",
				"class": "btn btn14"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 帐号设置</span></a>");
			else {
				user.following ? (buf.push("<a"), buf.push(attrs({
					"data-urlname": "" + user.urlname + "",
					href: "#",
					onclick: "return false;",
					"class": "followuser unfollowuser btn"
				})), buf.push("><span"), buf.push(attrs({
					"class": "text"
				})), buf.push("> 取消关注</span></a>")) : (buf.push("<a"), buf.push(attrs({
					"data-urlname": "" + user.urlname + "",
					title: "关注" + user.username + "",
					href: "#",
					onclick: "return false;",
					"class": "followuser btn rbtn"
				})), buf.push("><span"), buf.push(attrs({
					"class": "text"
				})), buf.push("> 关注</span></a>"));
				if(req.user) {
					var _username = user.username.replace(/'/g, "\\'");
					buf.push("<a"), buf.push(attrs({
						onclick: "app.page.dmController.showDialog({user_id: " + user.user_id + ", username: '" + _username + "'}, true); return false;",
						title: "发送私信给" + user.username + "",
						href: "#",
						"class": "msg btn-with-icon btn"
					})), buf.push("><i"), buf.push(attrs({
						"class": "message"
					})), buf.push("></i></a>")
				}
			}
			buf.push("</div><div"), buf.push(attrs({
				"class": "bindings"
			})), buf.push(">");
			if(user.bindings.weibo && !user.status.hide_weibo && user.bindings.weibo.user_info) {
				var weibo = user.bindings.weibo.user_info;
				buf.push("<a"), buf.push(attrs({
					href: "http://weibo.com/" + (weibo.urlname ? weibo.urlname : weibo.id) + "",
					title: "访问" + user.username + "的微博",
					target: "_blank",
					rel: "nofollow",
					"class": "weibo"
				})), buf.push("></a>")
			}
			user.bindings.douban && !user.status.hide_douban && user.bindings.douban.user_info && (buf.push("<a"), buf.push(attrs({
				href: "http://www.douban.com/people/" + user.bindings.douban.user_info.urlname + "/",
				title: "访问" + user.username + "的豆瓣主页",
				target: "_blank",
				rel: "nofollow",
				"class": "douban"
			})), buf.push("></a>")), user.bindings.renren && !user.status.hide_renren && user.bindings.renren.user_info && (buf.push("<a"), buf.push(attrs({
				href: "http://www.renren.com/profile.do?id=" + user.bindings.renren.user_info.id + "",
				title: "访问" + user.username + "的人人主页",
				target: "_blank",
				rel: "nofollow",
				"class": "renren"
			})), buf.push("></a>")), user.bindings.tqq && !user.status.hide_tqq && user.bindings.tqq.user_info && (buf.push("<a"), buf.push(attrs({
				href: "http://t.qq.com/" + user.bindings.tqq.user_info.urlname + "",
				title: "访问" + user.username + "的腾讯微博主页",
				target: "_blank",
				rel: "nofollow",
				"class": "tqq"
			})), buf.push("></a>")), user.profile.url && (buf.push("<a"), buf.push(attrs({
				href: "" + (user.profile.url.substr(0, 4) == "http" ? user.profile.url : "http://" + user.profile.url) + "",
				title: "访问" + user.username + "的个人主页",
				target: "_blank",
				rel: "nofollow",
				"class": "link"
			})), buf.push("></a>")), buf.push("</div>"), is_owner || (buf.push("<div"), buf.push(attrs({
				title: "举报用户",
				"class": "report-user"
			})), buf.push("></div>")), buf.push("</div>");
			if(user.repins_from && user.repins_from.length) {
				buf.push("<div"), buf.push(attrs({
					"class": "side"
				})), buf.push("><h4>最多转采自</h4>");
				for(var $index = 0, $$l = user.repins_from.length; $index < $$l; $index++) {
					var u = user.repins_from[$index];
					buf.push("<a"), buf.push(attrs({
						href: "/" + u.urlname + "/",
						"class": "item x"
					})), buf.push("><img"), buf.push(attrs({
						src: avatar(u)
					})), buf.push("/>" + escape((interp = u.username) == null ? "" : interp) + ""), isVerified(page.user) && (buf.push("<img"), buf.push(attrs({
						src: "/img/icon_v.png",
						"data-baiduimageplus-ignore": 1,
						"class": "v-icon"
					})), buf.push("/>")), buf.push("</a>")
				}
				buf.push("</div>")
			}
			buf.push("<div"), buf.push(attrs({
				"class": "tabs"
			})), buf.push(">"), user.board_count ? (buf.push("<a"), buf.push(attrs({
				href: "/" + user.urlname + "/",
				"class": "tab " + (!page.people_query && ctx == "boards" ? "active" : "")
			})), buf.push(">" + escape((interp = user.board_count) == null ? "" : interp) + "画板</a>")) : (buf.push("<a"), buf.push(attrs({
				href: "/" + user.urlname + "/",
				rel: "nofollow",
				"class": "tab " + (!page.people_query && ctx == "boards" ? "active" : "")
			})), buf.push(">" + escape((interp = user.board_count) == null ? "" : interp) + "画板</a>")), user.pin_count ? (buf.push("<a"), buf.push(attrs({
				href: "/" + user.urlname + "/pins/",
				"class": "tab " + (!page.people_query && ctx == "pins" ? "active" : "")
			})), buf.push(">" + escape((interp = user.pin_count) == null ? "" : interp) + "采集</a>")) : (buf.push("<a"), buf.push(attrs({
				href: "/" + user.urlname + "/pins/",
				rel: "nofollow",
				"class": "tab " + (!page.people_query && ctx == "pins" ? "active" : "")
			})), buf.push(">" + escape((interp = user.pin_count) == null ? "" : interp) + "采集</a>"));
			var _count = user.like_count;
			user.boards_like_count && (_count += user.boards_like_count), _count ? (buf.push("<a"), buf.push(attrs({
				href: "/" + user.urlname + "/likes/",
				"class": "tab " + (!page.people_query && ctx == "likes" ? "active" : "")
			})), buf.push(">" + escape((interp = _count) == null ? "" : interp) + "喜欢</a>")) : (buf.push("<a"), buf.push(attrs({
				href: "/" + user.urlname + "/likes/",
				rel: "nofollow",
				"class": "tab " + (!page.people_query && ctx == "likes" ? "active" : "")
			})), buf.push(">" + escape((interp = _count) == null ? "" : interp) + "喜欢</a>")), user && user.museUser && (user.muse_board_count ? (buf.push("<a"), buf.push(attrs({
				href: "/" + user.urlname + "/muse_boards/",
				"class": "tab " + (!page.people_query && ctx == "muse_boards" ? "active" : "")
			})), buf.push(">" + escape((interp = user.muse_board_count) == null ? "" : interp) + "原创画板</a>")) : (buf.push("<a"), buf.push(attrs({
				href: "/" + user.urlname + "/muse_boards/",
				rel: "nofollow",
				"class": "tab " + (!page.people_query && ctx == "muse_boards" ? "active" : "")
			})), buf.push(">" + escape((interp = user.muse_board_count) == null ? "" : interp) + "原创画板</a>"))), buf.push("<form"), buf.push(attrs({
				id: "people_search_item",
				action: "/" + user.urlname + "/pins/",
				"class": "searching-unit"
			})), buf.push("><input"), buf.push(attrs({
				value: page.people_query ? _(page.people_query.text) : "",
				name: "q",
				placeholder: req.user && req.user.user_id == user.user_id ? "搜索我的采集" : "搜索TA的采集"
			})), buf.push("/><a"), buf.push(attrs({
				onclick: "return false;",
				"class": "go"
			})), buf.push("></a></form></div></div>"), qt && (buf.push("<div"), buf.push(attrs({
				"class": "search-status"
			})), buf.push(">找到 " + escape((interp = qn) == null ? "" : interp) + " 个与<strong>" + escape((interp = qt) == null ? "" : interp) + "</strong>相关的结果</div>"));
			var __val__ = emerge(body_tpl, {
				user: user,
				users: page.users || null,
				req: req
			});
			buf.push(null == __val__ ? "" : __val__), buf.push('</div></div><script>(function(){app.initFollowButtons(),app.initSearchForms("#people_search_item"),app.initPureFollowUserButtons({onFollowSuccess:function(a){a.getElement(".text").innerHTML="取消关注",a.removeClass("rbtn")},onUnfollowSuccess:function(a){a.getElement(".text").innerHTML="关注",a.addClass("rbtn")}}),app.initFollowExploreButtons({onFollowSuccess:function(a){a.removeClass("rbtn"),a.getElement(".text").innerHTML="已关注"},onUnfollowSuccess:function(a){a.addClass("rbtn"),a.getElement(".text").innerHTML="关注"}}),app.initPureFollowUserButtons({buttonSelector:".item-followuser",unfollowButtonClass:"item-unfollowuser"}),app.initLikeButtons(),app.initAddCommentButtons(),app.initShowMoreButtons(),app.initGifButtons()})(),function(){app.view.addEvent("click:relay(.board-cover-edit)",function(c){c.stop(),!app.dialog||!app.dialog.boards?(app.dialog={},app.dialog.boards={},app.page.user.boards.map(function(a){app.dialog.boards[a.board_id]=a})):app.page.user.boards.map(function(a){app.dialog.boards[a.board_id]=a});var d=this,e=d.getParent(".Board").get("data-id");$$(".cover-change")&&$$(".cover-change").removeClass("cover-change"),d.getParent(".Board").addClass("cover-change"),app.showDialog("board_cover"),b(e),a(e);var f=document.getElement("#board_cover");f.getElements(".left").addClass("none"),f.getElements(".none").length&&f.getElements(".right").removeClass("none");var g="设置封面 / "+app.dialog.boards[e].title;document.getElement("#board_cover h2").set("text",g),document.getElement("#board_cover .prompt")&&document.getElement("#board_cover .prompt").hide(),document.id("board_cover").getElement(".cover").show(),document.getElement(".cover-imgs").setStyle("left","226px")});var a=function(a){document.id("board_cover").getElements(".cover-option input:checked").set("checked",""),app.dialog.boards[a].cover?(document.getElement("#board_cover .cover-option").show(),document.getElement("#board_cover .cover-option .sub-arrow").show(),document.id("board_cover").getElement("#cover-option-default").set("checked",""),document.id("board_cover").getElement("#cover-option-custom").set("checked","checked")):document.getElement("#board_cover .cover-option").hide(),document.id("board_cover").addEvent("click:relay(.cover-option span)",function(a){document.id("board_cover").getElements(".cover-option input:checked").set("checked",""),this.getElement("input").set("checked","checked"),this.hasClass("first")?(document.getElement("#board_cover .cover").hide(),document.getElement("#board_cover .cover-option .sub-arrow").hide()):(document.getElement("#board_cover .cover").show(),document.getElement("#board_cover .cover-option .sub-arrow").show())})},b=function(a){var b=app.dialog.boards[a].pins;app.dialog.pinsNum=b.length,app.dialog.board_id=a,app.dialog.moveIndex=0;var c="";b.map(function(a){var b="//"+app.settings.imgHosts[a.file.bucket]+"/"+a.file.key+"_sq235";c+="<li><img src=\'"+b+"\' data-id= \'"+a.pin_id+"\' />"+"</li>"}),document.getElement(".cover-imgs").set("html",c)}}(),function(){function f(a){a?(c.hide(),b.set("src",a).setStyle("opacity",1),$("nav_user").getElement("img").set("src",a.replace("sq140sf","sq75sf"))):(c.show(),b.setStyle("opacity",.3))}function g(a){(new Request.JSON({url:"/settings",method:"post",data:{"user[avatar]":a},onSuccess:function(a){a.err?app.error(a.msg):app.msg("头像已修改")}})).send()}var a=$$(".avatar-unit")[0],b=a.getElement(".current-avatar"),c=a.getElements("img.load"),d=a.getElement(".change-avatar .btn");if(!d)return;var e=new Uploadr(d);e.addEvents({start:function(){f()},complete:function(a){app.req.user.avatar=a;var b=app.imgURL(a,"sq140sf");new Asset.image(b,{onload:function(){f(b)}}),g(a.id)}})}(),$$(".report-user").addEvent("click",function(){return report_type="account",report_id=app.page.user.user_id,app.showDialog("report"),!1}),function(){var a=document.getElement(".head-line"),b=a.getElement(".v-icon.verified"),c=a.getElement(".verified.medal-info"),d=a.getElement(".v-icon.weibo"),e=a.getElement(".medal-info.weibo");b&&(new MenuController({menu:c,trigger:b,showupDelay:100}),c.addEvent("menu_show",function(){e&&e.hide();var a=b.getPosition().x,c=b.getPosition().y,d=this.getStyle("width").toInt(),f=c+30-window.getScroll().y,g=a-d/2;this.setStyle("top",f),this.setStyle("left",g)})),d&&(new MenuController({menu:e,trigger:d,showupDelay:100}),e.addEvent("menu_show",function(){c&&c.hide();var a=d.getPosition().x,b=d.getPosition().y,e=this.getStyle("width").toInt(),f=b+30-window.getScroll().y,g=a-e/2;this.setStyle("top",f),this.setStyle("left",g)}))}(),function(){app._gaq_promotion&&app._gaq_promotion()}()</script>')
		}
		return buf.join("")
	}, __t["base/people_likes"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/people_layout", {
				req: req,
				user: page.user,
				settings: settings,
				ctx: "likes",
				body_tpl: "base/people_likes_body",
				page: page
			});
			buf.push(null == __val__ ? "" : __val__)
		}
		return buf.join("")
	}, __t["base/people_likes_boards"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/people_layout", {
				req: req,
				user: page.user,
				settings: settings,
				ctx: "likes",
				body_tpl: "base/people_likes_boards_body",
				page: page
			});
			buf.push(null == __val__ ? "" : __val__)
		}
		return buf.join("")
	}, __t["base/people_likes_boards_body"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "desc-bar"
			})), buf.push("><ul"), buf.push(attrs({
				"class": "pin-board-switcher clearfix"
			})), buf.push("><li"), buf.push(attrs({
				"class": "first"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + user.urlname + "/likes/",
				"class": "pin-link"
			})), buf.push(">" + escape((interp = user.like_count) == null ? "" : interp) + " 采集</a></li><li"), buf.push(attrs({
				"class": "last selected"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + user.urlname + "/likes/boards/"
			})), buf.push(">" + escape((interp = user.boards_like_count) == null ? "" : interp) + " 画板</a></li></ul></div><div"), buf.push(attrs({
				id: "waterfall"
			})), buf.push(">");
			for(var boards = user.likes_boards, i = 0, l = boards.length; i < l; i++) {
				var board = boards[i],
					__val__ = emerge("base/board_item", {
						user: req.user,
						board: board
					});
				buf.push(null == __val__ ? "" : __val__)
			}
			buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/people_likes_body"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "desc-bar"
			})), buf.push("><ul"), buf.push(attrs({
				"class": "pin-board-switcher clearfix"
			})), buf.push("><li"), buf.push(attrs({
				"class": "first selected"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + user.urlname + "/likes/",
				"class": "pin-link"
			})), buf.push(">" + escape((interp = user.like_count) == null ? "" : interp) + " 采集</a></li><li"), buf.push(attrs({
				"class": "last"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + user.urlname + "/likes/boards/"
			})), buf.push(">" + escape((interp = user.boards_like_count) == null ? "" : interp) + " 画板</a></li></ul></div><div"), buf.push(attrs({
				id: "waterfall"
			})), buf.push(">");
			for(var pins = user.likes, i = 0, l = pins.length; i < l; i++) {
				var pin = pins[i],
					__val__ = emerge("base/pin_item", {
						user: pin.user,
						pin: pin,
						board: pin.board
					});
				buf.push(null == __val__ ? "" : __val__)
			}
			buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/people_list_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"data-seq": "" + user.seq + "",
				"class": "person"
			})), buf.push("><div"), buf.push(attrs({
				"class": "PersonPins"
			})), buf.push(">");
			for(var $index = 0, $$l = user.pins.length; $index < $$l; $index++) {
				var pin = user.pins[$index];
				buf.push("<a"), buf.push(attrs({
					href: "/pins/" + pin.pin_id + "/",
					"class": "img"
				})), buf.push("><img"), buf.push(attrs({
					src: imgURL(pin.file, "sq75"),
					"data-baiduimageplus-ignore": 1
				})), buf.push("/></a>")
			}
			buf.push("</div><a"), buf.push(attrs({
				href: "/" + user.urlname + "/",
				"class": "PersonImage img"
			})), buf.push("><img"), buf.push(attrs({
				src: "" + this.avatar(user) + "",
				alt: "" + user.username + "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a><p"), buf.push(attrs({
				"class": "PersonIdentity"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + user.urlname + "/"
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + "</a></p>"), req.user && user.user_id === req.user.user_id ? (buf.push("<a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "disabled btn btn14 rbtn"
			})), buf.push("><strong> 你</strong><span></span></a>")) : user.following ? (buf.push("<a"), buf.push(attrs({
				"data-id": "" + user.urlname + "",
				href: "#",
				onclick: "return false;",
				"class": "unfollowuser btn btn14 wbtn"
			})), buf.push("><strong> 取消关注</strong><span></span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": "" + user.urlname + "",
				href: "#",
				onclick: "return false;",
				"class": "followuser btn btn14 rbtn"
			})), buf.push("><strong> 关注</strong><span></span></a>")), buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/people_muse_boards"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/people_layout", {
				req: req,
				user: page.user,
				settings: settings,
				ctx: "muse_boards",
				body_tpl: "base/people_muse_boards_body",
				page: page
			});
			buf.push(null == __val__ ? "" : __val__)
		}
		return buf.join("")
	}, __t["base/people_muse_boards_body"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, self = req.user && req.user.user_id === user.user_id,
				is_sort_able = self ? "sortable" : "";
			buf.push("<div"), buf.push(attrs({
				id: "waterfall",
				"class": "sort-lists clearfix " + ("" + is_sort_able + "")
			})), buf.push(">"), self && (buf.push("<div"), buf.push(attrs({
				onclick: "app.requireLogin(function() {app.showDialogBox('create_board');});",
				"class": "wfc add-board"
			})), buf.push("><div"), buf.push(attrs({
				"class": "inner"
			})), buf.push("><i></i><span>创建原创画板</span></div></div>"));
			for(var $index = 0, $$l = user.boards.length; $index < $$l; $index++) {
				var b = user.boards[$index];
				if(b && (b.is_private != 2 || b.pin_count > 0 && b.pins && b.pins[0])) {
					var __val__ = emerge("base/board_item", {
						board: b,
						user: this.req.user,
						show_cover_button: !0
					});
					buf.push(null == __val__ ? "" : __val__)
				}
			}
			buf.push('</div><script>var main=document.getElement(".sortable");if(main){var sorting=!1,container=$$(".sortable")[0],sortable,cancelBtn,oldorder,ContainTop,ContainHeight,start=function(){sorting=!0;var a;sortable=new Sortables(".sortable",{clone:!0,childrenSelector:".Board:not(.default-board)",onStart:function(a,b){app.view.addEvent("mousemove",app.boardListScroll),a.setStyles({border:"dashed 3px #DDD",background:"transparent","box-shadow":"none",width:b.getStyle("width").toInt()-6,height:b.getStyle("height").toInt()-6}),a.getChildren().setStyles({visibility:"hidden"}),a.addClass("sort"),b.setStyles({"z-index":999999,opacity:.6,filter:"alpha(opacity=40)"})},onComplete:function(a){app.view.removeEvent("mousemove",app.boardListScroll),a.getChildren().setStyles({visibility:""}),a.set("style",""),complete()}}),oldorder=sortable.serialize(0,function(a){return a.get("data-id")})},complete=function(){var a=sortable.serialize(0,function(a){return a.get("data-id")});oldorder.join("-")!=a.join("-")?(new Request.JSON({url:"/muse_boards/sort/",data:{ids:a.join(",")},onSuccess:onComplete(a,!0)})).post():onComplete(a,!0)},onComplete=function(a,b){oldorder=a,sorting=!1};app.boardListScroll=function(a){var b=window.innerHeight;ContainTop=container.getTop(),ContainHeight=container.getHeight();var c,d;b-a.client.y<50?(d=window.getScroll(),c=Math.min(d.y+50,ContainTop+ContainHeight-window.innerHeight),window.scrollTo(d.x,c)):a.client.y<50&&(d=window.getScroll(),c=Math.max(d.y-50,ContainTop-55),window.scrollTo(d.x,c))},sorting?complete():start()}(function(){var a=function(){var a=document.getElement("#waterfall");if(!document.getElement("#user_page .loading"))var c=(new Element("div",{"class":"loading"})).inject(a,"after").hide().set("html",\'<img src="/img/loading.gif"><span>正在加载...</span>\');else var c=document.getElement("#user_page .loading");var d=window.getSize().y,e=window.getScroll().y,f=a.getCoordinates().bottom;if(f-e-d<150&&!app.page.triggered&&!app.page.end){app.page.triggered=!0;if(!a.getElement(".Board")){app.page.end=!0;return}var g=a.getLast(".Board:not(.sort)").get("data-id");(new Request.JSON({url:app.page.$url,data:{max:g,limit:10,wfl:1},noCache:!0,onRequest:function(){c.show()},onSuccess:function(d){c.hide();if(d.err){app.error(d.msg||app.COMMON_ERRMSG);return}if(d&&d.user&&d.user.boards.length>0){var e="";app.page.user&&app.page.user.boards&&(app.page.user.boards=app.page.user.boards.concat(d.user.boards)),d.user.boards.each(function(a){e+=app.renderSync("base/board_item",{board:a,user:app.req.user,show_cover_button:!0})}),Elements.from(e).inject(a),b()}else app.page.end=!0,c.set("html",\'<img src="/img/end.png">\').show()}})).get()}},b=function(){if(main){var a=$$(".sortable .Board:not(.inited)");sortable.addItems(a),a.addClass("inited")}app.page.triggered=!1};main&&$$(".sortable .Board").addClass("inited"),app.loadBoardEvent||(app.loadBoardEvent=function(){var b;window.clearTimeout(b),b=window.setTimeout(function(){a()},500)},window.addEvent("scroll",app.loadBoardEvent))})()</script>')
		}
		return buf.join("")
	}, __t["base/people_pins"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/people_layout", {
				req: req,
				user: page.user,
				ctx: "pins",
				settings: settings,
				body_tpl: "base/people_pins_body",
				page: page
			});
			buf.push(null == __val__ ? "" : __val__)
		}
		return buf.join("")
	}, __t["base/people_pins_body"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "waterfall"
			})), buf.push(">"), req.user && req.user.user_id == user.user_id && (buf.push("<div"), buf.push(attrs({
				onclick: "app.showUploadDialog();",
				"class": "add-pin wfc"
			})), buf.push("><div"), buf.push(attrs({
				"class": "inner"
			})), buf.push("><i></i><span>添加采集</span></div></div>"));
			for(var $index = 0, $$l = user.pins.length; $index < $$l; $index++) {
				var pin = user.pins[$index],
					__val__ = emerge("base/pin_item", {
						user: user,
						pin: pin,
						board: pin.board
					});
				buf.push(null == __val__ ? "" : __val__)
			}
			buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/people_profile"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, req = req || app.req;
			buf.push("<div"), buf.push(attrs({
				id: "Profile"
			})), buf.push("><div"), buf.push(attrs({
				"class": "profile-basic"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(user.urlname) + "/",
				title: escape(user.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				width: "54",
				height: "54",
				src: avatar(user),
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a><a"), buf.push(attrs({
				href: "/" + user.urlname + "/",
				"class": "userlink"
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + ""), isVerified(page.user) && (buf.push("<img"), buf.push(attrs({
				src: "/img/icon_v.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon"
			})), buf.push("/>")), buf.push("</a><a"), buf.push(attrs({
				href: "/settings/",
				title: "帐号设置",
				"class": "settings"
			})), buf.push("></a></div><div"), buf.push(attrs({
				"class": "profile-stats"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + user.urlname + "/pins/"
			})), buf.push("><strong>" + escape((interp = user_info.pin_count) == null ? "" : interp) + "</strong>采集</a><a"), buf.push(attrs({
				href: "/" + user.urlname + "/",
				"class": "middle"
			})), buf.push("><strong>" + escape((interp = user_info.board_count) == null ? "" : interp) + "</strong>画板</a><a"), buf.push(attrs({
				href: "/" + user.urlname + "/followers/"
			})), buf.push("><strong>" + escape((interp = user_info.follower_count) == null ? "" : interp) + "</strong>粉丝</a></div>"), user.status.newbietask === 1 && (buf.push("<div"), buf.push(attrs({
				style: "display: none",
				"class": "unit"
			})), buf.push("><div"), buf.push(attrs({
				id: "task_start_tip"
			})), buf.push(">欢迎来到花瓣网，跟着花小瓣玩转花瓣吧！<div"), buf.push(attrs({
				"class": "start-button"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "cls"
			})), buf.push("></div></div><div"), buf.push(attrs({
				id: "task_progress"
			})), buf.push("><h3>用花瓣采集你喜欢的</h3><ol><li>创建画板</li><li>把精彩图片采集到画板中</li></ol></div></div><div"), buf.push(attrs({
				id: "task_modules",
				style: "display:none"
			})), buf.push("><div"), buf.push(attrs({
				"class": "module-exit module"
			})), buf.push("><div"), buf.push(attrs({
				"class": "cancel"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "exit"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "module-step1-1 module"
			})), buf.push("><div"), buf.push(attrs({
				"class": "next"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "cls"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"data-relative-to": "#elevator_item .plus",
				"data-offset-x": "9",
				"data-offset-y": "9",
				"class": "module-step1-2 module pos"
			})), buf.push("><div"), buf.push(attrs({
				"class": "add"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "point"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"data-relative-to": "#elevator_item .plus-popup .add-board-item",
				"data-offset-x": "0",
				"data-offset-y": "47",
				"class": "module-step1-3 module pos"
			})), buf.push("><div"), buf.push(attrs({
				"class": "add"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "point"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"data-relative-to": "#CreateBoard .CategoryPicker",
				"data-offset-x": "360",
				"data-offset-y": "100",
				"class": "module-step1-4 module pos"
			})), buf.push("><div"), buf.push(attrs({
				"data-relative-to": "#CreateBoard .close-btn",
				"data-offset-x": "0",
				"data-offset-y": "0",
				"class": "fake-close pos"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "module-step1-5 module"
			})), buf.push("><div"), buf.push(attrs({
				"class": "next"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "cls"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "module-step2-1 module"
			})), buf.push("><div"), buf.push(attrs({
				"class": "text1"
			})), buf.push(">看到网页上不错的设计素材、优秀的摄影作品、好看的服饰、发型等美图，通过花瓣采集工具，点击一下，就可以把任意网站的图片、视频、网页等采集到画板中。点击图片还能回到原网页。</div><div"), buf.push(attrs({
				"class": "text2"
			})), buf.push(">从电脑中选择图片，上传，还能同步到第三方平台，让好友了解你的最新状态。</div><div"), buf.push(attrs({
				"class": "text3"
			})), buf.push(">点击转采按钮，即可把其他用户的美图转到自己的画板中，因为共同的兴趣，说不定还能和他们成为好友哦。</div><a"), buf.push(attrs({
				target: "_blank",
				href: "/about/goodies/",
				"class": "go"
			})), buf.push("></a><a"), buf.push(attrs({
				target: "_blank",
				href: "/about/goodies/",
				style: "display:none",
				"class": "go-goodies"
			})), buf.push("></a><div"), buf.push(attrs({
				"class": "cls"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "module-step2-2 module"
			})), buf.push("><div"), buf.push(attrs({
				"class": "next"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "cls"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "module-welcome module"
			})), buf.push("><div"), buf.push(attrs({
				"class": "start"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "cls"
			})), buf.push("></div></div></div>"));
			if(suggestion_friends.length > 0) {
				buf.push("<div"), buf.push(attrs({
					"class": "all-friends convo"
				})), buf.push(">已在花瓣的好友<a"), buf.push(attrs({
					href: "/friends/weibo/"
				})), buf.push(">查看全部</a></div>");
				var cnt = 0;
				for(var $index = 0, $$l = suggestion_friends.length; $index < $$l; $index++) {
					var f = suggestion_friends[$index];
					if(cnt >= 3) break;
					cnt += 1;
					var __val__ = emerge("base/suggest_friend", {
						friend: f
					});
					buf.push(null == __val__ ? "" : __val__)
				}
			} else buf.push("<div"), buf.push(attrs({
				"class": "profile-acts convo"
			})), buf.push("><div"), buf.push(attrs({
				"class": "links"
			})), buf.push("><a"), buf.push(attrs({
				href: "/friends/weibo/",
				"class": "btn wbtn"
			})), buf.push("><strong><em></em> 查找在花瓣的好友</strong><span></span></a></div></div>");
			buf.push('</div><script>(function(){var a=[],b=[],c=$("Profile").getElement(".profile-acts"),d=$("Profile");app.initFollowUserButtons(function(a){function c(c,d){if(d){var f=a.getParent(".suggestion").get("data-id");f&&!~b.indexOf(f)&&b.push(f),e(a.getParent(".suggestion"))}else(new Button(c.removeClass("unfollow"))).setTitle("关注")}$$("a.unfollowuser").each(function(b){c(b,a.hasClass("unfollowuser"))})}),d&&d.addEvent("click:relay(.suggestion a.mute)",function(a){var c=a.target;c.get("tag")!=="a"&&(c=c.getParent("a"));var d=c.get("data-friend-urlname"),f=c.get("data-service-name");(new Request.JSON({url:"/friends_suggest/mute/",data:{friend_urlname:d,service_name:f},onSuccess:function(a){!~b.indexOf(d)&&b.push(d),e(c.getParent(".suggestion"))}})).post()});var e=function(b){b&&b.dispose(),a.length>0?f():(new Request.JSON({url:"/friends_suggest/",data:{limit:10},onSuccess:function(b){b&&b.suggestion_friends&&b.suggestion_friends.length>0&&(a=b.suggestion_friends,f())}})).get(),setTimeout(function(){app.page.$waterfall&&app.page.$waterfall.reposition(!0)},100)},f=function(){var e=a.shift();while(e){var f=d.getElement(".suggestion[data-id="+e.urlname+"]");if(~b.indexOf(e.urlname)||f){e=a.shift();continue}app.render("base/suggest_friend",{friend:e},function(a,b){Elements.from(b)[0].inject(c,"before"),a&&Browser.exec(a)}),setTimeout(function(){app.page.$waterfall&&app.page.$waterfall.reposition(!0)},100);if(d.getElements(".suggestion").length<3){e=a.shift();continue}break}}})(),function(){document.id("task_start_tip")&&(Asset.css("/css/user_task.css"),Asset.javascript("/js/user_task.js"))}()</script>')
		}
		return buf.join("")
	}, __t["base/person_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"data-seq": user.seq,
				"class": "person-item"
			})), buf.push("><div"), buf.push(attrs({
				"class": "mask"
			})), buf.push("></div><a"), buf.push(attrs({
				href: "/" + escape(user.urlname) + "/",
				title: escape(user.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(user, "sq120sf"),
				"data-baiduimageplus-ignore": 1,
				"class": "avt"
			})), buf.push("/></a><a"), buf.push(attrs({
				href: "/" + user.urlname + "/",
				"class": "username"
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + ""), user.extra && user.extra.is_museuser && (buf.push("<img"), buf.push(attrs({
				src: "/img/medals/icon_designer.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon"
			})), buf.push("/>")), isVerified(page.user) && (buf.push("<img"), buf.push(attrs({
				src: "/img/icon_v.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon"
			})), buf.push("/>")), buf.push("</a>");
			if(typeof bindtype != "undefined") {
				var bindship = user[bindtype],
					urlname = bindship.user_info && (bindship.user_info.urlname || "u/" + bindship.user_info.id) || "";
				bindtype == "weibo" ? (buf.push("<a"), buf.push(attrs({
					href: "http://weibo.com/" + urlname + "/",
					target: "_blank",
					"class": "bindship"
				})), buf.push("><i"), buf.push(attrs({
					"class": "weibo"
				})), buf.push("></i>" + escape((interp = bindship.user_info.username) == null ? "" : interp) + "</a>")) : bindtype == "douan" ? (buf.push("<a"), buf.push(attrs({
					href: "http://www.douban.com/people/" + urlname + "/",
					target: "_blank",
					"class": "bindship"
				})), buf.push("><i"), buf.push(attrs({
					"class": "douban"
				})), buf.push("></i>" + escape((interp = bindship.user_info.username) == null ? "" : interp) + "</a>")) : bindtype == "renren" ? (buf.push("<a"), buf.push(attrs({
					href: "http://www.renren.com/profile.do?id=" + bindship.user_info.id + "",
					target: "_blank",
					"class": "bindship"
				})), buf.push("><i"), buf.push(attrs({
					"class": "renren"
				})), buf.push("></i>" + escape((interp = bindship.user_info.username) == null ? "" : interp) + "</a>")) : bindtype == "tqq" && (buf.push("<a"), buf.push(attrs({
					href: "http://t.qq.com/" + urlname + "",
					target: "_blank",
					"class": "bindship"
				})), buf.push("><i"), buf.push(attrs({
					"class": "tqq"
				})), buf.push("></i>" + escape((interp = bindship.user_info.username) == null ? "" : interp) + "</a>"))
			}
			buf.push("<div"), buf.push(attrs({
				"class": "person-item-meta"
			})), buf.push("><span"), buf.push(attrs({
				"class": "first-meta"
			})), buf.push(">");
			var __val__ = user.board_count + " 画板";
			buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</span><span>");
			var __val__ = user.pin_count + " 采集";
			buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</span></div>");
			if(locals.pins) {
				buf.push("<div"), buf.push(attrs({
					"class": "pins"
				})), buf.push(">");
				for(var i = 0, $$l = pins.length; i < $$l; i++) {
					var pin = pins[i];
					if(i < 3) {
						buf.push("<a"), buf.push(attrs({
							href: "/pins/" + pin.pin_id + "",
							"class": "img x"
						})), buf.push(">");
						var __val__ = img(pin.file, "sq75");
						buf.push(null == __val__ ? "" : __val__), buf.push("</a>")
					}
				}
				buf.push("</div>")
			}
			buf.push("<div"), buf.push(attrs({
				"class": "btn-bar"
			})), buf.push(">");
			if(!req.user || req.user.user_id !== user.user_id) user.following ? (buf.push("<a"), buf.push(attrs({
				"data-urlname": user.urlname,
				href: "#",
				onclick: "return false;",
				"class": "item-followuser item-unfollowuser " + (user.following_me ? "following-me" : "") + " " + "btn"
			})), buf.push("><i></i><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 取消关注</span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-urlname": user.urlname,
				href: "#",
				onclick: "return false;",
				"class": "item-followuser " + (user.following_me ? "following-me" : "") + " " + "btn"
			})), buf.push("><i></i><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 关注</span></a>"));
			buf.push("</div></div>")
		}
		return buf.join("")
	}, __t["base/pin_ad"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, url = locals.url || "";
			if(ad && ad.length) {
				var types = ["", "推广", "活动"],
					PIN_WIDTH = 236,
					loc = (/^\/pins\/\d+/.test(url) ? "/pins/" : url).replace(/\//ig, "").replace(/\?.*/, "") || "user-home";
				for(var $index = 0, $$l = ad.length; $index < $$l; $index++) {
					var a = ad[$index];
					buf.push("<div"), buf.push(attrs({
						"data-id": "" + a.id + "",
						"class": "pin wfc ad"
					})), buf.push(">");
					var image = a.image;
					buf.push("<a"), buf.push(attrs({
						href: "" + a.link + "",
						target: "_blank",
						onclick: 'try{_czc.push(["_trackEvent","ads", "click", "' + loc + "-" + a.id + '", 1]);}catch(e){};',
						"class": "img x layer-view"
					})), buf.push(">");
					var __val__ = img(image, "fw" + PIN_WIDTH, {
						alt: ""
					});
					buf.push(null == __val__ ? "" : __val__), buf.push("<div"), buf.push(attrs({
						"class": "cover"
					})), buf.push("></div></a>"), 1 === a.type && "/" === url ? (buf.push("<div"), buf.push(attrs({
						"class": "content"
					})), buf.push("><b"), buf.push(attrs({
						"class": "title"
					})), buf.push(">点广告 = 赞赏花瓣<a"), buf.push(attrs({
						href: "http://blog.huaban.com/?p=16742",
						target: "_blank",
						"class": "icon ad help"
					})), buf.push("></a></b><label"), buf.push(attrs({
						"class": "text"
					})), buf.push("><div"), buf.push(attrs({
						"class": "visible"
					})), buf.push(">推广采集</div><div"), buf.push(attrs({
						"class": "invisible"
					})), buf.push("><i"), buf.push(attrs({
						"class": "icon ad close"
					})), buf.push("></i><a"), buf.push(attrs({
						onclick: "return hideAd(this);",
						"class": "brown-link"
					})), buf.push(">隐藏此广告</a></div></label></div>")) : (0 < a.type && (buf.push("<div"), buf.push(attrs({
						"class": "type"
					})), buf.push(">" + escape((interp = types[a.type]) == null ? "" : interp) + "</div>")), "/" === url && /fixed/i.test(a.placement) && (buf.push("<a"), buf.push(attrs({
						href: "#",
						title: "关闭",
						onclick: "return hideAd(this);",
						"class": "icon closable"
					})), buf.push("></a>"))), buf.push("</div>")
				}
			}
			buf.push('<script>function hideAd(a){var b=a.getParents(".pin.wfc.ad")[0];if(!b)return;var c=b.get("data-id"),d="_ad_"+c;Cookie.write(d,!0,{duration:.5}),window.location.reload()}(function(){var a=document.getElements(".pin.wfc.ad"),b=location.pathname;if("/"!==b)return;a.each(function(a){var b=a.get("data-id"),c="_ad_"+b,d=Cookie.read(c);"true"===d&&a.destroy()})})()</script>')
		}
		return buf.join("")
	}, __t["base/pin_create"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, main_id = Math.floor(1e6 * Math.random());
			buf.push("<div"), buf.push(attrs({
				id: "uniq_" + main_id + "",
				"class": "pin-create"
			})), buf.push("><div"), buf.push(attrs({
				"class": "preview"
			})), buf.push(">"), locals.media === "from_chrome_extension" ? (buf.push("<img"), buf.push(attrs({
				"data-baiduimageplus-ignore": 1,
				"class": "waiting"
			})), buf.push("/>")) : (buf.push("<img"), buf.push(attrs({
				src: locals.media || "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/>")), buf.push("<div"), buf.push(attrs({
				style: locals.h / locals.w > 1 ? "" : "display: none",
				"class": "stop"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "right-part"
			})), buf.push(">");
			var __val__ = emerge("base/board_list", {
				currentBoard: locals.current_board || "default"
			});
			buf.push(null == __val__ ? "" : __val__), buf.push("<div"), buf.push(attrs({
				"class": "text-block"
			})), buf.push("><textarea"), buf.push(attrs({
				"class": "clear-input description"
			})), buf.push(">" + escape((interp = locals.text || locals.name) == null ? "" : interp) + "</textarea><div"), buf.push(attrs({
				"class": "tag-bar"
			})), buf.push("><div"), buf.push(attrs({
				"class": "normal"
			})), buf.push("><span"), buf.push(attrs({
				"class": "title"
			})), buf.push(">推荐标签</span><span"), buf.push(attrs({
				"class": "tags"
			})), buf.push("></span></div><div"), buf.push(attrs({
				style: "display: none",
				"class": "more"
			})), buf.push("><span"), buf.push(attrs({
				"class": "title"
			})), buf.push(">更多标签</span><span"), buf.push(attrs({
				"class": "tags"
			})), buf.push("></span></div><div"), buf.push(attrs({
				style: "display: none",
				"class": "tip"
			})), buf.push(">通过给采集添加 #标签#，更好地整理采集</div></div></div></div><div"), buf.push(attrs({
				"class": "bottom-part"
			})), buf.push(">");
			var bindings = [];
			req.user.bindings.weibo && bindings.push({
				key: "weibo",
				value: "新浪微博"
			}), req.user.bindings.qzone && bindings.push({
				key: "qzone",
				value: "QQ空间"
			}), req.user.bindings.renren && bindings.push({
				key: "renren",
				value: "人人"
			});
			var share_bit_flags = {
				weibo: 1,
				qzone: 2,
				tqq: 4,
				douban: 8,
				renren: 16
			};
			if(bindings.length > 0) {
				buf.push("<div"), buf.push(attrs({
					"class": "shares"
				})), buf.push("><span>分享到：</span>");
				for(var i = 0, $$l = bindings.length; i < $$l; i++) {
					var binding = bindings[i];
					i < 2 && (buf.push("<div"), buf.push(attrs({
						"data-key": binding.key,
						"data-flag": share_bit_flags[binding.key],
						"class": "share " + (binding.key + (req.user.status.share & share_bit_flags[binding.key] ? " active" : ""))
					})), buf.push("><div"), buf.push(attrs({
						"class": "selection"
					})), buf.push("></div>" + escape((interp = binding.value) == null ? "" : interp) + "</div>"))
				}
				buf.push("</div>")
			}
			buf.push("<div"), buf.push(attrs({
				"class": "buttons"
			})), buf.push(">"), locals.cancel && (buf.push("<a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "cancel btn btn18"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 取消</span></a>")), buf.push("<a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "action btn btn18 rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push('> 采下来</span></a></div></div></div><script>(function(){var a=document.id("uniq_' + escape((interp = main_id) == null ? "" : interp) + '"),b=a.getElement(".board-list"),c=a.getElement(".tag-bar .normal"),d=a.getElement(".tag-bar .more"),e=a.getElement(".tag-bar .tip"),f=c.getElement(".tags"),g=a.getElement("textarea"),h=a.getElement(".preview img"),i=a.getElement(".preview .stop"),j=function(){var a=b.get("data-board-id"),g=null;app.req.user.boards.each(function(b){b.board_id==a&&(g=b.recommend_tags)}),d.hide();if(!g||!g.length)c.hide(),e.show();else{c.show(),e.hide(),f.empty();for(var h=0;h<g.length;h++)(new Element(".tag",{html:g[h]})).inject(f)}};app.req.user.boards?j():(c.hide(),e.show()),a.getElements(".shares .share").addEvent("click",function(){this.toggleClass("active")}),b.master.addEvent("select",j),f.addEvent("click:relay(.tag)",function(){if(~g.value.indexOf("#"+this.innerHTML+"#"))return;g.value+=" #"+this.innerHTML+"#"}),new Autocompleter.Contacts.At(g),h.onload=function(){this.height>this.width?i.show():i.hide()}})()</script>')
		}
		return buf.join("")
	}, __t["base/pin_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, _suffix = typeof suffix == "undefined" || !suffix ? "fw236" : suffix,
				promt = typeof promotion == "undefined" || !promotion ? null : promotion,
				seq = promt ? "" : pin.seq ? pin.seq : pin.pin_id,
				extraCssClass = promt ? "promotion" : "",
				board_title = board ? board.is_private == 2 ? "待归类采集" : board.title : "",
				md = "",
				isFollow = this.page.$url.substring(0, 8) == "/explore" ? "nofollow" : "";
			this.page.$url.indexOf("/ent/") != -1 && (md = "?md=ent"), buf.push("<div"), buf.push(attrs({
				"data-id": "" + pin.pin_id + "",
				"data-seq": seq,
				"data-source": "" + pin.source + "",
				"data-created-at": "" + pin.created_at + "",
				"class": "pin wfc " + ("" + extraCssClass + "")
			})), buf.push("><div"), buf.push(attrs({
				"class": "hidden"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + user.urlname + "/" + md + ""
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + "</a>采集到<a"), buf.push(attrs({
				href: "/boards/" + pin.board_id + ""
			})), buf.push(">" + escape((interp = board_title) == null ? "" : interp) + "</a></div><div"), buf.push(attrs({
				"class": "actions"
			})), buf.push("><div"), buf.push(attrs({
				"class": "right"
			})), buf.push(">"), this.req.user && pin.user_id === this.req.user.user_id ? (buf.push("<a"), buf.push(attrs({
				href: "/pins/" + pin.pin_id + "/edit/" + md + "",
				"class": "edit btn btn14"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push(">编辑</span></a>")) : pin.liked ? (buf.push("<a"), buf.push(attrs({
				"data-id": "" + pin.pin_id + "",
				title: "喜欢",
				href: "#",
				onclick: "return false;",
				"class": "unlike btn-with-icon btn btn14"
			})), buf.push("><i"), buf.push(attrs({
				"class": "heart"
			})), buf.push("></i><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> " + escape((interp = pin.like_count) == null ? "" : interp) + "</span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": "" + pin.pin_id + "",
				title: "喜欢",
				href: "#",
				onclick: "return false;",
				"class": "like btn-with-icon btn btn14"
			})), buf.push("><i"), buf.push(attrs({
				"class": "heart"
			})), buf.push("></i><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> " + escape((interp = pin.like_count ? pin.like_count : "") == null ? "" : interp) + "</span></a>")), buf.push("</div>"), pin.private || (buf.push("<div"), buf.push(attrs({
				"class": "left"
			})), buf.push("><a"), buf.push(attrs({
				onclick: "app.requireLogin(function(){ app.showDialogBox('repin', {pin_id:'" + pin.pin_id + "'});});return false;",
				href: "#",
				"class": "repin btn btn14 rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 采集</span></a></div>")), buf.push("</div>");
			var size = imgSize(pin.file, _suffix),
				pinUrl = "/pins/" + pin.pin_id + "/" + md,
				targetUrl = promt ? promt.url || pinUrl : pinUrl,
				target = promt ? promt.new_tab ? "_blank" : "_self" : "_self",
				extra_css_class = [];
			size.h > 800 && extra_css_class.push("long"), promt && extra_css_class.push("promotion-url"), extra_css_class = extra_css_class.join(" "), buf.push("<a"), buf.push(attrs({
				href: "" + targetUrl + "" + md + "",
				target: "" + target + "",
				rel: "" + isFollow + "",
				"class": "img " + ("" + extra_css_class + "") + " " + "x" + " " + "layer-view"
			})), buf.push("><div"), buf.push(attrs({
				"class": "default-bg"
			})), buf.push(">");
			var __val__ = pin.source;
			buf.push(null == __val__ ? "" : __val__), buf.push("</div>");
			var __val__ = img(pin.file, _suffix, {
				alt: user.username + "采集到" + board_title
			});
			buf.push(null == __val__ ? "" : __val__), pin.media_type === 1 && (buf.push("<img"), buf.push(attrs({
				src: "/img/media_video.png",
				"data-baiduimageplus-ignore": 1,
				"class": "video-icon"
			})), buf.push("/>")), buf.push("<span"), buf.push(attrs({
				style: "display: " + (size.h > 800 ? "block" : "none") + "",
				"class": "stop"
			})), buf.push("></span>");
			if(pin.commodity && pin.commodity.price) {
				var currency = pin.commodity.extra && pin.commodity.extra.currency ? pin.commodity.extra.currency + " " : "￥";
				buf.push("<div"), buf.push(attrs({
					"class": "price"
				})), buf.push(">" + escape((interp = currency) == null ? "" : interp) + " " + escape((interp = Math.round(pin.commodity.price * 10) / 10) == null ? "" : interp) + "</div>")
			}
			buf.push("<div"), buf.push(attrs({
				"class": "cover"
			})), buf.push("></div>"), pin.file.type === "image/gif" && pin.file.frames !== 1 && (buf.push("<div"), buf.push(attrs({
				"class": "gif-icon"
			})), buf.push("><div"), buf.push(attrs({
				"class": "gif-loading"
			})), buf.push("></div></div>")), buf.push("</a>");
			if(pin.raw_text) {
				var pinDesc = format_text(pin.raw_text, pin.text_meta),
					metas = pin.text_meta,
					showMore = pin.raw_text.length > 45;
				buf.push("<p"), buf.push(attrs({
					"data-raw": pinDesc,
					"class": "description"
				})), buf.push(">");
				var __val__ = showMore ? pin.raw_text.substring(0, 45) + '<a class="show-more">...</a>' : pinDesc;
				buf.push(null == __val__ ? "" : __val__), buf.push("</p>")
			}
			if(pin.like_count || pin.comment_count || pin.repin_count) buf.push("<p"), buf.push(attrs({
				"class": "stats less"
			})), buf.push(">"), pin.repin_count && (buf.push("<span"), buf.push(attrs({
				title: "转采",
				"class": "repin"
			})), buf.push("><i></i>" + escape((interp = pin.repin_count) == null ? "" : interp) + "</span>")), pin.like_count && (buf.push("<span"), buf.push(attrs({
				title: "喜欢",
				"class": "like"
			})), buf.push("><i></i>" + escape((interp = pin.like_count) == null ? "" : interp) + "</span>")), pin.comment_count && (buf.push("<span"), buf.push(attrs({
				title: "评论",
				"class": "comment"
			})), buf.push("><i></i>" + escape((interp = pin.comment_count) == null ? "" : interp) + "</span>")), buf.push("</p>");
			buf.push("<div"), buf.push(attrs({
				"class": "convo attribution clearfix"
			})), buf.push(">"), locals.hide_user ? !pin.hide_origin && pin.source ? (buf.push("<p"), buf.push(attrs({
				"class": "NoImage"
			})), buf.push("><a"), buf.push(attrs({
				href: "/from/" + pin.source + "/" + md + "",
				"class": "x"
			})), buf.push(">" + escape((interp = pin.source) == null ? "" : interp) + "</a><a"), buf.push(attrs({
				title: "评论",
				"class": "replyButton"
			})), buf.push("></a></p>")) : (buf.push("<p"), buf.push(attrs({
				"class": "NoImage"
			})), buf.push("><a"), buf.push(attrs({
				title: "评论",
				"class": "replyButton"
			})), buf.push("></a></p>")) : (buf.push("<a"), buf.push(attrs({
				href: "/" + escape(user.urlname) + "/",
				title: escape(user.username),
				rel: "nofollow",
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(user),
				"data-baiduimageplus-ignore": 1,
				"class": "avt"
			})), buf.push("/></a>"), isVerified(page.user) && (buf.push("<img"), buf.push(attrs({
				src: "/img/icon_v.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon"
			})), buf.push("/>")), buf.push("<div"), buf.push(attrs({
				"class": "text"
			})), buf.push("><div"), buf.push(attrs({
				"class": "inner"
			})), buf.push("><div"), buf.push(attrs({
				"class": "line"
			})), buf.push(">"), pin.keyword ? buf.push("兴趣 来自") : (buf.push("<a"), buf.push(attrs({
				href: "/" + user.urlname + "/" + md + "",
				rel: "" + isFollow + "",
				"class": "author x"
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + "</a>&nbsp;采集到")), buf.push("</div><div"), buf.push(attrs({
				"class": "line"
			})), buf.push(">"), pin.keyword ? (buf.push("<a"), buf.push(attrs({
				href: "/explore/" + pin.keyword.urlname + "/",
				rel: "" + isFollow + ""
			})), buf.push(">" + escape((interp = pin.keyword.name) == null ? "" : interp) + "</a>")) : board && (buf.push("<a"), buf.push(attrs({
				href: "/boards/" + pin.board_id + "/" + md + "",
				rel: "" + isFollow + "",
				"class": "x"
			})), buf.push(">" + escape((interp = board.is_private == 2 ? "待归类采集" : board.title) == null ? "" : interp) + "</a>")), buf.push("</div><a"), buf.push(attrs({
				title: "评论",
				"class": "replyButton"
			})), buf.push("></a></div></div>")), buf.push("</div><div"), buf.push(attrs({
				style: pin.comments ? "" : "display:none;",
				"class": "comments muted"
			})), buf.push(">");
			if(pin.comments)
				for(var $index = 0, $$l = pin.comments.length; $index < $$l; $index++) {
					var comment = pin.comments[$index],
						__val__ = emerge("base/comment_item_convo", comment);
					buf.push(null == __val__ ? "" : __val__)
				}
			buf.push("</div>"), au = this.req.user || {
				urlname: "",
				username: ""
			}, buf.push("<div"), buf.push(attrs({
				style: "display: " + (pin.comments ? "block" : "none") + ";",
				"class": "write convo clearfix"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(au.urlname) + "/",
				title: escape(au.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(au),
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a>"), isVerified(page.user) && (buf.push("<img"), buf.push(attrs({
				src: "/img/icon_v.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon"
			})), buf.push("/>")), buf.push("<form"), buf.push(attrs({
				action: "/pins/" + pin.pin_id + "/comments/",
				method: "POST"
			})), buf.push("><textarea"), buf.push(attrs({
				placeholder: "添加评论或把采集@给好友",
				"class": "clear-input GridComment"
			})), buf.push("></textarea><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "grid_comment_button btn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 添加评论</span></a></form></div>"), promt && promt.show_icon && (buf.push("<div"), buf.push(attrs({
				"class": "promotion-icon"
			})), buf.push("></div>")), buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/pin_success"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "form"
			})), buf.push("><div"), buf.push(attrs({
				"class": "pin-prompt"
			})), buf.push("><div"), buf.push(attrs({
				"class": "text"
			})), buf.push(">成功采集到<a"), buf.push(attrs({
				href: "#",
				onclick: 'try{_czc.push(["_trackEvent", "repin", "click", "board", 1]);}catch(e){};',
				"class": "brown-link prompt-board-link"
			})), buf.push("></a>|<a"), buf.push(attrs({
				href: "#",
				onclick: 'try{_czc.push(["_trackEvent", "repin", "click", "pin", 1]);}catch(e){};',
				"class": "brown-link prompt-pin-link"
			})), buf.push(">查看采集</a></div></div><div"), buf.push(attrs({
				"class": "pin-done"
			})), buf.push("><h3"), buf.push(attrs({
				"class": "recommend-title"
			})), buf.push("></h3><div"), buf.push(attrs({
				"class": "recommend-board clearfix"
			})), buf.push('></div></div></div><script>(function(){app.initFollowButtons();var a=$("pin_success"),b=a.getElement(".pin-done .recommend-board"),c=a.getElement(".pin-done .recommend-title");(new Request.JSON({url:"/pins/"+app.$pin.pin_id+"/recommendBoards/",onSuccess:function(d){if(d.err||!d.boards)return;b.show();var e=a.getElement(".prompt-board-link"),f=a.getElement(".prompt-pin-link");e.set("text",app.$pin.board.title),e.set("href","/boards/"+app.$pin.board.board_id+"/"),f.set("href","/pins/"+app.$pin.pin_id+"/");var g=d.boards[0];if(g)c.set("text",d.title),app.render("base/board_item",{board:g,user:app.req.user},function(a,c){Elements.from(c).inject(b),a&&Browser.exec(a);var d=setTimeout(function(){app.hideDialogBox("pin_success"),clearTimeout(d)},5e3);app.gaqTrackEvent("#pin_success .recommend-board a.link",{category:"recommend_board_link"}),app.gaqTrackEvent("#pin_success .recommend-board .follow",{category:"recommend_board_follow"})});else{c.set("html",\'<span class="timer"></span>\');var h=c.getElement(".timer"),i;(function j(a){a==0?app.hideDialogBox("pin_success"):(h.set("text",a+" 秒后自动关闭"),a--,i=setTimeout(j,1e3,a))})(3)}}})).get()})()</script>')
		}
		return buf.join("")
	}, __t["base/pin_view"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			locals.pin && (page = locals);
			var pin = page.pin,
				board = pin.board,
				is_owner = this.req.user && pin.user_id === this.req.user.user_id,
				pin_link_host = pin.source || "";
			if(!pin_link_host) {
				var match = /^http(?:s)?:\/\/([^/]+)(?:\/.*)?/.exec(pin.link);
				match && match.length == 2 && (pin_link_host = match[1] || "")
			}
			var pin_desc = pin.raw_text ? pin.raw_text.length > 20 ? pin.raw_text.substr(0, 20) + "..." : pin.raw_text : "",
				original_user = pin.original_pin && pin.original_pin.user ? pin.original_pin.user : pin.via_user,
				ads = page.ads;
			"function" != typeof ads.getAd ? (ads.normalAds = ads.normalAds.map(function(e, t) {
				var n = t * 10,
					r = n + 9,
					i = Math.floor(Math.random() * (r - n + 1) + n);
				return e.position = i, e
			}), ads = ads.fixedAds.concat(ads.normalAds), page.viewAds = {}, page.viewAds.currentIndex = 0, page.viewAds.ads = ads, page.viewAds.getAd = function() {
				var e = this,
					t = e.ads.filter(function(t) {
						return t.position === e.currentIndex
					});
				return ++e.currentIndex, t
			}) : page.viewAds = ads, buf.push("<div"), buf.push(attrs({
				"data-id": pin.pin_id,
				"data-media-type": pin.media_type,
				"data-orig-source": pin.orig_source,
				"data-board-id": board.board_id,
				"data-size-x": pin.file.width,
				"data-size-y": pin.file.height,
				"class": "pin-view"
			})), buf.push("><div"), buf.push(attrs({
				"class": "pin-view-wrapper"
			})), buf.push("><div"), buf.push(attrs({
				"class": "main-part"
			})), buf.push("><div"), buf.push(attrs({
				"class": "image-piece piece"
			})), buf.push("><div"), buf.push(attrs({
				"class": "tool-bar"
			})), buf.push("><a"), buf.push(attrs({
				onclick: "app.requireLogin(function(){app.showDialogBox('repin', {pin_id: '" + pin.pin_id + "'});});return false;",
				href: "#",
				"class": "repin-btn btn rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 采集</span></a>"), is_owner ? (buf.push("<a"), buf.push(attrs({
				href: "/pins/" + pin.pin_id + "/edit/",
				"class": "edit-btn btn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 编辑</span></a><a"), buf.push(attrs({
				href: "/pins/" + pin.pin_id + "/delete/",
				"class": "del-btn btn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 删除</span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": pin.pin_id,
				href: "#",
				onclick: "return false;",
				"class": "like-btn " + (pin.liked ? "liked" : "") + " " + "btn-with-icon" + " " + "btn"
			})), buf.push("><i"), buf.push(attrs({
				"class": "heart"
			})), buf.push("></i></a>")), buf.push("<div"), buf.push(attrs({
				"class": "right-part"
			})), buf.push("><div"), buf.push(attrs({
				"class": "huaban-share-unit"
			})), buf.push("><span>分享</span><div"), buf.push(attrs({
				"class": "share-btns"
			})), buf.push("><a"), buf.push(attrs({
				"data-to": "weibo",
				title: "新浪微博",
				target: "_blank",
				href: "/pins/" + pin.pin_id + "/js-share/?to=weibo",
				"class": "share-btn weibo"
			})), buf.push("></a><a"), buf.push(attrs({
				"data-to": "qzone",
				title: "QQ空间",
				target: "_blank",
				href: "/pins/" + pin.pin_id + "/js-share/?to=qzone",
				"class": "share-btn qzone"
			})), buf.push("></a><a"), buf.push(attrs({
				"data-to": "weixin",
				title: "微信",
				target: "_blank",
				href: "/pins/" + pin.pin_id + "/js-share/?to=weixin",
				"class": "share-btn weixin"
			})), buf.push("></a><div"), buf.push(attrs({
				"class": "more"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "menu"
			})), buf.push("><a"), buf.push(attrs({
				"data-to": "tqq",
				title: "腾讯微博",
				target: "_blank",
				href: "/pins/" + pin.pin_id + "/js-share/?to=tqq",
				"class": "tqq"
			})), buf.push("><i></i>腾讯微博</a><a"), buf.push(attrs({
				"data-to": "qfriends",
				title: "QQ好友",
				target: "_blank",
				href: "/pins/" + pin.pin_id + "/js-share/?to=qfriends",
				"class": "qq"
			})), buf.push("><i></i>QQ 好友</a><a"), buf.push(attrs({
				"data-to": "douban",
				title: "豆瓣",
				target: "_blank",
				href: "/pins/" + pin.pin_id + "/js-share/?to=douban",
				"class": "douban"
			})), buf.push("><i></i>豆瓣</a><a"), buf.push(attrs({
				"data-to": "renren",
				title: "人人网",
				target: "_blank",
				href: "/pins/" + pin.pin_id + "/js-share/?to=renren",
				"class": "renren"
			})), buf.push("><i></i>人人网</a><div"), buf.push(attrs({
				"class": "arr"
			})), buf.push("></div></div></div><a"), buf.push(attrs({
				href: "/pins/" + pin.pin_id + "/zoom/",
				title: "查看原图",
				"class": "zoomin btn-with-icon btn"
			})), buf.push("><i"), buf.push(attrs({
				"class": !0
			})), buf.push("></i></a></div></div><div"), buf.push(attrs({
				"class": "main-image"
			})), buf.push("><div"), buf.push(attrs({
				id: "baidu_image_holder",
				"class": "image-holder"
			})), buf.push(">");
			var imgAttrs = {
				alt: pin_desc
			};
			pin.board && ~["beauty", "other", "pets", "funny"].indexOf(pin.board.category_id) && !~[1].indexOf(pin.user.user_id) && (imgAttrs.imageplus = !0);
			if(pin.link && !pin.hide_origin)
				if(pin_link_host) {
					buf.push("<a"), buf.push(attrs({
						href: "/go/?pin_id=" + pin.pin_id + "",
						target: "_blank",
						rel: "nofollow",
						"data-real-href": "" + pin.link + ""
					})), buf.push(">");
					var __val__ = img(pin.file, "fw658", imgAttrs);
					buf.push(null == __val__ ? "" : __val__), buf.push("</a>")
				} else {
					buf.push("<a"), buf.push(attrs({
						href: "" + pin.link + "",
						target: "_blank",
						rel: "nofollow"
					})), buf.push(">");
					var __val__ = img(pin.file, "fw658", imgAttrs);
					buf.push(null == __val__ ? "" : __val__), buf.push("</a>")
				}
			else if(pin.original_pin && pin.original_pin.text_meta && pin.original_pin.text_meta.creation) {
				buf.push("<a"), buf.push(attrs({
					href: "/pins/" + pin.original_pin.pin_id + "",
					target: "_blank",
					rel: "nofollow"
				})), buf.push(">");
				var __val__ = img(pin.file, "fw658", imgAttrs);
				buf.push(null == __val__ ? "" : __val__), buf.push("</a>")
			} else {
				var __val__ = img(pin.file, "fw658", imgAttrs);
				buf.push(null == __val__ ? "" : __val__)
			}
			buf.push("</div></div>");
			if(pin.showcase && pin.showcase.length) {
				var __val__ = emerge("base/pin_view_extra_imgs", {
					showcase: pin.showcase
				});
				buf.push(null == __val__ ? "" : __val__)
			}
			buf.push("<div"), buf.push(attrs({
				"class": "tool-bar-bottom"
			})), buf.push("><a"), buf.push(attrs({
				onclick: "app.requireLogin(function(){app.showDialogBox('repin', {pin_id: '" + pin.pin_id + "'});});return false;",
				href: "#",
				"class": "repin-btn btn-with-icon btn"
			})), buf.push("><i"), buf.push(attrs({
				"class": !0
			})), buf.push("></i><span"), buf.push(attrs({
				"class": "text"
			})), buf.push('> 采集 <span class="num">' + escape((interp = pin.repin_count || "") == null ? "" : interp) + "</span></span></a><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "like-btn btn-with-icon btn"
			})), buf.push("><i"), buf.push(attrs({
				"class": !0
			})), buf.push("></i><span"), buf.push(attrs({
				"class": "text"
			})), buf.push('> 喜欢 <span class="num">' + escape((interp = pin.like_count || "") == null ? "" : interp) + "</span></span></a><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "comment-btn btn-with-icon btn"
			})), buf.push("><i"), buf.push(attrs({
				"class": !0
			})), buf.push("></i><span"), buf.push(attrs({
				"class": "text"
			})), buf.push('> 评论 <span class="num">' + escape((interp = pin.comment_count || "") == null ? "" : interp) + "</span></span></a><!--btn.download-btn(href='#{imgURL(pin.file)}', target='_blank', download) #{((pin.file.type || '').substring(6) || 'jpeg').toUpperCase()}--><!--    i.new--><!--    i--><div"), buf.push(attrs({
				"class": "right-part"
			})), buf.push("><a"), buf.push(attrs({
				title: "举报这张采集",
				href: "#",
				onclick: "return false;",
				"class": "report-btn btn-with-icon btn"
			})), buf.push("><i"), buf.push(attrs({
				"class": !0
			})), buf.push("></i></a>");
			if(!pin.commodity && pin.link && pin.source && !pin.hide_origin) buf.push("<a"), buf.push(attrs({
				href: "/go/?pin_id=" + pin.pin_id + "",
				rel: "nofollow",
				target: "_blank",
				"class": "source btn-with-icon btn"
			})), buf.push("><i"), buf.push(attrs({
				"class": !0
			})), buf.push("></i><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 查看来源 " + escape((interp = pin.source) == null ? "" : interp) + "</span></a>");
			else if(pin.musePinId || pin.creation || pin.original_pin && pin.original_pin.text_meta && pin.original_pin.text_meta.creation) {
				var _user = original_user || pin.user,
					_link = pin.musePinId ? "/pins/" + pin.musePinId : "/" + _user.urlname + "/creations";
				buf.push("<a"), buf.push(attrs({
					href: "" + _link + "",
					target: "_blank",
					rel: "nofollow",
					"class": "come-from creation-user btn wbtn btn-with-icon x"
				})), buf.push(">© 来自<span"), buf.push(attrs({
					"class": "brown-link"
				})), buf.push(">@" + escape((interp = _user.username) == null ? "" : interp) + "</span>的版权作品</a>")
			} else if(pin.material || pin.original_pin && pin.original_pin.text_meta && pin.original_pin.text_meta.material) {
				var _user = original_user || pin.user;
				buf.push("<a"), buf.push(attrs({
					href: "" + ("/" + _user.urlname || "#") + "",
					target: "_blank",
					rel: "nofollow",
					"class": "come-from creation-user btn wbtn btn-with-icon x"
				})), buf.push(">© 来自<span"), buf.push(attrs({
					"class": "brown-link"
				})), buf.push(">@" + escape((interp = _user.username) == null ? "" : interp) + "</span>的素材作品</a>")
			}
			buf.push("</div></div><div"), buf.push(attrs({
				"class": "extra-box"
			})), buf.push(">");
			if(pin.commodity) {
				var __val__ = emerge("base/pin_view_gift_extra", {
					commodity: pin.commodity,
					pin: pin
				});
				buf.push(null == __val__ ? "" : __val__)
			}
			buf.push("</div></div><div"), buf.push(attrs({
				"class": "info-piece piece"
			})), buf.push("><div"), buf.push(attrs({
				"class": "info"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(pin.user.urlname) + "/",
				title: escape(pin.user.username),
				rel: "nofollow",
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(pin.user),
				"data-baiduimageplus-ignore": 1,
				"class": "avt"
			})), buf.push("/></a>");
			if(pin.via_user) {
				buf.push("<div"), buf.push(attrs({
					"class": "main"
				})), buf.push("><a"), buf.push(attrs({
					href: "/" + pin.user.urlname + "/",
					rel: "nofollow"
				})), buf.push(">" + escape((interp = pin.user.username) == null ? "" : interp) + "</a><span"), buf.push(attrs({
					"class": "space"
				})), buf.push(">从</span><a"), buf.push(attrs({
					href: "/" + pin.via_user.urlname + "/",
					rel: "nofollow"
				})), buf.push(">" + escape((interp = pin.via_user.username) == null ? "" : interp) + "</a></div><div"), buf.push(attrs({
					"class": "sub"
				})), buf.push(">转采于<span"), buf.push(attrs({
					"data-ts": "" + pin.created_at + "",
					"class": "ts-words space"
				})), buf.push(">");
				var __val__ = Date.timeAgo(pin.created_at);
				buf.push(null == __val__ ? "" : __val__), buf.push("</span></div>")
			} else {
				buf.push("<div"), buf.push(attrs({
					"class": "main"
				})), buf.push("><a"), buf.push(attrs({
					href: "/" + pin.user.urlname + "/",
					rel: "nofollow"
				})), buf.push(">" + escape((interp = pin.user.username) == null ? "" : interp) + "</a></div><div"), buf.push(attrs({
					"class": "sub"
				})), buf.push(">"), pin.via < 1e3 && pin.via_client && (buf.push("通过"), pin.via_client.client_link ? (buf.push("<a"), buf.push(attrs({
					href: "" + pin.via_client.client_link + "",
					target: "_blank",
					rel: "nofollow",
					"class": "space brown-link"
				})), buf.push(">" + escape((interp = pin.via_client.client_name) == null ? "" : interp) + "</a>")) : (buf.push("<span"), buf.push(attrs({
					"class": "space"
				})), buf.push(">" + escape((interp = pin.via_client.client_name) == null ? "" : interp) + "</span>"))), buf.push("采集于<span"), buf.push(attrs({
					"data-ts": "" + pin.created_at + "",
					"class": "ts-words space"
				})), buf.push(">");
				var __val__ = Date.timeAgo(pin.created_at);
				buf.push(null == __val__ ? "" : __val__), buf.push("</span></div>")
			}
			buf.push("</div>");
			if(pin.raw_text && !pin.creation) {
				buf.push("<div"), buf.push(attrs({
					"class": "description"
				})), buf.push(">");
				var __val__ = format_text(pin.raw_text, pin.text_meta);
				buf.push(null == __val__ ? "" : __val__), buf.push("</div>")
			}
			pin.comment_count > 20 && (buf.push("<div"), buf.push(attrs({
				"class": "more-comments"
			})), buf.push(">加载较早的评论</div>")), buf.push("<div"), buf.push(attrs({
				"class": "comments"
			})), buf.push(">");
			if(pin.comments && pin.comments.length)
				for(var $index = 0, $$l = pin.comments.length; $index < $$l; $index++) {
					var comment = pin.comments[$index];
					comment.pin_user_id = pin.user_id;
					var __val__ = emerge("base/comment_item", comment);
					buf.push(null == __val__ ? "" : __val__)
				}
			buf.push("</div>");
			var __val__ = emerge("base/comment_form", {
				pin: pin,
				user: this.req.user
			});
			buf.push(null == __val__ ? "" : __val__);
			if(pin.likes && pin.likes.length) {
				buf.push("<div"), buf.push(attrs({
					"class": "likes clearfix"
				})), buf.push("><h4>" + escape((interp = pin.like_count) == null ? "" : interp) + "喜欢</h4>");
				for(var $index = 0, $$l = pin.likes.length; $index < $$l; $index++) {
					var u = pin.likes[$index];
					buf.push("<a"), buf.push(attrs({
						href: "/" + escape(u.urlname) + "/",
						title: escape(u.username),
						"class": "img x"
					})), buf.push("><img"), buf.push(attrs({
						width: 46,
						height: 46,
						src: avatar(u),
						"data-baiduimageplus-ignore": 1
					})), buf.push("/></a>")
				}
				buf.push("</div>")
			}
			buf.push("</div><div"), buf.push(attrs({
				"class": "repin-info-piece clearfix " + (pin.original && pin.via_pin && pin.via_user ? "two" : "")
			})), buf.push("><div"), buf.push(attrs({
				"class": "board unit"
			})), buf.push("><a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/",
				rel: "nofollow",
				"class": "pins x"
			})), buf.push(">");
			var t = 0;
			while(t < 4 && t < board.pins.length) buf.push("<img"), buf.push(attrs({
				width: "24",
				height: "24",
				src: imgURL(board.pins[t].file, "sq75"),
				"data-baiduimageplus-ignore": 1
			})), buf.push("/>"), t++;
			buf.push("</a><div"), buf.push(attrs({
				"class": "info"
			})), buf.push("><span>采集到画板</span><a"), buf.push(attrs({
				href: "/boards/" + pin.board_id + "/",
				rel: "nofollow",
				"class": "x"
			})), buf.push(">" + escape((interp = board.title) == null ? "" : interp) + "</a></div>"), is_owner || (board.following ? (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "follow-btn unfollow btn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 取消关注</span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "follow-btn btn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 关注</span></a>"))), buf.push("</div>"), pin.original && pin.via_pin && pin.via_user && (buf.push("<div"), buf.push(attrs({
				"class": "repins-from unit"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(original_user.urlname) + "/",
				title: escape(original_user.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				width: 50,
				height: 50,
				src: avatar(original_user),
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a><div"), buf.push(attrs({
				"class": "info"
			})), buf.push("><span>采集自用户</span><a"), buf.push(attrs({
				href: "/" + original_user.urlname + "/",
				"class": "x"
			})), buf.push(">" + escape((interp = original_user.username) == null ? "" : interp) + "</a></div></div>")), buf.push("</div>"), pin.breadcrumb && (buf.push("<div"), buf.push(attrs({
				"class": "category-info-piece"
			})), buf.push(">该采集属于<a"), buf.push(attrs({
				href: "" + pin.breadcrumb.link + "",
				"class": "brown-link x"
			})), buf.push(">" + escape((interp = pin.breadcrumb.text) == null ? "" : interp) + "</a>分类</div>")), buf.push("</div><div"), buf.push(attrs({
				"class": "side-part"
			})), buf.push("><div"), buf.push(attrs({
				"class": "board-piece piece"
			})), buf.push("><div"), buf.push(attrs({
				"class": "board-info"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(pin.user.urlname) + "/",
				title: escape(pin.user.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(pin.user),
				"data-baiduimageplus-ignore": 1,
				"class": "avt"
			})), buf.push("/></a><a"), buf.push(attrs({
				href: "/boards/" + pin.board_id + "/",
				"class": "name x"
			})), buf.push(">" + escape((interp = pin.board.title) == null ? "" : interp) + "</a><div"), buf.push(attrs({
				"class": "sub"
			})), buf.push(">" + escape((interp = pin.user.username) == null ? "" : interp) + "</div></div><div"), buf.push(attrs({
				"class": "board-pins cst-scrollbar"
			})), buf.push("><div"), buf.push(attrs({
				id: "board_pins_waterfall"
			})), buf.push(">");
			for(var $index = 0, $$l = board.pins.length; $index < $$l; $index++) {
				var board_pin = board.pins[$index];
				board_pin.pin_id == pin.pin_id && (board_pin.selected = !0);
				var __val__ = emerge("base/pin_view_board_pin_item", {
					board_pin: board_pin
				});
				buf.push(null == __val__ ? "" : __val__)
			}
			buf.push("</div></div>"), is_owner || (board.following ? (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "follow-btn unfollow btn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 取消关注画板</span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": "" + board.board_id + "",
				href: "#",
				onclick: "return false;",
				"class": "follow-btn btn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 关注画板</span></a>"))), buf.push("</div>");
			if(pin.siblings && !pin.hide_origin) {
				buf.push("<div"), buf.push(attrs({
					"class": "siblings-piece piece"
				})), buf.push("><a"), buf.push(attrs({
					href: "/from/" + pin.source + "/",
					"class": "inner x"
				})), buf.push("><div>同采自</div><div"), buf.push(attrs({
					"class": "site"
				})), buf.push(">" + escape((interp = pin.source) == null ? "" : interp) + "</div><div"), buf.push(attrs({
					"class": "pins clearfix"
				})), buf.push(">");
				for(var i = 0, $$l = pin.siblings.length; i < $$l; i++) {
					var sibling = pin.siblings[i];
					i < 3 && (buf.push("<img"), buf.push(attrs({
						src: imgURL(sibling.file, "sq120"),
						"data-baiduimageplus-ignore": 1,
						"class": i < 2 ? "space" : ""
					})), buf.push("/>"))
				}
				buf.push("</div><div"), buf.push(attrs({
					"class": "arrow"
				})), buf.push("></div></a></div>")
			}
			var _promotions = [];
			if(_promotions.length) {
				var random_ad = Array.getRandom(_promotions);
				if(random_ad == "iframe") buf.push("<div"), buf.push(attrs({
					"class": "pin-view-promo"
				})), buf.push("><iframe"), buf.push(attrs({
					src: "/adpush.html"
				})), buf.push("></iframe></div>");
				else if(random_ad) {
					var image_url = "//" + this.settings.hbfile[random_ad.image.bucket] + "/img/promotion/" + random_ad.image.key;
					buf.push("<div"), buf.push(attrs({
						"class": "pin-view-promo"
					})), buf.push("><a"), buf.push(attrs({
						href: random_ad.url,
						title: random_ad.title,
						target: random_ad.new_tab ? "_blank" : "_self",
						rel: "nofollow"
					})), buf.push("><img"), buf.push(attrs({
						src: image_url,
						width: 278,
						"data-baiduimageplus-ignore": 1
					})), buf.push("/></a></div>")
				}
			} else {
				buf.push("<div"), buf.push(attrs({
					"class": "pin side promotion"
				})), buf.push(">");
				var __val__ = emerge("base/google", {
					slot: "7601640858",
					width: 250,
					height: 250,
					className: ""
				});
				buf.push(null == __val__ ? "" : __val__), buf.push("</div>")
			}
			buf.push("</div><div"), buf.push(attrs({
				"class": "clear"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "bottom-part"
			})), buf.push("><div"), buf.push(attrs({
				"class": "pin-view-wrapper"
			})), buf.push("><div"), buf.push(attrs({
				"class": "related-boards clearfix"
			})), buf.push("><div"), buf.push(attrs({
				"class": "title-el"
			})), buf.push(">该采集也在以下画板</div><div"), buf.push(attrs({
				"class": "board-box clearfix"
			})), buf.push("></div><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "load-more-board btn btn18"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 加载更多</span></a></div><div"), buf.push(attrs({
				id: "recommend-pins"
			})), buf.push("><div"), buf.push(attrs({
				"class": "title-el"
			})), buf.push(">推荐给你的采集</div><div"), buf.push(attrs({
				"class": "waterfall"
			})), buf.push('></div></div></div></div></div><script>(function(){var a=document.getElement(".pin-view"),b=a.getElement(".main-part .main-image"),c=a.get("data-id"),d=a.get("data-board-id"),e=a.get("data-media-type"),f=a.get("data-orig-source"),g=document.id("pin_view_layer"),h=a.getElement(".cst-scrollbar"),i;(function(){app.initPureLikeButtons({buttonSelector:".pin-view .tool-bar .like-btn",unLikeButtonClass:"liked",onLikeSuccess:function(a){var b=a.getParent(".main-part").getElement(".tool-bar-bottom .like-btn"),c=b.getElement(".num"),d=c.innerHTML.toInt()||0;c.set("text",d+1)},onUnLikeSuccess:function(a){var b=a.getParent(".main-part").getElement(".tool-bar-bottom .like-btn"),c=b.getElement(".num"),d=c.innerHTML.toInt()||0;c.set("text",d-1||"")}}),app.initDelCommentButtons(),app.initAddCommentButtons(),app.initReplyButtons(),app.initLikeButtons(),app.initShowMoreButtons(),app.initFollowButtons(),app.initGifButtons(),app.initPureFollowBoardButtons({buttonSelector:".follow-btn",onFollowSuccess:function(a){var b=a.getElement(".text");b.innerHTML=b.innerHTML.replace("关注","取消关注")},onUnfollowSuccess:function(a){var b=a.getElement(".text");b.innerHTML=b.innerHTML.replace("取消关注","关注")}});var b=a.getElement(".tool-bar-bottom .like-btn"),c=a.getElement(".tool-bar .like-btn");b.addEvent("click",function(){c.click()});var d=a.getElement(".tool-bar-bottom .comment-btn"),e=document.getElement("#pin_view_add_comment textarea"),f=new Fx.Scroll(g||document.body);d.addEvent("click",function(){e.select(),f.toElementCenter(e,"y",{y:g?-document.body.getScroll().y:0})})})(),function(){if(e&&e==1){var a=658,c=410,d=new Swiff(f,{width:a,height:c,params:{allowfullscreen:!0,wMode:"opaque"}});d.inject(b.getElement(".image-holder").empty())}}(),function(){var a=document.getElement(".tool-bar .del-btn");a&&a.addEvent("click",function(){var a=new Button(this);return app.confirm({title:"删除确认",text:"删除采集后不能恢复，确定要删除吗?",action:"删除"},function(b){b&&(a.setTitle("正在删除...").disable(),(new Request.JSON({url:"/pins/"+c+"/",data:{_method:"DELETE"},onSuccess:function(b){if(b.err){app.error(b.msg||app.COMMON_ERRMSG),a.setTitle().enable();return}var c="/boards/"+d+"/";app.msg("已经成功删除采集"),setTimeout(function(){location.href=c},1500)},onFailure:function(){a.setTitle().enable()}})).post())}),!1})}(),function(){if(g)return;var a,b,d=app.getState().id,e="/pins/"+c+"/zoom/",f="#header, #header_side_menu, #top_promotion",h=$$(f),i=document.getElement(".pin-view .tool-bar .zoomin"),j=function(){a||(a=Elements.from(app.renderSync("base/pin_view_zoom"))[0],a.getElement("#zoomr_hide").addEvent("click",function(){return app.popState(),!1})),b=a.retrieve("slide"),b||(b=new SlidePage(a,{fixedSelector:f}),a.store("slide",b)),a.inject(document.body).show(),b.show().chain(function(){a.setStyles({width:"100%",height:"auto"}),h.setStyle("visibility","hidden")}),app.registerStateHandler(d,k)},k=function(){if(!a)return;b=a.retrieve("slide"),h.setStyle("visibility",""),b.hide().chain(function(){a.destroy(),a=null}),app.setTitle(),app.removeStateHandler(d)};app.registerStateHandler(e,j),i.addEvent("click",function(a){return app.pushState(null,app.page.title,e),!1})}(),function(){if(!g)return;var b=a.getElement(".tool-bar .zoomin"),c=g.getElement(".zoom-layer"),d=c.getElement(".holder"),e=c.getElement(".close-zoom"),f=g.getElement(".close - layer"),h=a.get("data-size-y");b.addEvent("click",function(a){d.empty();var b=(new Element("img",{src:c.get("data-img")})).inject(d);b.addEvent("click",function(a){a.stop()});var e=document.html.clientHeight-h;return e>0&&b.setStyle("margin-top",e/2),c.show(),f.hide(),!1}),(new Elements([e,d])).addEvent("click",function(){return c.hide(),f.show(),!1})}(),function(){var a=document.getElement(".pin-view .info-piece .more-comments");if(a){var b=a.getNext(".comments"),d=b.getElement(".comment").get("data-id"),e=10,f=!1;a.addEvents({click:function(g){if(f)return;f=!0,a.tween("opacity",.3),(new Request.JSON({url:"/pins/"+c+"/comments/",data:{max:d,limit:e},onSuccess:function(c){f=!1;if(c.err)return alert(c.msg||app.COMMON_ERRMSG);var g=c.comments.reverse(),h;b.getElements(".comment.new").removeClass("new"),g.each(function(a,c){a.pin_user_id="' + escape((interp = pin.user_id) == null ? "" : interp) + '";var d=app.renderSync("base/comment_item",a),e=Elements.from(d).inject(b,"top");c===0&&(h=e[0]),e.addClass("new")});if(g.length<e)return a.dispose();d=g[g.length-1].comment_id,a.tween("opacity",1)}})).get()}})}}(),function(){var b=a.get("data-size-y"),c=a.getElement(".main-image .arrows");c&&b>700&&c.setStyle("top",280)}(),function(){var b=document.getElement(".pin-view .board-piece .board-pins"),d=function(){var e=app.createCellLoader("/boards/' + escape((interp = board.board_id) == null ? "" : interp) + '/",20,function(a){return a.board.pins&&a.board.pins.each(function(a){a.pin_id==c&&(a.selected=!0)}),{data:a.board.pins}},{template:"base/pin_view_board_pin_item"}),f=new Waterfall("board_pins_waterfall",{container:b,cellWidth:78,cellSpace:2,minCols:3,maxCols:3,up:!0,cellSelector:".cell",hibernate:!1,containerSelector:"",loadOffset:100,autoResize:!1,scrollEl:a.getElement(".board-piece .board-pins"),transitionClass:"",containerSelectorOffset:0,loader:e});f.options.loader(f);var g=380,h=20,i=0,j=f.cells.length;if(j===h)try{i=Math.min.apply(Math,f.getColsHeight()),i<g&&f.options.loader(f)}catch(k){}app.view.removeEvent("initWaterfall",d);var l=function(){$$("#board_pins_waterfall .cell").each(function(a){if(a.hasClass("selected")){var b=(a.getStyle("top")||"").replace("px","");$$(".board-pins.cst-scrollbar").scrollTo(0,b-150)}})};l()};app.view.addEvent("initWaterfall",d)}(),function(){var b=a.getElement("#recommend-pins .waterfall"),c=function(){b.$waterfall=new Waterfall(b,{container:a,minCols:4,maxCols:4,hibernate:!1,containerSelector:"",autoResize:!1,scrollEl:g||window,transitionClass:"",containerSelectorOffset:0,loader:app.createCellLoader("/pins/' + escape((interp = pin.pin_id) == null ? "" : interp) + '/recommend/",10,0,function(a){var b=a;return b.forEach(function(a,c){var d=page.viewAds||app.page.ads,e=d.getAd();e&&e.length&&b.splice(c,0,e[0])}),{data:b}})}),app.view.removeEvent("initWaterfall",c)};app.view.addEvent("initWaterfall",c)}(),function(){function f(){var a=d.getLast(".wfc"),f=a?a.get("data-seq"):null;(new Request.JSON({url:"/pins/"+c+"/relatedboards/",data:{max:f},onSuccess:function(a){if(a.err||!a.boards||!a.boards.length)return e.hide();a.more||e.hide(),b.show();var c="";a.boards.forEach(function(a){c+=app.renderSync("base/board_item",{board:a,user:app.req.user})}),Elements.from(c).inject(d)}})).get()}var b=a.getElement(".related-boards"),d=b.getElement(".board-box"),e=b.getElement(".load-more-board");f(),e.addEvent("click",f)}(),function(){var b=a.getElement(".tool-bar .huaban-share-unit .more"),c=a.getElement(".tool-bar .huaban-share-unit .menu");new MenuController({menu:c,trigger:b})}(),function(){a.getElement(".tool-bar-bottom .report-btn").addEvent("click",function(){return window.report_type="pin",window.report_id=c,app.showDialog("report"),!1}),a.getElement(".info-piece .comments").addEvent("click:relay(a.report-button)",function(){return window.report_type="comment",window.report_id=this.getParent(".comment").getProperty("data-id"),app.showDialog("report"),!1})}(),function(){var a="' + escape((interp = pin.board.category_id) == null ? "" : interp) + '";_czc.push(["_trackEvent","pin-view","expose",a||"none",1]);var b=document.getElement(".pin-view .main-image .image-holder a");if(b&&b.get("data-real-href")){var c=app.parseURL(b.get("data-real-href")).hostname;app.cnzzTrackEvent(".right-part .source",{category:"outlink",label:c}),app.cnzzTrackEvent(".pin-view .main-image .image-holder a",{category:"outlink",label:c})}app.cnzzTrackEvent(".pin-view-promo a",{category:"ads",label:"pin-view-right-bottom"});try{ga("set","dimension6","' + escape((interp = pin.board.category_id) == null ? "" : interp) + '")}catch(d){}try{e&&e==1&&(f&&~f.indexOf("youku.com")?ga("send","event","video-pins","view","youku"):ga("send","event","video-pins","view","others"))}catch(d){}app.gaqTrackEvent(".pin-view .board-piece .board-pins .cell",{category:"Pin Source Board Link"}),app.gaqTrackEvent(".pin-view .siblings-piece .inner",{category:"Pin Source Domain Link"}),app.gaqTrackEvent(".pin-view .board-piece .follow-btn",{category:"Pin Source Board Follow"}),document.getElements(".pin-view .tool-bar .huaban-share-unit a").each(function(a){app.gaqTrackEvent(a,{category:"SocialShare",action:a.get("data-to")+":{js}",label:"PinView:' + escape((interp = pin.source) == null ? "" : interp) + '"})}),app.gaqTrackEvent(".pin-view .main-image .image-holder a",{category:"Pin Links Image",useTargetUrlAsLabel:!0}),app.gaqTrackEvent(".pin-view .tool-bar-bottom .source",{category:"Pin Links Site"}),app.gaqTrackEvent(".pin-view .bottom-part .related-boards",{elementEvent:"click:relay(.Board)",category:"pin_view_recommend_board",label:location.pathname||""}),app.gaqTrackEvent(".pin-view .bottom-part .related-boards",{elementEvent:"click:relay(.follow)",category:"pin_view_recommend_board_follow",label:location.pathname||""}),app.gaqTrackEvent("#recommend-pins",{elementEvent:"click:relay(.pin)",category:"pin_view_recommend_pin",label:location.pathname||""}),app.cnzzTrackEvent(".pin-view .tool-bar-bottom .download-btn",{category:"pin_download",useTargetUrlAsLabel:!0}),app.gaqTrackEvent(".pin-view .tool-bar-bottom .download-btn",{category:"pin_download",useTargetUrlAsLabel:!0}),app.gaqTrackEvent(".pin-view .gift-info .goto-buy",{category:"commodity",label:"buy",value:"https://huaban.com/pins/' + escape((interp = pin.pin_id) == null ? "" : interp) + '/"}),app.gaqTrackPromotion(".pin-view-promo a",{category:"pin_view_promotions",useTargetUrlAsLabel:!0})}();if(g&&app.page.$url.indexOf("/gift/")==0||!history.state&&document.referrer&&document.referrer.indexOf("huaban.com/gift/")==0)try{ga("send","event","from_gift","click",location.href)}catch(j){}})()</script>')
		}
		return buf.join("")
	}, __t["base/pin_view_board_pin_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, _long = imgSize(board_pin.file, "fw78").h > 150;
			buf.push("<a"), buf.push(attrs({
				href: "/pins/" + board_pin.pin_id + "/",
				"data-id": board_pin.pin_id,
				"data-seq": board_pin.pin_id,
				"class": "cell x layer-view " + ("" + (_long ? "long" : "") + " " + (board_pin.selected ? "selected" : "") + "")
			})), buf.push(">");
			var __val__ = img(board_pin.file, "fw78");
			buf.push(null == __val__ ? "" : __val__), buf.push("<div"), buf.push(attrs({
				"class": "cover"
			})), buf.push("></div>"), _long && (buf.push("<div"), buf.push(attrs({
				"class": "stop"
			})), buf.push("></div>")), buf.push("</a>")
		}
		return buf.join("")
	}, __t["base/pin_view_creation_extra"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, is_owner = this.req.user && pin.user_id === this.req.user.user_id,
				is_material = !1,
				creation = null,
				file = null,
				creation_id = null;
			pin.creation ? (creation = pin.creation, creation_id = creation.creation_id, file = creation.extra && creation.extra.file || {}) : (creation = pin.material, is_material = !0, creation_id = creation.material_id, file = creation.file || {});
			var width = file.width,
				height = file.height;
			buf.push("<div"), buf.push(attrs({
				"class": "pin-info creation-info wt"
			})), buf.push("><div"), buf.push(attrs({
				"class": "info-header"
			})), buf.push(">");
			if(pin.raw_text) {
				buf.push("<p"), buf.push(attrs({
					"class": "text"
				})), buf.push(">");
				var __val__ = format_text(pin.raw_text, pin.text_meta, {
					tag_icon: !0
				});
				buf.push(null == __val__ ? "" : __val__), buf.push("</p>")
			}
			buf.push("</div><div"), buf.push(attrs({
				"class": "info-body clearfix"
			})), buf.push("><div"), buf.push(attrs({
				"class": "info-left info-panel"
			})), buf.push("><div"), buf.push(attrs({
				"class": "info-line"
			})), buf.push(">编号:  " + escape((interp = creation_id) == null ? "" : interp) + "</div><div"), buf.push(attrs({
				"class": "info-line"
			})), buf.push(">原图尺寸:  " + escape((interp = width) == null ? "" : interp) + " x " + escape((interp = height) == null ? "" : interp) + " px</div>");
			var type = file.type.split("/")[1].toUpperCase(),
				fakeType = {
					JPEG: "JPG"
				};
			buf.push("<div"), buf.push(attrs({
				"class": "info-line"
			})), buf.push(">原图格式:  " + escape((interp = fakeType[type] ? fakeType[type] : type) == null ? "" : interp) + "</div>");
			var useage = creation.auth_method == 1 ? "商业用途" : creation.auth_method == 2 ? "编辑用途" : "原创作品,只展示不出售";
			buf.push("<div"), buf.push(attrs({
				"class": "info-line"
			})), buf.push(">用途:  " + escape((interp = useage) == null ? "" : interp) + "</div><div"), buf.push(attrs({
				"class": "info-line last"
			})), buf.push("><span>版权所有:  花瓣&nbsp;</span><a"), buf.push(attrs({
				href: "/" + pin.user.urlname + "",
				"class": "brown-link x"
			})), buf.push(">@" + escape((interp = pin.user.username) == null ? "" : interp) + "</a>"), creation.extra && creation.extra.auth && (buf.push("<span"), buf.push(attrs({
				id: "portrait",
				"class": "portrait icon"
			})), buf.push("></span>")), buf.push("</div></div>"), creation.auth_method != 3 && (buf.push("<div"), buf.push(attrs({
				"class": "info-right info-panel"
			})), buf.push("><div"), buf.push(attrs({
				"class": "size"
			})), buf.push("><label><input"), buf.push(attrs({
				type: "radio",
				name: "size",
				value: "ori"
			})), buf.push("/><span>原图</span><span"), buf.push(attrs({
				"class": "num"
			})), buf.push(">" + escape((interp = width) == null ? "" : interp) + " * " + escape((interp = height) == null ? "" : interp) + "</span></label><label><input"), buf.push(attrs({
				type: "radio",
				name: "size",
				value: "l"
			})), buf.push("/><span>大图</span><span"), buf.push(attrs({
				"class": "num"
			})), buf.push(">" + escape((interp = (.75 * width).toFixed(0)) == null ? "" : interp) + " * " + escape((interp = (.75 * height).toFixed(0)) == null ? "" : interp) + "</span></label><label><input"), buf.push(attrs({
				type: "radio",
				name: "size",
				value: "m"
			})), buf.push("/><span>中图</span><span"), buf.push(attrs({
				"class": "num"
			})), buf.push(">" + escape((interp = (.6 * width).toFixed(0)) == null ? "" : interp) + " * " + escape((interp = (.6 * height).toFixed(0)) == null ? "" : interp) + "</span></label><label><input"), buf.push(attrs({
				type: "radio",
				name: "size",
				value: "s",
				checked: !0
			})), buf.push("/><span>小图</span><span"), buf.push(attrs({
				"class": "num"
			})), buf.push(">" + escape((interp = (.5 * width).toFixed(0)) == null ? "" : interp) + " * " + escape((interp = (.5 * height).toFixed(0)) == null ? "" : interp) + "</span></label></div><div"), buf.push(attrs({
				"data-price": "" + creation.price + "",
				"class": "price"
			})), buf.push("><span"), buf.push(attrs({
				"class": "num"
			})), buf.push(">价格: ￥" + escape((interp = (creation.price * .5).toFixed(2)) == null ? "" : interp) + "</span><a"), buf.push(attrs({
				href: "/cc/help/#item_8",
				"class": "doubt icon"
			})), buf.push("></a></div></div>")), buf.push("</div>"), creation.auth_method != 3 && (!creation.type || creation.type == 2) && (buf.push("<div"), buf.push(attrs({
				"class": "info-footer"
			})), buf.push("><a"), buf.push(attrs({
				id: "download_creation",
				"data-id": creation_id,
				"data-type": is_material ? "material" : "creation",
				href: "#",
				onclick: "return false;",
				"class": "btn-with-icon btn btn18 rbtn"
			})), buf.push("><i"), buf.push(attrs({
				"class": "download-icon"
			})), buf.push("></i>"), is_owner ? buf.push("直接下载") : buf.push("授权下载"), buf.push("</a></div>")), buf.push('</div><script>(function(){app.page.portraitNoti=new SmoothNotification({duration:3e3,relative:{to:"portrait",position:"topcenter",offset:{x:0,y:-6}},arrow:"down",styles:{position:"absoute",padding:"4px 10px","font-size":"14px","border-radius":"2px"}}),document.id("portrait")&&document.id("portrait").addEvent("mouseenter",function(){if(document.getElement(".smooth-notification"))return;app.page.portraitNoti.show("肖像已授权")});var a=document.getElement(".creation-info .size");a&&a.addEvent("click:relay(input)",function(a){var b=this;b.getParent(".size").getElement("input:checked").checked=!1;var c=b.getParent(".info-panel").getElement(".price");b.checked=!0;var d=b.get("value"),e=c.get("data-price"),f={ori:1,xl:.85,l:.75,m:.6,s:.5},g=e*f[d];return c.getElement(".num").set("text","价格: ￥"+g.toFixed(2)),!1}),document.id("download_creation")&&document.id("download_creation").addEvent("click",function(){var a=$$("input[name=size]:checked")[0],b=this.get("data-id"),c=this.get("data-type");a?a=a.get("value"):a="s";var d="/cc/buy/?size="+a+"&id="+b+"&type="+c;window.open(d,"","",!1)})})()</script>')
		}
		return buf.join("")
	}, __t["base/pin_view_extra_imgs"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"class": "extra-imgs"
			})), buf.push("><div"), buf.push(attrs({
				"class": "more-imgs"
			})), buf.push("><div"), buf.push(attrs({
				"class": "imgs"
			})), buf.push(">");
			for(var i = 0; i < 4; i++) showcase[i] ? (buf.push("<a><img"), buf.push(attrs({
				src: imgURL(showcase[i], "sq140"),
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a>")) : buf.push("<a></a>");
			buf.push("</div><a"), buf.push(attrs({
				"class": "open"
			})), buf.push('>展开大图<i></i></a></div></div><script>(function(){var a=document.getElement(".pin-view .extra-imgs"),b=a.getElement(".more-imgs");b&&b.addEvent("click",function(){this.destroy(),app.page.pin.showcase.files.each(function(b){if(!b)return;(new Element("div.img-holder")).grab((new Element("a",{href:"/go/?pin_id="+app.page.pin.pin_id,"class":"img",rel:"nofollow",target:"_blank"})).grab(new Element("img",{src:app.imgURL(b,"fw658"),height:app.imgSize(b,"fw658").h}))).inject(a)})})})()</script>')
		}
		return buf.join("")
	}, __t["base/pin_view_gift_extra"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, hideFoo = "no-foo";
			if(commodity.title || commodity.price > 0) hideFoo = "";
			buf.push("<div"), buf.push(attrs({
				"class": "pin-info gift-info"
			})), buf.push(">");
			if(commodity.title || commodity.price > 0) {
				buf.push("<div"), buf.push(attrs({
					"class": "info-foo"
				})), buf.push(">");
				if(commodity.title) {
					buf.push("<div"), buf.push(attrs({
						id: "pin_commodity_bar",
						"class": "info-title"
					})), buf.push(">");
					var _css_class = commodity.store ? "store-" + commodity.store + " icon" : "icon";
					buf.push("<em"), buf.push(attrs({
						"class": "" + _css_class + ""
					})), buf.push("></em><h4>" + escape((interp = commodity.title) == null ? "" : interp) + "</h4></div>")
				}
				if(commodity.price > 0) {
					buf.push("<div"), buf.push(attrs({
						"class": "info-price"
					})), buf.push(">");
					var currency = commodity.extra && commodity.extra.currency ? commodity.extra.currency + " " : "￥";
					buf.push("<span"), buf.push(attrs({
						"class": "price-now"
					})), buf.push(">" + escape((interp = currency) == null ? "" : interp) + "" + escape((interp = commodity.price) == null ? "" : interp) + "</span></div>")
				}
				buf.push("<a"), buf.push(attrs({
					href: "/go/?pin_id=" + pin.pin_id + "",
					rel: "nofollow",
					target: "_blank",
					"class": "button goto-buy"
				})), buf.push(">立即购买</a></div>")
			}
			var targets = (commodity.extra["target:gent"] || []).concat(commodity.extra["target:lady"] || []).concat(commodity.extra["target:child"] || []),
				scenes = commodity.extra.scene || [],
				_scenes = scenes.slice(0, 8);
			if(targets.length || _scenes.length) {
				buf.push("<div"), buf.push(attrs({
					"class": "info-bar " + ("" + hideFoo + "")
				})), buf.push("><div"), buf.push(attrs({
					"class": "info-fit"
				})), buf.push(">");
				if(targets.length) {
					buf.push("<span"), buf.push(attrs({
						"class": "fit-title"
					})), buf.push(">适合对象:</span>");
					for(var $index = 0, $$l = (commodity.extra["target:gent"] || []).length; $index < $$l; $index++) {
						var target = (commodity.extra["target:gent"] || [])[$index];
						buf.push("<a"), buf.push(attrs({
							href: "/gift/goods/gent?target=" + target + "",
							"class": "brown-link fit-item"
						})), buf.push(">" + escape((interp = target) == null ? "" : interp) + "</a>")
					}
					for(var $index = 0, $$l = (commodity.extra["target:lady"] || []).length; $index < $$l; $index++) {
						var target = (commodity.extra["target:lady"] || [])[$index];
						buf.push("<a"), buf.push(attrs({
							href: "/gift/goods/lady?target=" + target + "",
							"class": "brown-link fit-item"
						})), buf.push(">" + escape((interp = target) == null ? "" : interp) + "</a>")
					}
					for(var $index = 0, $$l = (commodity.extra["target:child"] || []).length; $index < $$l; $index++) {
						var target = (commodity.extra["target:child"] || [])[$index];
						buf.push("<a"), buf.push(attrs({
							href: "/gift/goods/child?target=" + target + "",
							"class": "brown-link fit-item"
						})), buf.push(">" + escape((interp = target) == null ? "" : interp) + "</a>")
					}
				}
				buf.push("</div><div"), buf.push(attrs({
					"class": "info-fit info-fit-bottom"
				})), buf.push(">");
				var scenes = commodity.extra.scene || [],
					_scenes = scenes.slice(0, 8);
				if(_scenes.length) {
					buf.push("<span"), buf.push(attrs({
						"class": "fit-title"
					})), buf.push(">适合场合:</span>");
					for(var $index = 0, $$l = _scenes.length; $index < $$l; $index++) {
						var scene = _scenes[$index];
						buf.push("<a"), buf.push(attrs({
							href: "/gift/goods/scene/?scene=" + scene + "",
							"class": "brown-link fit-item"
						})), buf.push(">" + escape((interp = scene) == null ? "" : interp) + "</a>")
					}
				}
				buf.push("</div></div>")
			}
			buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/pin_view_layer"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "pin_view_layer"
			})), buf.push("><div"), buf.push(attrs({
				"class": "close-layer"
			})), buf.push("><i></i></div>");
			var __val__ = emerge("base/pin_view", locals);
			buf.push(null == __val__ ? "" : __val__), buf.push("<div"), buf.push(attrs({
				"class": "pin-view-arrows"
			})), buf.push("><a"), buf.push(attrs({
				style: "visibility: hidden",
				"class": "next x layer-view"
			})), buf.push("></a><a"), buf.push(attrs({
				style: "visibility: hidden",
				"class": "prev x layer-view"
			})), buf.push("></a></div><div"), buf.push(attrs({
				id: "layout_elevator_item",
				"class": "elevator-item"
			})), buf.push("><a"), buf.push(attrs({
				id: "layout_elevator",
				onclick: "return false;",
				title: "回到顶部",
				"class": "off"
			})), buf.push("></a><a"), buf.push(attrs({
				"class": "plus"
			})), buf.push("></a><div"), buf.push(attrs({
				"class": "plus-popup"
			})), buf.push("><div"), buf.push(attrs({
				"class": "group"
			})), buf.push("><a"), buf.push(attrs({
				onclick: "app.showUploadDialog();"
			})), buf.push(">添加采集<i"), buf.push(attrs({
				"class": "upload"
			})), buf.push("></i></a><a"), buf.push(attrs({
				"class": "add-board-item"
			})), buf.push(">添加画板<i"), buf.push(attrs({
				"class": "add-board"
			})), buf.push("></i></a><a"), buf.push(attrs({
				href: "/about/goodies/"
			})), buf.push(">安装采集工具<i"), buf.push(attrs({
				"class": "goodies"
			})), buf.push("></i></a></div><div"), buf.push(attrs({
				"class": "arr"
			})), buf.push("></div></div></div><div"), buf.push(attrs({
				style: "display: none",
				"data-img": imgURL(pin.file, suffix = ""),
				"class": "zoom-layer"
			})), buf.push("><div"), buf.push(attrs({
				"class": "holder"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "close-zoom"
			})), buf.push('></div></div><script>(function(){var a=document.id("pin_view_layer"),b=a.getElement(".close-layer"),c=app.page.$waterfall&&app.page.$waterfall.element,d=function(){app.go(app.$pinViewState.url),app.hidePinViewLayer(),c&&c.getElements(".view-on").removeClass("view-on")};a.addEvent("click",function(a){(a.target.id=="pin_view_layer"||~a.target.className.indexOf("pin-view-wrapper"))&&d()}),b.addEvent("click",d),function(){if(!app.page.$waterfall||!app.page.$waterfall.cells.length)return;var b=a.getElement(".pin-view-arrows .next"),d=a.getElement(".pin-view-arrows .prev"),e=app.page.$waterfall.element.getElement(".pin.view-on");e||(e=app.page.$waterfall.element.getElement(".pin[data-id=' + escape((interp = pin.pin_id) == null ? "" : interp) + ']"));if(!e)return;e.addClass("view-on");var f=e.getNext(".pin[data-id]"),g=e.getPrevious(".pin[data-id]");if(f){var h=f.get("data-id");b.set("href","/pins/"+h+"/").set("data-id",h).setStyle("visibility","visible")}if(g){var h=g.get("data-id");d.set("href","/pins/"+h+"/").set("data-id",h).setStyle("visibility","visible")}(new Elements([b,d])).addEvent("click",function(){var a=this.get("data-id");c.getElements(".view-on").removeClass("view-on"),c.getElement(".pin[data-id="+a+"]").addClass("view-on")}),(new Fx.Scroll(window)).toElementEdge(e,"y")}()})()</script></div>')
		}
		return buf.join("")
	}, __t["base/pin_view_material_extra"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, is_owner = this.req.user && pin.user_id === this.req.user.user_id,
				material = pin.material || {},
				file = material.file || {};
			buf.push("<div"), buf.push(attrs({
				"class": "pin-info creation-info wt"
			})), buf.push("><div"), buf.push(attrs({
				"class": "info-header"
			})), buf.push(">");
			if(pin.raw_text) {
				buf.push("<p"), buf.push(attrs({
					"class": "text"
				})), buf.push(">");
				var __val__ = format_text(pin.raw_text, pin.text_meta, {
					tag_icon: !0
				});
				buf.push(null == __val__ ? "" : __val__), buf.push("</p>")
			}
			buf.push("</div><div"), buf.push(attrs({
				"class": "info-body clearfix"
			})), buf.push("><div"), buf.push(attrs({
				"class": "info-left info-panel"
			})), buf.push("><div"), buf.push(attrs({
				"class": "info-line"
			})), buf.push(">编号:  " + escape((interp = material.material_id) == null ? "" : interp) + "</div>"), material.raw_resolution && material.raw_resolution != "0 x 0" ? (buf.push("<div"), buf.push(attrs({
				"class": "info-line"
			})), buf.push(">原图尺寸:  " + escape((interp = material.raw_resolution) == null ? "" : interp) + " px</div>")) : 2 == material.type && file.height && file.width && (buf.push("<div"), buf.push(attrs({
				"class": "info-line"
			})), buf.push(">原图尺寸:  " + escape((interp = file.width + "x" + file.height) == null ? "" : interp) + " px</div>")), material.raw_size && material.raw_size != "NaN x NaN cm" && (buf.push("<div"), buf.push(attrs({
				"class": "info-line"
			})), buf.push(">原图大小:  " + escape((interp = material.raw_size) == null ? "" : interp) + "</div>")), buf.push("<div"), buf.push(attrs({
				"class": "info-line"
			})), buf.push(">原图格式:  " + escape((interp = file.type && file.type.split("/")[1].toUpperCase() || "JPG") == null ? "" : interp) + "</div><div"), buf.push(attrs({
				"class": "info-line last"
			})), buf.push("><span>版权所有:  花瓣&nbsp;</span><a"), buf.push(attrs({
				href: "/" + pin.user.urlname + "",
				"class": "brown-link x"
			})), buf.push(">@" + escape((interp = pin.user.username) == null ? "" : interp) + "</a></div></div>");
			if(material.prices && material.prices.length) {
				buf.push("<div"), buf.push(attrs({
					"class": "info-right info-panel"
				})), buf.push("><div"), buf.push(attrs({
					"class": "size material"
				})), buf.push(">");
				for(var $index = 0, $$l = material.prices.length; $index < $$l; $index++) {
					var price = material.prices[$index];
					price.resolution != "0 x 0" && (buf.push("<label><span>" + escape((interp = price.name) == null ? "" : interp) + "</span>"), price.resolution ? (buf.push("<span"), buf.push(attrs({
						"class": "num"
					})), buf.push(">" + escape((interp = price.resolution) == null ? "" : interp) + " px</span>")) : price.size && (buf.push("<span"), buf.push(attrs({
						"class": "num"
					})), buf.push(">" + escape((interp = price.size) == null ? "" : interp) + "</span>")), buf.push("<span"), buf.push(attrs({
						"class": "price"
					})), buf.push(">￥" + escape((interp = price.price) == null ? "" : interp) + "</span></label>"))
				}
				buf.push("</div></div>")
			}
			buf.push("</div>"), material.type !== 2 && (buf.push("<div"), buf.push(attrs({
				"class": "info-footer"
			})), buf.push("><a"), buf.push(attrs({
				href: "/go/?pin_id=" + pin.pin_id + "",
				target: "_blank",
				rel: "nofollow",
				"class": "btn-with-icon btn btn18"
			})), buf.push(">去购买</a></div>")), buf.push("</div><script>(function(){})()</script>")
		}
		return buf.join("")
	}, __t["base/pin_view_page"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "pin_view_page"
			})), buf.push(">");
			var __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/pin_view");
			buf.push(null == __val__ ? "" : __val__), buf.push("</div><script>app.page.noPinViewLayer=!0</script>")
		}
		return buf.join("")
	}, __t["base/pin_view_recommend"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, recommend_pin_mixin = function(e) {
					if(e) {
						buf.push("<div"), buf.push(attrs({
							"class": "recommend-pin"
						})), buf.push("><a"), buf.push(attrs({
							href: "/pins/" + e.pin_id + "/",
							onclick: "try{ga('send', 'event', 'Pin Recommend Links', '/pins/" + e.pin_id + "/');}catch(e){}",
							"class": "img x"
						})), buf.push("><img"), buf.push(attrs({
							width: "180",
							height: "180",
							src: imgURL(e.file, "sq320"),
							"data-baiduimageplus-ignore": 1
						})), buf.push("/>"), e.commodity && e.commodity.price && (buf.push("<div"), buf.push(attrs({
							"class": "price"
						})), buf.push(">" + escape((interp = "￥" + e.commodity.price.toFixed(2)) == null ? "" : interp) + "</div>")), buf.push("</a><div"), buf.push(attrs({
							"class": "description"
						})), buf.push("><div"), buf.push(attrs({
							"class": "inner"
						})), buf.push(">");
						var t = format_text(e.raw_text, e.text_meta);
						buf.push(null == t ? "" : t), buf.push("</div></div></div>")
					}
				},
				recommend_board_mixin = function(e) {
					buf.push("<div"), buf.push(attrs({
						"class": "recommend-board"
					})), buf.push("><h4>" + escape((interp = e.title) == null ? "" : interp) + "</h4><div"), buf.push(attrs({
						"class": "stats"
					})), buf.push("><span"), buf.push(attrs({
						"class": "pin-count"
					})), buf.push(">" + escape((interp = e.pin_count) == null ? "" : interp) + "采集</span><span"), buf.push(attrs({
						"class": "form"
					})), buf.push(">来自：<a"), buf.push(attrs({
						href: "/" + e.user.urlname + "/"
					})), buf.push(">" + escape((interp = e.user.username) == null ? "" : interp) + "</a></span></div><a"), buf.push(attrs({
						href: "/boards/" + e.board_id + "/",
						onclick: "try{ga('send', 'event', 'Pin Recommend Board Link', '/boards/" + e.board_id + "/');}catch(e){}",
						"class": "pins clearfix x"
					})), buf.push("><div"), buf.push(attrs({
						"class": "el main"
					})), buf.push("><img"), buf.push(attrs({
						width: "213",
						height: "213",
						src: imgURL(e.pins[0].file, "sq320"),
						"data-baiduimageplus-ignore": 1
					})), buf.push("/></div><div"), buf.push(attrs({
						"class": "others"
					})), buf.push(">");
					for(var t = 1; e.pins[t] && t <= 6; t++) buf.push("<div"), buf.push(attrs({
						"class": "el"
					})), buf.push("><img"), buf.push(attrs({
						width: "104",
						height: "104",
						src: imgURL(e.pins[t].file, "sq120"),
						"data-baiduimageplus-ignore": 1
					})), buf.push("/></div>");
					buf.push("</div></a><a"), buf.push(attrs({
						"data-board-id": e.board_id,
						href: "#",
						onclick: "return false;",
						"class": "follow-btn btn wbtn"
					})), buf.push("><strong> 关注</strong><span></span></a></div>")
				};
			buf.push("<div"), buf.push(attrs({
				"class": "recommend-pins-unit clearfix"
			})), buf.push(">");
			for(var i = 0; i < 3; i++) recommend_pin_mixin(pins.pop());
			buf.push("</div><div"), buf.push(attrs({
				"class": "recommend-pins-unit clearfix"
			})), buf.push(">");
			for(var i = 0; i < 3; i++) recommend_pin_mixin(pins.pop());
			buf.push("</div>"), typeof boards != "undefined" && boards[0] && boards[0].pins && boards[0].pins.length > 0 && recommend_board_mixin(boards[0]), buf.push("<div"), buf.push(attrs({
				"class": "recommend-pins-unit clearfix"
			})), buf.push(">");
			for(var i = 0; i < 3; i++) recommend_pin_mixin(pins.pop());
			buf.push('</div><script>(function(){var a=document.getElement("#related_recommend .recommend-board"),b=document.getElement("#related_recommend .follow-btn");b&&b.addEvent("click",function(){var a=b.get("data-board-id"),c=(new Button(b)).disable();if(!app.req.user)return app.requireLogin();b.hasClass("unfollow")?(c.setTitle("取消..."),(new Request.JSON({url:"/boards/"+a+"/unfollow/",onSuccess:function(a){if(a.err)return c.setTitle("已关注"),app.error(a.msg||app.COMMON_ERRMSG);b.removeClass("unfollow").addClass("follow"),c.setTitle("关注").enable()}})).post()):(c.setTitle("关注..."),(new Request.JSON({url:"/boards/"+a+"/follow/",onSuccess:function(a){if(a.err)return c.setTitle("关注"),app.error(a.msg||app.COMMON_ERRMSG);b.addClass("unfollow").removeClass("follow"),c.setTitle("已关注").enable()}})).post())})})()</script>')
		}
		return buf.join("")
	}, __t["base/pin_view_zoom"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, pin = page.pin;
			buf.push("<div"), buf.push(attrs({
				id: "zoomr"
			})), buf.push("><div"), buf.push(attrs({
				id: "zoomr_toolbar"
			})), buf.push("><div"), buf.push(attrs({
				"class": "bg"
			})), buf.push("></div><div"), buf.push(attrs({
				"class": "fg"
			})), buf.push("><a"), buf.push(attrs({
				id: "zoomr_logo",
				href: "/"
			})), buf.push("><img"), buf.push(attrs({
				src: "/img/logo_grey.png",
				width: "98",
				height: "34",
				alt: "花瓣",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a><a"), buf.push(attrs({
				id: "zoomr_hide",
				href: "/pins/" + pin.pin_id + "/",
				title: "返回"
			})), buf.push(">返回</a></div></div><div"), buf.push(attrs({
				id: "zoomr_body"
			})), buf.push("><img"), buf.push(attrs({
				id: "zoomr_img",
				src: "" + imgURL(pin.file, suffix = "") + "",
				width: "" + pin.file.width + "",
				height: "" + pin.file.height + "",
				alt: "采集图片",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></div></div>")
		}
		return buf.join("")
	}, __t["base/promote_user_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, user = puser.user,
				avatar = user.avatar,
				bg = "//" + avatar.bucket + ".b0.upaiyun.com/" + avatar.key + "_/sq/236/gaussblur/0x20/gifto/jpg";
			buf.push("<div"), buf.push(attrs({
				style: "background-image: url(" + bg + ");",
				"data-seq": "" + puser.updated_at + "",
				"class": "pin wfc user"
			})), buf.push("><div"), buf.push(attrs({
				"class": "image"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + user.urlname + "",
				title: "" + user.username + "",
				"class": "avatar"
			})), buf.push(">");
			var __val__ = img(user.avatar, "sq120");
			buf.push(null == __val__ ? "" : __val__), buf.push("</a></div><div"), buf.push(attrs({
				"class": "profile"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + user.urlname + "/",
				"class": "username"
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + ""), user.extra && user.extra.is_museuser && (buf.push("<img"), buf.push(attrs({
				src: "/img/medals/icon_designer.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon"
			})), buf.push("/>")), buf.push("</a><div"), buf.push(attrs({
				"class": "description"
			})), buf.push(">");
			var profile = user.profile;
			buf.push("<div"), buf.push(attrs({
				"class": "personal"
			})), buf.push(">"), "1" === profile.sex ? (buf.push("<div"), buf.push(attrs({
				"class": "meta"
			})), buf.push(">男</div>")) : "2" === profile.sex ? (buf.push("<div"), buf.push(attrs({
				"class": "meta"
			})), buf.push(">女</div>")) : (buf.push("<div"), buf.push(attrs({
				"class": "meta"
			})), buf.push(">保密</div>"));
			if(profile.location) {
				var location = profile.location || "";
				5 < location.length && (location = location.slice(0, 5) + "..."), buf.push("<div"), buf.push(attrs({
					"class": "meta"
				})), buf.push(">" + escape((interp = location) == null ? "" : interp) + "</div>")
			}
			if(profile.job) {
				var job = profile.job || "";
				5 < job.length && (job = job.slice(0, 5) + "..."), buf.push("<div"), buf.push(attrs({
					"class": "meta"
				})), buf.push(">" + escape((interp = job) == null ? "" : interp) + "</div>")
			}
			buf.push("</div></div><div"), buf.push(attrs({
				"class": "pins"
			})), buf.push("><span"), buf.push(attrs({
				"class": "meta"
			})), buf.push(">" + escape((interp = user.pin_count) == null ? "" : interp) + "采集</span><span"), buf.push(attrs({
				"class": "meta"
			})), buf.push(">" + escape((interp = user.follower_count) == null ? "" : interp) + "粉丝</span></div><div"), buf.push(attrs({
				"class": "buttons"
			})), buf.push(">");
			var yourself = req.user || {};
			yourself.urlname !== user.urlname && (user.following ? (buf.push("<button"), buf.push(attrs({
				"data-urlname": "" + user.urlname + "",
				"class": "btn"
			})), buf.push(">取消关注</button>")) : (buf.push("<button"), buf.push(attrs({
				"data-urlname": "" + user.urlname + "",
				"class": "btn"
			})), buf.push(">关注</button>"))), buf.push("</div></div></div>")
		}
		return buf.join("")
	}, __t["base/promote_users"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, categories = {};
			for(var i = 0; i < settings.categories.length; i++) categories[settings.categories[i].id] = settings.categories[i].name;
			var _pusers = page.pusers,
				__val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/ctx_bar", {
				filter: page.filter,
				qt: null,
				qn: null,
				categories: categories,
				settings: settings,
				user_info: page.user_info,
				_url: page.$url,
				promotion: req.promotions.ctxbar_promotions
			});
			buf.push(null == __val__ ? "" : __val__), buf.push("<div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push(">");
			if(_pusers && _pusers.length > 0) {
				buf.push("<div"), buf.push(attrs({
					id: "waterfall",
					"class": "promote users"
				})), buf.push(">");
				for(var $index = 0, $$l = _pusers.length; $index < $$l; $index++) {
					var puser = _pusers[$index],
						__val__ = emerge("base/promote_user_item", {
							puser: puser,
							req: req
						});
					buf.push(null == __val__ ? "" : __val__)
				}
				buf.push("</div><div"), buf.push(attrs({
					"class": "loading"
				})), buf.push("><img"), buf.push(attrs({
					src: "/img/loading.gif",
					alt: "loading",
					"data-baiduimageplus-ignore": 1
				})), buf.push("/><span>正在加载</span></div>")
			}
			buf.push('</div><script>(function(){function a(){function f(){if(c)return;var e=a.getLast(".pin.wfc.user"),g=window.getSize().y,h=window.getScroll().y,i=e.getPosition().y+e.getDimensions().height;if(g+h<i)return;c=!0,d.show(),(new Request.JSON({url:app.page.$url,data:{max:e.get("data-seq"),limit:b},noCache:!0,onSuccess:function(c){if(c.err)return alert(c.msg||app.COMMON_ERRMSG);if(c.pusers&&c.pusers.length){var e="";c.pusers.each(function(a){e+=app.renderSync("base/promote_user_item",{puser:a,req:app.req})});var g=Elements.from(e);a.adopt(g)}c.pusers.length<b?(d.set("html",\'<img src="/img/end.png" alt="end" />\').show(),window.removeEvent("scroll",f)):d.hide()},onComplete:function(){c=!1}})).get()}var a=document.getElement("#waterfall");if(!a)return;var b=12,c=!1,d=a.getNext(".loading");window.addEvent("scroll",f);var e=function(){var a=16,b=$$(".wrapper");windowInnerWidth=window.innerWidth,windowInnerWidth<=1275?b.setStyle("width",996+a):windowInnerWidth>1275&&windowInnerWidth<=1528?b.setStyle("width",1244+a):b.setStyle("width",1496+a)};e(),window.addEvent("resize",e)}function b(){if(app.view.retrieve("followuserbutton"))return;app.view.addEvent("click:relay(.pin.wfc.user .buttons .btn)",function(a){function e(){b.hasClass("unfollow")?(d.setTitle("Unfollowing..."),(new Request.JSON({url:"/"+c+"/unfollow/",onSuccess:function(a){if(a.err)return d.setTitle("取消关注"),app.error(a.msg||app.COMMON_ERRMSG);b.removeClass("unfollow").addClass("follow"),d.setTitle("关注").enable()}})).post()):(d.setTitle("Following..."),(new Request.JSON({url:"/"+c+"/follow/",onSuccess:function(a){if(a.err)return d.setTitle("关注"),app.error(a.msg||app.COMMON_ERRMSG);b.addClass("unfollow").removeClass("follow"),d.setTitle("取消关注").enable()}})).post())}var b=a.target,c=b.get("data-urlname"),d=(new Button(b)).disable();if(app.req.user)return e();app.requireLogin(function(){b=app.view.getElement(".pin.wfc.user .buttons .btn[data-urlname="+c+"]"),b?e():app.error("这就是你自己")})}),app.view.store("followuserbutton",!0)}function c(){if(app.view.retrieve("followboardbutton"))return;app.view.addEvent("click:relay(.promote-user .board a.follow, .promote-user .board a.unfollow)",function(a){function e(){b.hasClass("unfollow")?(d.setTitle("取消..."),(new Request.JSON({url:"/boards/"+c+"/unfollow/",onSuccess:function(a){if(a.err)return d.setTitle("已关注"),app.error(a.msg||app.COMMON_ERRMSG);b.removeClass("unfollow").addClass("follow"),d.setTitle("关注").enable()}})).post()):(d.setTitle("关注..."),(new Request.JSON({url:"/boards/"+c+"/follow/",onSuccess:function(a){if(a.err)return d.setTitle("关注"),app.error(a.msg||app.COMMON_ERRMSG);b.addClass("unfollow").removeClass("follow"),d.setTitle("已关注").enable()}})).post())}var b=a.target;b.get("tag")!=="a"&&(b=b.getParent("a"));var c=b.get("data-id"),d=(new Button(b)).disable();if(app.req.user)return e();app.requireLogin(function(){b=app.view.getElement(".promote-user .board a[data-id="+c+"].follow"),b?e():app.error("这个画板是你自己的")})}),app.view.store("followboardbutton")}function d(){if(app.view.retrieve("likeboardbutton"))return;app.view.addEvent("click:relay(.promote-user .board a.like, .promote-user .board a.unlike)",function(a){function g(){b.hasClass("like")?(new Request.JSON({url:"/boards/"+c+"/like/",onSuccess:function(a){a.err?app.error(a.msg||app.COMMON_ERRMSG):(b.addClass("unlike").removeClass("like"),f++,d.setTitle(f+"喜欢"))},onComplete:function(){d.enable()}})).post():b.hasClass("unlike")&&(new Request.JSON({url:"/boards/"+c+"/unlike/",onSuccess:function(a){if(a.err)app.error(a.msg||app.COMMON_ERRMSG);else{b.addClass("like").removeClass("unlike"),f--;var c=f>0?f+"喜欢":"喜欢";d.setTitle(c)}},onComplete:function(){d.enable()}})).post()}var b=a.target;b.get("tag")!=="a"&&(b=b.getParent("a"));var c=b.get("data-id"),d=(new Button(b)).disable(),e=b.getElement("strong").get("text"),f=e.toInt();f=isNaN(f)?0:f;if(app.req.user)return g();app.requireLogin(function(){b=app.view.getElement(".promote-user .board a[data-id="+c+"].like"),b?g():app.error("这个画板是你自己的")})}),app.view.store("likeboardbutton")}a(),b(),c(),d(),$$(".self-promote").addEvent("click",function(){var a=app.page.filter.split(":"),b=a[1]==="popular"?"popular":a[2],c=(new Button(this)).disable();c.setTitle("推荐自己..."),(new Request.JSON({url:"/users/"+app.req.user.user_id+"/promoted/",data:{category:b},onSuccess:function(a){a.err?app.error(a.msg||app.COMMON_ERRMSG):a.promoted?app.showDialog("already_promoted"):app.showDialog("self_promote")},onError:function(a,b){app.error(b||app.COMMON_ERRMSG)},onComplete:function(){c.setTitle("推荐自己"),c.enable()}})).get()})})()</script>')
		}
		return buf.join("")
	}, __t["base/promotions"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			promotions = promotions || {
				img_promotions: [],
				reading_promotions: []
			}, buf.push("<div"), buf.push(attrs({
				"class": "wfc topright promotions"
			})), buf.push(">");
			var __val__ = emerge("base/image_promotions", {
				promotions: promotions.img_promotions || []
			});
			buf.push(null == __val__ ? "" : __val__);
			var __val__ = emerge("base/reading_promotions", {
				promotions: promotions.reading_promotions || []
			});
			buf.push(null == __val__ ? "" : __val__), buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/reading_promotions"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			if(promotions && promotions.length > 0) {
				buf.push("<div"), buf.push(attrs({
					"class": "reading-promotions"
				})), buf.push("><h3>推荐阅读</h3>");
				var per_page = 3,
					page = 0,
					total_pages = Math.floor((promotions.length - 1) / per_page) + 1,
					current_page = Math.floor(Math.random() * total_pages + 1);
				while(promotions.length > 0) {
					var promotions_per_page = promotions.splice(0, per_page),
						style = "";
					page++, page != current_page && (style = "display: none;"), buf.push("<ul"), buf.push(attrs({
						style: "" + style + "",
						"class": "page" + page + ""
					})), buf.push(">");
					for(var $index = 0, $$l = promotions_per_page.length; $index < $$l; $index++) {
						var promotion = promotions_per_page[$index];
						buf.push("<li"), buf.push(attrs({
							"class": "reading-item"
						})), buf.push(">");
						var image_url = "",
							target = promotion.new_tab ? "_blank" : "_self";
						promotion.image && (image_url = "//" + this.settings.hbfile[promotion.image.bucket] + "/img/promotion/" + promotion.image.key), buf.push("<a"), buf.push(attrs({
							href: "" + promotion.url + "",
							target: "" + target + ""
						})), buf.push("><img"), buf.push(attrs({
							src: "" + image_url + "",
							height: "50",
							width: "50",
							alt: !0,
							"data-baiduimageplus-ignore": 1
						})), buf.push("/></a><h4><a"), buf.push(attrs({
							href: "" + promotion.url + "",
							target: "" + target + ""
						})), buf.push(">" + escape((interp = promotion.title) == null ? "" : interp) + "</a></h4><div"), buf.push(attrs({
							"class": "subtitle"
						})), buf.push(">" + escape((interp = promotion.sub_title) == null ? "" : interp) + "</div></li>")
					}
					buf.push("</ul>")
				}
				if(total_pages > 1) {
					buf.push("<ul"), buf.push(attrs({
						"class": "pager"
					})), buf.push(">");
					for(var i = 1; i <= page; i++) {
						var li_class = "";
						i == current_page && (li_class = "current"), buf.push("<li"), buf.push(attrs({
							"data-page": "" + i + "",
							"class": "" + li_class + ""
						})), buf.push(">●</li>")
					}
					buf.push("</ul>")
				}
				buf.push("</div>")
			}
			buf.push('<script>(function(){var a=$$(".reading-promotions ul.pager li");a.length>0&&a.addEvent("click",function(){if(this.hasClass("current"))return;var a=$$(".reading-promotions ul.pager li.current")[0],b=a.get("data-page"),c=$$(".reading-promotions ul.page"+b)[0],d=this.get("data-page"),e=$$(".reading-promotions ul.page"+d)[0];c.hide(),a.removeClass("current"),this.addClass("current"),e.show(),app.page.$waterfall.update(this.getParent(".promotions"))}),app.gaqTrackPromotion(".reading-promotions",{category:"category_reading_promotions",useTargetUrlAsLabel:!0,elementEvent:"click:relay(.reading-item a)"})})()</script>')
		}
		return buf.join("")
	}, __t["base/recommend"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "recommend_container",
				"class": "recommend-container"
			})), buf.push(">");
			var key = rows + 1,
				newRecommends = [];
			for(var i = 0; i < recommends.length; i += 3) recommends.slice(i, i + 3).length > 2 && newRecommends.push(recommends.slice(i, i + 3));
			for(var $index = 0, $$l = newRecommends.length; $index < $$l; $index++) {
				var item = newRecommends[$index];
				buf.push("<div"), buf.push(attrs({
					"class": "recommend-container-row clearfix"
				})), buf.push(">");
				var row = key % 2;
				if(row) {
					var __val__ = emerge("base/recommend_item_two", {
						recommendItem: item.slice(0, 2)
					});
					buf.push(null == __val__ ? "" : __val__);
					var __val__ = emerge("base/recommend_item_one", {
						recommendItem: item.slice(2, 3),
						row: row
					});
					buf.push(null == __val__ ? "" : __val__)
				} else {
					var __val__ = emerge("base/recommend_item_one", {
						recommendItem: item.slice(0, 1),
						row: row
					});
					buf.push(null == __val__ ? "" : __val__);
					var __val__ = emerge("base/recommend_item_two", {
						recommendItem: item.slice(1, 3)
					});
					buf.push(null == __val__ ? "" : __val__)
				}
				key++, buf.push("</div>")
			}
			buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/recommend_boards"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, file = board.pins && board.pins.length && board.pins[0].file || null,
				categoryName = filter.split(":")[2],
				bgUrl = imgURL(file, "sq236bl4");
			buf.push("<div"), buf.push(attrs({
				"class": "recommend boards"
			})), buf.push("><a"), buf.push(attrs({
				href: "/boards/favorite/" + categoryName + "",
				"class": "header"
			})), buf.push(">推荐画板<div"), buf.push(attrs({
				"class": "more link"
			})), buf.push(">»</div></a><div"), buf.push(attrs({
				"class": "image"
			})), buf.push("><a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "/"
			})), buf.push(">");
			var __val__ = img(file, "sq320");
			buf.push(null == __val__ ? "" : __val__), buf.push("</a><div"), buf.push(attrs({
				style: "background-image: url(" + bgUrl + ")",
				"class": "wrap"
			})), buf.push("><div"), buf.push(attrs({
				"class": "description"
			})), buf.push("><a"), buf.push(attrs({
				href: "/boards/" + board.board_id + "",
				"class": "title"
			})), buf.push(">" + escape((interp = board.title) == null ? "" : interp) + "</a><span"), buf.push(attrs({
				"class": "info"
			})), buf.push(">" + escape((interp = board.pin_count) == null ? "" : interp) + " 采集</span><span"), buf.push(attrs({
				"class": "info"
			})), buf.push(">" + escape((interp = board.follow_count) == null ? "" : interp) + " 关注</span></div></div></div><div"), buf.push(attrs({
				"class": "footer attribution"
			})), buf.push(">来自");
			var user = board.user;
			buf.push("<a"), buf.push(attrs({
				href: "/" + user.urlname + "/",
				title: "来自于" + user.username + "",
				"class": "link"
			})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + "</a></div></div>")
		}
		return buf.join("")
	}, __t["base/recommend_item_one"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, item = recommendItem[0],
				itemType = item.type;
			itemType == "users" && (buf.push("<div"), buf.push(attrs({
				"class": "recommend-hidebox pl-right"
			})), buf.push(">"), row ? (buf.push("<div"), buf.push(attrs({
				"class": "recommend-userbox recommend-box"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + item.urlname + "/",
				"class": "avt"
			})), buf.push("><img"), buf.push(attrs({
				src: "" + imgURL(item.avatar || this.settings.default_avatar_img, "sq320") + "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a><a"), buf.push(attrs({
				style: "background:url(" + imgURL(item.avatar || this.settings.default_avatar_img, "sq308bl20") + ") no-repeat",
				"class": "avt-bg"
			})), buf.push("></a></div><div"), buf.push(attrs({
				"class": "recommend-infobox user recommend-box big"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data user"
			})), buf.push("></div><h2"), buf.push(attrs({
				"class": "user"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + item.urlname + "/"
			})), buf.push(">" + escape((interp = item.username) == null ? "" : interp) + "</a></h2><p><span>" + escape((interp = item.pin_count) == null ? "" : interp) + " 采集</span><span>" + escape((interp = item.follow_count) == null ? "" : interp) + " 粉丝</span></p><div"), buf.push(attrs({
				"class": "info-tra-left big"
			})), buf.push("></div></div>")) : (buf.push("<div"), buf.push(attrs({
				"class": "recommend-infobox user recommend-box pl-right big"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data user"
			})), buf.push("></div><h2"), buf.push(attrs({
				"class": "user"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + item.urlname + "/"
			})), buf.push(">" + escape((interp = item.username) == null ? "" : interp) + "</a></h2><p><span>" + escape((interp = item.pin_count) == null ? "" : interp) + " 采集</span><span>" + escape((interp = item.follow_count) == null ? "" : interp) + " 粉丝</span></p><div"), buf.push(attrs({
				"class": "info-tra-right big"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "recommend-userbox recommend-box"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + item.urlname + "/",
				"class": "avt"
			})), buf.push("><img"), buf.push(attrs({
				src: "" + imgURL(item.avatar || this.settings.default_avatar_img, "sq320") + "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a><a"), buf.push(attrs({
				style: "background:url(" + imgURL(item.avatar || this.settings.default_avatar_img, "sq308bl20") + ") no-repeat",
				"class": "avt-bg"
			})), buf.push("></a></div>")), buf.push("</div>")), itemType == "explores" && (buf.push("<div"), buf.push(attrs({
				"class": "recommend-hidebox pl-right"
			})), buf.push(">"), row ? (buf.push("<div"), buf.push(attrs({
				"class": "recommend-imgbox recommend-box"
			})), buf.push("><a"), buf.push(attrs({
				href: "/explore/" + item.urlname + "/"
			})), buf.push("><img"), buf.push(attrs({
				src: "" + imgURL(item.cover, "sq320") + "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a></div><div"), buf.push(attrs({
				"class": "recommend-infobox explore recommend-box big"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data explore"
			})), buf.push("></div><h2><a"), buf.push(attrs({
				href: "/explore/" + item.urlname + "/"
			})), buf.push(">" + escape((interp = item.title) == null ? "" : interp) + "</a></h2><p"), buf.push(attrs({
				style: "display:none;"
			})), buf.push("><span>" + escape((interp = item.follow_count) == null ? "" : interp) + " 关注</span></p><div"), buf.push(attrs({
				"class": "info-tra-left big"
			})), buf.push("></div></div>")) : (buf.push("<div"), buf.push(attrs({
				"class": "recommend-infobox explore recommend-box pl-right big"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data explore"
			})), buf.push("></div><h2><a"), buf.push(attrs({
				href: "/explore/" + item.urlname + "/"
			})), buf.push(">" + escape((interp = item.title) == null ? "" : interp) + "</a></h2><p"), buf.push(attrs({
				style: "display:none;"
			})), buf.push("><span>" + escape((interp = item.follow_count) == null ? "" : interp) + " 关注</span></p><div"), buf.push(attrs({
				"class": "info-tra-right big"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "recommend-imgbox recommend-box"
			})), buf.push("><a"), buf.push(attrs({
				href: "/explore/" + item.urlname + "/"
			})), buf.push("><img"), buf.push(attrs({
				src: "" + imgURL(item.cover, "sq320") + "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a></div>")), buf.push("</div>")), itemType == "boards" && (buf.push("<div"), buf.push(attrs({
				"class": "recommend-hidebox pl-right"
			})), buf.push(">"), row ? (buf.push("<div"), buf.push(attrs({
				"class": "recommend-imgbox recommend-box"
			})), buf.push("><a"), buf.push(attrs({
				href: "/boards/" + item.board_id + "/"
			})), buf.push("><img"), buf.push(attrs({
				src: "" + imgURL(item.cover, "sq320") + "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a></div><div"), buf.push(attrs({
				"class": "recommend-infobox board recommend-box big"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data board"
			})), buf.push("></div><h2><a"), buf.push(attrs({
				href: "/boards/" + item.board_id + "/"
			})), buf.push(">" + escape((interp = item.title) == null ? "" : interp) + "</a></h2><p><span>" + escape((interp = item.pin_count) == null ? "" : interp) + " 采集</span><span>" + escape((interp = item.follow_count) == null ? "" : interp) + " 粉丝</span></p><span>来自<a"), buf.push(attrs({
				href: "/" + item.user.urlname + "/",
				rel: "nofollow"
			})), buf.push(">" + escape((interp = item.user.username) == null ? "" : interp) + "</a></span><div"), buf.push(attrs({
				"class": "info-tra-left big"
			})), buf.push("></div></div>")) : (buf.push("<div"), buf.push(attrs({
				"class": "recommend-infobox board recommend-box pl-right big"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data board"
			})), buf.push("></div><h2><a"), buf.push(attrs({
				href: "/boards/" + item.board_id + "/"
			})), buf.push(">" + escape((interp = item.title) == null ? "" : interp) + "</a></h2><p><span>" + escape((interp = item.pin_count) == null ? "" : interp) + " 采集</span><span>" + escape((interp = item.follow_count) == null ? "" : interp) + " 粉丝</span></p><span>来自<a"), buf.push(attrs({
				href: "/" + item.user.urlname + "/",
				rel: "nofollow"
			})), buf.push(">" + escape((interp = item.user.username) == null ? "" : interp) + "</a></span><div"), buf.push(attrs({
				"class": "info-tra-right big"
			})), buf.push("></div></div><div"), buf.push(attrs({
				"class": "recommend-imgbox recommend-box"
			})), buf.push("><a"), buf.push(attrs({
				href: "/boards/" + item.board_id + "/"
			})), buf.push("><img"), buf.push(attrs({
				src: "" + imgURL(item.cover, "sq320") + "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a></div>")), buf.push("</div>"))
		}
		return buf.join("")
	}, __t["base/recommend_item_two"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, itemOne = recommendItem[0],
				itemTwo = recommendItem[1];
			itemOne.type == "boards" || itemOne.type == "explores" ? (buf.push("<div"), buf.push(attrs({
				"class": "recommend-imgbox recommend-box"
			})), buf.push("><a"), buf.push(attrs({
				href: itemOne.type == "boards" ? "/boards/" + itemOne.board_id + "/" : "/explore/" + itemOne.urlname + "/"
			})), buf.push("><img"), buf.push(attrs({
				src: "" + imgURL(itemOne.cover, "sq320") + "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a></div>")) : itemOne.type == "users" && (buf.push("<div"), buf.push(attrs({
				"class": "recommend-userbox recommend-box"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + itemOne.urlname + "/",
				"class": "avt"
			})), buf.push("><img"), buf.push(attrs({
				src: "" + imgURL(itemOne.avatar || this.settings.default_avatar_img, "sq320") + "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a><a"), buf.push(attrs({
				style: "background:url(" + imgURL(itemOne.avatar || this.settings.default_avatar_img, "sq308bl20") + ") no-repeat",
				"class": "avt-bg"
			})), buf.push("></a></div>")), buf.push("<div"), buf.push(attrs({
				"class": "recommend-box"
			})), buf.push(">"), itemOne.type == "boards" ? (buf.push("<div"), buf.push(attrs({
				"class": "recommend-infobox board small"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data board"
			})), buf.push("></div><h2><a"), buf.push(attrs({
				href: "/boards/" + itemOne.board_id + "/"
			})), buf.push(">" + escape((interp = itemOne.title) == null ? "" : interp) + "</a></h2><p><span>" + escape((interp = itemOne.pin_count) == null ? "" : interp) + " 采集</span><span>" + escape((interp = itemOne.follow_count) == null ? "" : interp) + " 粉丝</span></p><span>来自<a"), buf.push(attrs({
				href: "/" + itemOne.user.urlname + "/",
				rel: "nofollow"
			})), buf.push(">" + escape((interp = itemOne.user.username) == null ? "" : interp) + "</a></span></div>")) : itemOne.type == "explores" ? (buf.push("<div"), buf.push(attrs({
				"class": "recommend-infobox explore small"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data explore"
			})), buf.push("></div><h2><a"), buf.push(attrs({
				href: "/explore/" + itemOne.urlname + "/"
			})), buf.push(">" + escape((interp = itemOne.title) == null ? "" : interp) + "</a></h2><p"), buf.push(attrs({
				style: "display:none;"
			})), buf.push("><span>" + escape((interp = itemOne.follow_count) == null ? "" : interp) + " 关注</span></p></div>")) : itemOne.type == "users" && (buf.push("<div"), buf.push(attrs({
				"class": "recommend-infobox user small"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data user"
			})), buf.push("></div><h2"), buf.push(attrs({
				"class": "user"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + itemOne.urlname + "/"
			})), buf.push(">" + escape((interp = itemOne.username) == null ? "" : interp) + "</a></h2><p><span>" + escape((interp = itemOne.pin_count) == null ? "" : interp) + " 采集</span><span>" + escape((interp = itemOne.follow_count) == null ? "" : interp) + " 粉丝</span></p></div>")), buf.push("<div"), buf.push(attrs({
				"class": "info-tra-left"
			})), buf.push("></div>"), itemTwo.type == "boards" ? (buf.push("<div"), buf.push(attrs({
				"class": "recommend-infobox board small pl-right"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data board"
			})), buf.push("></div><h2><a"), buf.push(attrs({
				href: "/boards/" + itemTwo.board_id + "/"
			})), buf.push(">" + escape((interp = itemTwo.title) == null ? "" : interp) + "</a></h2><p><span>" + escape((interp = itemTwo.pin_count) == null ? "" : interp) + " 采集</span><span>" + escape((interp = itemTwo.follow_count) == null ? "" : interp) + " 粉丝</span></p><span>来自<a"), buf.push(attrs({
				href: "/" + itemTwo.user.urlname + "/",
				rel: "nofollow"
			})), buf.push(">" + escape((interp = itemTwo.user.username) == null ? "" : interp) + "</a></span></div>")) : itemTwo.type == "explores" ? (buf.push("<div"), buf.push(attrs({
				"class": "recommend-infobox explore small pl-right"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data explore"
			})), buf.push("></div><h2><a"), buf.push(attrs({
				href: "/explore/" + itemTwo.urlname + "/"
			})), buf.push(">" + escape((interp = itemTwo.title) == null ? "" : interp) + "</a></h2><p"), buf.push(attrs({
				style: "display:none;"
			})), buf.push("><span>" + escape((interp = itemTwo.follow_count) == null ? "" : interp) + " 关注</span></p></div>")) : itemTwo.type == "users" && (buf.push("<div"), buf.push(attrs({
				"class": "recommend-infobox user small pl-right"
			})), buf.push("><div"), buf.push(attrs({
				"class": "recommend-data user"
			})), buf.push("></div><h2"), buf.push(attrs({
				"class": "user"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + itemTwo.urlname + "/"
			})), buf.push(">" + escape((interp = itemTwo.username) == null ? "" : interp) + "</a></h2><p><span>" + escape((interp = itemTwo.pin_count) == null ? "" : interp) + " 采集</span><span>" + escape((interp = itemTwo.follow_count) == null ? "" : interp) + " 粉丝</span></p></div>")), buf.push("<div"), buf.push(attrs({
				"class": "info-tra-right"
			})), buf.push("></div></div>"), itemTwo.type == "boards" || itemTwo.type == "explores" ? (buf.push("<div"), buf.push(attrs({
				"class": "recommend-imgbox recommend-box"
			})), buf.push("><a"), buf.push(attrs({
				href: itemTwo.type == "boards" ? "/boards/" + itemTwo.board_id + "/" : "/explore/" + itemTwo.urlname + "/"
			})), buf.push("><img"), buf.push(attrs({
				src: "" + imgURL(itemTwo.cover, "sq320") + "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a></div>")) : itemTwo.type == "users" && (buf.push("<div"), buf.push(attrs({
				"class": "recommend-userbox recommend-box"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + itemTwo.urlname + "/",
				"class": "avt"
			})), buf.push("><img"), buf.push(attrs({
				src: "" + imgURL(itemTwo.avatar || this.settings.default_avatar_img, "sq320") + "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a><a"), buf.push(attrs({
				style: "background:url(" + imgURL(itemTwo.avatar || this.settings.default_avatar_img, "sq308bl20") + ") no-repeat",
				"class": "avt-bg"
			})), buf.push("></a></div>"))
		}
		return buf.join("")
	}, __t["base/recommend_users"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, categoryName = filter.split(":")[2];
			buf.push("<div"), buf.push(attrs({
				"class": "recommend users"
			})), buf.push("><a"), buf.push(attrs({
				href: "/users/favorite/" + categoryName + "/",
				"class": "header"
			})), buf.push(">推荐用户<div"), buf.push(attrs({
				"class": "more link"
			})), buf.push(">»</div></a>");
			for(var $index = 0, $$l = users.length; $index < $$l; $index++) {
				var info = users[$index],
					user = info.user;
				buf.push("<div"), buf.push(attrs({
					"class": "field"
				})), buf.push("><a"), buf.push(attrs({
					href: "/" + user.urlname + "/",
					title: "访问" + user.username + "的空间",
					"class": "avatar"
				})), buf.push(">");
				var __val__ = img(user.avatar, "sq75");
				buf.push(null == __val__ ? "" : __val__), buf.push("</a><div"), buf.push(attrs({
					"class": "mate"
				})), buf.push("><a"), buf.push(attrs({
					href: "/" + user.urlname + "/",
					title: "访问" + user.username + "的空间",
					"class": "author"
				})), buf.push(">" + escape((interp = user.username) == null ? "" : interp) + ""), user.extra && user.extra.is_museuser && (buf.push("<img"), buf.push(attrs({
					src: "/img/medals/icon_designer.png",
					"data-baiduimageplus-ignore": 1,
					"class": "v-icon"
				})), buf.push("/>")), buf.push("</a><div"), buf.push(attrs({
					"class": "repin"
				})), buf.push("><span"), buf.push(attrs({
					"class": "info"
				})), buf.push(">" + escape((interp = user.pin_count) == null ? "" : interp) + " 采集</span><span"), buf.push(attrs({
					"class": "info"
				})), buf.push(">" + escape((interp = user.follower_count) == null ? "" : interp) + " 粉丝</span></div></div></div>")
			}
			buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/search_hint"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			if(result && result.length) {
				buf.push("<ul>");
				for(var $index = 0, $$l = result.length; $index < $$l; $index++) {
					var keyword = result[$index];
					buf.push("<li>" + escape((interp = keyword) == null ? "" : interp) + "</li>")
				}
				buf.push("</ul>")
			}
		}
		return buf.join("")
	}, __t["base/search_result"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, __val__ = emerge("base/header");
			buf.push(null == __val__ ? "" : __val__);
			var q = page.query,
				qt = escape(q.text),
				cate = escape(q.category),
				facets = page.facets,
				total = facets && facets.total || 0,
				b = [],
				m = [
					[page.pin_count, "pin", "采集", "/"],
					[page.board_count, "board", "画板", "/boards/"],
					[page.people_count, "people", "用户", "/people/"]
				],
				search_form_style = page.words && page.words.length != 0 ? "short_form" : "long_form";
			this.req.user && (m.push([page.self_pin_count, "self_pin", "我的采集", "/self_pins/"]), m.push([page.self_board_count, "self_board", "我的画板", "/self_boards/"]));
			var target = page.target || "/search?q=" + q,
				sensitiveWords = ["美臀", "臀部", "臀模", "臀控", "臀沟"],
				sortFields = [
					["all", "综合"],
					["relative", "匹配度"],
					["created_at", "时间"]
				],
				isSensitiveness = sensitiveWords.filter(function(e) {
					return -1 !== qt.indexOf(e)
				});
			isSensitiveness = 0 !== isSensitiveness.length, buf.push("<div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				id: "ctx_bar",
				"class": "board"
			})), buf.push("><div"), buf.push(attrs({
				"class": "search-group"
			})), buf.push("><form"), buf.push(attrs({
				id: "search_result_form",
				action: page.$url,
				"class": "search-item " + ("" + search_form_style + "")
			})), buf.push("><input"), buf.push(attrs({
				value: qt,
				name: "q",
				placeholder: "搜索你喜欢的",
				autocomplete: "off",
				"class": "clear-input"
			})), buf.push("/><a"), buf.push(attrs({
				onclick: "return false;",
				"class": "go"
			})), buf.push("></a></form><div"), buf.push(attrs({
				"class": "search-type"
			})), buf.push("><div"), buf.push(attrs({
				id: "search_switch",
				"class": "tabs"
			})), buf.push(">");
			for(var i = 0, $$l = m.length; i < $$l; i++) {
				var x = m[i];
				if(q.type == x[1]) {
					buf.push("<a"), buf.push(attrs({
						"class": "switch-" + x[1] + " tab active"
					})), buf.push(">");
					var __val__ = x[0] + " " + x[2];
					buf.push(null == __val__ ? "" : __val__), buf.push("</a>")
				} else {
					buf.push("<a"), buf.push(attrs({
						href: "/search" + x[3] + "?q=" + qt,
						"class": "switch-" + x[1] + " tab"
					})), buf.push(">");
					var __val__ = x[0] + " " + x[2];
					buf.push(null == __val__ ? "" : __val__), buf.push("</a>")
				}
			}
			buf.push("</div>");
			if(~["pin", "board"].indexOf(q.type)) {
				buf.push("<div"), buf.push(attrs({
					id: "search_sort",
					"class": "items"
				})), buf.push("><span"), buf.push(attrs({
					"class": "category item"
				})), buf.push(">排序：</span>"), q.sort == "weight" ? (buf.push("<a"), buf.push(attrs({
					"class": "active item"
				})), buf.push(">热门</a>")) : (buf.push("<a"), buf.push(attrs({
					href: target,
					"class": "item"
				})), buf.push(">热门</a>"));
				for(var $index = 0, $$l = sortFields.length; $index < $$l; $index++) {
					var sortField = sortFields[$index];
					if(q.sort == sortField[0]) {
						buf.push("<a"), buf.push(attrs({
							"class": "active item"
						})), buf.push(">");
						var __val__ = sortField[1];
						buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</a>")
					} else {
						buf.push("<a"), buf.push(attrs({
							href: target + (/\?/.test(target) ? "&sort=" : "?sort=") + sortField[0],
							"class": "item"
						})), buf.push(">");
						var __val__ = sortField[1];
						buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</a>")
					}
				}
				buf.push("</div>")
			}
			buf.push("</div></div><div"), buf.push(attrs({
				id: "search_filter",
				"class": "search_filter"
			})), buf.push(">"), facets && (buf.push("<div"), buf.push(attrs({
				"class": "block categories"
			})), buf.push("><div"), buf.push(attrs({
				id: "search_more",
				"class": "search-more"
			})), buf.push("><i></i></div><ul><li"), buf.push(attrs({
				"class": "title"
			})), buf.push("><span"), buf.push(attrs({
				"class": "name"
			})), buf.push(">分类：</span></li></ul></div>")), buf.push("</div>"), page.query_msg && (buf.push("<div"), buf.push(attrs({
				id: "search_msg",
				"class": "search-msg"
			})), buf.push("><i"), buf.push(attrs({
				"class": "icon-info"
			})), buf.push("></i><span>" + escape((interp = page.query_msg) == null ? "" : interp) + "</span></div>")), buf.push("</div><div"), buf.push(attrs({
				id: "waterfall"
			})), buf.push(">");
			if(~["pin", "self_pin"].indexOf(q.type)) {
				var first = !0;
				for(var $index = 0, $$l = page.pins.length; $index < $$l; $index++) {
					var pin = page.pins[$index];
					if(pin) {
						var ad = page.ads.getAd();
						if(first) {
							var first = !1,
								__val__ = emerge("base/pin_ad", {
									ad: ad,
									url: page.$url
								});
							buf.push(null == __val__ ? "" : __val__);
							if("http" === scheme) {
								if(!isSensitiveness) {
									var __val__ = emerge("base/google", {
										slot: "6124907653",
										width: 200,
										height: 200,
										className: "pin wfc promotion google search"
									});
									buf.push(null == __val__ ? "" : __val__)
								}
								buf.push("<div"), buf.push(attrs({
									id: "baidu_search_attach",
									"class": "pin wfc promotion"
								})), buf.push(">");
								var __val__ = emerge("base/baidu", {
									attach: "baidu_search_attach",
									id: "baidu_search_promotion"
								});
								buf.push(null == __val__ ? "" : __val__), buf.push("</div>")
							}
							var __val__ = emerge("base/pin_item", {
								user: pin.user,
								pin: pin,
								board: pin.board
							});
							buf.push(null == __val__ ? "" : __val__)
						} else {
							var __val__ = emerge("base/pin_ad", {
								ad: ad,
								url: page.$url
							});
							buf.push(null == __val__ ? "" : __val__);
							var __val__ = emerge("base/pin_item", {
								user: pin.user,
								pin: pin,
								board: pin.board
							});
							buf.push(null == __val__ ? "" : __val__)
						}
					}
				}
			} else if(~["board", "self_board"].indexOf(q.type))
				for(var $index = 0, $$l = page.boards.length; $index < $$l; $index++) {
					var board = page.boards[$index],
						__val__ = emerge("base/board_item", {
							board: board,
							user: req.user
						});
					buf.push(null == __val__ ? "" : __val__)
				} else if(q.type == "people")
					for(var $index = 0, $$l = page.users.length; $index < $$l; $index++) {
						var user = page.users[$index],
							__val__ = emerge("base/user_item", {
								user: user,
								current_user: this.req.user
							});
						buf.push(null == __val__ ? "" : __val__)
					}
				buf.push('</div></div><script>(function(){app.initLikeButtons(),app.initShowMoreButtons(),app.initAddCommentButtons(),app.initFollowButtons(),app.initFollowUserButtons(),app.initSearchForms("#search_result_form")})(),function(){var a=window.location,b=a.host,c=a.pathname,d="//"+b+c+"?q="+app.page.query.text,e=document.getElement(".color-picker"),f=document.getElement(".categories ul");app.query=a.search.substring(1).parseQueryString();var g,h,i;app.query.category&&(g=app.query.category),app.query.c&&(h=app.query.c),app.query.cr&&(i=app.query.cr);if(app.page.facets){function j(a){if(!a)return null;a=a.results;var b=[],c={};app.settings.categories.forEach(function(a){c[a.id]=a});for(var d in a){var e=[d,a[d]];c[d]&&c[d].name&&(e.push(c[d].name),b.push(e))}return b.sort(function(a,b){return a[1]<b[1]}),b}app.page.facetResult=j(app.page.facets),app.page.facetResult.unshift(["all",app.page.facets.total,"全部"]);var k,l="";app.page.facetResult.forEach(function(a){k=d,h&&(k+="&c="+h,i&&(k+="&cr="+i)),a[0]!="all"&&(k+="&category="+a[0]),l+=\'<li><a id="\'+a[0]+\'" href="\'+k+\'">\'+a[2]+"<i>"+a[1]+"</i></a></li>"}),f.innerHTML=f.innerHTML+l,function(){var a=app.query.category||"all";$(a)&&$(a).addClass("selected");if(a!=="all"){var b=document.getElement("#search_switch .selected a");if(!b)return!1;app.page.query.type==="pin"?b.set("text",app.page.facets.total+" 采集"):app.page.query.type==="board"&&b.set("text",app.page.facets.total+" 画板")}}(),function(){var a=app.query.category||"all",b=app.page.query.sort;if(a)try{_czc.push(["_trackEvent","search_category",a,"click",1])}catch(c){}if(b)try{_czc.push(["_trackEvent","search_sort",b,"click",1])}catch(c){}}();function m(){var a=document.getElement("#search_filter .search-more"),b=document.getElement("#search_filter .categories ul").getStyles("height").height.toInt();b>41?(a.setStyle("display","block"),a.addEvent("click",function(){var c=document.getElement("#search_filter .categories"),d=new Fx.Tween(c,{duration:400});if(this.get("id")==="search_more")d.start("height",b).chain(function(){a.erase("id").set("id","search_less")});else if(this.get("id")==="search_less"){var e=document.getElement("#search_less"),c=document.getElement("#search_filter .categories"),d=new Fx.Tween(c,{duration:400});d.start("height","41").chain(function(){a.erase("id").set("id","search_more")})}})):a.setStyle("display","none");var c=~window.location.href.indexOf("category");b>41&&c&&$("search_more").fireEvent("click")}window.addEvent("domready",function(){m()})}var n;window.addEvent("resize",function(){window.clearTimeout(n),app.page.$url.match("/^/search/")&&(n=window.setTimeout(function(){m()},500))})}()</script>')
		}
		return buf.join("")
	}, __t["base/shiji_features_rss"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<h3>");
			var __val__ = feature.description;
			buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</h3>");
			for(var $index = 0, $$l = feature.feature_items.length; $index < $$l; $index++) {
				var item = feature.feature_items[$index];
				buf.push("<p"), buf.push(attrs({
					style: "text-align: center;"
				})), buf.push(">");
				var link = item && item.data && item.data.link && item.data.link.link,
					target = item && item.data && item.data.link && item.data.link.type || "_blank";
				link = item.pin ? "http://" + host + "/shiji/pins/" + item.pin.pin_id + "/" : link, target = item.pin ? "_blank" : target;
				var description = item && item.data && item.data.description || item && item.pin && item.pin.raw_text || "";
				buf.push("<a"), buf.push(attrs({
					href: "" + link + "",
					target: "" + target + "",
					"class": "img"
				})), buf.push(">");
				if(item && item.pin && item.pin.file) {
					var __val__ = img(item.pin.file, "sq490", {
						alt: description
					}, "sq490");
					buf.push(null == __val__ ? "" : __val__)
				}
				buf.push("</a></p>");
				if(item.data && item.data.title) {
					buf.push("<p"), buf.push(attrs({
						style: "text-align: center;"
					})), buf.push(">");
					var __val__ = item.data.title;
					buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</p>")
				}
				if(item.data && item.data.description) {
					buf.push("<p"), buf.push(attrs({
						style: "text-align: center;"
					})), buf.push(">");
					var __val__ = item.data.description;
					buf.push(escape(null == __val__ ? "" : __val__)), buf.push("</p>")
				}
				buf.push("<p"), buf.push(attrs({
					style: "text-align: center;"
				})), buf.push(">售价:" + escape((interp = item.price) == null ? "" : interp) + "元</p>")
			}
		}
		return buf.join("")
	}, __t["base/subsite"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			window.close(), buf.push("<style>.message {\n    margin: 0 auto;\n    width: 20rem;\n    font-size: 2rem;\n    text-align: center;\n    background-color: #fff;\n}</style><div"), buf.push(attrs({
				"class": "subsite"
			})), buf.push("><div"), buf.push(attrs({
				"class": "message"
			})), buf.push(">请手动关闭该窗口</div></div>")
		}
		return buf.join("")
	}, __t["base/suggest_friend"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, f = friend;
			buf.push("<div"), buf.push(attrs({
				"data-id": "" + f.urlname + "",
				"class": "convo suggestion"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(f.urlname) + "/",
				title: escape(f.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				width: "40px",
				height: "40px",
				src: avatar(f),
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a><a"), buf.push(attrs({
				href: "/" + f.urlname + "/",
				"class": "txt userlink"
			})), buf.push(">" + escape((interp = f.username) == null ? "" : interp) + "</a><span"), buf.push(attrs({
				"class": "icon " + ("" + f.service_name + "")
			})), buf.push("></span><span"), buf.push(attrs({
				"class": "txt"
			})), buf.push(">" + escape((interp = f.user_info.username) == null ? "" : interp) + "</span><a"), buf.push(attrs({
				"data-id": "" + f.urlname + "",
				href: "#",
				onclick: "return false;",
				"class": "followuser btn wbtn"
			})), buf.push("><strong> 关注</strong><span></span></a><a"), buf.push(attrs({
				title: "不再推荐",
				"data-friend-urlname": "" + f.urlname + "",
				"data-friend-username": "" + f.username + "",
				"data-service-name": "" + f.service_name + "",
				"class": "mute"
			})), buf.push("></a></div>")
		}
		return buf.join("")
	}, __t["base/unauth"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp, imgBase = "//hbfile.b0.upaiyun.com/img/unauth_page/";
			buf.push("<div"), buf.push(attrs({
				"class": "unauth-page"
			})), buf.push("><div"), buf.push(attrs({
				id: "unauth_main"
			})), buf.push("><div"), buf.push(attrs({
				"class": "sign-up"
			})), buf.push("><img"), buf.push(attrs({
				src: imgBase + "logo.png",
				width: 106,
				height: 36,
				"data-baiduimageplus-ignore": 1,
				"class": "logo"
			})), buf.push("/><div"), buf.push(attrs({
				"class": "title"
			})), buf.push("></div><span>花瓣帮你保存喜欢的图片，需要时，你可以点击它回到原网页。</span><div"), buf.push(attrs({
				"class": "buttons"
			})), buf.push("><a"), buf.push(attrs({
				href: "/oauth/weibo/instant_login/?_ref=unauth",
				title: "微博帐号登录",
				rel: "nofollow",
				"class": "weibo"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/qzone/instant_login/?_ref=unauth",
				title: "QQ帐号登录",
				rel: "nofollow",
				"class": "qzone"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/douban/instant_login/?_ref=unauth",
				title: "豆瓣帐号登录",
				rel: "nofollow",
				"class": "douban"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/renren/instant_login/?_ref=unauth",
				title: "人人帐号登录",
				rel: "nofollow",
				"class": "renren"
			})), buf.push("></a></div><span"), buf.push(attrs({
				"class": "ds"
			})), buf.push(">使用以上帐号注册</span><div"), buf.push(attrs({
				"class": "switch-email-signup"
			})), buf.push(">使用邮箱注册</div><div"), buf.push(attrs({
				"class": "switch"
			})), buf.push(">已有帐号？登录</div><a"), buf.push(attrs({
				href: "/all/",
				title: "最新采集_图片大全_花瓣网",
				"class": "go"
			})), buf.push(">先逛逛»</a></div><div"), buf.push(attrs({
				"class": "login"
			})), buf.push("><img"), buf.push(attrs({
				src: imgBase + "logo_color.png",
				width: 108,
				height: 32,
				"data-baiduimageplus-ignore": 1,
				"class": "logo"
			})), buf.push("/><div"), buf.push(attrs({
				"class": "words"
			})), buf.push(">使用第三方帐号登录</div><div"), buf.push(attrs({
				"class": "buttons"
			})), buf.push("><a"), buf.push(attrs({
				href: "/oauth/weibo/instant_login/?_ref=unauth",
				title: "微博帐号登录",
				rel: "nofollow",
				"class": "weibo"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/qzone/instant_login/?_ref=unauth",
				title: "QQ帐号登录",
				rel: "nofollow",
				"class": "qzone"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/douban/instant_login/?_ref=unauth",
				title: "豆瓣帐号登录",
				rel: "nofollow",
				"class": "douban"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/renren/instant_login/?_ref=unauth",
				title: "人人帐号登录",
				rel: "nofollow",
				"class": "renren"
			})), buf.push("></a></div><div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				"class": "with-line"
			})), buf.push(">使用邮箱登录</div><form"), buf.push(attrs({
				action: "/auth/",
				method: "post",
				action: url("/auth/", !0),
				"class": "mail-login"
			})), buf.push("><input"), buf.push(attrs({
				type: "hidden",
				name: "_ref",
				value: "unauth"
			})), buf.push("/><input"), buf.push(attrs({
				type: "text",
				name: "email",
				placeholder: "花瓣注册邮箱",
				"class": "clear-input"
			})), buf.push("/><input"), buf.push(attrs({
				name: "password",
				type: "password",
				placeholder: "密码",
				"class": "clear-input"
			})), buf.push("/><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "btn btn18 rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 登录</span></a></form><a"), buf.push(attrs({
				"class": "reset-password red-link"
			})), buf.push(">忘记密码»</a><div"), buf.push(attrs({
				"class": "switch-back"
			})), buf.push(">还没有花瓣帐号？<a"), buf.push(attrs({
				"class": "red-link"
			})), buf.push(">点击注册»</a></div><div"), buf.push(attrs({
				"class": "close"
			})), buf.push("></div></div></div><div"), buf.push(attrs({
				"class": "reset"
			})), buf.push("><img"), buf.push(attrs({
				src: imgBase + "logo_color.png",
				width: 108,
				height: 32,
				"data-baiduimageplus-ignore": 1,
				"class": "logo"
			})), buf.push("/><div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				"class": "with-line"
			})), buf.push(">找回密码</div><form"), buf.push(attrs({
				"class": "reset-form"
			})), buf.push("><input"), buf.push(attrs({
				type: "text",
				name: "email",
				placeholder: "花瓣注册邮箱",
				"class": "clear-input"
			})), buf.push("/><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "btn btn18 rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 发送邮件</span></a></form><a"), buf.push(attrs({
				"class": "back red-link"
			})), buf.push(">又想起来了»</a></div></div><div"), buf.push(attrs({
				"class": "email-signup"
			})), buf.push("><img"), buf.push(attrs({
				src: imgBase + "logo_color.png",
				width: 108,
				height: 32,
				"data-baiduimageplus-ignore": 1,
				"class": "logo"
			})), buf.push("/><div"), buf.push(attrs({
				"class": "signup-success"
			})), buf.push("><div"), buf.push(attrs({
				"class": "info"
			})), buf.push("><i></i>注册成功</div><div"), buf.push(attrs({
				"class": "text"
			})), buf.push(">验证邮件已经发送到<span"), buf.push(attrs({
				"class": "email"
			})), buf.push(">email</span><br"), buf.push(attrs({})), buf.push("/>请<a"), buf.push(attrs({
				href: "",
				target: "_blank",
				"class": "check-mail red-link"
			})), buf.push(">点击查收邮件</a>激活账号。<br"), buf.push(attrs({})), buf.push("/>没有收到激活邮件？请耐心等待, 或者<a"), buf.push(attrs({
				"class": "resend red-link disabled"
			})), buf.push(">重新发送<span>30</span></a></div><a"), buf.push(attrs({
				href: "/login/",
				"class": "login-link red-link"
			})), buf.push(">« 返回登录页</a></div><div"), buf.push(attrs({
				"class": "signup-form hidden"
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				"class": "with-line"
			})), buf.push(">使用邮箱注册</div><form"), buf.push(attrs({
				action: "",
				method: "post"
			})), buf.push("><input"), buf.push(attrs({
				type: "text",
				name: "email",
				placeholder: "邮箱",
				"class": "clear-input"
			})), buf.push("/><input"), buf.push(attrs({
				type: "text",
				name: "captcha",
				value: "",
				placeholder: "验证码",
				"class": "clear-input input-captcha"
			})), buf.push("/><input"), buf.push(attrs({
				type: "hidden",
				name: "challenge",
				value: ""
			})), buf.push("/><a"), buf.push(attrs({
				title: "换一个",
				"class": "captcha"
			})), buf.push("><img"), buf.push(attrs({
				src: "",
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a><a"), buf.push(attrs({
				href: "#",
				onclick: "return false;",
				"class": "btn btn18 rbtn"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 注册</span></a></form><a"), buf.push(attrs({
				"class": "email-signup-back"
			})), buf.push(">« 返回第三方帐号登录</a></div></div></div></div><div"), buf.push(attrs({
				id: "unauth_bottom"
			})), buf.push("><a"), buf.push(attrs({
				href: "/about/",
				rel: "nofollow"
			})), buf.push(">关于花瓣</a><a"), buf.push(attrs({
				href: "/about/goodies/",
				rel: "nofollow"
			})), buf.push(">花瓣采集工具</a><a"), buf.push(attrs({
				href: "/about/join_us/",
				rel: "nofollow"
			})), buf.push('>加入我们</a></div></div><script>(function(){function D(a){if(a.err)return a.err==404?window.location.reload():(p.removeClass("disabled"),app.alert(a.msg));window.oauth_callback(a.user)}var a=["photo","pet","gift","wedding","movie","food","diy","trip"],b=a.getRandom(),c=a.indexOf(b)+1,d=800,e=document.id("unauth_main"),f=e.getElement(".title"),g=e.getElement(".switch"),h=e.getElement(".switch-email-signup"),i=e.getElement(".switch-back a"),j=e.getElement("a.email-signup-back"),k=e.getElement(".login"),l=e.getElement(".sign-up"),m=e.getElement(".email-signup"),n=l.getElement(".ds"),o=l.getElement(".buttons"),p=k.getElement(".mail-login .btn"),q=k.getElement(".mail-login"),r=k.getElement("input[name=email]"),s=m.getElement("input[name=email]"),t=m.getElement("input[name=captcha]"),u=k.getElement("input[name=password]"),v=k.getElement(".reset-password"),w=e.getElement(".reset"),x=w.getElement(".back"),y=w.getElement("form .btn"),z=m.getElement("form .btn"),A=w.getElement("input[name=email]"),B=m.getElement(".signup-success"),C=m.getElement(".signup-form");$(document.html).setStyles({"background-image":"url(//hbfile.b0.upaiyun.com/img/unauth_page/"+b+"_bg.jpg)",height:"100%",position:"relative"}),l.setStyle("background-image","url(//hbfile.b0.upaiyun.com/img/unauth_page/"+b+".jpg)"),f.setStyle("background-position","0 -"+c*60+"px"),$(document.html).setStyle("background-position","0 -100px"),n.addEvent("mouseenter",function(){o.addClass("hover")}),n.addEvent("mouseleave",function(){o.removeClass("hover")}),g.addEvent("click",function(){if(e.hasClass("switching"))return;e.addClass("switching"),function(){e.setStyles({width:520,"margin-left":-260}),k.show(),l.hide(),r.focus()}.delay(d/2),function(){e.removeClass("switching")}.delay(d)}),i.addEvent("click",function(){if(e.hasClass("switching"))return;e.addClass("switching"),function(){e.erase("style"),k.hide(),l.show()}.delay(d/2),function(){e.removeClass("switching")}.delay(d)});var E=new Request.JSON({url:"/auth/",onSuccess:D,onFailure:function(a){p.removeClass("disabled")}}),F=new Request.JSON({withCredentials:!0,url:"https://"+app.host+"/auth/",onSuccess:D});window.oauth_callback=function(a){"string"==typeof a&&(a=JSON.parse(a)),app.req.user=a;if(app.$login_callback){app.redraw();var b=app.$login_callback;delete app.$login_callback,b()}else window.location=app.page.$url},e.getElements(".login .buttons a, .sign-up .buttons a").addEvent("click",function(a){a.stop();var b=window.open(this.get("href"),"binding_win","status=no,resizable=no,scrollbars=yes,personalbar=no,directories=no,location=no,toolbar=no,menubar=no,width=680,height=500,left=50,top=40");window.focus&&b.focus()}),q.addEvent("keydown",function(a){a.key=="enter"&&p.click()}),p.addEvent("click",function(){var a=r.value,b=u.value;return a.trim()==""?app.error("请输入您的邮箱地址"):~a.indexOf("@")?b.trim()==""?app.error("请输入密码"):(this.addClass("disabled"),Browser.ie&&Browser.version<9?E.post({email:a,password:b,_ref:"frame"}):(F.onFailure=function(){E.post({email:a,password:b,_ref:"frame"}),p.removeClass("disabled")},F.post({email:a,password:b,_ref:"frame"})),!1):app.error("请输入正确的邮箱地址")}),v.addEvent("click",function(){k.hide(),w.show(),e.setStyle("height",280),A.focus()}),x.addEvent("click",function(){k.show(),w.hide(),e.setStyle("height",""),r.focus()}),y.addEvent("click",function(){var a=this;if(this.hasClass("disabled"))return;if(!A.value)return app.error("请输入您的邮箱地址");a.addClass("disabled"),(new Request.JSON({url:"/password/reset/email/",data:{email:A.value},onSuccess:function(b){a.removeClass("disabled"),app.alert("重置密码的链接已被发送到你的邮箱"+(b.data.link?\'，请 <a target="_blank" class="red-link" href="http://\'+b.data.link+\'">点击查收邮件</a>以重置密码。\':""),function(){location.reload()})},onFailure:function(b){a.removeClass("disabled"),app.error(JSON.parse(b.response||"{}").error||app.COMMON_ERRMSG)}})).post()}),h.addEvent("click",function(){if(e.hasClass("switching"))return;C.removeClass("hidden"),B.addClass("hidden"),app.getCaptcha(),e.addClass("switching"),function(){e.setStyles({width:520,"margin-top":-160,"margin-left":-260,height:320}),m.show(),l.hide(),s.focus()}.delay(d/2),function(){e.removeClass("switching")}.delay(d)}),j.addEvent("click",function(){if(e.hasClass("switching"))return;e.addClass("switching"),function(){e.erase("style"),m.hide(),l.show()}.delay(d/2),function(){e.removeClass("switching")}.delay(d)}),C.addEvent("keydown",function(a){a.key=="enter"&&z.click()}),z.addEvent("click",function(){if(z.hasClass("disabled"))return;var a=m.getElement("input[name=email]").get("value"),b=m.getElement("input[name=captcha]").get("value"),c=m.getElement("input[name=challenge]").get("value");if(!a||!b||!c)return app.alert("请输入完整的信息");z.addClass("disabled"),(new Request.JSON({url:"/signup/email",data:{email:a,captcha:b,challenge:c,_ref:"unauth"},onComplete:function(b){z.removeClass("disabled"),b.err&&app.getCaptcha();if(b.err&&b.msg&&b.msg!=="email_exist")return app.error(b.msg);if(b.msg=="email_exist")return app.alert("该邮箱已注册啦，请直接登录");e.setStyle("height",280);var c=a.split("@")[1];/^((vip.)?qq.com|163.com|126.com|yeah.net|sina.com|sohu.com)$/.test(c)&&(c="mail."+c),c="http://"+c,B.getElement(".text span.email").set("text",a),B.getElement(".text a.check-mail").set("href",c),C.addClass("hidden"),B.removeClass("hidden"),J()}})).post()});var G=m.getElement(".resend"),H=G.getElement("span"),I=function(){H.innerHTML--,H.innerHTML=="0"?(H.hide(),G.removeClass("disabled")):setTimeout(I,1e3)},J=function(){H.show().innerHTML="30",setTimeout(I,1e3)};G.addEvent("click",function(){if(this.hasClass("disabled"))return;this.addClass("disabled"),app.getCaptcha(),J(),(new Request.JSON({url:"/signup/email/resend",onComplete:function(a){if(a.err&&a.msg&&a.msg!=="email_exist")return app.error(a.msg);if(a.msg=="email_exist")return app.alert("此邮箱已经注册过花瓣账号啦，你可以直接使用它登录");app.alert("发送成功，请查收")}})).post()}),m.getElement("form a.captcha").addEvent("click",function(){app.getCaptcha()}),app.tdcaptcha={},app.tdcaptcha.showcode=function(a){$$(".email-signup form input[name=challenge]").set("value",a);var b=app.settings.tdcaptcha.code_url;b+="?pubkey="+app.settings.tdcaptcha.public_key,b+="&clientsonid="+a+"&"+Math.random(),document.getElement(".email-signup form a.captcha img").set("src",b)},app.gaqTrackEvent("#unauth_main .go",{category:"unauth_get_in"})})()</script><style>html {\n    background-color: #686866;\n    background-size: cover;\n    transition: 10s .8s background-position linear;\n    min-height: 530px;\n}</style>')
		}
		return buf.join("")
	}, __t["base/unauth_callout"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "unauth_callout"
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper clearfix"
			})), buf.push("><div"), buf.push(attrs({
				"class": "intro"
			})), buf.push("><div"), buf.push(attrs({
				"class": "title"
			})), buf.push(">国内最优质图片灵感库</div><div>已有数百万出众网友，用花瓣保存喜欢的图片。</div><div"), buf.push(attrs({
				style: "display: none",
				"class": "more"
			})), buf.push("><span>更多相似内容：</span><a>潮品</a><a>当季流行</a></div></div>"), page.isQplus || (buf.push("<div"), buf.push(attrs({
				"class": "login"
			})), buf.push("><a"), buf.push(attrs({
				href: "/oauth/weibo/instant_login/?_ref=bar",
				onclick: "return false;",
				rel: "nofollow",
				"class": "weibo"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/qzone/instant_login/?_ref=bar",
				onclick: "return false;",
				rel: "nofollow",
				"class": "qzone"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/douban/instant_login/?_ref=bar",
				onclick: "return false;",
				title: "豆瓣帐号登录",
				rel: "nofollow",
				"class": "douban"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/renren/instant_login/?_ref=bar",
				onclick: "return false;",
				title: "人人帐号登录",
				rel: "nofollow",
				style: "margin-right: 0",
				"class": "renren"
			})), buf.push("></a><div"), buf.push(attrs({
				"class": "with-line"
			})), buf.push(">用以上社交帐号直接登录</div></div>")), buf.push("</div><div"), buf.push(attrs({
				style: "display: none",
				"class": "floating"
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper clearfix"
			})), buf.push("><div"), buf.push(attrs({
				"class": "title"
			})), buf.push(">国内最优质图片灵感库</div><div"), buf.push(attrs({
				"class": "sub-title"
			})), buf.push(">已有数百万出众网友，用花瓣保存喜欢的图片。</div>"), page.isQplus || (buf.push("<div"), buf.push(attrs({
				"class": "floating-login"
			})), buf.push("><span"), buf.push(attrs({
				"class": "words"
			})), buf.push(">用社交帐号直接登录：</span><a"), buf.push(attrs({
				href: "/oauth/weibo/instant_login/?_ref=barFloating",
				onclick: "return false;",
				rel: "nofollow",
				"class": "weibo"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/qzone/instant_login/?_ref=barFloating",
				onclick: "return false;",
				rel: "nofollow",
				"class": "qzone"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/douban/instant_login/?_ref=barFloating",
				onclick: "return false;",
				title: "豆瓣帐号登录",
				rel: "nofollow",
				"class": "douban"
			})), buf.push("></a><a"), buf.push(attrs({
				href: "/oauth/renren/instant_login/?_ref=barFloating",
				onclick: "return false;",
				title: "人人帐号登录",
				rel: "nofollow",
				style: "margin-right: 0",
				"class": "renren"
			})), buf.push("></a></div>")), buf.push('</div></div></div><script>(function(){window.oauth_callback=function(a){"string"==typeof a&&(a=JSON.parse(a)),app.req.user=a;if(app.$login_callback){app.redraw();var b=app.$login_callback;delete app.$login_callback,b()}else window.location=app.page.$url},$$("#unauth_callout .login a, #unauth_callout .floating-login a").addEvent("click",function(a){a.stop();var b=window.open(this.get("href"),"binding_win","status=no,resizable=no,scrollbars=yes,personalbar=no,directories=no,location=no,toolbar=no,menubar=no,width=680,height=500,left=50,top=40");window.focus&&b.focus()}),app.gaqTrackEvent("#unauth_callout .login a, #unauth_callout .floating-login a",{category:"unauth_callout_login"});var a=document.getElement("#unauth_callout"),b=a.getElement(".floating");(function(){location.pathname.substring(0,8)=="/explore"?(a.setStyle("margin-top",-120),b.setStyle("bottom",0),$$("#elevator_item").setStyle("bottom",82),b.show()):(b.setStyle("top",48),window.addEvent("scroll",function(){var a=120;document.getElement(".design-pages")&&(a+=42),window.getScrollTop()>a?b.show():b.hide()}))})()})()</script>')
		}
		return buf.join("")
	}, __t["base/user_fix_callout"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				id: "unauth_callout",
				style: "display: none;",
				"class": "has-close"
			})), buf.push("><div"), buf.push(attrs({
				"class": "wrapper"
			})), buf.push("><div"), buf.push(attrs({
				id: "intro",
				"class": "sheet"
			})), buf.push("><div"), buf.push(attrs({
				"class": "unauth-btns"
			})), buf.push("><a"), buf.push(attrs({
				id: "fix_user_btn",
				href: "/settings/",
				"class": "btn btn18 wbtn"
			})), buf.push('><strong><em></em> 完善我的注册帐号</strong><span></span></a></div><h2>请完善你的花瓣注册邮箱</h2>大侠，你是通过第三方帐号直接登录的</div></div></div><script>(function(){(!Cookie.read("_hbfu")||Cookie.read("_hbfu")!=app.req.user.user_id)&&document.id("unauth_callout").removeClass("has-close").show(),document.id("fix_user_btn").addEvent("click",function(){Cookie.write("_hbfu",app.req.user.user_id,{duration:1}),window.location.href=this.get("href")})})()</script>')
		}
		return buf.join("")
	}, __t["base/user_item"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			buf.push("<div"), buf.push(attrs({
				"data-id": "" + user.user_id + "",
				"data-seq": "" + user.user_id + "",
				"class": "pin user wfc"
			})), buf.push("><a"), buf.push(attrs({
				href: "/" + escape(user.urlname) + "/",
				title: escape(user.username),
				"class": "img x"
			})), buf.push("><img"), buf.push(attrs({
				src: avatar(user, "sq235"),
				"data-baiduimageplus-ignore": 1
			})), buf.push("/></a><h2>" + escape((interp = user.username) == null ? "" : interp) + ""), user.extra && user.extra.is_museuser && (buf.push("<img"), buf.push(attrs({
				src: "/img/medals/icon_designer.png",
				"data-baiduimageplus-ignore": 1,
				"class": "v-icon"
			})), buf.push("/>")), buf.push("</h2><p"), buf.push(attrs({
				"class": "location less"
			})), buf.push("></p>"), current_user && (current_user.user_id !== user.user_id ? user.following ? (buf.push("<a"), buf.push(attrs({
				"data-id": user.urlname,
				href: "#",
				onclick: "return false;",
				"class": "unfollowuser btn btn14 wbtn"
			})), buf.push("><strong> 取消关注</strong><span></span></a>")) : (buf.push("<a"), buf.push(attrs({
				"data-id": user.urlname,
				href: "#",
				onclick: "return false;",
				"class": "followuser btn btn14 wbtn"
			})), buf.push("><strong> 关注</strong><span></span></a>")) : (buf.push("<a"), buf.push(attrs({
				href: "/settings/",
				"class": "btn btn14"
			})), buf.push("><span"), buf.push(attrs({
				"class": "text"
			})), buf.push("> 帐号设置</span></a>"))), buf.push("</div>")
		}
		return buf.join("")
	}, __t["base/visit"] = function(locals) {
		var buf = [];
		with(locals || {}) {
			var interp;
			if(visits && visits.length > 0) {
				var current_page = Math.floor(Math.random() * promotions.length + 1),
					promotion = promotions[current_page - 1],
					image_url = "",
					target = promotion.new_tab ? "_blank" : "_self";
				promotion.image && promotion.image.bucket && promotion.image.key && (image_url = "//" + this.settings.hbfile[promotion.image.bucket] + "/img/promotion/" + promotion.image.key), buf.push("<div"), buf.push(attrs({
					"class": "image-promotions"
				})), buf.push("><a"), buf.push(attrs({
					href: "" + promotion.url + "",
					target: "" + target + ""
				})), buf.push("><img"), buf.push(attrs({
					src: "" + image_url + "",
					alt: !0,
					width: "204",
					height: "330",
					"data-baiduimageplus-ignore": 1,
					"class": "promotion"
				})), buf.push("/></a>");
				if(promotions.length > 1) {
					buf.push("<ul"), buf.push(attrs({
						"class": "pager"
					})), buf.push(">");
					for(var i = 1, l = promotions.length; i <= l; i++) {
						var promotion = promotions[i - 1],
							image_url = "",
							target = promotion.new_tab ? "_blank" : "_self";
						promotion.image && (image_url = "//" + this.settings.hbfile[promotion.image.bucket] + "/img/promotion/" + promotion.image.key);
						var li_class = "";
						i == current_page && (li_class = "current"), buf.push("<li"), buf.push(attrs({
							"data-url": "" + promotion.url + "",
							"data-target": "" + target + "",
							"data-image": "" + image_url + "",
							"class": "" + li_class + ""
						})), buf.push(">●</li>")
					}
					buf.push("</ul>")
				}
				buf.push("</div>")
			}
			buf.push('<script>(function(){var a=$$(".image-promotions ul.pager li");a.length>0&&a.addEvent("click",function(){if(this.hasClass("current"))return;var a=$$(".image-promotions ul.pager li.current")[0],b=$$(".image-promotions a")[0],c=$$(".image-promotions img.promotion")[0];a.removeClass("current"),b.set("href",this.get("data-url")),b.set("target",this.get("data-target")),c.set("src",this.get("data-image")),this.addClass("current")})})()</script>')
		}
		return buf.join("")
	}
})(app);