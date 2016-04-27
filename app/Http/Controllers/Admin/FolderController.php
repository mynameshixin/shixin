<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/25
 * Time: 下午6:52
 */
namespace App\Http\Controllers\Admin;

use App\Lib\LibUtil;
use App\Models\Folder;
use App\Services\FolderService;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Zofe\Rapyd\Facades\DataFilter;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;

use App\Models\Category;

class FolderController extends ApiController
{
    protected $recommend =  [''=>'推荐否','1'=>'推荐','0'=>'不推荐'];
    private  static $recommends = [1=>'推荐',0=>'不推荐'];
    private static $privates = [0=>'公开',1=>'隐私'];

    protected $categories= [''=>'选择分类'];

    public function index(Request $request)
    {
        $user = Auth::user();
        $userArr['']= '全部';
        $userArr[$user->id] = '自己发布的';
        $filter = DataFilter::source( new Folder());
        $filter->add('is_recommend','推荐','select')->options($this->recommend);
        $filter->add('user_id','发布人','select')->options($userArr);
        $filter->add('name','名称', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->link("/admin/folder/action/edit","创建文件夹");

        $grid = DataGrid::source($filter);  //same source types of DataSet
        $grid->add('id','ID', true);
        $grid->add('name','名称', true); //field name, label, sortable
        $grid->add('count','文件数'); //relation.fieldname
        $grid->add('private','隐私')->cell( function ($value) {
            return isset(self::$privates[$value]) ? self::$privates[$value] : '';
        });
        $grid->add('is_recommend','推荐')->cell( function ($value) {
            return isset(self::$recommends[$value]) ? self::$recommends[$value] : '';
        });
        $grid->add('image_id','照片', true)->cell( function ($value) {

            if($value)$img = LibUtil::getPicUrl($value,4);
            if (isset($img) && $img) {
                return "<img src='".$img."' style='width:120px;'>";
            }
            return '';
        });
        $grid->add('tags','标签');
        $actions = 'modify|delete|show';

        $grid->edit('/admin/folder/action/edit', 'Edit', $actions);

        $grid->row(function ($row)use($user) {

            if($row->data->user_id == $user->id ){
                if ($row->data->count > 0) {
                    $actions = ['show', 'modify', 'delete'];
                }else {
                    $actions = ['show', 'modify', 'delete'];
                }

            }else{
                $actions = ['show'];
            }



            $view = \View::make('rapyd::datagrid.actions', [
                'uri' => '/admin/folder/action/edit',
                'id' => $row->data->id,
                'actions' => $actions
            ]);

            $row->cell('_edit')->value($view);

        });
        //排序
        $grid->orderBy('id', 'desc');

        $grid->paginate(15); //pagination

        return view('admin.grid', compact('grid', 'filter'));
    }


    public function anyEdit()
    {
        $data = Input::all();
        $user = Auth::user();
        if(isset($data['do_delete']) && $data['do_delete']) {
           FolderService::getInstance()->delFolder($data['do_delete']);
            return redirect('admin/folders');
        }elseif (isset($data['save']) && $data['save']==1 && isset($data['insert']) && $data['insert']==1) {
            $id = FolderService::getInstance()-> create ($user->id,$data);
            return redirect('admin/folder/action/edit?show='.$id);
        }

        $edit = DataEdit::source( new Folder());
        $dataInfo = $edit->model;
        if($dataInfo) $dataInfo = $dataInfo->toArray();
        $edit->link("/admin/folders","分类列表", "TR")->back();
        if (empty($dataInfo)) {
            $edit->add('user_id','名称', 'hidden')->insertValue($user->id);
        }
        $edit->add('name','名称', 'text')->rule('required');
        $edit->add('tags', '标签：多标签用";" 分割', 'text')->insertValue(' ');
        //$edit->add('private','权限', 'Radiogroup')->options(self::$privates)->rule('required');
        $edit->add('is_recommend','是否推荐', 'Radiogroup')->options(self::$recommends)->insertValue('0');
        if(isset($data['show'])){

            if(!empty($dataInfo) && $dataInfo['image_id']){
                $edit->add('image_id', "图片（建议248px*254px)", 'text')->attributes(array("style" => "display:none;"))->insertValue(' ');
            }
        }else{
            $edit->add('image_id', "图片 （建议248px*254px)", 'text')->attributes(array("style" => "display:none"))->insertValue('');
        }

        return $edit->view('admin.category.edit', compact('edit'));
    }






}