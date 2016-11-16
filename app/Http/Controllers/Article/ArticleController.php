<?php
namespace App\Http\Controllers\Article;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Lib\LibUtil; // 用户
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination;


use DB;
class ArticleController extends CmController{

	public function __construct(){
		parent::__construct();
		$getdata = Input::all();
		if(isset($getdata['oid']) && !empty($getdata['oid'])){
			$this->other_id = $getdata['oid'];
		}else{
			$this->other_id = $this->user_id;			
		}

        
	}
	
	
	public function create(){
		$cm=new CmController;
		$us=$this->user();
		if($us){
			if ($us['id']==5||$us['id']==6) {
				return View('essay.create');
			}else{				
				echo "<script>alert('你是谁！快走开')</script>";
				return redirect('/Article/article');
			}
			
		}else{
			echo "<script>alert('请先登陆')</script>";
			return redirect('/Article/article');
		}
		
	}
	public function add_eassat(){  //写入数据库前判定
		$us=$this->user();
		if (!($us['id']==5||$us['id']==6)) {
			dd('你是谁！快走开');
		}
		if($_POST['eassat_user']){$use=$this->user_name($_POST['eassat_user']);$data['eassat_guide_id']=$use['id'];$data['eassat_guide_user']=$use['nick'];$data['eassat_guide_src']=$use['src'];}
		if($_POST['eassat_describe']){$data['eassat_describe']=$_POST['eassat_describe'];}else{dd('请写入文章描述');};
		if($_POST['eassat_title']){$data['eassat_title']=$_POST['eassat_title'];}else{dd('请写入文章标题');};
		if($_POST['cont']){$data['eassat_cont']=$_POST['cont'];}else{dd('请写入文章内容');};
		$data['eassat_date']=date('y-m-d h:i:s',time());
		$data['eassat_time']=date('y-m-d h:i:s',time());
		$data['eassat_user_id']=$us['id'];
		$data['eassat_user_src']=$us['src'];
		$data['eassat_user_name']=$us['nick'];
		$data['eassat_classfy']='';
		for ($i=1; $i < 13 ; $i++) { 
			if($_POST['classfy'.$i]){$data['eassat_classfy']=';'.$_POST['classfy'.$i].';'.$data['eassat_classfy'];};
		}
		if(empty($_POST['where'])){$data['eassat_where']=0;}else{$data['eassat_where']=1;}
		if(empty($_POST['adapt'])){$data['adapt']=0;}else{$data['adapt']=1;}
		if($_FILES['file1']['name']||$_FILES['file2']['name']){
		if($_FILES['file2']['name']){$file2 = Input::file('file2');$filename = uniqid();$hz=$file2 -> getClientOriginalExtension();$file2->move('uploads/ueditor/show',$filename.'.'.$hz);$data['eassat_timg']='/uploads/ueditor/show/'.$filename.'.'.$hz;
		}else{$file1 = Input::file('file1');$filename = uniqid();$hz=$file1 -> getClientOriginalExtension();$file1->move('uploads/ueditor/show',$filename.'.'.$hz);$data['eassat_timg']='/uploads/ueditor/show/'.$filename.'.'.$hz;
		}}else{dd("请设置推荐图片 11:8");}
		if($_FILES['file3']['name']||$_FILES['file4']['name']){if($_FILES['file4']['name']){$file4 = Input::file('file4');$filename = uniqid();$hz2=$file4 -> getClientOriginalExtension();$file4->move('uploads/ueditor/show',$filename.'.'.$hz2);$data['eassat_ximg']='/uploads/ueditor/show/'.$filename.'.'.$hz2;
		}else{$file3 = Input::file('file3');$filename = uniqid();$hz2=$file3 -> getClientOriginalExtension();$file3->move('uploads/ueditor/show',$filename.'.'.$hz2);$data['eassat_ximg']='/uploads/ueditor/show/'.$filename.'.'.$hz2;}
		}else{dd("请设置推荐图片 11:8");}
		
		$id=$this->eassat($data);
		if($id){
			echo "<script>alert('上传成功')</script>";
			return redirect('/Article/article/create');
		}else{
			dd("上传失败");
		}
		//return redirect('/Article/article/create');

	
	}
	public function user($user=null){  //查询用户信息 不传递user查询当前用户信息
		$cm=new CmController;
		$a=new LibUtil;
		if(!$user){$user=$cm->get_user_cache($_COOKIE['user_id']);}
		//if(!($user==1214)){dd('非管理员用户禁止上传');}else{	}	
		$us=DB::table('users')->where('id',$user)->first();$us['src']=$a->getUserAvatar($user,1);
		return $us;
	}
	public function user_name($name){  //根据昵称查询用户详细信息
		$us=DB::table('users')->where('nick',$name)->first();
		if(!$us){dd('请写入正确指导人姓名');}
		$a=new LibUtil;
		$us['src']=$a->getUserAvatar($us['id'],1);
		return $us;
	}
	public function eassat($data){  //数据写入eassat表
		$id=DB::table('eassat')->insert($data);
		return $id;
	}
	public function indexx(){
		$where=$this->eassat_where(4);
		$index=$this->eassat_index();
		$user_id = $this->user_id; 
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'where'=>$where,
			'index'=>$index
		];
		return View('essay.indexx',$data);
	}
	public function show($id){	
		$dataa=$this->cont_id($id);

		$commentw=$this->comment_eassat_id_int($id);
		$comment=$this->comment_eassat_id($id);	

		if(empty($_COOKIE['user_id'])){$user=0;}else{$user=$this->user();}
		$where=$this->eassat_where();

		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'ok'=>$dataa,
			'new'=>$commentw,
			'comment'=>$comment,
			'us'=>$user,
			'where'=>$where
		];
	
		return View ('essay.show',$data);
	}
	public function pingx(){  //添加评论
		$cm=new CmController;
		if($_POST['cont']){$data['comment_cont']=$_POST['cont'];}else{return '服务器繁忙';}
		if($_POST['eassat_id']){$data['comment_eassat_id']=$_POST['eassat_id'];}else{return '服务器繁忙';}
		if($_POST['user_id']){
			try {
		        $user=$cm->get_user_cache($_COOKIE['user_id']);
				$us=$this->user($user);			
				$data['comment_date']=date('y-m-d h:i:s',time());
				$data['comment_user_id']=$user;
				$data['comment_user_src']=$us['src'];
				$data['comment_user_name']=$us['nick'];
				$data['comment_int']=0;
				$data=DB::table('eassat_comment')->insert($data);
				return 1;
		    } catch (Exception $e){
		    	return '服务器繁忙';
		    }
		}else{
			$ac=2;
			return $ac;
		}	
	}
	public function select_pingx(){  //查询更多评论
		$c=$_POST['c'];
		$id=$_POST['eassat_id'];
		$comment=$this->comment_eassat_id($id,$c);
		$comment['c']=$c;	
		return $comment;
	}
	public function aqq_pingx($pid){  //上一篇文章跳转
		$a=DB::table('eassat')->where('eassat_id','<',$pid)->max('eassat_id');
		if($a){
			return redirect('/Article/article/'.$a);
		}else{
			echo "<script>alert('没有更多文章');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}
		
	}
	public function add_pingx($pid){  //下一篇文章跳转
		$a=DB::table('eassat')->where('eassat_id','>',$pid)->min('eassat_id');
		if($a){
			return redirect('/Article/article/'.$a);
		}else{
			echo "<script>alert('没有更多文章');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		}
	}
	public function cont_id($id){ //根据ID查询eassat
		$comment = DB::table('eassat')->where('eassat_id',$id)->first();
		if(!$comment){dd('服务器繁忙');}
		return $comment;
	}
	public function comment_eassat_id_int($id,$limit=3){  //根据ID查询热门评论 $limit默认3个
		$comment=DB::table('eassat_comment')->where(['comment_eassat_id'=>$id,'comment_delete'=>1])->orderBy('comment_int','desc')->take($limit)->get();			
		$comment['int']=count($comment);
		return $comment;
	}
	public function comment_eassat_id($id,$c=null){  //根据ID查询所有评论 按时间排序最新的为第一个 最多10个 $c控制从第几个开始
		$comment=DB::table('eassat_comment')->where(['comment_eassat_id'=>$id,'comment_delete'=>1])->orderBy('comment_date','desc')->skip($c)->take(10)->get();
		$int=count($comment);

		if($int>10){$comment['int']=10;}else{$comment['int']=$int;}
		return $comment;
	}	
	public function eassat_where($c=9){	//抓取最新推荐 $c设置抓取多少个  默认9个
		$eassat=DB::table('eassat')->where('eassat_where',1)->take($c)->select('eassat_id','eassat_timg','eassat_ximg','eassat_title')->orderBy('eassat_date','desc')->get();
		$eassat['int']=count($eassat);
		return $eassat;
	}
	public function comment_delete(){ //删除评论 comment_delete 属性变为2  返回3未登录 返回1成功  返回2不是本人或管理员 返回0更改数据出错
		$cm=new CmController;
		$us=input::get('user');
		$id=input::get('comment_id');
		$user=$cm->get_user_cache($_COOKIE['user_id']);
		if($user){

			if($user==$us){//||$user=1214

				$del=DB::table('eassat_comment')->where('comment_id', $id)->update(array('comment_delete' => 2));
				if($del){return 1;}else{return 0;}
			}else{
				return 2;
			}
		}else{
			return 3;
		}
		
	}
	public function add_int(){ //点赞记录 返回1成功  返回2已点赞 返回3 未登录 返回0事务出现错误
		$cm=new CmController;
		$user=$cm->get_user_cache($_COOKIE['user_id']);
		if($user){
			$ac=DB::table('eassat_comment_action')->where(['eassat_comment_user_id'=>$user,'eassat_comment_id'=>$_POST['eassat_comment_id']])->first();	
			if($ac){
				return 2;	
			}else{	
				try {
				$data['eassat_comment_user_id']=$user;
				$data['eassat_comment_id']=$_POST['eassat_comment_id'];
				$data['eassat_comment_date']=date('y-m-d h:i:s',time());
				$data['eassat_comment_time']=date('y-m-d h:i:s',time());
				$id=DB::table('eassat_comment_action')->insert($data);
				DB::table('eassat_comment')->where('comment_id',$_POST['eassat_comment_id'])->increment('comment_int');
				} catch (Exception $e) {
					return $e->getMessage(); 
				};
				return 1;
			}
		}else{
			return 3;
		}		
	}

	//首页显示
	public function index(){
		$where=$this->eassat_where(4);
		$index=$this->eassat_index();

		//头部
		$user_id = $this->user_id; 
		$data = [
			'self_id'=>$user_id,
			'self_info'=>$this->self_info,
			'where'=>$where,
			'index'=>$index
		];
		
		return View('essay.index',$data);
	}
	public function eassat_index($c=12){	//抓取最新发布的文章 $c设置抓取多少个  默认12个
		$eassat=DB::table('eassat')->take($c)->select('eassat_id','eassat_timg','eassat_ximg','eassat_title','eassat_date')->orderBy('eassat_date','desc')->get();
		$eassat['int']=count($eassat);
		return $eassat;
	}
	public function search($id){ //搜索页显示	

		$classfy=$this->eassat_search($id);	
		$rel=$this->search_re($classfy['b']['name']);
		//dd($rel);
		//头部
		$user_id = $this->user_id; 
		$data = [
			'self_id'=>$user_id,
			'self_info'=>$this->self_info,
			'class'=>$classfy,
			'rel'=>$rel
		];
		return View('essay.search',$data);
	}
	public function eassat_search($id){ //根据传递过来的id 查询eassat_search 表 返回所有的子分类和本身b 上级分类信息a
		$b=DB::table('eassat_search')->where('id',$id)->first(); 
		$data=DB::table('eassat_search')->where('pid',$id)->get();
		if($data){
			$data['int']=count($data);
			$data['a']=$b;
			$data['b']=$b;
		}else{	
			$data=DB::table('eassat_search')->where('pid',$b['pid'])->get();
			$data['int']=count($data);
			$data['a']=DB::table('eassat_search')->where('id',$b['pid'])->first();
			$data['b']=$b;
		}
		return $data;
	}
	public function search_re($classfy){ //根据classfy 查询eassat的 图片 id 标题 时间
		//$data=DB::select("select eassat_id,eassat_timg,eassat_ximg,eassat_title,eassat_date from eassat where eassat_classfy like '%;".$classfy.";%' ");
		
		$data= DB::table('eassat')->select('eassat_id','eassat_timg','eassat_ximg','eassat_title','eassat_date')->where('eassat_classfy', 'like', '%'.$classfy.'%')->Paginate(6);
//
		return $data;

	}
	public function search_re_add(){ //搜索页更多选项 返回2 分类id错误 返回3 页码错误 返回1 查询错误
		$data=Input::all();
		if(!$data['classfy']){
			return 2;
		}
		if(!$data['c']){
			return 3;
		}
		$classfy=$data['classfy'];
		$c=$data['c'];

		$da= DB::table('eassat')->select('eassat_id','eassat_timg','eassat_ximg','eassat_title','eassat_date')->where('eassat_classfy', 'like', '%'.$classfy.'%')->skip($c)->take(6)->get();
		$da['int']=count($da);
		$da['c']=$c;
		if($da){
			return $da;
		}else{
			return 1;
		}
	}
	public function modify($id){
		$cont=$this->cont_id($id);
		$us=$this->user();
		if ($us['id']==5||$us['id']==6) {
		return View('essay.modify',$cont);
		}else{
			echo "<script>alert('这篇文章说不认识你！不想理你')</script>";
		}
	}
	public function mod(){	
		$us=$this->user();
		if (!($us['id']==5||$us['id']==6)) {
			dd("这篇文章说不认识你！不想理你");
		}	
		$data=input::All();
	
		if(empty($data['eassat_id'])){
			dd('服务器繁忙!');
			
		}else{
			$da['eassat_id']=$data['eassat_id'];
		}
		if(empty($data['eassat_describe'])){
				dd('服务器繁忙.');
		}else{
			$da['eassat_describe']=$data['eassat_describe'];
		}
		if(empty($data['eassat_title'])){
			dd('服务器繁忙?');	
		}else{
			$da['eassat_title']=$data['eassat_title'];
		}
		if(empty($data['cont'])){
			dd('服务器繁忙!!');
		}else{	
			$da['eassat_cont']=$data['cont'];
		}
		if(!empty($data['eassat_user'])){
			$use=$this->user_name($_POST['eassat_user']);
			$da['eassat_guide_id']=$use['id'];
			$da['eassat_guide_user']=$use['nick'];
			$da['eassat_guide_src']=$use['src'];
		}
		if(empty($data['where'])){$da['eassat_where']=0;}else{$da['eassat_where']=1;}
		$ea=DB::table('eassat')->where('eassat_id',$data['eassat_id'])->select('eassat_timg','eassat_ximg')->first();
		
		if($_FILES['file1']['name']||$_FILES['file2']['name']){
		if($_FILES['file2']['name']){$file2 = Input::file('file2');$filename = uniqid();$hz=$file2 -> getClientOriginalExtension();$file2->move('uploads/ueditor/show',$filename.'.'.$hz);$da['eassat_timg']='/uploads/ueditor/show/'.$filename.'.'.$hz;
		}else{$file1 = Input::file('file1');$filename = uniqid();$hz=$file1 -> getClientOriginalExtension();$file1->move('uploads/ueditor/show',$filename.'.'.$hz);$da['eassat_timg']='/uploads/ueditor/show/'.$filename.'.'.$hz;
		}}
		if($_FILES['file3']['name']||$_FILES['file4']['name']){if($_FILES['file4']['name']){$file4 = Input::file('file4');$filename = uniqid();$hz2=$file4 -> getClientOriginalExtension();$file4->move('uploads/ueditor/show',$filename.'.'.$hz2);$da['eassat_ximg']='/uploads/ueditor/show/'.$filename.'.'.$hz2;
		}else{$file3 = Input::file('file3');$filename = uniqid();$hz2=$file3 -> getClientOriginalExtension();$file3->move('uploads/ueditor/show',$filename.'.'.$hz2);$da['eassat_ximg']='/uploads/ueditor/show/'.$filename.'.'.$hz2;}
		}
		
		if($ea){
			DB::beginTransaction();
		    try {   
		        DB::table('eassat')->where('eassat_id',$data['eassat_id'])->update($da);
		        DB::commit();
		        $p=unlink(substr($ea['eassat_timg'],1));
		        $o=unlink(substr($ea['eassat_ximg'],1));
		    } catch (Exception $e){
		       DB::rollback();
		       throw $e;
		    }
		    return redirect('/Article/article/'.$da['eassat_id']);
		}else{
			dd('系统繁忙@');
		}
	}
}

