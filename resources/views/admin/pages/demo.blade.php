@extends('admin.right')

@section('htmlheader_title')
    用户详情
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/gray/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/static/js/jquery_easyui/themes/color.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/static/admin/account/css/storeAccount.css')}}">
    <script type="text/javascript" src="{{asset('/static/admin/account/js/storeAccount.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/js/jquery_easyui/jquery.easyui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/static/js/jquery_easyui/locale/easyui-lang-zh_CN.js')}}"></script>

    <section class="content">



        <ul id="tt" class="easyui-tree" data-options="checkbox:true,animate:true,dnd:true">
            <li>
                <span>运营数据</span>
                <ul>
                    <li>
                        <span>业务内容数据</span>
                    <li>
                        <span>积分数据</span>
                    </li>
                    <li>
                        <span>信用分数据</span>
                    </li>
                    <li>
                        <span>页面流量数据</span>
                    </li>
                    <li>
                        <span>业务功能管理</span>
                    </li>
                </ul>
            </li>
            <li>
                <span>业务功能管理</span>
                <ul>
                    <li><span>首页管理</span></li>
                    <li><span>场地预约管理</span>
                        <ul>
                            <li><span>只查看</span></li>
                            <li><span>查看编辑</span></li>
                        </ul>
                    </li>
                    <li>
                        <span>活动管理</span>
                    </li>
                    <li>
                        <span>票务管理</span>
                    </li>
                    <li>
                        <span>失物招领管理</span>
                    </li>
                    <li>
                        <span>闲置物品管理</span>
                    </li>
                </ul>
            </li>
        </ul>



        <div class="editorMain">

            <div class="box-header with-border">
                <div class="checkbox">
                    <b>账户情况</b><input type="button" value="更改" id="accountBtn" onclick="editUser()" />
                </div>
            </div>


            <div class="box-header with-border">
                <div class="checkbox">
                    <b>运营权限</b><input class="menu-btn" type="button" value="更改" id="operationBtn"/>
                </div>
            </div>
            <form id="operationForm">
                <div class="box-header with-border">
                    <div class="checkbox">
                        <span>店面范围</span>
                        <label><input type="checkbox" disabled name="shopScope"/>上海工程技术大学</label>
                        <label><input type="checkbox" disabled name="shopScope"/>上海第二工业大学</label>
                    </div>
                </div>

                <div class="box-header with-border ">
                    <div class="checkbox">
                        <label> <input type="checkbox" disabled  cur-mark="y1" />运营数据</label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox menu-two">
                        <label><input type="checkbox" disabled cur-mark="y1-1" parent-mark="y1" /><span>业务内容数据</span></label>
                        <label><input type="checkbox" disabled cur-mark="y1-2" parent-mark="y1"/><span>积分数据</span></label>
                        <label><input type="checkbox" disabled cur-mark="y1-3" parent-mark="y1"/><span>信用分数据</span></label>
                        <label><input type="checkbox" disabled cur-mark="y1-4" parent-mark="y1"/><span>页面流量数据</span></label>
                    </div>
                </div>

                <div class="box-header with-border">
                    <div class="checkbox">
                        <label> <input type="checkbox" disabled  cur-mark="y2" />业务功能管理</label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox menu-two">
                        <label> <input type="checkbox" disabled cur-mark="y2-1" parent-mark="y2" /><span>首页管理</span></label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox menu-two">
                        <label> <input type="checkbox" disabled cur-mark="y2-2" parent-mark="y2" /><span>场地预约管理</span></label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox menu-three">
                        <label> <input type="checkbox" disabled cur-mark="y2-2-1" parent-mark="y2-2" /><span>只查看</span></label>
                        <label> <input type="checkbox" disabled cur-mark="y2-2-2" parent-mark="y2-2"/><span>查看编辑</span></label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox menu-two">
                        <label> <input type="checkbox" disabled cur-mark="y2-3" parent-mark="y2"/><span>活动管理</span></label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox menu-two">
                        <label> <input type="checkbox" disabled cur-mark="y2-4" parent-mark="y2"/><span>票务管理</span></label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox menu-two">
                        <label> <input type="checkbox" disabled cur-mark="y2-5" parent-mark="y2"/><span>失物招领管理</span></label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox menu-two">
                        <label> <input type="checkbox" disabled cur-mark="y2-6" parent-mark="y2"/><span>闲置物品管理</span></label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox menu-two">
                        <label> <input type="checkbox" disabled cur-mark="y2-7" parent-mark="y2"/><span>保险订单管理</span></label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox menu-two">
                        <label> <input type="checkbox" disabled cur-mark="y2-8" parent-mark="y2"/><span>挂号管理</span></label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox ">
                        <label> <input type="checkbox" disabled cur-mark="y3" /><span>积分管理</span></label>
                    </div>
                </div>
                <div class="box-header with-border">
                    <div class="checkbox ">
                        <label> <input type="checkbox" disabled cur-mark="y4" /><span>信用分管理</span></label>
                    </div>
                </div>
            </form>

        </div>


    </section>
@stop